<?php
session_start();
include "../db_conn.php";
$data = $conn->query("SELECT * FROM catatan WHERE id_hutang ='$_GET[id]'");
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Ubah</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="card" style="width: 18rem;">
                <img src="../img/admin-default.png" class="card-img-top" alt="admin image">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <?= $_SESSION['name'] ?>
                    </h5>
                    <a href="logout.php" class="btn btn-dark">Logout</a>
                </div>
            </div>


            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <form class="row g-3" method="post">
                            <?php
                            while ($dta = mysqli_fetch_assoc($data)) :
                            ?>
                                <div class="col-md-6">
                                    <label for="printilan" class="form-label">Pengeluaran Printilan</label>
                                    <input class="form-control" type="hidden" name="id_hutang" value="<?= $dta['id_hutang'] ?>">
                                    <input type="text" class="form-control" id="printilan" name="printilan" value="<?= $dta['pengeluaran_prtl'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="snack" class="form-label">Pengeluaran Snack</label>
                                    <input type="text" class="form-control" id="snack" name="snack" value="<?= $dta['pengeluaran_snk'] ?>">
                                </div>
                                <div class="col-12">
                                    <label for="pemasukan" class="form-label">Pemasukan</label>
                                    <input type="text" class="form-control" id="pemasukan" name="pemasukan" value="<?= $dta['pemasukan'] ?>">
                                </div>
                                <div class="col-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $dta['keterangan'] ?>">
                                </div>
                                <div class="col-12">
                                    <label for="qty" class="form-label">Kuantitas</label>
                                    <input type="text" class="form-control" id="qty" name="qty" value="<?= $dta['qty'] ?>">
                                </div>
                                <div class="col-12">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $dta['tanggal'] ?>">
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='../home.php'">Kembali</button>
                                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                                </div>
                        </form>
                    <?php endwhile; ?>
                    <?php
                    if (isset($_POST['ubah'])) {
                        $id   = $_POST['id_hutang'];
                        $printilan = $_POST['printilan'];
                        $snack = $_POST['snack'];
                        $pemasukan = $_POST['pemasukan'];
                        $keterangan = $_POST['keterangan'];
                        $kuantitas = $_POST['qty'];
                        $tanggal = $_POST['tanggal'];


                        $ubah = $conn->query("UPDATE catatan SET pengeluaran_prtl = '$printilan', pengeluaran_snk = '$snack', pemasukan = '$pemasukan', keterangan = '$keterangan', qty = '$kuantitas', tanggal = '$tanggal' WHERE id_hutang = " . $id);
                        if ($ubah) {
                            echo "
                            <script>
                            alert('data catatan berhasil diedit');
                            document.location.href = '../home.php';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                            alert('data catatan gagal diedit');
                            document.location.href = '../home.php';
                            </script>
                            ";
                        }
                    } ?>
                    </div>
                </div>

            </div>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: ../home.php");
} ?>