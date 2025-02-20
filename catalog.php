<?php

$host = 'mysql-8.0';
$db = 'demoexam-bd';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение товаров из базы данных
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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

        .h1 {
            position: relative;
            text-align: center;
        }

        /* Стили для сетки товаров */
        #catalog {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .product:hover {
            transform: translateY(-5px);
        }

        .product img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .product h3 {
            margin: 10px 0;
            font-size: 1.2em;
            color: #333;
        }

        .product p {
            color: #666;
            margin: 10px 0;
        }

        .product button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product button:hover {
            background-color: #45a049;
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
        <h1>Каталог товаров</h1>

        <div id="catalog">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="product">
                        <img src="' . $row['product_image'] . '" alt="' . $row['product_name'] . '">
                        <h3>' . $row['product_name'] . '</h3>
                        <p>Цена: ' . $row['product_price'] . ' руб.</p>
                        <button onclick="addToCart(' . $row['product_id'] . ')">Добавить в корзину</button>
                    </div>';
                }
        } else {
            echo "<p>Товары отсутствуют.</p>";
        }
         ?>
        </div>

    <script>
        function addToCart(productId) {
            console.log(`Товар с ID ${productId} добавлен в корзину`);
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>