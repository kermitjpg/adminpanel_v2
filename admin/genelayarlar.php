<?php
$sayfa = "Genel Ayarlar";
include("inc/header.php");
?>

<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">

        <main>

            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Sitenin genel
                    ayarlarını buradan düzenleyebilirsiniz.</p>
                <div class="row row-cols-1 shadow rounded-end">
                    <div class="col bg-secondary text-white rounded">
                        <h6 class="p-3 pb-2">GENEL AYARLAR</h6>
                    </div>
                </div>

                <?php
                $sorgu2 = $baglanti->prepare("select * from anasayfa");
                $sorgu2->execute();
                $sonuc2 = $sorgu2->fetch();
                ?>

                <div class="row bg-light">
                    <div class="col">
                        <form id="form" action="" method="post">
                            <!-- Form action'una guncelle.php yazılıp input type submit metoduylada gönderilebilir.-->
                            <div class="col">
                                <div class="mt-3 mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Başlık</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Başlık Giriniz" value="<?= $sonuc2["baslik"] ?>" name="baslik">
                                </div>
                            </div>


                            <div class="col">
                                <div class="mt-1 mb-3">
                                    <label for="formGroupExampleInput2" class="form-label">Açıklama</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Açıklama Giriniz" value="<?= $sonuc2["tanimlama"] ?>" name="tanimlama">
                                </div>
                            </div>


                            <div class=" col">
                                <div class="mt-1 mb-3">
                                    <label for="formGroupExampleInput3" class="form-label">Anahtar Kelimeler</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput3" placeholder="Anahtar Kelime Giriniz" value="<?= $sonuc2["anahtar"] ?>" name="anahtar">
                                </div>
                            </div>

                            <hr class="mt-3">


                            <div class="col">
                                <div class="mt-1 mb-3">
                                    <label for="formGroupExampleInput4" class="form-label">Admin Login</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput4" placeholder="Admin Kullanıcı Adı" value="<?= $_SESSION["kadi"] ?>">
                                </div>
                            </div>

                            <?php
                            $sorgu = $baglanti->prepare("select * from yoneticiler");
                            $sorgu->execute();
                            $sonuc = $sorgu->fetch();
                            ?>

                            <?php
                            if ($_SESSION['Oturum'] != '') {
                                $kadi = $_SESSION['kadi'];
                                $islemSorgu = $baglanti->query("SELECT * FROM yoneticiler WHERE kadi='" . $kadi . "'");
                                $islemCek = $islemSorgu->fetch(PDO::FETCH_ASSOC);

                                $sifrecek = $islemCek['parola'];
                            }
                            ?>
                            <div class="col">
                                <div class="mt-1 mb-3">
                                    <label for="formGroupExampleInput5" class="form-label">Admin Şifre</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput5" placeholder="Admin Şifre" value="<?= $sifrecek ?>">
                                </div>
                            </div>


                            <hr class="mt-3">


                            <div class="mt-1 mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Canlı Destek Kodu</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Canlı Destek Kodu Giriniz" name="tawk" rows="3"> <?= $sonuc2["tawk"] ?></textarea>
                            </div>


                            <hr class="mt-3">


                            <button class="btn btn-secondary mb-3 w-100" type="button" id="btnGonder" onclick="save();">Kaydet
                            </button>
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
            url: 'genelayarlar.php',
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

$sorgu2 = $baglanti->prepare("select * from anasayfa");
$sorgu2->execute();
$sonuc2 = $sorgu2->fetch();

if ($_POST) { ///veri güncelle

    $guncelleSorgu = $baglanti->prepare("Update anasayfa set baslik=:baslik, tanimlama=:tanimlama, anahtar=:anahtar, tawk=:tawk");
    $guncelle = $guncelleSorgu->execute([
        'baslik' => $_POST["baslik"],
        'tanimlama' => $_POST["tanimlama"],
        'anahtar' => $_POST["anahtar"],
        'tawk' => $_POST["tawk"],
    ]);
};
