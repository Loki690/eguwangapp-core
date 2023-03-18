<?php 

    require_once('class.php');

    $storeDetails = $store->getUserData();

    // $id = $_GET['id'];

    $store_id = $storeDetails['id'];

    $store->addProduct($_POST);

    $store_products = $store->getStoreProduct($store_id);

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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  
  
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
					<a href="store-myproducts.php?id=<?= $storeDetails['id'] ?>" class="active">
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
					<a href="store-orders.php" >
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

  <div class="sidebar-overlay"></div>

  <!--Content Start-->
	<div class="content-start transition">
		<div class="container-fluid">
			<div class="row">
        
      <header class="py-5 mb-3" style="background-color: #F4962A;">
        <div class="px-4 px-lg-5 my-5">
            <div class="text-center text-white col-md-12 col-sm-12">
                <h1 class="display-5 fw-bolder text-white"><?= $storeDetails['storeName']; ?> Products</h1>
                <p class="lead fw-normal text-white mb-0">Manage your products</p>
            </div>
        </div>
      </header>

      <div class="col-md-12 mt-2 d-flex">
        <button class="btn btn-primary btn-lg text-white" type="button"  data-bs-toggle="modal" data-bs-target="#add-product">Add Product <span><i class="bi bi-plus"></i></span></button>
      </div>
      
        <!-- Add Product Modal -->
        <div class="modal fade" id="add-product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product <span><i class="bi bi-plus"></i></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                 <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-6">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control form-control-lg" name="product_name" id="product_name" placeholder="Product Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="product_type" class="form-label" >Product Type </label>
                        <select class="form-select form-select-lg" id="product_type" name="product_type" required>
                            <option value="">Choose...</option>
                            <option value="Food">Dairy</option>
                            <option value="Food">Fruits</option>
                            <option value="Food">Grains</option>
                            <option value="Food">Protien Foods</option>
                            <option value="Food">Beverages</option>
                            <option value="Food">Ready to Eat</option>
                            
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="min_stocks" class="form-label">Min Stocks</label>
                        <input type="number" class="form-control form-control-lg" name="min_stocks" id="min_stocks" placeholder="Minimum Stocks" min="1" value="1">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control form-control-lg" name="image" id="image" required>
                    </div>
                    <div class="form-floating col-md-12 mt-3">
                        <textarea class="form-control" placeholder="Description" id="floatingTextarea" name="description"></textarea>
                       <label for="floatingTextarea"> <div class="px-2">Description</div> </label>
                    </div>
                      <input type="hidden" name="store_id" value="<?= $storeDetails['id']; ?>">
                      </div>
                      </div>
                   
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary btn-lg text-white w-25" name="add-product">Add</button>
                  </div>
                  </form>
                  </div>
              </div>
          </div>
          <!-- Modal -->
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
    </div>

    <div class="row card mt-3 bg-white">

                                    
<div class="table-responsive px-4 mt-4 pt-2">
<table class="table table-border table-striped table-hover">
    <thead>
    <tr>
    <th scope="col">Prodcut Name</th>
        <th scope="col">Product Type</th>
        <th scope="col">Base Stocks</th>
        <th scope="col">Description</th>
        <th scope="col">View</th>
        <th scope="col">Action </th>
    </tr>
    </thead>
    <tbody >
    <?php foreach($store_products as $item) { ?>

        <?php 
        include('config.php');
        
        $inventory_stocks = array();

        $p = $item['id'];

        $details = $store->getProductDetails($p);

        $order = $store->getOrderDetails($item['storeid']);

        $sum = $details['total'];
        $inventory_stocks[] = $sum;
    
        ?>
    <tr class="">
    <td scope="row"><?=  $item['product_name']; ?></td>
    <td scope="row"><?=  $item['product_type']; ?></td>
    <td scope="row"><?=  array_sum($inventory_stocks); ?></td>
    <td scope="row"><?=  $item['description']; ?></td>
    <td scope="row"><a href="store-add-stocks.php?id=<?= $item['id']; ?>" class="btn btn-primary text-white">View</a></td>
    <td scope="row"><a href="delete-product.php?id=<?= $item['id']; ?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php } ?>

    </tbody>

</table>

</div>
</div>
	</div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){
      $('table').DataTable();
    });
  </script>

</body>

</html>