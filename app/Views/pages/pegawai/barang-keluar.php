<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Barang Keluar</h1>
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
                  <h4>Barang Keluar</h4>
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
                          <th>Jumlah</th>
                          <th>Status</th>
                          <!-- <th>Aksi</th> -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no = 1?>
                      <?php foreach ($barangkeluar as $barang): ?>
                        <?php 
                            if ($barang['status'] == 'Keluar') {
                                $badge = "badge-warning";
                            }
                            ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?=$barang['tanggal_pesan']?></td>
                          <td><?= $barang['nama_barang']?> </td>
                          <td><?=$barang['id_supplier']?></td>
                          <td><?= $barang['jumlah']?></td>
                          <td><div class="badge <?=$badge?>"><?= $barang['status']?></div></td>
                          <!-- <td>
                            <button data-target="#hapusModal<?=$barang['id_barang_keluar']?>" data-toggle="modal" class="btn btn-primary">Keluar</button>
                          </td> -->
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
<?php foreach ($barangkeluar as $barang) :?>
<div class="modal fade" id="hapusModal<?=$barang['id_barang_keluar']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pegawai/users/delete/').$barang['id_barang_keluar']?>" method="POST">
      <?= csrf_field()?>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus barang <?=$barang['id_barang']?> ?
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
<?= $this->endSection()?>