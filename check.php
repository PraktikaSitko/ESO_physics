<?php
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    $password = md5($password."gosh98");

    $my_sql = new PDO ('mysql:host=localhost;dbname=Project',"root",""); 
    $result = $my_sql->query("SELECT * FROM `user` WHERE `login`='$login' AND `password`='$password'");
    $user = $result->fetchALL(PDO::FETCH_ASSOC);
    if(count($user) != 0 ) {
        echo "пИЗДЕЦ";
       exit(); 
    }
    $my_sql->query("INSERT INTO `user` (`login`,`password`) VALUES ('$login','$password')");
    $result = $my_sql->query("SELECT * FROM `user` WHERE `login`='$login' AND `password`='$password'");
    $user = $result->fetchALL(PDO::FETCH_ASSOC);
    foreach ($user as $data){
        $q=$data['id'];
        
        setcookie('user',$q,time()+3600*24,"/");
    }
    
    $my_sql->query("INSERT INTO `stat_pr` (`user_id`,`pr_id_10`,`pr_id_11`) VALUES ('$q','1','1')");
    

header('Location: /Main.php');
?>