<?php
$user_id=$_COOKIE['user'];
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
$db = new PDO ('mysql:host=localhost;dbname=Project',"root","");
if ($query1=$db->query("SELECT `$pr_id_cl` FROM `stat_pr` WHERE user_id='$user_id'")) {
	$info = $query1->fetchALL(PDO::FETCH_ASSOC);
foreach( $info as $data) {
	$pr_id=$data[$pr_id_cl];
}
} else print_r($db->errorInfo());
if ($query = $db->query("SELECT * FROM `$problems` WHERE pr_id='$pr_id'")) {
	$result = $query->fetchALL(PDO::FETCH_ASSOC);
} else print_r($db->errorInfo());
$a=$_POST['answer'];
foreach ($result as $res){
    $b=$res['answer'];
}
if ($a == $b) {
    $count_pr++;
    $db->query("UPDATE `stat_pr` SET $count=$count_pr WHERE user_id=$user_id");
}
$pr_id++;
$db->query("UPDATE `stat_pr` SET $pr_id_cl=$pr_id WHERE user_id=$user_id");
header("Location: ".$_SERVER['HTTP_REFERER']);