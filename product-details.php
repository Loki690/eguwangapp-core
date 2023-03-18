<?php
include('header.php');

require_once('class.php');

$id = $_GET['id'];

$store_products = $store->getProductDetails($id);

require_once('config.php');
    
if(!isset($_SESSION)){
  session_start();
}
// type of user can access
if(isset($_SESSION['Role']) && $_SESSION['Role'] == "user"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];


}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
	$senior = $con->query($sql) or die ($con->error);
	$row1 = $senior->fetch_assoc();

  // fetching image from seniors table
  $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
  $senior_img = $con->query($sql_img) or die ($con->error);
  $row_img = $senior_img->fetch_assoc();
  
function trasacID(){
  $floor = FLOOR(RAND() * 401) + 100;
  $id = $floor.rand(10,20);

  return $id;
}

$transId = trasacID();

if(isset($_POST['order-direct'])){

  $qty = $_POST['qty'];
  $user_id = $_POST['user_id'];
  $p_id = $_POST['product_id'];
  $store_id = $_POST['store_id'];
  $customer_name = $_POST['customer_name'];
  $price = $_POST['price'];
  $product_name = $_POST['product_name'];
  $status = "order";
  $ts = $transId;

  $sql = "INSERT INTO `cart`(`user_id`, `customer_name`, `store_id`, `product_id`, `product_name`, `price`, `qty`, `status`, `transid`) VALUES ('$user_id', '$customer_name', '$store_id', '$p_id', '$product_name', '$price', '$qty', '$status', '$ts')";
  //$order = 

  if($con->query($sql) === TRUE){

    $query = "SELECT * FROM `cart` WHERE `transid` = '$ts' AND `status` = 'order'";
    $rq = $con->query($query) or die($con->error);
    $result = $rq->fetch_assoc();

    $cart_id = $result['id'];

    //$cart_id = $order['id'];
    ?>
       <script>
        Swal.fire(
          'Product Checkout',
        ).then (function(){
          window.location.href='senior-checkout.php?id=<?= $cart_id; ?>'
        });
        // alert('New Product is added');
        // window.location.href="store-myproducts.php?id=<?= $store_id; ?>";
      </script>
    <?php 
  }else{

    http_response_code(404);
    echo "Page Not Found";

  }

}

  include('notification-count.php');
  include('cart-count.php');

  if(isset($_POST['add-to-cart'])){
    $store->addtoCart($_POST['add-to-cart']);
  }
  // if(isset($_POST['order-direct'])){
  //   $store->orderProduct($_POST['order-direct']);
  // }
  

?>
<!--Topbar -->
<div class="topbar transition bg-primary fixed-top pb-5">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
			<li class="nav-item">
					<a class="nav-link" href="senior-cart.php">
					   <i class="fa fa-cart-shopping size-icon-1" style="color: white;"></i><span class="badge bg-danger notif"><?= $cart_count; ?></span>
					</a> 								  
				  </li>
         <li class="nav-item">
					<a class="nav-link" href="senior-notification.php">
					   <i class="fa fa-bell size-icon-1" style="color: white;"></i>
						 <?php if($count == 0) {?>
					
						<?php }else{ ?>
							<span class="badge bg-danger notif"> 
							<?php echo $count; ?> 
						</span>
							<?php } ?>
					</a> 								  
				  </li>

				  <li class="nav-item dropdown">
					<?php if(isset($_SESSION['UserLogin'])){?>
					<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  <img src="uploads/<?php echo $row_img['image'] ?>" alt="">
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="senior-profile.php"><i class="fa fa-user size-icon-1"></i> <span><?php echo $_SESSION['UserLogin'];?></span></a>
						<a class="dropdown-item" href="senior-myorders.php"><i class="fa fa-cog size-icon-1"></i> <span>My Orders</span></a>
            <a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>Settings</span></a>
						<hr class="dropdown-divider">
						<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>Logout</span></a>
					</ul>
				  </li>
			</ul>
			<?php } ?>
		</div>
	</div>

    <!--Sidebar-->
	<div class="sidebar transition overlay-scrollbars">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-0">E-Guwang</h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="senior-home.php">
						<i class='bx bxs-home icon' ></i> Home
					</a>
				</li>
        <li>
					<a href="senior-booklet.php">
					<i class='bx bxs-book-open icon'></i>
						Booklet
					</a>
				</li>
				<li>
					<a href="store-senior-index.php" class="active">
						<i class='bx bxs-store icon'></i> 
						Shop
					</a>
				</li>
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->

  <div class="sidebar-overlay"></div>

  <div class="content-start transition">
		<div class="container-fluid dashboard">

      <div class="row">

      <?php
      
      ?>
        <!-- Product section-->
        <?php if(!empty($store_products)){ ?>
        <section class="py-5 bg-white mb-2">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 img-fluid" src="uploads/<?= $store_products['image'] ?>" alt="..." /></div>
                    <div class="col-md-6 text-black">
                        <h1 class="display-5 fw-bolder"> <?= $store_products['product_name'] ?></h1>
                        <div class="fs-5 mb-3">
                            <span><strong><?= "₱".$store_products['Price'].".00"; ?></strong></span>
                        </div>
                        <p class="lead"><?= $store_products['description'] ?></p>
                      
                        <form action="" method="POST">
                   
                        <div class="d-flex">
                          
                        <input class="form-control text-center" id="inputQuantity" name="qty" type="num" value="1" style="max-width: 7rem" />

                            <input type="hidden" name="user_id" value="<?= $session_id ?>">
                            <input type="hidden" name="customer_name" value="<?= $user?>">
                            <input type="hidden" name="product_name" value="<?= $store_products['product_name'] ?>">
                            <input type="hidden" name="store_id" value="<?= $store_products['storeid']; ?>">
                            <input type="hidden" name="product_id" value="<?= $store_products['id']; ?>">
                            <input type="hidden" name="price" value="<?= $store_products['Price']; ?>">

                            <button class="btn btn-outline-primary btn-lg flex-shrink-0"  type="submit" name="add-to-cart">
                            <i class='bx bx-cart-add me-1'></i>
                                Add to cart
                            </button>
                            <button class="btn btn-primary btn-lg flex-shrink-0" type="submit" name="order-direct">
                                <i class="bi-cart-fill me-1"></i>
                               Buy Now
                            </button>
                            </form>
                          
                        </div>
                        
                    </div>
                </div>
              </section>
              <?php } ?>
            </div>
       
        <!-- Related items section-->
      </div>

    </div>
  </div>

  <?php
  include('footer.php');
  ?>

  
