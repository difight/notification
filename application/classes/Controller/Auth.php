<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Base {
    
        public $error = false;
        
        public function action_login()
	{
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            if ($username && $password) 
                {
                
                    if (!Auth::instance()->login($username, $password))
                    {
                        $this->error = true;
                    } else {
                        $this->redirect('/admin');
                    }

                }
            $content = View::factory('/page/login')
                    ->bind('error',$this->error);
            $this->template->content = $content;  
	}        
        

} // End Welcome
