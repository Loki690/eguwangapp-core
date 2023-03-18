<?php
include('header.php');

require_once('class.php');

include('config.php');



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

  $id = $_GET['id'];

  $sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
	$senior = $con->query($sql) or die ($con->error);
	$row1 = $senior->fetch_assoc();

  // fetching image from seniors table
  $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
  $senior_img = $con->query($sql_img) or die ($con->error);
  $row_img = $senior_img->fetch_assoc();

  $o = "order";


  $con_order = "SELECT * FROM orders WHERE `user_id` = '$session_id' AND `status` = '$o' AND `id` = '$id' ORDER BY `id` DESC";
  $order = $con->query($con_order) or die ($con->error);
  $result = $order->fetch_assoc();

  include('notification-count.php');

  if(isset($_POST['receive'])){

    $receive = "Received";
    $con_up = "UPDATE `orders` SET `store_status`= '$receive' WHERE `id` = '$id'";
    $order_up = $con->query($con_up) or die($con->error);

    if($order_up == TRUE){
      ?>
      <script>
        Swal.fire(
          'Product Received',
          'You clicked the button!',
          'success'
        ).then(function(){
            window.location.href="senior-order-details.php?id=<?= $id; ?>";
          })
      </script>
    <?php
    }
    
  }

  include('cart-count.php');


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
        <h1>Order Details</h1> <span class="px-3 mx-3"><a href="senior-order-history.php">Purchase History</a></span>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
          <?php
           $con_image = "SELECT * FROM `products` WHERE `id` = '".$result['product_id']."'";
           $image = $con->query($con_image) or die($con->error);
           $result_image = $image->fetch_assoc();
          ?>
          <div class="card-body mt-2">
            <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                <div class="col-4">
                <div>
                <img src="uploads/<?= $result_image['image']; ?>" alt="" width="250px">
                </div>
                </div>
                <div class="col-md-8 pt-3">
                  <div>
                  <h1 class="text-black text-start"><?= $result_image['product_name'] ?></h1>
                  <p>Description : <?= $result_image['description'] ?></p>
                  </div>
                  <div class="row">
                   
                    <?php if($result['delivery_method'] == "Delivery" ) {?>
                      <div class="col-4">
                      <p>Customer Address : <strong class="text-primary"> <?= $result['delivery_address'] ?> </strong></p>
                      </div>
                    <?php }else{ ?>
                      <?php 
                        $store_id = $result['store_id'];
                        $store_con = "SELECT * FROM `stores` WHERE `id` = '$store_id' ";
                        $st_address = $con->query($store_con) or die($con->error);
                        $st_result = $st_address->fetch_assoc();
                        ?>

                      <div class="col-4">
                      <p>Store Address : <strong class="text-primary"> <?= $st_result['address'] ?> </strong></p>
                      </div>

                      <?php } ?>
                  <div class="col-4 text-center">
                      <p>Quantity : <strong class="text-primary"> <?= $result['qty'] ?> </strong></p>
                    </div>
                    <div class="col-4">
                      <p>Price : <strong class="text-primary"><?= "₱".$result['total_price'].".00";  ?></strong> </p>
                    </div>
                    <div class="col-4">
                    <?php if($result['delivery_method'] == "Pick up" ) {?>
                      
                          <h5><span><i class="bi bi-geo-fill"></i></span> <?= $result['delivery_method']?>       
                          <span class="badge 
                          <?php if($result['store_status'] == "Pending"){ ?>
                      bg-primary
                      <?php }elseif($result['store_status'] == "Preparing"){?>
                      bg-warning
                      <?php }elseif($result['store_status'] == "Ready"){?>
                        bg-success
                        <?php }elseif($result['store_status'] == "Canceled"){?>
                        bg-danger
                        <?php }else{ ?>
                          bg-success
                          <?php } ?>
                          px-4 mt-3"><?= $result['store_status'] ?></span></h5>
                    
                    <?php }else{ ?>
                      <h5><span><i class="bi bi-truck"></i></span> <?= $result['delivery_method']?> 
                      <span class="badge 
                      <?php if($result['store_status'] == "Pending"){ ?>
                      bg-primary
                      <?php }elseif($result['store_status'] == "Preparing"){?>
                      bg-warning
                      <?php }elseif($result['store_status'] == "Ready"){?>
                        bg-success
                        <?php }elseif($result['store_status'] == "Canceled"){?>
                        bg-danger
                        <?php }else{ ?>
                          bg-success
                          <?php } ?>
                      px-4 mt-3"><?= $result['store_status'] ?></span></h5>
                      
                      <?php } ?>
                    </div>
                  </div>
                </div>
               
                <div class="col-md-12 mt-4 text-end border-bottom">

                  <?php if($result['store_status'] == "Pending"){?>
                  <button class="btn btn-danger">Cancel Order</button>
                  <?php }elseif($result['store_status'] == "Preparing") {?>
                    <button class="btn btn-danger">Cancel Order</button>
                    <?php }elseif($result['store_status'] == "Canceled"){ ?>
                     
                      <?php }else{ ?>
                       
                        <?php if($result['store_status'] == "Received"){?>
                          <a href="product-details.php?id=<?= $result['product_id'] ?>"> <button class="btn btn-primary w-25" type="submit" name="receive">Buy Again</button></a>
                          <?php }else{ ?>
                        <form action="" method="POST">
                        <button class="btn btn-primary w-25" type="submit" name="receive">Receive</button>
                        </form>
                        <?php } ?>
                        <?php } ?>
                </div>
            </div>
          </div>
          <div class="card-footer bg-primary">

          </div>
        </div>
      </div>
    </div>
    </div>
  </div>

  <?php
  include('footer.php');
  ?>