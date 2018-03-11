<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_AdminBase {
    
        private $error = false;
        
        private $model_category = false;
        
        public function before()
        {
            parent::before();
            $this->model_category = new Model_Category();
	}
        
        public function action_index()
	{
            $categoies = $this->model_category->selectAllCategories();
            $notification = $this->model_category->selectAllNotification();
            $content = View::factory('/page/admin')
                    ->bind('categories',$categoies)
                    ->bind('notification',$notification);
            $this->template->content = $content;  
	}
        
        public function action_logout()
	{
            Auth::instance()->logout();
            $this->redirect('/');
	}

} // End Admin
