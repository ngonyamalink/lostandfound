<div>
<?php
$this->load->view('alert');
?>
</div>

<!-- Content section -->
<section class="py-5">
	<div class="container">
	
	
		<img style="height: 260px; width: 100%;"
			src="<?php echo base_url("resources/lostandfound.jpg")?>">
		<br /> <br />
	
	<h3 align="center"><font color='red'>LOST</font>FOUND</h3>
	
	<br/>


 <?php
echo '<div class="container" align="center">';
echo "<form method='POST' action='" . base_url('index.php/welcome/finditem') . "'><input name='keyword' type='text' class='form-control rounded' placeholder='Search' aria-label='Search'
    aria-describedby='search-addon'><br/>
    <br/> <input type='submit' value='Search' class='input-group-text border-0' id='search-addon'>
    </form><br/>";
echo "</div>";
?>

<?php
if (isset($results)) {
    ?>
<br />
		<div class="container-fluid">
			<div class="card mb-4">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" id="dataTable" width="100%"
							cellspacing="0">
							<thead>
								<tr>
									<th>Item Description</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Item Description</th>
								</tr>
							</tfoot>
							<tbody>
                    <?php
    $cnt = 0;
    foreach ($results as $t) {
        $cnt = $cnt + 1;
        echo "<tr>";
        echo "<td>" . getfaicon($t['itemtype']) . "<br/>";
        echo substr($t['itemdescription'], 0, 25) . "@" . $t['location'] . "<br/> <a href='" . base_url('welcome/retrieve/0/'.$t['id']) . "'>Retrieve</a>  </td>";
        echo "</tr>";
    }
    ?>
                 </tbody>
						</table>
					</div>
				</div>

			</div>
		</div>

<?php
}
?>