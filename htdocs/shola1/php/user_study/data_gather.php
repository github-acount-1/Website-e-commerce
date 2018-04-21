<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
    @session_start();

    /**
     * Hit functiion scores user with category to suggest list of items
     * @oaran - item_id
     * @return - none
     */
    function hit($item_id){
        global $pdo;

        //get user id
        $user_id = $_SESSION['user']->getUserId();
        //check to see if user is already associated with items catefory
        $sql = "SELECT * FROM user_data where user_id=:u AND category=:c";
        $stm = $pdo->prepare($sql);
        $stm->execute(array(":u"=>$user_id, ":c"=>Category::getItemsCategory($item_id)));

        //fetch query results
        $result = $stm->fetch();

        //if user is not created yet
        if(empty($result)){
            //insert user into user_data table and associate it with a category
            $sql = "INSERT INTO user_data SET user_id=:u, category=:c, score=7, updated=NOW()";
            $stm = $pdo->prepare($sql);
            $stm->execute(array(":u"=>$user_id, ":c"=>Category::getItemsCategory($item_id)));
        }

        else{
            //Calculate the time gap since last database update
            $time_gap = abs(time() - strtotime($result['updated']));
            //Normalize time to adjust by days
            $scor_dec = $time_gap*0.1/84000000;
            //calculate updated score for category
            $score = $result['score'] - $scor_dec + 0.2;
            if($score > 10)
                $score = 10;
            //Write changes to database;
            $sql = "UPDATE user_data SET updated=NOW(), score=".$score." WHERE user_id = ".$user_id." AND category = '".Category::getItemsCategory($item_id)."'";
            $stm = $pdo->prepare($sql);
            $stm->execute();
        }
    }

    hit(2);
?>