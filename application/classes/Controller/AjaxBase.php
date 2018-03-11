<?php defined('SYSPATH') or die('No direct script access.');

class Controller_AjaxBase extends Controller {
        
	public function before()
        {
            parent::before();
            if (!Request::initial()->is_ajax())
                $this->response->status(404);
            
            $this->response->headers('Content-Type','application/json');
	}

} // End Base
