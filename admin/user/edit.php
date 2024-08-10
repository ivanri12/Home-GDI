<?php require_once('../_header.php') ?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">

            <?php
            $id = &$_GET['id'];
            $sql_jemaat = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            // Definisikan opsi kategori
            $categories = [
                'Admin' => 'Admin',
                'Ketua Majelis' => 'Ketua Majelis',
                'Kordinator' => 'Kordinator'
            ];

            // Ambil nilai kategori dan id_rayon yang dipilih dari database
            $selectedCategory = $data['kategori'];
            $selectedRayon = $data['id_rayon'];
            ?>

            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data User</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 text-start control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $data['email'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 text-start control-label col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $data['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 text-start control-label col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="kategori" id="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                    foreach ($categories as $value => $label) {
                                        $selected = ($selectedCategory == $value) ? "selected" : "";
                                        echo "<option value='" . htmlspecialchars($value) . "' $selected>" . htmlspecialchars($label) . "</option>";
                                    }
                                    ?>
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
                                        $selected = ($selectedRayon == $row['id_rayon']) ? "selected" : "";
                                        echo '<option value="' . $row['id_rayon'] . '" ' . $selected . '>' . $row['rayon'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <p class="text-danger">* Jika kategori kordinator, silahkan tambahkan rayon</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="data.php"><button type="button" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</button></a>
                        <button type="submit" name="edit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php require_once('../_footer.php') ?>