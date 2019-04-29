<?php 

    session_start();

        require_once("mysql.php");

        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];


        $cekuser = mysql_query("SELECT * FROM users WHERE email = '$email'");
        $jumlah = mysql_num_rows($cekuser);
        $hasil = mysql_fetch_array($cekuser);

        if($password != $jumlah["password"])  {
            echo "<script>alert('Email belum terdaftar!'); window.location = 'indexas.php'</script>";
        } else {
            if($password > $hasil['password']) {
            echo "<script>alert('Password Salah!'); window.location = 'indexas.php'</script>";
            } else {

            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['name'] = $name; 

            header('location:indexas.php');
            }
        }
    ?>