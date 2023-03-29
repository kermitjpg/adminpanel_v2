<?php




function p($par, $st = false)
{
    if ($st) {
        return htmlspecialchars(addslashes(trim($_POST[$par])));
    } else {
        return addslashes(trim($_POST[$par]));
    }
}

function g($par)
{
    global $baglan;
    return str_replace('<', ' ', strip_tags(mysqli_real_escape_string($baglan, htmlspecialchars(trim($_GET[$par])))));
}

function query($query)
{
    global $baglan;
    return mysqli_query($baglan, $query);
}

function row($query)
{
    return mysqli_fetch_assoc($query);
}

function rows($query)
{
    return mysqli_num_rows($query);
}


function ip_sehir_getir($ip)
{
    $content = file_get_contents('http://www.ipsorgu.com/?ip=' . $ip);
    if (preg_match('#\<title>(.*?)\</title>#', $content, $regs)) {
        $city = $regs[1];
    }
    if ($city != '') {
        return iconv('windows-1254', 'UTF-8', explode('lke: ', explode('-', $city)[0])[1]);
    } else {
        return 'yok';
    }
    /*$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        return $details->city?$details->city:'Lokasyon Belirlenemiyor';*/
}

function sayac_ayar()
{
    $ip = $_SERVER['REMOTE_ADDR']; //Localhost uzerinde calistiginda ip degeri '::1' seklinde doner. Sunucuya atildiginda dogru ip degeri gosterilir.
    $zaman = time();
    $buguntarih = date('Y-m-d');
    $sure_siniri = $zaman - 60 * 5;
    $kayit_sql = row(query('SELECT count(id) as kayit_sayisi FROM sayac_ip WHERE tarih=\'' . $buguntarih . '\' AND ip=\'' . $ip . '\''));
    if ($kayit_sql['kayit_sayisi'] == 0) { //bugün bu ip ye sahip kullanıcı siteye girmediyse
        query('INSERT INTO sayac_ip (tarih, tiklama, ip) VALUES (\'' . $buguntarih . '\',1,\'' . $ip . '\')'); //bugünün tarihini ve kullancıının ip sini kaydet
        $toplam_kayit_sayisi = rows(query('SELECT id FROM sayac_toplam'));
        if ($toplam_kayit_sayisi == 0) {
            query('INSERT INTO sayac_toplam(toplam_tekil,toplam_cogul) VALUES(1,1)');
        } else {
            query('UPDATE sayac_toplam SET toplam_tekil=toplam_tekil+1, toplam_cogul=toplam_cogul+1 WHERE id=1 LIMIT 1');
        }
    } else {
        query('UPDATE sayac_ip SET tiklama=tiklama+1 WHERE tarih=\'' . $buguntarih . '\' and ip=\'' . $ip . '\''); //bugün siteye bu kullancıı kaç kere girmiş, tıklama sayısını kaydet
        query('UPDATE sayac_toplam SET toplam_cogul=toplam_cogul+1 WHERE id=1 LIMIT 1');
    }
    query('DELETE FROM sayac_online WHERE tarih < \'' . $sure_siniri . '\''); //5 dakika boyunca sitede aktif olmayan kullanıcıları online listesinden (sayac_online tablosundan) çıkart
    $online_kontrol = row(query('SELECT count(id) as online_kontrol FROM sayac_online WHERE ip=\'' . $ip . '\''));
    if ($online_kontrol['online_kontrol'] == 0) { //kullanıcının ip si sayac_online tablosunda yok ise
        query('INSERT INTO sayac_online (ip, tarih) VALUES (\'' . $ip . '\',\'' . $zaman . '\')'); //kullanıcıyı sayac_online tablosuna ekle
    } else {
        query('UPDATE sayac_online SET tarih=\'' . $zaman . '\' WHERE ip=\'' . $ip . '\''); //sayac_online tablosundaki tarih alanını şu an ki zaman ile güncelle
    }
}

