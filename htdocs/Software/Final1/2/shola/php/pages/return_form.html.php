<?php
$title = "Return";
require_once '../classes/return_policy.class.php';

?>

<pre>
<form action = "" method = "post">
	
	Problem of Product:<select name = "problem">
							<option value="" selected ="selected">Choose a problem</option>
							<option value="broken" >broken product</option>
							<option value="malfunction" >product mulfunction </option>
							<option value="expired" >expired product </option>
						</select>
	Choose Service you Want:<select name = "choice">
							<option value="" selected ="selected">Choose a Service</option>
							<option value="replacement" >get item replacement</option>
							<option value="refund" >get money back </option>
							 
						</select>
						<input type = "submit" name ="submit" value="Submit"/>
</pre>';

<?php ReturnPolicy::processReturn();
?>
