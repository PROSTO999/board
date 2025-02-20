<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <meta charset="UTF-8">
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
</head>
<body>
    <form method="POST" action="./php/reg.php">
        <h2 class="form-title">Регистрация</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div>
            <label>Имя:</label>
            <input type="text" name="username" >
        </div>
        <div>
            <label>Фамилия:</label>
            <input type="text" name="secondname" value="<?php echo isset($secondname) ? htmlspecialchars($secondname) : ''; ?>">
        </div>
        <div>
            <label>Логин:</label>
            <input type="text" name="login" value="<?php echo isset($login) ? htmlspecialchars($login) : ''; ?>">
        </div>
        <div>
            <label>Телефон:</label>
            <input type="tel" name="number" value="<?php echo isset($number) ? htmlspecialchars($number) : ''; ?>">
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
        </div>
        <div>
            <label>Пароль:</label>
            <input type="password" name="password">
        </div>
        <div>
            <label>Подтверждение пароля:</label>
            <input type="password" name="password_confirm">
        </div>
        <button type="submit">Зарегистрироваться</button>
        <p>Уже есть аккаунт? <a href="./php/login.php">Войти</a></p>
    </form>
    <script>
        document.querySelector('.form-register').addEventListener('submit', function(event) {
            const password = document.querySelector('#password').value;
            const confirmPassword = document.querySelector('#password_confirm').value;

            if (password !== confirmPassword) {
                alert('Пароли не совпадают!');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>