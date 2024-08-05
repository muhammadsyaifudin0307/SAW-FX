<?php

include 'header.php';
$da = "SELECT * FROM tbl_alternatif ORDER BY nilai_moora DESC";
$s = $conn->query($da);
$rank = 1;
while ($aa = $s->fetch_assoc()) {
    $id_alternatif = $aa['id_alternatif'];
    $sim = "UPDATE tbl_alternatif SET rangking ='$rank' WHERE id_alternatif = '$id_alternatif'";
    $conn->query($sim);
    $rank++;
}
?>
<h5 class="mb-4 font-weight-bolder">Rank</h5>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Alternatif</th>
            <th class="text-center">Nilai</th>
            <th class="text-center">Rank</th>
        </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM tbl_alternatif ORDER BY rangking";
    $stm = $conn->query($sql);
    $no = 1;
    while ($a = $stm->fetch_assoc()) { ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $a['nama_alternatif'] ?></td>
            <td class="text-center"><?= number_format($a['nilai_moora'], 2) ?></td>
            <td class="text-center"><?= $a['rangking'] ?></td>
        </tr>
    <?php } ?>
</table>

</div>
</div>