<?php
header('Content-Type: application/json');

// Параметры подключения к базе данных
$host = 'v2-comp4-307';           // адрес сервера MySQL
$db   = 'my_web_app_db';       // имя базы данных
$user = 'Alex'; // имя пользователя MySQL
$pass = 'Alex123'; // пароль пользователя MySQL
$charset = 'utf8mb4';

// Формирование DSN строки для PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // режим обработки ошибок
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // режим выборки данных
    PDO::ATTR_EMULATE_PREPARES   => false,                  // отключение эмуляции подготовленных запросов
];

try {
    // Подключаемся к базе данных
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Ошибка подключения: ' . $e->getMessage()]);
    exit;
}

// Выполнение SQL запроса для получения всех пользователей
$stmt = $pdo->query("SELECT id, title, email FROM users");

// Получение всех строк в виде ассоциативного массива
$data = $stmt->fetchAll();

// Отдача данных в формате JSON
echo json_encode($data);
?>
