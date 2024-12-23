<?php 

require_once "../controllers/template.controller.php";
require_once "../controllers/curl.controller.php";

class FilesController{

	/*=============================================
	Subir Archivos a los Servidores
	=============================================*/

	public $file;
	public $folder;
	public $token;

	public function ajaxUploadFiles(){

		/*=============================================
		Traer info del folder
		=============================================*/

		$url = "folders?linkTo=id_folder&equalTo=".$this->folder;
		$method = "GET";
		$fields = array();

		$folder = CurlController::request($url,$method,$fields);

		if($folder->status == 200){

			$folder = $folder->results[0];
		
			/*=============================================
			Capturamos la extensión del archivo
			=============================================*/

			$extension = explode(".",$this->file["name"]);
	
			/*=============================================
			Subiendo archivos al servidor propio
			=============================================*/

			if($this->folder == 1){

				/*=============================================
				Creamos el nombre de la imagen
				=============================================*/

				$fileName = uniqid().getdate()["seconds"].".".end($extension);
				
				/*=============================================
				Capturar ruta donde guardaremos el archivo
				=============================================*/

				$path = "../views/assets/files/".$fileName;

				/*=============================================
				Movemos archivo temporal a esa ruta
				=============================================*/

				if(move_uploaded_file($this->file["tmp_name"], $path)){

					/*=============================================
					Subimos información de archivos a la base de datos
					=============================================*/

					$url = "files?token=".$this->token."&table=admins&suffix=admin";
					$method = "POST";
					$fields = array(

						"id_folder_file" => $this->folder,
						"extension_file" => end($extension),
						"name_file" => str_replace(".".end($extension), "", $this->file["name"]),
						"type_file" => $this->file["type"],
						"size_file" => $this->file["size"],
						"link_file" =>str_replace("..",$folder->url_folder, $path),
						"date_created_file" => date("Y-m-d")
					);

					$uploadData = CurlController::request($url,$method,$fields);

					if($uploadData->status == 200){

						/*=============================================
						Devolvemos la información a javascript
						=============================================*/

						$response = array(

							"status" => 200,
							"id_file" => $uploadData->results->lastId,
							"link" => $fields["link_file"],
							"reduce_link" => TemplateController::reduceText($fields["link_file"],34)."...",
							"date" => $fields["date_created_file"].", ".date("H:m:s")

						);

						echo json_encode($response);

					}

				}

			}

			/*=============================================
			Subiendo archivos a AWS
			=============================================*/

			if($this->folder == 2){


			}

			/*=============================================
			Subiendo archivos a Cloudinary
			=============================================*/

			if($this->folder == 3){


			}

			/*=============================================
			Subiendo archivos a Vimeo
			=============================================*/

			if($this->folder == 4){


			}

			/*=============================================
			Subiendo archivos a Mailchimp
			=============================================*/

			if($this->folder == 5){


			}
		}

		
	}

	/*=============================================
	Calcular el peso total de archivos de un folder
	=============================================*/

	public $idFolder;

	public function updateServer(){

		/*=============================================
		Traer todos los archivos vinculados al folder
		=============================================*/

		$url = "files?linkTo=id_folder_file&equalTo=".$this->idFolder."&select=size_file";
		$method = "GET";
		$fields = array();

		$files = CurlController::request($url,$method,$fields);

		if($files->status == 200){

			$files = $files->results;
			$totalSize = 0;
			$countFiles = 0;

			foreach ($files as $key => $value) {
				
				$totalSize += $value->size_file;
				$countFiles++;

				if($countFiles == count($files)){

					/*=============================================
					Actualizar Folders
					=============================================*/

					$url = "folders?id=".$this->idFolder."&nameId=id_folder&token=".$this->token."&table=admins&suffix=admin";
					$method = "PUT";
					$fields = "total_folder=".$totalSize;

					$folders = CurlController::request($url,$method,$fields);

					if($folders->status == 200){

						echo $folders->status;
						
					}

				}
			}
		}


	}


}

/*=============================================
Subir Archivos a los Servidores
=============================================*/

if(isset($_FILES["file"])){

	$ajax = new FilesController();
	$ajax -> file = $_FILES["file"];
	$ajax -> folder  = $_POST["folder"];
	$ajax -> token = $_POST["token"];
	$ajax -> ajaxUploadFiles();

}

/*=============================================
Calcular el peso total de archivos de un folder
=============================================*/

if(isset($_POST["idFolder"])){

	$ajax = new FilesController();
	$ajax -> idFolder  = $_POST["idFolder"];
	$ajax -> token = $_POST["token"];
	$ajax -> updateServer();

}


