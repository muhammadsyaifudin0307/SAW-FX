<?php
include "../asset/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'ubah') {
        $id_alternatif = $_POST['id_alternatif'];

        $hps = "DELETE  FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
        $s = $conn->query($hps);

        $dkr = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
        $k = $conn->query($dkr);
        while ($dk = $k->fetch_assoc()) {
            $idK = $dk['id_kriteria'];
            $idS = $_POST[$idK];

            $sql = "INSERT INTO tbl_nilai (id_alternatif,id_kriteria,id_subkriteria) 
            VALUES('$id_alternatif','$idK','$idS')";
            $row = $conn->query($sql);
        }
        header("location:nilai.php");
    }
}
include "header.php"; ?>
<h2 class="mb-4">Ubah Data</h2>
<hr>
<form action="nilai-ubah.php?aksi=ubah" method="post">
    <div class="form-group">
        <label>Nama Alternatif</label>
        <select name="id_alternatif" class="form-control">
            <?php
            $dta = "SELECT * FROM tbl_alternatif WHERE id_alternatif='$_GET[id_alternatif]'";
            $n = $conn->query($dta);
            $da = $n->fetch_assoc();
            echo "<option value='$da[id_alternatif]' selected>1 - $da[nama_alternatif]</option>";
            $data = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
            $a = $conn->query($data);
            $no = 1;
            while ($dt = $a->fetch_assoc()) {
                echo "<option value='$dt[id_alternatif]'>$no - $dt[nama_alternatif]</option>";
                $no++;
            } ?>
        </select>
    </div>

    <?php
    $dkr = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
    $b = $conn->query($dkr);
    while ($k = $b->fetch_assoc()) {
        $idK = $k['id_kriteria'];
        $nmK = $k['nama_kriteria'];

        $dtn = "SELECT * FROM tbl_nilai WHERE id_kriteria='$idK' AND id_alternatif='$_GET[id_alternatif]'";
        $n = $conn->query($dtn);
        $dn = $n->fetch_assoc();
        $idS = $dn['id_subkriteria'];
        echo "
        <div>
        <label>$nmK</label>
        <select class='form-control mb-3' name='$idK'>";
        $dskr = "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$idK' ORDER BY nilai_subkriteria
        DESC";
        $c = $conn->query($dskr);
        while ($ds = $c->fetch_assoc()) {
            if ($idS == $ds['id_subkriteria']) {
                echo "<option selected value='$ds[id_subkriteria]'>$ds[nama_subkriteria] - ($ds[nilai_subkriteria])</option>";
            } else {
                echo "<option value='$ds[id_subkriteria]'>$ds[nama_subkriteria] - ($ds[nilai_subkriteria])</option>";
            }
        }

        echo "
        </select></div>";
    } ?>
    <hr>
    <input type="submit" value="Ubah" class="btn btn-primary">
    <a href="nilai.php" class="btn badge-secondary">Batal</a>
</form>
</div>
</div>