<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';    
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/payment/payment_functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';

    $username = $_SESSION['user']->getUserName(); /****** READ THIS USER NAME FROM $_SESSION VARIABLE HAYELOM HAS PROVIDED *******/
	$userId = $_SESSION['user']->getUserId();/*****READ THIS USER ID FROM $_SESSION VARIABLE HAYELOM HAS PROVIDED ****/
	$stmt = $pdo->prepare("SELECT item_id, item_name, remaining_debt, interest_rate from debt where user_id=:user_id");
    $stmt->execute(["user_id"=>$userId]);
    $debts = $stmt->fetchAll();
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
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Creative Tim
                </a>
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
                    <a href="resolve_debt.html.php';?>">
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
                                <i class="fa fa-dashboard"></i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                                <p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container">
        <div class="row .payment-dialog-row">
			<div class="col-xs-6">
				<table>
                    <tr>
                        <th>Item name</th>
						<th>Remaining Debt</th>
						<th>Interest</th>
					</tr>
					<?php
						for($i=0; $i<count($debts);$i++){
							echo '<tr><td>';
							echo $debts[$i]["item_name"];
							echo '</td><td>';
							echo $debts[$i]["remaining_debt"];
							echo '</td><td>';
							echo $debts[$i]["interest_rate"];
							$item_id = $debts[$i]["item_id"];
							echo '</td><td>
							<a href="'.getRootPath().'php/pages/payment/payment.html.php?payment_type=7&resolve_money='.$sum.'&item_id='.$item_id.'">
							<button class="btn btn-success btn-block btn-lg" type="submit">Resolve</button></td></a>';
							echo '</tr>';
						}
					?>
					<tr>
						
						<?php
							$sum = 0;
							$interest_sum = 0.0;
							$average = 0.0;
							for($i=0; $i<count($debts);$i++){
								$sum = $sum + $debts[$i]["remaining_debt"];
								$interest_sum = $interest_sum + $debts[$i]["interest_rate"];
							}
							if(count($debts = 0))
								$average = 0;
							else
								$average = $interest_sum/(count($debts));
							
						?>
						<td>
						<?php 
							if($sum > 0){
								echo '<td>TOTAL DEBT:</td>';
								echo '<td>';
								echo $sum;
								echo '</td><td>';
								echo $average;
								echo '</td>';
						?>

						<a href="<?php echo getRootPath().'php/pages/payment/payment.html.php?payment_type=7&resolve_money='.$sum.'&item_id=null';?>"><button class="btn btn-success btn-block btn-lg" type="submit">Resolve All</button></a>
						<?php
							}
							else
								echo "<p>No dbt to Resolve</p>";
						?>
					</tr>
				</table>
			</div>
			<div class="col-xs-12">
            </div>
        </div>
    </div>

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


</html>