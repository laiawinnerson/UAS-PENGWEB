<?php
    session_start();
    require 'koneksi.php';
    require 'ceklogin.php';

    $no = 0;

    function get_client_browser() {
        $browser = '';
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
            $browser = 'Netscape';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
            $browser = 'Firefox';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
            $browser = 'Chrome';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
            $browser = 'Opera';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
            $browser = 'Internet Explorer';
        else
            $browser = 'Yang lainnya';
        return $browser;
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'IP tidak dikenali';
        return $ipaddress;
    }
    
    
    if(isset($_POST['add'])){
        $id_user = intval($_SESSION['id_user']);
        $nama_tempat = $_POST['nama_tempat'];
        $kategori_tempat = $_POST['kategori_tempat'];
        $provinsi = $_POST['provinsi'];
        $tanggal = $_POST['tanggal'];
        $foto = $_FILES['foto']['name'];
        $link_gmaps = $_POST['link_gmaps'];
        $browser = get_client_browser();
        $ip = get_client_ip();
        
        $dir = "foto_tempat/";
        $tmp_file = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp_file, $dir.$foto);
        
        $query_tambahData = "INSERT INTO data_tempat(id_user, nama_tempat, kategori, waktu, foto, link_gmaps, browser, ip, provinsi) VALUE('$id_user', '$nama_tempat', '$kategori_tempat', '$tanggal', '$foto', '$link_gmaps', '$browser', '$ip', '$provinsi');";
        $sql = mysqli_query($conn, $query_tambahData);
        header("location:profile.php?input=true");

    }elseif(isset($_GET['hapus'])){
        $id = $_GET["hapus"];

        $query_foto = "SELECT * FROM data_tempat WHERE id = '$id';";
        $sql_foto = mysqli_query($conn, $query_foto);
        $result = mysqli_fetch_assoc($sql_foto);

        unlink("foto_tempat/".$result['foto']);

        $query = "DELETE FROM data_tempat WHERE id = $id;";
        $sql = mysqli_query($conn, $query);
        header("location:profile.php?input=false");
    }else{
        $id_user = $_SESSION['id_user'];
        $query_postinganKu = "SELECT * FROM data_tempat WHERE id_user= '$id_user';";
        $sql_postinganKU = mysqli_query($conn, $query_postinganKu);
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

        .menu-bar{
            width: fit-content;
            margin-left: 5%;
            margin-top: 20px;
        }

        .menu{
            width: fit-content;
            height: 20px;
            float: left;
            padding: 7px;
            padding-left: 10px;
            padding-right: 10px;
            text-align: center;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            background-color: white;
            color: gray;
        }

        .menu a{
            color: gray;
        }

        .konten{
            padding-top: 40px;
            position: fixed;
            width: 90%;
            height: 75%;
            background-color: white;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            top: 100px;
            left: 50%;
            transform: translate(-50%, 0);
            box-sizing: border-box;
            overflow-y:auto;
        }

        form{
            width: fit-content;
            margin: auto;
            width: 90%;
        }

        .input{
            width: 100%;
            height: 30px;
            border: 1px solid black;
            margin-bottom: 20px;
            border-radius: 5px;
            padding: 5px;
            box-sizing: border-box;
            border: 1px solid #bfbfbf;
        }

        .tombol{
            width: 30%;
            display: flex; 
            justify-content:center;
            column-gap:20px; 
        }

        .tombol input{
            width: 400px;
            height: 30px;
            border-radius: 5px;
            border-style: none;
            color: white;
            font-size: 16px;
        }

        .tombol .submit{
            background-color: #0766AD;
        }

        .tombol .reset{
            background-color: #F31559;
        }

        input[type="file"]::file-selector-button{
            height: 100%;
            border-style:none ;
        }

        table{
            margin-left:auto;
            margin-right:auto;
            margin-top: -40px;
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 1000px;
            height: 100px;
            box-sizing: border-box;
        }

        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        table th,
        table td {
            padding: 12px 15px;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        table td img{
            width: 200px;
        }

        .hapus{
            width: 80px;
            height: 40px;
            background-color: #F31559;
            border-radius: 10px;
            border: none;
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>

    <script>
        function disorot(obj){
            obj.style.backgroundColor = '#0F2167';
        }

        function tidak_disorot(obj){
            obj.style.backgroundColor = '#0766AD';
        }

        function validasi(){
            let nama_tempat = document.getElementById('nama_tempat').value;
            let kategori = document.getElementById('kategori_tempat').value;
            let provinsi = document.getElementById('provinsi').value;
            let tanggal = document.getElementById('tanggal').value;
            let file = document.getElementById('foto').value;
            let link_gmaps = document.getElementById('link_gmaps').value;

            if(nama_tempat == "" || tanggal =="" || file =="" || link_gmaps =="" || provinsi ==""|| kategori ==""){
                alert("isikan data dengan lengkap");
            }else{
                return true;
            }
        }
    </script>
</head>
<body>
    <div class="topnav">
        <a href="logout.php">Logout</a>
        <a href="profile.php">Profile</a>
        <a href="index.php">Beranda</a>
    </div>

    <div class="menu-bar">
        <div class="menu" style="background-color: <?php if($_GET['input'] == "true" ){echo "gray";}else{echo "white";} ?>;">
            <a href="profile.php?input=false" style="color:black">
                Postingan
            </a>
        </div>
        <div class="menu" style="background-color:<?php if($_GET['input'] == "true" ){echo "white";}else{echo "gray";} ?>;">
            <a href="profile.php?input=true" style="color:black">
                Data Baru
            </a> 
        </div>
    </div>

    <div class="konten">
        <?php 
            if($_GET['input'] == "true"){ ?>
                <form action="" method="POST" enctype="multipart/form-data" onSubmit="validasi()">
                    <input class="input"  type="text" id="nama_tempat" name="nama_tempat" id="nama_tempat" placeholder="Nama Tempat"> <br>
                    <select class="input" id = "kategori_tempat" name="kategori_tempat" style="display: block;">
                        <option value="" selected disabled>Kategori Tempat</option>
                        <option value="Jalan">Jalan</option>
                        <option value="Gedung">Gedung</option>
                        <option value="Wahana">Wahana</option>
                        <option value="Pantai">Pantai</option>
                        <option value="Sungai">Sungai</option>
                        <option value="Hutan">Hutan</option>
                        <option value="Pegunungan">Pegunungan</option>
                    </select>
                    <input class="input" type="date" id= "tanggal" name="tanggal" id="tanggal" placeholder="Tanggal"> <br>

                    <select class="input" id= "provinsi" name="provinsi" style="display: block;">
                        <option value="" selected disabled>Provinsi</option>
                        <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                        <option value="Bengkulu">Male</option>
                        <option value="Riau">Riau</option>
                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                        <option value="Jambi">Jambi</option>
                        <option value="Lampung">Lampung</option>
                        <option value="Bangka Belitung">Bangka Belitung</option>
                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                        <option value="Banten">Banten</option>
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Daerah Istimewa Yogyakarta">Daerah Istimewa Yogyakarta</option>
                        <option value="Jawa Timur" >Jawa Timur</option>
                        <option value="Bali">Bali</option>
                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option> 
                        <option value="Nusa Tenggara Barat" >Nusa Tenggara Barat</option>
                        <option value="Gorontalo">Gorontalo</option>
                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                        <option value="Maluku Utara">Maluku Utara</option>
                        <option value="Maluku">Maluku</option>
                        <option value="Papua Barat">Papua Barat</option>
                        <option value="Papua">Papua</option>
                        <option value="Papua Tengah">Papua Tengah</option>
                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                        <option value="Papua Selatan">Papua Selatan"</option>
                        <option value="Papua Barat Daya">Papua Barat Daya</option>
                    </select>

                    <input class="input"  type="file" id = "foto" name="foto" id="foto" placeholder="Foto" accept="image/*"> <br>
                    <input class="input"  type="url" id ="link_gmaps" name="link_gmaps" id="" placeholder="Link Gmaps"> <br>

                    <div class="tombol" >
                        <input class="submit" onmouseover="disorot(this)" onmouseout="tidak_disorot(this)" type="submit" name="add" value="submit">
                        <input class="reset" type="reset" name="reset" value="reset">
                    </div>
                </form>

            <?php }else{ ?>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Tempat</th>
                            <th>Provinsi</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Tanggal Pengambilan</th>
                            <th>Link Gmaps</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($result = mysqli_fetch_assoc($sql_postinganKU)){?>
                        <tr>
                            <td><?php echo ++$no;?></td>
                            <td><?php echo $result['nama_tempat'];?></td>
                            <td><?php echo $result['provinsi'];?></td>
                            <td><?php echo $result['kategori'];?></td>
                            <td><img src="foto_tempat/<?php echo $result['foto'];?>" alt=""></td>
                            <td><?php echo $result['waktu'];?></td>
                            <td><a href="<?php echo $result['link_gmaps'];?>">Link</a></td>
                            <td><a href="profile.php?hapus=<?php echo $result['id'];?>"><button class="hapus">Hapus</button></a></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            <?php } 
        ?> 
    </div>
</body>
</html>