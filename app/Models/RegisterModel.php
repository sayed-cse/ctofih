<?php
declare(strict_types=1);
namespace App\Models;
use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table = 'basicinfo';
    protected $primaryKey = 'bid';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'tagline', 'description', 'schedule', 'entrydate', 'updatestatus', 'rules', 'year', 'fees'];

    #protected $useTimestamps = false;
    #protected $createdField  = 'created_at';
    #protected $updatedField  = 'updated_at';
    #protected $deletedField  = 'deleted_at';

    #protected $validationRules    = [];
    #protected $validationMessages = [];
    #protected $skipValidation     = false;    
    // public function __construct()
    // {
    //     parent:: __construct();
    //     $this->load->database();
    //     $this->db->query("SET NAMES 'utf8'");
    //     $this->load->library(array('pagination','form_validation'));
    // } 
    // public function readRegInfo()
    // {
    //     $data = array();
    //     $userModel->insert($data);
    // }
    // public function insertRegInfo()
    // {
    //     $data = array(
    //         'title' => $this->request->getPost('title'),
    //     );
    //     $userModel->insert($data);        
    // }
}
