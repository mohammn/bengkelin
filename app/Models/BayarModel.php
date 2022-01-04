<?php

namespace App\Models;

use CodeIgniter\Model;

class BayarModel extends Model
{
    protected $table      = 'bayar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['platNomor', 'nama', 'idJasa', 'kasir'];
}
