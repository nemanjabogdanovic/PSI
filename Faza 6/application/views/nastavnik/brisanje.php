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

						
										<div class="form-group">
												<label>Ocena:</label>
												<br>
												<?php
												echo "<select name='ocena'>";
												foreach($ocene->result() as $row) {
												?>
													echo "<option value="<?php echo $row->id; ?>"><?php echo $row->ocena; ?></option>"; 
												<?php
												}
												echo "</select>";
												?>
										</div>		
												<button type="submit" class="btn btn-primary" />Obriši</button>
										
						

       </div>
  </div>


</div>

<?php echo form_close(); ?>
