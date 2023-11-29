<!-- index.php -->
<?php require 'partials/starter-top.php'; ?>
<?php require '../partials/style.php'; ?>
<?php require 'partials/navigasi.php'; ?>

<div class="container">
    <h2 class="text-center text-light mt-3 fw-pops">JADWAL PIKET</h2>
    <label class="text-light d-none" for="tanggalCari">Cari Jadwal Piket berdasarkan Tanggal:</label>
    <input class="d-none" type="date" id="tanggalCari" name="tanggalCari" onchange="cariJadwal()">
    <table class="table table-dark table-striped mt-5">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Petugas</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <tr class="d-none">
                <th scope="row"><span id="tanggalPencarian"></span></th>
                <td><span id="jadwalPencarian"></span></td>
                <td class="text-primary">Pencarian</td>
            </tr>
            <tr>
                <th scope="row"><span id="tanggalHariIni"></span></th>
                <td><span id="jadwalHariIni"></span></td>
                <td class="text-success">Hari Ini</td>
            </tr>
            <tr>
                <th scope="row"><span id="tanggalBesok"></span></th>
                <td><span id="jadwalBesok"></span></td>
                <td class="text-warning">Besok</td>
            </tr>
            <tr>
                <th scope="row"><span id="tanggalLusa"></span></th>
                <td><span id="jadwalLusa"></span></td>
                <td class="text-danger">Lusa</td>
            </tr>
            <tr>
                <th scope="row"><span id="tanggalDepan1"></span></th>
                <td><span id="jadwalDepan1"></span></td>
                <td class="text-info">3 Hari Ke Depan</td>
            </tr>
            <tr>
                <th scope="row"><span id="tanggalDepan2"></span></th>
                <td><span id="jadwalDepan2"></span></td>
                <td class="text-info">4 Hari Ke Depan</td>
            </tr>
            <tr>
                <th scope="row"><span id="tanggalDepan3"></span></th>
                <td><span id="jadwalDepan3"></span></td>
                <td class="text-info">5 Hari Ke Depan</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        updateSchedule();
        setInterval(updateSchedule, 60000);
    });

    function updateSchedule() {
        fetch('partials/schedule.php')
            .then(response => response.json())
            .then(data => {
                displaySchedule(data);
                displayDates(data);
            })
            .catch(error => {
                console.error('Terjadi kesalahan saat mengambil data:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            });
    }

    function displaySchedule(schedule) {
        const jadwalPencarian = document.getElementById('jadwalPencarian');
        const jadwalHariIni = document.getElementById('jadwalHariIni');
        const jadwalBesok = document.getElementById('jadwalBesok');
        const jadwalLusa = document.getElementById('jadwalLusa');
        const jadwalDepan1 = document.getElementById('jadwalDepan1');
        const jadwalDepan2 = document.getElementById('jadwalDepan2');
        const jadwalDepan3 = document.getElementById('jadwalDepan3');

        // Menampilkan data pencarian
        if (schedule.pencarian && schedule.pencarian.length > 0) {
            jadwalPencarian.textContent = schedule.pencarian;
        } else {
            jadwalPencarian.textContent = 'Tidak ada jadwal piket untuk tanggal tersebut.';
        }

        // Menampilkan data hari ini
        if (schedule.hari_ini && schedule.hari_ini.length > 0) {
            jadwalHariIni.textContent = schedule.hari_ini;
        } else {
            jadwalHariIni.textContent = 'Tidak ada jadwal piket hari ini.';
        }

        // Menampilkan data besok
        if (schedule.besok && schedule.besok.length > 0) {
            jadwalBesok.textContent = schedule.besok;
        } else {
            jadwalBesok.textContent = 'Tidak ada jadwal piket besok.';
        }

        // Menampilkan data lusa
        if (schedule.lusa && schedule.lusa.length > 0) {
            jadwalLusa.textContent = schedule.lusa;
        } else {
            jadwalLusa.textContent = 'Tidak ada jadwal piket lusa.';
        }

        // Menampilkan data 3 hari ke depan
        if (schedule.depan1 && schedule.depan1.length > 0) {
            jadwalDepan1.textContent = schedule.depan1;
        } else {
            jadwalDepan1.textContent = 'Tidak ada jadwal piket 3 hari ke depan.';
        }

        if (schedule.depan2 && schedule.depan2.length > 0) {
            jadwalDepan2.textContent = schedule.depan2;
        } else {
            jadwalDepan2.textContent = 'Tidak ada jadwal piket 3 hari ke depan.';
        }

        if (schedule.depan3 && schedule.depan3.length > 0) {
            jadwalDepan3.textContent = schedule.depan3;
        } else {
            jadwalDepan3.textContent = 'Tidak ada jadwal piket 3 hari ke depan.';
        }
    }

    function displayDates(schedule) {
        const tanggalPencarian = document.getElementById('tanggalPencarian');
        const tanggalHariIni = document.getElementById('tanggalHariIni');
        const tanggalBesok = document.getElementById('tanggalBesok');
        const tanggalLusa = document.getElementById('tanggalLusa');
        const tanggalDepan1 = document.getElementById('tanggalDepan1');
        const tanggalDepan2 = document.getElementById('tanggalDepan2');
        const tanggalDepan3 = document.getElementById('tanggalDepan3');

        // Menampilkan tanggal pencarian
        const tanggalCari = document.getElementById('tanggalCari').value;
        tanggalPencarian.textContent = formatDate(new Date(tanggalCari));

        // Menampilkan tanggal hari ini
        const tanggalHariIniValue = new Date();
        tanggalHariIni.textContent = formatDate(tanggalHariIniValue);

        // Menampilkan tanggal besok
        const tanggalBesokValue = new Date(tanggalHariIniValue.getTime() + 24 * 60 * 60 * 1000);
        tanggalBesok.textContent = formatDate(tanggalBesokValue);

        // Menampilkan tanggal lusa
        const tanggalLusaValue = new Date(tanggalHariIniValue.getTime() + 2 * 24 * 60 * 60 * 1000);
        tanggalLusa.textContent = formatDate(tanggalLusaValue);

        // Menampilkan tanggal 3 hari ke depan
        const tanggalDepan1Value = new Date(tanggalHariIniValue.getTime() + 3 * 24 * 60 * 60 * 1000);
        const tanggalDepan2Value = new Date(tanggalHariIniValue.getTime() + 4 * 24 * 60 * 60 * 1000);
        const tanggalDepan3Value = new Date(tanggalHariIniValue.getTime() + 5 * 24 * 60 * 60 * 1000);
        tanggalDepan1.textContent = formatDate(tanggalDepan1Value);
        tanggalDepan2.textContent = formatDate(tanggalDepan2Value);
        tanggalDepan3.textContent = formatDate(tanggalDepan3Value);
    }

    function formatDate(date) {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return date.toLocaleDateString('id-ID', options);
    }

    function cariJadwal() {
        const tanggalCari = document.getElementById('tanggalCari').value;
        const formattedTanggalCari = new Date(tanggalCari).toISOString().split('T')[0];

        fetch('partials/schedule.php?tanggal=' + formattedTanggalCari)
            .then(response => response.json())
            .then(data => {
                console.log('Data dari server:', data);

                if (data.pencarian || data.hari_ini || data.besok || data.lusa || data.depan1 || data.depan2 || data
                    .depan3) {
                    displaySchedule(data);
                    // Perbarui tanggal hari ini pada displayDates
                    displayDates({
                        ...data,
                        hari_ini: new Date(tanggalCari)
                    });
                } else if (data.error) {
                    // Menampilkan pesan error jika ada
                    alert(data.error);
                } else {
                    // Menampilkan pesan jika tidak ada jadwal untuk tanggal tersebut
                    alert('Tidak ada jadwal piket untuk tanggal tersebut.');
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan saat mengambil data:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            });
    }
</script>

<?php require 'partials/starter-end.php'; ?>