<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Kelola Data Pesan Barang</h1>
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
                  <h4>Tambah Data Pesan Barang</h4>
                </div>
                <div class="card-body">
                 <form action="<?= base_url('pegawai/pesan-barang/save')?>" method="POST" >
                 <?= csrf_field()?>
                 <div class="row ">
                     <div class="col-12">
                         <div class="form-group">
                            <label>Tanggal Pesan</label>
                            <input type="text" value="<?= date('Y-m-d')?>" class="form-control" name="tanggal_pesan" readonly>
                        </div>
                         <div class="form-group">
                            <label>Supplier</label>
                            <select name="id_supplier" class="form-control" id="">
                              <?php foreach($dataSupplier as $supplier):?>
                              <option value="<?= $supplier['id_supplier'] ?>"><?=$supplier['nama'] ?></option>
                              <?php endforeach?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required="">
                        <div class="invalid-feedback">
                            Masukan Nama yang Valid
                        </div>
                        </div>
                        <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control">
                        <div class="invalid-feedback">
                            Masukan Email yang Valid
                        </div>
                        </div>
                     </div>
                 </div>
                      <div class="card-footer text-right">
                      <button class="btn btn-primary">Tambah Data Pesanan</button>
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