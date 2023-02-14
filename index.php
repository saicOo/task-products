<?php
session_start();
include_once  "./init.php";
function __autoload($class){
    require "Models/".$class.".php";
}

$product = new Product;
$disblayproduct = $product->display();
if (isset($_POST['mass_delete']) && !empty($_POST['mass_delete'])) {
  $mass_delete = $_POST['mass_delete'];
  $product->destroy($mass_delete);
}
        // start header area
require_once "./layouts/header.php"; 
?>

<section class="mt-3" id="app">
  <div class="container"><!-- container -->
    <div class="row"><!-- row -->
      <div class="col-6"><h3>Lest Product</h3></div>
      <div class="col-6"><!-- col-6 -->
        <div class="float-right"><a href="add.php" class="btn btn-info">ADD</a></div>
        <div class="float-right mr-3">
          <form action="" method="POST">
            <input type="hidden" :value="itemDeleted" name="mass_delete">
            <button type="submit" class="btn btn-primary mb-2">MASS DELETE</button>
          </form>
        </div>
      </div><!-- col-6.// -->
    </div><!-- row.// -->
    <hr>
    <div class="row"><!-- row -->
      <?php foreach($disblayproduct as $item): ?>
      <div class="col-md-4 col-sm-2"><!-- col -->
        <div class="card text-white bg-dark"><!-- card -->
          <h5 class="card-header">
            <input type="checkbox" class="delete-checkbox" value="<?php echo $item['id'] ?>" @change="massDelete($event)">
          </h5>
          <div class="card-body text-center">
            <h5>Name: <?php echo $item['name'] ?></h5>
            <h5>Price: <?php echo $item['price'] ?></h5>
            <h5>Weight: <?php echo $item['weight'] ?></h5>
          </div>
        </div><!-- card.// -->
      </div><!-- col.// -->
      <?php endforeach ?>
    </div><!-- row.// -->
  </div><!-- container.// -->
</section>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>

        // Vue JS
        var app = new Vue({
            el: '#app',
            data: {
                itemDeleted: [],
            },
            methods: {
                massDelete: function(event) {
                    console.log(event.target.value);
                    productId = event.target.value;
                    this.itemDeleted.push(productId);
                },
            },


        })
    </script>
<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
