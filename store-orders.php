<?php 

    require_once('class.php');

    $storeDetails = $store->getUserData();
    
    // print_r($storeDetails);

    // print($storeDetails['id']);

    // $id = $_GET['id'];

    $store_id = $storeDetails['id'];

    $store_orders = $store->getOrder($store_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Guwang App</title>

  	<!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css"/>
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>
  
    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>



</head>
<body>
    <!--Sidebar-->
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
					<a href="store-myproducts.php?id=<?= $storeDetails['id'] ?>" >
						<i class='bx bxl-product-hunt icon'></i> 
						Products
					</a>
				</li>
				<li>
					<a href="store-sales.php" >
						<i class='bx bx-money icon'></i> 
					 Sales
					</a>
				</li>
        <li>
					<a href="store-orders.php" class="active" >
						<i class='bx bx-shopping-bag icon'></i> 
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
   <div class="content-start transition">
		<div class="container-fluid">
			<div class="row">
      <header class="py-5 mb-3" style="background-color: #F4962A;">
        <div class="px-4 px-lg-5 my-5">
            <div class="text-center text-white col-md-12 col-sm-12">
                <h1 class="display-5 fw-bolder text-white"><?= $storeDetails['storeName']; ?> Products</h1>
                <p class="lead fw-normal text-white mb-0">Manage your Orders</p>
            </div>
            
        </div>
      </header>

      </div>

<div class="row card mt-3 bg-white">

                                
<div class="table-responsive px-4 mt-4 pt-2">
<table class="table table-border table-striped table-hover">
<thead>
<tr>
<th scope="col">#</th>
  <th scope="col">Prodcut Name</th>
      <th scope="col">Customer Name</th>
      
      <th scope="col">Quantity</th>
      <th scope="col">To pay</th>
      <th scope="col">Method</th>
      <th scope="col">Delivery Address</th>
      <th scope="col">Payment</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
  </tr>
</thead>
<tbody >
<?php foreach($store_orders as $item) { ?>
    
    <?php 
    $p_id = $item['product_id'];
    $get_product = $store->getProductDetails($p_id);

    ?>
<tr class="">
<td scope="row"><?= $item['id'] ?></td>
<td scope="row"><?= $get_product['product_name']; ?></td>
<td scope="row"><?= $item['customer_name'] ?></td>

<td scope="row"><?= $item['qty'] ?></td>
<td scope="row"><?= $item['total_price'] ?></td>
<td scope="row"><?= $item['delivery_method'] ?></td>
<td scope="row"><?= $item['delivery_address'] ?></td>
<td scope="row"><?= $item['payment'] ?></td>
<td scope="row">
<div class="dropdown">
  <button 
  <?php if($item['store_status']=="Ready"){ ?>

  class="btn btn-outline-success dropdown-toggle" 

  <?php }elseif($item['store_status']=="Preparing"){ ?>

    class="btn btn-outline-warning dropdown-toggle" 

    <?php }elseif($item['store_status']=="Canceled"){ ?>

      class="btn btn-outline-danger dropdown-toggle disabled" 

      <?php }else{ ?>

        class="btn btn-outline-primary dropdown-toggle" 

        <?php } ?>
  type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <?= $item['store_status'];?>
  </button>
  <ul class="dropdown-menu">
    <!-- <li><a class="dropdown-item" href="#">Pending</a></li> -->
    <li><a class="dropdown-item" href="order-prepare.php?id=<?= $item['id']; ?>">Preparing</a></li>
    <li><a class="dropdown-item" href="order-ready.php?id=<?= $item['id']; ?>">Product Ready</a></li>
  </ul>
</div>
</td>
<td scope="row">
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Action
   </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="cancel-order.php?id=<?= $item['id']; ?>">Cancel</a></li>
    <li><a class="dropdown-item" href="delete-order.php?id=<?= $item['id']; ?>">Delete</a></li>
   </ul>
</div>
</td>
</tr>
<?php } ?>

</tbody>

</table>

</div>
</div>

      </div>
    </div>
    <div class="modal fade" id="store_logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
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
  
</body>
	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>
  
    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('table').DataTable();
    });
  </script>
</html>