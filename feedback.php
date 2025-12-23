<?php
/**
 * @file feedback.php
 * @brief Обработчик формы обратной связи
 * @details Сохраняет данные из формы в таблицу feedback базы данных
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
 * @brief Получает данные из POST запроса формы
 */
$username = $_POST['username'];  ///< Имя пользователя
$email = $_POST['email'];        ///< Email пользователя
$number = $_POST['number'];      ///< Номер телефона
$message = $_POST['message'];    ///< Сообщение

/**
 * @brief INSERT запрос для сохранения данных
 * @details Добавляет запись в таблицу feedback
 * @warning Уязвим к SQL-инъекциям
 */
$sql = "INSERT INTO `feedback` (login, email, phone, message) 
        VALUES ('$username', '$email', '$number', '$message')";

/**
 * @brief Выполняет SQL запрос и выводит результат
 */
if ($conn -> query($sql) === TRUE){
    echo "Данные успешно отправлены!";
}
else {
    echo "Ошибка: ". $conn->error;
}
?>