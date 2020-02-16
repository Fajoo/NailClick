<?php


class OrganizationPresenter extends _MainPresenter {

	//Добавление карточки организации
	public function addCardOrganization(){
			echo (new Organizations())->addCardOrganization();
	} 

	//Редактирование карточки организации
	public function editCardOrganization(){
			echo (new Organizations())->editCardOrganization();
	} 

	//Удаление карточки организации
	public function deleteCardOrganization(){
			echo (new Organizations())->deleteCardOrganization();
	} 

	//Вывод карточки организации
	public function getCardOrganization(){
			echo (new Organizations())->getCardOrganization();
	} 

	//Редактирование logo_url карточки организации
	public function editLogoUrl(){
			echo (new Organizations())->editLogoUrl();
	} 

	//Добавление карточки в таблицу staff
	public function addCardStaff(){
			echo (new Organizations())->addCardStaff();
	} 

	//Редактирование карточки в таблице staff
	public function editCardStaff(){
			echo (new Organizations())->editCardStaff();
	} 

	//Удаление карточки в таблице staff
	public function deleteCardStaff(){
			echo (new Organizations())->deleteCardStaff();
	} 

	//Вывод списка сотрудников салона (таблица stuff)
	public function getAllStaff(){
			echo (new Organizations())->getAllStaff();
	} 
	
	//Добавление карточки в таблице staff_payments
	public function addCardStaffPayments(){
			echo (new Organizations())->addCardStaffPayments();
	} 

	//Редактирование карточки в таблице staff_payments
	public function editCardStaffPayments(){
			echo (new Organizations())->editCardStaffPayments();
	} 

	//Удаление карточки в таблице staff_payments
	public function deleteCardStaffPayments(){
			echo (new Organizations())->deleteCardStaffPayments();
	} 
	
}
?>