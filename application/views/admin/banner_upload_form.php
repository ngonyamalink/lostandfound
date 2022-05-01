
<div>
	<?php
	  $this->load->view('alert');
	?>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-7">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4">Banner Upload Form</h3>
				</div>
				<div class="card-body">
				 

						<?php echo form_open_multipart(base_url() . 'index.php/admin/upload_banner'); ?>


<div class="form-row"><div class="col-md-12">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Publisher Key</label> <input
										class="form-control py-4" type="text"
										placeholder="Publisher Key"
										name="publisherkey" />
								</div>
							</div></div>
					 

						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Title</label> <input
										class="form-control py-4" type="text"
										placeholder="Title"
										name="title" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputConfirmPassword">Description</label>
									<input class="form-control py-4"
										type="text" placeholder="Description"
										name="description" />
								</div>
							</div>
						</div>


						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Code</label> <input
										class="form-control py-4" id="inputPassword" type="text"
										placeholder="Banner Code"
										name="banner_code" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1">Photo / or image url (.jpg or .png)</label>
									<input class="form-control" id="inputConfirmPassword"
										type="file" placeholder="Banner" name="userfile" />
								</div>
							</div>
						</div>

 
						 

						<div class="form-group mt-4 mb-0">
							<input type="submit" class="btn btn-primary" />
						</div>
				<?php echo form_close(); ?>
				</div>

			</div>
		</div>
	</div>
</div>

<br/><br/>