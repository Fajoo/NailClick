<?php

class Users extends _MainModel
{

    //Добавление карточки пользователя
    // http://site/api/user/addCardUser?avatar_url=test&role=test&status=test&parent_id=1&rating=1&language=ru
    public function addCardUser()
    {
        if (
            !_MainModel::is_var('avatar_url') || !_MainModel::is_var('role') ||
            !_MainModel::is_var('status') || !_MainModel::is_var('parent_id') ||
            !_MainModel::is_var('rating')
        ) {
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty params"]
            ]);
        } else {
            $result = _MainModel::table("users_cards")->add(array('avatar_url' => $_GET['avatar_url'], 'role' => $_GET['role'], 'status' => $_GET['status'], 'parent_id' => $_GET['parent_id'], 'rating' => $_GET['rating'], 'language' => $_GET['language']))->send();
            _MainModel::viewJSON(["id" => $result]);
        }
    }

    //Добавление координат пользователя
    //http://site/api/user/addCoorUser?user_id=3&coordinate_longitude=1&coordinate_latitude=1&radius_km=1&radius_unit=1&convenient_time=05:00:00
    public function addСoorUser()
    {
        if (
            !_MainModel::is_var('user_id') || !_MainModel::is_var('coordinate_longitude') ||
            !_MainModel::is_var('coordinate_latitude') || !_MainModel::is_var('radius_km') ||
            !_MainModel::is_var('radius_unit') || !_MainModel::is_var('convenient_time')
        ) {
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty params"]
            ]);
        } else {
            $result = _MainModel::table("user_coordinates")->add(array('user_id' => $_GET['user_id'], 'coordinate_longitude' => $_GET['coordinate_longitude'], 'coordinate_latitude' => $_GET['coordinate_latitude'], 'radius_km' => $_GET['radius_km'], 'radius_unit' => $_GET['radius_unit'], 'convenient_time' => $_GET['convenient_time']))->send();
            _MainModel::viewJSON(["id" => $result]);
        }
    }

    //Добавление токена пользователя
    //http://site/api/user/addTokenUser?key=1&user_id=3&creation_time=15:00:00&session_data=2020-02-12
    public function addTokenUser()
    {
        if (
            !_MainModel::is_var('key') || !_MainModel::is_var('user_id') || !_MainModel::is_var('creation_time') ||
            !_MainModel::is_var('session_data')
        ) {
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty params"]
            ]);
        } else {
            $result = _MainModel::table("users_tokens")->add(array('key' => $_GET['key'], 'user_id' => $_GET['user_id'], 'creation_time' => $_GET['creation_time'], 'session_data' => $_GET['session_data']))->send();
            _MainModel::viewJSON(["id" => $result]);
        }
    }

    //Удаление токена пользователя
    //http://site/api/user/deleteTokenUser?key=1
    public function deleteTokenUser()
    {
        if (!_MainModel::is_var('key')) {
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);
        } else {
            $id = $_GET['key'];
            $stmt = self::$db->prepare("DELETE FROM users_tokens WHERE users_tokens.key='$id'");
            $result_query = $stmt->execute(array());
        }
    }

    //Редактирование поля avatar_url
    //http://site/api/user/editAvatarUser?id=3&avatar_url=testedit
    public function editAvatarUser()
    {
        if (!_MainModel::is_var('id')) {
            _MainModel::viewJSON([
                "error" => ["id" => 0, "type" => "Empty ID"]
            ]);
        } else {
            if (_MainModel::is_var('avatar_url')) {
                $result = _MainModel::table("users_cards")->edit(array('avatar_url' => $_GET['avatar_url']), array('id' => $_GET['id']))->send();
            } else {
                _MainModel::viewJSON([
                    "error" => ["id" => 1, "type" => "Empty avatar_url"]
                ]);
            }
        }
    }

    //Редактирование карточки пользователя
    //http://site/api/user/editCardUser?id=3&avatar_url=testedit&role=testedit&rating=1000
    public function editCardUser()
    {
        if (!_MainModel::is_var('id')) {
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);
        } else {
            $arr = [];
            if (_MainModel::is_var('avatar_url')) {
                $arr['avatar_url'] = $_GET['avatar_url'];
            }
            if (_MainModel::is_var('role')) {
                $arr['role'] = $_GET['role'];
            }
            if (_MainModel::is_var('status')) {
                $arr['status'] = $_GET['status'];
            }
            if (_MainModel::is_var('parent_id')) {
                $arr['parent_id'] = $_GET['parent_id'];
            }
            if (_MainModel::is_var('rating')) {
                $arr['rating'] = $_GET['rating'];
            }
            if (_MainModel::is_var('language')) {
                $arr['language'] = $_GET['language'];
            }
            $result = _MainModel::table("users_cards")->edit($arr, array('id' => $_GET['id']))->send();
        }
    }

    //Вывод данных карточки пользователя
    //http://site/api/user/getCardUser?id=3
    public function getCardUser()
    {
        if (!_MainModel::is_var('id')) {
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);
        } else {

            $result = _MainModel::table("users_cards")->get()->filter(array('id' => $_GET['id']))->send();
            _MainModel::viewJSON($result);
        }
    }

    //Вывод данных карточки пользователя с данными координат
    //http://site/api/user/getCardCoorUser?id=3
    public function getCardCoorUser()
    {
        if (!_MainModel::is_var('id')) {
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);
        } else {
            $id = $_GET['id'];
            $stmt = self::$db->prepare("SELECT * FROM users_cards JOIN user_coordinates WHERE users_cards.id = $id AND users_cards.id = user_coordinates.user_id");
            $result_query = $stmt->execute(array());
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            _MainModel::viewJSON($rows);
        }
    }

    //Удаление координат пользователя
    //http://site/api/user/deleteCoorUser?id=1
    public function deleteCoorUser()
    {
        if (!_MainModel::is_var('id')) {
            _MainModel::viewJSON([
                "error" => ["id" => 1, "type" => "Empty ID"]
            ]);
        } else {
            $result = _MainModel::table("user_coordinates")->delete(array('id' => $_GET['id']))->send();
        }
    }

    //Список геоточек и радиусов
    //http://site/api/user/getCoorUser
    public function getCoorUser()
    {
        $result = _MainModel::table("user_coordinates")->get()->send();
        _MainModel::viewJSON($result);
    }
}
