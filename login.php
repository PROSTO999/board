<?php
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: catalog.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $errors = [];

    if (empty($login)) $errors[] = "Введите логин";
    if (empty($password)) $errors[] = "Введите пароль";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_login = :login OR email = :email");
        $stmt->execute(['login' => $login, 'email' => $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: catalog.php");
            exit();
        } else {
            $errors[] = "Неверный логин или пароль";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind CSS 3 Login Page With border Style</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-messages {
            background-color: #ffebee;
            border: 1px solid #ffcdd2;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            color: #c62828;
        }

        .error-messages p {
            margin: 5px 0;
        }

        .form-title {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
        }
    </style>

  <body>
    <div class="relative flex flex-col justify-center min-h-screen overflow-hidden">
      <div class="w-full p-6 m-auto bg-white border-t-4 border-purple-600 rounded-md shadow-md border-top lg:max-w-md">
        <h1 class="text-3xl font-semibold text-center text-purple-700">Вход </h1>
        <form class="mt-6" action="login.php" method="POST">
          <div>
            <label for="email" class="block text-sm text-gray-800">Email</label>
            <input type="email"
              class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
              name="login">
          </div>
          <div class="mt-4">
            <div>
              <label for="password" class="block text-sm text-gray-800">Password</label>
              <input type="password"
                class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                name="password">
            </div>
            <a href="#" class="text-xs text-gray-600 hover:underline">Забыли пароль?</a>
            <div class="mt-6">
              <button 
              class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-purple-700 rounded-md hover:bg-purple-600 focus:outline-none focus:bg-purple-600">
                Login
              </button>
            </div>
        </form>
        <p class="mt-8 text-xs font-light text-center text-gray-700">Нет аккаунта? <a href="../index.php"
            class="font-medium text-purple-600 hover:underline">Зарегистрируйтесь</a></p>
      </div>
    </div>

  </body>

</html>