<?= $this->extend('layouts/admin-panel-supplier')?>

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
                      <?php foreach ($pesanan as $pesan): ?>
                        <?php 
                            if ($pesan['status'] == 'Dipesan') {
                                $badge = "badge-warning";
                            } else if ($pesan['status'] == 'Dikirim') {
                                $badge = 'badge-info';
                            }else if ($pesan['status'] == 'Diterima') {
                                $badge = 'badge-success';
                            }
                            ?>
                      <tbody>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?=$pesan['tanggal_pesan']?></td>
                          <td><?= $pesan['nama_barang']?> </td>
                          <td><?=$pesan['id_supplier']?></td>
                          <td><?= $pesan['jumlah']?></td>
                          <td><div class="badge <?=$badge?>"><?= $pesan['status']?></div></td>
                          <td>
                            <a href="<?= base_url('supplier/kirim/').$pesan['id_barang_pesanan']?>" class="btn btn-success">Kirim Barang</a>
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

<?= $this->endSection()?>