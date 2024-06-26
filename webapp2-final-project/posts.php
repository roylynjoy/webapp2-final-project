<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Page</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            background-color:white;
        }

        .posts-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid white;
            border-radius: 5px;
            color: white;
            background: url(ai4.jpg);
            object-fit: fill;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: rgb(236, 222, 222);
            cursor: pointer;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        li a {
            text-decoration: none;
        }
        
        li:hover {
            background-color: transparent;
            color: white;
        }


    </style>
</head>

<body>
    <div class="posts-container">
        <h1>Posts Page</h1>
        <ul id="postLists">
            <?php

            require 'config.php';

             if (!isset($_SESSION['user_id'])) {
                 header("Location: index.php");
                 exit;
            }

            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try {
                $pdo = new PDO($dsn, $user, $password, $options);

                if ($pdo) {
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT * FROM `posts` WHERE user_id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $user_id]);

                    
                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        // echo '<li data-id="' . $row['id'] . '">' . $row['title'] . '</li>';
                        echo '<li><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</li>';
                    }

                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </ul>
    </div>
</body>


</html>
