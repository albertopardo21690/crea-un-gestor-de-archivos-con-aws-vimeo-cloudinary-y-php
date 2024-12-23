/*=============================================
Cambiar de Listado a Cuadrícula
=============================================*/

$(document).on("click",".changeView",function(){

	var modules = $(".modules");

	modules.each((i)=>{

		$(modules[i]).hide();

	})

	$("#"+$(this).attr("module")).show();

	var changeView = $(".changeView");

	changeView.each((i)=>{

		$(changeView[i]).removeClass("text-white")
		$(changeView[i]).addClass("text-secondary")

		$(changeView[i]).removeClass("bg-dark")
		$(changeView[i]).addClass("bg-white")

	})

	$(this).addClass("text-white")
	$(this).removeClass("text-secondary")

	$(this).addClass("bg-dark")
	$(this).removeClass("bg-white")

	/*=============================================
	Ajustar imágenes cuando activamos el grid
	=============================================*/

	if($(this).attr("module") == "grid"){

		imgAdjustGrid();
	}
})

/*=============================================
Zona Drag & Drop
=============================================*/

$("#dragFiles").on(
	'dragover',
	function(e) {

		e.preventDefault();
		e.stopPropagation();

		$(this).addClass("bg-light");
	}
)

$("#dragFiles").on(
	'dragenter',
	function(e) {

		e.preventDefault();
		e.stopPropagation();
	
	}
)

$("#dragFiles").on(
	'mouseleave',
	function(e) {

		e.preventDefault();
		e.stopPropagation();

		$(this).removeClass("bg-light");
	
	}
)

$("#dragFiles").on(
	'drop',
	function(e) {
		
		e.preventDefault();
		e.stopPropagation();

		if(e.originalEvent.dataTransfer){

			if(e.originalEvent.dataTransfer.files.length){

				$(this).removeClass("bg-light");

				var t = new Date();
				var time = t.getFullYear()+"-"+("0"+(t.getMonth()+1)).slice(-2)+"-"+("0"+t.getDate()).slice(-2)+", "+t.toLocaleTimeString();

				uploadFiles(e.originalEvent.dataTransfer.files,'drag',time);
			}
		}
	}
)

/*=============================================
Subir Archivos
=============================================*/
var files;

