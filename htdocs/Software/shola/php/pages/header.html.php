<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Software/shola/php/classes/category.class.php';
    @session_start();

    $category_list = Category::getCategoryList();
?>
<html>
<head>
    <link href="<?php echo getRootPath().'css/metro.css'; ?>" rel="stylesheet">
    <link href="<?php echo getRootPath().'css/metro-icons.css'; ?>" rel="stylesheet">
    <script src="<?php echo getRootPath().'js/jquery-2.1.3.min.js'; ?>"></script>
    <script src="<?php echo getRootPath().'js/metro.js'; ?>"></script>
    <style>
        #log_out_but{
            border: none;
            background-color: inherit;
        }
    </style>
</head>
<body class="bg-darker">

  <div class="bg-white" >
    <header class="no-margin-left no-margin-right no-margin-top">
        <div class="clear-float margin10 no-margin-top">
            <div class="place-right">
                <form action = "<?php echo getRootPath().'php/pages/search/search.html.php';?>">
                    <div class="input-control text margin20" style="width: 300px">
                        <input type="text" name="search" placeholder="Search item here ...">
                        <button class="button"><span class="mif-search"></span></button>
                        <br>
                        <a href="#" class="place-right padding10 no-padding-right link" >Advanced Search</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="main-menu-wrapper">
            <a class="place-left" href="<?php echo getRootPath(); ?>" title="" style="margin-left:10px">
              <img src="<?php echo getRootPath().'img/logo.png';?>" width=50px height=50px>
              <!--<h1>Shola</h1>-->
            </a>

          <ul class="h-menu">

            <li><a href="<?php echo getRootPath(); ?>">Home</a></li>
            <li>
                <a href="#" class="dropdown-toggle">Catagories</a>
                <ul class="d-menu" data-role="dropdown">
                <?php
                    foreach($category_list as $c){
                        echo '<li><a href="'.getRootPath().'php/pages/item/category_display.html.php?id='.$c['id'].'">'.
                                $c['category_name'].'</a></li>';
                                
                    }
                ?>
                </ul>
            </li>
          <li><a href="auction.php">Auction</a></li>
          <li><a href="#">Contact us</a></li>

          <li class="place-right">
            <a href="#" class="dropdown-toggle"><span class="mif-user"></span></a>
            <ul class="d-menu place-right" data-role="dropdown">
                <?php 
                    if(userIsLoggedIn()){
                ?>
                        <li><a href="<?php echo getRootPath().'php/pages/dashboard/user.html.php'; ?>">Dashboard</a></li>
                        <li>
                            <a>
                                <form  role="form" action="<?php echo getRootPath().'php/authenticate/logout.php'; ?>" method="post">
                                    <input type="hidden" name="logout" value="true">
                                    <button type="submit" style="border:none;background-color: inherit;color:inherit;width: inherit">Log out</button>
                                </form>
                            </a>
                        </li>
                <?php
                    }
                    else{
                ?>
                        <li><a href="#" onclick="showDialog('#dialog')">Login</a></li>
                <?php 
                    }
                ?>


            </ul>
          </li>
                <?php 
                    if(userIsLoggedIn()){
                ?>
                         <li class="place-right">
                            <a href="<?php echo getRootPath().'php/pages/payment/viewcart.html.php'; ?>">
                                <span class="mif-cart"></span></a></li>
                <?php
                    }
                ?>
          </ul>
        </div>
    </header>


</div>


<div data-role="dialog" id="dialog">
    <div class="login-form padding20 block-shadow">
        <form action = "<?php echo getRootPath().'php/authenticate/login.php'; ?>" method="post">
            <h1 class="text-light">Login</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control modern text full-size" data-role="input">
                <span class="label">Email</span>
                <input type="text" name="email" id="user_login" >
                <span class="label">Email</span>

                <span class="placeholder">Enter Email</span>
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control modern password full-size" data-role="input">
                <span class="label">Password</span>
                <input type="password" name="password" id="user_password">
                <span class="label">Password</span>
                <span class="placeholder">Enter password</span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Login</button>
                <button onclick="closeDialog('#dialog')" type="button" class="button link">Cancel</button>
                <button onclick="showDia('#dia')" type="button" class="button link">Sign up</button>
            </div>
        </form>
    </div>
</div>

<div data-role="dialog" id="dia">
    <div class="login-form-signup padding20 block-shadow">
        <form>

            <h1 class="text-light">Sign up</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">Email:</label>
                <input type="text" name="user_login" id="user_login">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="user_password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="user_password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="user_password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="user_password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="user_password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Login</button>
                <button onclick="closeDia('#dia')" type="button" class="button link">Cancel</button>

            </div>
        </form>
    </div>


</div>