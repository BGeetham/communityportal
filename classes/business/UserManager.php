<?php
namespace classes\business;

use classes\entity\User;
use classes\data\UserManagerDB;

class UserManager
{
    public static function getAllUsers(){
        return UserManagerDB::getAllUsers();
    }
	public static function getUsersBySubscription(){
        return UserManagerDB::getUsersBySubscription();
    }
    public function getUserByEmailPassword($email,$password){
        return UserManagerDB::getUserByEmailPassword($email,$password);
    }
    public function getUserByEmail($email){
        return UserManagerDB::getUserByEmail($email);
    }
	public function setUnsubcribe($email){
        return UserManagerDB::setUnsubcribe($email);
    }
    public function saveUser(User $user){
        UserManagerDB::saveUser($user);
    }
	public function checkUser($email){
        return UserManagerDB::checkUser($email);
    }
	public function getRoleUser($email,$password){
        return UserManagerDB::getRoleUser($email,$password);
    }
	public function getUserByFirstname($firstName,$lastName){
        return UserManagerDB::getUserByFirstname($firstName,$lastName);
	}	
	public function getUserByName($firstName,$lastName){
        return UserManagerDB::getUserByName($firstName,$lastName);
    }
	
	public function getUserByLastname($firstName,$lastName){
        return UserManagerDB::getUserByLastname($firstName,$lastName);
		
    }
	public function getUserByCountry($country){
        return UserManagerDB::getUserByCountry($country);
	    }
	
	public function getUserByCity($city){
        return UserManagerDB::getUserByCity($city);
	    }
	public function getUserById($id){
        return UserManagerDB::getUserById($id);
		
    }
	public function setForgetPasscode($email,$uniqidstr){
        return UserManagerDB::setForgetPasscode($email,$uniqidstr);
		
    }
	
	public function setPassword($email,$passcode){
        return UserManagerDB::setPassword($email,$passcode);
		
    }

}
?>