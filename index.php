<?php
    session_start();
    require 'koneksi.php';

    $err = "Maaf data anda yang dicari tidak ada !";
    
    if(isset($_POST['cari'])){
        $provinsi = $_POST['provinsi'];
        $query_cari = "SELECT * FROM data_tempat WHERE provinsi = '$provinsi';";
        $sql = mysqli_query($conn, $query_cari);
    }else{
        $query = "SELECT nama_tempat, username, provinsi, waktu, foto, link_gmaps FROM data_tempat  JOIN user on (user.id_user = data_tempat.id_user) ORDER BY id DESC LIMIT 10;";
        $sql = mysqli_query($conn, $query);
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
        .topnav {
            overflow: hidden;
            background-color: #F7EFE5;
            text-align: center;
        }

        .topnav a{
            float: right;
            color: #765827;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        } 
        
        .topnav a.active {
            background-color: #04AA6D;
        }

        form{
            width: fit-content;
            margin: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .kolom_cari{
            background-color: #EAD7BB;
            background-color: white;
            box-shadow: 0px 5px 5px 5px rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            height: 40px;
            width: 250px;
            border-style: none;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .tombol-cari{
            box-shadow: 0px 5px 5px 5px rgba(0, 0, 0, 0.2);
            background-color: #765827;
            color: white;
            border-style: none;
            border-radius: 3px;
            font-size: 18px;
            height: 40px;
            width: 75px;
        }

        .kecocokan{
            margin-left: 5%;
            padding : 7px;
            width: fit-content; 
            background-color:white;
            color:gray;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .konten{
            position: fixed;
            width: 90%;
            height: 75%;
            background-color: white;
            border-radius: 10px;
            top: 170px;
            left: 50%;
            transform: translate(-50%, 0);
            box-sizing: border-box;
            overflow-y: auto;
        }

        .kotak{
            width: 50%;
            height: 225px;
            float: left;
            box-sizing: border-box;
            padding: 10px;
        }

        .inner{
            width: 100%;
            height: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 5px 5px 5px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            padding: 10px;
        }

        .inner .judul{
            margin-bottom:5px;
            font-size:18px;
        }

        .gambar{
            width : 50%; 
            height: 86%;
            border-radius:10px; 
            background-size: 200%; 
            float:left;
        }

        .keterangan{
            font-size: 14px;
            width : 50%; 
            height: 86%; 
            float:left; 
            box-sizing:border-box; 
            padding:5px;
        }

        .keterangan p{
            text-overflow:clip; 
            white-space: nowrap;
            overflow:hidden;
        }

        .error{
            font-size: 16px;
            border-radius: 10px;
            position :absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 200px;
            padding: 20px;
            /* background-color: #F31559; */
            color: gray;
        }


        ::-webkit-scrollbar {
            display: none;
        }

        @media screen and (min-width: 360px) {
        .kotak{
            width: 100%;
        }
        }
    
        @media screen and (min-width: 800px) {
        .kotak {
            width: 50%;
        }
        }


        @media screen and (min-width: 1000px){
        .kotak {
            width: 25%;
        }
        
        }
        
    </style>
</head>
<body>
    <div class="topnav">
        <a href="logout.php" style="display: <?php if(isset($_SESSION['username'])){ echo 'block';} else {echo 'none';}?>;">Logout</a>
        <a href="<?php if(isset($_SESSION['username'])){ echo 'profile.php?input=false';} else {echo 'login.php';}?>">
            <?php if(isset($_SESSION['username'])){ echo 'Profile';} else {echo 'Login';}?></a>
        <a href="index.php">Beranda</a>
    </div>

    <div class="kontainer">
        
        <form action="" method="POST">
            <input required type="text" id=kolom-cari class=kolom_cari name="provinsi" placeholder="Cari berdasar provinsi">
            <input type="submit" name="cari" value="cari" class="tombol-cari">
        </form>
    </div>
    
    <div class="kecocokan">
        <?php 
        if(isset($_POST['cari'])){
            echo "Kecocokan : ".mysqli_num_rows($sql);
        }else{
            echo "Yang baru saja ditambahkan";
        } 
        ?> 
    </div>

    <div class="konten">
        <?php if(mysqli_num_rows($sql)!= 0) { while($result = mysqli_fetch_assoc($sql)){?>
        <div class="kotak">
            <div class="inner">
                <p class="judul"><?php echo $result['nama_tempat']?></p>
                <div class="gambar" style="background-image: url('foto_tempat/<?php echo $result['foto']?>');"> 
                        <!-- foto tempat di folder foto_tempat -->
                </div>
                <div class="keterangan">
                    <p>oleh : <?php echo $result['username']?></p>
                    <p>provinsi : <?php echo $result['provinsi']?> </p>
                    <p>waktu    : <?php echo $result['waktu']?></p>
                    <p>link-gmaps : <a href="<?php echo $result['link_gmaps']?>">klik disini</a></p>
                    <a href="">selengkapnya...</a>
                </div>
            </div>
        </div>        
        <?php } 
    
        }else{ ?>
    
        <div class="error">
            <p><?php echo $err?></p>
        </div>
    
        <?php } ?>
    </div>
</body>
</htm