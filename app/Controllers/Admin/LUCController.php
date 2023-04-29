<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LUCModel;

class LUCController extends BaseController
{
    public function LUC()
    {
        $barangKeluarModel = new LUCModel();
        $getStok = $barangKeluarModel->getStok();
        $prevDemand = $getStok; // Jumlah permintaan selama 3 bulan sebelumnya
        $unitCost = 10000; // Biaya per unit barang
        $holdingCost = 0.2; // Persentase biaya penyimpanan per unit barang
        $orderCost = 5000; // Biaya pemesanan barang

        $unitDemand = $prevDemand / 3; // Jumlah permintaan per bulan
        $minOrder = ceil($unitDemand); // Jumlah unit terendah yang harus dibeli
        $orderCostPerUnit = $orderCost / $minOrder; // Biaya pemesanan per unit barang
        $totalCost = ($unitCost * $minOrder) + ($holdingCost * $unitCost * $minOrder) + ($orderCostPerUnit * $prevDemand);

        $data = [
            'minOrder' => $minOrder,
            'purchaseCost' => $minOrder * $unitCost,
            'inventoryCost' => $minOrder * $unitCost * $holdingCost,
            'orderCostPerUnit' => $orderCostPerUnit,
            'totalCost' => $totalCost
        ];

        return view('inventory/cost', $data);
    }
}
