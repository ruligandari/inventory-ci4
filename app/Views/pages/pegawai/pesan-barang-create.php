<?= $this->extend('layouts/admin-panel-pegawai')?>
<?= $this->section('script-head')?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?= $this->endSection()?>
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
                        <form action="<?= base_url('pegawai/pesan-barang/save')?>" method="POST">
                            <?= csrf_field()?>
                            <div class="row ">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Tanggal Pesan</label>
                                        <input type="text" value="<?= date('Y-m-d')?>" class="form-control"
                                            name="tanggal_pesan" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select name="id_supplier" class="form-control" id="">
                                            <?php foreach($dataSupplier as $supplier):?>
                                            <option value="<?= $supplier['id_supplier'] ?>"><?=$supplier['nama'] ?>
                                            </option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select name="id_barang" id="id_barang" class="form-control">
                                            <option value="Pilih Nama Barang">Pilih Nama Barang</option>
                                            <?php foreach($barangdata as $barang):?>
                                            <option value="<?= $barang['id_barang'] ?>"><?= $barang['nama_barang'] ?>
                                            </option>
                                            <?php endforeach?>
                                        </select>
                                        <input type="hidden" name="nama_barang" id="nama_barang">
                                        <div class="invalid-feedback">
                                            Masukan Nama yang Valid
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="text" name="jumlah" id="total_stok" class="form-control">
                                        <div class="invalid-feedback">
                                            Masukan Email yang Valid
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" name="harga" id="cost" class="form-control">
                                        <div class="invalid-feedback">
                                            Masukan Email yang Valid
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" name="total" id="totalcost" class="form-control">
                                        <br>
                                        <p id="minorder"></p>
                                        <p id="biayapembelian"></p>
                                        <p id="biayapersediaan"></p>
                                        <p id="biayapemesanan"></p>
                                        <p id="totalbiaya"></p>
                                        <p id="remaining_months"></p>
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

<script>
function formatNumber(input) {
    // Menghilangkan karakter selain angka
    var num = input.value.replace(/\D/g, '');

    // Mengubah angka menjadi format ribuan (misal: 1000 menjadi 1.000)
    var formattedNum = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Memperbarui nilai input dengan format yang diinginkan
    input.value = formattedNum;
}
</script>

<script>
$(document).ready(function() {
    $('#id_barang').on('change', function() {
        var id_barang = $(this).val();

        $.ajax({
            url: "<?= base_url('getDataId'); ?>",
            type: "GET",
            data: {
                id_barang: id_barang
            },
            dataType: "json",
            success: function(response) {
                var tgl_sekarang = new Date();
                var tgl_awal = new Date(tgl_sekarang.getFullYear(), tgl_sekarang
                    .getMonth() - 3, 1);
                var tgl_akhir = new Date(tgl_sekarang.getFullYear(), tgl_sekarang
                    .getMonth(), 0);

                var total_stok = 0;
                var harga = 0;
                var namabarang = '';

                // Looping untuk menghitung jumlah total stok
                for (var i = 0; i < response.length; i++) {
                    var tgl_item = new Date(response[i].tanggal_pesan);
                    if (tgl_item >= tgl_awal && tgl_item <= tgl_akhir) {
                        total_stok += parseInt(response[i].jumlah);
                        harga = parseInt(response[i].harga);
                        namabarang = response[i].nama_barang;
                    }
                }

                // Menampilkan hasil perhitungan
                console.log('total : ' + total_stok);
                let prevDemand = total_stok;
                let unitCost = harga;
                let holdingCost = 0.2;
                let orderCost = 5000;

                let unitDemand = prevDemand / 3;
                let minOrder = Math.ceil(unitDemand);
                let orderCostPerUnit2 = orderCost / minOrder;
                let orderCostPerUnit = Math.ceil(orderCostPerUnit2)
                let totalCost = (unitCost * minOrder) + (holdingCost * unitCost *
                    minOrder) + (orderCostPerUnit * prevDemand);

                console.log("Jumlah stok yang harus dibeli: " + minOrder);
                console.log("Biaya pembelian: " + (minOrder * unitCost));
                console.log("Biaya persediaan untuk periode berikutnya: " + (minOrder *
                    unitCost * holdingCost));
                console.log("Biaya pemesanan per unit barang: " + orderCostPerUnit);
                console.log("Total biaya untuk periode ini dan berikutnya: " + totalCost);
                $('#total_stok').val(minOrder);
                $('#totalcost').val((minOrder * unitCost));
                $('#cost').val((unitCost));
                $('#nama_barang').val(namabarang);
                let minorder = document.getElementById("minorder");
                minorder.textContent = "Jumlah stok yang harus dibeli: " + minOrder;

                let biayapembelian = document.getElementById("biayapembelian");
                biayapembelian.textContent = "Biaya pembelian: Rp. " + (minOrder * unitCost)
                    .toLocaleString();

                let biayapersediaan = document.getElementById("biayapersediaan");
                biayapersediaan.textContent =
                    "Biaya persediaan untuk periode berikutnya: Rp. " + (minOrder *
                        unitCost * holdingCost).toLocaleString();

                let biayapemesanan = document.getElementById("biayapemesanan");
                biayapemesanan.textContent = "Biaya pemesanan per unit barang: Rp. " +
                    orderCostPerUnit.toLocaleString();

                let totalbiaya = document.getElementById("totalbiaya");
                totalbiaya.textContent =
                    "Total biaya untuk periode ini dan berikutnya: Rp. " + totalCost
                    .toLocaleString();

                // Prediksi berapa bulan persediaan akan bertahan
                var average_demand = total_stok / unitDemand;
                var remaining_months = Math.floor(average_demand);

                let perkiraan_bulan = document.getElementById("remaining_months");
                perkiraan_bulan.textContent =
                    "Sehingga ongkos total untuk Periode ini adalah : Rp. " + totalCost
                    .toLocaleString() +
                    " Dengan waktu periode optimal " + remaining_months + " bulan";
            }
        });
    });
});
</script>
<?= $this->endSection()?>