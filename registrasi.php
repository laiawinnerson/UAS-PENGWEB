<?php
    require 'koneksi.php';
    session_start();

    $err = "";

    if(isset($_POST['registrasi'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query_cek_username = "SELECT * FROM user WHERE username = '$username';";
        $sql_cek_username = mysqli_query($conn, $query_cek_username);

        if(mysqli_num_rows($sql_cek_username) == 1){
           $err = "username yang sama telah dipakai!";
        }
        else{
            $query = "INSERT INTO user (username, password, email)
                        VALUE('$username', '$password', '$email');";
            $sql = mysqli_query($conn, $query);    
            header("Location:login.php");  
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
            font-size: 25px;
            text-align: center;
            margin-bottom: 20px;
            margin-top: -10px;
            color: #765827;
        }

        .error{
            margin-top: 20px;
            text-align: center;
            padding: 20px;
            background-color: #F7EFE5;
            color: white;
        }

        input{
            border-radius: 5px;
            border-width: 1px;
            border: 1px solid #bfbfbf;
        }

        input[type=text], 
        input[type=password],
        input[type=email]{
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
            background-color: #765827;
            color: white;
            font-size: 16px;
        }
        
        input[type=submit]:hover{
            background: #65451F;
        }

        .link{
            text-align:center;
            margin-top: -15px;
            margin-bottom: 5px;
        }

    </style>
</head>
<body>
    
    <div class="kontainer">
        <h3>Buat Akun</h3>
    
        <form action="" method="POST">
            <input required type="text" name="username" id="username" placeholder= "username"> <br>
            <input required type="password" name="password" id="password" placeholder="password"> <br>
            <input required type="email" name="email" id="email" placeholder="email"> <br>

            <div class="link">
                <a href="login.php" id="link-login">login akun</a>
                <span>atau</span>
                <a href="index.php" id="link-beranda">beranda</a>
            </div>

            <input required type="submit" name="registrasi" value="registrasi">

            <div class="error" style="display: <?php if($err != ""){echo "block";}else{echo "none";}?>;">
                <p>
                    <?php echo $err?>
                </p>
            </div>
        </form>
    </div>
</body>
</html>