function uploadFiles(event, type, time){

	fncMatPreloader("on");
	fncSweetAlert("loading", "Loading...", "");

	/*=============================================
	Convertir los checkbox a radio
	=============================================*/

	var checkFMS = $(".check-fms");

	checkFMS.each((i)=>{

		$(checkFMS[i]).attr("type","radio");
		$(checkFMS[i]).attr("checked",false);

	})

	$(checkFMS[0]).attr("checked",true);

	/*=============================================
	Captura de Archivos
	=============================================*/
	
	if(type == "btn"){
	
		files = event.target.files;
	
	}else{

		files = event;
	
	}

	/*=============================================
	Recorriendo los archivos
	=============================================*/

	Array.from(files).forEach((file,i)=>{

		if(file.type.split("/")[0] == "image" || 
		   file.type.split("/")[0] == "video" ||
		   file.type.split("/")[0] == "audio" ||
		   file.type.split("/")[1] == "pdf" ||
		   file.type.split("/")[1] == "zip"
		){
		
			/*=============================================
			Capturar el nombre
			=============================================*/

			var name = file.name.split(".");
			name.pop();
			name = name.toString().replace(/,/g,"_");

			/*=============================================
			Capturar la extensión
			=============================================*/

			var extension = file.name.split(".").pop();

			/*=============================================
			Capturar el tamaño
			=============================================*/

			var size = (Number(file.size)/1000000).toFixed(2);
			

			/*=============================================
			Capturar la miniatura en imágenes
			=============================================*/

			var path;

			if(file.type.split("/")[0] == "image"){

				var data  = new FileReader();
				data.readAsDataURL(file);

				$(data).on("load",function(event){
					
					path = event.target.result; 

					paintFiles(path,name,extension,size,time);

				})

			}

			/*=============================================
			Capturar la miniatura de videos
			=============================================*/

			if(file.type.split("/")[0] == "video"){

				/*=============================================
				Capturar la miniatura de videos MP4
				=============================================*/

				if(file.type.split("/")[1] == "mp4"){
					
					var canvas = document.createElement("canvas");
					var video = document.createElement("video");

					video.autoplay = true;
					video.muted = true;
					video.src = URL.createObjectURL(file);

					video.onloadeddata = () => {

						var ctx = canvas.getContext("2d");

						canvas.width = video.videoWidth;
						canvas.height = video.videoHeight;

						ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
						video.pause();

						path = canvas.toDataURL("image/png");

						paintFiles(path,name,extension,size,time);

					}

				}else{

					path = "/views/assets/img/multimedia.png";
					paintFiles(path,name,extension,size,time);

				}

			}

			/*=============================================
			Capturar la miniatura de audios
			=============================================*/

			if(file.type.split("/")[0] == "audio"){

				path = "/views/assets/img/multimedia.png";
				paintFiles(path,name,extension,size,time);

			}

			/*=============================================
			Capturar la miniatura de PDF
			=============================================*/

			if(file.type.split("/")[1] == "pdf"){
				

				path = "/views/assets/img/pdf.jpeg";
				paintFiles(path,name,extension,size,time);

			}

			/*=============================================
			Capturar la miniatura de ZIP
			=============================================*/

			if(file.type.split("/")[1] == "zip"){	

				path = "/views/assets/img/zip.jpg";
				paintFiles(path,name,extension,size,time);

			}

			/*=============================================
			Función para pintar los archivos en la lista o cuadrícula
			=============================================*/

			function paintFiles(path,name,extension,size,time){

				/*=============================================
				Visualizando archivos a subir en la lista
				=============================================*/
			
				$("#list table tbody tr:first-child").before(`

					<tr style="height:100px" class="itemsUp">

						<td>
							<img src="${path}" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">
						</td>

						<td class="align-middle columnName${i}">
							<div class="input-group">
								<input type="text" class="form-control" value="${name}" readonly>
								<span class="input-group-text">.${extension}</span>
							</div>
						</td>

						<td class="align-middle">${size} MB</td>

						<td class="align-middle">
							<span class="badge bg-dark rounded px-3 py-2 text-white typeFolder">Server</span>
						</td>

						<td class="align-middle progressList${i}">
							<div class="progress-spinner"></div>
							<div class="progress mt-1" style="height:20px">
								<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:0%">0%</div>
							</div>
						</td>

						<td class="align-middle">${time}</td>

						<td class="align-middle columnAction${i}">
							<button type="button" class="btn btn-sm py-2 px-3 bg-default border font-weight-bold rounded">
								<i class="bi bi-x-circle"></i> Clear
							</button>
						</td>

					</tr>

				`)

				/*=============================================
				Visualizando archivos a subir en la cuadrícula
				=============================================*/

				$("#grid .col:first-child").before(`

					<div class="col itemsUp">
			 			
			 			<div class="card rounded p-3 border-0 shadow my-3">
			 				
			 				<div class="card-header bg-white border-0 p-0">
			 					
			 					<div class="d-flex justify-content-between mb-2">
			 						
			 						<div class="bg-white w-50 progressGrid${i}">
										<div class="progress-spinner"></div>
										<div class="progress mt-1" style="height:20px">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:0%">0%</div>
										</div>
									</div>

									<div class="bg-white m-0 gridAction${i}">
										<button type="button" class="btn btn-sm py-2 px-3 bg-default border font-weight-bold rounded">
											<i class="bi bi-x-circle"></i> Clear
										</button>
									</div>

			 					</div>
			 				</div>

			 				<img src="${path}" class="card-img-top rounded w-100">

			 				<div class="card-body p-1">
			 					
			 					<p class="card-text">
			 						
			 						<div class="input-group gridName${i}">
										<input type="text" class="form-control" value="${name}" readonly>
										<span class="input-group-text">.${extension}</span>
									</div>

									<div class="d-flex justify-content-between mt-3">

										<div class="bg-white">
											<p class="small mt-1">${size} MB</p>
										</div>

										<div class="bg-white m-0">
											<span class="badge bg-dark border rounded px-3 py-2 text-white typeFolder">Server</span>
										</div>
									</div>

									<h6 class="float-end my-0 py-0">
										<small>${time}</small>
									</h6>

			 					</p>

			 				</div>

			 			</div>

			 		</div>

			 	`);

				/*=============================================
				Ejecutar función ajuste de imagen
				=============================================*/

				imgAdjustGrid();


				fncMatPreloader("off");
				fncSweetAlert("close", "", "");
			}

		}else{

			fncToastr("error", "El formato de archivo que intenta subir no es permitido");
			return;
		}
		

	})

}

/*=============================================
Ajuste de imagen para el grid
=============================================*/

function imgAdjustGrid(){

	if($(".card-img-top").length > 0){

		var cardImgTop = $(".card-img-top");

		cardImgTop.each((i)=>{

			$(cardImgTop[i]).attr("style", "height:"+$(cardImgTop[i]).width()+"px;  object-fit: cover; object-position: center;");		
			
		})
	}

}

/*=============================================
Cambio al seleccionar servidor
=============================================*/

