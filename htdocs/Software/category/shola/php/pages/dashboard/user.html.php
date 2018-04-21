<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/notify.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }
    $usr = $_SESSION['user'];
    $user_id = $_SESSION['user']->getUserId();
    $notif_count = Notification::notifCount($user_id);
?>
<?php
function errors(){
    if(isset($_SESSION["errors"])){
        $errors= ($_SESSION["errors"]);
        
        $_SESSION["errors"]= null;
        return $errors;
    }
}
?>
<?php 
require_once $_SERVER['DOCUMENT_ROOT'] .'/shola/php/includes/db_inc.php';
 if(mysqli_connect_errno()){
     die("Database connection failed: ".
     mysqli_connect_error() .
    " (" . mysqli_connect_errno() . ")" 
 ); 
 }
 ?>
<?php

function form_errors($errors=array()){
    $output = "";
    if(!empty($errors)){
        $output .= "<div class=\"error\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach($errors as $key => $error){
            $output .= "<li>" . htmlentities($error). "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

?>
<?php
$errors = array();
?>

<?php
// $id = $_SESSION['user']->getUserId();
// function find_user_by_id($id){
//     global $con;
    
//  $query= "SELECT * ";
//  $query .= "FROM profile ";
//  $query .= "where user_id = '{$id}' ";
//  $query .= "LIMIT 1";
//  $user_set= mysqli_query($con, $query);
//  if(@$user= mysqli_fetch_assoc($user_set)){
//  return $user; 
//  } else{
//      return null;
//  }
// }

// $user= find_user_by_id($id);

if(isset($_POST["submit_form"])){
    // echo "submitted<br>";
    if(empty($errors)){
        $id = $usr->getUserId();

        $query = "UPDATE customer SET ";
        $pwd_match = true;

        $query .= "user_name = '{$_POST["UserName"]}', ";
        $query .= "first_name = '{$_POST["FirstName"]}', ";
        $query .= "last_name = '{$_POST["LastName"]}', ";
        // if(md5($_POST["OldPassword"]) == $usr->getPassword())
        //     $query .= "password = '{$_POST["NewPassword"]}', ";
        $query .= "phone_number = '{$_POST["PhoneNumber"]}', ";
        $query .= "country = '{$_POST["Country"]}', ";
        $query .= "city = '{$_POST["City"]}' ";
        $query .= "WHERE user_id = {$id} ";
        $result = mysqli_query($con, $query);
        if($result){
            unset($_SESSION['user']);
            $_SESSION['user'] = new User($usr->getEmail(), $usr->getPassword());
            header("Location: ".$_SERVER['PHP_SELF'], true, 303);
        }
        else {
            echo "<script>alert('Profile Update Failed')</script>";
        }
 }
}
?>

 <?php $errors = errors();?>
 <?php echo form_errors($errors);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- <link rel="icon" type="image/png" href="assets/img/favicon.ico"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>User Profile</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo getRootPath().'css/bootstrap.min.css';?>" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo getRootPath().'css/animate.min.css';?>" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo getRootPath().'css/light-bootstrap-dashboard.css?v=1.4.0';?>" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="<?php echo getRootPath().'css/font-awesome.min.css';?>" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo getRootPath().'css/pe-icon-7-stroke.css';?>" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <p class="simple-text">
                    <?php echo $_SESSION['user']->getName(); ?>
                </p><br>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="user.html.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li >
                    <a href="table.html.php">
                        <i class="pe-7s-note2"></i>
                        <p>Item List</p>
                    </a>
                </li>
                <li>
                    <a href="coupon.html.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Coupons</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html.php">
                        <i class="pe-7s-bell"></i>

                        <p>Notifications<?php
                            if($notif_count > 0)
                                echo '('.$notif_count.')';
                        ?></p>  
                    </a>
                </li>
                <li>
                    <a href="resolve_debt.html.php">
                        <i class="pe-7s-user"></i>
                        <p>Resolve Debt</p>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">User</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo getRootPath(); ?>">
                                <p>Home</p>
                            </a>
						<li>
                            <a href="#">
                                <form  role="form" action="<?php echo getRootPath().'php/authenticate/logout.php'; ?>" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <button type="submit" style="border:none;background-color: inherit;">Log out</button>
                                </form>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

         <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="row">
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name = "UserName" class="form-control" value="<?php echo $usr->getUserName(); ?>" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="Email" class="form-control" disabled value="<?php echo $usr->getEmail(); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="FirstName" type="text" class="form-control" value="<?php echo $usr->getFirstName(); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="LastName" type="text" class="form-control" value="<?php echo $usr->getLastName(); ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div  class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name="PhoneNumber" value="<?php echo $usr->getPhone(); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="City" value="<?php echo $usr->getCity(); ?>" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name="Country" value="<?php echo $usr->getCountry(); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" name="OldPassword" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="NewPassword" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> -->

                                    
                                    <input type="hidden" name="submit_form" value="true">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="<?php echo getRootPath().'js/jquery.3.2.1.min.js';?>" type="text/javascript"></script>
    <script src="<?php echo getRootPath().'js/bootstrap.min.js';?>" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo getRootPath().'js/chartist.min.js'?>"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo getRootPath().'js/bootstrap-notify.js'?>"></script>

    <script src="<?php echo getRootPath().'js/light-bootstrap-dashboard.js?v=1.4.0';?>"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="<?php echo getRootPath().'js/demo.js';?>"></script>


</html>
