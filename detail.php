<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Profil Calon Formatur</title>
      <link rel="stylesheet" href="./assets/css/bootstrap.min.css"/>
      <style type="text/css">
         body {
            background-color: #0b9a03;
           max-height: 100vh;
           overflow: hidden;
           height: 100vh; 
           position: relative; 
         }

      

         .footer {
            position:absolute;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            min-height: 100%;
            align-items: end;
      
      z-index: -9999999999999999;
      
         }

         .tayo {
            /* border: 1px solid red; */
            /* position: absolute; */
            /* top: auto;
            left: 0; */
            align-items: end;
            width: 100%;
            min-height: 100%;
            display: flex;
            background-repeat: round;
         
         }

      .foooter .tayo .img-batik {
         width: 100%;
         height: 100%;
         border: 1px solid blue;
         background-repeat: repeat-y;

      }

         
      </style>
   </head>
   <body>
   
    <div class="main-content">
            <div class="container">
               <div class="bungkus">
         <div class="text-center" style="padding-top:20px; color:#eee;">
            <h2>Profil Calon Formatur</h2>
         </div>
         <hr />

         <?php
         define('BASEPATH', dirname(__FILE__));
         session_start();

         if(!isset($_SESSION['siswa'])) {
            header('location:./');
         }

         if(isset($_GET['id'])) {

            require('./include/connection.php');

            $sql = $con->prepare("SELECT * FROM t_kandidat WHERE id_kandidat = ?") or die($con->error);
            $sql->bind_param('i', $_GET['id']);
            $sql->execute();
            $sql->store_result();
            $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
            $sql->fetch();
            ?>
            <div class="row">
               <div class="col-md-10 col-md-offset-1">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="text-center">
                           <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="img-responsive" draggable="false"  oncontextmenu="return false;">
                        </div>
                     </div>

                     <div class="col-md-8"> 
                        <h3 style="color:#eee">Informasi Calon Formatur
                        </h3>
                        <table class="table table-striped" style="background: #fff;">
                           <tr>
                              <td width="200px">Nama Calon</td>
                              <td>: <?php echo $nama; ?></td>
                           </tr>
                           <tr>
                              <td>Visi</td>
                              <td>: <?php echo nl2br($visi); ?></td>
                           </tr>
                           <tr>
                              <td>Misi</td>
                              <td>: <?php echo nl2br($misi); ?></td>
                           </tr>
                           <!-- <tr>
                              <td>Total Perolehan Suara</td>
                              <td>: <?php echo $suara; ?> Suara</td>
                           </tr> -->
                           <tr>
                              <td>Periode Pencalonan</td>
                              <td>: <?php echo $periode; ?></td>
                           </tr>
                        </table>
                        <div>
                           <button onclick="window.history.go(-1)" class="btn btn-warning">Kembali</button>
                           <!-- <a href="./submit.php?id=<?php echo $id; ?>&s=<?php echo $suara; ?>" class="btn btn-success">Beri Suara</a> -->
                           
                        </div>
                        
                     </div>
                  </div>
               </div>
               </div>
               </div>
        
            </div>
            <footer class="footer">
              <div class="tayo">
                  <img src="./assets/img/batik3.png" alt="" class="img-batik">
                  <img src="./assets/img/batik3.png" alt="" class="img-batik">
                  
                  </div>
            </footer>
            </div> 
               
            <?php

         } else {

            header('loaction: ./');

         }
         ?>
      </div>
   </body>
</html>
