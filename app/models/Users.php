<?php
 
class Users extends _MainModel{

	//Добавление карточки пользователя
    // http://site/api/user/addCardUser?avatar_url=test&role=test&status=test&parent_id=1&rating=0&language=ru
    public function addCardUser(){
        if (!isset($_GET['avatar_url']) || !isset($_GET['role']) || 
        	!isset($_GET['status']) || !isset($_GET['parent_id']) ||
        	!isset($_GET['rating'])) {
        		_MainModel::viewJSON(["error"=>"Empty params"]);; 
    	}else{
    			$result = _MainModel::table("users_cards")->add(array('avatar_url' => $_GET['avatar_url'], 'role' => $_GET['role'], 'status' => $_GET['status'], 'parent_id' => $_GET['parent_id'], 'rating' => $_GET['rating'], 'language' => $_GET['language']))->send();
    			_MainModel::viewJSON($result);
        }
    }

    //Добавление координат пользователя
    //http://site/api/user/addCoorUser?user_id=3&coordinate_longitude=1&coordinate_latitude=1&radius_km=1&radius_unit=1&convenient_time=05:00:00
    public function addСoorUser(){
        if (!isset($_GET['user_id']) || !isset($_GET['coordinate_longitude']) ||
            !isset($_GET['coordinate_latitude']) || !isset($_GET['radius_km'])||
            !isset($_GET['radius_unit']) || !isset($_GET['convenient_time'])) {
                _MainModel::viewJSON(["error"=>"Empty params"]);; 
        }else{
                $result = _MainModel::table("user_coordinates")->add(array('user_id' => $_GET['user_id'], 'coordinate_longitude' => $_GET['coordinate_longitude'], 'coordinate_latitude' => $_GET['coordinate_latitude'], 'radius_km' => $_GET['radius_km'], 'radius_unit' => $_GET['radius_unit'], 'convenient_time' => $_GET['convenient_time']))->send();
                _MainModel::viewJSON($result);
        }
    }

    //Добавление токена пользователя
    //http://site/api/user/addTokenUser?user_id=3&creation_time=15:00:00&session_data=2020-02-12
    public function addTokenUser(){
        if (!isset($_GET['user_id']) || !isset($_GET['creation_time']) ||
            !isset($_GET['session_data'])) {
                _MainModel::viewJSON(["error"=>"Empty params"]);; 
        }else{
                $result = _MainModel::table("users_tokens")->add(array('user_id' => $_GET['user_id'], 'creation_time' => $_GET['creation_time'], 'session_data' => $_GET['session_data']))->send();
                _MainModel::viewJSON($result);
        }
    }

    //Удаление токена пользователя
    //http://site/api/user/deleteTokenUser?key_id=1
    public function deleteTokenUser(){
        if (!isset($_GET['key_id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);
        }else{
            $result = _MainModel::table("users_tokens")->delete(array('key_id' => $_GET['key_id']))->send();
        }
    }

    //Редактирование поля avatar_url
    //http://site/api/user/editAvatarUser?id=3&avatar_url=testedit
    public function editAvatarUser(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            if (isset($_GET['avatar_url'])){
                $result = _MainModel::table("users_cards")->edit(array('avatar_url' => $_GET['avatar_url']), array('id'=>$_GET['id']))->send();    
            }
            else{
                 _MainModel::viewJSON(["error"=>"Empty avatar_url"]);      
            }


        }
    }

    //Редактирование карточки пользователя
    //http://site/api/user/editCardUser?id=3&avatar_url=testedit&role=testedit&rating=1000
    public function editCardUser(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            $arr = [];
            if(isset($_GET['avatar_url'])){
                $arr['avatar_url']=$_GET['avatar_url'];
            }
            if(isset($_GET['role'])){
                $arr['role']=$_GET['role'];
            }
            if(isset($_GET['status'])){
                $arr['status']=$_GET['status'];
            }
            if(isset($_GET['parent_id'])){
                $arr['parent_id']=$_GET['parent_id'];
            }
            if(isset($_GET['rating'])){
                $arr['rating']=$_GET['rating'];
            }
            if(isset($_GET['language'])){
                $arr['language']=$_GET['language'];
            }
        $result = _MainModel::table("users_cards")->edit($arr, array('id'=>$_GET['id']))->send();    

        }
    }

    //Вывод данных карточки пользователя
    //http://site/api/user/getCardUser?id=3
    public function getCardUser(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            
            $result = _MainModel::table("users_cards")->get()->filter(array('id'=>$_GET['id']))->send();    
            _MainModel::viewJSON($result);
        }
    }

    //Вывод данных карточки пользователя с данными координат
    //http://site/api/user/getCardCoorUser?id=3
    public function getCardCoorUser(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            $id = $_GET['id'];
            $stmt = self::$db->prepare("SELECT * FROM users_cards JOIN user_coordinates WHERE users_cards.id = $id AND users_cards.id = user_coordinates.user_id");
            $result_query = $stmt->execute(array());
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            _MainModel::viewJSON($rows);

        }
    }

    //Удаление координат пользователя
    //http://site/api/user/deleteCoorUser?id=1
    public function deleteCoorUser(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);
        }else{
            $result = _MainModel::table("user_coordinates")->delete(array('id' => $_GET['id']))->send();
        }
    }

    //Список геоточек и радиусов
    //http://site/api/user/getCoorUser
    public function getCoorUser(){
            $result = _MainModel::table("user_coordinates")->get()->send();    
            _MainModel::viewJSON($result);
    }
}
?>