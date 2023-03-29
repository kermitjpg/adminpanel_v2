<?php
$sayfa = "Bankalar";
include("inc/header.php");

// Yetkisiz kullanıcının girmesini engellemek için etkinleştirebilirsiniz.
// if ($_SESSION["yetki"] != "1") {
//     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
//     echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
//             if(value.isConfirmed){window.location.href='index.php'}
//         })</script>";
//     exit;
// }


?>


<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">
        <main>
            <div class="container-fluid px-1 py-1 mt-1 mb-5">
                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Banka hesaplarını buradan düzenleyebilirsiniz.</p>
                <a href="bankaekle.php" class="btn btn-dark shadow mb-3">Yeni Banka Hesabı Ekle </a>
                <div class="row row-cols-1 shadow rounded-end">
                    <div class="col bg-secondary text-white rounded-top">
                        <h6 class="p-3 pb-2">BANKA HESAPLARI</h6>
                    </div>


                    <div class="table-responsive">
                        <div class="col text-black">
                            <div class="col-sm-12 mb-5 mt-3">
                                <table id="" class="dataTable">
                                    <thead class="">
                                        <tr>
                                            <th class="text-center">Banka</th>
                                            <th class="text-center">Hesap Sahibi</th>
                                            <th class="text-center">Hesap Numarası</th>
                                            <th class="text-center">Şube Kodu</th>
                                            <th class="text-center">Iban</th>
                                            <th class="text-center">Aktif mi?</th>
                                            <th class="text-center">İşlem</th>

                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        $sorgu4 = $baglanti->prepare("select * from bankalar");
                                        $sorgu4->execute();
                                        while ($sonuc4 = $sorgu4->fetch()) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $sonuc4["havale_hesap"] ?></td>
                                                <td class="text-center"><?= $sonuc4["havale_ad"] ?></td>
                                                <td class="text-center"><?= $sonuc4["havale_hesap_no"] ?></td>
                                                <td class="text-center"><?= $sonuc4["havale_sube"] ?></td>
                                                <td class="text-center"><?= $sonuc4["havale_iban"] ?></td>

                                                <td class="text-center">

                                                    <link href="css/switch.css" rel="stylesheet" />
                                                    <label class="switch">
                                                        <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                                        <input type="checkbox" id='<?= $sonuc4['id'] ?>' class="aktifPasif" <?= $sonuc4['aktif'] == 1 ? 'checked' : '' ?> />
                                                        <span class="slider round"></span>

                                                    </label>

                                                </td>



                                                <td class="text-center">

                                                    <a href="bankaguncelle.php?id=<?= $sonuc4["id"] ?>" <button class="btn btn-primary btn-sm" type="button">Düzenle
                                                        </button>
                                                    </a>




                                                    <a href="#" data-toggle="modal" data-target="#silModal<?= $sonuc4["id"] ?>"><button class="btn btn-danger btn-sm" type="button">Sil</button></a>




                                                    <!-- Modal -->
                                                    <div class="modal fade" id="silModal<?= $sonuc4["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <a href="sil.php?id=<?= $sonuc4["id"] ?>&tablo=bankalar" class="btn btn-danger">Sil</a>
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
                    tablo: 'bankalar',
                    durum: durum
                }, //datamızı yolluyoruz
                success: function(result) {
                    $('#sonuc4').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function() {
                    alert('Hata');
                }
            });
        });
    });
</script>