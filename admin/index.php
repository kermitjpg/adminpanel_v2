<?php
$sayfa = "Anasayfa";
include("inc/header.php");
include("inc/fonksiyon.php");
include("inc/ayar.php");
?>



<!-- Content -->
<div class="content" style="height: 105vh;">
    <!-- Animated -->
    <div class="animated fadeIn">


        <main>
            <div class="container-fluid px-1 py-1">

                <p class="col pt-0 px-0"><i class="fa-solid fa-circle-info fs-4"></i> Genel bilgileri buradan görüntüleyebilirsiniz.</p>

                <div class="row row-cols-1 d-flex justify-content-center shadow rounded-end">
                    <div class="col bg-secondary bg-gradient text-white rounded">
                        <h6 class="p-3 pb-2">GENEL BİLGİLER</h6>
                    </div>
                </div>

                <div class="row bg-light">
                    <div class="col p-5">
                        <!-- <h3 class="text-center p-3 pb-2">Toplam Kasa Tutarı : 2316₺</h3> -->



                        <?php
                        sayac_bilgiler();
                        ?>



                    </div>
                </div>
            </div>
        </main>



    </div>
    <!-- .animated -->
</div>
<!-- /.content -->


<?php
include("inc/footer.php");
?>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>