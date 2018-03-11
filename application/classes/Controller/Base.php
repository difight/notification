<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template {
    
        public $template = 'main';
        
	public function before()
        {
            parent::before();
            
            if(Auth::instance()->logged_in()){
                $this->redirect('/admin');
            }
	}

} // End Base
