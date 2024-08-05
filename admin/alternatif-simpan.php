<?php
include "../asset/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $nama_alternatif = $_POST['nama_alternatif'];
        $sql = "INSERT INTO tbl_alternatif (nama_alternatif)VALUES('$nama_alternatif')";   # code...
        $row = $conn->query($sql);
        header("location:alternatif.php");
    }
    # code...
}


include "header.php";


?>
<h2 class="mb-4 font-weight-bolder">Tambah Data</h2>
<hr>

<form action="alternatif-simpan.php?aksi=simpan" method="post">
    <div class="form-group">
        <label> Nama Alternatif</label>
        <input type="text" name="nama_alternatif" class="form-control">
    </div>
    <hr>
    <input type="submit" value="simpan" class="btn btn-primary">
    <a href="alternatif.php" class="btn badge-secondary">Batal</a>
</form>