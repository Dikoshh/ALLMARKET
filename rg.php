<?
    $db = mysqli_connect('localhost', 'root', '', 'registr');

    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    $sql_login_check = "SELECT id FROM users WHERE login='{$login}'";
    $login_result = mysqli_query($db, $sql_login_check);

    $trust = '';
    $out = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($login_result and mysqli_num_rows($login_result) == 0){

            if((mb_strlen($login) < 5)) {
                $trust .= "<br/><span class='warn'>Поле: логин - должно иметь не менее 5-ти символов</span>";
            }
            if((mb_strlen($password) < 8)){
                $trust .= "<br/><span class='warn'>Поле: пароль - должно иметь не менее 8-ми символов</span>";
            }
            if($password_check !== $password){
                $trust .= "<br/><span class='warn'>Пароли не совпадают!</span>";
            }

            if(empty($trust)){
                $SQL = "INSERT INTO users (login, password) VALUES ('{$login}', '{$password}')";
                $result = mysqli_query($db, $SQL);
                if($result){
                    $out = '<br/><span class="warn">Регистрация прошла успешно. Теперь вы можете </span><a id="avt" href="avt.php">Авторизоваться.</a>';
                }else{
                    $out = "<br/><span class='warn'>Регистрация прошла не успешно</span>";
                }
            }
        }else{
            if(mysqli_errno($db)){
                $out = "<br/><span class='warn'>Ошибка выполнения запроса</span>".mysqli_errno($db);
            }else{
                $out = "<br/><span class='warn'>Такой пользователь уже зарегистрирован</span>";
            }
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
        <div id='div_post'>
            <h2><center>Форма регистрации</center></h2>
            <form action="" method="POST">
                <input type="text" class="pole" name="login" placeholder="Введите логин"><br/>
                <input type="password" class="pole" name="password" placeholder="Введите пароль"><br/>
                <input type="password" class="pole" name="password_check" placeholder="Повторите пароль"><br/>
                <button class="btn" type="submit">Регистрация</button>
            </form>
            <?echo $trust; echo $out;?>
        </div>
    </body>
</html>