function calculate(){
  var city=document.getElementById('places').value;
  var house_number=document.getElementById('house-number').value;
  var street_number=document.getElementById('street-number').value;
  var post_info = {"house-number":""+house_number,"places":""+city,"street-number":""+street_number};
  $.post("Calculate.php", post_info, function(data) {
      var cost = data;
      document.getElementById('costLabel').value = cost;
  });
}
