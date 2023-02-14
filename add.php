<?php
session_start();
function __autoload($class){
    require "Models/".$class.".php";
}
$product = new Product;
if(isset($_POST['add'])){
    $request = array(
        'name'=> $_POST['name'],
        'price'=> $_POST['price'],
        'weight'=> $_POST['weight'],
    );
    $product->store($request);
}

include_once  "./init.php";
        // start header area
require_once "./layouts/header.php"; 
?>
<section>
<div class="container py-5">
  <div class="row"><!-- row -->
      <div class="col-6"><h3>Add Product</h3></div>
      <div class="col-6"><!-- col-6 -->
        <div class="float-right"><a href="/taskProject/" class="btn btn-info">BACK</a></div>
      </div><!-- col-6.// -->
    </div><!-- row.// -->
    <hr>
  <div class="card text-white bg-dark">
  <?php if(!empty($product->messErrors)): ?>
            <div class="container">
        <div class="alert alert-warning alert-success-style3 alert-success-stylenone">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
					<span class="icon-sc-cl" aria-hidden="true">×</span>
				</button>
        <i class="fa fa-exclamation-triangle edu-warning-danger admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
        <?php foreach($product->messErrors as $errors): ?>
            <p class="message-alert-none text-center"><strong>Warning!</strong> <?php echo  $errors ?></p>
            <?php endforeach ?>
        </div>
        </div>
    <?php endif ?>
    <div class="card-body">
      <form method="POST" autocomplete="off">
        <div class="form-row">
          <div class="col-7">
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <div class="col">
            <input type="number" step="any" class="form-control" name="price" placeholder="Price">
          </div>
          <div class="col">
            <input type="number" step="any" class="form-control" name="weight" placeholder="Weight kg">
          </div>
          <div class="col">
            <button type="submit" name="add" class="btn btn-primary">Add</button>
          </div>
        </div>
      </form>
  </div>
</div>

</div>
</section>
<?php
 //start footer area 
require_once "./layouts/footer.php"; ?>
       
