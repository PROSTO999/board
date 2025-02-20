<?php
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Профиль</title>
    <meta charset="UTF-8">

    <style>
        /* Те же базовые стили */
        .profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .logout-btn {
            background-color: white;
        }
        .logout-btn:hover {
            background-color: red;
        }
        
        /* Стили для навигационной панели */
        .header {
            background-color: #333;
            padding: 15px 0;
            margin-bottom: 30px;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .nav-menu {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav-menu a:hover {
            background-color: #555;
        }
        .nav-menu a.active {
            background-color: #444;
        }
    </style>

</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <ul class="nav-menu">
                <li><a href="catalog.php">Каталог</a></li>
                <li><a href="search.php">Поиск</a></li>
                <li><a href="profile.php" class="active">Профиль</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <h2 class="form-title">Профиль пользователя</h2>
        <div class="profile-info">
            <p><strong>Имя:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Фамилия:</strong> <?php echo htmlspecialchars($user['secondName']); ?></p>
            <p><strong>Логин:</strong> <?php echo htmlspecialchars($user['user_login']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Телефон:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        </div>
        <a href="logout.php" class="button logout-btn">Выйти</a>
    </div>
</body>
</html>
