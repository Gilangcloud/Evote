<?php
define("BASEPATH", dirname(__FILE__));
session_start();
if (!isset($_SESSION['siswa'])) {
   header('location:./index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Musywil</title>
   <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
   <link rel="stylesheet" href="./assets/css/animate.css" />
   <link href="./assets/js/index.js">
   <style media="screen">
      body {
         background-color: #F16D00;
         color: white;
      }

      .img {
         height: 200px;
         width: 200px;
      }

      .button.success {
         background-color: #059f3e;
         color: #ebebeb;
         padding: 30px;
      }

      .button.success:hover,
      .button.success:focus {
         background-color: #22bb5b;
         color: #fefefe;
      }

      .nama {
         position: absolute;
         background: rgba(35, 35, 35, 0.624);
         width: 196px;
         top: 178px;
         font-size: 16px;
         padding: 3px 0px;
      }

      .checkbox-container {
         display: block;
         position: relative;
         padding-left: 40px;
         margin-bottom: 12px;
         margin-top: 10px;
         cursor: pointer;
         font-size: 16px;
         -webkit-user-select: none;
         -moz-user-select: none;
         -ms-user-select: none;
         user-select: none;
         background-color: #059f3e;
         color: white;
         padding: 5px;
      }

      /* Hide the browser's default checkbox */
      .checkbox-container input {
         position: absolute;
         opacity: 0;
         cursor: pointer;
         height: 0;
         width: 0;
      }


      .checkmark {
         position: absolute;
         top: 5px;
         left: 5px;
         height: 20px;
         width: 20px;
         background-color: #fff;
         border: 2px solid white;
         border-radius: 5px;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .checkbox-container:hover input~.checkmark {
         background-color: #ffffff;
      }

      /* When the checkbox is checked, add a blue background */
      .checkbox-container input:checked~.checkmark {
         background-color: #fff;
      }

      /* Create the checkmark/indicator (hidden when not checked) */
      .checkmark:after {
         content: "";
         position: absolute;
         display: none;
      }

      /* Show the checkmark when checked */
      .checkbox-container input:checked~.checkmark:after {
         display: block;
      }

      /* Style the checkmark/indicator */
      .checkbox-container .checkmark:after {
         left: 4px;
         /* adjust this value to center the checkmark horizontally */
         top: 2px;
         /* adjust this value to center the checkmark vertically */
         width: 5px;
         height: 10px;
         border: solid #059f3e;
         border-width: 0 3px 3px 0;
         -webkit-transform: rotate(45deg);
         -ms-transform: rotate(45deg);
         transform: rotate(45deg);
      }

      .beri-suara {
         background-color: white;
         /* initial green color */
         color: #0b9a03;
         position: relative;
         bottom: 10px;
      }

      .beri-suara.clicked {
         background-color: #b43a23;
         color: #000000;
      }
   </style>
</head>

<body>
   <div class="container">
      <?php
      require('./include/connection.php');

      $thn     = date('Y');
      $dpn     = date('Y') + 1;
      $periode = $thn . '/' . $dpn;

      $sql = $con->prepare("SELECT * FROM t_kandidat WHERE periode = ?") or die($con->error);
      $sql->bind_param('s', $periode);
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows() > 0) {
         $numb = $sql->num_rows();
         echo '<div class="text-center" style="padding-top:20px;">
                     <h2>DAFTAR CALON FORMATUR PW IPM RIAU ' . $periode . '</h2>
                  </div>
                  <hr />';

         if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger">' . $_GET['error'] . '</div>';
         }

         echo '<form action="submit.php" method="post">';

         echo '<div class="row">';

         echo '<div class="col-md-10 col-md-offset-1">';

         for ($i = 1; $i <= $numb; $i++) {
            $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
            $sql->fetch();
      ?>
            <div class=" col-md-3">
               <section class="wow fadeInDown" data-wow-delay="<?php echo $i; ?>s">
                  <div class="thumbnail">
                     <div class="text-center">
                        <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="img" draggable="false" oncontextmenu="return false;">
                        <!-- <p class="nama"><?php echo $nama; ?></p> -->
                        <div class="caption">
                           <!-- <a href="./detail.php?id=<?php echo $id; ?>" class="btn btn-warning btn-block">Lihat Visi Misi</a> -->
                           <!-- <input type="checkbox" name="candidates[]" value="<?php echo $id; ?>">
                                 <label>Pilih</label> -->
                           <label class="checkbox-container">
                              <input type="checkbox" name="candidates[]" value="<?php echo $id; ?>">
                              <span class="checkmark"></span>
                              Pilih
                           </label>

                           <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['siswa']; ?>">

                        </div>
                     </div>
                  </div>
               </section>
            </div>

      <?php
         }

         echo '</div>';

         echo '<button type="submit" class="beri-suara btn btn-light btn-block ">Beri Suara</button>';
      } else {

         echo '<div class="callout warning">
                     <h2>Belum Ada Calon Ketua</h2>
                     <a href="logout.php">Kembali</a>
                  </div>';
      }

      echo '</form>';
      echo '</div>';
      ?>
   </div>


   <script type="text/javascript" src="./assets/js/jquery.js"></script>
   <script type="text/javascript" src="./assets/js/wow.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         var maxCandidates = 10;
         var selectedCandidates = [];

         $('input[type="checkbox"]').on('change', function() {
            var candidateId = $(this).val();
            if ($(this).is(':checked')) {
               if (selectedCandidates.length < maxCandidates) {
                  selectedCandidates.push(candidateId);
               } else {
                  $(this).prop('checked', false);
                  alert('You can only select up to ' + maxCandidates + ' candidates.');
               }
            } else {
               var index = selectedCandidates.indexOf(candidateId);
               if (index > -1) {
                  selectedCandidates.splice(index, 1);
               }
            }
         });
      });
      $(document).ready(function() {
         $('button.beri-suara').on('click', function() {
            $(this).toggleClass('clicked');
         });
      });
   </script>

</body>

</html>