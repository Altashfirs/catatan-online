<?php
session_start();
include "../db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $data = $conn->query("SELECT * FROM catatan WHERE id_peminjam ='$_GET[id]'");
    $dta = mysqli_fetch_assoc($data)
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>HOME</title>
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
                            <div class="col-md-6">
                                <label for="printilan" class="form-label">Pengeluaran Printilan</label>
                                <input type="text" class="form-control" id="printilan" name="printilan" placeholder="Masukkan Biaya">
                            </div>
                            <div class="col-md-6">
                                <label for="snack" class="form-label">Pengeluaran Snack</label>
                                <input type="text" class="form-control" id="snack" name="snack" placeholder="Masukkan Biaya">
                            </div>
                            <div class="col-12">
                                <label for="pemasukan" class="form-label">Pemasukan</label>
                                <input type="text" class="form-control" id="pemasukan" name="pemasukan" placeholder="Masukkan Pemasukan">
                            </div>
                            <div class="col-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan">
                            </div>
                            <div class="col-12">
                                <label for="qty" class="form-label">Kuantitas</label>
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Masukkan Kuantitas">
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='../home.php'">Kembali</button>
                                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['tambah'])) {
                            $id = $_GET['id'];
                            $printilan = $_POST['printilan'];
                            $snack = $_POST['snack'];
                            $pemasukan = $_POST['pemasukan'];
                            $keterangan = $_POST['keterangan'];
                            $kuantitas = $_POST['qty'];
                            $tanggal = $_POST['tanggal'];

                            // ID_HUTANG
                            $today = date("ymd");
                            $query = mysqli_query($conn, "SELECT max(id_hutang) AS last FROM catatan WHERE id_hutang LIKE '$today%'");
                            $data = mysqli_fetch_assoc($query);
                            $lastNobayar = $data['last'];
                            $lastNoUrut  = intval(substr($lastNobayar, 6, 4));
                            $nextNoUrut  = $lastNoUrut + 1;
                            $randomNumber = rand(1000, 9999); // Generate a random 4-digit number
                            $nextNobayar = $today . sprintf('%03s', $nextNoUrut) . $randomNumber;
                            $cekid = mysqli_num_rows($conn->query("SELECT id_hutang FROM catatan WHERE id_hutang='$nextNobayar'"));

                            if($cekid > 0) {
                                $nextNobayar = $today . sprintf('%03s', $nextNoUrut) . $randomNumber;
                                $simpan = $conn->query("INSERT INTO catatan (id_peminjam, tanggal, pemasukan, pengeluaran_prtl, pengeluaran_snk, keterangan, qty, id_hutang) VALUES('$id', '$tanggal', '$pemasukan', '$printilan', '$snack', '$keterangan', '$kuantitas', '$nextNobayar')");
                            } else {
                            $simpan = $conn->query("INSERT INTO catatan (id_peminjam, tanggal, pemasukan, pengeluaran_prtl, pengeluaran_snk, keterangan, qty, id_hutang) VALUES('$id', '$tanggal', '$pemasukan', '$printilan', '$snack', '$keterangan', '$kuantitas', '$nextNobayar')");
                            } 
                            if (!$ubah) {
                                echo "
                            <script>
                            alert('data berhasil ditambahkan');
                            document.location.href = '../home.php';
                            </script>
                            ";
                            } else {
                                echo "
                            <script>
                            alert('data gagal ditambahkan');
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