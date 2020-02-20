<?php
class Organizations extends _MainModel{

    //Добавление карточки организации
    //https://site/api/organization/addCardOrganization?name=testt&adress=testt&logo_url=testt&coordinate_longitude=0.1&coordinate_latitude=0.2&status=blocked
    public function addCardOrganization(){
        if (empty($_GET['name']) || empty($_GET['adress']) || 
            empty($_GET['logo_url']) || empty($_GET['coordinate_longitude']) ||
            empty($_GET['coordinate_latitude']) || empty($_GET['status'])) {
                _MainModel::viewJSON([
                    "error" => ["id" => 0, "type" => "Empty params"]
                ]); 
        }else{
                $result = _MainModel::table("organizations")->add(array('name' => $_GET['name'], 'adress' => $_GET['adress'], 'logo_url' => $_GET['logo_url'], 'coordinate_longitude' => $_GET['coordinate_longitude'], 'coordinate_latitude' => $_GET['coordinate_latitude'], 'status' => $_GET['status']))->send();
                _MainModel::viewJSON(["id" => $result]);
        }
    }


    //Редактирование карточки организации
    //https://site/api/organization/editCardOrganization?id=3&name=test5&adress=test5&logo_url=test5&coordinate_longitude=0.999&coordinate_latitude=0.277&status=active
    public function editCardOrganization(){
        if (empty($_GET['id'])){
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);            
        }else{
            $arr = [];
            if(!empty($_GET['name'])){
                $arr['name'] = $_GET['name'];
            }
            if(!empty($_GET['adress'])){
                $arr['adress'] = $_GET['adress'];
            }
            if(!empty($_GET['logo_url'])){
                $arr['logo_url'] = $_GET['logo_url'];
            }
            if(!empty($_GET['coordinate_longitude'])){
                $arr['coordinate_longitude'] = $_GET['coordinate_longitude'];
            }
            if(!empty($_GET['coordinate_latitude'])){
                $arr['coordinate_latitude'] = $_GET['coordinate_latitude'];
            }
            if(!empty($_GET['status'])){
                $arr['status'] = $_GET['status'];
            }
            
            $result = _MainModel::table("organizations")->edit($arr, array('id' => $_GET['id']))->send();    
        }
    }


    //Удаление карточки организации
    //https://site/api/organization/deleteCardOrganization?id=4
    public function deleteCardOrganization(){
        if (empty($_GET ['id'])){
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
        if (empty($_GET['id'])){
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
        if (empty($_GET['id'])){
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
            ]);            
        }else{
            if(!empty($_GET['logo_url'])){
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
        if (empty($_GET['user_id']) || empty($_GET['organization_id']) || 
            empty($_GET['position']) || empty($_GET['status']) || empty($_GET['end_date'])){
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
        if (empty($_GET['id'])){
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
            ]);           
        }else{
            $arr = [];
            if(!empty($_GET['user_id'])){
                $arr['user_id'] = $_GET['user_id'];
            }
            if(!empty($_GET['organization_id'])){
                $arr['organization_id'] = $_GET['organization_id'];
            }
            if(!empty($_GET['position'])){
                $arr['position'] = $_GET['position'];
            }
            if(!empty($_GET['status'])){
                $arr['status'] = $_GET['status'];
            }
            if(!empty($_GET['end_date'])){
                $arr['end_date'] = $_GET['end_date'];
            }

            $result = _MainModel::table("staff")->edit($arr, array('id' => $_GET['id']))->send();    
        }
    }

    //Удаление карточки в таблице staff
    //https://site/api/organization/deleteCardStaff?id=3
    public function deleteCardStaff(){
        if (empty($_GET ['id'])){
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
        if (empty($_GET['staff_id']) || empty($_GET['payer_id']) || empty($_GET['sum'])){
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
        if (empty($_GET['id'])){
             _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
             ]);             
        }else{
            $arr = [];
            if(!empty($_GET['staff_id'])){
                $arr['staff_id'] = $_GET['staff_id'];
            }
            if(!empty($_GET['payer_id'])){
                $arr['payer_id'] = $_GET['payer_id'];
            }
            if(!empty($_GET['sum'])){
                $arr['sum'] = $_GET['sum'];
            }

            $result = _MainModel::table("staff_payments")->edit($arr, array('id' => $_GET['id']))->send();    
        }
    }

    //Удаление карточки в таблице staff_payments
    //https://site/api/organization/deleteCardStaffPayments?id=2
    public function deleteCardStaffPayments(){
        if (empty($_GET['id'])){
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
        if (empty($_GET['search']) || empty($_GET['limit'])) {
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty params"]
            ]); 
        }else{
            $search = $_GET['search'];
            $lm = $_GET['limit'];
            $stmt = self::$db->prepare("SELECT * FROM `organizations` WHERE `name` LIKE '%$search%' OR `adress` LIKE '%$search%' LIMIT $lm");
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
