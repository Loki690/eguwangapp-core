<?php
include('header.php');

require_once('class.php');

include('config.php');

$id = $_GET['id'];

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

  $con_order = "SELECT * FROM orders WHERE `transaction_id` = '$id'";
  $order = $con->query($con_order) or die ($con->error);
  $result = $order->fetch_assoc();

  $cart_id = $result['cart_id'];

  if(isset($_POST['place-order'])){

    $cartup_sql = "UPDATE `cart` SET `count`= 1 WHERE `id` = '$cart_id' ";
    $cart = $con->query($cartup_sql) or die($con->error);

  }






include('notification-count.php');
include('cart-count.php');

$store->placeOrder($_POST);



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

  <div class="content-start transition mt-5">
		<div class="container-fluid dashboard">

    <div class="content-header hstack g-3 mb-3">
        <h1>Checkout</h1>
    </div>

    <?php 

      $con_image = "SELECT * FROM `products` WHERE `id` = '".$result['product_id']."'";
      $image = $con->query($con_image) or die($con->error);
      $result_image = $image->fetch_assoc();

      $con_items = "SELECT * FROM `product_items` WHERE `product_id` = '".$result['product_id']."'";
      $pitem = $con->query($con_items) or die($con->error);
      $result_pitem = $pitem->fetch_assoc();

    ?>

			<div class="row bg-white">
        <div class="col-md-8">
            <div class="mt-3 mb-3">
              <h4><span><i class='bx bxs-info-circle'></i></span> Informaton</h4>
            </div>
            <div class="px-3">
            <h4><strong> <?= $result['customer_name']?></strong></h4>
            <p>
            <span>Contact Number: <span class="fs-bold text-black"><?= $result['contact_number']; ?></span> </span> | Address: <span class="fw-bold text-black"> <?= $result['delivery_address'] ?></span>
            </p>
            </div>
        </div>
        <div class="col-4">
        <div class="mt-3 text-center">
        <?php if($result['delivery_method'] == "Pick up" ) {?>
              <h5><span><i class="bi bi-geo-fill"></i></span> <?= $result['delivery_method']?></h5>
        <?php }else{ ?>
          <h5><span><i class="bi bi-truck"></i></span> <?= $result['delivery_method']?></h5>
          <?php } ?>
        </div>
        </div>
        <div class="col-md-12">
          <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
          <div class="col-4">
          
          <div class="mt-3">
              <h5><span><i class='bx bxl-product-hunt' ></i></span> Product Ordered</h5>
            </div>
          </div>
          <div class="col-2 mt-3 text-center">
            <h5>Unit Price</h5>
          </div>
          <div class="col-2 mt-3 text-center">
            <h5>Qty</h5>
          </div>
          <div class="col-4 mt-3 text-end">
          <h5>Total - 5% discount</h5>
          </div>
          </div>
        
        </div>
        <div class="col-md-12 mt-2 px-3">
          <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
          <div class="col-4">
            <div>
            <img src="uploads/<?= $result_image['image']; ?>" alt="" width="100px">
            <span class="text-black px-3"><?= $result_image['product_name'] ?></span>
            </div>
            
          </div>
          <div class="col-2 mt-3 text-center ">
            <p><?= "₱".$result_pitem['price'].".00"; ?></p>
          </div>
          <div class="col-2 mt-3 text-center">
            <p><?= $result['qty']; ?></p>
          </div>
          <div class="col-4 mt-3 text-end">
          <p><?= "₱".$result['total_price'].".00"; ?></p>
          </div>
          </div>
          
        </div>
        <div class="col-md-12 text-end pt-3 px-5 mt-3 bg-info">
          <p class="text-black"><strong> Order Total: <?= "₱".$result['total_price'].".00"; ?> </strong></p>
        </div>
        
        <div class="col-md-12">
          <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
            <div class="col-6">
            <div class="mt-3">
              <h5><span><i class='bx bxs-wallet' ></i></i></span> Payment Method</h5>
            </div>
            <div class="col mt-3">
         
              <?php if($result['payment'] == "Gcash"){
                 ?>
               <a href="" >Set Gcash Payment</a>

                 <?php }elseif($result['payment'] == "Bank"){ ?>
                  <a href="" >Set Bank Payment</a>
                  <?php } ?>

            </div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-6 mt-3 text-center">
                <strong><p> <?= $result['payment'] ?></p></strong> 
                </div>
                <div class="col-6 mt-3 text-start">
                  <h5>CHANGE</h5>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 text-end mb-5 mt-4">
          
         <form action="" method="POST">
          <input type="hidden" name="order" value="order">
          <input type="hidden" name="order_id" value="<?= $result['id']; ?>">
            <div>
              <button class="btn btn-primary btn-lg w-50" type="submit" name="place-order">Place Order</button>
            </div>
          </form>
        </div>

      </div>

    </div>
  </div>


  <?php
  include('footer.php');
  ?>