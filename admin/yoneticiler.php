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

?>


<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">


        <main>
            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i>
                    Yöneticileri buradan görüntüleyebilir ve düzenleyebilirsiniz.</p>

                <a href="yoneticiekle.php" class="btn btn-dark shadow mb-3">Yönetici
                    Ekle </a>

                <div class="row row-cols-1 shadow rounded-end">


                    <div class="col bg-secondary bg-gradient text-white rounded-top">
                        <h6 class="p-3 pb-2">YÖNETİCİLER</h6>
                    </div>


                    <div class="table-responsive">
                        <div class="col">
                            <div class="col-sm-12 mb-5 mt-3">
                                <table id="" class="dataTable">
                                    <thead class="">
                                        <tr>

                                            <th class="text-center">Kullanıcı Adı</th>
                                            <th class="text-center">Şifre</th>
                                            <th class="text-center">Yetki</th>
                                            <th class="text-center">E-mail</th>
                                            <th class="text-center">Aktif mi?</th>
                                            <th class="text-center">İşlem</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        $sorgu = $baglanti->prepare("select * from yoneticiler");
                                        $sorgu->execute();
                                        while ($sonuc = $sorgu->fetch()) {
                                        ?>
                                            <tr>

                                                <td class="text-center"><?= $sonuc["kadi"] ?></td>
                                                <td class="text-center"><?= $sonuc["parola"] ?></td>
                                                <td class="text-center"><?= $sonuc["yetki"] == 1 ? 'Admin' : 'Normal Kullanıcı' ?></td>
                                                <td class="text-center"><?= $sonuc["email"] ?></td>

                                                <td class="text-center">

                                                    <link href="css/switch.css" rel="stylesheet" />
                                                    <label class="switch">
                                                        <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                                        <input type="checkbox" id='<?= $sonuc['id'] ?>' class="aktifPasif" <?= $sonuc['aktif'] == 1 ? 'checked' : '' ?> />
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>



                                                <td class="text-center">

                                                    <a href="yoneticiguncelle.php?id=<?= $sonuc["id"] ?>" <button class="btn btn-primary btn-sm" type="button">Düzenle
                                                        </button>
                                                    </a>





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
                                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=yoneticiler" class="btn btn-danger">Sil</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
                    tablo: 'yoneticiler',
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