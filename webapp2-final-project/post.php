<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Page</title>
    <style>
        body{
        background: url("image.png");
        background-size: 100vw;
    }

    .all{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 180px;
        border: 5px solid white;
        padding: 40px;
    }

    #page{
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        padding: 10px;
        border: 2px solid white;
    }

    .post-container{
        max-width: 600px;

    }

    #btn{
        background-color: azure;
    }

    #btn:hover{
        background-color: rgb(61, 58, 58);
        color: white;
    }

    #postDetails{
        color: rgb(46, 23, 23);
    }
    </style>
</head>

<body>
<div class="all">
    <div class="post-container">
        <h1 id="page">Post Page</h1>
        <div id="postDetails"></div>
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
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $query = "SELECT * FROM `posts` WHERE id = :id";
                        $statement = $pdo->prepare($query);
                        $statement->execute([':id' => $id]);

                        $post = $statement->fetch(PDO::FETCH_ASSOC);

                        if ($post) {
                            echo '<h3>Title: ' . $post['title'] . '</h3>';
                            echo '<p>Body: ' . $post['body'] . '</p>';
                        } else {
                            echo "No post found with ID $id!";
                        }
                    } else {
                        echo "No post ID provided!";
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
            <button input type="Back" <a href="#" onclick="history.back();">Back</a></button>
        </div>
    </div>
</body>

</html>