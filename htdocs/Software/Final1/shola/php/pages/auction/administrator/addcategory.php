<?php
	//session_start();
	//if($_SESSION['isvalid'] != "true"){
	//	header("location:index.php");
	//}
	require('functions.php');
	require('htmls.php');
	  require ('shola/php/includes/db_inc.php');
	headhtml();
	categoryadd();
?>

<body>
	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
				<div id="menu"> <!-- navigation menu -->
					<ul>
						<li><a href="notifications.php"><img src="icons/73.png" alt /><span>Notifications</span></a></li>
                        <li><a href="bids.php" class="dashboard"><img src="icons/2.png" alt /><span class="current">Bids</span></a></li>						
						<li class='showme current'><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
							<ul class='showoff'>
								<li><a href="add_prodven.php">New Product</a></li>
								<li><a href="addcategory.php">New Product Category</a></li>
							</ul>
						</li>						
                        	
					</ul>
				</div> <!-- navigation menu end -->
			</div> 
			<div id="primary_right">
				<div class="inner">
					
					<h1>Welcome Administrator</h1>


						<div class="two_third column">
						  <h5>Add New Product Category</h5>
                           <div id="bodycon">
                          <form method="post" name="prodform" id="prodform" action="" enctype='multipart/form-data'>
                          		<div id="textcon">
                                	Category Name:
                                        <input name="categoryname" type="text" id="categoryname"  class="namewidth" />
                                        <input type="file" name="catimage" id="catimage" class="namewidth" />
                                        <input name="cmdadd" type="submit" id="cmdadd" value="Add New" class="namewidth" />
                                        <input name="cmdcancel" type="submit" id="cmdcancel" value="Cancel"  class="namewidth"/>
                                </div>&nbsp;
                                <div id="inputcon1">
                                		
								<table width="554" border="0">
                      			<tr>
                                    <td width="22">&nbsp;</td>
                                    <td width="129" bgcolor="#CCCCCC"><strong>Category number</strong></td>
                                    <td width="189" bgcolor="#CCCCCC"><strong>Category Name</strong></td>
                                    <td width="100" bgcolor="#CCCCCC"><strong>Category Image</strong></td>
                                    
                                </tr>
								<?php
  								$result = mysql_query("SELECT * FROM product_categories ORDER BY category_id");
								if (!$result) 
								{
									die("Query to show fields from table failed");
								}
								$numberOfRows = @MYSQL_NUMROWS($result);
								if ($numberOfRows == 0)
								{
									echo 'Sorry No Record Found!';
								}
								else if ($numberOfRows > 0) {
									$i=1;
									while ($i<$numberOfRows)		{
									if(($i%2)==0) 
									{
										$bgcolor ='#FFFFFF';
									}
									else
									{
										$bgcolor ='@C0C0C0';
									}
								$this_CategoryID = MYSQL_RESULT($result,$i,"category_id");
								$this_CategoryName = MYSQL_RESULT($result,$i,"category_name");
								$image = MYSQL_RESULT($result,$i,"cat_image");
								
								?>
                     	 </tr>
                     	 <tr>
                     	   		<td>&nbsp;</td>
                        		<td><?php echo $i; ?></td>
                        		<td><?php echo $this_CategoryName; ?></td>
								<td><img src="images/category/<?php echo $image; ?>" width="75" height="75" /></td>
                        		<td><a href="edit.category.php?CategoryID= <?php echo $this_CategoryID; ?>"><img src="" alt="" width="20" height="20" /></a></td>
						
                        <td><a href="delete_category.php?CategoryID=<?php echo $this_CategoryID; ?>"><img src="" alt="delete record" onClick="return confirm('Are you sure you want to delete <?php echo $this_CategoryID; ?>');" width="20" height="20" /></a></td>
                      </tr>
<?php 	
		$i++;		
		}$i;
	}	
?>

</table>
                                 </div>
								</form>

                        </div>
						</div>

						<div class="one_third last column">
						  <h5></h5>
						</div>
						<hr />
						<HR>
						<HR/>
						  <div class="clearboth"></div>
						</div><!-- three_fourth last -->
					</div>
					<div class="clearboth" style="padding-bottom:20px;"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>

