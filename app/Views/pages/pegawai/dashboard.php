<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          
          <!-- Statistik -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Chart Barang Masuk</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary" id="month">Bulan Ini</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart1" height="90"></canvas>
                  
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Chart Barang Keluar</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary" id="month">Bulan Ini</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart2" height="90"></canvas>
                  
                </div>
              </div>
            </div>
          </div>
          <!-- end Statistik -->
        </section>
      </div>
<?= $this->endSection()?>

<?= $this->section('script')?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $.ajax({
        url: '<?= base_url("pegawai/home/get_data") ?>',
        dataType: 'json',
        success: function(data) {
            // Data yang diterima dari controller akan berupa array of objects.
            // Untuk membuat chart dengan ChartJS, kita perlu memformat data tersebut menjadi dua array terpisah:
            // satu array untuk label (tanggal_pesan) dan satu array lagi untuk data (jumlah).
            var labels = [];
            var dataJumlah = [];
            data.forEach(function(item) {
              var satukan = item.nama_barang+" / "+item.tanggal_pesan;
                labels.push(satukan);
                dataJumlah.push(item.jumlah);
            });

            // Konfigurasi chart
            var config = {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Barang Masuk',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        data: dataJumlah
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            };

            // Membuat chart
            var ctx = document.getElementById('myChart1').getContext('2d');
            var myChart = new Chart(ctx, config);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
$(document).ready(function() {
    $.ajax({
        url: '<?= base_url("pegawai/home/get_data_keluar") ?>',
        dataType: 'json',
        success: function(data) {
            // Data yang diterima dari controller akan berupa array of objects.
            // Untuk membuat chart dengan ChartJS, kita perlu memformat data tersebut menjadi dua array terpisah:
            // satu array untuk label (tanggal_pesan) dan satu array lagi untuk data (jumlah).
            var labels = [];
            var dataJumlah = [];
            data.forEach(function(item) {
              var satukan = item.nama_barang+" / "+item.tanggal_pesan;
                labels.push(satukan);
                dataJumlah.push(item.jumlah);
            });

            // Konfigurasi chart
            var config = {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Barang Keluar',
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        borderColor: 'rgba(255, 0, 0, 1)',
                        borderWidth: 1,
                        data: dataJumlah
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            };

            // Membuat chart
            var ctx = document.getElementById('myChart2').getContext('2d');
            var myChart = new Chart(ctx, config);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});
</script>
<?= $this->endSection()?>