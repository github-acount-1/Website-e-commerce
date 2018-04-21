<?php $pageTitle = "Discount"; ?>

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

</head>
<body>


<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Active Discounts</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th >Item</th>
                                <th >Original Price</th>
                                <th >New Price</th>
                                <th >Expiry Date</th>
                                <th>Status</th>
                                <th>Order</th>
                                </thead>
                                <tbody id ="tableData">

                                </tbody>
                            </table>

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