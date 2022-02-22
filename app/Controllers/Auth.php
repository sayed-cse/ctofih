<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Models\UserModel;
#use App\Libraries\Facebook;

class Auth extends BaseController
{
   public function __construct()
   {
     //parent::__construct();
   }
   public function index($page = 'index')
   {
   //Show Form
      if (! is_file(APPPATH . 'Views/challenge/' . $page . '.php')) { throw new \CodeIgniter\Exceptions\PageNotFoundException($page); }        
      $data['title'] = ucfirst('C.T.O Forum Innovation Hackathon'); 
      $data['dynarobot'] = 'index,nofollow,noarchive';
      $data['dynadesc'] = 'dynamic description data';
      $data['dynakey'] = 'dynamic keywords data';
      $data['dynagbot'] = 'index,follow';        
      echo view('templates/header', $data);      
      echo view('auth/index', $data);
      echo view('templates/footer', $data); 
   }
   public function isOnline($site = 'https://google.com'){ if(@fopen($site, 'r')){return true;}else{return false;} }
   public function signup()
   {
      $regUser = new UserModel();
      $umail = $this->request->getPost('umail');
      $uname = $this->request->getPost('uname');
      $passwd = $this->request->getPost('password');
      $csrf = $this->request->getPost(csrf_token());
      $class=md5(uniqid($umail, true));
      $random_id_length = 10;
      $rnd_id = substr($class,0,$random_id_length);

      if($this->request->getMethod() === 'post' && !empty($umail) && !empty($uname) && !empty($passwd) && !empty($csrf)){
         #Check if Data already exists
         $query = $regUser->where('umail', $umail)->first();
         if($query){
            return redirect()->back()->with('error','ERROR:: Data Exists!!');
         }else 
         {
#sendMail Configuration Begin
            $email = \Config\Services::email();               
            $config=array();
            $config['useragent'] = "C.T.O Forum";
            //$config['send_multipart'] = TRUE;
            $config['protocol'] = 'smtp';
            $config['SMTPPort'] = 465;
            $config['SMTPCrypto'] = 'ssl';
            $config['SMTPHost'] = 'smtp.googlemail.com';
            $config['SMTPUser'] = 'styledbee@gmail.com';
            $config['SMTPPass'] = '$#Admentor1';
            $config['mailtype'] = 'html';
            $config['wordwrap'] = true;
            $config['charset']  = 'utf-8';
            $config['priority'] = '1';
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
            $email->initialize($config);      
            $email->setHeader('X-Mailer', 'PHP/'.phpversion());
            $email->setHeader('Return-Path', 'webmaster@ctofih.org');      
            $email->setFrom('webmaster@ctofih.org', 'webmaster');
            $email->setReplyTo('webmaster@ctofih.org', 'webmaster');
            $email->setTo($umail);       
            $email->setSubject('Registration Verification: Continuous Impression');
            $email->setMessage('<strong style="color:#026180">Thanks for signing up!</strong><br/>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
            <br/>------------------------<br/>Login : '.$umail.'<br/>Password : '.trim($passwd).'<br/>------------------------<br/>
            Please <a href='.site_url('auth/verifySign/').'?umail='.$umail.'&salt='.$rnd_id.'>Click Here</a> to activate your account <br/><br/>Best regards,<br/><a href="www.ctofih.org">C.T.O Forum Innovation Hackathon</a><br/>webmaster<br/><br/>'); 
            $email->setAltMessage(trim(htmlspecialchars('This message sent via C.T.O Forum for Registration Verification. If you are unable to read your login and password please! Register again. Thank`s<br/> webmaster<br/>C.T.O Forum Innovation Hackathon Team'))); 
#sendMail Configuration End
#After Sending Validation Data Insert Information to database
         return $this->isOnline() ? $email->send() ? !$regUser->insert([
         'umail' => $umail,'uname' => $uname,'passwd' => md5($passwd),'status' => '0','type' => '2','role' => '2','salt' => $rnd_id,
         ]) ?  redirect()->back()->with('error','ERROR:: Unable to save! Try again.') : redirect()->back()->with('success','SUCCESS:: Please Check your email & confirm!')  : redirect()->back()->with('error','ERROR:: Unable to send Mail! Check Firewall')->withInput() : redirect()->back()->with('error','ERROR:: Check Your Internet! Contact webmaster')->withInput();
         }
      }else{
         return redirect()->back()->with('error','ERROR:: Required data mismatched!');
      }
   }
   public function verifySign()
   {
      //Update Database for account activate
      $request = \Config\Services::request();
      $rand = $request->getVar('salt');
      $userModel = new UserModel();
      $query = $userModel->where('salt', $rand)->findAll();
      foreach($query as $q){ $id = $q['id']; }
      if($query){
         $data =['status' => '1', 'salt' => '0',];
         if(! $userModel->update($id, $data)){
            return redirect()->to('/challenge/index/')->with('error','ERROR:: Unable to Activate!!');
         }else{
            return redirect()->to('/challenge/index/')->with('success','SUCCESS:: Your Account Activated!!');
         }
      } else{
         return redirect()->to('/challenge/index/')->with('error','ERROR:: You May Not Registered!!');
      }    
   }
   public function signin()
   {
      $session = session();
      $userModel = new UserModel();    
      $uname = $this->request->getVar('login');
      $passwd = $this->request->getVar('passwd');
      $loginType = $this->request->getVar('ltype');         
      $csrf = $this->request->getPost(csrf_token());
      if($this->request->getMethod() === 'post' &&  !empty($csrf) && !empty($uname)){
         $query = $userModel->where('umail', $uname)->first();
         if($query){            
            if ($query['passwd'] === md5($passwd) && $query['type'] === $loginType && $query['status'] === '1' && $query['salt'] === '0') {
               $sessionData = [
                 'id' => $query['id'],
                 'uname' => $query['uname'],
                 'umail' => $query['umail'],
                 'type' => $query['type'],
                 'role' => $query['role'],
               ];
               $session->set($sessionData);
               return redirect()->to('/challenge/index/')->with('success','SUCCESS:: Login Success!!');
            }else{
               return redirect()->back()->with('error','ERROR:: Invalid Login Credentials!!');
            }
         }else{
            return redirect()->back()->with('error','ERROR:: Please Register / Activate!!');
         }
      }else{
         return redirect()->back()->with('error','ERROR:: Access Denied!');
      }
   }
   public function logout(){ session()->destroy(); return redirect()->to('/challenge/index/')->with('success','SUCCESS:: Logout Success!!'); }
   public function acl()
   {

   }
}
?>

