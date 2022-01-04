<?php

namespace App\Controllers;

use App\Models\JasaModel;

class Jasa extends BaseController
{
    public function __construct()
    {
        $this->jasaModel = new JasaModel();
    }
    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/login");
        }
        echo view('jasa');
    }
    public function muatData()
    {
        echo json_encode($this->jasaModel->where('hapus', 0)->findAll());
    }

    public function tambah()
    {
        $data = [
            "nama" => $this->request->getPost("nama"),
            "biaya" => $this->request->getPost("biaya"),
            "hapus" => 0
        ];

        $this->jasaModel->save($data);

        echo json_encode("");
    }

    public function hapus()
    {
        $data = [
            "hapus" => 1
        ];
        $this->jasaModel->update($this->request->getPost("id"), $data);
        echo json_encode("");
    }
}
