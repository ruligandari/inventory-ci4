<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Laporan Barang Masuk</h1>
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
                  <form action="<?= base_url('pegawai/laporan-masuk/create')?>" method="POST">
                <div class="card-header d-flex justify-content-between">
                  <div class="form-group">
                    <label>Pilih Bulan</label>
                    <input type="month" id="month" value="<?= date('Y-m') ?>" class="form-control" name="month">
                  </div>
                    <button type="submit" name="cetak" class="btn btn-success">Cetak</button>
                </div>
            </form>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-stripped" id="tableMonth">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Nama Barang</th>
                          <th>Supplier</th>
                          <th>Jumlah</th>
                          <th>Harga</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $no = 1?>
                          <?php foreach ($laporanMasuk as $laporan): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?=$laporan['tanggal_pesan']?></td>
                          <td><?= $laporan['nama_barang']?> </td>
                          <td><?=$laporan['id_supplier']?></td>
                          <td><?= $laporan['jumlah']?></td>
                          <td><?= $laporan['harga']?></td>
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
<?php foreach ($laporanMasuk as $laporan) :?>
<div class="modal fade" id="hapusModal<?=$laporan['id_barang_masuk']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('pegawai/barang-masuk/update/').$laporan['id_barang_masuk']?>" method="POST">
      <?= csrf_field()?>
      <div class="modal-body">
        Apakah anda yakin ingin mengeluarkan barang <?=$laporan['nama_barang']?> ?
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

<?= $this->section('script')?>
<script>
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var month = $('#month').val();
            var date = data[1];
            var split1 = date.split('-')[0];
            var split2 = date.split('-')[1];
            var fix = split1 + '-' + split2;
            if (
                (fix === month) || (month === "") || (fix === "")
            ) {
                return true;
            }
            return false;
        }
    );
    $(document).ready(function () {
        
        // Create date inputs
        monthDate = $('#month').val();
        var table = $('#tableMonth').DataTable({
            "order": [
                [1, "asc"]
            ],
        });
        // Refilter the table
        $('#month').on('change', function () {
            table.draw();
        });
    });
</script>
<?= $this->endSection()?>