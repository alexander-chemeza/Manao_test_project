<?php
class RegisterUser{
	// Class properties
	private $login;
	private $raw_password;
	private $confirm_password;
	private $email;
	private $name;
	private $encrypted_password;
	public $error;
	public $success;
	private $storage = "../db/users.json";
	private $stored_users;
	private $new_user; // array


	public function __construct($username, $password, $confirm_password, $email, $name){

		$this->login = trim($this->login);
		$this->login = filter_var($username, FILTER_SANITIZE_STRING);

		$this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
		$this->confirm_password = filter_var(trim($confirm_password), FILTER_SANITIZE_STRING);

        if(!($this->raw_password === $this->confirm_password)) {
            $this->error = "Password fields don't match";
            return false;
        } else {
            $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

            $this->email = trim($this->email);
            $this->email = filter_var($email, FILTER_SANITIZE_STRING);

            $this->name = trim($this->name);
            $this->name =filter_var($name, FILTER_SANITIZE_STRING);

            $this->stored_users = json_decode(file_get_contents($this->storage), true);

            $this->new_user = [
                "username" => $this->login,
                "password" => $this->encrypted_password,
                "email" => $this->email,
                "name" => $this->name,
            ];

            if($this->checkFieldValues()){
                $this->insertUser();
            }
        }
	}


	private function checkFieldValues(){
		if(empty($this->login) || empty($this->raw_password) || empty($this->email) || empty($this->name)){
			$this->error = "All fields are required.";
			return false;
		}else{
			return true;
		}
	}

	private function usernameExists(){
		foreach($this->stored_users as $user){
			if($this->login == $user['username']){
				$this->error = "Username already taken, please choose a different one.";
				return true;
			}
		}
		return false;
	}


	private function insertUser(){
		if($this->usernameExists() == FALSE){
			array_push($this->stored_users, $this->new_user);
			if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
				return $this->success = "Your registration was successful";
			}else{
				return $this->error = "Something went wrong, please try again";
			}
		}
	}



} // end of class