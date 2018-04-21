
<div class="bg-darker">

  <div class="bg-dark">
        <footer class="no-margin-left no-margin-right no-margin-top">

          <div class="grid condensed padding20">
            <?php
              if(!userIsLoggedIn()){
            ?>

              <div class="row cells3">

              <div class="cell"></div>
              <div class="cell">

                <h3 class="fg-white ">Login to Explore more and purchase items</h3>

              <form style="max-width: 300px" action = "<?php echo getRootPath().'php/authenticate/login.php'; ?>" method="post">
                <div class="cell">

                  <div class="input-control  text full-size" data-role="input">

                      <span class="mif-mail prepend-icon"></span>
                      <input type="text" placeholder="Email" name="email"   id="user_login" >

                  </div>
                  <br/>

                  <div class="input-control  password full-size" data-role="input">

                    <span class="mif-key prepend-icon"></span>
                    <input type="password" placeholder="Password" name="password" id="user_password">

                  </div>

                </div>
              
              <div class="cell">

                  <button class="button primary rounded fg-black no-border margin10 no-margin-top no-margin-bottom">Log in</button>

              </div>
              </form>
              </div>
              </div>
            <?php
              }
              else{
            ?>
                <form  role="form" action="<?php echo getRootPath().'php/authenticate/logout.php'; ?>" method="post">
                    <input type="hidden" name="logout" value="true">
                    <button type="submit" style="border:none;background-color: inherit;color:white;width: inherit">Log out</button>
                </form>
            <?php     
              }
            ?>
            

              <hr class="thin fg-white bg-white"/>

              <?php
                $count = Category::getCategoryCount();
                $cells = ceil($count/4);
              ?>


              <div class="row cells<?php echo $cells; ?> padding20">

                <?php 
                  for($i=0; $i<$count; $i++){
                    if($i%4 == 0){
                      if($i == 0)
                        echo '<div class="cell">';
                      else 
                        if($i%4 == 0)
                      echo '</div><div class="cell">';
                    }
                    echo '<a class="fg-grayLight" href="'.getRootPath().
                    'php/pages/item/category_display.html.php?id='.$category_list[$i]['id'].'">'.$category_list[$i]['category_name'].'</a><br>';
                  }
                  echo "</div>";
                  ?>
              </div>

              
          <div class="cell rows">
              <a class="fg-yellow place-left" href="about.php">About shola</a>
               <?php 
                    if(userIsLoggedIn()){
                ?>
                         <a class="fg-yellow place-right" href="<?php echo getRootPath().'php/pages/forum/main_forum.html.php';?>">Community</a><br>
                <?php
                    }
                ?>
              
         </div>
              <hr class="thin  fg-white bg-yellow"/>

              <div class="row">

                <span class="fg-white">Copy Right &copy <?php echo date("Y") ?> Shola.com </span>

                  <a href="https://www.facebook.com/shola">
                        <span class="mif-facebook place-right fg-yellow margin20 no-margin-top no-margin-bottom"></span>
                  </a>
                  <a href="https://www.twitter.com/shola">
                <span class="mif-twitter place-right fg-yellow margin20 no-margin-top no-margin-bottom"></span>
                  </a>
                  <a href="https://www.googleplus.com/shola">
                <span class="mif-google-plus place-right fg-yellow margin20 no-margin-top no-margin-bottom"></span>
                  </a>

              </div>
            </div>
        </footer>

</div>
</div>


<script>
    function showDialog(id){
        var dialog = $(id).data('dialog');
        dialog.open();
    }

    function closeDialog(id){
        var dialog = $(id).data('dialog')
        dialog.close();

    }

    function showDia(id){

        var dialog = $(id).data('dialog');
        dialog.open();
    //closeDialog(#dialog);
    }

    function closeDia(id){
        var dialog = $(id).data('dialog');
        dialog.close();
    }

    $(function(){
        var form = $(".login-form");

        form.css({
            opacity: 1,
            "-webkit-transform": "scale(1)",
            "transform": "scale(1)",
            "-webkit-transition": ".5s",
            "transition": ".5s"
        });
    });

    $(function(){
        var form = $(".login-form-signup");


        form.css({
            opacity: 1,
            "-webkit-transform": "scale(1)",
            "transform": "scale(1)",
            "-webkit-transition": ".5s",
            "transition": ".5s"
        });
    });

</script>

</body>
</html>