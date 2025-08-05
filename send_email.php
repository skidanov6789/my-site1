<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $name = strip_tags(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $attendance = $_POST['attendance'] === 'yes' ? 'Присутствует' : 'Не присутствует';
    $message = strip_tags(trim($_POST['message']));
    
    // Проверка данных
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Пожалуйста, заполните все обязательные поля корректно";
        exit;
    }
    
    // Настройки почты
    $to = 'danil.skidanov1337@mail.ru'; 
    $subject = 'Ответ на приглашение: ' . $name;
    
    // Формирование содержимого письма
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Присутствие: $attendance\n\n";
    $email_content .= "Сообщение:\n$message\n";
    
    // Заголовки письма
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Отправка письма
    if (mail($to, $subject, $email_content, $headers)) {
        echo 'success';
    } else {
        echo 'Ошибка при отправке письма';
    }
} else {
    echo 'Некорректный запрос';
}
?>
