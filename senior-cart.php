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

  $sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
	$senior = $con->query($sql) or die ($con->error);
	$row1 = $senior->fetch_assoc();

  // fetching image from seniors table
  $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
  $senior_img = $con->query($sql_img) or die ($con->error);
  $row_img = $senior_img->fetch_assoc();

  $con_cart = "SELECT * FROM cart WHERE `user_id` = ' $session_id ' AND `status` != 'order' ORDER BY `id` DESC ";
  $cart = $con->query($con_cart) or die ($con->error);
  $result = $cart->fetch_assoc();
  

include('notification-count.php');
include('cart-count.php');

$store->updateQty($_POST);


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

  
  <!--Content Start-->
	<div class="content-start transition mt-5">
		<div class="container-fluid dashboard">
    <div class="content-header">
    <h1><i class='bx bxs-cart px-3'></i>Cart</h1>
    <p></p>
  </div>
			<div class="row">
      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col"></th>
            <th scope="col">Price</th>
            <th scope="col">Total Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <?php if(!empty($result)){ ?>
        <?php do{ ?>
          <?php if($result['isdeleted'] != "yes") {?>
          <?php
          $price = $result['price'];
          $qty = $result['qty'];
          $total_price = $price * $qty;

          $con_image = "SELECT `image` FROM `products` WHERE `id` = '".$result['product_id']."'";
          $image = $con->query($con_image) or die($con->error);
          $result_image = $image->fetch_assoc();
          ?>
          <tr>

          <?php do{ ?>
          <td><img src="uploads/<?= $result_image['image']; ?>" alt="dsds" width="100px"></td>
          <?php }while($result_image = $image->fetch_assoc()) ?>

           
            <td><?= $result['product_name']; ?></td>

            <td><?= "₱".$result['price'].".00"; ?></td>
            <td><?= "₱".$total_price.".00"; ?></td>

         
            <?php 
            
            $cart_id = $result['id']; 
            $check_sql = "SELECT * FROM `orders` WHERE `cart_id` = '$cart_id'";
            $check = $con->query($check_sql) or die ($con->error);
            $check_result = $check->fetch_assoc();

            ?>
            <?php if($check_result){ ?>
            <?php if($check_result['status'] != "order") {?>
              <form action="" method="POST">
            <td><input type="num" class="form-control text-center" name="qty" value="<?= $result['qty']; ?>">
            <input type="hidden" name="cart_id" value="<?= $result['id']; ?>">
            <button class="btn btn-sm btn-primary" type="submit" name="update-qty">Update</button>
            </td>
            </form>
             
            <td><a href="senior-checkout.php?id=<?= $result['id']; ?>"> <span><i class='bx bxs-wallet'></i></span> Checkout</a></td>
              <?php }else{ ?>
                <form action="" method="POST">
                  <td>
                  <input type="num" class="form-control text-center" name="qty" value="<?= $result['qty']; ?>" aria-label="Disabled input example" disabled readonly>
                  <input type="hidden" name="cart_id" value="<?= $result['id']; ?>">
                  </td>
                  </form>
                <td><a href="product-details.php?id=<?= $result['product_id']; ?>"><span><i class='bx bxs-cart-add'></i></span> Buy Again</a></td>
                <?php } ?>
                <?php }else{?>
                  <form action="" method="POST">
                  <td><input type="num" class="form-control text-center" name="qty" value="<?= $result['qty']; ?>">
                  <input type="hidden" name="cart_id" value="<?= $result['id']; ?>">
                  <button class="btn btn-sm btn-primary" type="submit" name="update-qty">Update</button>
                  </td>
                  </form>
                  <td><a href="senior-checkout.php?id=<?= $result['id']; ?>"><i class='bx bxs-wallet'></i> Checkout</a></td>
                <?php } ?>

            <td><a href="delete-cart.php?id=<?= $result['id']; ?>" class="text-danger">Delete</a></td>

          </tr>
          <?php }else{
            
          } ?>
          <?php }while($result = $cart->fetch_assoc()) ?>
          <?php } ?>
        </tbody>
      </table>
      </div>
      </div>
    </div>
  </div>

  <?php
  include('footer.php');
  ?>
  