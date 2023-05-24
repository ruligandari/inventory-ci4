<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Barang Masuk</h1>
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
                  <h4>Barang Masuk</h4>
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
                          <?php if($_SESSION['role'] !== '1'):?>
                          <th>Aksi</th>
                          <?php endif;?>
                        </tr>
                      </thead>
                      <?php $no = 1?>
                      <?php foreach ($barangpesanan as $pesanan): ?>
                        <?php 
                            if ($pesanan['status'] == 'Dikeluarkan') {
                                $badge = "badge-danger";
                                $isDisable = 'disabled';
                            } else if ($pesanan['status'] == 'Masuk') {
                                $badge = 'badge-info';
                                $isDisable = '';
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
                          <?php if($_SESSION['role'] !== '1'):?>
                          <td>
                            <button <?= $isDisable?> data-target="#hapusModal<?=$pesanan['id_barang_masuk']?>" data-toggle="modal" class="btn btn-primary <?= $isDisable?>">Keluar</button>
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
<div class="modal fade" id="hapusModal<?=$pesanan['id_barang_masuk']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pegawai/barang-masuk/update/').$pesanan['id_barang_masuk']?>" method="POST">
      <?= csrf_field()?>
      <div class="modal-body">
        Apakah anda yakin ingin mengeluarkan barang <?=$pesanan['nama_barang']?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Keluar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach?>
<?= $this->endSection()?>