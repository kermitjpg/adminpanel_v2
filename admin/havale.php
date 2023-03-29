<?php
$sayfa = "Havale";
include("inc/header.php");

/* Tümünü sil butonu kodları */
if (isset($_POST['sil']) && $_SESSION["yetki"] == "1") {
    //Seçilenleri pdo ile toplu silme kodu:
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $baglanti->prepare('DELETE FROM havale WHERE id IN (' . $silinecekler . ')');
    $sorgu->execute();
    if ($sorgu) {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
    Swal.fire({
        title: 'Başarılı!!',
        text: 'Silme işlemi başarılı.',
        icon: 'success',
        confirmButtonText: 'Kapat',
        confirmButtonColor: '#000',
    }).then((value) => {
        if (value.isConfirmed) {
            window.location.href = 'havale.php'
        }
    })
</script>";
    }
}
/* Tümünü sil butonu kodları*/

?>

<script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>

<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">
        <main>


            <?php

            $havaleKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM havale WHERE aktif=1");
            $havaleKasa->execute();
            $havaleTopla = $havaleKasa->fetch();
            ?>


            <div class="container-fluid px-1 py-1">
                <div class="row d-flex justify-content-center">
                    <h2 class="text-center pt-2 pb-5">Havale Toplam Kasa
                        Tutarı: <?= /* Sorgu ahead.php'de tanımlı */
                                $havaleTopla["tutar"] ?>₺</h2>
                </div>

                <!-- EDİT -->
                <!-- Onaylanan ödemeler sayı bilgisi -->
                <?php
                $onayOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM havale WHERE aktif=1");
                $onayOkundu->execute();
                $onayOkundu = $onayOkundu->fetch();
                ?>
                <!-- Onaylanan ödemeler sayı bilgisi -->

                <div class="row d-flex justify-content-center">


                    <div class="col-sm-2">
                        <div class="card text-white text-center bg-success bg-gradient mb-3" style="max-width: 800px;">
                            <div class="card-header">Onaylanan Ödemeler</div>
                            <div class="card-body">
                                <h5 class="card-title"><span id="onaySayisi" class="text-light"> <?= $onayOkundu["sayi"] ?></span>
                                    Ödeme</h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>


                    <!-- EDİT -->
                    <!-- Reddedilen ödemeler sayı bilgisi -->
                    <?php
                    $redOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM havale WHERE aktif=2");
                    $redOkundu->execute();
                    $redOkundu = $redOkundu->fetch();
                    ?>
                    <!-- Reddedilen ödemeler sayı bilgisi -->


                    <div class="col-sm-2">
                        <div class="card text-white text-center bg-danger bg-gradient  mb-3" style="max-width: 800px;">
                            <div class="card-header">Reddedilen Ödemeler</div>
                            <div class="card-body">
                                <h5 class="card-title"><span id="onaySayisi" class="text-light"> <?= $redOkundu["sayi"] ?></span>
                                    Ödeme</h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-2">
                        <div class="card text-white text-center bg-warning bg-gradient mb-3" style="max-width: 800px;">
                            <div class="card-header">Bekleyen Ödemeler</div>
                            <div class="card-body">
                                <h5 class="card-title"><span id="okunmaSayisi" class="text-light"> <?= $sonucOkundu["sayi"] ?></span>
                                    Ödeme
                                </h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-sm-12 mb-5 mt-3">

                    <form action="" method="post">
                        <div class="table-responsive">
                            <table id="" class="dataTable order-table">

                                <?php if ($_SESSION["yetki"] == "1") { /* Tümünü sil butonu kodları*/

                                ?>

                                    <a href="#" data-toggle="modal" data-target="#silModal" class="btn btn-danger mb-2"><span class="fa fa-trash"></span> Tümünü
                                        Sil</a>



                                    <!-- Modal -->
                                    <div class="modal fade" id="silModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Silmek istediğinizden emin misiniz?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Sil
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                                <!-- Tümünü sil butonu kodları -->


                                <thead class="">
                                    <tr>


                                        <!-- Tümünü sil butonu kodları -->
                                        <input type="checkbox" id="tumunuSec" onclick="TumunuSec();" value="" style="display: none;" checked />
                                        <!-- Tümünü sil butonu kodları -->


                                        <th class="text-center">ID</th>
                                        <th class="text-center">Kullanıcı</th>
                                        <th class="text-center">Gönderen Ad Soyad</th>
                                        <th class="text-center">Telefon No</th>
                                        <th class="text-center">İşlem Saati</th>
                                        <th class="text-center">Sistem Saati</th>
                                        <th class="text-center">Alıcı Banka Adı</th>
                                        <th class="text-center">Tutar</th>
                                        <th class="text-center">Durum</th>
                                        <th class="text-center">İşlem</th>

                                    </tr>
                                </thead>


                                <tbody>

                                    <?php

                                    $aktif = [
                                        array('title' => 'BEKLİYOR', 'icon' => 'fa-solid fa-question text-warning'),
                                        array('title' => 'ONAYLANDI', 'icon' => 'fas fa-check text-success'),
                                        array('title' => 'İPTAL EDİLDİ', 'icon' => 'fas fa-times text-danger')
                                    ];
                                    $sorgu = $baglanti->prepare("select * from havale order by okundu");
                                    $sorgu->execute();
                                    while ($sonuc = $sorgu->fetch()) {
                                    ?>

                                        <tr <?php if ($sonuc["okundu"] == 0) echo 'class="fw-bold"' ?>>

                                            <!-- Tümünü sil butonu kodları -->
                                            <input class="cbSil" type="checkbox" name="sil[]" value="<?= $sonuc['id']; ?>" style="display: none;" checked>
                                            <!-- Tümünü sil butonu kodları -->

                                            <td class="text-center"><?= $sonuc["id"] ?></td>
                                            <td class="text-center"><?= $sonuc["kullanici"] ?></td>
                                            <td class="text-center"><?= $sonuc["gonderen_adsoyad"] ?></td>
                                            <td class="text-center"><?= $sonuc["tel_no"] ?></td>
                                            <td class="text-center"><?= $sonuc["islem_saati"] ?></td>
                                            <td class="text-center"><?= $sonuc["sistem_saati"] ?></td>
                                            <td class="text-center"><?= $sonuc["banka_adi"] ?></td>
                                            <td class="text-center"><?= $sonuc["tutar"] ?> ₺</td>

                                            <td class="text-center">
                                                <div>

                                                    <?php if ($sonuc["aktif"] == 0) {
                                                    ?>
                                                        <span class="badge badge-pending"> <?= $aktif[$sonuc['aktif']]['title'] ?></span>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php if ($sonuc["aktif"] == 1) {
                                                    ?>
                                                        <span class="badge badge-complete"> <?= $aktif[$sonuc['aktif']]['title'] ?></span>
                                                    <?php
                                                    }
                                                    ?>


                                                    <?php if ($sonuc["aktif"] == 2) {
                                                    ?>
                                                        <span class="badge badge-danger"> <?= $aktif[$sonuc['aktif']]['title'] ?></span>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </td>


                                            <td class="text-center">

                                                <button class="btn btn-success btn-sm oku onay" type="button" onclick="change(<?= $sonuc['id'] ?>, 1);" name="onay" id="<?= $sonuc["id"] ?>">Onayla
                                                </button>

                                                <button class="btn btn-danger btn-sm oku red" type="button" onclick="change(<?= $sonuc['id'] ?>, 2);" name="red" id="<?= $sonuc["id"] ?>">
                                                    İptal Et
                                                </button>


                                                <?php if ($_SESSION["yetki"] == "1") {

                                                ?>

                                                    <a href="#" data-toggle="modal" data-target="#silModal<?= $sonuc["id"] ?>"><button class="btn btn-secondary btn-sm" type="button">Sil</button></a>




                                                    <!-- Modal -->
                                                    <div class="modal fade" id="silModal<?= $sonuc["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Silmek istediğinizden emin misiniz?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=havale" class="btn btn-danger">Sil</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
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

<!-- Okundu bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.oku').click(function(event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#okunmaSayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php',
                data: {
                    id: id,
                    tablo: 'havale'
                },
                success: function(result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#okunmaSayisi").text(sayi - 1);
                    }
                },
            });
        });

    });
