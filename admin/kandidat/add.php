<?php
if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}
?>
<h3>Tambah Kandidat</h3>
<hr />
<div class="row">
    <div class="col-md-8">
        <form action="./kandidat/simpan.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Kader</label>
                <div class="col-md-6">
                    <input type="text" name="nama" class="form-control" required="Nama" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Foto Kader</label>
                <div class="col-md-5">
                    <input type="file" name="foto" class="form-control" required="Foto"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Visi</label>
                <div class="col-md-8">
                    <textarea name="visi" rows="3" class="form-control" required="Visi"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Misi</label>
                <div class="col-md-8">
                    <textarea name="misi" rows="3" required="Misi" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group" style="padding-top:20px;">
                <div class="col-md-offset-3 col-md-8">
                    <button type="submit" name="add_kandidat" value="Tambah Kandidat" class="btn btn-success">
                        Tambah Kandidat
                    </button>
                    <button type="button" onclick="window.history.go(-1)" class="btn btn-danger">
                        Kembali
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
