<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>HOME</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">

            <!-- FOR USERS -->
            <!-- <div class="card" style="width: 18rem;">
                    <img src="img/user-default.png" class="card-img-top" alt="admin image">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <?= $_SESSION['name'] ?>
                        </h5>
                        <a href="logout.php" class="btn btn-dark">Logout</a>
                    </div>
                </div> -->
            <div class="p-3">
                <?php
                $id_user = $_SESSION['id'];
                $query = "SELECT * FROM catatan WHERE id_peminjam = $id_user";
                $respon = mysqli_query($conn, $query);

                if (mysqli_num_rows($respon) >= 0) { ?>
                    <div class="container d-flex justify-content-between align-items-center mb-4">
                        <a href="logout.php" class="btn btn-dark">Logout</a>
                        <h1 class="display-4 fs-1">Catatan</h1>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='php/tambah.php?id=<?= $id_user ?>';">Tambah</button>
                    </div>
                    <table id="myTable" class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pemasukkan</th>
                                <th scope="col">Pengeluaran Printilan</th>
                                <th scope="col">Pengeluaran Snack</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Keuntungan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $totalHarga = 0;
                            $kuantitas = 0;
                            while ($rows = mysqli_fetch_assoc($respon)) {
                                $keuntungan = $rows['pemasukan'] - $rows['pengeluaran_prtl'] + $rows['pengeluaran_snk'];
                                $kuantitas += $rows['qty'];
                                $totalHarga += $keuntungan;
                            ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $rows['tanggal'] ?></td>
                                    <td><?= "Rp " . number_format($rows['pemasukan'], 0, '', '.') ?></td>
                                    <td><?= "Rp " . number_format($rows['pengeluaran_prtl'], 0, '', '.') ?></td>
                                    <td><?= "Rp " . number_format($rows['pengeluaran_snk'], 0, '', '.') ?></td>
                                    <td><?= $rows['keterangan'] ?></td>
                                    <td><?= $rows['qty'] ?></td>
                                    <td><?= "Rp " . number_format($keuntungan, 0, '', '.') ?></td>
                                    <td>
                                        <button type="button" class="btn p-0" onclick="window.location.href='php/ubah.php?id=<?= $rows['id_hutang'] ?>';"><i class="bi bi-pencil-fill" style="color: green;"></i></button>
                                        <button type="button" class="btn p-0 ms-1" onclick="window.location.href='php/hapus.php?id=<?= $rows['id_hutang'] ?>';"><i class="bi bi-trash-fill" style="color: red;"></i></button>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?= $kuantitas ?></th>
                                <th><?= "Rp " . number_format($totalHarga, 0, '', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php } ?>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "lengthMenu": [5, 10, 25, 50],
                    "order": [
                        [1, "asc"]
                    ],
                    "searching": true,
                    "scrollY": 200,
                    "scrollX": true,
                    // Add more options as needed
                });
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("Location: index.php");
}
?>