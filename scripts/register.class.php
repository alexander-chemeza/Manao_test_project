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
	private $new_user;

    public $error_login_length;
    public $error_name_length;
    public $error_password_sample;
    public $error_password_equality;
    public $error_email;
    public $error_name_format;

	public function __construct($username, $password, $confirm_password, $email, $name){
        // User input
		$this->login = trim($this->login);
		$this->login = filter_var($username, FILTER_SANITIZE_STRING);
        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->confirm_password = filter_var(trim($confirm_password), FILTER_SANITIZE_STRING);
        $this->email = trim($this->email);
        $this->email = filter_var($email, FILTER_SANITIZE_STRING);
        $this->name = trim($this->name);
        $this->name =filter_var($name, FILTER_SANITIZE_STRING);
        // Password sample checkers
        $uppercase = preg_match('@[A-Z]@', $this->raw_password);
        $lowercase = preg_match('@[a-z]@', $this->raw_password);
        $number    = preg_match('@[0-9]@', $this->raw_password);
        $specialChars = preg_match('@[^\w]@', $this->raw_password);

		if (strlen($this->login) < 6) { // login length
		    $this->error_login_length = "Login length must be more than 6 characters";
		    return false;
        } elseif (strlen($this->name) < 2) { // name length
            $this->error_name_length = "Name length must be more than 2 characters";
            return false;
        } elseif(!($this->raw_password === $this->confirm_password)) { //password equality
            $this->error_password_equality = "Password fields don't match";
            return false;
        } elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->raw_password) < 6) { // password sample
            $this->error_password_sample = "Password should be at least 6 characters in length and should include 
                                            at least one upper case letter, one number, and one special character";
            return false;
        } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error_email = "Check email. Correct email format is example@mail.com";
            return false;
        } elseif(!ctype_alpha($this->name)) {
		    $this->error_name_format = "Name must contain letters only";
		    return false;
        } else {
            $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

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