<?php
class Organizations extends _MainModel{

	//Добавление карточки организации
    // http://site/api/organization/addCardOrganization?name=testt&adress=testt&logo_url=testt&coordinate_longitude=0.1&coordinate_latitude=0.2&status=blocked
    public function addCardOrganization(){
        if (!isset($_GET['name']) || !isset($_GET['adress']) || 
        	!isset($_GET['logo_url']) || !isset($_GET['coordinate_longitude']) ||
        	!isset($_GET['coordinate_latitude']) || !isset($_GET['status'])) {
        		_MainModel::viewJSON(["error"=>"Empty params"]); 
    	} else {
    			$result = _MainModel::table("organizations")->add(array('name' => $_GET['name'], 'adress' => $_GET['adress'], 'logo_url' => $_GET['logo_url'], 'coordinate_longitude' => $_GET['coordinate_longitude'], 'coordinate_latitude' => $_GET['coordinate_latitude'], 'status' => $_GET['status']))->send();
    			_MainModel::viewJSON($result);
        }
    }



    //Редактирование карточки организации
    //http://site/api/organization/editCardOrganization?id=3&name=test5&adress=test5&logo_url=test5&coordinate_longitude=0.999&coordinate_latitude=0.277&status=active
    public function editCardOrganization(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            $arr = [];
            if(isset($_GET['name'])){
                $arr['name']=$_GET['name'];
            }
            if(isset($_GET['adress'])){
                $arr['adress']=$_GET['adress'];
            }
            if(isset($_GET['logo_url'])){
                $arr['logo_url']=$_GET['logo_url'];
            }
            if(isset($_GET['coordinate_longitude'])){
                $arr['coordinate_longitude']=$_GET['coordinate_longitude'];
            }
            if(isset($_GET['coordinate_latitude'])){
                $arr['coordinate_latitude']=$_GET['coordinate_latitude'];
            }
            if(isset($_GET['status'])){
                $arr['status']=$_GET['status'];
            }
        $result = _MainModel::table("organizations")->edit($arr, array('id'=>$_GET['id']))->send();    

        }
    }


    //Удаление карточки организации
    //http://site/api/organization/deleteCardOrganization?id=4
    public function deleteCardOrganization(){
        if (empty($_GET ['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);
        }else{

            $result = _MainModel::table("organizations")->delete(array('id' => $_GET['id']))->send();
        }
    }


    //Вывод карточки организации
    //http://site/api/organization/getCardOrganization?id=3
    public function getCardOrganization(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            
            $result = _MainModel::table("organizations")->get()->filter(array('id'=>$_GET['id']))->send();    
            _MainModel::viewJSON($result);
        }
    }


    //Редактирование logo_url карточки организации
    //http://site/api/organization/editLogoUrl?id=3&logo_url=testedit
    public function editLogoUrl(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            if (isset($_GET['logo_url'])){
                $result = _MainModel::table("organizations")->edit(array('logo_url' => $_GET['logo_url']), array('id'=>$_GET['id']))->send();    
            }
            else{
                 _MainModel::viewJSON(["error"=>"Empty logo_url"]);      
            }

        }
    }

    //Добавление карточки в таблицу staff
    // http://site/api/organization/addCardStaff?user_id=6&organization_id=1&position=studio administrator&status=processing&end_date=2020-03-12
    public function addCardStaff(){
        if (!isset($_GET['user_id']) || !isset($_GET['organization_id']) || 
            !isset($_GET['position']) || !isset($_GET['status']) ||
            !isset($_GET['end_date'])) {
                _MainModel::viewJSON(["error"=>"Empty params"]); 
        } else {
                $result = _MainModel::table("staff")->add(array('user_id' => $_GET['user_id'], 'organization_id' => $_GET['organization_id'], 'position' => $_GET['position'], 'status' => $_GET['status'], 'end_date' => $_GET['end_date']))->send();
                _MainModel::viewJSON($result);
        }
    }


    //Редактирование карточки в таблице staff
    //http://site/api/organization/editCardStaff?id=2&user_id=8&organization_id=3&position=owner&status=rejected&end_date=2020-08-11
    public function editCardStaff(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            $arr = [];
            if(isset($_GET['user_id'])){
                $arr['user_id']=$_GET['user_id'];
            }
            if(isset($_GET['organization_id'])){
                $arr['organization_id']=$_GET['organization_id'];
            }
            if(isset($_GET['position'])){
                $arr['position']=$_GET['position'];
            }
            if(isset($_GET['status'])){
                $arr['status']=$_GET['status'];
            }
            if(isset($_GET['end_date'])){
                $arr['end_date']=$_GET['end_date'];
            }
        $result = _MainModel::table("staff")->edit($arr, array('id'=>$_GET['id']))->send();    

        }
    }

    //Удаление карточки в таблице staff
    //http://site/api/organization/deleteCardStaff?id=3
    public function deleteCardStaff(){
        if (empty($_GET ['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);
        }else{

            $result = _MainModel::table("staff")->delete(array('id' => $_GET['id']))->send();
        }
    }
    

    //Вывод списка сотрудников салона (таблица stuff)
    //http://site/api/organization/getAllStaff
    public function getAllStaff(){
        $result = _MainModel::table("staff")->get()->send();
        _MainModel::viewJSON($result);
    }


    //Добавление карточки в таблицу staff_payments
    //http://site/api/organization/addCardStaffPayments?staff_id=1&payer_id=6&sum=111
    public function addCardStaffPayments(){
        if (!isset($_GET['staff_id']) || !isset($_GET['payer_id']) || 
            !isset($_GET['sum'])) {
                _MainModel::viewJSON(["error"=>"Empty params"]); 
        } else {
                $result = _MainModel::table("staff_payments")->add(array('staff_id' => $_GET['staff_id'], 'payer_id' => $_GET['payer_id'], 'sum' => $_GET['sum']))->send();
                _MainModel::viewJSON($result);
        }
    }

    //Редактирование карточки в таблице staff_payments
    //http://site/api/organization/editCardStaffPayments?id=1&staff_id=2&payer_id=7&sum=322
    public function editCardStaffPayments(){
        if (!isset($_GET['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);            
        }else{
            $arr = [];
            if(isset($_GET['staff_id'])){
                $arr['staff_id']=$_GET['staff_id'];
            }
            if(isset($_GET['payer_id'])){
                $arr['payer_id']=$_GET['payer_id'];
            }
            if(isset($_GET['sum'])){
                $arr['sum']=$_GET['sum'];
            }

        $result = _MainModel::table("staff_payments")->edit($arr, array('id'=>$_GET['id']))->send();    

        }
    }

    //Удаление карточки в таблице staff_payments
    //http://site/api/organization/deleteCardStaffPayments?id=2
    public function deleteCardStaffPayments(){
        if (empty($_GET ['id'])){
            _MainModel::viewJSON(["error"=>"Empty ID"]);
        }else{

            $result = _MainModel::table("staff_payments")->delete(array('id' => $_GET['id']))->send();
        }
    }

}
?>