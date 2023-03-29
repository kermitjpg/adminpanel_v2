<?php
session_start();
ob_start();
include("../inc/vt.php");
?>

<!doctype html>
<html class="no-js" lang="tr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/admin2.png">
    <link rel="shortcut icon" href="images/admin2.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="images/admin2.png" style="max-height: 250px;" alt="">
                    </a>
                </div>
                <div class="login-form">

                    <?php
                    if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
                        header("location:index.php");
                    } elseif (isset($_COOKIE["cerez"])) {

                        $sorgu = $baglanti->prepare("select kadi, yetki from yoneticiler WHERE aktif=1");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            if ($_COOKIE["cerez"] == md5("aa" . $sonuc["kadi"] . "bb")) {

                                $_SESSION["Oturum"] = "6789";
                                $_SESSION["kadi"] = $sonuc["kadi"];
                                $_SESSION["yetki"] = $sonuc["yetki"];



                                header("location:index.php");
                            }
                        }
                    }


                    if ($_POST) {
                        $kadi = $_POST["txtKadi"];
                        $parola = $_POST["txtParola"];
                    }

                    ?>

                    <form method="POST" action="login.php">

                        <div class="form-floating mb-2">
                            <input type="text" name="txtKadi" class="form-control" id="floatingInput" required placeholder="name@example.com">
                            <label for="floatingInput">Kullanıcı Adı</label>
                        </div>

                        <div class="form-floating mb-2">
                            <input type="password" name="txtParola" class="form-control" id="floatingPassword" required placeholder="Password">
                            <label for="floatingPassword">Şifre</label>
                        </div>


                        <div class="form-check mb-3">
                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="cbHatirla" value="" />
                            <label class="form-check-label" for="inputRememberPassword">Beni Hatırla</label>
                        </div>

                        <input type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" value="Giriş"></input>
                    </form>

                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <?php


                    //admin
                    // echo md5("56" . "admin123" . "23");

                    if ($_POST) {
                        $sorgu = $baglanti->prepare("select parola, yetki from yoneticiler WHERE kadi=:kadi and aktif=1");
                        $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                        $sonuc = $sorgu->fetch();
                        if ($parola == $sonuc["parola"]) {

                            $_SESSION["Oturum"] = "6789";
                            $_SESSION["kadi"] = $kadi;
                            $_SESSION["yetki"] = $sonuc["yetki"];

                            if (isset($_POST["cbHatirla"])) {
                                setcookie("cerez", md5("aa" . $kadi . "bb"), time() + (60 * 60 * 24 * 7));
                            }


                            header("location:index.php");
                        } else {
                            echo "<script> Swal.fire({
                            title: 'Hata!',
                            text: 'Kullanıcı adı veya şifre hatalı!',
                            icon: 'error',
                            confirmButtonText: 'Tamam',
                            confirmButtonColor: '#000',
                        })</script>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>