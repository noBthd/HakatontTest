<?php
// Параметры подключения к базе данных
$host = "localhost"; // Хост базы данных
$username = "root"; // Имя пользователя базы данных
$password = "EI(qZG@PGH9qm(U)"; // Пароль пользователя
$database = "registeruser"; // Имя базы данных

// Подключение к базе данных
$mysqli = new mysqli($host, $username,$password,$database);

// Проверка соединения на ошибку
if ($mysqli->connect_error) {
    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
}

// Теперь $mysqli представляет подключение к вашей базе данных.
// Вы можете выполнять запросы SQL с использованием этого объекта.
?>
