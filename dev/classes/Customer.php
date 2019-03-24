<?php


	class Customer {

		private $db = null;


		public function __construct() {


				$this->db = db::get_instance();
		}


		public function create($fields) {

			$email = $fields['email'];
			$salt = hash::salt(32);
			$password = hash::make($fields['password'], $salt);
			$date = date("Y-m-d H:i:s");



			//login insert
			$login_fields = array(

				'email' => $email,
				'password' => $password,
				'salt' => $salt,
				'role_id' => 2,
				'created_on' => $date,
				'activated' => 0

			);

			//insert into login table


			$login_insert = $this->db->insert('logins', $login_fields);

			if(!$login_insert) {

				return false;


			}


			$user_fields = array(

				'email' => $email,
				'first_name' => $fields['first_name'],
				'last_name' => $fields['last_name'],
				'profile_picture' => 'default.jpg',
				'created_on' => $date,

			);



			$user_insert  = $this->db->insert('users', $user_fields);

			if(!$user_insert) {

				return false;
			}


			//send user and email
			$hash = hash::unique();
			$subject = "Activate you account";
			$body =  "<a href='http://localhost/projects/auto_delux/activate_account.php?hash=$hash&email=$email'>Activate Account!</a>";

			$send_mail = Mail::send($email, $subject, $body);

			if($send_mail) {

				$activate_fields = array(

					'email' => $email,
					'hash' => $hash
				);



			$activate_insert = $this->db->insert('account_activations', $activate_fields);


			if(!$activate_insert) {

				//note if it doesnt work delete all data from previous insert
				//will work on that later
				//for now we are assuming all went according to plan
				return false;
			}




			}


			session::flash("success", "Your account was successfully created. Check Your email to activate Accouunt");

			return true;


		}

	}
