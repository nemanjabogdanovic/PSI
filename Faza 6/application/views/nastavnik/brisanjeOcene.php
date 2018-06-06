<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->

<?php echo form_open('nastavnik/brisanje'); ?>

<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>nastavnik/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/kalendar">Kalendar</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/ucenici">Učenici</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/upis">Upis časa</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/izostanci">Izostanci</a></li>
			<li><a href="<?php echo base_url(); ?>nastavnik/ocene">Ocene</a></li>
		</ul>
	</div>
</div>



<style type="text/css">
    select {
        width:200px;
    }
</style>


<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">
	<div class="tm-right-inner-container">
												
											
										
				<div style="width: 850px; overflow: hidden;">
						<h1 class="css-header">Brisanje ocene</h1>

							<div style="width: 850px; float: left;">

								<form name = "search_form" method= "POST" action = "izostanci">
									<strong style = "font-style:oblique; font-size:18px;"> Izaberite odeljenje: </strong>
									<br>


									<br>

								<br>

								<select name = 'od'>
										<option value="" disabled selected> Odeljenje </option>
									<?php
									if ($odeljenja->num_rows() > 0)
									{
										foreach($odeljenja->result() as $row)
										{
									?>
														<option option value="<?php echo $row->id; ?>"  > <?php echo $row->oznaka; ?> </option>

										<?php
										}
									}
									else {
										?>
									 <option> Nema odeljenja </option>
									<?php

									}
									?>
								</select>
								
							<strong style = "font-style:oblique; font-size:18px;"> Izaberite Predmet: </strong>	
							<br>
							<br>
									<div class="form-group">
										
											<?php
											echo "<select name='predmet'>";
											foreach($predmetiSelect->result() as $row) {
											?>
												echo "<option value="<?php echo $row->id; ?>"><?php echo $row->ime; ?></option>"; 
											<?php
											}
											echo "</select>";
											?>
									</div>
								<br>
								<br>
									<input type="submit" name = "search1" value = "Generisi ">

											</form>




									<table class = "table table-bordered" id= "tabela">



											<?php
											if ($fetch_data->num_rows() > 0)
											{

											?>
											<strong style = "font-style:oblique;font-size:18px;">Spisak ucenika: </strong>
											<br>
											<br>

											<tr style = "border: 2px solid black;background-color:#337ab7;">
												 <td style = "border: 1px solid black; " > <strong> Ime</strong> </td>
												 <td style = "border: 1px solid black; "><strong> Prezime</strong> </td>

										 <tr>

											<?php
												foreach($fetch_data->result() as $row)
												{
											?>


														<td style = "background-color:#lightblue; border:1px solid black;"> <?php echo $row->name; ?> </td>
														<td style = "background-color:#lightblue; border:1px solid black;"> <?php echo $row->surname; ?> </td>

													</tr>
												<?php
												}
											}
											else {
												?>
												<tr colspan = "2">

												 <strong style = "font-size:20px">	Nema ucenika! </strong>

												</tr>

											<?php

											}
											?>
										</table>
							<div style = "border: 1px solid black; width:850px; padding: 15px; background-color:#88b5dd;">
					
											<label>Učenik:</label>
											<br>
												<select name = 'iz' style = "width: 350px">
												<option value="" disabled selected> Izaberite učenika </option>
											<?php
											if ($ucenici->num_rows() > 0)
											{
												foreach($ucenici->result() as $row)
												{
											?>
																<option value="<?php echo $row->id; ?>"> <?php echo $row->name." ".$row->surname; ?> </option>

												<?php
												}
											}
											else {
												?>
											 <option> Nema ucenika </option>
											<?php

											}
											?>
										</select>
										<br>
										<br>
										<div class="form-group">
												<label>Predmet:</label>
												<br>
												<?php
												echo "<select name='ime'>";
												foreach($predmeti->result() as $row) {
												?>
													echo "<option value="<?php echo $row->id; ?>"><?php echo $row->ime; ?></option>"; 
												<?php
												}
												echo "</select>";
												?>
										</div>	
										

										
										<br>
										<br>
									<button type="submit" class="btn btn-primary btn-block">Izaberi</button>
									
								</div>

										
								<br>



										<br>








	           </div>
       </div>
  </div>


</div>

<?php echo form_close(); ?>
