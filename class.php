
<?php

include('header.php');

class Store {
  private $server = "mysql:host=localhost;dbname=3eguwangapp";
  private $user = "root";
  private $pass = "";
  private $options = array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

  protected $con;

  public function openConnection(){

    try{

      $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
      return $this->con;

    }catch(PDOException $e){
      echo "There is some problem in the connection". $e->getMessage();
    }
  }
  public function closeConnection()
  {
    $this->con = null;
  }


  public function getUsers()
    {

      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM `stores` ");
      $stmt->execute();
      $users = $stmt->fetchAll();
      $userCount = $stmt->rowCount();

      if($userCount > 0 ){
        return $users;
      }else{
        return 0;
      }

    }

    // setting user session
  public function setUserData($array){
    
      if(!isset($_SESSION)){
        session_start();
      }

      $_SESSION['userdata'] = array (
        "storeName" => $array ['store_name'],
        "id" => $array['id'],
        "image" => $array['image'],
        "password" => $array['password'],
        "username" => $array['username']
      );

      return $_SESSION['userdata'];

  }

  public function getUserData(){
      
    if(!isset($_SESSION)){
      
      session_start();
    }
    if(isset($_SESSION['userdata'])){
      return $_SESSION['userdata'];
    }else{

      header("Location: store-login.php");
      
    }

  }

  public function storeLogin(){

    if (isset($_POST['login-store'])){

      $username = $_POST['username'];
      $password = $_POST['password'];

      $connection = $this->openConnection();
      $stmt = $connection->prepare("SELECT * FROM `stores` WHERE username = ? AND password = ? ");
      $stmt->execute([$username, $password]);

      $store_user= $stmt->fetch();

      $total = $stmt->rowCount();

      if($total > 0 ){
        
        echo "Welcome ".$store_user['store_name'];
        $this->setUserData($store_user);

        ?>
        <script>
        Swal.fire(
          'Login Success',
          'success'
        ).then (function(){
          window.location.href='get-session-store.php'
        });
      </script>
        <?php
        // header("Location: get-session-store.php");
      }else{
            ?>
          <script>
           Swal.fire({
              icon: 'error',
              title: 'Login failed',
              text: 'Something went wrong!',
            })
          </script>
        <?php
      }

  }

  }

  public function logout(){

    if(!isset($_SESSION)){
      session_start();
    }
    $_SESSION['userdata'] = null;
    unset($_SESSION['userdata']);
  }

