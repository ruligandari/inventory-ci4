<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Kelola Data User</h1>
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
                  <h4>Tambah Data Users</h4>
                </div>
                <div class="card-body">
                 <form action="<?= base_url('pegawai/users/save')?>" method="POST" >
                 <?= csrf_field()?>
                 <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control"  required="">
                        <div class="valid-feedback">
                          Good job!
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required="">
                        <div class="invalid-feedback">
                          Oh no! Email is invalid.
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="" class="form-control">
                          <option value="1">Pimpinan</option>
                          <option value="2">Pegawai</option>
                          <option value="3" selected>Supplier</option>
                        </select>
                      </div>
                      <div class="card-footer text-right">
                      <button class="btn btn-primary">Simpan</button>
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