<?php

class AdminsController {

	/*=============================================
	Login de administradores
	=============================================*/

	public function login() {

		if(isset($_POST["email_admin"]) && $_POST["password_admin"]) {

			echo '<script>
			
				fncMatPreloader("on");
				fncSweetAlert("loading", "Cargando...", "");
			
			</script>';

			$url = "admins?login=true&suffix=admin";
			$method = "POST";
			$fields = array(
				"email_admin" => $_POST["email_admin"],
				"password_admin" => $_POST["password_admin"],
			);

			$login = CurlController::request($url, $method, $fields);
			
			if($login->status == 200) {

				$_SESSION['admin'] = $login->results[0];

				echo '<script>

					localStorage.setItem("token_admin", "'.$login->results[0]->token_admin.'");
					window.location = "/";

				</script>';

			} else {

				if($login->results == "Wrong email") {

					$error = "El correo esta mal escrito.";

				} else {

					$error = "La contraseña esta mal escrita.";

				}

				echo '<script>

					fncFormatInputs();
					fncMatPreloader("off");
					fncToastr("error", "'.$error.'");

				</script>';

			}

		}

	}

}

?>