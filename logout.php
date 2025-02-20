<?php
// Начинаем сессию
session_start();

// Очищаем все данные сессии
$_SESSION = array();

// Уничтожаем сессию
session_destroy();

// Удаляем куки сессии если они есть
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Перенаправляем на страницу входа
header("Location: login.php");
exit();
?>
