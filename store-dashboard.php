<?php 

    include('header.php');
		include('config.php');

    require_once('class.php');
    
    $storeDetails = $store->getUserData();

    $id = $_GET['id'];

    // $store_detail = $store->storeDetails($id);

		$query = "SELECT COUNT(*) AS count FROM products WHERE storeid = '$id'";
		$result = $con->query($query);
		while($row = mysqli_fetch_assoc($result)){
		$output = $row['count'];

		$product_count = "SELECT COUNT(*) AS count FROM orders WHERE store_id = '$id' AND store_status = ('Pending')";
		$p_result = $con->query($product_count);
		while($row = mysqli_fetch_assoc($p_result)){
			$p_count = $row['count'];
		}
}
?>
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
					<a href="store-dashboard.php" class="active">
						<i class='bx bxs-home icon' ></i>Dashboard
					</a>
				</li>
                <li>
					<a href="store-myproducts.php?id=<?= $storeDetails['id'] ?>">
						<i class='bx bxs-meh-blank icon'></i> 
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
                <h1 class="display-5 fw-bolder text-white"><?= $storeDetails['storeName'] ?> Dashboard</h1>
                <p class="lead fw-normal text-white mb-0"></p>
            </div>
        </div>
      </header>

      <div class="col-md-6 col-lg-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
              <div class="col-12 py-3 text-center">
									<h4>Products</h4>
									<h3><?= $output ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			
        <div class="col-md-6 col-lg-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								
								<div class="col-12 py-3 text-center">
									<h4>Orders</h4>
									<h3><?= $p_count ?></h3>

								</div>
              
							</div>
						</div>
					</div>
				</div>
    </div>
      
		</div>
		<div>
							<iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/4mc3rUoMwwiNTHA4al9nNd?utm_source=generator" width="50%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
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
						

  <?php
  include('footer.php');
  ?>