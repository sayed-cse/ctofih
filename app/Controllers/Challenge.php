<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Models\RegisterModel;
use App\Libraries\Facebook;
class Challenge extends BaseController
{
    public function __construct()
    {
        //parent::__construct();
        //service('negotiator')->encoding(['gzip']); 
    }
##  Home Page   
    public function index($page = 'index')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }        
        $data['title'] = ucfirst('C.T.O Forum Innovation Hackathon'); 
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';        
        echo view('templates/header', $data);
        $db = db_connect();
        $db->protectIdentifiers('basicinfo', true);
        $query = $db->query("SELECT * FROM basicinfo");
        $data['info'] = $query;     
        echo(view('challenge/index', $data));
        $db->close();
        echo view('templates/footer', $data);        
    }
## Basic Registration Form     
    public function register($page = 'basicinfoForm')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }
        $data['title'] = ucfirst('Registration');
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';
        $data['insert_mode'] = TRUE;
        $data['update_mode'] = FALSE;
        $data['action'] = base_url('challenge/insertBasic');        
        echo view('templates/header', $data);
        echo view('challenge/' . $page, $data);
        echo view('templates/footer', $data);
    }
## Insert BasicInfo
    public function insertBasic()
    {
        $regModel = new RegisterModel();
        $db = db_connect();
        $db->protectIdentifiers('basicinfo', true);
        if($this->request->getMethod() === 'post' && !empty($this->request->getPost(csrf_token())) && $this->validate([
        'title' => 'required|min_length[3]',
         // 'tagline' => 'required|min_length[3]', 
         // 'description' => 'required|min_length[10]', 
         // 'schedule' => 'required', 
        // 'entrydate' => 'required', 
         // 'updatestatus' => 'required', 
         // 'rules' => 'required', 
         // 'year' => 'required', 
         // 'fees' => 'required',
       //'basicfile' => ['mime_in[basicfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]', 'max_size[basicfile,1024]'],
        ])){
#Check if Data already exists
            $query = $db->query('SELECT title FROM basicinfo WHERE title = "'.$this->request->getPost('title').'"');
            if($query->getNumRows() > 0){
                return redirect()->back()->with('error','ERROR:: Data Exists!!');
            } else {
# Upload Image
                // $file = $this->request->getFile('basicfile');
                // if($file->isValid() && ! $file->hasMoved()) {
                //     $newName = $file->getRandomName();
                //     $file->move('images/basicinfo/', $newName);
                // }else{ $newName = 'no-image.png'; /* If Image Not upload Set default image */}

                if(!$regModel->insert([
                    'title' => $this->request->getPost('title'),
                    'tagline' => $this->request->getPost('tagline'),
                    'keyword' => $this->request->getPost('keyword'),
                    'description' => $this->request->getPost('description'),
                    'schedule' => $this->request->getPost('schedule'),
                    'entrydate' => !empty($this->request->getPost('entrydate')) ? $this->request->getPost('entrydate') : date('Y-m-d'), //must this format
                    'updatestatus' => $this->request->getPost('updatestatus'),
                    'rules' => $this->request->getPost('rules'),
                    'year' => date('Y'),
                    'fees' => $this->request->getPost('fees'),
                ])){
                    $db->close();
                    return redirect()->back()->with('error','ERROR:: Unable to save! Try again.');
                }else{
                    $db->close();
                    return redirect()->back()->with('success','SUCCESS:: Data Saved!');
                }
            }
        }else{
            $db->close();
            return redirect()->back()->with('error','ERROR:: Required data mismatched!');
        }
    }
#Update BasicForm
    public function basicForm($bid)
    {
        //if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }
        $data['title'] = ucfirst('Update Info');
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';
        $data['insert_mode'] = FALSE;
        $data['update_mode'] = TRUE;
        $data['action'] = base_url('challenge/updateBasic'); 
        $db = db_connect();
        $db->protectIdentifiers('basicinfo', true);
        $data['query'] = $db->query("SELECT * FROM basicinfo WHERE bid = $bid");                   
        echo view('templates/header', $data);
        echo view('challenge/basicinfoForm', $data);
        $db->close();
        echo view('templates/footer', $data);        
    }    
