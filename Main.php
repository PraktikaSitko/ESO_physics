<?php

	$db = new PDO ('mysql:host=localhost;dbname=Project',"root","");

	$k=0;
	$info = [];
	$tp_info = [];
	$pr_info = [];
	$test_info = [];
	$ans_info = [];
	$th_topic_id = $_COOKIE['th_topic_id'];
	$user_id=$_COOKIE['user'];
	

	if (isset($_COOKIE['class'])) {
		$class=$_COOKIE['class'];
	} else $class=10;
	echo $class;
	if ($query = $db->query("SELECT * FROM `topic` WHERE class_number='$class'")) {
		$info = $query->fetchAll(PDO::FETCH_ASSOC);
	} else {
		print_r($db->errorInfo()); 
	}

	if (isset($_COOKIE['th_topic_id'])) {
		if ($query2 = $db->query("SELECT * FROM `test` WHERE topic_id='$th_topic_id'")) {
			$test_info = $query2->fetchALL(PDO::FETCH_ASSOC);
		}
		if ($query0 = $db->query("SELECT topic,text FROM `topic` INNER JOIN `topic_text` 
        ON topic.topic_id=topic_text.topic_id WHERE topic.topic_id='$th_topic_id'")) {
           $tp_info = $query0->fetchALL(PDO::FETCH_ASSOC);
        } else {
                print_r($db->errorInfo());
            }		
		}
	
	if ($query1 = $db->query("SELECT DISTINCT topic FROM `topic` INNER JOIN `problems` 
	ON topic.topic_id=problems.topic_id WHERE class_number='$class'")) {
		$pr_info = $query1->fetchALL(PDO::FETCH_ASSOC);
	} else {
		print_r($db->errorInfo());
	}

	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css" type="text/css">
	
	<title>Главная</title>
</head>
<body >
	<div class="nav">
	  <a href="Tasks.php" id="Tasks">Задачи</a>
	  <a href="#" id="Theory">Теория</a>
	  <p id="C10">10</p>
	  <p id="C11">11</p>
	  <label class="switch">
			<input type="checkbox" onclick="switchcl()" id="ch_box" >
			<span class="slider round"></span>
		</label>
	  <a id="Cabinet" href="Cabinet.php">Кабинет</a>
	</div>
	<div class="Theory" id="TheoryNav" hidden>
		<?php foreach ($info as $data): ?>
		<a href="Main.php" id="tpc_btn" name="<?php echo $data['topic_id'] ?>" onclick="th_cookie(this.name)"><?php echo $data['topic']; ?></a>
		<hr>
		<?php endforeach; ?>	
	</div>
	<div class="Wrapper">
		<div class="content">
			<?php $k = count($test_info);
			setcookie("question","$k",time()+3600,"/");
			$k=0;
			foreach ($tp_info as $tp_data): ?>
			<h2><?php echo $tp_data['topic'] ?>
			</h2>
			<h1 id="Text"><?php echo $tp_data['text'] ?>
			</h1>
			<div id="Test">
			<form action='test.php' method='POST'>
			<?php foreach ($test_info as $test_data): ?>
				<h3><?php echo $test_data['question']; ?>
				</h3><br>
			<?php	$q_id = $test_data['question_id'];
					$t_query = $db->query("SELECT * FROM `answers` WHERE question_id='$q_id'");
					$ans_info = $t_query->fetchALL(PDO::FETCH_ASSOC);
					foreach ($ans_info as $ans_data): ?>
						<input name="<?php echo $k ?>" type="radio" value="<?php echo $ans_data['rightornot']?>">
						<?php echo $ans_data['answer'] ?>
						<br>
					<?php endforeach;
					$k++; 
			endforeach; ?>
			<input type='submit' name="Submit" value='Отправить'>
			</form>
			</div>
			<button class="button" id="btn" onmousedown="viewDiv()">Тест</button>
			<?php endforeach; ?>
			<div class="F"></div>
			<div class="footer">
				&copy;Савицкий<br/>&copy;Ситко
			</div>
		</div>
	</div>
	<script src="Mai.js"></script>
</body>
</html>