<?php defined('SYSPATH') or die('No direct script access.');

class Controller_AdminBase extends Controller_Template {
    
        public $template = 'main';
        
	public function before()
        {
            parent::before();
            
            if(!Auth::instance()->logged_in()){
                $this->redirect('/');
            }
	}

} // End Base
