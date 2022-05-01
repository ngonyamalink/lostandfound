
<div>
	<?php
	  $this->load->view('alert');
	?>
</div>


<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-5">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4">Tell a Friend</h3>
				</div>
				<div class="card-body">
					<div class="small mb-3 text-muted">Enter your mobile number and the email address of a person you wish to refer.</div>
					<form action="<?php echo base_url("/index.php/Welcome/submit_tell_a_friend")?>"
						method="POST">
						<div class="form-group">
							<label class="small mb-1" for="inputEmailAddress">My Phone Number</label>
							
							
							<input 
								class="form-control py-4" id="inputEmailAddress" name="referrer_phone_number" type="text"
								aria-describedby="emailHelp" placeholder="Enter your phone number" />
								
								
								
								<br/>
								
						<label class="small mb-1" for="inputEmailAddress">My Frind's Email Address</label>
								
							
							 <input 
								class="form-control py-4" id="inputEmailAddress" name="email" type="email"
								aria-describedby="emailHelp" placeholder="Enter your freind's email address" />
						</div>
						<div
							class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
							<a class="small"
								href="<?php echo base_url()?>">
							 Home</a> <input type="submit" class="btn btn-primary"/>
						</div>
					</form>
				</div>
				 
			</div>
		</div>
	</div>
</div>