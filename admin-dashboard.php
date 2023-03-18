<?php
include('header.php');
include('session.php');
include('config.php');

if(isset($_SESSION['Role']) && $_SESSION['Role'] == "admin"){
  $user = $_SESSION['UserLogin'];
  $session_id = $_SESSION['ID'];
}else{
  echo '<script language="javascript">';
  echo 'alert("Access Denied!");';
  echo 'window.location="index.php";';
  echo '</script>';
}

// senior count
$query = "SELECT COUNT(*) AS count FROM users";
$result = $con->query($query);
while($row = mysqli_fetch_assoc($result)){
	$output = $row['count'];
}

// rosters count
$q = "SELECT COUNT(*) AS count FROM stores";
$r = $con->query($q);
while($row = mysqli_fetch_assoc($r)){
	$o = $row['count'];
}

?>
<div class="topbar transition">
	<div class="bars">
		<button type="button" class="btn transition" id="sidebar-toggle">
			<i class="fa fa-bars"></i>
		</button>
	</div>
		<div class="menu">
			<ul>
				  <li class="nav-item dropdown">
          <?php
                  if(!isset($_SESSION)){
                    session_start();
                  }
                ?>
					<?php if(isset($_SESSION['UserLogin'])){?>
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logout">Logout</button>
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
                  <a href="admin-dashboard.php" class="active">
                    <i class='bx bxs-dashboard icon' ></i>Dashboard
                  </a>
				        </li>
                <li>
                  <a href="users.php">
                    <i class='bx bxs-meh-blank icon'></i> 
                    Users
                  </a>
			        	</li>
                <li>
              <a href="admin-store.php">
               <i class='bx bxs-meh-blank icon'></i> 
                  Stores
              </a>
			      </li>
            </ul>
        </div>

       </div> 
	 </div><!-- End Sidebar--> 

   
  <div class="content-start transition">
      <div class="container-fluid dashboard">
        <div class="content-header">
          <h1><i class='bx bxs-dashboard icon' > </i> Admin Dashboard</h1>
          <p></p>
       </div>
      <div class="row">

      <div class="col-md-6 col-lg-5">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="bx bxs-user icon icon-home bg-primary text-light"></i>
								</div>
								<div class="col-8">
									<h4>Users</h4>
									<h3> <?= $output ?> </h3>
								</div>
							</div>
						</div>
					</div>
				</div>

        <div class="col-md-6 col-lg-5">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
								<i class="bx bxs-user icon icon-home bg-success text-light"></i>
								</div>
								<div class="col-8">
									<h4>Stores</h4>
									<h3><?= $o ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
    </div>

  </div> <!-- End Container -->
</div><!-- End Content -->
<!-- Logout Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <form action="logout.php" method="POST">
           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary text-white">Logout</button>
           </form>
      </div>
      </div>
  </div>
</div>

<?php
include('footer.php');
?>
