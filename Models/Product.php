<?php
require_once "Connect.php";
require_once 'InitTrait.php';
class Product extends Connect{
    use InitTrait;
    public $messErrors = [];
    
###############################################################
########################     display all products     ########
public function display(){
    $sql = "SELECT * FROM `products`";
    $result = $this->conn->query($sql);
    return $result;
}

###############################################################
########################     insert new products       ########
public function store($request){
    $name = $request['name'];
    $price = $request['price'];
    $weight = $request['weight'];
    if($this->validate($request)){
            $name = filter_var($name,FILTER_SANITIZE_STRING);
            $weight = $weight . ' kg';
            $sql = "INSERT INTO `products`(`id`,`name`, `price`,`weight`) VALUES (null,'$name','$price','$weight')";
            $result = $this->conn->exec($sql);
            $_SESSION['success'] = "Product added successfully";
            header("location:/taskProject/");
            exit;
    }else{
        return $this->messErrors;
    }
}
public function destroy($product_id){
    $sql = "DELETE FROM `products` WHERE id in($product_id)";
    $result = $this->conn->exec($sql);
    $_SESSION['success'] = "exam deleted successfully";
    $root_path = $this->getRootPath();
    header("location:$root_path");
    exit;
    
}
private function validate($request){
    $name = $request['name'];
    $price = $request['price'];
    $weight = $request['weight'];
/********************************************
    *** check inputs empty & validate float
    */
    if(empty($name)){
        $this->messErrors[] = "the input name is empty";
    } 
    if(empty($price)){
        $this->messErrors[] = "the input price is empty";
    }else{
        if(filter_var($price,FILTER_VALIDATE_FLOAT) === FALSE )  $this->messErrors[] = "The price is not a floating number";
    } 
    if(empty($weight)){
        $this->messErrors[] = "the input weight is empty";
    }else{
        if(filter_var($weight,FILTER_VALIDATE_FLOAT) === FALSE) $this->messErrors[] = "The weight is not a floating number";
    } 
    /********************************************
    *** check inputs length
    */
    if(strlen($name) > 255) $this->messErrors[] = "The name max length char 255";
    if($price > 999999.99) $this->messErrors[] = "The price max 999999.99";
    if($weight > 999999.99) $this->messErrors[] = "The weight max 999999.99";

    return empty($this->messErrors) ? true : false; 
}
}
