<?php
/**
 * @file register.php
 * @brief Обработчик регистрации пользователя
 * @details Проверяет данные и сохраняет нового пользователя в БД
 */

// Конфигурация подключения к БД
$servername = "localhost";  ///< Сервер MySQL
$username = "root";         ///< Пользователь БД  
$password = "";             ///< Пароль БД
$bdname = "UfaBD";          ///< Имя базы данных

/**
 * @brief Устанавливает соединение с MySQL
 */
$conn = mysqli_connect($servername, $username, $password, $bdname);
if (!$conn){
    die("Connection failed". mysqli_connect_error());
}

/**
 * @brief Получает данные из POST запроса формы регистрации
 */
$username = $_POST['login'];      ///< Логин пользователя
$email = $_POST['email'];         ///< Email пользователя
$number = $_POST['number'];       ///< Номер телефона
$password = $_POST['password'];   ///< Пароль
$confirm = $_POST['confirm'];     ///< Подтверждение пароля

/**
 * @brief Проверяет совпадение паролей
 */
if ($password == $confirm){
    /**
     * @brief INSERT запрос для регистрации пользователя
     * @details Добавляет запись в таблицу register
     * @warning Уязвим к SQL-инъекциям
     */
    $sql = "INSERT INTO `register` (login, email, phone, pass) 
            VALUES ('$username', '$email', '$number', '$password')";
    
    /**
     * @brief Выполняет регистрацию и перенаправляет на страницу входа
     */
    if ($conn -> query($sql) === TRUE){
        $content = file_get_contents('login.html');
        echo $content;
    }
    else {
        echo "Ошибка: ". $conn->error;
    }
}
else {
    /**
     * @brief Выводит ошибку при несовпадении паролей
     */
    echo "Пароли не совпадают!";
}
?>