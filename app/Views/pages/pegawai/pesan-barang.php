<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pesan Barang</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <?php 
                if (session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success" role="alert">'.session()->getFlashdata('success').'</div>';
                } else if (session()->getFlashdata('error')){
                    echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Barang Pesanan</h4>
                        <div class="card-header-action">
                            <?php if($_SESSION['role'] !== '1'): ?>
                            <a href="<?= base_url('pegawai/pesan-barang/create') ?>" class="btn btn-primary">Tambah
                                Pesanan</a>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Supplier</th>
                                        <th>ID Kategori</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <?php if($_SESSION['role'] !== '1'):?>
                                        <th>Aksi</th>
                                        <?php endif;?>
                                        <?php if($_SESSION['role'] == '1'):?>
                                        <th>Aksi</th>
                                        <?php endif;?>
                                    </tr>
                                </thead>
                                <?php $no = 1?>
                                <?php foreach ($barangpesanan as $pesanan): ?>
                                <?php 
                            if (session()->get('role') !== '1') {
                              if($pesanan['status'] == 'Menunggu Konfirmasi'){
                                $badge = "badge-secondary";
                                $isHide = 'disabled';
                            } else if ($pesanan['status'] == 'Dipesan') {
                                $badge = "badge-warning";
                                $isHide = 'disabled';
                            } else if ($pesanan['status'] == 'Dikirim') {
                                $badge = 'badge-info';
                                $isHide = '';
                            }else if ($pesanan['status'] == 'Diterima') {
                                $badge = 'badge-success';
                                $isHide = 'disabled';
                            }
                                // $isHide = 'disabled';
                            } else {
                              if($pesanan['status'] == 'Menunggu Konfirmasi'){
                                $badge = "badge-secondary";
                                $isHide = '';
                            } else if ($pesanan['status'] == 'Dipesan') {
                                $badge = "badge-warning";
                                $isHide = 'disabled';
                            } else if ($pesanan['status'] == 'Dikirim') {
                                $badge = 'badge-info';
                                $isHide = 'disabled';
                            }else if ($pesanan['status'] == 'Diterima') {
                                $badge = 'badge-success';
                                $isHide = 'disabled';
                            }
                            }
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?=$pesanan['tanggal_pesan']?></td>
                                        <td><?=$pesanan['nama_barang']?> </td>
                                        <td><?=$pesanan['id_supplier']?></td>
                                        <td><?=$pesanan['id_kategori']?></td>
                                        <td><?=$pesanan['harga']?></td>
                                        <td><?=$pesanan['jumlah']?></td>
                                        <td><?=$pesanan['total']?></td>
                                        <td>
                                            <div class="badge <?=$badge?>"><?= $pesanan['status']?></div>
                                        </td>
                                        <?php if($_SESSION['role'] == '1'):?>
                                        <td>
                                            <button <?=$isHide?>
                                                data-target="#konfirmasiModal<?=$pesanan['id_barang_pesanan']?>"
                                                data-toggle="modal"
                                                class="btn btn-success <?=$isHide?>">Konfirmasi</button>
                                        </td>
                                        <?php endif;?>
                                        <?php if($_SESSION['role'] !== '1'):?>
                                        <td>
                                            <button <?=$isHide?>
                                                data-target="#hapusModal<?=$pesanan['id_barang_pesanan']?>"
                                                data-toggle="modal" class="btn btn-danger <?=$isHide?>">Hapus</button>
                                            <button <?=$isHide?>
                                                data-target="#terimaModal<?=$pesanan['id_barang_pesanan']?>"
                                                data-toggle="modal" class="btn btn-success <?=$isHide?>">Terima
                                                Barang</button>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                </tbody>
                                <?php endforeach?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Statistik -->
    </section>
</div>


<!-- Modal -->
<?php foreach ($barangpesanan as $pesanan) :?>
<div class="modal fade" id="hapusModal<?=$pesanan['id_barang_pesanan']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/users/delete/').$pesanan['id_barang_pesanan']?>" method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus pesanan <?=$pesanan['nama_barang']?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach?>
<?php foreach ($barangpesanan as $pesanan) :?>
<div class="modal fade" id="terimaModal<?=$pesanan['id_barang_pesanan']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/pesan-barang/update/').$pesanan['id_barang_pesanan']?>" method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin memasukan barang <?=$pesanan['nama_barang']?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach?>
<?php foreach ($barangpesanan as $pesanan) :?>
<div class="modal fade" id="konfirmasiModal<?=$pesanan['id_barang_pesanan']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/pesan-barang/konfirmasi/').$pesanan['id_barang_pesanan']?>"
                method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin konfirmasi barang <?=$pesanan['nama_barang']?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach?>
<?= $this->endSection()?>