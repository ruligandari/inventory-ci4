<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi Penjualan</h1>
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
                        <h4>Transaksi</h4>
                        <div class="card-header-action">
                            <button data-target="#tambahModal" data-toggle="modal" class="btn btn-success">Tambah
                                Transaksi</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1?>
                                    <?php foreach ($transaksi as $pesanan): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?=$pesanan['nama_barang']?></td>
                                        <td>Rp. <?=number_format($pesanan['harga'])?></td>
                                        <td><?=$pesanan['qty']?> Pcs</td>
                                        <td>Rp. <?=number_format($pesanan['total'])?></td>
                                        <td><?=$pesanan['tanggal']?></td>
                                        <td>
                                            <button data-target="#hapusModal<?=$pesanan['id_transaksi']?>"
                                                data-toggle="modal" class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
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
<?php foreach ($transaksi as $pesanan) :?>
<div class="modal fade" id="hapusModal<?=$pesanan['id_transaksi']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/users/delete/').$pesanan['id_transaksi']?>" method="POST">
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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/transaksi/save')?>" method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="id_barang" class="form-control" id="id_barang">
                            <option value="#">Silahkan Pilih</option>
                            <?php foreach ($barang as $br):?>
                            <option value="<?=$br['id_barang']?>"><?=$br['nama_barang']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="qty">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection()?>