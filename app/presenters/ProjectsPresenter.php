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

    // Фильтрация
    public function ProjectFilter()
    {
        echo (new Projects())->ProjectFilter();
    }

    // Сортировка
    public function ProjectSort()
    {
        echo (new Projects())->ProjectSort();
    }

     // Поиск
    public function ProjectSearch()
    {
        echo (new Projects())->ProjectSearch();
    }

    // Пагинация
    public function ProjectPagin()
    {
        echo (new Projects())->ProjectPagin();
    }
}

?>