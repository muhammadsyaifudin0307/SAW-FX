<?php include "header.php"; ?>

<main>
    <div class="site-section">
        <div class="container">

            <h2 class="mb-4">Metode</h2>
            <hr>
            <br>
            <h5>Data Kriteria</h5>

            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama kriteria</th>
                        <th class="text-center">Bobot</th>

                    </tr>
                </thead>
                <?php
                //normalisasi bobot
                $n_wj = array();
                $sql = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                $stm = $conn->query($sql);
                $no = 1;
                $sum_bobot = 0;
                while ($a = $stm->fetch_assoc()) {
                    $dsum = "SELECT bobot_kriteria as nBobot FROM tbl_kriteria";
                    $s = $conn->query($dsum);
                    $ns = $s->fetch_assoc();
                    //normalisasi bobot
                    $nwj = $a['bobot_kriteria'];
                    $n_wj[] = array(
                        'nilai_wj' => $nwj
                    );

                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['nama_kriteria'] ?> - (<?= $a['tipe_kriteria'] ?>)</td>
                        <td class="text-center"><?= $a['bobot_kriteria'] ?></td>

                        </td>



                    </tr>
                <?php } ?>
            </table>
            <br>
            <h5>Matrik Keputusan</h5>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria]</th>";
                        } ?>

                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM  tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) { ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>;
                            <?php
                            $data = "SELECT s.nama_subkriteria as nm_sub FROM tbl_nilai n, tbl_subkriteria s 
        WHERE n.id_subkriteria=s.id_subkriteria AND n.id_alternatif='$id_alternatif' ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                echo "<td class= 'text-center'>$dtn[nm_sub]</td>";
                            } ?>

                        </tr>
                <?php } else {
                    }
                }
                ?>
            </table>
            <br>

            <h5>Konversi Matrik Keputusan</h5>
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria]</th>";
                        } ?>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                $data_found = false; // Flag to check if data is found

                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) {
                        $data_found = true; // Data is found
                ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                            <?php

                            $nilaimax = array();
                            $nilaimin = array();
                            $data = "SELECT s.nilai_subkriteria as n_sub, n.id_kriteria as id_kriteria, k.tipe_kriteria as tipe_kriteria FROM tbl_nilai n, tbl_subkriteria s, tbl_kriteria k 
                WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria = k.id_kriteria AND n.id_alternatif='$id_alternatif' ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                $nilai_sub = $dtn['n_sub'];
                                // nilai max
                                $nmax = "SELECT MAX(s.nilai_subkriteria) as n_max FROM tbl_nilai n, tbl_subkriteria s WHERE 
                    n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $nn = $conn->query($nmax);
                                $n_m = $nn->fetch_assoc();
                                $nilai_max = $n_m['n_max'];
                                $nilaimax[] = array(
                                    'n_max' => $nilai_max
                                );
                                // nilai min
                                $nmin = "SELECT Min(s.nilai_subkriteria) as n_min FROM tbl_nilai n, tbl_subkriteria s WHERE 
                       n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $ni = $conn->query($nmin);
                                $n_i = $ni->fetch_assoc();
                                $nilai_min = $n_i['n_min'];
                                $nilaimin[] = array(
                                    'n_min' => $nilai_min
                                );

                                echo "<td class='text-center'>$nilai_sub</td>";
                            } ?>
                        </tr>
                    <?php
                    }
                }

                if ($data_found) {
                    ?>
                    <tr>
                        <td colspan="2"><b>Maxsimal</b></td>
                        <?php
                        foreach ($nilaimax as $n_max) {
                            echo "<td class='text-center'><b>$n_max[n_max]</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Minimal</b></td>
                        <?php
                        foreach ($nilaimin as $n_min) {
                            echo "<td class='text-center'><b>$n_min[n_min]</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Bobot</b></td>
                        <?php
                        foreach ($n_wj as $nwj) {
                            echo "<td class='text-center'><b>$nwj[nilai_wj]</b></td>";
                        }
                        ?>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td colspan="100%" class="text-center">Masukkan data terlebih dahulu</td>
                    </tr>
                <?php
                }
                ?>
            </table> <br>


            <h5>Normalisasi Matrik</h5>
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        $ket = "SELECT * FROM tbl_kriteria ORDER BY id_kriteria";
                        $a = $conn->query($ket);
                        $kriteria = [];
                        while ($row = $a->fetch_assoc()) {
                            echo "<th class='text-center'>$row[nama_kriteria]</th>";
                            $kriteria[] = $row;
                        }
                        ?>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif";
                $stm = $conn->query($sql);
                $no = 1;
                $data_found = false; // Flag to check if data is found

                // Array to store normalized values
                $normalized_values = [];

                while ($a = $stm->fetch_assoc()) {
                    $id_alternatif = $a['id_alternatif'];
                    $nm_alternatif = $a['nama_alternatif'];

                    $cek = "SELECT * FROM tbl_nilai WHERE id_alternatif='$id_alternatif'";
                    $k = $conn->query($cek);
                    if ($k->num_rows > 0) {
                        $data_found = true; // Data is found
                ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                            <?php
                            $nilaimax = array();
                            $nilaimin = array();
                            $normalized_row = [];
                            $data = "SELECT s.nilai_subkriteria as n_sub, n.id_kriteria as id_kriteria, k.tipe_kriteria as tipe_kriteria 
                         FROM tbl_nilai n, tbl_subkriteria s, tbl_kriteria k 
                         WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria = k.id_kriteria AND n.id_alternatif='$id_alternatif' 
                         ORDER BY n.id_kriteria";
                            $b = $conn->query($data);
                            while ($dtn = $b->fetch_assoc()) {
                                $nilai_sub = $dtn['n_sub'];
                                $nmax = "SELECT MAX(s.nilai_subkriteria) as n_max 
                             FROM tbl_nilai n, tbl_subkriteria s 
                             WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $nn = $conn->query($nmax);
                                $n_m = $nn->fetch_assoc();
                                $nilai_max = $n_m['n_max'];
                                $nilaimax[] = array('n_max' => $nilai_max);

                                $nmin = "SELECT Min(s.nilai_subkriteria) as n_min 
                             FROM tbl_nilai n, tbl_subkriteria s 
                             WHERE n.id_subkriteria=s.id_subkriteria AND n.id_kriteria ='$dtn[id_kriteria]'";
                                $ni = $conn->query($nmin);
                                $n_i = $ni->fetch_assoc();
                                $nilai_min = $n_i['n_min'];
                                $nilaimin[] = array('n_min' => $nilai_min);

                                if ($dtn['tipe_kriteria'] == 'Benefit') {
                                    $n_nm = $nilai_sub / $nilai_max;
                                } else if ($dtn['tipe_kriteria'] == 'Cost') {
                                    $n_nm = $nilai_min / $nilai_sub;
                                }
                                echo "<td class='text-center'>" . number_format($n_nm, 2) . "</td>";
                                $normalized_row[$dtn['id_kriteria']] = $n_nm;
                            }
                            $normalized_values[$id_alternatif] = $normalized_row;
                            ?>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            <br>

            <h5>Perhitungan</h5>
            <table class="table table-striped ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <?php
                        foreach ($kriteria as $row) {
                            echo "<th class='text-center'>$row[nama_kriteria] </th>";
                        }
                        ?>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <?php
                $no = 1;
                foreach ($normalized_values as $id_alternatif => $normalized_row) {
                    $sql = "SELECT * FROM tbl_alternatif WHERE id_alternatif='$id_alternatif'";
                    $stm = $conn->query($sql);
                    $a = $stm->fetch_assoc();
                    $total_nqa = 0;
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['nama_alternatif'] ?></td>
                        <?php
                        foreach ($kriteria as $row) {
                            $id_kriteria = $row['id_kriteria'];
                            $bobot_kriteria = $row['bobot_kriteria'];
                            $nqa = $normalized_row[$id_kriteria] * $bobot_kriteria;
                            $total_nqa += $nqa;
                            echo "<td class='text-center'>" . number_format($nqa, 2) . "</td>";
                        }
                        echo "<td class='text-center'>" . number_format($total_nqa, 2) . "</td>";
                        ?>
                    </tr>
                <?php
                    // simpan nilai total Qa
                    $simpan = "UPDATE tbl_alternatif SET nilai_moora ='$total_nqa' WHERE id_alternatif = '$id_alternatif'";
                    $conn->query($simpan);
                }
                ?>
            </table>
            <br>

        </div>
    </div>
</main>