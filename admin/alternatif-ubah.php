<?php
include "../asset/conn/config.php";

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'ubah') {
        $id_alternatif = $_POST['id_alternatif'];
        $nama_alternatif = $_POST['nama_alternatif'];
        $sql = "UPDATE tbl_alternatif SET nama_alternatif='$nama_alternatif' WHERE id_alternatif='$id_alternatif'";
        $row = $conn->query($sql);
        header("location:alternatif.php");
    }
}
include "header.php"; ?>
<h2 class="mb-4 font-weight-bolder">Ubah Data</h2>
<hr>
<?php
$sql = "SELECT * FROM tbl_alternatif WHERE id_alternatif='$_GET[id_alternatif]'";
$stm = $conn->query($sql);
$a = $stm->fetch_assoc(); ?>
<form action="alternatif-ubah.php?aksi=ubah" method="post">
    <input type="hidden" name="id_alternatif" value="<?= $a['id_alternatif'] ?>">
    <div class="form-group">
        <label>Nama Alternatif</label>
        <input type="text" name="nama_alternatif" class="form-control" value="<?= $a['nama_alternatif'] ?>">
    </div>
    <hr>
    <input type="submit" value="ubah" class="btn btn-primary">
    <a href="alternatif.php" class="btn badge-secondary">Batal</a>
</form>
</div>
</div>