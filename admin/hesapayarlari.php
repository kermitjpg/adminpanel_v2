<?php
$sayfa = "Hesap Ayarları";
include("inc/header.php");
$sorgu3 = $baglanti->prepare("select * from hesapayarlari");
$sorgu3->execute();
$sonuc3 = $sorgu3->fetch();
?>


<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">
        <main>
            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Hesap ayarlarını buradan düzenleyebilirsiniz.</p>
                <div class="row row-cols-1 shadow rounded-end">
                    <div class="col bg-secondary text-white rounded">
                        <h6 class="p-3 pb-2">HESAP AYARLARI</h6>
                    </div>
                </div>


                <div class="row bg-light">
                    <div class="col">
                        <form action="" method="post" id="form">
                            <div class="row g-3 mt-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput" class="form-label">Papara Hesap Sahibi</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" required placeholder="Hesap Sahibi" aria-label="First name" value="<?= $sonuc3["papara_hesap"] ?>" name="papara_hesap">
                                </div>

                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput2" class="form-label">Papara Hesap Numarası</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" required placeholder="Papara Hesap Numarası" aria-label="Last name" value="<?= $sonuc3["papara_no"] ?>" name="papara_no">
                                </div>



                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput3" class="form-label">PayFix Hesap Sahibi</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput3" required placeholder="Hesap Sahibi" aria-label="First name" value="<?= $sonuc3["payfix_hesap"] ?>" name="payfix_hesap">
                                </div>

                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput4" class="form-label">PayFix Hesap Numarası</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput4" required placeholder="PayFix Hesap Numarası" aria-label="Last name" value="<?= $sonuc3["payfix_no"] ?>" name="payfix_no">
                                </div>



                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput5" class="form-label">Kripto Kodu</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput5" required placeholder="Kripto Kodu" aria-label="First name" value="<?= $sonuc3["kripto_no"] ?>" name="kripto_no">
                                </div>

                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput6" class="form-label">Kripto QR</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput6" placeholder="QR Kodu" aria-label="Last name">
                                </div>


                                <hr class="mt-3">



                            </div>

                            <button class="btn btn-secondary mb-3 w-100" type="button" id="btnGonder2" onclick="save();">Kaydet</button>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<?php
include("inc/footer.php");
?>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function save() {
        $.ajax({
            type: 'POST',
            url: 'hesapayarlari.php',
            data: $('#form').serialize(),
            success: function(e) {

                Swal.fire({
                    title: 'Harika!',
                    text: 'Güncelleme başarılı!',
                    icon: 'success',
                    confirmButtonText: 'Tamam',
                    confirmButtonColor: "#000",

                }).then((result) => {
                    window.location.reload();
                })

            }
        })
    };
</script>

<?php
if ($_POST) { ///veri güncelle

    $guncelleSorgu = $baglanti->prepare("Update hesapayarlari set papara_hesap=:papara_hesap, papara_no=:papara_no, payfix_hesap=:payfix_hesap, payfix_no=:payfix_no, kripto_no=:kripto_no");
    $guncelle = $guncelleSorgu->execute([
        'papara_hesap' => $_POST["papara_hesap"],
        'papara_no' => $_POST["papara_no"],
        'payfix_hesap' => $_POST["payfix_hesap"],
        'payfix_no' => $_POST["payfix_no"],
        'kripto_no' => $_POST["kripto_no"],
    ]);
}
?>