<!DOCTYPE html>
<html>
<head>
<title>Events: submit</title>
<script src='jquery-1.11.1.min.js'></script>
</head>
<body>
<form id='form'>
First name: <input id='fname' type='text' name='fname'><br>
Last name: <input id='lname' type='text' name='lname'><br>
<input type='submit'>
</form>
<script>
$('#form').submit(function()
{
if ($('#fname').val() == '' ||
$('#lname').val() == '')
{
alert('Please enter both names')
return false
}
})
</script>
</body>
</html>