<?php

namespace App\Controllers;

use App\Models\BayarModel;
use App\Models\JasaModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->bayarModel = new BayarModel();
        $this->jasaModel = new JasaModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        return view('laporan');
    }

    public function dataBayar()
    {
        $tanggalMulai = $this->request->getPost('tanggalMulai') . " 00:00:00";
        $tanggalSelesai = $this->request->getPost('tanggalSelesai') . " 23:59:59";
        $ringkasan = $this->request->getPost('ringkas');
        $transaksi = $this->bayarModel->where(['tanggal >=' => $tanggalMulai, 'tanggal <=' => $tanggalSelesai])->findAll();

        $dataTransaksi = [];
        if ($ringkasan) {
            $jasa = $this->jasaModel->findAll();
            for ($i = 0; $i < count($jasa); $i++) {
                $dataTransaksi[$jasa[$i]['id']] = $jasa[$i];
                $dataTransaksi[$jasa[$i]['id']]["jumlah"] = 0;
            }

            for ($i = 0; $i < count($transaksi); $i++) {
                $kumpulanId = explode(",", $transaksi[$i]["idJasa"]);
                for ($j = 0; $j < count($kumpulanId); $j++) {
                    $dataTransaksi[intval($kumpulanId[$j])]["jumlah"] += 1;
                }
            }
        } else {
            for ($i = 0; $i < count($transaksi); $i++) {
                $kumpulanId = explode(",", $transaksi[$i]["idJasa"]);
                for ($j = 0; $j < count($kumpulanId); $j++) {
                    $data = [];
                    $jasa = $this->jasaModel->where('id', $kumpulanId[$j])->first();
                    $data["tanggal"] = $transaksi[$i]["tanggal"];
                    $data["platNomor"] = $transaksi[$i]["platNomor"];
                    $data["namaMotor"] = $transaksi[$i]["nama"];
                    $data["namaJasa"] = $jasa["nama"];
                    $data["biaya"] = $jasa["biaya"];
                    $data["karyawan"] = "moham";
                    array_push($dataTransaksi, $data);
                }
            }
        }

        echo json_encode($dataTransaksi);
    }
}
