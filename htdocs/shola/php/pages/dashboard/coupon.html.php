<?php

    $root = $_SERVER['DOCUMENT_ROOT'];
    if($root[strlen($root) - 1] != "/")
        $root .= "/";

    require_once $root.'shola/php/includes/helpers_inc.php';
    require_once $root.'shola/php/classes/user.class.php';
    require_once $root.'shola/php/classes/notify.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }
    $user_id = $_SESSION['user']->getUserId();
    $notif_count = Notification::notifCount($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- <link rel="icon" type="image/png" href="assets/img/favicon.ico"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Coupon</title>

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
    <link href="<?php echo getRootPath().'css/pe-icon-7-stroke.css';?>" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo getRootPath().'img/sidebar-icon.jpg'; ?>">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <p class="simple-text">
                    <?php echo $_SESSION['user']->getName(); ?>
                </p><br>
            </div>

            <ul class="nav">
                <li >
                    <a href="user.html.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="table.html.php">
                        <i class="pe-7s-note2"></i>
                        <p>Item List</p>
                    </a>
                </li>
                <li class="active">
                    <a href="coupon.html.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Coupons</p>
                    </a>
                </li>
                
                 <li>
                    <a href="discount.html.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Discounts</p>
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
                    <a class="navbar-brand" href="#">Dashboard</a>
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
                           <a href="<?php echo getRootPath();?>">
                               <p>Home</p>
                            </a>
                        </li>
                        
                        <li>
                            <a href="#">
                                <form  role="form" action="<?php echo getRootPath().'php/authenticate/logout.php'; ?>" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <button type="submit" style="border:none;background-color: inherit;">Log out</button>
                                </form>
                            </a>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id=""><h3>Coupon Options</h3></div>
		<body>

<!-- Active coupon begin -->
<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Active Coupons</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th >Coupon ID</th>
                                <th >Item Name</th>
                                <th >Item amount</th>
                                <th >Free Item Name</th>
                                <th >Free Item amount</th>
                                <th >Expire Date</th>
                                 <th >Create Date</th>
                                 <th >Add</th>

                                </thead>
                                <tbody id ="tableData">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
	<div class="wrapper">
	
<!-- Active coupon end-->

<!-- my coupon begin -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">My Coupons</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th >Coupon ID</th>
                                <th >User ID</th>
                                <th >Offer ID</th>
                                <th >Order</th>
                                
                                </thead>
                                <tbody id ="mytableData">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


<!-- my coupon end-->

<!-- create coupon begin-->
<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Create Coupon</h4>

                        </div>
                        <div class="content">
                            <form id = "createCoupon" method="post" action=" ">

                               

                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Choose Item</label>
                                        <select class="form-control"  id="item" name="item" required="" placeholder="Choose item" >
                                            <?php
                                            $readQuery ="SELECT * from  items where item_id='1'";
                                            $statement =$pdo->query($readQuery);
                                            $menu="";
                                            while($row=$statement -> fetch (PDO::FETCH_OBJ))
                                                {
                                                   
                                                    $menu.="<option>".$row->item_name."</option>";

                                                }
                                            echo $menu;
                                            $menu ="</select>";
                                            echo $menu;
                                            ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Insert Item amount</label>
                                            <input name ="itemamount"  required="" type="number" class="form-control" placeholder="Insert Item amount"  id = "itemamount">
                                        </div>
                                    </div>

                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Choose Free Item</label>
                                        <select class="form-control"  id="freeitem" name="freeitem" required="" placeholder="Choose Free item" >
                                            <?php
                                            $readQuery ="SELECT * from  items where item_id='1'";
                                            $statement =$pdo ->query($readQuery);
                                            $menu="";
                                            while($row=$statement -> fetch (PDO::FETCH_OBJ))
                                                {
                                                    $menu.="<option>".$row->item_name."</option>";

                                                }
                                            echo $menu;
                                            $menu ="</select>";
                                            echo $menu;
                                            ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Insert Free Item amount</label>
                                            <input name ="freeitemamount"  required="" type="number" class="form-control" placeholder="Insert Free Item amount"  id = "freeitemamount">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input required="" name="date"  type="date" class="form-control" placeholder="dd/mm/yy" id = "date">
                                    </div>
                                </div>


                                <button  type="submit" class="btn btn-info btn-fill pull-right" >Create Coupon</button>
                                <div class="clearfix"></div>
                                <div  style="display:none" id="ajax_msg" class ="alert alert-success">Success!</div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
       
    </div>

</div>


<!-- create coupon end-->
</div>

</div>


</body>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="<?php echo getRootPath().'js/jquery.3.2.1.min.js';?>" type="text/javascript"></script>
    <script src="<?php echo getRootPath().'js/bootstrap.min.js';?>" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo getRootPath().'js/coupon/coupon_main.js'?>"></script>



    <!--  Notifications Plugin    -->
    <script src="<?php echo getRootPath().'js/bootstrap-notify.js'?>"></script>
	<script>
	$(document).ready(function () {
 $('#mytableData').load('<?php echo getRootPath().'php/coupon/readmyCoupons.php'?>');


})
	</script>
	
	<script>
	$(document).ready(function () {
    $('#tableData').load('<?php echo getRootPath().'php/coupon/readTable.php'?>');   
})
	</script>

	
	
	
</html>
