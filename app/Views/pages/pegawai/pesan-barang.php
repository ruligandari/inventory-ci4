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
                      <a href="<?= base_url('pegawai/pesan-barang/create')?>" class="btn btn-primary">Tambah Pesanan</a>        
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
                          <th>Jumlah</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php $no = 1?>
                      <?php foreach ($barangpesanan as $pesanan): ?>
                        <?php 
                            if ($pesanan['status'] == 'Dipesan') {
                                $badge = "badge-warning";
                            } else if ($pesanan['status'] == 'Dikirim') {
                                $badge = 'badge-info';
                            }else if ($pesanan['status'] == 'Diterima') {
                                $badge = 'badge-success';
                            }
                            ?>
                      <tbody>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?=$pesanan['tanggal_pesan']?></td>
                          <td><?= $pesanan['nama_barang']?> </td>
                          <td><?=$pesanan['id_supplier']?></td>
                          <td><?= $pesanan['jumlah']?></td>
                          <td><div class="badge <?=$badge?>"><?= $pesanan['status']?></div></td>
                          <td>
                            <a href="<?= base_url('pegawai/users/edit/').$pesanan['id_barang_pesanan']?>" class="btn btn-primary">Edit</a>
                            <button data-target="#hapusModal<?=$pesanan['id_barang_pesanan']?>" data-toggle="modal" class="btn btn-danger">Hapus</button>
                          </td>
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
<div class="modal fade" id="hapusModal<?=$pesanan['id_barang_pesanan']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<?= $this->endSection()?>