  public function registerStore(){

    if(isset($_POST['store-register'])){

      $username = $_POST['username'];
      $store_name = $_POST['store_name'];
      $password = $_POST['password'];
      $mobile_number = $_POST['mobile_number'];
      $address = $_POST['address'];

      $image = rand(1000, 1000000)."-".$_FILES['image']['name'];
      $image_loc = $_FILES['image']['tmp_name'];
      $folder = "uploads/";

      $new_file_name = strtolower($image);
      $final_file = str_replace(' ','-',$new_file_name);

      if(move_uploaded_file($image_loc, $folder.$final_file)){

        $connection = $this->openConnection();
        $stmt = $connection->prepare("INSERT INTO `stores`(`store_name`, `password`, `mobile_number`, `address`, `image`, `username`) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$store_name, $password, $mobile_number, $address, $final_file, $username]);

        ?>
        <script>
          alert('New Store is registered');
          window.location.href="admin-store.php";
        </script>
        <?php 
      }
    }
  }

  public function showAllStores(){

    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM `stores` ");
    $stmt->execute();
    $all_stores = $stmt->fetchAll();

    $total = $stmt->rowCount();

    if($total > 0 ){
      return $all_stores;

    }else{
      echo $connection->errorInfo();
    }
  }
  public function show_404(){

    http_response_code(404);
    echo "Page Not Found";

  }

  public function storeDetails($id){
    
    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM `stores` WHERE `id` = ?");
    // $stmt = $connection->prepare("SELECT t1.id ,product_name, product_type, min_stocks, SUM(qty) AS total
    // FROM (SELECT * FROM products WHERE products.id = ? ) t1 INNER JOIN product_items t2 ON t1.id = t2.product_id");
    $stmt->execute([$id]);
    $store_detail = $stmt->fetch();
    $total = $stmt->rowCount();

    if($total > 0 ){

      if(isset($store_detail)){

        return $store_detail;
      }

    }else{

      return $this->show_404();

    }
  }

  public function addProduct(){

    if(isset($_POST['add-product'])){
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $min_stocks = $_POST['min_stocks'];
    $description = $_POST['description'];
    $store_id = $_POST['store_id'];

    $image = rand(1000, 1000000)."-".$_FILES['image']['name'];
    $image_loc = $_FILES['image']['tmp_name'];
    $folder = "uploads/";

    $new_file_name = strtolower($image);
    $final_file = str_replace(' ','-',$new_file_name);

    if(move_uploaded_file($image_loc, $folder.$final_file)){

    $connection = $this->openConnection();
    $stmt = $connection->prepare("INSERT INTO `products`(`storeid`, `product_name`, `product_type`, `min_stocks`, `description`, `image`) VALUES (?,?,?,?,?,?)");
    $stmt->execute([$store_id, $product_name, $product_type, $min_stocks, $description, $final_file]);

    if($stmt == true){
      ?>
      <script>
        Swal.fire(
          'Product Successfully Added',
        ).then (function(){
          window.location.href='store-myproducts.php?id=<?= $store_id; ?>'
        });
        // alert('New Product is added');
        // window.location.href="store-myproducts.php?id=<?= $store_id; ?>";
      </script>
    <?php
    }else{
      echo $connection->errorInfo();
    }
    }
    }

  }

  public function getStoreProduct($store_id){


    $connection = $this->openConnection();

    $stmt = $connection->prepare("SELECT * FROM `products` WHERE `storeid` = ?");
    $stmt->execute([$store_id]);

    $store_products = $stmt->fetchAll();
    $total = $stmt->rowCount();

      if($total > 0 ){

        if(isset($store_products)){

          return $store_products;
        }

      }else{

        return $this->show_404();
        echo $connection->errorInfo();

      }
  }

  public function getProductDetails($id){

    $connection = $this->openConnection();

    // $stmt = $connection->prepare("SELECT * FROM `products` WHERE `id` = ?");
    $stmt = $connection->prepare("SELECT t1.id , storeid, product_name, product_type, min_stocks, description, image, qty AS total, status AS stat, price AS Price
    FROM (SELECT * FROM products WHERE products.id = ? ) t1 INNER JOIN product_items t2 ON t1.id = t2.product_id");
    
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    $total = $stmt->rowCount();

    if($total > 0 ){

      if(isset($product)){

        return $product;
      }

    }else{

      return $this->show_404();

    }
  }

  public function addStock(){

    if(isset($_POST['add_stocks'])){

      $qty = $_POST['qty'];
      $product_id = $_POST['product_id'];
      $store_id = $_POST['store_id'];
      $price = $_POST['price'];
      $status = $_POST['status'];
      
      $connection = $this->openConnection();
      $stmt = $connection->prepare("INSERT INTO `product_items`( `store_id`, `product_id`, `price`, `qty`, `status`) VALUES (?,?,?,?,?)");
      $stmt->execute([$store_id, $product_id, $price, $qty, $status]);

      if($stmt == true){
        ?>
        <script>
         Swal.fire(
          'Success!',
          'success'
        ).then (function(){
          window.location.href="store-myproducts.php";
        });
          
        </script>
      <?php
      }else{
        echo $connection->errorInfo();
      }
    }
  }

  public function addProductStocks(){


    if(isset($_POST['add'])){

      $qty = $_POST['qty'];
      $current_qty = $_POST['current_qty'];
      $product_id = $_POST['product_id'];

      $added_qty = $qty + $current_qty;

      $connection = $this->openConnection();
      $stmt = $connection->prepare("UPDATE `product_items` SET `qty`= '$added_qty' WHERE `product_id` = '$product_id'");
      $stmt->execute();

      if($stmt == true){
        ?>
        <script>
          Swal.fire(
          'Success!',
          'success'
        ).then (function(){
          window.location.href="store-myproducts.php";
        });
        </script>
      <?php
      }else{
        echo $connection->errorInfo();
      }
    }

  }


  public function updateStock(){

    if(isset($_POST['update_stocks'])){

      $qty = $_POST['qty'];
      $product_id = $_POST['product_id'];
      $price = $_POST['price'];
      
      $connection = $this->openConnection();
      $stmt = $connection->prepare("UPDATE `product_items` SET `price`= '$price' ,`qty`= '$qty' WHERE `product_id` = '$product_id'");
      $stmt->execute();

      if($stmt == true){
        ?>
        <script>
         Swal.fire(
          'Success!',
          'success'
        ).then (function(){
          window.location.href="store-add-stocks.php?id=<?= $product_id ?>";
        });
        </script>
      <?php
      }else{
        echo $connection->errorInfo();
      }
    }
  }


  public function viewAllStocks($product_id){

    $connection = $this->openConnection();
    // $stmt = $connection->prepare("SELECT * FROM product_items WHERE product_id = ? ");
    $stmt = $connection->prepare("SELECT t1.id, t1.vendor_name, t1.price, t1.qty, SUM(t2.qty) as sale_qty, 
    SUM(t2.qty * t2.price) as TotalSales FROM product_items t1 LEFT JOIN sales t2 ON t1.id = t2.stocks_id WHERE t1.product_id = ? GROUP BY t1.id" );

    $stmt->execute([$product_id]);
    $stocks = $stmt->fetchAll();
    $total = $stmt->rowCount();

    if($total > 0 ){

      return $stocks;

    }else{

      return "FALSE";

    }

  }

  public function orderProduct(){


    if(isset($_POST['checkout'])){

      $qty = $_POST['qty'];
      $method = $_POST['delivery_method'];
      $payment = $_POST['payment'];
      $delivery_address = $_POST['delivery_address'];
      $customer = $_POST['customer_name'];
      // $number = ['number'];

      $user_id = $_POST['user_id'];
      $p_id = $_POST['product_id'];
      $store_id = $_POST['store_id'];
      $total_price = $_POST['total_price'];
      $cart_id = $_POST['cart_id'];
      $contact = $_POST['number'];

      $trans = $this->transacId();

      $connection = $this->openConnection();
      $stmt = $connection->prepare("INSERT INTO `orders`(`cart_id`, `user_id`, `customer_name`, `product_id`, `store_id`, `qty`, `delivery_method`, `payment`, `total_price`, `delivery_address`, `transaction_id`, `contact_number`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

      $stmt->execute([$cart_id, $user_id, $customer, $p_id, $store_id, $qty, $method, $payment, $total_price, $delivery_address, $trans, $contact]);
      if($stmt == true){
        ?>
        <script>
             Swal.fire(
            'Proceed to Checkout',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="checkout-info.php?id=<?= $trans; ?>";
          })
        </script>
        <!-- <script>
          alert('Proceed to checkout');
          window.location.href="checkout-info.php?id=<?= $trans; ?>";
        </script> -->
      <?php
      }else{
        echo $connection->errorInfo();
      }
    }
  
  }

  public function transacId(){

    $floor = FLOOR(RAND() * 401) + 100;
    $id = $floor.rand(10,20);

    return $id;

  }

  public function getOrder($store_id){


    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM orders WHERE `store_id` = ? AND `status` = 'order' AND `isdeleted` != 'yes'");

    $stmt->execute([$store_id]);
    $orders = $stmt->fetchAll();
   
    $total = $stmt->rowCount();

    if($total > 0 ){

      return $orders;

    }else{

      return null;

    }



  }

  public function getOrderDetails($store_id){

    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT `id`, `user_id`, `customer_name`, `product_id`, `store_id`, SUM(qty) AS tt, `delivery_method`, `payment`, `delivery_address`, `transaction_id` FROM orders WHERE `store_id` = ? ");

    $stmt->execute([$store_id]);
    $orders = $stmt->fetch();
    $total = $stmt->rowCount();

    if($total > 0 ){

      if(isset($orders)){
        
        return $orders;
      }

     

    }else{

      return "FALSE";

    }
  }

  public function addtoCart(){

    
    if(isset($_POST['add-to-cart'])){

      $qty = $_POST['qty'];
      $user_id = $_POST['user_id'];
      $p_id = $_POST['product_id'];
      $store_id = $_POST['store_id'];
      $customer_name = $_POST['customer_name'];
      $price = $_POST['price'];
      $product_name = $_POST['product_name'];

      $connection = $this->openConnection();
      $stmt = $connection->prepare("INSERT INTO `cart`(`user_id`, `customer_name`, `store_id`, `product_id`, `product_name`, `price`, `qty`) VALUES (?,?,?,?,?,?,?)");

      $stmt->execute([$user_id, $customer_name, $store_id, $p_id, $product_name, $price, $qty]);

      if($stmt == true){
        ?>
        <script>
          Swal.fire(
            'Added to Cart',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="senior-cart.php";
          })
        </script>
      <?php
      }else{
        echo $connection->errorInfo();
      }
    }

  }

  public function checkout(){


  }

  public function updateQty(){

    if(isset($_POST['update-qty'])){

      $cart_id = $_POST['cart_id'];
      $qty = $_POST['qty'];

      $connection = $this->openConnection();
      $stmt = $connection->prepare("UPDATE `cart` SET `qty`= '$qty' WHERE `id` = '$cart_id' ");

      $stmt->execute();
      
      if($stmt == true){
        ?>
        <script>
        Swal.fire(
            'Qauntity Updated',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="senior-cart.php";
          })
        </script>
          <?php
   
      }else{
        echo $connection->errorInfo();
      }


    }

  }
  public function placeOrder(){

    if(isset($_POST['place-order'])){

      $order = $_POST['order'];
      $order_id = $_POST['order_id'];
      $store_status = "Pending";

      $connection = $this->openConnection();
      $stmt = $connection->prepare("UPDATE `orders` SET `status`= '$order', `store_status` = '$store_status' WHERE `id` = '$order_id' ");

      $stmt->execute();
      if($stmt == true){
        ?>
        <script>
        Swal.fire(
            'Ordered Success',
            'You clicked the button!',
            'success'
          ).then(function(){
            window.location.href="senior-myorders.php";
          })
        </script>
          <?php
   
      }else{
        echo $connection->errorInfo();
      }


      
    }

  }

  public function getProductinfo($store_id){

    $connection = $this->openConnection();
    $stmt = $connection->prepare("SELECT * FROM `product_items` WHERE `store_id` = '$store_id' ");

    $stmt->execute();
    $info = $stmt->fetchall();
    $total = $stmt->rowCount();

    if($total > 0 ){

      if(isset($info)){
        
        return $info;
      }
      
    }else{

      return "No data";

    }

  }
  public function storeSales($store_id){

   
  }

  public function con(){
    $con = new mysqli('localhost', 'root','', '3eguwangapp');
    if($con->connect_error){
      echo $con->connect_error;
    }else{
      return $con;
      echo "connected";
    }
  }
}


$store = new Store();

?>

</body>
</html>