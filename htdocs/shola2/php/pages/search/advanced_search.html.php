<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
?>
			<link rel="stylesheet" href="<?php echo getRootPath().'css/bootstrap.css';?>" >
       
	        <script src="<?php echo getRootPath().'js/jquery-2.1.3.min.js';?>"></script>
	        <script src="<?php echo getRootPath().'js/bootstrap.min.js';?>" ></script> 
 <?php 
 	global $result;

// fuction used for data base connection dataBase connection 
 function dataBaseConnection($query){
 	global $con;
    if (!empty($query)){
    global $result;
    $result= mysqli_query($con,$query);
	$count=mysqli_num_rows($result);

	}

 return $count;
 }


// function used to get the image from the img folder

function getImageUrl($itemId){
	global $con;
    
     
	$quer="SELECT image_url FROM item_image WHERE item_id='".$itemId."'";
    if (!empty($quer)){
	$coun = mysqli_query($con,$quer);
	 
	$id=mysqli_num_rows($coun);
	
	
	while($row=mysqli_fetch_array($coun)){
	    		$url=$row['image_url'];
	    	}

	return $url;

}
}


// ShowTheRes function used to display the searched item bay using database resualt

function showTheRes($result){
	global $result;
	$num=0;
	$data="";
	while($row=mysqli_fetch_array($result))
		{
				$itemId = $row['item_id'];
                $itemName = $row['item_name'];
                $cat_id = Category::getItemIdCat($itemId);

        //    $url=getImageUrl($itemId);			/* GET image USING URL*/
				$url = "";        	

	        $data=$data.'<h4><a href="'.getRootPath().'php/pages/item/item_info.html.php?id='.$itemId.'&cid='.$cat_id.'">'.$itemName.'</h4><div class="cell padding5">
     				 <img src="'.itemClass::getItemImage($row['item_id']).'" width="100px" height="100px">
       				</a><span class="place-right"></span>
    					</div>';
    					$num++;
		}


   return $data;
		  
   }
//checkPric is used to comp  maxPrice and minPrice (inserted by the user) whith the price on the dataBase



function checkPrice($result){
	$maxP=floatval($_GET['maxPrice']);    
    $minP =floatval( $_GET['minPrice']);
    $data="";
    while($row=mysqli_fetch_array($result)){

	 if ( $maxP>$row['price'] and  $row['price'] >$minP )
	   {
	   	$itemId = $row['item_id'];
//	   	$url=getImageUrl($itemId);				/**urllll*/
	   	$url="";
	   $data .='<h4><a href="'.getRootPath().'php/pages/item/item_info.html.php?id='.$row['item_id'].'">'.$row['item_name'].'</a></h4><div class="cell padding5">
     				 <img src="'.$url.'" width="50px" height="50px">
       				<span class="place-right"></span>
    					</div>';
	     } 

	    }
	return $data;  
   }



function search(){

                    
                    global $result;
                    $data="";
                    $dataa="";
                    $query ="";
                    $maxP=0.0	;
                    $minP=0.0;
                    $imageID="";
                    
                    $i =0;

               
               // the following if condition chack the in put of the user and prep the query 
               
               if( !empty($_GET['search'])   or !empty($_GET['category']) or  !empty($_GET['colors']) or !empty($_GET['model']) ){
               
               
               	$str=$_GET['search'];
               	
                   $query="SELECT item_name,item_id , price FROM items WHERE item_name LIKE '%$str%' ";
               
               // he following if condition chack category field 
               	if(!empty($_GET['category'])){
                        $cata=Category::getCatName($_GET['category']);
               		 $query.= " AND category LIKE '%$cata%'";
               	
               							
                        } 
               // he following if condition chack color field 
               	if(!empty($_GET['colors'])){
                   $colo=$_GET['colors'];
               	$query.= " AND color LIKE '%$colo%'";
               	//$queryCondition .= "title LIKE '%" . $v . "%' OR description LIKE '%" . $v . "%'";
               							
                        }
               	
               // he following if condition chack model field 
               	if(!empty($_GET['model'])){
                   $mod=$_GET['model'];
               	$query.= " AND model LIKE '%$mod%'";
               	//$queryCondition .= "title LIKE '%" . $v . "%' OR description LIKE '%" . $v . "%'";
               							
                          }
               
                        }
               
               
               
               	if(!empty($_GET['maxPrice']) and !empty($_GET['minPrice'])  )
               	{
               
                      	
               		 if (!empty($query))
               			 {
               			
               			       $count = dataBaseConnection($query);
               			
               			    			if($count>0)
               			    			 {
               			    			   
               			    			        $data = checkPrice($result);
               			    			    
               			    			  }
               			 
               				 			else
               				 			   {
               				 			       $data = "<h4>invalid input</h4>";
               				 			   }
               			
               			  } 
                    }
               
                	elseif ($query!="") 
                	{
                	
                			     $count = dataBaseConnection($query);
               				 if($count>0){
               			     $data = showTheRes($result);
               				   	   
               					  }
                   }
               	
               return $data;

}


$data = search();


?> 
<body> 
	<form 	action="<?php echo getRootPath().'php/pages/search/advanced_search.html.php';?>" method="GET" role="form">
		<div class="container-fluid bg-white ">	
			<div class="">
				<section>
					<div  class="">
						<div class="row">

							<div class="col-md-4">

							</div>	


							<!-- enables users to access itemss form footer-->


							<div class="col-md-4">
								<div class="heading">
									<h1>Advanced Search</h1>
								</div>
									<div class="form-group"><label ><input  class="form-control input-lg"  type="text" name="search" placeholder="ietm Name"></label>
									</div>
								<div class="Heading">
									<h4>Color</h4>
								</div> 

								<div class="form-group"><label ><input  class="form-control input-lg"  type="text" name="colors" placeholder="color"></label>
								</div>



								<div class="Heading">

									<h4>Category</h4>
								</div> 

								<div class="form-group">
									<div class="col-md-8">
								<select class="form-control " id="select_cat" name="category" required>
									<?php
						                foreach($category_list as $c)
						                    echo '<option value="'.$c['id'].'">'.$c['category_name']."</option>";
						            ?>
								</select>
							</div>
								</div>
								<br>
								<div class="Heading">
									<h4>Model</h4>
								</div> 


								<div class="form-group"><label ><input  class="form-control input-lg"  type="text" name="model" placeholder="Model"></label>

								</div>

								<div class="Heading">
									<h4>Price</h4>
								</div> 

								<div class="form-group">
									<label for="inputxs"><input class="form-control input-xs" id="inputxs" type="number"  name="maxPrice" placeholder="$maxPrice"  step="0.0001"></label>

								</div>


								<div class="form-group">
									<label for="inputxs"><input class="form-control input-xs" id="minPrice" type="number" placeholder="$minPrice" name="minPrice" step="0.0001"></label>

								</div>



								<button type="submit" class="btn btn-info btn-fill">Submit</button>
                                    <div class="clearfix"></div>
							</div>



							
						</form>      


						<div class="col-md-4">
							<?php echo $data ?>
							<?php //echo $dataa ?>
						</div>
						</div>
					</div>

				</section>	
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>