</script>
<!-- Okundu bilgisi scripti -->


<!-- Onaylanan ödemeler sayı bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.onay').click(function(event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#onaySayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php', // onay.php ye yönlendirme yapılabilir.
                data: {
                    id: id,
                    tablo: 'havale'
                },
                success: function(result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#onaySayisi").text(sayi + 1);
                    }
                },
            });
        });

    });
</script>
<!-- Onaylanan ödemeler sayı bilgisi scripti -->


<!-- Reddedilen ödemeler sayı bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.red').click(function(event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#redSayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php', // red.php ye yönlendirme yapılabilir.
                data: {
                    id: id,
                    tablo: 'havale'
                },
                success: function(result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#redSayisi").text(sayi + 1);

                    }
                },
            });
        });

    });
</script>
<!-- Reddedilen ödemeler sayı bilgisi scripti bilgisi scripti -->


<!-- Tümünü sil butonu scripti -->

<script type="text/javascript">
    //Tümünü seçme ve silme işlemini yapan script kodları:
    $(document).ready(function() {
        $('#tumunuSec').on('click', function() {
            if ($('#tumunuSec:checked').length == $('#tumunuSec').length) {
                $('input.cbSil:checkbox').prop('checked', true);
            } else {
                $('input.cbSil:checkbox').prop('checked', false);

            }
        });
    });
</script>
<!-- Tümünü sil butonu scripti -->


<script type="text/javascript">
    function change(id, aktif) {

        $.ajax({
            type: 'POST',
            data: {
                id: id,
                aktif: aktif,
            },
            url: 'havale.php',
            success: function(e) {
                window.location.reload();
            }
        })
    }
</script>


<?php
if ($_POST) { /// Statü değiştirme
    $guncelleSorgu = $baglanti->prepare("Update havale set aktif=:aktif WHERE id=:id");
    $guncelle = $guncelleSorgu->execute([
        'aktif' => $_POST['aktif'],
        'id' => $_POST['id'],

    ]);
}
?>