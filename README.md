####Nama : Winnerson Laia <br>
####NIM : 121140121
####Kelas Pengweb : RB

# UAS-PENGWEB
Pada uas pengweb kali ini, saya membuat sebuah website yang dimana orang dapat saling membagikan, melihat foto-foto indah dari berbagai tempat. Postingan disertai dengan link gmaps sehingga pengguna lain dapat mengetahui lokasi foto diambil jika ingin mengunjungi tempatnya. Pengguna tak perlu login untuk melihat isi dari database. Jika ingin memposting foto ke website maka pengguna harus membuat akun atau login jika sudah punya akun. 

## **Poin Penilaian**
### Bagian 1 : Client-side Programing
#### 1.1 Buatlah sebuah halaman web sederhana yang memanfaatkan JavaScript untuk melakukan manipulasi DOM

Ketika pengguna telah login dan ingin memposting sesuatu, maka akan terdapat form untuk mengisi data. Terdapat beberapa input dalam form, yakni input text(nama tempat), file(foto), url(link gmaps), dan date(tanggal penggambilan foto).

#### 1.2 Buatlah beberapa event untuk menghandle interaksi pada halaman web

Terdapat tiga event untuk menghandel interaksi pada halaman web yakni onsubmit, onmouseover, onmouseout. Ketika pengguan mensubmit data, maka terdapat fungsi validasi untuk mengecek jika semua kolom data telah terisi. 

### Bagian 2 : Server-side Programming
#### 2.1 Implementasikan script PHP untuk mengelola data dari formulir pada Bagian 1 menggunakan variabel global seperti `$_POST` atau `$_GET`. Tampilkan hasil pengolahan data ke layar.

Disemua halaman variable global $_POST dan $_GET digunakan, baik untuk berpindah halaman, mengambil yang telah diinputkan, untuk login akun, dan regitrasi akun. Jenis browser dan alamat ip pengguna juga diinputkan ke database.

#### 2.2 Buatlah sebuah objek PHP berbasis OOP yang memiliki minimal dua metode dan gunakan objek tersebut dalam skenario tertentu pada halaman web Anda.

Pada kode progam tidak terdapat class atau objek, semua code masih ditulis dengan pendekatan prosedural.

### Bagian 3 : Database Management
#### 3.1 Buatlah sebuah tabel pada database MySQL

Terdapat 2 tabel pada database yakni tabel user dan tabel data_tempat

#### 3.2 Buatlah konfigurasi koneksi ke database MySQL pada file PHP. Pastikan koneksi berhasil dan dapat diakses.

Pada program terdapat sebuah file bernama koneksi.php yang berisi kode untuk koneksi ke database.

#### 3.3 Lakukan manipulasi data pada tabel database dengan menggunakan query SQL. Misalnya, tambah data, ambil data, atau update data.

Penggunan dapat membuat postingan(tambah data), dan melihat postingannya (baca data), serta menghapus postingan(hapus data).

### Bagian 4 : State Management
#### 4.1 Buatlah skrip PHP yang menggunakan session untuk menyimpan dan mengelola state pengguna. Implementasikan logika yang memanfaatkan session.

Pada file ceklogin.php dan logout.php dan login.php digunakan variabel $_SESSSION untuk menyimpan informasi login pengguna.

#### 4.2 Implementasikan pengelolaan state menggunakan cookie dan browser storage pada sisi client menggunakan JavaScript.

Saya tidak terlalu mengerti mengolah cookie dengan javscript sehingga saya menggunakan php untuk mengolah cookie. Cokkie pada website ini berlaku hanya 15 menit.











