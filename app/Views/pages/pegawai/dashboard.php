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
                                <a href="#" class="btn btn-primary filter-chart" data-filter="bulan">Bulan Ini</a>
                                <a href="#" class="btn btn-primary filter-chart" data-filter="minggu">Minggu Ini</a>
                                <a href="#" class="btn btn-primary filter-chart" data-filter="hari">Hari Ini</a>
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
                                <a href="#" class="btn btn-primary filter-chart" data-filter="bulan1">Bulan Ini</a>
                                <a href="#" class="btn btn-primary filter-chart" data-filter="minggu1">Minggu Ini</a>
                                <a href="#" class="btn btn-primary filter-chart" data-filter="hari1">Hari Ini</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2" height="90"></canvas>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi</h4>
                        <div class="card-header-action">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary" id="month">Bulan Ini</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =1; foreach($stok as $br):?>
                                    <?php 
                                    if($br['stok'] <= 5) {
                                        $keterangan = "Stok hampir habis";
                                    } else {
                                        $keterangan = "Stok masih tersedia";
                                    }
                                    ?>
                                    <tr>
                                        <td><?=$no++?></td>
                                        <td><?=$br['nama_barang']?></td>
                                        <td><?=$br['stok']?> Pcs</td>
                                        <td><?=$keterangan?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
    var activeFilter1 = 'bulan';

    function updateChart1() {
        var url1 = '';
        if (activeFilter1 === 'bulan') {
            url1 = '<?= base_url("pegawai/home/get_data") ?>';
        } else if (activeFilter1 === 'hari') {
            url1 = '<?= base_url("pegawai/home/get_data_hari") ?>';
        } else if (activeFilter1 === 'minggu') {
            url1 = '<?= base_url("pegawai/home/get_data_week") ?>';
        }
        $.ajax({
            url: url1,
            dataType: 'json',
            success: function(data) {
                var labels = [];
                var dataJumlah = [];
                data.forEach(function(item) {
                    var satukan = item.nama_barang + " / " + item.tanggal_pesan;
                    labels.push(satukan);
                    dataJumlah.push(item.jumlah);
                });

                var ctx1 = document.getElementById('myChart1').getContext('2d');
                var myChart1 = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Barang Masuk',
                            backgroundColor: 'rgba(255, 0, 0, 0.2)',
                            borderColor: 'rgba(255, 0, 0, 1)',
                            borderWidth: 1,
                            data: dataJumlah
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    $('.filter-chart').click(function(e) {
        e.preventDefault();
        var Filter1 = $(this).data('filter');
        if (Filter1 !== activeFilter1) {
            activeFilter1 = Filter1;
            updateChart1();
        }
    });

    updateChart1();

    var activeFilter2 = 'bulan1';

    function updateChart2() {
        var url2 = '';
        if (activeFilter2 === 'bulan1') {
            url2 = '<?= base_url("pegawai/home/get_data_keluar") ?>';
        } else if (activeFilter2 === 'hari1') {
            url2 = '<?= base_url("pegawai/home/get_data_hari_keluar") ?>';
        } else if (activeFilter2 === 'minggu1') {
            url2 = '<?= base_url("pegawai/home/get_data_week_keluar") ?>';
        }
        $.ajax({
            url: url2,
            dataType: 'json',
            success: function(data) {
                var labels = [];
                var dataJumlah = [];
                data.forEach(function(item) {
                    var satukan = item.nama_barang + " / " + item.tanggal_pesan;
                    labels.push(satukan);
                    dataJumlah.push(item.jumlah);
                });

                var ctx2 = document.getElementById('myChart2').getContext('2d');
                var myChart2 = new Chart(ctx2, {
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
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    $('.filter-chart').click(function(e) {
        e.preventDefault();
        var Filter2 = $(this).data('filter');
        if (Filter2 !== activeFilter2) {
            activeFilter2 = Filter2;
            updateChart2();
        }
    });

    updateChart2();
});
</script>
<?= $this->endSection()?>