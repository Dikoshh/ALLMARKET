<?php
    $db = mysqli_connect('localhost', 'root', '', 'registr');

    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];

    $SQL = "INSERT INTO `tovar` (name, price, img) VALUES ('{$name}', '{$price}', '{$img}')";
    $result = mysqli_query($db, $SQL);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
    <header>
    <div class="header_burger">
            <div class="hamburger-menu">
                <input id="menu__toggle" type="checkbox" />
                <label class="menu__btn" for="menu__toggle">
                  <span></span>
                </label>
                <ul class="menu__box">
                    <li><a class="menu__item" href="index.html">1</a></li>
                    <li><a class="menu__item" href="index2.html">2</a></li>
                    <li><a class="menu__item" href="index3.html">3</a></li>
                  <li><a class="menu__item" href="index4.html">4</a></li>
                  <li><a class="menu__item" href="index5.html">5</a></li>
                  <li><a class="menu__item" href="index6.html">6</a></li>
                </ul>
              </div>
        </div>
    </header>
    <div class="container">
        <h2>Добавление товара</h2>
        <input placeholder="название товара" type="text" name="name" />
        <input placeholder="цена товара" type="number" name="price" />
        <input placeholder="фото товара" type="file" name="img" />
        <input placeholder="отправить" type="submit" />
        <br/>
        <?
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo $out;
                    }
                ?>
    </div>

</body>
</html>