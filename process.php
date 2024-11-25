<?php
session_start(); 

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
        
        $_SESSION['errors'] = $errors;
        header("Location: index.php"); 
        exit;
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