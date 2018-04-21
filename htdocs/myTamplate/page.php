<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
$title = "Testing yourself title";
$content = "<h1>Hello Belay, are you fine?</h1>";
echo "This is before returnining statement!";
return "<!DOCTYPE html>
<html>
<head>
<title>$title</title>
<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
</head>
<body>
$content
</body>
</html>";