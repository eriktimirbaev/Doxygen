<?php
/**
 * @file login.php
 * @brief Обработчик авторизации через POST запрос
 * @details Проверяет логин и пароль пользователя в БД MySQL
 */

// Конфигурация подключения к базе данных
$servername = "localhost";  ///< Сервер базы данных
$username = "root";         ///< Имя пользователя MySQL
$password = "";             ///< Пароль пользователя MySQL
$bdname = "UfaBD";          ///< Имя базы данных

/**
 * @brief Устанавливает соединение с MySQL
 * @return mysqli|void Возвращает объект соединения или завершает скрипт
 */
$conn = mysqli_connect($servername, $username, $password, $bdname);
if (!$conn){
    die("Connection failed". mysqli_connect_error());
}

/**
 * @brief Получает данные из POST запроса
 * @note Обрабатывает только POST метод
 */
$login = $_POST['login'];    ///< Логин из формы
$pass = $_POST['password'];  ///< Пароль из формы

/**
 * @brief SELECT запрос для проверки пользователя
 * @details Ищет пользователя с указанным логином и паролем
 * @warning Уязвим к SQL-инъекциям
 */
$sql = "SELECT * FROM `register` WHERE login = '$login' AND pass = '$pass'";

/**
 * @brief Выполняет SQL запрос
 */
$result = $conn->query($sql);

/**
 * @brief Обрабатывает результат SELECT запроса
 * @details При успехе загружает главную страницу
 */
if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        $content = file_get_contents('index.html');
        echo $content;
    }
} else{
    echo "Неправильно введён логин или пароль!";
}
?>