<!--
	autor: Nemanja Bogdanovic, 2012/0533
	@version: 1.0
-->
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
						<h1 class="css-header">Izostanci</h1>

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
											<p> Ukoliko vise ucenika ne prisustvuje casu, unosite jednog po jednog </p>
											<form name = "search_form" method= "POST" action = "izostanci">
												<select name = 'iz' style = "width: 350px">
												<option value="" disabled selected> Izaberite ucenika koji ne prisustvuje casu: </option>
											<?php
											if ($fetch_data->num_rows() > 0)
											{
												foreach($fetch_data->result() as $row)
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
										<input type="submit" name = "search_izostanak" value = "Unesi">
									</form>
								</div>



										<br>








	           </div>
       </div>
  </div>


</div>
