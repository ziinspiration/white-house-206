<?php require 'partials/starter-top.php'; ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<?php require '../partials/style.php'; ?>
<style>
#map {
    height: 400px;
    width: 80%;
    margin: auto;
    border: 2px solid black;
    border-radius: 10px !important;
}

@media screen and (max-width: 550px) {
    .table {
        width: 95% !important;
        margin: auto !important;
    }

    .alamat {
        width: 80% !important;
        margin: auto !important;
    }
}
</style>
<?php require 'partials/navigasi.php'; ?>
<div class="container">
    <h2 class="text-center text-light mt-5 fw-pops mb-5">ALAMAT WHITE HOUSE</h2>
</div>
<div id="map"></div>

<div class="alamat text-light">
    <h3 class="text-center m-3">Alamat Lengkap</h3>
    <table class="table table-dark table-striped w-50 m-auto">
        <tbody>
            <tr>
                <th scope="row">Jalan</th>
                <td> : Jl. Cipedes Tengah</td>
            </tr>
            <tr>
                <th scope="row">No</th>
                <td> : 206</td>
            </tr>
            <tr>
                <th scope="row">Kelurahan</th>
                <td> : Sukagalih</td>
            </tr>
            <tr>
                <th scope="row">Kecamatan</th>
                <td> : Sukajadi</td>
            </tr>
            <tr>
                <th scope="row">Kota</th>
                <td> : Bandung</td>
            </tr>
            <tr>
                <th scope="row">Provinsi</th>
                <td> : Jawa Barat</td>
            </tr>
            <tr>
                <th scope="row">Kode Pos</th>
                <td> : 40163</td>
            </tr>
        </tbody>
    </table>
    <div class="alamat text-light d-flex flex-column m-auto w-25">
        <button class="btn-copy btn btn-light mt-2 mb-2" id="copyAddressBtn">Salin Alamat Lengkap <i
                class="bi bi-clipboard-fill"></i></button>
        <button class="btn-copy btn btn-light mb-5" id="copyMapLinkBtn">Salin Link Google Maps <i
                class="bi bi-clipboard-fill"></i></button>
    </div>
</div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([-6.8787741094185915, 107.59051255092693], 17);

    L.tileLayer("https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
    }).addTo(map);

    var marker = L.marker([-6.8787741094185915, 107.59051255092693]).addTo(map);
    marker.bindPopup(
            "Jl. Cipedes Tengah No.206, Kel. Sukagalih, Kec. Sukajadi, Kota Bandung, Jawa Barat, 40163")
        .openPopup();

    document.getElementById('copyAddressBtn').addEventListener('click', function() {
        copyToClipboard(
            "Jl. Cipedes Tengah No.206, Sukagalih, Kec. Sukajadi, Kota Bandung, Jawa Barat 40163",
            'Alamat berhasil disalin ke clipboard!');
    });

    document.getElementById('copyMapLinkBtn').addEventListener('click', function() {
        copyToClipboard("https://maps.app.goo.gl/sJzUyQBcKSgEstmi9",
            'Link Google Maps berhasil disalin ke clipboard!');
    });

    function copyToClipboard(text, successMessage) {
        navigator.clipboard.writeText(text).then(function() {
            var successNotification = document.createElement('div');
            successNotification.className = 'alert alert-success mt-2';
            successNotification.setAttribute('role', 'alert');
            successNotification.innerHTML = successMessage;
            document.body.appendChild(successNotification);

            setTimeout(function() {
                successNotification.remove();
            }, 2000);
        }).catch(function(err) {
            console.error('Gagal menyalin ke clipboard', err);
        });
    }
});
</script>

<?php require 'partials/starter-end.php'; ?>