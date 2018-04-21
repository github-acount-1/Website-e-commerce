<?php
	require_once 'php/includes/helpers_inc.php';
	require_once 'php/classes/user.class.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Auction</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  

	<link rel="stylesheet" href="css/bootstrap.css" >
	<script src="js/jquery/jquery-1.11.3.js"></script>
	<script src="js/bootstrap.js" ></script> 

</head>

<!-- Notice: there is alot to add to this code it just unfinished work -->
<!-- Notice: there is alot to add to this code it just unfinished work -->
<!-- Notice: there is alot to add to this code it just unfinished work -->
<!-- Notice: there is alot to add to this code it just unfinished work -->
<!-- Notice: there is alot to add to this code it just unfinished work -->
<!-- Notice: there is alot to add to this code it just unfinished work -->


<body >
	<div class="container">	

		<!-- i will come back later for this one-->
		<header class="">

			<!-- background image of shola-->
			<div  class="jumbotron" >

				<h2>image or something goes here</h2>

			</div>


			<div class="page-header">


				<nav class="navbar navbar-default">
					
					<div class="container-fluid" style="background-color:white; font-weight:bold" >
						<div class="navbar-header"  " >
							<a class="navbar-brand" href="#">Shola trinagle logo</a>
						</div>
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">HOME</a></li>
							<li><a href="#">CATAGORY</a></li>
							<li ><a href="#">AUCTION</a></li>
							<li><a href="#">CONTACT</a></li>

						</ul>
						<form role="form">
							<div class="form-group"><label ><input  class="form-control input-lg"  type="text"  placeholder="Search"></label>
							</div>

						</form>
					</div>
				</nav>

			</div>

		</header>

		<!-- the page content goes here-->
		<br><p>Headd</p><br><br>


		<?php 
			if(userIsLoggedIn())
				echo "<h2>User: ".$_SESSION['user']->getName()."<br></h2>";
		?>

		<div  class="">
			<!-- the rows needs to be borederd correctly-->
			<div class="row">

				<div class="col-md-3"  >

					<div>
						<div><img src="gray.gif" ></div> 
						<div class="heading"><h5>the name of the item</h5></div>
					</div>

				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>
				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>
				<div class="col-md-3">
					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>

			</div> 
			<div class="row">

				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>
				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>

			</div> 
			<div class="row">

				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>
				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>
				<div class="col-md-3">

					<div><img src="gray.gif" ></div> 
					<div class="heading"><h5>the name of the item</h5></div>

				</div>

			</div> 
		</div>
		<hr>

		<div class="row">


			<div class="col-md-3">


				<div class="heading"><a href="#"><h5>Free shipping</h5></a></div>

			</div>
			<div class="col-md-3">


				<div class="heading"> <a href="#"><h5>Return of goods</h5></a>


				</div>

			</div>
			<div class="col-md-3">


				<div class="heading"><a href="#"><h5>Clients Discounts</h5></a></div>

			</div>

		</div>

		<hr>					   
		<!-- this is the footer section -->
		<footer>

			<section>

				<div class="">
					<h2>Logger</h2>

					<?php
						if(isset($_GET["loginerror"])){
							echo "<p>Username or Password Incorrect</p>";
						}
					?>

					<?php
						if(!userIsLoggedIn()){
					?>
						<form  role="form" action="<?php echo getRootPath().'php/authenticate/login.php'; ?>" method="post">
							<div class="form-group">
								<label ><input type="email" name="email" class="form-control" placeholder="Enter e-mail"></label>

							</div>
							<div class="form-group">
								<label >
									<input type="password" name="password" class="form-control"  placeholder="password"></label>
							</div>
								<button type="submit" class="btn btn-default"><h4>Log in</h4></button>
						</form>
						<br><br>
						<a href="<?php echo getRootPath().'php/pages/register.html.php'; ?>">Register</a>
					<?php
						}
						else{
					?>
						<form  role="form" action="<?php echo getRootPath().'php/authenticate/logout.php'; ?>" method="post">
							<input type="hidden" name="logout" value="true">
							<button type="submit" class="btn btn-default" ><h4>Log out</h4></button>
						</form>
					<?php
						}
					?>

					</div>

				</section>
				<hr>
				
				<section>

					<!-- enables users to access items form footer-->
					<div  class="">

						<div class="row">

							<div class="col-md-4">
								<p>Electronics</p>
								<p>Electronics</p>
								<p>Electronics</p>
								<p>Electronics</p>
							</div>
							<div class="col-md-4">
								<p>Electronics</p>
								<p>Electronics</p>
								<p>Electronics</p>
								<p>Electronics</p>
							</div>
							<div class="col-md-4">
								<p>Electronics</p>
								<p>Electronics</p>
								<p>Electronics</p>
								<p>Electronics</p>
							</div>
						</div>

					</div>

				</section>
				<hr>
				<section>

					<div class="heading">

						<h5>Shola Ecommerce</h5>

					</div>
					<nav class="navbar navbar-default">

						<div class="container-fluid" style="background-color:white; font-weight:bold" >
							<div class="navbar-header"  " >
								<a class="navbar-brand" href="#">Shola trinagle logo</a>
							</div>
							<ul class="nav navbar-nav">

								<li><a href="#"><img  src="facebook.png"  alt=""></a></li>
								<li><a href="#"><img  src="twitter.png"  alt=""></a></li>
								<li><a href="#"><img  src="instagram.png"  alt=""></a></li>							   

							</ul>

						</div>
						
					</nav>
				</section> 
			</footer>            
		</div>
		
	</div>
</div>

</body>
</html>
