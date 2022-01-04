<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaModel extends Model
{
    protected $table      = 'jasa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'biaya', 'hapus'];
}
