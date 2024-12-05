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

    <script>
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