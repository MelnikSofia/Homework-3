<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма для ввода данных</title>
</head>
<body>
    <?php
    session_start();
    if (!empty($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        unset($_SESSION['errors']); 
    }
    ?>
    <form action="process.php" method="post">

        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="phone">Номер телефона:</label><br>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="way_to_communicate">Предпочитаемый способ связи</label><br>
        <select id="select" name="select">
            <option value="Email">Электронная почта</option>
            <option value="Phone">Телефон</option>
            <option value="Message">Сообщение в мессенджере</option>
        </select><br><br>

        <label>Пол:</label><br>
        <input type="radio" id="radio1" name="radio" value="Women">
        <label for="radio1">Женщина</label><br>
        
        <input type="radio" id="radio2" name="radio" value="Men">
        <label for="radio2">Мужчина</label><br>

        <label for="save_data">Согласие на обработку персональных данных:</label>
        <input type="checkbox" id="checkbox" name="checkbox"><br><br>

        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Отправить">

    </form>

