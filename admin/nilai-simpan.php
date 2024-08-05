<?php
include "../asset/conn/config.php";
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $id_alternatif = $_POST['id_alternatif'];

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
<h2 class="mb-4">Tambah Data</h2>
<hr>
<form action="nilai-simpan.php?aksi=simpan" method="post">
    <div class="form-group">
        <label>Nama Alternatif</label>
        <select name="id_alternatif" class="form-control">
            <option selected disabled>Pilih</option>
            <?php
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
        echo "
        <div>
        <label>$nmK</label>
        <select class='form-control mb-3' name='$idK'>";
        $dskr = "SELECT * FROM tbl_subkriteria WHERE id_kriteria='$idK' ORDER BY nilai_subkriteria
        DESC";
        $c = $conn->query($dskr);
        while ($ds = $c->fetch_assoc()) {
            echo "<option value='$ds[id_subkriteria]'>$ds[nama_subkriteria] - ($ds[nilai_subkriteria])</option>";
        }
        echo "
        </select></div>";
    } ?>
    <hr>
    <input type="submit" value="Simpan" class="btn btn-primary">
    <a href="nilai.php" class="btn badge-secondary">Batal</a>
</form>
</div>
</div>