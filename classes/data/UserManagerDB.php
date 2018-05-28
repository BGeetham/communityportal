<?php
namespace classes\data;

use classes\entity\User;
use classes\util\DBUtil;

class UserManagerDB
{
    public static function fillUser($row){
        $user=new User();
        $user->id=$row["id"];
        $user->firstName=$row["firstName"];
        $user->lastName=$row["lastName"];
        $user->email=$row["email"];
        $user->password=$row["password"];
		$user->country=$row["country"];
		$user->city=$row["city"];
		$user->education=$row["education"];
		$user->company=$row["company"];
		$user->role=$row["role"];
		$user->updatedOn=$row["updatedOn"];
		return $user;
    }
	public static function fillsubscribedUser($row){
        $user=new User();
        $user->name=$row["name"];
        $user->email=$row["email"];
     	return $user;
    }
	
	
	
    public static function getUserByEmailPassword($email,$password){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $password=mysqli_real_escape_string($conn,$password);
        $sql="select * from tb_user where email='$email' and password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
	
	public static function getRoleUser($email,$password){
		$role="";
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $password=mysqli_real_escape_string($conn,$password);
        $sql="select role from tb_user where email='$email' and password='$password' limit 1";
        $result = $conn->query($sql);
        if ($result) {
			$role = $result->fetch_row();
                  
        }
        $conn->close();
        return $role;
    }
	
    public static function getUserByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				$users[]=$user;
            }
        }
        $conn->close();
        return $user;
    }
	
	public static function getUserByFirstNLastName($firstName,$lastName){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $users[]=array();
        $firstName=mysqli_real_escape_string($conn,$firstName);
        $lastName=mysqli_real_escape_string($conn,$lastName);
        $sql="select * from tb_user  where First_Name like '%{$firstName}%' || Last_Name like '%{$lastName}%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }

	public static function getUserByName($firstName,$lastName){
		$user=NULL;
		$users[]=array();
        $conn=DBUtil::getConnection();
        $firstName=mysqli_real_escape_string($conn,$firstName);
		$lastName=mysqli_real_escape_string($conn,$lastName);
		 $sql="select * from tb_user where firstName like '%{$firstName}%'|| lastName like '%{$lastName}%'";
     // $sql="select * from tb_user where firstName like '$firstName'|| lastName like '$lastName'";
		//$sql="select * from tb_user where firstName like '%$firstName%'|| lastName like '%$lastName%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				$users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
	public static function getUserByFirstname($firstName,$lastName){
		$user=NULL;
		$users[]=array();
        $conn=DBUtil::getConnection();
        $firstName=mysqli_real_escape_string($conn,$firstName);
		$lastName=mysqli_real_escape_string($conn,$lastName);
		 $sql="select * from tb_user where firstName like '%$firstName%'";
     // $sql="select * from tb_user where firstName like '$firstName'|| lastName like '$lastName'";
		//$sql="select * from tb_user where firstName like '%$firstName%'|| lastName like '%$lastName%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				$users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
	public static function getUserByLastname($firstName,$lastName){
		$user=NULL;
		$users[]=array();
        $conn=DBUtil::getConnection();
       $firstName=mysqli_real_escape_string($conn,$firstName);
		$lastName=mysqli_real_escape_string($conn,$lastName);
		 $sql="select * from tb_user where lastName like '%{$lastName}%'";
     // $sql="select * from tb_user where firstName like '$firstName'|| lastName like '$lastName'";
		//$sql="select * from tb_user where firstName like '%$firstName%'|| lastName like '%$lastName%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				$users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
	public static function getUserByCountry($country){
        $user=NULL;
		$users[]=array();
        $conn=DBUtil::getConnection();
        $country=mysqli_real_escape_string($conn,$country);
        $sql="select * from tb_user where country like '%$country%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				$users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
	public static function getUserByCity($city){
        $user=NULL;
		$users[]=array();
        $conn=DBUtil::getConnection();
        $city=mysqli_real_escape_string($conn,$city);
        $sql="select * from tb_user where city like '%$city%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				$users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
		 public static function getUserById($id){
		
        $user=NULL;
		$users[]=array();
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql="select * from tb_user where id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
				
            }
        }
        $conn->close();
        return $user;
    }
	
	 public static  function deleteUsersById($id){
        $conn=DBUtil::getConnection();
		$id=mysqli_real_escape_string($conn,$id);
        $sql ="DELETE FROM tb_user WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
	 }
	
		
	public static function checkUser($email){
        $exist=False;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0 ) 
            $exist=True;
        $conn->close();
		return $exist;
    }
	
	
    public static function saveUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="call procSaveUser(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssss", $user->id,$user->firstName, $user->lastName, $user->email,$user->password,$user->country,$user->city,$user->education,$user->company); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
	}

	public static function setForgetPasscode($email,$uniqidStr){
		$updated="";
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $fpcode=mysqli_real_escape_string($conn,$uniqidStr);
        $sql="update tb_user set forgetPasswordCode='$fpcode' where email='$email'";
        $updated = $conn->query($sql);
        $conn->close();
        return $updated;
    }
	public static function setUnsubcribe($email){
		$updated="";
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="update tb_user set subscribe='OFF' where email='$email'";
        $updated = $conn->query($sql);
        $conn->close();
        return $updated;
    }
	
	public static function setPassword($email,$passcode){
		$updated="";
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $pcode=mysqli_real_escape_string($conn,$passcode);
        $sql="update tb_user set password='$pcode',forgetPasswordCode='' where email='$email'";
        $updated = $conn->query($sql);
        $conn->close();
        return $updated;
    }
	
	
    public static function getAllUsers(){
        $users[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
	public static function getUsersBySubscription(){
        $users[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from mailList";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillsubscribedUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
}
?>