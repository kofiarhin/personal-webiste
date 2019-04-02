<?php


	class Mechanic  {

		private $db = null;


		public function __construct() {

			$this->db = db::get_instance();

		}


		public function create($fields) {

			//login insert
			$email = $fields['email'];
			$first_name = $fields['first_name'];
			$last_name  = $fields['last_name'];
			$salt = $fields['salt'];
			$password = $fields['password'];
			$specialty = $fields['specialty'];

			$login_fields = array(

				'email' => $email,
				'password' => $password,
				'salt' => $salt,
				'role_id' => 3,
				'created_on' => date('Y-m-d H:i:s'),
				'activated' => 0
			);


			$login_insert = $this->db->insert('logins', $login_fields);

			//user insert

			$user_fields = array(
				'email' => $email,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'profile_picture' => 'default.jpg',
				'created_on' => date("Y-m-d H:i:s")

			);


			$user_insert = $this->db->insert("users", $user_fields);

			if($user_insert) {

				//mechanic insert
				$mechanic_fields  = array(

					'user_id' => $user_insert,
					'specialty_id' => $specialty

				);

				$mechanic_insert = $this->db->insert("mechanics", $mechanic_fields);

				if(!$mechanic_insert) {

					return false;


				}


				$hash = hash::unique();
				$user_id = $user_insert;

				//send an email;

				$subject  = "Account Activation";

				$body = "activate your account";

				//send customer email
				$message = Mail::send($email, $subject, $body);


				if(!$message) {

					return false;
				}

				//insert hash into database

				$a_fields = array(

					'email' => $email,
					'hash' => $hash

				);


				$a_insert = $this->db->insert("account_activations", $a_fields);

				if(!$a_insert) {

					return false;
				}

				session::flash("success", "An email has been sent to ".$email." to activate account!");

				return true;





			}


		}
	}
