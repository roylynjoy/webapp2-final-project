<?php

require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('azure' === $password) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: posts.php");
                    exit;
                } else {
                    echo "Invalid password!";
                }
            } else {
                echo "User not found!";
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <title>Login Page</title>

    <style>
     * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
    }

    body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(ai1.jpg) no-repeat;
    background-size: cover;
    background-position: center;
    
    }
    
    .wapper{
        border: 2px solid white;
        padding: 50px;
        border-radius: 20px;
        backdrop-filter: blur(3px);
        color: white;
    }

    #submit{
        margin-top: 10px;
        cursor: pointer;
    }

    #submit:hover{
        background-color: rgb(83, 77, 77);
        color: white;
    }
    </style>
</head>

<body>
<div class="wapper">
        <div class="form-box login">
            <h2>Login</h2>

        <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <!-- <span class="icon"><ion-icon name="mail-outline"></ion-icon></span> -->
                    <input type="text" id="username" placeholder="Enter Username" name="username" required>
                    <label>Username</label>
                
                <div class="input-box">
                    <!-- <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span> -->
                    <input type="password" id="password" placeholder="Enter Password" name="password" required>
                    <label>Password</label>
                </div>
                <button id="submit">Login</button>


 
        </form>
    </div>
</body>

</html>