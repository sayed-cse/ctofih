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
        helper(['url', 'file', 'text', 'form','string', 'download', 'html', 'security', 'cookie', 'validation', 'xml']);
    }
    public function index($page = 'index')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }        
        $data['title'] = ucfirst('CTO Forum Innovation Hackathon'); 
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
## Retrieve Registration Info    
    public function registrationinfo($page = 'reginfo')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }        
        $data['title'] = ucfirst('Registration Informations');
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';
        echo view('templates/header', $data);
        echo view('challenge/' . $page, $data);
        echo view('templates/footer', $data);
    }
## Registration Form     
    public function register($page = 'registration')
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
##Insert BasicInfo
    public function insertBasic()
    {
        $regModel = new RegisterModel();
        $db = db_connect();
        $db->protectIdentifiers('basicinfo', true);
        if($this->request->getMethod() === 'post' && !empty($this->request->getPost(csrf_token())) 
            && $this->validate([
        //'title' => 'required|min_length[3]',
         // 'tagline' => 'required|min_length[3]', 
         // 'description' => 'required|min_length[10]', 
         // 'schedule' => 'required', 
         // 'entrydate' => 'required', 
         // 'updatestatus' => 'required', 
         // 'rules' => 'required', 
         // 'year' => 'required', 
         // 'fees' => 'required',
       'basicfile' => 'mime_in[basicfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
        ])){
#Check if Data already exists
            if($db->simpleQuery('SELECT title FROM basicinfo WHERE title = "'.htmlspecialchars($this->request->getPost('title')).'"')){
                return redirect()->back()->with('error','ERROR:: Data Exists!!');
            } else {
# 
                $file = $this->request->getFile('basicfile');
                if($file->isValid() && ! $file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('images/basicinfo/', $newName);
                }

                if(!$regModel->save([
                    'title' => $newName,//$this->request->getPost('title'),
                    
                    // 'tagline' => $this->request->getPost('tagline'),
                    // 'description' => $this->request->getPost('description'),
                    // 'schedule' => $this->request->getPost('schedule'),
                    // 'entrydate' => $this->request->getPost('title'),
                    // 'updatestatus' => $this->request->getPost('entrydate'),
                    // 'rules' => $this->request->getPost('updatestatus'),
                    // 'title' => $this->request->getPost('rules'),
                    // 'fees' => $this->request->getPost('fees'),
                ])){
                    $db->close();
                    return redirect()->back()->with('error','ERROR:: Unable to save! Try again.');
                }else{
                    $db->close();
                    return redirect()->back()->with('success','SUCCESS:: Data Saved!');
                }
#
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
        echo view('challenge/registration', $data);
        $db->close();
        echo view('templates/footer', $data);        
    }    
#Update BasicInfo
    public function updateBasic()
    {
        $updModel = new RegisterModel();
        if(!$updModel->update([

        ])){

        }
    }
    public function roundinfo($page = 'round')
    {
        if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }        
        $data['title'] = ucfirst('Round Informations'); 
        $data['dynarobot'] = 'index,nofollow,noarchive';
        $data['dynadesc'] = 'dynamic description data';
        $data['dynakey'] = 'dynamic keywords data';
        $data['dynagbot'] = 'index,follow';        
        echo view('templates/header', $data);
        echo view('challenge/' . $page, $data);
        echo view('templates/footer', $data);
    }

# End    
}
