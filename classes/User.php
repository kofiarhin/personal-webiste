<?php 
	
	class User {

		private $db = null,
				$session_name,
				$logged_in = false,
				$data = array();


		public function __construct($user = false) {

			$this->db = db::get_instance();
			$this->session_name = config::get('session/session_name');

			if(!$user) {

				if(session::exist($this->session_name)) {

					$user = session::get($this->session_name);


					if($this->find($user)) {

						$this->logged_in = true;
					}

				}
			}
		}



		public function find($user) {


			$field = (is_numeric($user)) ? 'id': "email";


			$sql = "select * from logins  

			inner join roles
			on logins.role_id = roles.id

			inner join users

			on logins.email = users.email

			where logins.email = ?";


			$fields = array(

				"{$field}" => $user

			);

			$query = $this->db->query($sql,$fields);

			if($query->count()) {

				$this->data = $query->first();


				return true;

			}

			return false;
		}


		public function login($email, $password) {


			$user = $this->find($email);


			if($user) {


				if($this->data()->password == hash::make($password, $this->data()->salt)) {


						session::put($this->session_name, $this->data()->email);

						return true;


				}


			}


			return false;



		}


		public function logout() {

			session::delete($this->session_name);
		}


		public function data() {

			return $this->data;
		}

		public function exist() {

			return (!empty($this->data)) ? true : false;
		}


		public function logged_in() {

			return $this->logged_in;
		}



		public function has_role($role) {


				if($this->exist()) {


					$role_name = $this->data()->role_name;

					if($role_name == $role) {

						return true;
					}


				}
				return false;


		}
	}



 ?>