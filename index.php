<?php
  
  include('config.php');
  if(!isset($_SESSION)){
    session_start();
  }
?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>E-Guwang App</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container ">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
      </a>
    
      <h3><strong class="px-3 header" style="color:#E94D1A;">E-GUWANG</strong> </h3>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
           
            </li>
               <li class="nav navtext">
              
            <?php if(isset($_SESSION['UserLogin'])){?>
                <a href="senior-home.php" class="nav-link" style="color:#E94D1A;">Home</a>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo $_SESSION['UserLogin']; ?>
                        </a>

                        <?php if($_SESSION['Role'] == "leader"){ ?>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="" class="dropdown-item">Profile</a>
                                    <a href="leader-dashboard.php" class="dropdown-item">Dasboard</a>
                                    <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                        <li class="nav navtext">
                        <?php }elseif($_SESSION['Role'] == "osca"){?>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a href="" class="dropdown-item">Profile</a>
                                        <a href="logout.php" class="dropdown-item">Logout</a>
                                    </div>
                        </li>
                        <li class="nav navtext">
                                <?php }else{ ?>
                                  
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a href="senior-profile.php" class="dropdown-item">Profile</a>
                                        <a href="senior-notification.php" class="dropdown-item">Notification</a>
                                        <a href="logout.php" class="dropdown-item">Logout</a>
                                </div>

                                <?php } ?>
                         </li>

                            <?php }else{ ?>
                            <li class="nav-item">
                            <h5><a href="index.php" class="nav-link"  style="color:#E94D1A;">Home</a> </h5>
                            </li>
                            <li class="nav-item">
                                <h5><a href="login.php" class="nav-link"  style="color:#E94D1A;">Login</a></h5>
                            </li>
                            <?php } ?>
            </ul>
        </div>
  </div>
  </nav>

