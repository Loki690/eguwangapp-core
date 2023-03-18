<?php
  include('header.php');
  include('config.php');
  if(!isset($_SESSION)){
    session_start();
  }
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND id";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total =$user->num_rows;
  
    if($total > 0){
  
      $_SESSION['UserLogin'] = $row['username'];
      $_SESSION['Role'] = $row['role'];
      $_SESSION['ID'] = $row['id'];
      $_SESSION['seniorid'] = $row['seniorcitizen_id'];
      // $_SESSION['firstname'] = $row['firstname'];
      // $_SESSION['lastname'] = $row['lastname'];
     
      if(isset($_SESSION['Role']) && $_SESSION['Role'] == "osca"){
        
        echo header("Location: osca-dashboard.php");
  
      }elseif($_SESSION['Role'] && $_SESSION['Role'] == "leader"){
       echo header('Location: leader-dashboard.php');
  
      }elseif($_SESSION['Role'] && $_SESSION['Role'] == "dswd"){
        echo header('Location: dswd-dashboard.php');
  
      }elseif($_SESSION['Role'] && $_SESSION['Role'] == "barangay"){
        echo header('Location: barangay-dashboard.php');
  
      }elseif($_SESSION['Role'] && $_SESSION['Role'] == "admin"){
        echo header('Location: admin-dashboard.php');
      }else{
        header("location: senior-home.php");
      }
    }else{
      $error = "Invalid username or password";  
    }
  }
?>
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
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="color:#E94D1A;">
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
                        <li class="nav navtext" style="color:#E94D1A;">
                                <?php }else{ ?>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="color:#E94D1A;">
                                        <a href="senior-profile.php" class="dropdown-item" style="color:#E94D1A;">Profile</a>
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

<main>
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-7" style="background-image: url('img/senior5.jpg');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      height: 646px;">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-8 mt-5">
            <!-- <h1 class="">
              <strong style="color:#E94D1A;">FOSTERING</strong>  A MORE MEANINGFUL AND PRODUCTIVE <strong style="color: #E94D1A;">AGEING</strong> 
          </h1> -->
          </div>
        </div>
      </div>
     
      </div>
      <div class="col-md-5 mt-5 px-5">
        <form action="" method="POST">
          <div class="text-center">
            <img class="mb-4 align-center" src="img/logo.png" alt="" width="100" height="100">
            <h1 class="h3 mb-3 fw-normal">Please Login</h1>
            <div>
            <?php if(!empty($error)){ ?>
              <span class="text-danger" class="invalid-feedback"><?= $error; ?></span>
              <?php } ?>
            </div>
          </div>
          <div class="ps-3">
            <label for="username" class="form-label">Username</label>
          
            <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="username" required>
          </div>
          <div class="mt-4 ps-3">
            <label for="password" class="form-label" >Password</label>
            <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="password" required>
          </div>
      
          <div class="checkbox mb-3 mt-3 ps-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary text-white" type="submit" name="login">Sign in</button>
          <p class="mt-5 mb-3 text-muted">&copy; 2022-eguwangapp</p>
        </form>
      </div>
    </div>
   

  </div>
  
</main>
<?php include('footer.php') ?>