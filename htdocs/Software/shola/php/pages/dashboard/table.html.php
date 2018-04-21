<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/notify.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'] .'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }
    $user_id = $_SESSION['user']->getUserId();
    $notif_count = Notification::notifCount($user_id);
    if(isset($_POST['itemName'])){
        $obj = new itemClass();
        $obj->postItemMethod();
    }
    $category_list = Category::getCategoryList();
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

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Table List</a>
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
            <h1>Table</h1>
            <button class="btn btn-default btn-fill" onclick="show_form()">Upload Item</button>

            <a href='<?php echo "../return_form.html.php?id="?> ' ><button class="btn btn-default btn-fill">Return Item</button></a>

        <div class="wrapper" style="display: none" id="upload_form">

            <div class="content">
                <div class="container-fluid">

                    <div class="col-md-8">
                        <div class="card">  
                            <div class="content">
                                <form id="cat_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="itemName">Item Name: </label>
                                                <input type="text" name="itemName" id="itemName"class="form-control"  required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="itemImage">image: </label>
                                                <input type="text" name="itemImage" id="itemImage" class="form-control" required/>                                              
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">Description: </label>
                                                <input type="text" name="description" id="description" class="form-control" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="availability">How many days would you like your item be available: </label>
                                                <input type="text" name="availability" id="availability"class="form-control"  required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quantity">Quantity: </label>
                                                <input type="number" name="quantity" id="quantity" class="form-control" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price: </label>
                                                <input type="number" name="price" id="price"class="form-control"  required/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div style="display: inline" id="cat_inp_div">
                                                <span class="form-group" style="display: inline">
                                                    <label>Select Category</label>
                                                    <select style="display: inline" class="form-control" id="select_cat" name="category" required >
                                                        <?php
                                                        foreach($category_list as $c)
                                                            echo '<option value="'.$c['id'].'">'.$c['category_name']."</option>";
                                                        ?>
                                                    </select>

                                                </span>
                                                <span  class="col-md-6">
                                                    <span class="form-group">
                                                        <input class="btn" type="button"  value="other" id="gen_but" onclick="newCat()">
                                                    </span>
                                                </span>
                                            </div>
                                            </div>

                                        </div>
                                         <hr>
                                        <input type="submit" value="Post" name="post" class="btn "/> 
                                        <a href = "<?php echo getRootPath(); ?>"><input type="button" value="cancel" name="cancel" class="btn "/> </a>
                                        <div class="clearfix"></div>
                                    </form>

                                   

                                </div>




                            </div>

                        </div>

                    </div>
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

    <script>
    function newCat(){
        var form_in = document.getElementById("cat_inp_div");
        var inp = document.createElement("input");
        inp.type="text"; inp.id="inp_category"; inp.placeholder="Enter Category";inp.name="new_category";
        form_in.appendChild(inp);
        var sel_form = document.getElementById("select_cat");
        sel_form.style = "display: none";
        var but = document.getElementById("gen_but");
        but.style = "display: none";
        console.log(but);
    }

    function show_form(){
        console.log("JDFLK");
        var x = document.getElementById("upload_form");
        x.style = "display: block";
    }
</script>


</html>
