

    <?php

    /* Attempt MySQL server connection. Assuming you are running MySQL

    server with default setting (user 'root' with no password) */

    $link = mysqli_connect("localhost", "root", "", "categorydemo");

     

    // Check connection

    if($link === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());

    }

     

    // Escape user inputs for security

            $itemNames = mysqli_real_escape_string($link, $_REQUEST['itemName']);

            $itemPictures = mysqli_real_escape_string($link, $_REQUEST['itemPicture']);

            $itemDescriptions = mysqli_real_escape_string($link, $_REQUEST['itemDescription']);
            
            $postDates = mysqli_real_escape_string($link, $_REQUEST['postDate']);

            $contractPeriods = mysqli_real_escape_string($link, $_REQUEST['contractPeriod']);

            $quantity = mysqli_real_escape_string($link, $_REQUEST['quantity']);
            $price = mysqli_real_escape_string($link, $_REQUEST['price']);

            $itemType = mysqli_real_escape_string($link, $_REQUEST['itemType']);

            //$userId = mysqli_real_escape_string($link, $_REQUEST['userId']);


     

    // attempt insert query execution

    //$sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";

            $sql="INSERT INTO `itemtable` ( `itemName`, `itemPicture`, `itemDescription`, `postDate`, `contractPeriod`, `quantity`, `price`, `itemType`, `userId`) VALUES
        ('Nike Shoes', 'NK', 'Size 42,high quality,made in vietnam', '2017-11-17', 5, 3, 1324, 'MS', 0)";

    if(mysqli_query($link, $sql)){

        echo "Records added successfully.";

    } else{

        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

    }

     

    // close connection

    mysqli_close($link);

    ?>

