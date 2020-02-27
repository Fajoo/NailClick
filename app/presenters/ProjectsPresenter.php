<?php

class ProjectsPresenter extends _MainPresenter 
{
	// Добавление нового проекта
	public function AddProject()
    {
		echo (new Projects())->AddProject();
	}

	// Удаление проекта
    public function DeleteProject()
    {
    	echo (new Projects())->DeleteProject();
    }

    // Вывод проекта по id
    public function ShowProject()
    {
		echo (new Projects())->ShowProject();
    }

	// Редактирование проекта
    public function EditProject()
    {
		echo (new Projects())->EditProject();
    }

    // Фильтрация, поиск, пагинация и сортировка
    public function ShowAllProjects()
    {
        echo (new Projects())->ShowAllProjects();
    }
}

?>