</header>
<br><br><br>
<main>
  <div class="container-fluid pb-4" style="background-image: url('img/elder.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 646px;">
            <br>
            <br><br>
           <div class="container">
            <div class="row">
              <div class="col-md-6">
                <h1 class="text-white animate__pulse">
                  <strong style="color:#E94D1A;">FOSTERING</strong>  A MORE MEANINGFUL AND PRODUCTIVE <strong style="color: #E94D1A;">AGEING</strong> 
              </h1>
              <p class="fw-bolder text-black fst-italic" style="color:#E94D1A;">"Faster, safer, and cashless online financial ditribution for senior citizens."</p>
              </div>
              <div class="col-md-6">
               
              </div>
            </div>
            <br>
            <div class="row mt-5">
              <div class="col-md-6">
                <!-- <h3 class="text-white">
                    Your Problem 
                </h3>
                <h1>
                   <strong class="text-white">Our</strong> <strong style="color: crimson">Solution</strong>
                </h1> -->
                <div class="mt-4">
                    <a href="register.php"><button class="btn btn-primary btn-lg">Register as Senior Citizen <span class="px-2"><i class="bi bi-arrow-right" style="font-size: xl;"></i></span></button></a>
                </div>
            </div>
            </div>
           </div>
            <br><br><br>
        </div>   
        <br><br>
        <div class="container py-5">
            <div class="row text-center text-white">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4">Features</h1>
                    <!-- <p class="lead mb-0">E-Guwang Application has three main features that consists of</p> -->
                
                </div>
            </div>
        </div><!-- End -->
        <div class="container-fluid mt-6">
            <div class="row">

                <div class="col-md-4 bg-white">
                    <div class="row">
                        <div class="col-md-12 card scale-up-bl">
                        <div class="card-body " style="height: 400px;">
                                <div class="card-title text-center display-3">
                                  <h2 style="color:#E94D1A;">
                                    <strong>Online distribution</strong>
                                  </h2>
                                </div>
                                
                                <div class="card-text text-center  mt-5">
                                <div >
                                <h1 style="color:#E94D1A;"><i class='bx bx-money bx-lg'></i></h1>
                                </div>
                                <p class="text-black fs-4 lead fst-italic">
                                Online distribution of financial assistance can provide more convenience and reduce physical interaction for those receiving aid.
                                </p>
                                </div>
                                <br><br>
                            </div>
                            <div class="card-footer bg-white mb-3">
                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-white">
                    <div class="row">
                        <div class="col-md-12 card">
                        <div class="card-body" style="height: 400px;">
                                <div class="card-title text-center">
                                <h2 style="color:#E94D1A;">
                                       <strong>Digital Booklet</strong> 
                                    </h2>
                                </div>
                                <div class="card-text text-center mt-5">
                                <div >
                                <h1 style="color:#E94D1A;"><i class='bx bxs-book-open'></i></i></h1>
                                </div>
                                <p class="text-black fs-4 lead fst-italic">
                                Accurate and efficient tracking of financial assistance for senior citizens, digitally record the assistance that is received.  
                                </p>
                                </div>
                            </div>
                            <div class="card-footer bg-white mb-3">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4 bg-white">
                    <div class="row">
                        <div class="col-md-12 card">
                            <div class="card-body" style="height: 400px;">
                                <div class="card-title text-center">
                                <h2 style="color:#E94D1A;">
                                   <strong>Shop Discount</strong> 
                                  </h3>
                                </div>
                                <div class="card-text text-center mt-5 mb-5">
                                <div >
                                <h1 style="color:#E94D1A;"><i class='bx bxs-store'></i></i></i></h1>
                                </div>
                                <p class="text-black fs-4 lead fst-italic">
                                Shop with ease to E-Guwang-partnered grocery stores and markets with senior citizen discounts.
                                </div>
                            </div>
                            <div class="card-footer bg-white mb-3">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
               
            
        </div>
        <div class="container py-5">
            <div class="row text-center text-white">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4" >Users</h1>
                    <p class="lead mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nostrum corrupti exercitationem tempore quis atque sit animi in, fugiat quo ab illum eos, totam, veniam officiis magni. Similique, dignissimos rem.</p>
                
                </div>
            </div>
        </div><!-- End -->
        <!-- Page Content-->
        <section class="pt-4">
            <div class="container">
            
                <!-- Page Features-->
                <div class="row">
                    <div class="col-lg-6 col-xxl-6 mb-4">
                        <div class="card bg-light border-0 h-100 shadow">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0" >
                                <div class="feature text-white rounded-3 mb-4 mt-2">
                                    <img src="img/osca1.png" alt="" height="150">
                                </div>
                                <h2 class="fs-4 fw-bold" style="color:#E94D1A;">Office for Senior Citizens Affairs (OSCA)</h2>
                                <p class="mb-0">Registering Senior Citizen information on the system</p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-6 mb-4">
                        <div class="card bg-light border-0 h-100 shadow">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0" >
                            <div class="feature text-white rounded-3 mb-4 mt-2">
                                    <img src="img/DSWD-Logo.png" alt="" height="150">
                                </div>
                                <h2 class="fs-4 fw-bold" style="color:#E94D1A;">Department of Social Welfare and Development (DSWD)</h2>
                                <p class="mb-0">Validating senior citizen information. This involves verifying the accuracy of the information provided by seniors, such as their age, income, and residence, to ensure that they meet the criteria for receiving aid.</p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4 mb-3">
                        <div class="card bg-light border-0 h-100 shadow">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature text-white rounded-3 mb-4 mt-2">
                                    <img src="img/Barangay.svg.png" alt="" height="150">
                                </div>
                                <h2 class="fs-4 fw-bold" style="color:#E94D1A;">Barangays</h2>
                                <p class="mb-0">Monitoring seniors' information, identify patterns and trends that may be indicative of changes in their health or behavior.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4 mb-3">
                        <div class="card bg-light border-0 h-100 shadow">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                          
                                <h2 class="fs-4 fw-bold mt-5 pt-5" style="color:#E94D1A;">Cluster Leaders</h2>
                                <p class="mb-0">Facilitating communication and collaboration among the members. Leading the cluster of senior citizens.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4 mb-3">
                        <div class="card bg-light border-0 h-100 shadow">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                               
                            <h2 class="fs-4 fw-bold mt-5 pt-5" style="color:#E94D1A;">Senior Citizens</h2>
                                <p class="mb-0">The E-Guwang Application is a tool that is utilized by senior citizens who are seeking financial assistance from government institutions and wish to take advantage of technology to make the process more efficient and convenient. </p>
                            </div>
                        </div>
                    </div>
             
                </div>
            </div>
        </section>
        
        
     
  </main>
  <div class="container py-5">
            <div class="row text-center text-white">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4">About</h1>
                    <p class="lead mb-0"><strong style="color:#E94D1A;" class="fw-bolber">E-Guwang</strong> aims to solve the issues in the financial assistance distribution of senior citizens. The pandemic made the team realize that the senior citizens are most vulnerable to possible abuse from people who are only concerned is with taking advantage of their situation. Part of the objective of E-Guwang is to protect the benefits and make the lives of our grandparents comfortable, efficient, and worry-free.</p>
                
                </div>
            </div>
        </div>E
  
  <div class="container py-5">
    <div class="row text-center text-white">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4">The Team</h1>
            <p class="lead mb-0">"<span  style="color:#E94D1A;" class="fw-bolber">Our team</span> is dedicated to work together to achieve our common goals and make a positive impact in our community."</p>
           
        </div>
    </div>
</div><!-- End -->


<div class="container">
    <div class="row text-center">

        <!-- Team item -->
        <div class="col-xl-4 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="img/welgen.png" alt="" width="200" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm ">
                <h5 class="mb-0">Welgen Salvani</h5><span class="small text-uppercase text-muted">SYSTEM ANALYST</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-4 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="img/paez.png" alt="" width="200" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Edrian L. Paez</h5><span class="small text-uppercase text-muted">PROGRAMMER</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="bi bi-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-4 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5"><<img src="img/jc.png" alt="" width="200" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">John Cesar T. Suaybaguio</h5><span class="small text-uppercase text-muted">PROGRAMMER</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="https://web.facebook.com/johncesar.suaybaguio/" class="social-link"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/JohnCes51408050" class="social-link"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/joncsr/" class="social-link"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/john-cesar-b59ab71b9" class="social-link"><i class="bi bi-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->

       
    </div>
</div>



  <div class="b-example-divider"></div>

<div class="container-fluid bg-white">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-5 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2" style="font-size: 1rem;">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2" style="font-size: 1rem;">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2" style="font-size: 1rem;">About</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="bi bi-facebook" style="font-size: 1rem;"></i></a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2"><i class="bi bi-linkedin" style="font-size: 1rem;"></i></i></a></li>
      
    </ul>
    <p class="text-center text-muted">&copy; 2022 E-GuwangApp</p>
  </footer>
</div>
  
	<!-- Preloader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<!-- Loader -->
	<div class="loader-overlay"></div>

	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.min.js"></script>
	<script src="assets/modules/jquery/jquery.min.js"></script>
	<script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>

	<!-- Chart Js -->
	<script src="assets/modules/apexcharts/apexcharts.js"></script>
	<script src="assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>
	
 </body>
</html>