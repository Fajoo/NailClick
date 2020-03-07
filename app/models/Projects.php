<?php

class Projects extends _MainModel
{
    // Добавление нового проекта
	public function AddProject()
    {
	if (!_MainModel::is_var('name') || !_MainModel::is_var('description') ||
        !_MainModel::is_var('status') || !_MainModel::is_var('photo_folder_id'))
	{
        _MainModel::viewJSON(["error" => ["id" => 0, "type" => "Empty params"]]);
    }
    else
    {
		$result = _MainModel::table("projects")->add(array('name' => $_GET['name'], 'description' => $_GET['description'], 'status' => $_GET['status'], 'photo_folder_id' => $_GET['photo_folder_id']))->send();
        _MainModel::viewJSON(["id" => $result]);
	}
	}

	// Удаление проекта
    public function DeleteProject()
    {
    if (!_MainModel::is_var('id'))
    {
        _MainModel::viewJSON(["error" => ["id" => 1, "type" => "Empty ID"]]);
    }
    else
    {
        $id = $_GET['id'];
        $stmt = self::$db->prepare("DELETE FROM projects WHERE projects.id='$id'");
        $result_query = $stmt->execute(array());
    }
	}

    // Вывод проекта по id
    public function ShowProject()
    {
    if (!_MainModel::is_var('id'))
    {
        _MainModel::viewJSON(["error" => ["id" => 1, "type" => "Empty ID"]]);
    }
    else
    {
        $result = _MainModel::table("projects")->get()->filter(array('id' => $_GET['id']))->send();
        _MainModel::viewJSON($result);
    }
	}

    // Редактирование проекта
    public function EditProject()
    {
    if (!_MainModel::is_var('id'))
    {
        _MainModel::viewJSON(["error" => ["id" => 1, "type" => "Empty ID"]]);
    }
    else
    {
        $arr = [];

        if (_MainModel::is_var('name')) 
        {
            $arr['name'] = $_GET['name'];
        }
        if (_MainModel::is_var('description')) 
        {
            $arr['description'] = $_GET['description'];
        }
        if (_MainModel::is_var('status')) 
        {
            $arr['status'] = $_GET['status'];
        }
        if (_MainModel::is_var('photo_folder_id')) 
        {
            $arr['photo_folder_id'] = $_GET['photo_folder_id'];
        }

        $result = _MainModel::table("projects")->edit($arr, array('id' => $_GET['id']))->send();
    }
	}

	// Фильтрация, поиск, пагинация и сортировка
    public function ShowAllProjects()
    {
    if (!_MainModel::is_var($_GET['search']) || !_MainModel::is_var($_GET['limit'])) {
        _MainModel::viewJSON(["error" => ["id" => 0, "type" => "Empty params"]]); 
    }
    else
    {
        $stmt = self::$db->prepare("SELECT * FROM projects WHERE name LIKE $_GET['search'] OR adress LIKE $_GET['search'] LIMIT $_GET['limit'] ORDER BY name");
        $result_query = $stmt->execute(array());
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        if ($rows)
        {
            _MainModel::viewJSON($rows);
        }
        else
        {
            _MainModel::viewJSON(["error" => ["id" => 1, "type" => "Nothing found"]]); 
        }
    }
    }
}