#Update BasicInfo
    public function updateBasic()
    {
        $updModel = new RegisterModel();
        $id = $this->request->getVar('bid');
        $data =[
            'title' => $this->request->getPost('title'),
            'tagline' => $this->request->getPost('tagline'),
            'keyword' => $this->request->getPost('keyword'),
            'description' => $this->request->getPost('description'),
            'schedule' => $this->request->getPost('schedule'),
            'entrydate' => $this->request->getPost('entrydate'), //must this format
            'updatestatus' => $this->request->getPost('updatestatus'),
            'rules' => $this->request->getPost('rules'),
            'year' => date('Y'),
            'fees' => $this->request->getPost('fees'),            
        ];
       return !$updModel->update($id, $data) ? redirect()->to('/challenge/index/')->with('error','ERROR:: Unable to Update Data!!') : redirect()->to('/challenge/index/')->with('success','SUCCESS:: Data Updated!!');
    }
    public function eraseBasic()
    {
        $delModel = new RegisterModel();
        $id = $this->request->getVar('bid');
        $data = $delModel->find($id);
        return $data ? !$delModel->delete($data) ?  redirect()->to('/challenge/index/')->with('error','ERROR:: Unable to Delete!!') : redirect()->to('/challenge/index/')->with('success','SUCCESS:: Data Deleted!!') : redirect()->to('/challenge/index/')->with('error','ERROR:: No Data Found!!');
    }
# Basic Close
# Rounds Start
    public function roundinfo($page = 'roundinfoForm')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }        
        $data['title'] = ucfirst('Round Informations'); 
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';
        $data['insert_mode'] = TRUE;
        $data['update_mode'] = FALSE; 
        $data['action'] = base_url('challenge/insertRound');                    
        echo view('templates/header', $data);
        echo view('challenge/' . $page, $data);
        echo view('templates/footer', $data);
    }    
    public function insertRound()
    {
        $regModel = new RoundModel();
        $db = db_connect();
        $db->protectIdentifiers('roundinfo', true);
        if($this->request->getMethod() === 'post' && !empty($this->request->getPost(csrf_token())) && $this->validate([
        'roundname' => 'required|min_length[3]',
       //'basicfile' => ['mime_in[basicfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]', 'max_size[basicfile,1024]'],
        ])){
#Check if Data already exists
            $query = $db->query('SELECT roundname FROM roundinfo WHERE title = "'.$this->request->getPost('roundname').'"');
            if($query->getNumRows() > 0){
                return redirect()->back()->with('error','ERROR:: Data Exists!!');
            } else {
                if(!$regModel->insert([
                    'roundname' => $this->request->getPost('roundname'),
                    'roundid' => $this->request->getPost('roundid'),
                    'edate' => !empty($this->request->getPost('edate')) ? $this->request->getPost('edate') : date('Y-m-d'), //must this format
                ])){
                    $db->close();
                    return redirect()->back()->with('error','ERROR:: Unable to save! Try again.');
                }else{
                    $db->close();
                    return redirect()->back()->with('success','SUCCESS:: Data Saved!');
                }
            }
        }else{
            $db->close();
            return redirect()->back()->with('error','ERROR:: Required data mismatched!');
        }
    }
    public function updateRoundform($bid)
    {
        //if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }
        $data['title'] = ucfirst('Update Round');
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';
        $data['insert_mode'] = FALSE;
        $data['update_mode'] = TRUE;
        $data['action'] = base_url('challenge/updateRound'); 
        $db = db_connect();
        $db->protectIdentifiers('roundinfo', true);
        $data['query'] = $db->query("SELECT * FROM roundinfo WHERE bid = $bid");                   
        echo view('templates/header', $data);
        echo view('challenge/roundinfoForm', $data);
        $db->close();
        echo view('templates/footer', $data);         
    }
    public function updateRound()
    {
        $updModel = new RoundModel();
        $id = $this->request->getVar('bid');
        $data =[
            'title' => $this->request->getPost('title'),
            'tagline' => $this->request->getPost('tagline'),
            'keyword' => $this->request->getPost('keyword'),
            'description' => $this->request->getPost('description'),
            'schedule' => $this->request->getPost('schedule'),
            'entrydate' => $this->request->getPost('entrydate'), //must this format
            'updatestatus' => $this->request->getPost('updatestatus'),
            'rules' => $this->request->getPost('rules'),
            'year' => date('Y'),
            'fees' => $this->request->getPost('fees'),            
        ];
       return !$updModel->update($id, $data) ? redirect()->to('/challenge/index/')->with('error','ERROR:: Unable to Update Data!!') : redirect()->to('/challenge/index/')->with('success','SUCCESS:: Data Updated!!');
    }   
## Awards Start
    public function awardInfoForm($page = 'awardinfoForm')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }
        $data['title'] = ucfirst('Insert Award');
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';
        $data['insert_mode'] = TRUE;
        $data['update_mode'] = FALSE;
        $data['action'] = base_url('challenge/insertAward');                   
        echo view('templates/header', $data);
        echo view('challenge/awardinfoForm', $data);
        echo view('templates/footer', $data); 
    }

# End    
}
