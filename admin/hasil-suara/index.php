<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Suara Realtime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .loading-placeholder {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
        }

        .countdown {
            font-size: 48px;
            color: #dc3545;
            margin-top: 20px;
            animation: fade 1s ease-in-out;
        }

        /* Animasi fade untuk nomor mundur */
        @keyframes fade {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }

            100% {
                opacity: 0;
                transform: scale(1.5);
            }
        }

        .main-content {
            display: none;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .table-primary {
            background-color: #ffffff;
        }

        th {
            background-color: #0d6efd;
            color: white;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>


    <!-- Placeholder loading -->
    <div id="loading" class="loading-placeholder">
        Memuat halaman, harap tunggu...
        <div id="countdown" class="countdown">60</div>
    </div>

    <div id="main-content" class="main-content">
        <div class="container py-4">
            <h1>Hasil Suara Realtime</h1>
            <div class="table-responsive shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Calon Formatur</th>
                            <th scope="col">Suara</th>
                        </tr>
                    </thead>
                    <tbody id="kandidat-table">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
        let countdownValue = 60;
        const countdownElement = document.getElementById('countdown');

        // Fungsi untuk memperbarui countdown dengan animasi
        const updateCountdown = () => {
            countdownElement.textContent = countdownValue;
            countdownElement.style.animation = 'none'; // Reset animasi
            setTimeout(() => {
                countdownElement.style.animation = ''; // Aktifkan kembali animasi
            }, 60);
        };

        const countdownInterval = setInterval(() => {
            countdownValue--;
            updateCountdown();

            // Ketika countdown selesai, tampilkan konten utama
            if (countdownValue <= 0) {
                clearInterval(countdownInterval); // Hentikan interval
                document.getElementById('loading').style.display = 'none';
                document.getElementById('main-content').style.display = 'block';

                // Memuat data kandidat
                loadKandidat();
            }
        }, 1000);



        // Fungsi untuk memuat data kandidat
        function loadKandidat() {
            axios.get('./get_kandidat.php')
                .then(response => {
                    const data = response.data;
                    const tableBody = document.getElementById('kandidat-table');
                    tableBody.innerHTML = ""; // Kosongkan tabel sebelum diisi

                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            const row = `
                                <tr>
                                    <th scope="row">${index + 1}</th>
                                    <td>${item.nama_calon}</td>
                                    <td>${item.suara}</td>
                                </tr>
                            `;
                            tableBody.innerHTML += row;
                        });
                    } else {
                        tableBody.innerHTML = `
                            <tr>
                                <td colspan="3" class="no-data">Belum ada data</td>
                            </tr>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Muat data pertama kali
        loadKandidat();

        // Perbarui data setiap 5 detik
        setInterval(loadKandidat, 5000);
    </script>
</body>

</html>