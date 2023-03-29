<?php
$sayfa = "Bankalar";
include("inc/header.php");

// Yetkisiz kullanıcının girmesini engellemek için etkinleştirebilirsiniz.
// if ($_SESSION["yetki"] != "1") {
//     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
//     echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
//             if(value.isConfirmed){window.location.href='bankalar.php'}
//         })</script>";
//     exit;
// }

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;


    if ($_POST["havale_hesap"] != '' && $_POST["havale_ad"] != '' && $_POST["havale_hesap_no"] != '' && $_POST["havale_sube"] != '' && $_POST["havale_iban"] != '') {


        $ekleSorgu = $baglanti->prepare(
            'INSERT INTO bankalar SET havale_hesap=:havale_hesap, havale_ad=:havale_ad, havale_hesap_no=:havale_hesap_no, havale_sube=:havale_sube, havale_iban=:havale_iban, aktif=:aktif'
        );
        $ekle = $ekleSorgu->execute([
            'havale_hesap' => $_POST['havale_hesap'],
            'havale_ad' => $_POST['havale_ad'],
            'havale_hesap_no' => $_POST['havale_hesap_no'],
            'havale_sube' => $_POST['havale_sube'],
            'havale_iban' => $_POST['havale_iban'],
            'aktif' => $aktif
        ]);

        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Ekleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='bankalar.php'}
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
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Buradan yeni banka ekleyebilirsiniz.</p>
                <div class="row row-cols-1 shadow rounded-end">

                    <div class="col bg-secondary text-white rounded">
                        <h6 class="p-3 pb-2">BANKALAR</h6>
                    </div>
                </div>

                <div class="row bg-light">
                    <div class="col">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group mt-2 mb-3">
                                <label>Banka Adı</label>
                                <input type="text" name="havale_hesap" required class="form-control" value="<?= @$_POST["havale_hesap"] ?>">
                            </div>

                            <div class=" form-group mt-2 mb-3">
                                <label>Hesap Sahibi</label>
                                <input type="text" name="havale_ad" required class="form-control" value="<?= @$_POST["havale_ad"] ?>">
                            </div>

                            <div class=" form-group mt-2 mb-3">
                                <label>Hesap Numarası</label>
                                <input type="text" name="havale_hesap_no" required class="form-control" value="<?= @$_POST["havale_hesap_no"] ?>">
                            </div>

                            <div class=" form-group mt-2 mb-3">
                                <label>Şube Kodu</label>
                                <input type="text" name="havale_sube" required class="form-control" value="<?= @$_POST["havale_sube"] ?>">
                            </div>

                            <div class=" form-group mt-2 mb-3">
                                <label>Iban</label>
                                <input type="text" name="havale_iban" required class="form-control" value="<?= @$_POST["havale_iban"] ?>">
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

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<?php
include("inc/footer.php")
?>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>