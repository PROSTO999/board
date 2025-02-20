<?php
// Подключение к базе данных
$host = "MySQL-8.0";
$db = "demoexam-bd";
$user = "root";
$pass = "";

require_once 'db.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    
    $username = $_POST['username'];
    $secondname = trim($_POST['secondname']);
    $login = trim($_POST['login']);
    $number = trim($_POST['number']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['password_confirm'];

    // // Валидация
    // if (empty($username)) $errors[] = "Введите имя";
    // if (empty($login)) $errors[] = "Введите логин";
    // if (empty($email)) $errors[] = "Введите email";
    // if (empty($password)) $errors[] = "Введите пароль";
    // if ($password !== $confirm_password) $errors[] = "Пароли не совпадают";
    // if (strlen($password) < 6) $errors[] = "Пароль должен быть не менее 6 символов";

    // Проверка существования пользователя
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_login = :user_login OR email = :email");
    $stmt->execute(['user_login' => $login, 'email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Пользователь с таким логином или email уже существует";
    }

    echo "ok";

   
        
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO users (username, secondName, user_login, password, email, phone_number) 
                                  VALUES (:username, :secondname, :login, :password, :email, :number)");
            
            $stmt->execute([
                'username' => $username,
                'secondname' => $secondname,
                'login' => $login,
                'password' => $hashed_password,                
                'email' => $email,
                'number' => $number
                
            ]);
            
            header("Location: ./login.php");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Ошибка при регистрации: " . $e->getMessage();
        }
    }

?>a