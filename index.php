<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8">
      <title>Musywil IPM RIAU 2024</title>
      <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
      <link rel="stylesheet" href="./assets/css/custom.css" />
      <link href="./assets/js/index.js">
      <link rel="icon" type="image/png" href="./assets/img/ipm.png">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

      <style type="text/css">
            .utama {
                  position: fixed;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;

                  display: flex;
                  flex-direction: column;
                  justify-content: center;
                  align-items: center;
            }

            .top-img {
                  z-index: 5;
                  position: fixed;
                  top: -20px;
                  width: 100%;
                  height: 100px;
                  background-image: url("assets/img/footer.png");
                  background-repeat: repeat;
                  background-size: contain;
            }

            .bottom-img {
                  z-index: 5;
                  position: fixed;
                  bottom: -20px;
                  width: 100%;
                  height: 100px;
                  background-image: url("assets/img/footer.png");
                  background-repeat: repeat;
                  background-size: contain;
            }

            .img-thanks {
                  padding-top: 3rem;
                  max-width: 200px;
                  width: 100%;
                  max-height: 400px;
            }

            .kata {
                  padding-bottom: 100px;
            }

            .kata h2 {
                  color: #b79007;
            }

            .sdm {
                  margin-top: 10px
            }

            .btn-thanks {
                  color: green;
                  background-color: lightblue;
                  text-decoration: none;
                  padding: 10px;
                  border-radius: 10px;
                  margin-top: 90px;
            }

            .btn-thanks:hover {
                  color: white;
                  background-color: green;
                  transition: 0.5s;
                  transition-delay: 0.2s;
                  text-decoration: none;
            }

            .header {
                  position: fixed;
                  display: flex;
                  flex-direction: row;
                  justify-content: space-between;

                  align-items: center;
                  width: 100%;
            }

            .logo-ipm {
                  width: 80px;
            }

            .logo-musywil {
                  width: 100px;
            }

            form {
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  flex-direction: column;

                  background-color: #ddd;
                  border-radius: 20px;
                  padding: 20px;
            }

            video {
                  width: 250px;
                  border-radius: 20px;
                  margin-bottom: 20px;
            }

            /* .diam {
                  display: flex;
                  align-items: center;
                  border: 2px solid green;

            } */
      </style>
</head>

<body class="utama">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
      <?php
      define('BASEPATH', dirname(__FILE__));
      session_start();

      if (isset($_SESSION['siswa'])) {
            header('location:./vote.php');
      }
      if (isset($_POST['submit'])) {

            require('include/connection.php');

            $nis     = $_POST['nis'];
            $thn     = date('Y');
            $dpn     = date('Y') + 1;
            $periode = $thn . '/' . $dpn;

            $cek = $con->prepare("SELECT * FROM t_pemilih WHERE nis = ? && periode = ?") or die($con->error);
            $cek->bind_param('ss', $nis, $periode);
            $cek->execute();
            $cek->store_result();

            if ($cek->num_rows() > 0) {

                  echo '<script type="text/javascript">
                              Swal.fire({
                                    title: "Musywil PW IPM RIAU",
                                    text: "Anda Sudah Memberikan Suara",
                                    icon: "error",
                                    confirmButtonText: "Kembali",
                              })
                              .then((result) => {
                                    if (result.isConfirmed) {
                                          history.back();
                                    }
                              });
                        </script>';
            } else {

                  $sql = $con->prepare("SELECT * FROM t_user WHERE id_user = ? && pemilih = 'Y'") or die($con->error);
                  $sql->bind_param('s', $nis);
                  $sql->execute();
                  $sql->store_result();

                  if ($sql->num_rows() > 0) {
                        $sql->bind_result($id, $user, $kelas, $jk, $pemilih);
                        $sql->fetch();

                        $_SESSION['siswa'] = $id;

                        header('location:./vote.php');
                  } else {

                        echo '<script type="text/javascript">
                              Swal.fire({
                                    title: "Musywil PW IPM RIAU",
                                    text: "Akun Ini Tidak Terdaftar",
                                    icon: "error",
                                    confirmButtonText: "Kembali",
                              })
                              .then((result) => {
                                    if (result.isConfirmed) {
                                          history.back();
                                    }
                              });
                        </script>';
                  }
            }
      }

      if (isset($_POST['submit'])) {
            require('include/connection.php');

            $nis     = $_POST['nis'];
            $thn     = date('Y');
            $dpn     = date('Y') + 1;
            $periode = $thn . '/' . $dpn;

            // Hapus pemeriksaan untuk suara yang ada
            // $cek = $con->prepare("SELECT * FROM t_pemilih WHERE nis = ? && periode = ?") or die($con->error);
            // $cek->bind_param('ss', $nis, $periode);
            // $cek->execute();
            // $cek->store_result();

            // Sebagai gantinya, perbarui logika untuk memungkinkan beberapa suara
            $sql = $con->prepare("SELECT * FROM t_user WHERE id_user = ? && pemilih = 'Y'") or die($con->error);
            $sql->bind_param('s', $nis);
            $sql->execute();
            $sql->store_result();

            if ($sql->num_rows() > 0) {
                  $sql->bind_result($id, $user, $kelas, $jk, $pemilih);
                  $sql->fetch();

                  $_SESSION['siswa'] = $id;

                  header('location:./vote.php');
            } else {

                  echo '<script type="text/javascript">
                  Swal.fire({
                        title: "Musywil PW IPM RIAU",
                        text: "Akun Ini Tidak Terdaftar",
                        icon: "error",
                        confirmButtonText: "Kembali",
                  })
                  .then((result) => {
                        if (result.isConfirmed) {
                              history.back();
                        }
                  });
            </script>';
            }
      }


      ?>

      <div class="top-img"></div>
      <div class="container-fluid">
            <div class="row">
                  <div class="col-md-12">
                        <?php
                        if (isset($_GET['page'])) {
                              switch ($_GET['page']) {
                                    case 'thanks':
                                          include('./thanks.php');
                                          break;

                                    default:
                                          include('./form.php');
                                          break;
                              }
                        } else {
                              include('./form.php');
                        }
                        ?>

                        <!-- <footer>
                                    Copyright © Panlihwil IPM Riau 2024
                              </footer> -->
                  </div>
            </div>
      </div>
      <div class="bottom-img"></div>
      <script type="text/javascript" src="./assets/js/jquery-2.2.3.min.js"></script>
      <script type="text/javascript" src="./assets/js/jquery-cycle.min.js"></script>
      <script type="text/javascript" src="./assets/js/cam.js"></script>
      <script type="text/javascript">
            $(document).ready(function() {
                  $('#content-slider').cycle({
                        fx: 'fade',
                        speed: 1000,
                        timeout: 500
                  });
            });
            document.addEventListener("contextmenu", function(event) {
                  event.preventDefault();
            }, false);
      </script>
</body>

</html>