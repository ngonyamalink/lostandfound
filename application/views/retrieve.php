<br />
<div>
	<?php
$this->load->view('alert');
?>
</div>

<link
	href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

	<h4 align="center">Item Retrieval Form</h4>
	<br />
	<div class="row">
		<div class="col-md-8">
					<?php echo form_open_multipart(base_url() . 'welcome/submit_retrieve'); ?>
<input class="form-control"
					placeholder="" name="item_id" type="hidden" value="<?php echo $item_id;?>"/>
				<label>&nbsp;Phone</label> <input class="form-control"
					placeholder="" name="phone" /><br /> <label>&nbsp; Email</label> <input
					class="form-control" placeholder="" name="email" /><br /> <label
					class="small mb-1">Affidavid - Photo / or image url (.jpg or .png or .pdf)</label> <input
					class="form-control" id="inputConfirmPassword" type="file"
					placeholder="Photo" name="userfile" /> <br /> <input type="submit"
					class="btn btn-primary" />
		
		</div>

		<div class="col-md-4">
			
			</form>
		</div>

	</div>
</div>