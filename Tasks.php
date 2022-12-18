<?php

$user_id=$_COOKIE['user'];
$db = new PDO ('mysql:host=localhost;dbname=Project',"root","");
$class=$_COOKIE['class'];
if ($class == 10) {
	$count="count_pr_10";
	$pr_id_cl="pr_id_10";
	$problems="problems_10";
} else {
	$count="count_pr_11";
	$pr_id_cl="pr_id_11";
	$problems="problems_11";
}
if ($query1=$db->query("SELECT `$pr_id_cl` FROM `stat_pr` WHERE user_id='$user_id'")) {
	$info = $query1->fetchALL(PDO::FETCH_ASSOC);
foreach( $info as $data) {
	$pr_id=$data[$pr_id_cl];
}
} else print_r($db->errorInfo());

if ($query = $db->query("SELECT * FROM `$problems` WHERE pr_id='$pr_id'")) {
	$result = $query->fetchALL(PDO::FETCH_ASSOC);
} else print_r($db->errorInfo());

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Tasks.css" type="text/css">
	<title>Задачи</title>
</head>
<body>
	<div class="Wrapper">
		<div class="Content">
			<div class="F"></div>
			<form method="post" action="problem.php">
			<?php foreach ($result as $pr_info):
			$topic_id=$pr_info['topic_id'];
			 if ($query_topic=$db->query("SELECT `topic` FROM `topic` WHERE topic_id='$topic_id'")){
				$topic_info=$query_topic->fetchALL(PDO::FETCH_ASSOC);
			 } else print_r($db->errorInfo());
			foreach ($topic_info as $data_topic): ?>
			<h2 id="topic"><?php echo $data_topic['topic']; ?></h2>
			<h1 id="text"><?php echo $pr_info['t_condition'] ?></h1>
			<input type="text" placeholder="Ответ" name="answer">
			<p class="button" id="check" name="check" onmousedown="viewDiv()">Проверить ответ</p>
			<h3 id="Correct">Правильный ответ: <?php echo $pr_info['answer']; ?></h3>
			<button class="button" id="Next" type="submit">К следующей задаче</button>
			<div class="footer">
				&copy;Савицкий<br/>&copy;Ситко
			</div>
			<?php endforeach;
			endforeach;?>
			</form>
		</div>
	</div>
	<script src="Tasks.js"></script>
</body>
</html>