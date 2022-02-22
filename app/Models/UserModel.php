<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'auth';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['id','uname', 'umail', 'passwd', 'type', 'status', 'role','salt'];
    protected $validationRules = [
        'uname' => 'required|min_length[3]',
        'umail' => 'required|min_length[5]|valid_email|is_unique[auth.umail]',
        'passwd' => 'required|min_length[8]',
        'type' => 'min_length[1]',
        'status' => 'min_length[1]',
        'role' => 'min_length[1]',
        'salt' => 'min_length[1]',
    ];
    protected $skipValidation = false;
    // protected $validationMessages = [
    //     'umail'        => [
    //         'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
    //     ],
    // ];
}

