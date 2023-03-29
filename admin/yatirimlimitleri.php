<?php
$sayfa = "Yatırım Limitleri";
include("inc/header.php");
$sorgu4 = $baglanti->prepare("select * from yatirimlimitleri");
$sorgu4->execute();
$sonuc4 = $sorgu4->fetch();
?>

<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">

        <main>
            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Yatırım limitlerini buradan düzenleyebilirsiniz.</p>
                <div class="row row-cols-1 shadow rounded-end">
                    <div class="col bg-secondary text-white rounded">
                        <h6 class="p-3 pb-2">YATIRIM LİMİTLERİ</h6>
                    </div>
                </div>


                <div class="row bg-light">
                    <div class="col">
                        <form action="" method="post" id="form">
                            <div class="row g-3 mt-3 mb-3">

                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput" class="form-label fw-bold">Havale Minimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Minimum Tutar" aria-label="First name" name="havale_minimum" value="<?= $sonuc4["havale_minimum"] ?>">
                                </div>


                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput2" class="form-label fw-bold">Havale Maksimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Maksimum Tutar" aria-label="Last name" name="havale_maksimum" value="<?= $sonuc4["havale_maksimum"] ?>">
                                </div>



                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput3" class="form-label fw-bold">Papara Minimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput3" placeholder="Minimum Tutar" aria-label="First name" name="papara_minimum" value="<?= $sonuc4["papara_minimum"] ?>">
                                </div>

                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput4" class="form-label fw-bold">Papara Maksimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput4" placeholder="Maksimum Tutar" aria-label="Last name" name="papara_maksimum" value="<?= $sonuc4["papara_maksimum"] ?>">
                                </div>



                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput5" class="form-label fw-bold">PayFix Minimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput5" placeholder="Minimum Tutar" aria-label="First name" name="payfix_minimum" value="<?= $sonuc4["payfix_minimum"] ?>">
                                </div>


                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput6" class="form-label fw-bold">PayFix Maksimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput6" placeholder="Maksimum Tutar" aria-label="Last name" name="payfix_maksimum" value="<?= $sonuc4["payfix_maksimum"] ?>">
                                </div>


                                <div class="col-sm-6">
                                    <label for="formGroupExampleInput7" class="form-label fw-bold">Kripto Minimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput5" placeholder="Minimum Tutar" aria-label="First name" name="kripto_minimum" value="<?= $sonuc4["kripto_minimum"] ?>">
                                </div>


                                <div class="col-sm-6 mb-2">
                                    <label for="formGroupExampleInput8" class="form-label fw-bold">Kripto Maksimum</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput6" placeholder="Maksimum Tutar" aria-label="Last name" name="kripto_maksimum" value="<?= $sonuc4["kripto_maksimum"] ?>">
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
            url: 'yatirimlimitleri.php',
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

    $guncelleSorgu = $baglanti->prepare("Update yatirimlimitleri set havale_minimum=:havale_minimum, havale_maksimum=:havale_maksimum, papara_minimum=:papara_minimum, papara_maksimum=:papara_maksimum, payfix_minimum=:payfix_minimum, payfix_maksimum=:payfix_maksimum, kripto_minimum=:kripto_minimum, kripto_maksimum=:kripto_maksimum");
    $guncelle = $guncelleSorgu->execute([
        'havale_minimum' => $_POST["havale_minimum"],
        'havale_maksimum' => $_POST["havale_maksimum"],
        'papara_minimum' => $_POST["papara_minimum"],
        'papara_maksimum' => $_POST["papara_maksimum"],
        'payfix_minimum' => $_POST["payfix_minimum"],
        'payfix_maksimum' => $_POST["payfix_maksimum"],
        'kripto_minimum' => $_POST["kripto_minimum"],
        'kripto_maksimum' => $_POST["kripto_maksimum"],

    ]);
}
?>