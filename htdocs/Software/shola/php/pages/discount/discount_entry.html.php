<?php $pageTitle = "Discount";
require_once '../../../php/includes/db_inc.php';
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Discount System</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../../css/app.css" rel="stylesheet" />

</head>
<body>


<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Discount Options</h4>

                        </div>
                        <div class="content">
                            <form id = "createDiscount" method="post" action=" ">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Discount code</label>
                                            <input name ="code"  required="" type="text" class="form-control" placeholder="Please enter your own discount code"  id = "code">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Type</label>
                                            <select class="form-control"  id="disType" name="disType" required=""  >

                                                <option>Amount</option>
                                                <option>Percentage</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input required="" name="disAmount" type="text" class="form-control" placeholder="Discount Amount" id = "disAmount">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Choose Item</label>
                                        <select class="form-control"  id="item" name="item" required=""  >
                                            <?php
                                            $readQuery ="SELECT * from  items where user_id='3'";
                                            $statement =$conn ->query($readQuery);
                                            $menu="";
                                            while($row=$statement -> fetch (PDO::FETCH_OBJ))
                                                {
                                                    $menu.="<option>".$row->item_name."</option>";

                                                }
                                            echo $menu;
                                            $menu ="</select>";
                                            echo $menu;
                                            ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input required="" name="date"  type="date" class="form-control" placeholder="dd/mm/yy" id = "date">
                                    </div>
                                </div>

                            </div>
                                <button  type="submit" class="btn btn-info btn-fill pull-right" >Create Discount</button>
                                <div class="clearfix"></div>
                                <div  id="ajax_msg" class ="alert alert-success">Success!</div>
                             </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</body>

<!--   Core JS Files   -->
<script src="../../../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
<!--   discount JS Files   -->
<script src = "../../../js/discount/main.js"></script>



</html>