$(document).on("change",".check-fms",function(){

	if($(this).attr("type") == "radio"){

		var folder = $(this).val().split("_")[1];
		
		if($(".typeFolder").length > 0){

			var typeFolder = $(".typeFolder");

			typeFolder.each((i)=>{

				$(typeFolder[i]).html(folder);
			})

		}
	}

})

/*=============================================
Iniciar subida de archivos
=============================================*/

$(document).on("click","#startAll",function(){

	/*=============================================
	Validar si lo está haciendo un admin
	=============================================*/

	if(localStorage.getItem("token-admin") == null){

		fncToastr("error", "Debe iniciar sesión para realizar esta acción");
		return;
	}

	/*=============================================
	Validar que si hayan archivos para subir
	=============================================*/
	
	if($(".itemsUp").length == 0){

		fncToastr("error", "Debe arrastrar mínimo un archivo para realizar esta acción");
		return;

	}
	
	/*=============================================
	Validar el folder donde se subiran los archivos
	=============================================*/

	var checkFMS = $(".check-fms");

	checkFMS.each((i)=>{

		if($(checkFMS[i]).attr("type") == "radio" && $(checkFMS[i]).prop("checked")){
			
			uploadFilesAjax($(checkFMS[i]).val());

		}

	})

})

/*=============================================
Función de carga
=============================================*/

function uploadFilesAjax(folder){
	
	fncMatPreloader("on");

	var countFiles = 0;
	
	/*=============================================
	Recorriendo los archivos
	=============================================*/

	Array.from(files).forEach((file,i)=>{

		var data = new FormData();
		data.append("file", file);
		data.append("folder", folder.split("_")[0]);
		data.append("token", localStorage.getItem("token-admin"));

		$.ajax({

			xhr:function(){

				xhr = $.ajaxSettings.xhr();

				xhr.upload.onprogress = function(e){
					
					if(e.lengthComputable){

						var completePercent = (e.loaded / e.total) * 100;

						/*=============================================
						Precarga individual en la lista
						=============================================*/			

						$(".progressList"+i).find(".progress-spinner").html(`<div class="spinner-border spinner-border-sm"></div><small>Uploading file to server...</small>`)

						$(".progressList"+i).find(".progress-bar").attr("style","width:"+completePercent+"%");

						$(".progressList"+i).find(".progress-bar").html(completePercent+"%");

						/*=============================================
						Precarga individual en la cuadrícula
						=============================================*/			

						$(".progressGrid"+i).find(".progress-spinner").html(`<div class="spinner-border spinner-border-sm"></div>`)

						$(".progressGrid"+i).find(".progress-bar").attr("style","width:"+completePercent+"%");

						$(".progressGrid"+i).find(".progress-bar").html(completePercent+"%");
					}

				}

				return xhr;

			},
			url:"/ajax/files.ajax.php",
			method:"POST",
			data:data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(response){
				
				if(JSON.parse(response).status == 200){

					countFiles++;

					/*=============================================
					Modifica la vista de la lista
					=============================================*/

					$(".columnName"+i).find("input").attr("readonly", false);

					$(".progressList"+i).html(`<a href="${JSON.parse(response).link}" target="_blank">

						${JSON.parse(response).reduce_link}
						<i class="bi bi-box-arrow-up-right ps-2 btn"></i>

					</a>`)

					$(".columnAction"+i).html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor:pointer">
						  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
						</svg>
					  <i class="bi bi-trash ps-2 btn"></i>`);

					/*=============================================
					Modifica la vista de la cuadrícula
					=============================================*/

					$(".gridName"+i).find("input").attr("readonly", false);

					$(".progressGrid"+i).html(`<a href="${JSON.parse(response).link}" target="_blank">

						<i class="bi bi-box-arrow-up-right ps-2 btn"></i>

					</a>`)

					$(".gridAction"+i).html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor:pointer">
						  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
						</svg>
					  <i class="bi bi-trash ps-2 btn"></i>`);

					/*=============================================
					Finaliza la carga de todos los archivos
					=============================================*/

					if(countFiles == files.length){

						/*============================================================
						Sumar el peso de todos los archivos que pertenecen al "folder"
						============================================================*/

						var data = new FormData();
						data.append("idFolder", folder.split("_")[0]);
						data.append("token", localStorage.getItem("token-admin"));

						$.ajax({

							url:"/ajax/files.ajax.php",
							method:"POST",
							data:data,
							contentType: false,
							cache: false,
							processData: false,
							success: function(response){

								if(response == 200){

									fncMatPreloader("off");
									fncToastr("success", "Todos los archivos han subido exitosamente");

								}

							}

						})

					}

				}
			
			}

		})

	})

}