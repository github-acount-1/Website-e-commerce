<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/notify.class.php';
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

    <title>Light Bootstrap Dashboard by Creative Tim</title>

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
    <div class="sidebar" data-color="purple" data-image="<?php echo getRootPath().'img/sidebar-5.jpg';?>">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <p class="simple-text">
                    <?php echo $_SESSION['user']->getName(); ?>
                </p><br>
            </div>

            <ul class="nav">
                <li>
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
                <li >
                    <a href="coupon.html.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Coupons</p>
                    </a>
                </li>
				<li class="active">
                    <a href="discount.html.php">
                        <i class="pe-7s-map-marker"></i>
                        <p>Dicounts</p>
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
                        <i class="pe-7s-bell"></i>
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

        <div id=""><h3>Discounts Options</h3></div>
		<body>

<!-- Active coupon begin -->

<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Discount Options</h4>

                        </div>
                        <div class="content">
                            <form id = "createDiscount" method="post" action=" ">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Discount code</label>
                                            <input name ="code"  required="" type="text" class="form-control" placeholder="Please enter your own discount code"  id = "code">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Type</label>
                                            <select class="form-control"  id="disType" name="disType" required=""  >

                                                <option>Amount</option>
                                                <option>Percentage</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input required="" name="disAmount" type="number" class="form-control" placeholder="Discount Amount" id = "disAmount">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Choose Item</label>
                                        <select class="form-control"  id="item" name="item" required=""  >
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input required="" name="date"  type="date" class="form-control" placeholder="dd/mm/yy" id = "date">
                                    </div>
                                </div>

                            </div>
                                <button  type="submit" class="btn btn-info btn-fill pull-right" >Create Discount</button>
                                <div class="clearfix"></div>
                                <div style="display:none" id="ajax_msg" class ="alert alert-success">Success!</div>
                             </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Active Discounts</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th >Item</th>
                                <th >Original Price</th>
                                <th >New Price</th>
                                <th >Expiry Date</th>
                                <th>Status</th>
                                <th>Order</th>
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

</div>       

	   </div>

<!-- discount create end-->




</div>

</div>
</div>

</body>

  

    <!--   Core JS Files   -->
    <script src="<?php echo getRootPath().'js/jquery.3.2.1.min.js';?>" type="text/javascript"></script>
    <script src="<?php echo getRootPath().'js/bootstrap.min.js';?>" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo getRootPath().'js/chartist.min.js'?>"></script>
    <script src="<?php echo getRootPath().'js/discount/discount_main.js'?>"></script>


    <!--  Notifications Plugin    -->
    <script src="<?php echo getRootPath().'js/bootstrap-notify.js'?>"></script>

	
	<script>
	$(document).ready(function () {
    $('#tableData').load('<?php echo getRootPath().'php/discount/read_Table.php'?>');   
})
	</script>



	
	
	
</html>
