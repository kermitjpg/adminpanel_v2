<?php
$sayfa = "Yöneticiler";
include("inc/header.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='index.php'}
        })</script>";
    exit;
}

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;


    if ($_POST["kadi"] != '' && $_POST["parola"] != '' && $_POST["email"] != '' && $_POST["yetki"] != '') {

        $ekleSorgu = $baglanti->prepare('INSERT INTO yoneticiler SET kadi=:kadi, parola=:parola, email=:email, yetki=:yetki, aktif=:aktif');
        $ekle = $ekleSorgu->execute([
            'kadi' => $_POST['kadi'],
            'parola' => $_POST['parola'],
            'email' => $_POST['email'],
            'yetki' => $_POST['yetki'],
            'aktif' => $aktif
        ]);

        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Ekleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='yoneticiler.php'}
        })</script>";
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'Bir hata oluştu!', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    }
}



?>


<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">
        <main>
            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Buradan yeni yönetici ve yetkisiz kullanıcı ekleyebilirsiniz.</p>
                <div class="row row-cols-2 shadow rounded-end">

                    <div class="col bg-secondary text-white rounded">
                        <h6 class="p-3 pb-2">YÖNETİCİLER</h6>
                    </div>
                </div>


                <div class="row bg-light">
                    <div class="col">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group mt-2 mb-3">
                                <label>Kullanıcı Adı</label>
                                <input type="text" name="kadi" required class="form-control" value="<?= @$_POST["kadi"] ?>">
                            </div>

                            <div class=" form-group mt-2 mb-3">
                                <label>Parola</label>
                                <input type="text" name="parola" required class="form-control" value="<?= @$_POST["parola"] ?>">
                            </div>

                            <div class=" form-group mt-2 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" required class="form-control" value="<?= @$_POST["email"] ?>">
                            </div>


                            <div class="form-group mt-3">
                                <label>Yetki</label> <br>
                                <label> <input type="radio" name="yetki" value="1"> Admin</label><br>
                                <label><input type="radio" name="yetki" value="2" checked> Normal Kullanıcı</label>

                            </div>

                            <div class="form-group form-check">
                                <label>
                                    <input type="checkbox" name="aktif" class="form-check-input">Aktif mi?
                                </label>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <input type="submit" value="Ekle" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>


<?php
include("inc/footer.php")
?>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>