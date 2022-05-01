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

	<h4 align="center">List Item To The Database</h4>
	<br />
	<div class="row">
		<div class="col-md-8">

			<form
				action='<?php echo base_url("welcome/submit_additem")?>'
				method="POST">

				<label>&nbsp; Item Location</label> <input class="form-control"
					placeholder="" name="location" /><br />



				<div class="form-group">
					<label for="sel1">&nbsp; Item Type - Select from the list below: </label>
					<select class="form-control" id="itemtype" name="itemtype">
						<option value="Document">Document</option>

						<option value="Vehicle">Vehicle</option>

						<option value="Device">Device</option>

						<option value="Person">Person</option>


						<option value="Livestock">Livestock</option>
						<option value="Other">Other</option>
					</select>
				</div>



				<label>&nbsp; Item Number * </label> <input class="form-control"
					placeholder="" name="itemuniquenumber" /><br /> <label>&nbsp; Item
					Description</label>

				<textarea class="form-control" placeholder="" style="height: 150px;"
					name="itemdescription"> </textarea>
				<br /> <input type="submit" class="btn btn-primary" />
		
		</div>

		<div class="col-md-4">
			 
			</form>
		</div>

	</div>
</div>