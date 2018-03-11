<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller_AjaxBase {
    private $model_category = false;
    private $result = false;
    
    public function before()
        {
            parent::before();
            $this->model_category = new Model_Category();
	}
        
        public function action_remove_category()
	{
            $category_id = $this->request->post('category_id');
            $this->result = $this->model_category->removeCategory($category_id);
            $json_data['success'] = $this->result;
            $this->response->body(json_encode($json_data));
	}
        public function action_remove_notification()
	{
            $notification_id = $this->request->post('notification_id');
            $this->result = $this->model_category->removeNotification($notification_id);
            $json_data['success'] = $this->result;
            $this->response->body(json_encode($json_data));
	}
        
        public function action_add_category(){
            $name = $this->request->post('name');
            if($name){
                $id = $this->model_category->addCategory($name);
                if($id){
                    $data['id'] = $id;
                    $data['name'] = $name;
                    $json_data['data']=$data;
                    $this->result = true;
                }
            }
            $json_data['success'] = $this->result;
            $this->response->body(json_encode($json_data));
        }
        public function action_add_notification(){
            $name = $this->request->post('name');
            $category_id = $this->request->post('category_id');
            if($name && $category_id){
                $id = $this->model_category->addNotification($name,$category_id);
                if($id){
                    $data['id'] = $id;
                    $data['name'] = $name;
                    $data['category_name'] = $this->model_category->getCategoryNameById($category_id);
                    $json_data['data']=$data;
                    $this->result = true;
                }
            }
            $json_data['success'] = $this->result;
            $this->response->body(json_encode($json_data));
        }
        public function action_show_notification(){
            $showed_ids = $this->request->post('showed_ids');
            if($showed_ids){
                $notif = $this->model_category->selectNotification($showed_ids);
                if($notif){
                    $data['id'] = $notif['id'];
                    $data['text'] = $notif['text'];
                    $data['category_name'] = $notif['category_name'];
                    $json_data['data']=$data;
                    $this->result = true;
                }
            }
            $json_data['success'] = $this->result;
            $this->response->body(json_encode($json_data));
        }

} // End Ajax
