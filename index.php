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
            setTimeout(function () { 
	            swal({
	                  title: "Musywil",
	                  text:  "Akun Ini Tidak Terdaftar",
	                  type: "warning",
	                  timer: 3200,
	                  showConfirmButton: true

	            });   
	            },10);  
	            window.setTimeout(function(){ 
	            window.location.replace("index.php");
	            } ,3000);
            </script>';
      }
}


?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <title>Musyran</title>
      <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
      <link rel="stylesheet" href="./assets/css/custom.css" />
      <link href="./assets/js/index.js">
      <link rel="icon" type="image/png" href="./assets/img/ipm.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

      <style type="text/css">
            /* .utama {
                  position: fixed;
            } */


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

            /* .diam {
                  display: flex;
                  align-items: center;
                  border: 2px solid green;

            } */
      </style>
</head>

<body class="utama">
      <div class="banner">
            <div class="hero">
                  <img src="assets/img/background.jpg" alt="" draggable="false" oncontextmenu="return false;">
            </div>
      </div>
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


                  </div>
            </div>
      </div>
      <script type="text/javascript" src="./assets/js/jquery-2.2.3.min.js"></script>
      <script type="text/javascript" src="./assets/js/jquery-cycle.min.js"></script>
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>     

</html>