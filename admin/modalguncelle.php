<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<input type="hidden" onclick="mesajGoster()">
<script>
    function mesajGoster() {
        Swal.fire({
            title: 'Dikkat!',
            text: 'Bu ödeme yöntemi güncelleniyor! Lütfen canlı desteğe bağlanın.',
            icon: 'warning',
            confirmButtonText: 'Tamam',
            confirmButtonColor: "#000",
        })
    };
</script>


<?php
$connection = mysqli_connect('127.0.0.1', 'root', 'Biskuvi123');
$db = mysqli_select_db($connection, 'midyepanel_v2');


if (isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];

    $kadi = $_POST['kadi'];
    $parola = $_POST['parola'];
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $tel_no = $_POST['tel_no'];
    $tc_no = $_POST['tc_no'];
    $bakiye = $_POST['bakiye'];



    $query = "UPDATE kayitolan SET kadi='$kadi', parola='$parola', ad_soyad='$ad_soyad', email='$email', tel_no='$tel_no', tc_no='$tc_no', bakiye='$bakiye' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);


    if ($query_run) {
        header("location:kayitolan.php");
    } else {
        alert("Bir hata oluştu");
    }
}

?>