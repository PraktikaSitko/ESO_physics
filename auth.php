    <?php
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    $password = md5($password."gosh98");

    $my_sql = new PDO ('mysql:host=localhost;dbname=Project',"root","");    
    $result = $my_sql->query("SELECT * FROM `user` WHERE `login`='$login' AND `password`='$password'");
    $user = $result->fetchALL(PDO::FETCH_ASSOC);
    if(count($user) == 0 ) {
        echo "Некорректный пароль или имя пользователя";
    exit(); 
    }
    foreach ($user as $user_id){
        $q=$user_id['id'];
    }
    setcookie('user',$q,time()+3600*24,"/");


    header('Location: /Main.php');
?>