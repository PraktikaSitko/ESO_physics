<?php

$user_id=$_COOKIE['user'];
$db = new PDO ('mysql:host=localhost;dbname=Project',"root","");
$class=$_COOKIE['class'];
if ($class == 10) {
	$count="count_pr_10";
	$pr_id="pr_id_10";
} else {
	$count="count_pr_11";
	$pr_id="pr_id_11";
}
if ($query = $db->query("SELECT `topic`,`test` FROM `topic` JOIN `statistics_test` ON topic.topic_id=statistics_test.topic_id WHERE user_id=$user_id AND class=$class")) {
	$result = $query->fetchALL(PDO::FETCH_ASSOC);
} else print_r($db->errorInfo());

$query2 = $db->query("SELECT `login` FROM `user` WHERE id=$user_id");
$user= $query2->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Cabinet_style.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Кабинет</title>
</head>
<body>
	<div class="nav">
	<form action="Main.php">
		<button class="btn"><i class="fa fa-home"></i></button>
	</form>
	</div>
	<div class="Wrapper">
		<div class="content">
			<?php foreach ($user as $u): ?>
			<h1 id="User"><?php echo $u['login'] ?></h1>
			<?php endforeach; ?>
			<h1 id="Tasks">оценки за задачи</h1>
			<h1>оценки за тесты</h1>
			<div class="table">
			<table class="table_dark" id="Test" border="1">
				<tr>
					<th>Название теста</th>
					<th>Оценки</th>
				</tr>
				<?php foreach ($result as $data): ?>
				<tr>
					<td><?php echo $data['topic'] ?></td>
					<td><?php echo $data['test'] ?></td>
			  </tr>
			  	<?php endforeach; ?>
			</table>
			</div>
			<table class="table_dark" id="Task" border="1">
				<?php $query0 = $db->query("SELECT `$count`,`$pr_id` FROM stat_pr WHERE user_id=$user_id"); 
				$res=$query0->fetchALL(PDO::FETCH_ASSOC);?>
				<tr>
					<th>Кол-во правильно решённых задач</th>
					<th>Кол-во просмотренных задач</th>
				</tr>
				<?php foreach ($res as $data):?>
				<tr>
					<td><?php echo $data[$count] ?></td>
					<td><?php echo ($data[$pr_id]-1) ?></td>
			  </tr>
			    <?php endforeach; ?>
			</table>
		</div>
		<div class="footer">
			&copy;Савицкий<br/>&copy;Ситко
		</div>
	</div>
</body>
</html>