function sayac_bilgiler()
{

    $buguntarih = date('Y-m-d');
    $secilen_gun = g('secilen_gun') ? g('secilen_gun') : $buguntarih;
    $online_sql = row(query('SELECT count(id) as online_sayisi FROM sayac_online'));
    $online_ziyaretci_sayisi = $online_sql['online_sayisi'];
    $toplam_tc_cek = row(query('SELECT * FROM sayac_toplam WHERE id=1 LIMIT 1'));
    $toplam_tekil_sayisi = $toplam_tc_cek['toplam_tekil'];
    $toplam_cogul_sayisi = $toplam_tc_cek['toplam_cogul'];
    $secilen_gun_sql = row(query('SELECT COUNT(ip) AS ttoplam, SUM(tiklama) AS ctoplam FROM sayac_ip WHERE tarih=\'' . $secilen_gun . '\''));
    $bugun_tekil = $secilen_gun_sql['ttoplam'];
    $bugun_cogul = $secilen_gun_sql['ctoplam'];
?>


    <?php
    include("../inc/vt.php");

    $havaleKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM havale WHERE aktif=1");
    $havaleKasa->execute();
    $havaleTopla = $havaleKasa->fetch();


    $paparaKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM papara WHERE aktif=1");
    $paparaKasa->execute();
    $paparaTopla = $paparaKasa->fetch();


    $payfixKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM payfix WHERE aktif=1");
    $payfixKasa->execute();
    $payfixTopla = $payfixKasa->fetch();


    $kriptoKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM kripto WHERE aktif=1");
    $kriptoKasa->execute();
    $kriptoTopla = $kriptoKasa->fetch();


    $mefeteKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM mefete WHERE aktif=1");
    $mefeteKasa->execute();
    $mefeteTopla = $mefeteKasa->fetch();


    $havaleToplam = $havaleTopla["tutar"];
    $paparaToplam = $paparaTopla["tutar"];
    $payfixToplam = $payfixTopla["tutar"];
    $mefeteToplam = $mefeteTopla["tutar"];
    $kriptoToplam = $kriptoTopla["tutar"];
    $tumToplam = $havaleToplam + $paparaToplam + $payfixToplam + $mefeteToplam + $kriptoToplam;
    ?>



    <!-- Widgets  -->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">₺<span class="count"><?= $tumToplam ?></span></div>
                                <div class="stat-heading">Toplam Kasa Tutarı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-3">
                            <i class="pe-7s-browser"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?= $toplam_cogul_sayisi ?></span></div>
                                <div class="stat-heading">Toplam Sayfa Görüntülenme Sayısı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"><?= $toplam_tekil_sayisi ?></span></div>
                                <div class="stat-heading">Giriş Yapan Kullanıcı Sayısı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <img src="images/Bank-PNG-Image.png" style="max-height: 35px;" />
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">₺<span class="count"><?= $havaleToplam ?></span></div>
                                <div class="stat-heading">Havale Toplam Kasa Tutarı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <img src="images/Papara_Logo.png" style="max-height: 20px;" />
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">₺<span class="count"><?= $paparaToplam ?></span></div>
                                <div class="stat-heading">Papara Toplam Kasa Tutarı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <img src="images/payfix.png" style="max-height: 20px;" />
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">₺<span class="count"><?= $payfixToplam ?></span></div>
                                <div class="stat-heading">PayFix Toplam Kasa Tutarı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <img src="images/mefete.png" style="max-height: 9px;" />
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">₺<span class="count"><?= $mefeteToplam ?></span></div>
                                <div class="stat-heading">Mefete Toplam Kasa Tutarı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <img src="images/kripto.png" style="max-height: 40px; margin-left: -20px;" />
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">₺<span class="count"><?= $kriptoToplam ?></span></div>
                                <div class="stat-heading">Kripto Toplam Kasa Tutarı</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>


<?php
}
?>