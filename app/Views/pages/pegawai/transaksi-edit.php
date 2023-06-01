<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Transaksi</h1>
        </div>

        <!-- Statistik -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <?php
                if (session()->getFlashdata('error')){
                  echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                }
                ?>
                    <div class="card-header">
                        <h4>Edit Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('pegawai/transaksi/update/').$transaksi['id_transaksi']?>"
                            method="POST">
                            <?= csrf_field()?>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select name="id_barang" class="form-control">
                                            <option value="<?=$transaksi['id_barang']?>"><?=$transaksi['nama_barang']?>
                                            </option>
                                            <?php foreach($barang as $br):?>
                                            <option value="<?=$br['id_barang']?>"><?=$br['nama_barang']?></option>
                                            <?php endforeach?>
                                        </select>
                                        <div class="valid-feedback">
                                            Pilih Nama Barang
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="number" name="qty" class="form-control"
                                            value="<?=$transaksi['qty']?>" required="">
                                        <div class="invalid-feedback">
                                            Masukan Quantity
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Statistik -->
    </section>
</div>
<?= $this->endSection()?>