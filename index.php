<?php require 'partials/starter-top.php'; ?>
<?php
date_default_timezone_set('Asia/Jakarta');

$jam = date('H');

if ($jam >= 3 && $jam < 10) {
    $salam = 'Selamat Pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Selamat Siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Selamat Sore';
} else {
    $salam = 'Selamat Malam';
}

$jamSekarang = date('H:i:s');

?>
<?php require 'partials/style.php'; ?>
<style>
    body {
        background: url(assets/images/5158083.jpg);

    }

    @media screen and (max-width:600px) {
        .btm h1 {
            font-size: 25px !important;
            text-align: center !important;
        }
    }
</style>
<?php require 'partials/navigasi.php'; ?>

<div class="container-beranda d-flex flex-column mt-5">
    <div class="top m-auto">
        <h1 class="text-light mt-3">Hallo, <span id="greeting" class="text-light"></span></h1>
    </div>
    <div class="btm m-auto">
        <h1 class="text-light">Selamat Datang Di Website</h1>
        <img class="d-flex m-auto" src="assets/images/logo-wh.png" alt="">
    </div>


</div>

<script>
    var greetingElement = document.getElementById('greeting');
    var greetings = ["<?= $salam; ?>"];
    var index = 0;

    function changeGreeting() {
        var greeting = greetings[index];
        var characters = greeting.split("");

        var interval = setInterval(function() {
            greetingElement.textContent += characters.shift();

            if (characters.length === 0) {
                clearInterval(interval);
                setTimeout(function() {
                    greetingElement.textContent = "";
                    index = (index + 1) % greetings.length;
                    changeGreeting();
                }, 2500);
            }
        }, 150);
    }

    changeGreeting();
</script>
<?php require 'partials/starter-end.php'; ?>