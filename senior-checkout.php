<?php
include('header.php');

require_once('class.php');

// include('config.php');
$con = $store->con();

if(!isset($_SESSION)){
  session_start();
}
// type of user can access
if(isset($_SESSION['Role']) && $_SESSION['Role'] == "user"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
  $senior_id = $_SESSION['seniorid'];


}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

  $id = $_GET['id'];

  $get_senior = "SELECT * FROM `seniors` WHERE `seniorcitizen_id` = '$senior_id' ";
  $i = $con->query($get_senior) or die ($con->error);
	$row_senior = $i->fetch_assoc();

  $sql = "SELECT * FROM users WHERE id = '".$_SESSION['ID']."' ";
	$senior = $con->query($sql) or die ($con->error);
	$row1 = $senior->fetch_assoc();

  // // fetching image from seniors table
  // $sql_img = "SELECT `image` FROM  `seniors` WHERE `seniorcitizen_id` = '".$row1['seniorcitizen_id']."'";
  // $senior_img = $con->query($sql_img) or die ($con->error);
  // $row_img = $senior_img->fetch_assoc();

  $con_cart = "SELECT * FROM cart WHERE `id` = '$id'";
  $cart = $con->query($con_cart) or die ($con->error);
  $result = $cart->fetch_assoc();

  $price = $result['price'];
  $qty = $result['qty'];
  $total_price = ($price * $qty);
  $v = $total_price * 0.05;
  
  $final_total = $total_price - $v;

  $store->orderProduct($_POST['checkout']);

  include('notification-count.php');
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

  <!--Content Start-->
	<div class="content-start transition mt-5">
		<div class="container-fluid dashboard">

			<div class="row">
      <main class="card bg-white pt-3 pb-3">

      <form action="" method="POST">
        <div class="row g-5">
          <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Your cart</span>
              <span class="badge bg-primary rounded-pill"><?= $cart_count ?></span>
            </h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0"><?= $result['product_name'] ?></h6>
                  <small class="text-muted"><?= $result['qty']; ?></small>
                </div>
                <span class="text-muted"><?= "₱".$result['price'].".00"; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                  <h6 class="my-0">Discount</h6>
                  <small>Senior Citizen</small>
                </div>
                <span class="text-success">5%</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span class="text-success">Total (Discounted Price) : </span>
                <strong><?= "₱".$final_total.".00"; ?></strong>
              </li>
            </ul>

          </div>
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Product Checkout</h4>
            
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="firstName" class="form-label">First name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="<?= $row_senior['first_name'] ?>" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Last name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="<?= $row_senior['last_name'] ?>" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>

                <div class="col-sm-6">
                  <label for="contact_number" class="form-label">Contact Number</label>
                  <input type="number" class="form-control" id="contact_number" name="number" placeholder="09123456789" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="delivery_address" placeholder="1234 Main St" required>
                  <div class="invalid-feedback">
                    Please enter your shipping address.
                  </div>
                </div>

                <!-- <div class="col-md-5">
                  <label for="country" class="form-label">City</label>
                  <select class="form-select" id="country" required>
                    <option value="">Choose...</option>
                    <option>Davao City</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>
                </div>

                <div class="col-md-4">
                  <label for="state" class="form-label">Barangay</label>
                  <select class="form-select" id="state" required>
                    <option value="">Choose...</option>
                    <option>California</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>
                </div> -->

              </div>

              <hr class="my-4">
              <h4 class="mb-3">Delivery Method</h4>

              <div class="my-3">
                <div class="form-check">
                  <input id="delivery" name="delivery_method" type="radio" class="form-check-input" value="Delivery" checked required>
                  <label class="form-check-label" for="delivery">Delivery</label>
                </div>
                <div class="form-check">
                  <input id="pickup" name="delivery_method" type="radio" class="form-check-input" value="Pick up" required>
                  <label class="form-check-label" for="pickup">Pick up</label>
                </div>
              </div>

              <hr class="my-4">

              <h4 class="mb-3">Payment Method</h4>

              <div class="my-3">
                <div class="form-check">
                  <input id="cashondelivery" name="payment" type="radio" class="form-check-input" value="Cash On Delivery" checked required>
                  <label class="form-check-label" for="cashondelivery">Cash on Delivery</label>
                </div>
                <div class="form-ccashondelivery">
                  <input id="gcash" name="payment" type="radio" class="form-check-input" value="Gcash" required>
                  <label class="form-check-label" for="gcash">Gcash</label>
                </div>
                <div class="form-check">
                  <input id="bank" name="payment" type="radio" class="form-check-input" value="Bank" required>
                  <label class="form-check-label" for="bank">Bank Card</label>
                </div>
              </div>

              <div class="row gy-3">
                
              </div>

              <hr class="my-4">
              
              <input type="hidden" name="cart_id" value="<?= $result['id'] ?>">
              <input type="hidden" name="user_id" value="<?= $result['user_id'] ?>">
              <input type="hidden" name="store_id" value="<?= $result['store_id'] ?>">
              <input type="hidden" name="product_id" value="<?= $result['product_id'] ?>">
              <input type="hidden" name="customer_name" value="<?= $row_senior['first_name']." ". $row_senior['last_name']; ?>">
              <input type="hidden" name="total_price" value="<?= $final_total; ?>">
              <input type="hidden" name="qty" value="<?= $result['qty']; ?>">

              <button class="w-100 btn btn-primary btn-lg" type="submit" name="checkout">Continue to checkout</button>
           
          </div>
        </div>
      </form>
      </main>
    
      </div>
      </div>
    </div>
  </div>

  <?php
  include('footer.php');
  ?>
  

