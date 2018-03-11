<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Category extends Model
{
    public function selectAllCategories()
    {	
        $total_menu = array();
        $query = DB::query(Database::SELECT, 'SELECT * FROM `category_notification` '); 
	$result = $query->execute()->as_array(); 
        
        return $result;		
    }
    public function selectNotification($showed_ids = false)
    {	
        if(!$showed_ids)
            return false;
        
        $total_menu = array();
        $query = DB::query(Database::SELECT, 'SELECT n.id as id,n.text as text,n.viewed as viewed, cn.name as category_name FROM `notification` as n '
                . 'INNER JOIN `category_notification` as cn ON cn.id = n.category_id and n.id not in ('.$showed_ids.') ORDER BY n.dateadd limit 1'); 
	$result = $query->execute()->as_array(); 
        
        return (isset($result[0])) ? $result[0] : false;		
    }

    public function selectAllNotification()
    {	
        $total_menu = array();
        $query = DB::query(Database::SELECT, 'SELECT n.id as id,n.text as text,n.viewed as viewed, cn.name as category_name FROM `notification` as n '
                . 'INNER JOIN `category_notification` as cn ON cn.id = n.category_id '); 
	$result = $query->execute()->as_array(); 
        
        return $result;		
    }
    public function removeCategory($category_id = false){
        if(!$category_id)
            return false;
        $query = DB::query(Database::DELETE, 'DELETE FROM `category_notification` WHERE id = :id')
                ->bind(':id',$category_id);
        $result = $query->execute();
        return $result;
    }
    public function removeNotification($notification_id = false){
        if(!$notification_id)
            return false;
        $query = DB::query(Database::DELETE, 'DELETE FROM `notification` WHERE id = :id')
                ->bind(':id',$notification_id);
        $result = $query->execute();
        return $result;
    }    
    public function addCategory($name = ''){
        if(!$name)
            return false;
        $query = DB::query(Database::INSERT, 'INSERT INTO `category_notification` SET name=:name')
                ->bind(':name',$name);        
        $result = $query->execute();
        return $result[0];
    }
    public function getCategoryNameById($category_id = false){
        if(!$category_id)
            return false;
        $query = DB::query(Database::SELECT, 'SELECT name FROM `category_notification` where id=:id')
                ->bind(':id',$category_id);        
        $result = $query->execute()->get('name');
        return $result;
    }
    public function addNotification($name = '',$category_id = false){
        if(!$name || !$category_id)
            return false;
        $query = DB::query(Database::INSERT, 'INSERT INTO `notification` SET text=:text,category_id = :category_id')
                ->bind(':text',$name)
                ->bind(':category_id',$category_id);        
        $result = $query->execute();
        return $result[0];
    }
    
    
}