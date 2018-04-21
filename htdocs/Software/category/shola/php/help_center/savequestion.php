<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
	// if(!userIsLoggedIn()){
	// 	header('Location: '.getRootPath());
	// 	exit();
	// }
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
	include 'Database.php';

	$id = $_GET['id'];

	if( isset($_POST['question_submit']) ) {

		$question = $_POST['question'];
		$answer = $_POST['answer'];
		$keywords = isset($_POST['keywords']) ? $_POST['keywords'] : [];
		$count = $_POST['question_count'];
		// check if fields are not null
		if( !is_null($question) && !is_null($answer) && !is_null($keywords) && !is_null($count) ) {
			// check if fields are empty
			if( !empty($question) && !empty($answer) && !empty($keywords) && !empty($count) ) {

				$database = new Database();

				for ($i=0; $i < $count; $i++) { 
					$question = $question[$i]; 
					$answer = $answer[$i]; 
					$keywords = $keywords[$i];

					$sql = "INSERT INTO questions (question, answer, keywords, prod_id) VALUES(?, ?, ?, ?)";
					$params = [$question, $answer, serialize($keywords), $id];

					$result[] = $database->insert($sql, $params);

				}

				echo "Operation Successful";
				
				print_r($result);

			} else {
				$error_msg = 'Please fill out all the fields';
			}
		} else {
			$error_msg = 'Please fill out all the fields';
		}

	}



?>
<html>
<body>


<div class="  bg-white">


 

<?php if(isset($error_msg)): ?>
		<p class="" style="color:red"><?= $error_msg; ?></p>
	<?php endif; ?>
<div class="grid padding20">
<div class="row cells">
  <button class="button rounded primary"  type="button" onclick="addQuestion()"   >Ask question</button>
</div>


  <form id="question_form" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id;?>" method="post">

    	<textarea id="question1" name="question[]" rows="6" cols="50" placeholder="Enter question"></textarea>

      <textarea id="answer1" name="answer[]" rows="6"  cols="50" placeholder="Enter Answer"></textarea>

      <select name="keywords[0][]" id="select1" style display="none" multiple></select>
            <br>
			<button  class="button rounded primary" type="button" onclick="generateKeys('question1', 'select1', 'button1')" id="button1">Generate Keywords</button>
      <br>
        <input type="submit" name="question_submit[]" value="Submit">
        <input type="hidden" id="question_count" name="question_count" value="1">
	</form>


</div>


<script >
	$add_button = document.querySelector('#add_question');
	$add_button.addEventListener('click', function(e) {
			var prev_count = parseInt(document.querySelector('#question_count').value);
			document.querySelector('#question_count').value = prev_count + 1; // increment the counter
</script>


	
	<script>
		function counter(){
			if(typeof(counter.count) == "undefined")
				counter.count = 1;
			return ++counter.count;
		}
		function addQuestion(){
			var create_count = counter();
			var que_form = document.getElementById("question_form");
			var div_form = document.createElement("div");
			div_form.id = "que_tab_" + create_count;

			var inp1 = document.createElement("textarea");
			inp1.id="question" + create_count; inp1.name="question[]"; inp1.rows="5"; inp1.cols="20"; inp1.placeholder="Enter Question";

			var inp2 = document.createElement("textarea");
			inp2.id="question" + create_count; inp2.name="answer[]"; inp2.rows="5"; inp2.cols="20"; inp2.placeholder="Enter Answer";

			var sel = document.createElement("select");
			sel.id="select"+create_count; sel.name="keywords[0][]"; sel.style="display:none"; sel.multiple="multiple";

			var but = document.createElement("button");
			but.type = "button"; but.onclick = function (){generateKeys("question"+create_count,"select"+create_count,"button"+create_count)};
			but.textContent = "Generate Keys"; but.id="button"+create_count;

			div_form.appendChild(inp1); div_form.appendChild(inp2); div_form.appendChild(sel);div_form.appendChild(but);

			que_form.appendChild(div_form);

			console.log(create_count);
		}
		function generateKeys(question, select, button){
			var NON_KEYS = ["what", "is", "of", "which", "how", "where", "this", "the", "it", "do", "did", "does", "have", "has", "had"];
			var text = document.getElementById("" + question).value;
			var words = text.split(' ');
			var keys = [];
			for(var i=0; i<words.length; i++)
				if(!NON_KEYS.includes(words[i].toLowerCase()))
					keys.push(words[i].toLowerCase());

			var select = document.getElementById(select);
			select.style.display = "block";
				
			for(var i=0; i<keys.length; i++){
				var opt = keys[i];
				var el = document.createElement("option");
				el.textContent = opt;
				el.value = opt;
				select.appendChild(el);
			}
			document.getElementById(button).style.display = "none";
		}
	</script>
</div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>