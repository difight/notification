<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
            $content = View::factory('/page/index');
            $this->template->content = $content;  
	}

} // End Welcome
