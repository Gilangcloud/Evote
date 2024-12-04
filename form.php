<?php defined('BASEPATH') or die("No Access Allowed"); ?>


<!-- <div class="row mt-5 pt-5 content container-fluid bg-dark">
    <div class="logo col-md-4">
    
        <img src="./assets/img/ipm.png" class="img" alt="logo" width="1000px"  draggable="false"  oncontextmenu="return false;">
    </div>
    <div class="col-md-5  ">
        <h2 class="index-header"><strong>SELAMAT DATANG</strong><br>DI PEMILIHAN CALON FORMATUR</h2>
        <p>PR IPM SMK MUHAMMADIYAH 2 PEKANBARU</p>
        <form action="" method="post"> 
            <div class="form-group">
                <label>Masukkan Nomer Pemilih :</label>
                <input  class="form-control" placeholder=" Nomer Pemilih"  quired="NIS" name="nis"/>
            </div>
            <br />
            <div class="row">
            
                <div class="text-right" style="padding-right:15px;">
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Login">
                </div>
            </div>
        </form>
    </div>
    <div class="maskot col-md-3 ">
        <img src="./assets/img/Maskot.png" alt="maskot" draggable="false"  oncontextmenu="return false;" >
    </div>
</div> -->

<div style="display: flex; align-items: center; flex-direction: column; width: 100%">
    <div class="header">
        <div style="display: flex; align-items: center">
            <img src="assets/img/ipm.png" alt="" class="logo-ipm" style="z-index: 2" />
            <img src="assets/img/musywil.jpg" alt="" style="margin-left: -30px" class="logo-musywil" />
        </div>
    </div>

    <h1 style="text-align: center; font-family: 'Bebas Neue', sans-serif; word-spacing: 5px; letter-spacing: 3px; color: #ffc000; margin: 10px 0">
        PORTAL PEMILIHAN CALON FORMATUR
        <br />
        <span style="color: #b43a23">MUSYAWARAH WILAYAH XX <span style="color: #000">IPM RIAU</span></span>
    </h1>

    <form action="" method="post">
        <video id="video" autoplay></video>
        <input class="form-control" placeholder=" Nomer Pemilih" quired="NIS" name="nis" style="margin-bottom: 20px;"/>

        <input type="submit" name="submit" class="btn btn-success btn-lg" style="margin-left: auto;" value="Login">
    </form>
</div>