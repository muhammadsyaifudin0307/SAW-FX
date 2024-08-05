<?php
include "../asset/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $sql = "DELETE FROM tbl_alternatif WHERE id_alternatif='$_GET[id_alternatif]'";
        $stm = $conn->query($sql);
        header("location:alternatif.php");
    }
}
include "header.php";
?>

<h2 class="mb-4 font-weight-bolder ">Alternatif</h2>
<hr>
<a href="alternatif-simpan.php" class="btn btn-primary mb-4">Tambah data</a>
<br>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Alternatif</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
    $stm = $conn->query($sql);
    $no = 1;
    while ($a = $stm->fetch_assoc()) {
    ?>

        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $a['nama_alternatif'] ?></td>
            <td class="text-center"><a href="alternatif-ubah.php?id_alternatif=<?= $a['id_alternatif'] ?>" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href="alternatif.php?id_alternatif=<?= $a['id_alternatif'] ?>&aksi=hapus" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
        </tr>

    <?php } ?>

</table>