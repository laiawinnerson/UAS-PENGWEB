<?php
    session_start();

    require 'koneksi.php';
    
    $err = "";
    
    if(isset($_COOKIE['cookie_username'])){
        $_SESSION['username'] = $_COOKIE['cookie_username'];
    }
    
    if(isset($_SESSION['username'])){
        header("location:profile.php");
    }
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username == "" and $password = ""){
            $err = "username dan password kosong!";
        }else{
            $query = "SELECT * FROM user WHERE username = '$username';";
            $sql = mysqli_query($conn, $query);
            $result = mysqli_fetch_assoc($sql);
            if(mysqli_num_rows($sql) == 1){
                if ($password == $result['password']){
                    $_SESSION['username'] = $username;
                    $_SESSION['id_user'] = $result['id_user'];
                    setcookie("cookie_username", "$username", time() + 60*15, '/'); // cookie berlaku 30 detik
                    header('location:profile.php');
                }else{
                    $err = "password salah!";
                }
            }
            else{
                $err = "akun anda tidak ditemukan!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        *{
            padding: 0;
            margin: 0;
            list-style: none;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            background-image: url("img/background.jpg");
        }
        .kontainer{
            position :absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            width: 400px;
            background-color: white;
            border-radius: 10px;
        }

        h3 {
            font-size: 27px;
            text-align: center;
            margin-bottom: 20px;
            margin-top: -10px;
            color: #765827;
        }

        input{
            border-radius: 5px;
            border: 1px solid #bfbfbf;
        }

        input[type=text], input[type=password]{
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
            height: 40px;
            box-sizing: border-box;
        }

        input[type = submit]{
            width: 100%;
            height: 40px;
            border-style: none;
            background-color:#765827;
            color: white;
            font-size: 16px;
        }
        
        input[type=submit]:hover{
            background: #65451F;
        }

        .error{
            margin-top: 20px;
            text-align: center;
            padding: 20px;
            background-color: #F31559;
            color: white;
        }

        .link{
            text-align: center;
            margin-top: -15px;
            margin-bottom: 5px;
        }

    </style>
</head>
<body>
    <div class="kontainer">
        <h3>Login</h3>
        <form action="" method="POST">
            <input required type ="text" name="username" id="username" placeholder="username"> <br>
    
            <input required type="password" name="password" id="password" placeholder="password"> <br>
            
            <div class="link">
                <a href="registrasi.php">buat akun</a>
                <span>atau</span>
                <a href="index.php">beranda</a>
            </div>

            <input type="submit" name="login" value="login" onclick="">
        </form>
        

        <div class="error" style="display: <?php if($err != ""){echo "block";}else{echo "none";}?>;">
            <p>
                <?php echo $err?>
            </p>
        </div>  
    </div>
</body>
</html> 




