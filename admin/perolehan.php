<div class="button">
   <div class="text-right"><button id="save-img" class="btn btn-success">Simpan Grafik</button></div>
   <br>
   <div class="text-right"><button id="table-perolehan" class="btn btn-success">Table perolehan</button></div>
   <br>
</div>

<div style="font-size:18px;">
   <canvas id="canvas"></canvas>
</div>





<div class="table-responsive container">

   <table class="table table-primary">
      <thead>
         <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Calon Formatur</th>
            <th scope="col">Suara</th>

         </tr>
      </thead>
      <tbody>

         <?php

         require('../include/connection.php');

         $sql = mysqli_query($con, "SELECT * FROM t_kandidat ORDER BY suara DESC;");


         if (mysqli_num_rows($sql) > 0) {

            $i = 1;
            while ($data = mysqli_fetch_array($sql)) {


         ?>


               <tr>
                  <th scope="row"><?php echo $i++; ?></th>
                  <td> <?php echo $data['nama_calon']; ?></td>
                  <td> <?php echo $data['suara']; ?></td>
                 
               </tr>
         <?php
            }
         } else {

            echo "<tr>
                              <td colspan='5' style='text-align:center;'><h4>Belum ada data</h4></td>
                        </tr>";
         }
         ?>
      </tbody>
   </table>
</div>