<!--=====================================
GRID
======================================-->

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 my-4 px-2 modules" id="grid" style="display:none">
 
 	<?php if (!empty($files)): ?>

		<?php foreach ($files as $key => $value): ?>

			<?php 

				/*=============================================
				Capturar miniatura imagen
				=============================================*/

				if(explode("/",$value->type_file)[0] == "image"){

					$path = '<img src="'.$value->link_file.'" class="rounded card-img-top w-100">';

				}

				/*=============================================
				Capturar miniatura video
				=============================================*/

				if(explode("/",$value->type_file)[0] == "video"){

					if(explode("/",$value->type_file)[1] == "mp4"){

						$path = '<video class="rounded card-img-top w-100">
							<source src="'.$value->link_file.'" type="'.$value->type_file.'">
						</video>';

					}else{

						$path = '<img src="/views/assets/img/multimedia.png" class="rounded card-img-top w-100">';
					}

				}

				/*=============================================
				Capturar miniatura audio
				=============================================*/

				if(explode("/",$value->type_file)[0] == "audio"){

					$path = '<img src="/views/assets/img/multimedia.png" class="rounded card-img-top w-100">';

				}

				/*=============================================
				Capturar miniatura pdf
				=============================================*/

				if(explode("/",$value->type_file)[1] == "pdf"){

					$path = '<img src="/views/assets/img/pdf.jpeg" class="rounded card-img-top w-100">';
				}

				/*=============================================
				Capturar miniatura zip
				=============================================*/

				if(explode("/",$value->type_file)[1] == "zip"){

					$path = '<img src="/views/assets/img/zip.jpg" class="rounded card-img-top w-100">';
				}

			?>

	 		<div class="col">
	 			
	 			<div class="card rounded p-3 border-0 shadow my-3">
	 				
	 				<div class="card-header bg-white border-0 p-0">
	 					
	 					<div class="d-flex justify-content-between mb-2">
	 						
	 						<div class="bg-white">
	 							<a href="<?php echo $value->link_file ?>" target="_blank">
								<i class="bi bi-box-arrow-up-right ps-2 btn p-0"></i>
								</a>
							</div>

							<div class="bg-white m-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="cursor:pointer">
									<path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
								</svg>
								<i class="bi bi-trash p-0 ps-2 btn"></i>
							</div>

	 					</div>
	 				</div>

	 				<?php echo $path ?>

	 				<div class="card-body p-1">
	 					
	 					<p class="card-text">
	 						
	 						<div class="input-group">
								<input type="text" class="form-control" value="<?php echo $value->name_file ?>">
								<span class="input-group-text">.<?php echo $value->extension_file ?></span>
							</div>

							<div class="d-flex justify-content-between mt-3">

								<div class="bg-white">
									<p class="small mt-1"><?php echo number_format($value->size_file/1000000,2) ?> MB</p>
								</div>

								<div class="bg-white m-0">
									<span class="badge bg-dark border rounded px-3 py-2 text-white"><?php echo $value->name_folder ?></span>
								</div>
							</div>

							<h6 class="float-end my-0 py-0">
								<small><?php echo $value->date_updated_file ?></small>
							</h6>

	 					</p>

	 				</div>

	 			</div>

	 		</div>

 		<?php endforeach ?>
				
	<?php endif ?>

</div>