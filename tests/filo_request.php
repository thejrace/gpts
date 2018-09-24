<?php

    $LOGIN_DATA = array(
        "dk_oasa" => "oas145",
        "dk_oasb" => "oas125",
        "dk_oasc" => "oas165"
    );

    $login = $_GET["bolge"];
    $password = $LOGIN_DATA[$login];
    $post_data = "login=".$login."&password=".$password;
    $login_url = 'https://filotakip.iett.gov.tr/login.php';

    $ch = curl_init();

    // login isteği
    curl_setopt($ch, CURLOPT_URL, $login_url );
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
    // loginde html i almiyoruz
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    // cookie jar ile cookie leri kaydediyoruz ( session )
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    // login
    curl_exec($ch);

    // verileri almak icin ikinci istek

    /*switch( $_GET['type'] ){
        case 'filo_orer_guncelle';
            //curl_setopt($ch, CURLOPT_URL, "http://filo5.iett.gov.tr/_FYS/000/sorgu.php?konum=ana&konu=sefer&otobus=".$_POST["kapi_no"]);
            curl_setopt($ch, CURLOPT_URL, "https://filotakip.iett.gov.tr/_FYS/000/sorgu.php?konum=ana&konu=sefer&otobus=".$_GET["kapi_kodu"]);
            break;

        case 'harita_koordinat_guncelle':
            curl_setopt($ch, CURLOPT_URL, "http://filo5.iett.gov.tr/_FYS/000/harita.php?konu=oto&hat=".$_GET["hat"]);
            break;

        case 'otobus_takip':
            curl_setopt($ch, CURLOPT_URL, "http://filo5.iett.gov.tr/_FYS/000/harita.php?konu=oto&oto=".$_GET['kapi_no']."&hat=".$_GET['hat']);
            break;

        case 'sofor_bilgileri_al':
            curl_setopt($ch, CURLOPT_URL, "http://filo5.iett.gov.tr/_FYS/000/uyg.0.2.php?abc=1&talep=5&grup=0&hat=".$_GET["kapi_no"]);
            break;
    }


    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    // cookie session kullancaz
    curl_setopt($ch, CURLOPT_COOKIESESSION, 1);

    // cookies.txt deki cookieleri kullanarak giris yapilmis gibi yapiyoruz requesti
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    $result = curl_exec($ch);
    echo $result;*/
    curl_close($ch);