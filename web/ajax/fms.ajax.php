<?php

require_once "../controllers/template.controller.php";
require_once "../controllers/curl.controller.php";

class FilesController {

    /*=============================================
	Subir Archivos a los Servidores
	=============================================*/

    public $file;
    public $folder;
    public $token;

    public function ajaxUploadFiles() {

        $this->file;
        $this->folder;
        $this->token;

        /*=============================================
        Traer la información del folder
        =============================================*/

        $url = "folders?linkTo=id_folder&equalTo=".$this->folder;
        $method = "GET";
        $fields = array();

        $folder = CurlController::request($url, $method, $fields);

        if($folder->status == 200) {

            $folder = $folder->results[0];
            
            /*=============================================
            Capturamos la extensión del archivo
            =============================================*/

            $extension = explode(".", $this->file["name"]);

            /*=============================================
            Subiendo archivos al servidor propio
            =============================================*/

            if($this->folder == 1) {

                /*=============================================
                Creamos el nombre de la imagen
                =============================================*/

                $fileName = uniqid().getdate()["seconds"].".".end($extension);

                /*=============================================
                Captura ruta donde guardaremos el archivo
                =============================================*/

                $path = "../views/assets/files/".$fileName;

                /*=============================================
                Movemos archivo temporal a esa ruta
                =============================================*/

                move_uploaded_file($this->file["tmp_name"], $path);

            }

            /*=============================================
            Subiendo archivos a AWS
            =============================================*/

            if($this->folder == 2) {

            }

            /*=============================================
            Subiendo archivos a Cloudinary
            =============================================*/

            if($this->folder == 3) {

            }

            /*=============================================
            Subiendo archivos a Vimeo
            =============================================*/

            if($this->folder == 4) {

            }

            /*=============================================
            Subiendo archivos a Mailchimp
            =============================================*/

            if($this->folder == 5) {

            }

            /*=============================================
            Subiendo archivos a Google Drive
            =============================================*/

            if($this->folder == 6) {

            }

        }

    }

}

/*=============================================
Subir Archivos a los Servidores
=============================================*/

if(isset($_FILES["file"])) {

    $ajax = new FilesController();
    $ajax -> file = $_FILES["file"];
    $ajax -> folder = $_POST["folder"];
    $ajax -> token = $_POST["token"];
    $ajax -> ajaxUploadFiles();

}

?>