<?php
class Organizations extends _MainModel{

    //Добавление карточки организации
    //https://site/api/organization/addCardOrganization?name=testt&address=testt&logo_url=testt&coordinate_longitude=0.1&coordinate_latitude=0.2&status=blocked
    public function addCardOrganization(){
        if (!_MainModel::is_var('name') || !_MainModel::is_var('address') || 
            !_MainModel::is_var('logo_url') || !_MainModel::is_var('coordinate_longitude') ||
            !_MainModel::is_var('coordinate_latitude') || !_MainModel::is_var('status')) {
                _MainModel::viewJSON([
                    "error" => ["id" => 0, "type" => "Empty params"]
                ]); 
        }else{
                $result = _MainModel::table("organizations")->add(array('name' => $_GET['name'], 'address' => $_GET['address'], 'logo_url' => $_GET['logo_url'], 'coordinate_longitude' => $_GET['coordinate_longitude'], 'coordinate_latitude' => $_GET['coordinate_latitude'], 'status' => $_GET['status']))->send();
                _MainModel::viewJSON(["id" => $result]);
        }
    }


    //Редактирование карточки организации
    //https://site/api/organization/editCardOrganization?id=3&name=test5&address=test5&logo_url=test5&coordinate_longitude=0.999&coordinate_latitude=0.277&status=active
    public function editCardOrganization(){
        if (!_MainModel::is_var('id')){
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);            
        }else{
            $arr = [];
            if(_MainModel::is_var('name')){
                $arr['name'] = $_GET['name'];
            }
            if(_MainModel::is_var('address')){
                $arr['address'] = $_GET['address'];
            }
            if(_MainModel::is_var('logo_url')){
                $arr['logo_url'] = $_GET['logo_url'];
            }
            if(_MainModel::is_var('coordinate_longitude')){
                $arr['coordinate_longitude'] = $_GET['coordinate_longitude'];
            }
            if(_MainModel::is_var('coordinate_latitude')){
                $arr['coordinate_latitude'] = $_GET['coordinate_latitude'];
            }
            if(_MainModel::is_var('status')){
                $arr['status'] = $_GET['status'];
            }
            
            $result = _MainModel::table("organizations")->edit($arr, array('id' => $_GET['id']))->send();    
        }
    }


    //Удаление карточки организации
    //https://site/api/organization/deleteCardOrganization?id=4
    public function deleteCardOrganization(){
        if (!_MainModel::is_var('id')){
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
                ]);
        }else{
            $result = _MainModel::table("organizations")->delete(array('id' => $_GET['id']))->send();
        }
    }


    //Вывод карточки организации
    //https://site/api/organization/getCardOrganization?id=3
    public function getCardOrganization(){
        if (!_MainModel::is_var('id')){
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);            
        }else{
            $result = _MainModel::table("organizations")->get()->filter(array('id' => $_GET['id']))->send();    
            _MainModel::viewJSON($result);
        }
    }


    //Редактирование logo_url карточки организации
    //https://site/api/organization/editLogoUrl?id=3&logo_url=testedit
    public function editLogoUrl(){
        if (!_MainModel::is_var('id')){
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
            ]);            
        }else{
            if(_MainModel::is_var('logo_url')){
                $result = _MainModel::table("organizations")->edit(array('logo_url' => $_GET['logo_url']), array('id' => $_GET['id']))->send();    
            }
            else{ 
                _MainModel::viewJSON([
                 "error" => ["id" => 1, "type" => "Empty logo_url"]   
                 ]);  
            }
        }
    }

    //Добавление карточки в таблицу staff
    //https://site/api/organization/addCardStaff?user_id=6&organization_id=1&position=studio administrator&status=processing&end_date=2020-03-12
    public function addCardStaff(){
        if (!_MainModel::is_var('user_id') || !_MainModel::is_var('organization_id') || 
            !_MainModel::is_var('position') || !_MainModel::is_var('status') || !_MainModel::is_var('end_date')){
                _MainModel::viewJSON([
                    "error" => ["id" => 0, "type" => "Empty params"]
                ]); 
        }else{
                $result = _MainModel::table("staff")->add(array('user_id' => $_GET['user_id'], 'organization_id' => $_GET['organization_id'], 'position' => $_GET['position'], 'status' => $_GET['status'], 'end_date' => $_GET['end_date']))->send();
                _MainModel::viewJSON(["id" => $result]);
        }
    }


    //Редактирование карточки в таблице staff
    //https://site/api/organization/editCardStaff?id=2&user_id=8&organization_id=3&position=owner&status=rejected&end_date=2020-08-11
    public function editCardStaff(){
        if (!_MainModel::is_var('id')){
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
            ]);           
        }else{
            $arr = [];
            if(_MainModel::is_var('user_id')){
                $arr['user_id'] = $_GET['user_id'];
            }
            if(_MainModel::is_var('organization_id')){
                $arr['organization_id'] = $_GET['organization_id'];
            }
            if(_MainModel::is_var('position')){
                $arr['position'] = $_GET['position'];
            }
            if(_MainModel::is_var('status')){
                $arr['status'] = $_GET['status'];
            }
            if(_MainModel::is_var('end_date')){
                $arr['end_date'] = $_GET['end_date'];
            }

            $result = _MainModel::table("staff")->edit($arr, array('id' => $_GET['id']))->send();    
        }
    }

    //Удаление карточки в таблице staff
    //https://site/api/organization/deleteCardStaff?id=3
    public function deleteCardStaff(){
        if (!_MainModel::is_var('id')){
            _MainModel::viewJSON([
                "error"=>["id" => 0, "type" => "Empty ID"]
            ]);  
        }else{
            $result = _MainModel::table("staff")->delete(array('id' => $_GET['id']))->send();
        }
    }
    

    //Вывод списка сотрудников салона (таблица stuff)
    //https://site/api/organization/getAllStaff
    public function getAllStaff(){
        $result = _MainModel::table("staff")->get()->send();
        _MainModel::viewJSON($result);
    }


    //Добавление карточки в таблицу staff_payments
    //https://site/api/organization/addCardStaffPayments?staff_id=1&payer_id=6&sum=111
    public function addCardStaffPayments(){
        if (!_MainModel::is_var('staff_id') || !_MainModel::is_var('payer_id') || !_MainModel::is_var('sum')){
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty params"]
            ]); 
        }else{
             $result = _MainModel::table("staff_payments")->add(array('staff_id' => $_GET['staff_id'], 'payer_id' => $_GET['payer_id'], 'sum' => $_GET['sum']))->send();
             _MainModel::viewJSON(["id" => $result]);
        }
    }

    //Редактирование карточки в таблице staff_payments
    //https://site/api/organization/editCardStaffPayments?id=1&staff_id=2&payer_id=7&sum=322
    public function editCardStaffPayments(){
        if (!_MainModel::is_var('id')){
             _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
             ]);             
        }else{
            $arr = [];
            if(_MainModel::is_var('staff_id')){
                $arr['staff_id'] = $_GET['staff_id'];
            }
            if(_MainModel::is_var('payer_id')){
                $arr['payer_id'] = $_GET['payer_id'];
            }
            if(_MainModel::is_var('sum')){
                $arr['sum'] = $_GET['sum'];
            }

            $result = _MainModel::table("staff_payments")->edit($arr, array('id' => $_GET['id']))->send();    
        }
    }

    //Удаление карточки в таблице staff_payments
    //https://site/api/organization/deleteCardStaffPayments?id=2
    public function deleteCardStaffPayments(){
        if (!_MainModel::is_var('id')){
           _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
            ]);   
        }else{
            $result = _MainModel::table("staff_payments")->delete(array('id' => $_GET['id']))->send();
        }
    }

    //Вывод всех организаций (фильтрация, пагинация, поиск)
    //https://site/api/organization/searchAllOrganization?search=test&limit=0,6
    public function searchAllOrganization(){
        if (!_MainModel::is_var('search') || !_MainModel::is_var('limit')) {
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty params"]
            ]); 
        }else{
            $search = $_GET['search'];
            $lm = $_GET['limit'];
            $stmt = self::$db->prepare("SELECT * FROM `organizations` WHERE `name` LIKE '%$search%' OR `address` LIKE '%$search%' LIMIT $lm");
            $result_query = $stmt->execute(array());
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
            if ($rows) {
                _MainModel::viewJSON($rows);
            }else{
                _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Nothing found"]
                ]); 
            }
        }
    }

}
?>
