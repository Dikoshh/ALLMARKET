<?
    $db = mysqli_connect('localhost', 'root', '', 'registr');

    $login = $_POST['login'];
    $password = $_POST['password'];
    $login_Seller = 'seller';
    $password_Seller = 'seller';

    $sql_user_check = "SELECT * FROM users WHERE login='{$login}'";
    $result = mysqli_query($db, $sql_user_check);

    $out = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($login and $password){
            while($row = mysqli_fetch_assoc($result)){
                $id_u = $row['id'];
                $login_u = $row['login'];
                $password_u = $row['password'];
            }
            if($login == $login_Seller and $password == $password_Seller){
                $_SESSION['admin'] = 'admin';
            }
            elseif($login_u == $login and $password_u == $password){
                $_SESSION['user'] = $login_u;
            }else{
                $out = '<span class="warn">Вы ввели неправильные данные!</span>';
            }
        }else{
            $out = '<span class="warn">Вы не заполнили поля!</span>';
        }
    }


?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css/style.css"/>
    </head>

    <body>
            <?
                if($_SESSION['admin']){
                    require 'admin.php';
                }
                elseif($_SESSION['user']){
                    require 'record.php';
                }else{
                    echo<<<HTML
                        <div id='div_post'>
                            <h2><center>Форма авторизации</center></h2>
                            <form action="" method="POST">
                                <input type="text" class="pole" name="login" placeholder="Введите логин"><br/>
                                <input type="password" class="pole" name="password" placeholder="Введите пароль"><br/>
                                <button class="btn" type="submit">Авторизация</button>
                            </form>
HTML;
                            echo $out;
                        echo'</div>';
                }
            ?>

    </body>
</html>