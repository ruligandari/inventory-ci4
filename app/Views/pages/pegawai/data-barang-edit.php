<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Barang</h1>
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
                        <h4>Update Data Barang</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('pegawai/daftar-barang/update/').$barang['id_barang']?>"
                            method="POST">
                            <?= csrf_field()?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" required=""
                                            value="<?=$barang['nama_barang']?>">
                                        <div class="invalid-feedback">
                                            Masukan Nama Barang yang Valid
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Supplier</label>
                                        <select name="id_supplier" class="form-control">
                                            <option value="<?=$barang['id_supplier']?>"><?=$barang['nama']?></option>
                                            <?php foreach($supplier as $sp ):?>
                                            <option value="<?=$sp['id_supplier']?>"><?=$sp['nama']?></option>
                                            <?php endforeach?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Silahkan Pilih Nama Supplier
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <select name="id_kategori" class="form-control">
                                            <option value="<?=$barang['id_kategori']?>"><?=$barang['nama_kategori']?>
                                            </option>
                                            <?php foreach($kategori as $sp ):?>
                                            <option value="<?=$sp['id_kategori']?>"><?=$sp['nama_kategori']?></option>
                                            <?php endforeach?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Silahkan Pilih Nama Supplier
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control"
                                            value="<?=$barang['stok']?>">
                                        <div class="invalid-feedback">
                                            Masukan Stok yang Valid
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control"
                                            value="<?=$barang['harga']?>">
                                        <div class="invalid-feedback">
                                            Masukan Harga yang Valid
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update</button>
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
<?= $this->section('script')?>
<script>
let table = new DataTable('#table-users', {
    searchable: true,
    sortable: true,
    fixedHeight: true
});
</script>
<?= $this->endSection()?>