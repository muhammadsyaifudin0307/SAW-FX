<?php

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'login') {
    session_start();
    include "asset/conn/config.php";


    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM tbl_akun WHERE username = '$username' AND password = '$password'";
    $stm = $conn->query($query);
    $row = $stm->num_rows;

    if ($row > 0) {
      $data = $stm->fetch_assoc();
      $id_akun = $data['id_akun'];
      $_SESSION['id_akun'] = $id_akun;
      echo '<script>alert("Login berhasil!"); window.location.href = "admin/index.php";</script>';
    } else {
      header("location:index.php?pesan=gagal");
    }
  }
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SAW</title>
    <!-- Link to Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

    <style>
      body {
        background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);
      }
      .card {
        border: 1px solid #bbdefb;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      .btn-custom {
        background: linear-gradient(135deg, #42a5f5 0%, #1e88e5 100%);
        border: none;
      }
      .btn-custom:hover {
        background: linear-gradient(135deg, #1e88e5 0%, #42a5f5 100%);
      }
    </style>
  </head>
  <body>
    <section class="py-3 py-md-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border border-light-subtle rounded-3 shadow-sm">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <h2 class="fs-3 fw-bold text-center text-secondary mb-4">
                  ADMIN
                </h2>
                <form
                  action="index.php?aksi=login"
                  method="post"
                  class="login-form">
                  <?php
                  if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == 'gagal') {
                      echo "<div class= 'alert alert-danger'><span class= 'fa fa-times'></span>Login Gagal!!! </div>";
                    }
                  }
                  ?>
                  <div class="row gy-2 overflow-hidden">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input
                          type="text"
                          class="form-control"
                          name="username"
                          id="username"
                          placeholder="admin123"
                          required />
                        <label for="username" class="form-label"
                          >Username</label
                        >
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input
                          type="password"
                          class="form-control"
                          name="password"
                          id="password"
                          value=""
                          placeholder="Password"
                          required />
                        <label for="password" class="form-label"
                          >Password</label
                        >
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-flex gap-2 justify-content-between">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            name="rememberMe"
                            id="rememberMe" />
                          <label
                            class="form-check-label text-secondary"
                            for="rememberMe">
                            Keep me logged in
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid my-3">
                        <button class="btn btn-custom btn-lg" type="submit">
                          Log in
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Link to Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
