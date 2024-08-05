<?php
include "header.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.7.0/css/bootstrap.min.css">
    <style>
        .card-custom {
            border-radius: 15px;
            color: white;
            padding: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-custom .icon {
            font-size: 80px;
            opacity: 0.2;
            position: absolute;
            right: 20px;
            bottom: 20px;
        }

        .progress-bar-custom {
            height: 5px;
        }

        .card-blue {
            background: linear-gradient(45deg, #007bff, #0056b3);
        }
    </style>
</head>

<body>

    <h2 class="mb-4 font-weight-bolder">Dashboard</h2>
    <hr>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-custom card-blue">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold text-white">Jumlah Alternatif</h5>
                            <h2 class="font-weight-bold text-white">
                                <?php
                                // Query untuk mendapatkan jumlah alternatif
                                $sql = "SELECT COUNT(*) as jumlah_alternatif FROM tbl_alternatif";
                                $result = $conn->query($sql);

                                // Mengecek hasil query
                                if ($result->num_rows > 0) {
                                    // Mengambil data dan menampilkan jumlah alternatif
                                    $row = $result->fetch_assoc();
                                    echo $row["jumlah_alternatif"];
                                } else {
                                    echo "Tidak ada alternatif ditemukan";
                                }

                                // Menutup koneksi

                                ?>
                            </h2>
                        </div>
                        <i class="fa fa-balance-scale fa-5x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom card-blue">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold text-white">Jumlah Kriteria</h5>
                            <h2 class="font-weight-bold text-white">
                                <?php

                                // Query untuk mendapatkan jumlah kriteria
                                $sql = "SELECT COUNT(*) as jumlah_kriteria FROM tbl_kriteria";
                                $result = $conn->query($sql);

                                // Mengecek hasil query
                                if ($result->num_rows > 0) {
                                    // Mengambil data dan menampilkan jumlah kriteria
                                    $row = $result->fetch_assoc();
                                    echo $row["jumlah_kriteria"];
                                } else {
                                    echo "Tidak ada kriteria ditemukan";
                                }
                                ?>
                            </h2>
                        </div>
                        <i class="fa fa-line-chart fa-5x"></i>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <?php
        // Aktifkan pelaporan kesalahan
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $da = "SELECT * FROM tbl_alternatif ORDER BY nilai_moora DESC";
            $s = $conn->query($da);
            $rank = 1;
            while ($aa = $s->fetch_assoc()) {
                $id_alternatif = $aa['id_alternatif'];
                $sim = "UPDATE tbl_alternatif SET rangking = ? WHERE id_alternatif = ?";
                $stmt = $conn->prepare($sim);
                $stmt->bind_param("ii", $rank, $id_alternatif);
                $stmt->execute();
                $rank++;
            }

            // Ambil alternatif dengan peringkat tertinggi
            $topRankQuery = "SELECT * FROM tbl_alternatif ORDER BY rangking LIMIT 1";
            $topRankResult = $conn->query($topRankQuery);

            if ($topRankResult->num_rows > 0) {
                $topRank = $topRankResult->fetch_assoc();
        ?>

                <p class="text-center text-dark font-weight-bold">
                    Dalam metode SAW, alternatif dengan peringkat tertinggi adalah
                    <strong class="text-primary"><?= htmlspecialchars($topRank['nama_alternatif']) ?></strong>
                    dengan nilai <strong class="text-primary"><?= number_format($topRank['nilai_moora'], 2) ?></strong>.
                    Alternatif ini menempati peringkat pertama karena memiliki nilai tertinggi berdasarkan analisis rasio dari berbagai kriteria yang telah ditentukan.
                </p>

            <?php
            } else {
            ?>

                <p class="text-center text-dark font-weight-bold">
                    Tidak ada alternatif yang tersedia dalam metode SAW saat ini.
                </p>

        <?php
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>