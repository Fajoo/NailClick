<?php


class UserPresenter extends _MainPresenter {

	//Добавление карточки пользователя
	public function addCardUser(){
			echo (new Users())->addCardUser();
	}

    //Добавление координат пользователя
	public function addCoorUser(){
			echo (new Users())->addСoorUser();
	}

    //Добавление токена пользователя
	public function addTokenUser(){
			echo (new Users())->addTokenUser();
	}

    //Удаление токена пользователя
	public function deleteTokenUser(){
			echo (new Users())->deleteTokenUser();
	}

	//Редактирование поля avatar_url
	public function editAvatarUser(){
			echo (new Users())->editAvatarUser();
	}

	//Редактирование карточки пользователя
	public function editCardUser(){
			echo (new Users())->editCardUser();
	}

	//Вывод данных карточки пользователя
	public function getCardUser(){
			echo (new Users())->getCardUser();
	}

	//Вывод данных карточки пользователя с данными координат
	public function getCardCoorUser(){
			echo (new Users())->getCardCoorUser();
	}

	//Вывод данных карточки пользователя с данными координат.
	public function deleteCoorUser(){
			echo (new Users())->deleteCoorUser();
	}
}

?>