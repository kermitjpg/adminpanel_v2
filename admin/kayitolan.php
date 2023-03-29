<?php
$sayfa = "Kayıt Olan Kullanıcılar";
include("inc/header.php");
// modal güncelleme için bootstrap 4 kullanıldı


/* Tümünü sil butonu kodları */
if (isset($_POST['sil']) && $_SESSION["yetki"] == "1") {
    //Seçilenleri pdo ile toplu silme kodu:
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $baglanti->prepare('DELETE FROM kayitolan WHERE id IN (' . $silinecekler . ')');
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
            window.location.href = 'kayitolan.php'
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
            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i>
                    Kayıt olan kullanıcıları buradan görüntüleyebilir, kullanıcı
                    bilgilerini düzenleyebilir ve bakiye işlemlerini yapabilirsiniz.</p>

                <div class="row row-cols-1 shadow rounded-end">
                    <div class="col bg-secondary text-white rounded-top">
                        <h6 class="p-3 pb-2">YENİ KULLANICILAR</h6>
                    </div>

                    <div class="table-responsive">
                        <div class="col text-black">
                            <div class="col-sm-12 mb-5 mt-3">
                                <form method="post" id="form">
                                    <table id="" class="dataTable">
                                        <!-- id'ye datatablesSimple eklenirse sayfalama yapar. myTable ise türkçeleştirir. -->

                                        <?php if ($_SESSION["yetki"] == "1") { /* Tümünü sil butonu kodları*/

                                        ?>

                                            <div class="mt-2">

                                                <a href="#" data-toggle="modal" data-target="#silModal" class="btn btn-danger"><span class="fa fa-trash"></span> Tümünü
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


                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <!-- Tümünü sil butonu kodları -->


                                        <thead class="">
                                            <tr>


                                                <!-- Tümünü sil butonu kodları -->
                                                <input type="checkbox" id="tumunuSec" onclick="TumunuSec();" value="" style="display: none;" checked>
                                                <!-- Tümünü sil butonu kodları -->


                                                <th class="text-center">ID</th>
                                                <th class="text-center">Kullanıcı Adı</th>
                                                <th class="text-center">Şifre</th>
                                                <th class="text-center">Ad Soyad</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Telefon Numarası
                                                </th>
                                                <th class="text-center">TC Kimlik Numarası
                                                </th>
                                                <th class="text-center">Bakiye</th>
                                                <th class="text-center">IP Adresi</th>
                                                <th class="text-center">Aktif mi?</th>
                                                <th class="text-center">İşlem</th>

                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $sorgu = $baglanti->prepare("select * from kayitolan");
                                            $sorgu->execute();
                                            while ($sonuc = $sorgu->fetch()) {
                                            ?>
                                                <tr>

                                                    <!-- Tümünü sil butonu kodları -->
                                                    <input class="cbSil" type="checkbox" name="sil[]" value="<?= $sonuc['id']; ?>" style="display: none;" checked>
                                                    <!-- Tümünü sil butonu kodları -->


                                                    <td class="text-center"><?= $sonuc["id"] ?></td>
                                                    <td class="text-center"><?= $sonuc["kadi"] ?></td>
                                                    <td class="text-center"><?= $sonuc["parola"] ?></td>
                                                    <td class="text-center"><?= $sonuc["ad_soyad"] ?></td>
                                                    <td class="text-center"><?= $sonuc["email"] ?></td>
                                                    <td class="text-center"><?= $sonuc["tel_no"] ?></td>
                                                    <td class="text-center"><?= $sonuc["tc_no"] ?></td>
                                                    <td class="text-center"><?= $sonuc["bakiye"] ?></td>
                                                    <td class="text-center"><?= $sonuc["ip"] ?></td>

                                                    <td class="text-center">

                                                        <link href="css/switch.css" rel="stylesheet" />
                                                        <label class="switch">
                                                            <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                                            <input type="checkbox" id='<?= $sonuc['id'] ?>' class="aktifPasif" <?= $sonuc['aktif'] == 1 ? 'checked' : '' ?> />
                                                            <span class="slider round"></span>
                                                        </label>

                                                    </td>

                                                    <td class="text-center">

                                                        <!--Modal ile güncelleme butonu-->
                                                        <button type="button" class="btn btn-primary btn-sm editbtn">
                                                            Düzenle
                                                        </button>
                                                        <!--Modal ile güncelleme butonu-->


                                                        <?php if ($_SESSION["yetki"] == "1") {

                                                        ?>

                                                            <a href="#" data-toggle="modal" data-target="#silModal<?= $sonuc["id"] ?>"><button class="btn btn-danger btn-sm" type="button">Sil</button></a>




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
                                                                            <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=kayitolan" class="btn btn-danger">Sil</a>
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>



<script type="text/javascript">
    $(document).ready(function() {
        $('.aktifPasif').click(function(event) {
            var id = $(this).attr("id"); //id değerini alıyoruz

            var durum = ($(this).is(':checked')) ? '1' : '0';
            //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

            $.ajax({
                type: 'POST',
                url: 'inc/aktifPasif.php', //işlem yaptığımız sayfayı belirtiyoruz
                data: {
                    id: id,
                    tablo: 'kayitolan',
                    durum: durum
                }, //datamızı yolluyoruz
                success: function(result) {
                    $('#sonuc').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function() {
                    alert('Hata');
                }
            });
        });
    });
</script>


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





<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<!--Modal ile güncelleme yapılmadığı zaman kayitliolankullaniciguncelle.php kullanılabilir. -->
<!--Modal ile veri güncelleme -->
<div class="modal" tabindex="-1" role="dialog" id="editmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Güncelle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modalguncelle.php" method="post" id="gosterform">

                    <input type="hidden" name="update_id" id="update_id">

                    <div class="form-group mt-2 mb-3">
                        <label>Kullanıcı Adı</label>
                        <input type="text" name="kadi" id="kadi" required class="form-control">
                    </div>

                    <div class="form-group mt-2 mb-3">
                        <label>Şifre</label>
                        <input type="text" name="parola" id="parola" required class="form-control">
                    </div>

                    <div class="form-group mt-2 mb-3">
                        <label>Ad Soyad</label>
                        <input type="text" name="ad_soyad" id="ad_soyad" required class="form-control">
                    </div>

                    <div class=" form-group mt-2 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="email" required class="form-control">
                    </div>

                    <div class=" form-group mt-2 mb-3">
                        <label>Telefon Numarası</label>
                        <input type="text" name="tel_no" id="tel_no" required class="form-control">
                    </div>

                    <div class=" form-group mt-2 mb-3">
                        <label>TC Kimlik Numarası</label>
                        <input type="text" name="tc_no" id="tc_no" required class="form-control">
                    </div>

                    <div class=" form-group mt-2 mb-3">
                        <label>Bakiye</label>
                        <input type="text" name="bakiye" id="bakiye" required autocomplete="off" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="updatedata" id="updatedata" class="btn btn-success">Güncelle</button>
            </div>
        </div>
    </div>
</div>


<!--Modal ile veri güncelleme -->
<script>
    $(document).ready(function() {
        $('.editbtn').on('click', function() {

            $('#editmodal').modal(
                'show'
            );

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#kadi').val(data[1]);
            $('#parola').val(data[2]);
            $('#ad_soyad').val(data[3]);
            $('#email').val(data[4]);
            $('#tel_no').val(data[5]);
            $('#tc_no').val(data[6]);
            $('#bakiye').val(data[7]);


        })

    })
</script>
<!--Modal ile veri güncelleme -->


<?php
include("inc/footer.php");
?>