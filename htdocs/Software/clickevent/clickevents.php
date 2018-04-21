<html>
<html>
<head>
    <title>test</title>
</head>

<body>

<div id="topfriends">
  <h3>Top 4 Most Friendable Friends</h3>
  <ol id="top4list">
    <li>Brady</li>
    <li>Graham</li>
    <li>Josh</li>
    <li>Sean</li>
  </ol>
</div>

<script type="text/javascript">
    var lis = document.getElementById("top4list").getElementsByTagName('li');

    for (var i=0; i<lis.length; i++) {
        lis[i].addEventListener('click', doStuff, false);
    }

    function doStuff() {
        alert( this.innerHTML );
    }
</script>
</body>
</html>