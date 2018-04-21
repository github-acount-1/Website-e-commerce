<html>
	<head>
		<style>
			h1{
				background-color:#3399ff;
				margin:0px;
				padding:20px;
				text-align:center;
				color:white;
				font-family:Broadway;
				font-size:40px;
			}
			
			ul{
				list-style-type:none;
				margin-bottom:2px;
				padding:0px;
				line-height:50px;
				background-color:#3399ff;
			}
			.clearfix::after {
				content: "";
				clear: both;
				display: table;
			}
			.drop{
				float:left;
				background-color:#3399ff;
				display:block;
				position:relative;
				min-width:150px;
			}
			.drop a{
				color:white;
				text-decoration:none;
				padding:20px;
			}
			.dropdown{
				display:none;
				position:absolute;
				background-color:#66a3ff;
			}
			.drop:hover > ul{
				display:block;
			}
			.dropdown:hover > li{
				display:block;
			}
			.drop:hover{
				background-color:#66a3ff;
			}
			ul ul ul{
				background-color:#66a3ff;
				top:0%;
				left:100%;
				min-width:150px;
			}	
			div{
				position:relative;
				left:0;
				top:70px;
				width:100%;
				//border:solid;
			}
			
		</style>
	</head>
	<body>
		<h1> SHOLA ECOMERCE </h1>
		<ul class = "clearfix">

			<li class = "drop"> <a href = "#"> Category </a> 
				<ul class = "dropdown"> 
					<li class = "drop"> <a href = "#"> Fashion </a> 
						<ul class = "dropdown">
							<li class="drop"> <a href = "#"> Men's </a>
								<ul class = "dropdown">
									<li > <a href = "#"> Clothes </a> </li>
												
												<?php
													//creating a connection to a database server
													 $user_name = "root";
													$password = "";
													$database = "category2";
													$server = "127.0.0.1";


														$dbh=mysql_connect ("$server", "$user_name", "$password")
														or die ('I cannot connect to the database because: ' . mysql_error());
														mysql_select_db ("$database");

														//$query = mysql_query("SELECT * FROM itemtable LIMIT 3");
														//while($r=mysql_fetch_array($query)) {
															//extract($r);
															 $disp=3;
															 //if($itemId<=$disp){
																//echo $itemName.'<br>';
															  $disp-=1;
															 //}
															//}

														//Paginating the data

														$rowsPerPage = 1;
														$pageNum = 1;
														if(isset($_GET['page']))
															{
															$pageNum = $_GET['page'];
															}
															$offset = ($pageNum - 1) * $rowsPerPage;

														$disp=0;
														// how many rows we have in database
														$query = "SELECT COUNT(itemName) AS numrows FROM itemtable";
														$result = mysql_query($query) or die('Error, query failed Part 2');
														$row = mysql_fetch_array($result, MYSQL_ASSOC);
														$numrows = $row['numrows'];
														// how many pages we have when using paging?
														$maxPage = ceil($numrows/$rowsPerPage);

														//Creation of link to each page

														// print the link to access each page
														$self = $_SERVER['PHP_SELF'];
														$nav = '';
														for($page = 1; $page <= $maxPage; $page++)
															{
															if ($page == $pageNum)
																{
																$nav .= " $page "; // no need to create a link to current page
																}
															else
																{
																$nav .= " <a href=\"$self?page=$page\">$page</a> ";

																   //$query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
																	//while($r=mysql_fetch_array($query)) {
																		//extract($r);
																		 $disp=3;
															 			//if($itemId<=$disp){
																		//echo $itemName.'<br>';
															  			$disp-=1;
															 				//}
																	//	}

																}
															}


														// Creation of navigation links

													if ($pageNum > 1)
														{
														$page = $pageNum - 1;
														$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
																$query = mysql_query("SELECT * FROM itemtable LIMIT 2,3");
																while($r=mysql_fetch_array($query)) {
																	extract($r);
																	 $disp=3;
														 			//if($itemId<=$disp){
																	echo $itemName.'<br>';
														  			$disp-=1;
														 				//}
																	}


														$first = " <a href=\"$self?page=1\">[First Page]</a> ";
																	$query = mysql_query("SELECT * FROM itemtable LIMIT 0,2");
																while($r=mysql_fetch_array($query)) {
																	extract($r);
																	 $disp=3;
														 			//if($itemId<=1){
																	echo $itemName.'<br>';
														  			$disp-=1;
														 				//}
																	//}
																}	
															}
														else
															{
															$prev = ' '; // we're on page one, don't print previous link
															$first = ' '; // nor the first page link
															}
														if ($pageNum < $maxPage)
															{
															$page = $pageNum + 1;
															$next = " <a href=\"$self?page=$page\">[Next]</a> ";
																	$query = mysql_query("SELECT * FROM itemtable LIMIT 5,2");
																	while($r=mysql_fetch_array($query)) {
																		extract($r);
																		 $disp=3;
															 			//if($itemId<=$disp){
																		echo $itemName.'<br>';
															  			$disp-=1;
															 				//}
																		}

															$last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
																	$query = mysql_query("SELECT * FROM itemtable LIMIT 7,3");
																	while($r=mysql_fetch_array($query)) {
																		extract($r);
																		 $disp=3;
															 			//if($itemId<=$disp){
																		echo $itemName.'<br>';
															  			$disp-=1;
															 				//}
																		}

															}
														else
															{
															$next = ' '; // we're on the last page, don't print next link
															$last = ' '; // nor the last page link
															}


														//Print the navigation links and close the connection to the database:

														// Print the navigation links
														echo "<br />  ".$nav;
														echo $next . "    " . $prev;
														echo $first . "    " . $last;
														// Close the connection to the database
														//mysql_close();







														?>




									<li > <a href = "#"> Shoes</a> </li>
								</ul>
							</li>
							<li class="drop"> <a href = "#"> Women's</a>
                                 <ul class = "dropdown">
									<li > <a href = "#"> Clothes </a> </li>
									<li > <a href = "#"> Shoes</a> </li>
								</ul>
							</li>
							<li class="drop"> <a href = "#"> Kids and Babies</a>
                                 <ul class = "dropdown">
									<li > <a href = "#"> Clothes </a> </li>
									<li > <a href = "#"> Shoes</a> </li>
								</ul>
							</li>
						</ul>
					</li>
					<li class = "drop"> <a href = "#"> Electonics </a> 
						<ul class = "dropdown">
							<li> <a href = "#"> Computer </a> </li>
							<li> <a href = "#"> Phones </a> </li>
							<li> <a href = "#"> Tablates </a> </li>
							<li> <a href = "#"> TVs </a> </li>
							<li> <a href = "#"> Computeraccessory </a> </li>
						</ul>
					</li>
					<li class = "drop"> <a href = "#">Books </a> 
						<ul class = "dropdown">
							<li> <a href = "#"> Fiction</a> </li>
							<li> <a href = "#"> Science </a> </li>
						</ul>
					</li>
					<li class = "drop"> <a href = "#"> Furniture </a> 
						
					</li>
				</ul>
			</li>
			
		</ul>
		<div>
			<img src = "">
		</div>
	</body>
</html>