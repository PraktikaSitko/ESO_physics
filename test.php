<?php 
$k=0;
$right=0;
for ($i=0; $i<=$_COOKIE['question'];$i++) {
    if ($_POST[$i] == 1) {$right++;}
    $k++;
}
$k--;
$summ=$right*10/$k;
$summ=round($summ);
$db = new PDO ('mysql:host=localhost;dbname=Project',"root","");
$user_id=$_COOKIE['user'];
$class=$_COOKIE['class'];
$th_topic_id=$_COOKIE['th_topic_id'];
$result = $db->query("SELECT * FROM `statistics_test` WHERE topic_id=$th_topic_id AND user_id=$user_id");
$user = $result->fetchALL(PDO::FETCH_ASSOC);
if(count($user) == 0 ) {
    $db->query("INSERT INTO `statistics_test`(`test`,`topic_id`,`user_id`,`class`) Values ('$summ','$th_topic_id','$user_id','$class')");
}

setcookie('th_topic_id',-1,time()-1);
header("Location: ".$_SERVER['HTTP_REFERER']);