<?php 


	class Activation  {



		private $db = null;

		public function __construct() {


			$this->db = db::get_instance();


		}



		public function activate($email, $hash) {

		
				$check = $this->db->get("account_activations", array('hash', '=', $hash));

				if($check->count()) {

					//update logins table
					//delete details from account_activations

					//return true after

					$update_fields = array(

						'activated' => 1
					);

					$update = $this->db->update('logins', $update_fields, array('email', '=', $email));


					if($update) {

						//delete details from account activation;


						$delete = $this->db->delete("account_activations", array('email', '=', $email));


						if($delete) {

							session::flash("success", "Account Activated");

							return true;
						}
					}

				}


				return false;
		}

	}