<?php
    
         $mysql=new mysqli();
              $mysql->connect("localhost","root","hogwarts123") ;
              
              
            
               
              if(!$mysql)
              {
                  echo "unable to connect";
              }
              
              
              else 
                  {
                  

          
              $db="shola";
          
         $result= $mysql->select_db($db) or die("could not found your items");
        
         
     
      $product_id=$_GET['id'];
     
  
 $sql="select category from items where item_id=$product_id  ";
     // their must be a column in the items table that hold related items id 
     //  every related items should have the same related id
   
   
        $category;
        
      
        $ret= mysqli_query($mysql,$sql);
        
        if($ret)
        {
            
        }
 else {
     echo "sorry the request could not proccess <br/>";
 }
        
           
        
        
        if(mysqli_num_rows($ret))
        {
            
         
             echo "<br/>";
       while($row2= mysqli_fetch_assoc($ret)  ) 
      {
           
          echo "<br/>";
       
      echo  "<br/>";
      
      $category=$row2['category'];
           
          
      }
        
   }
               
               else 
                   {
                   echo "sorry the request could not proccess ";
}    
       

    
     $sql2= "select * from items where (catagory=$category and id !=$product_id) order by release_date Limit  ;";  
       
    
        
      
        $ret2= $mysql->query($sql2);
        
        if($ret2)
        {
            
        }
 else {
     echo "sorry the request could not proccess  <br/>";
 }
        
        
        echo " related items results:_ <br/> <br/> <br/>";
        if(@mysqli_num_rows($ret2))
        {

       while($row= mysqli_fetch_assoc($ret2)  ) 
      {
       
        "<br/>";
           
          
        ?>    
 <div style="margin-left:100px">
                 <a href="result.php? id=<?php echo $row['id'];?>"target="_self">
                        <?php echo $row["name"];?> 
<br/>
                  <img  hieght="50" width="50" src= "2.jpg " >



        </a>

      </div>
               <br/>
                <br/>
                     
           <?php  
         
        
            
      }
      }
 else {
     echo "sorry no extera result avilable";
 }
               
  $mysql->close();



               }  

              
                  ?>
















