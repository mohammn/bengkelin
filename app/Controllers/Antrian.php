<?php

namespace App\Controllers;

use App\Models\AntrianModel;
use App\Models\BayarModel;

class Antrian extends BaseController
{
    public function __construct()
    {
        $this->antrianModel = new AntrianModel();
        $this->bayarModel = new BayarModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        echo view('antrian');
    }
    public function muatData()
    {
        echo json_encode($this->antrianModel->findAll());
    }

    public function tambah()
    {
        $data = [
            "platNomor" => $this->request->getPost("platNomor"),
            "namaMotor" => $this->request->getPost("nama"),
        ];

        $this->antrianModel->save($data);

        echo json_encode("");
    }

    public function prosesPembayaran()
    {
        $kumpulanId = "";
        $idAntrian = $this->request->getPost("idAntrian");
        $data = $this->request->getPost("idTindakan");
        for ($i = 0; $i < count($data); $i++) {
            if ($kumpulanId != "") {
                $kumpulanId .= ",";
            }
            $kumpulanId .= strval($data[$i]);
        }


        $motor = $this->antrianModel->where("id", $idAntrian)->first();

        $data = [
            "platNomor" => $motor["platNomor"],
            "nama" => $motor["namaMotor"],
            "idJasa" => $kumpulanId,
            "kasir" => "moham"
        ];

        $this->bayarModel->save($data);
        $this->antrianModel->delete($idAntrian);

        echo json_encode("");
    }
}
