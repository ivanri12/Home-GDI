<?php require_once('../_header.php') ?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data User</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 text-start control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 text-start control-label col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 text-start control-label col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select name="kategori" class="form-control" id="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Ketua Majelis">Ketua Majelis</option>
                                    <option value="Kordinator">Kordinator</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_rayon" class="col-sm-2 text-start control-label col-form-label">Rayon</label>
                            <div class="col-sm-9">
                                <select name="id_rayon" class="form-control" id="id_rayon">
                                    <option value="">Pilih Rayon</option>
                                    <?php
                                    // Ambil data rayon dari database
                                    $result = mysqli_query($con, "SELECT id_rayon, rayon FROM rayon");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id_rayon'] . '">' . $row['rayon'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <p class="text-danger">* Jika kategori kordinator, silahkan tambahkan rayon</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 text-start control-label col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" name="password" class="form-control" id="password" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="data.php"><button type="button" class="btn btn-warning"><i class=" fas fa-arrow-left"></i> Kembali</button></a>
                        <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../_footer.php') ?>