<?php
session_start();
if (!(isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789")) {
    header("location:login.php");
}
include("../inc/vt.php")
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/admin2.png">
    <link rel="shortcut icon" href="images/admin2.png">


    <script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <!-- önemli -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">


    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<div class="modal fade" id="exampleModalLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Çıkış</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Çıkış yapmak istediğinizden emin misiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <a href="logout.php" class="btn btn-danger">Çıkış</a>
            </div>
        </div>
    </div>
</div>


<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?= $sayfa == "Anasayfa" ? "active" : "" ?>">
                        <a href="index.php"> <i class="menu-icon fa fa-laptop"></i>Genel Bilgiler </a>
                    </li>
                    <li class="menu-title">Menü</li><!-- /.menu-title -->

                    <li class="<?= $sayfa == "Yöneticiler" ? "active" : "" ?>">
                        <a href="yoneticiler.php"> <i class="menu-icon fa-solid fa-user-tie"></i>Yöneticiler </a>
                    </li>

                    <li class="<?= $sayfa == "Genel Ayarlar" ? "active" : "" ?>">
                        <a href="genelayarlar.php"> <i class="menu-icon fa-solid fa-gear"></i>Genel Ayarlar </a>
                    </li>

                    <li class="<?= $sayfa == "Hesap Ayarları" ? "active" : "" ?>">
                        <a href="hesapayarlari.php"> <i class="menu-icon fa-solid fa-piggy-bank"></i>Hesap Ayarları </a>
                    </li>


                    <li class="<?= $sayfa == "Bankalar" ? "active" : "" ?>">
                        <a href="bankalar.php"> <i class="menu-icon fa-solid fa-building-columns"></i>Bankalar </a>
                    </li>


                    <li class="<?= $sayfa == "Havale" || $sayfa == "Papara" || $sayfa == "PayFix" || $sayfa == "Mefete" || $sayfa == "Kripto" ? "active" : "" ?> menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa-solid fa-turkish-lira-sign"></i>Ödemeler</a>
                        <ul class="sub-menu children dropdown-menu">



                            <!-- EDİT -->
                            <!-- Okundu sayı bilgisi -->
                            <?php
                            $sorguOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM havale WHERE okundu=0");
                            $sorguOkundu->execute();
                            $sonucOkundu = $sorguOkundu->fetch();
                            ?>
                            <!-- Okundu sayı bilgisi -->



                            <li><i class="fa fa-table"></i><a href="havale.php">Havale

                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge badge-pill badge-warning text-dark"> <?= $sonucOkundu["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->

                                </a></li>




                            <!-- EDİT -->
                            <!-- Okundu sayı bilgisi -->
                            <?php
                            $sorguOkundu2 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM papara WHERE okundu=0");
                            $sorguOkundu2->execute();
                            $sonucOkundu2 = $sorguOkundu2->fetch();
                            ?>
                            <!-- Okundu sayı bilgisi -->


                            <li><i class="fa fa-table"></i><a href="papara.php">Papara
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge badge-pill badge-warning text-dark"> <?= $sonucOkundu2["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a></li>




                            <!-- EDİT -->
                            <!-- Okundu sayı bilgisi -->
                            <?php
                            $sorguOkundu3 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM payfix WHERE okundu=0");
                            $sorguOkundu3->execute();
                            $sonucOkundu3 = $sorguOkundu3->fetch();
                            ?>
                            <!-- Okundu sayı bilgisi -->


                            <li><i class="fa fa-table"></i><a href="payfix.php">PayFix

                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge badge-pill badge-warning text-dark"> <?= $sonucOkundu3["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->

                                </a></li>





                            <!-- EDİT -->
                            <!-- Okundu sayı bilgisi -->
                            <?php
                            $sorguOkundu4 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM mefete WHERE okundu=0");
                            $sorguOkundu4->execute();
                            $sonucOkundu4 = $sorguOkundu4->fetch();
                            ?>
                            <!-- Okundu sayı bilgisi -->

                            <li><i class="fa fa-table"></i><a href="mefete.php">Mefete

                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge badge-pill badge-warning text-dark"> <?= $sonucOkundu4["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->

                                </a></li>




                            <!-- EDİT -->
                            <!-- Okundu sayı bilgisi -->
                            <?php
                            $sorguOkundu5 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM kripto WHERE okundu=0");
                            $sorguOkundu5->execute();
                            $sonucOkundu5 = $sorguOkundu5->fetch();
                            ?>
                            <!-- Okundu sayı bilgisi -->

                            <li><i class="fa fa-table"></i><a href="kripto.php">Kripto

                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge badge-pill badge-warning text-dark"> <?= $sonucOkundu5["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->

                                </a></li>
                        </ul>
                    </li>



                    <li class="<?= $sayfa == "Yatırım Limitleri" ? "active" : "" ?>">
                        <a href="yatirimlimitleri.php"> <i class="menu-icon fa-solid fa-wallet"></i>Yatırım Limitleri </a>
                    </li>




                    <!-- EDİT -->
                    <!-- Okundu sayı bilgisi -->
                    <?php
                    $sorguOkundu6 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM kayitolan WHERE okundu=0");
                    $sorguOkundu6->execute();
                    $sonucOkundu6 = $sorguOkundu6->fetch();
                    ?>
                    <!-- Okundu sayı bilgisi -->


                    <li class="<?= $sayfa == "Kayıt Olan Kullanıcılar" ? "active" : "" ?> menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa-solid fa-users"></i>Kullanıcılar</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="kayitolan.php">Kayıt Olan

                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge badge-pill badge-success text-dark"> <?= $sonucOkundu6["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->


                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">Yönetim Paneli</a>
                    <a class="navbar-brand hidden" href="./">Yönetim Paneli</a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>





                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin2.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user-tie"></i>Profilim</a>


                            <a class="nav-link" href="yoneticiler.php"><i class="fa fa-cog"></i>Ayarlar</a>


                            <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalLabel"><i class="fa fa-power-off"></i>Çıkış</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->