<?php
  include('header.php');

  require_once('class.php');

  include('config.php');

  $storeDetails = $store->getUserData();

  $id = $_GET['id'];

  $get_product = "SELECT * FROM `products` WHERE `id` = '$id'";
  $product_con = $con->query($get_product) or die($con->error);

  if($product_con->num_rows > 0 ){

    $product = $product_con->fetch_assoc();

  }else{
    echo "No Result";
  }

  $p_id = $product['id'];

  $get_details = "SELECT * FROM `product_items` WHERE `product_id` = '$p_id'";
  $details_con = $con->query($get_details) or die($con->error);

  if($details_con->num_rows > 0 ){
    $details = $details_con->fetch_assoc();
  }else{
     echo "no data";
  }
 


  $store->addStock($_POST);

  $store->updateStock($_POST);

  $store->addProductStocks($_POST);

?>
<!--Sidebar-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<div class="sidebar transition overlay-scrollbars">
        <div class="sidebar-content"> 
        	<div id="sidebar">
			
			<!-- Logo -->
			<div class="logo">
					<h2 class="mb-0">E-Guwang Store</h2>
			</div>

            <ul class="side-menu">
                <li>
					<a href="store-dashboard.php?id=<?= $storeDetails['id'] ?>">
						<i class='bx bxs-home icon' ></i>Dashboard
					</a>
				</li>
                <li>
					<a href="store-myproducts.php?id=<?= $storeDetails['id'] ?>" class="active">
						<i class='bx bxs-meh-blank icon'></i> 
						Products
					</a>
				</li>
				<li>
					<a href="store-sales.php" >
						<i class='bx bxs-store icon'></i> 
					 Sales
					</a>
				</li>
        <li>
					<a href="store-orders.php" >
						<i class='bx bxs-store icon'></i> 
					Orders
					</a>
				</li>
        <li class="mt-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#store_logout">
					Logout
				</li>
            </ul>
        </div>

       </div> 
	 </div>
	</div><!-- End Sidebar-->
    <!--Content Start-->
	<div class="content-start transition">
		<div class="container-fluid">
    <div class="row gx-4 gx-lg-5 align-items-center bg-white pt-4 shadow">
      <div class="col-md-6 mb-3 pb-3"><img class="card-img-top mb-5 mb-md-0" src="uploads/<?php echo $product['image'];?>" alt="..." /></div>
        <div class="col-md-6 text-black">
        <h1 class="display-5 fw-bolder"><?= $product['product_name']; ?></h1>

        <div class="fs-5 mb-5">
        <?php if(!empty($details)){?>
          <strong>Price:<span>  <?= "₱".$details['price'].".00"; ?> </span></strong> 
        </div>
        <?php } ?>
        <div class="fs-5 mb-5">
        <?php if(!empty($details)){?>
        <h5>Base Stock: <?= $details['qty'] ?> </h5>
        <?php } ?>
        
        <?php if(!empty($details)){?>
        <h5>Total Stocks: <?= $details['qty']; ?> </h5>
        <?php } ?>
        </div>

        <div class="d-flex">
          <?php if(!empty($details)) {?>
            
        <?php if( $details['status'] !== "ok" ) {
        ?>
       
        <?php }else{ ?>
          <button class="btn btn-primary btn-lg flex-shrink-0" type="button"  data-bs-toggle="modal" data-bs-target="#add">
          <i class="bi bi-plus me-1"></i>
          Add
        </button>
          <?php } ?>
          <?php }else{?>
            <button class="btn btn-primary btn-lg flex-shrink-0" type="button"  data-bs-toggle="modal" data-bs-target="#add-stocks">
        <i class="bi bi-plus me-1"></i>
          Add Stock
        </button>
            <?php } ?>
        <button class="btn btn-primary btn-lg flex-shrink-0" type="button" data-bs-toggle="modal" data-bs-target="#update-stocks">
        <i class="bi bi-arrow-up-circle-fill"></i>
          Update Stocks
        </button>
        </div>
    </div>
</div>
	</div>
  </div>

  <div class="modal fade" id="store_logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog ">
         <div class="modal-content">
         <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <h4>
             Are you sure you want to Logout?
           </h4>
         </div>
         <div class="modal-footer">
         <form action="store-logout.php" method="POST">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-danger text-white">Logout</button>
             </form>
         </div>
         </div>
     </div>
    </div>

    <!-- Add Stocks Modal -->
    <div class="modal fade" id="add-stocks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update <?= $product['product_name']; ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="" method="POST">
            <div class="row px-4">
            <div class="col-md-6">
              <label for="" class="forn-label">Quantity</label>
              <input type="number" name="qty" id="qty" class="form-control form-control-lg" required>
            </div>
            <div class="col-md-6">
              <label for="price" class="forn-label">Price</label>
              <input type="number" name="price" id="price" class="form-control form-control-lg" required>
            </div>
            </div>
            <input type="hidden" name="store_id" value="<?= $storeDetails['id']; ?>">
            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
            <input type="hidden" name="status" value="ok">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="add_stocks" class="btn btn-primary">Add Stocks</button>
          </div>
          </form>
        </div>
      </div>
    </div>

        <!-- Add Stocks Modal -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add <?= $product['product_name']; ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="" method="POST">

            <div class="row px-4">
              <h5>Current Quantity: <?= $details['qty'] //array_sum($inventory_stocks) ?> </h5>
            <div class="col-md-12">

              <label for="" class="forn-label">Quantity</label>
              <input type="number" name="qty" id="qty" class="form-control form-control-lg" required>

              <input type="hidden" name="current_qty" id="current_qty" value="<?=  $details['qty']//array_sum($inventory_stocks) ?>">
              <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

            </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-primary">Add</button>
          </div>

          </form>
        </div>
      </div>
    </div>

        <!-- Update Stocks Modal -->
        <div class="modal fade" id="update-stocks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Stocks for <?= $product['product_name']; ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="" method="POST">
            <div class="row px-4">
            <div class="col-md-6">
              <label for="" class="forn-label">Quantity</label>
              <input type="number" name="qty" id="qty" class="form-control form-control-lg" value="<?= $details['qty'] ?>" required>
            </div>
            <div class="col-md-6">
              <label for="price" class="forn-label">Price</label>
              <input type="number" name="price" id="price" class="form-control form-control-lg" value="<?= $details['price'] ?>" >
            </div>
            </div>
            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button  type="submit" name="update_stocks" class="btn btn-primary">Update Stocks</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <?php 
    include('footer.php');
    ?>


