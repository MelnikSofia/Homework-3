<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма для ввода данных</title>
</head>
<body>
    <form action="" method="post">

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

<?php
function validateName($name) {
    return !empty($name) ? true : 'Имя обязательно для заполнения!';
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false ? true : 'Введите корректный Email!';
}

function validatePhone($phone) {
    return is_numeric($phone) ? true : 'Номер телефона должен быть числом!';
}

function validateWayToCommunicate($way) {
    return !empty($way) ? true : 'Выберите способ связи!';
}

function validateGender($gender) {
    return !empty($gender) ? true : 'Выберите пол!';
}

function validatePassword($password) {
    return !empty($password) ? true : 'Пароль обязателен для заполнения!';
}

function validateFormData($data) {
    $errors = [];
    
    $nameError = validateName($data['name']);
    if ($nameError !== true) $errors[] = $nameError;

    $emailError = validateEmail($data['email']);
    if ($emailError !== true) $errors[] = $emailError;

    $phoneError = validatePhone($data['phone']);
    if ($phoneError !== true) $errors[] = $phoneError;

    $wayError = validateWayToCommunicate($data['way_to_communicate']);
    if ($wayError !== true) $errors[] = $wayError;

    $genderError = validateGender($data['gender']);
    if ($genderError !== true) $errors[] = $genderError;
    
    $passwordError = validatePassword($data['password']);
    if ($passwordError !== true) $errors[] = $passwordError;

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $errors = [];
    $data_form = 
    [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'phone' => trim($_POST['phone']),
        'gender' => $_POST['radio'] ?? null,
        'way_to_communicate' => $_POST['select'] ?? null,
        'save_data' => isset($_POST['checkbox']),
        'password' => trim($_POST['password']),
    ];

    $errors = validateFormData($data_form);

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        $data_form['time'] = date('Y-m-d H:i:s');
        $Datalog = json_encode($data_form, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $file = 'Form.json';

        if (file_put_contents($file, $Datalog) !== false) {
            echo '<p style="color: green;">Данные успешно сохранены в ' . $file . '</p>';
        } else {
            echo '<p style="color: red;">Ошибка при сохранении данных.</p>';
        }
    }
}
?>
</body>
</html>
