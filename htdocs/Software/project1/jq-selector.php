<!DOCTYPE html>
<html>
<head>
<title>Second jQuery Example</title>
<script src='jquery-1.11.1.min.js'></script>
</head>
<body>
<blockquote>Powerful and flexible as JavaScript is, with a plethora of
built-in functions, it is still necessary to use additional code for
simple things that cannot be achieved natively or with CSS, such as
animations, event handling, and Ajax.</blockquote>
<div id='advert'>This is an ad</div>
<p>This is my <span class='new'>new</span> website</p>
<script>
$('blockquote').css('background', 'lime')
$('#advert').css('border', '3px dashed red')
$('.new').css('text-decoration', 'underline')
$('blockquote, #advert, .new').css('font-weight', 'bold')
</script>
</body>
</html>