<!--
	autor: Markovic Milos, 0096/2012
	@version: 1.0
-->
<?php echo form_open('koordinator/prikazRasporedaO'); ?>
<div class="col col-lg-2 col-md-3 col-sm-3 col-xs-12 left-container">
	<div class="tm-left-inner-container">
		<ul class="nav nav-stacked css-nav">
			<li><a href="<?php echo base_url(); ?>koordinator/index">Početna</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/predmeti">Predmeti</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/raspored">Raspored časova</a></li>
			<li><a href="<?php echo base_url(); ?>koordinator/uredjivanje">Uređivanje naloga</a></li>
		</ul>
	</div>
</div>
<div class="col col-lg-8 col-md-7 col-sm-7 col-xs-12 right-container">	
	<div class="tm-right-inner-container">
		
		
<div class="row">
	<div class="col-md-6">
		<h1 class="text-center"><?php echo $title; ?></h1>
		
			<div class="form-group">
					<label>Za odeljenje:</label>
					<?php
					echo "<select name='odeljenje'>";
					foreach($odeljenja->result() as $row) {
					?>
						echo "<option value="<?php echo $row->id; ?>"><?php echo $row->oznaka; ?></option>"; 
					<?php
					}
					echo "</select>";
					?>
			</div>
		

		
			

		
	
		<button type="submit" class="btn btn-primary btn-block">Izmeni</button> 
			
	</div>	

		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

<style type = "text/css">
	#show_table{
alignment-adjust: center;
}
table{
align: center;
height:700px;
width:900px;
}
table td{
padding:10px;
text-align: center;
border: 1px solid #999;
vertical-aling: top;
background-color: #DEF; 
}
caption{
font-size: 24px;
font-weight: bold;
}
.row1_col1{
background-color: #4863A0;
font-weight:bold;
color:white;
font-size:28px;
}
.row1_col2{
font-weight:bold;
}
.row2_col3, .row2_col5, .row2_col4, .row2_col2, .row2_col1, .row2_col0{
font-weight:bold;
}

	</style>


	<body>
<center>
<div id="show_table">
<?php
// Create cation for table
$this->table->set_caption('Raspored Casova Za Odeljenje: '. $odeljenje);

// Set a table template to specify the design of table layout
$table_property = array('table_open' => '<table cellpadding="10" cellspacing="10" class="table_show">');
$this->table->set_template($table_property);

// Create a row with colspan
$row1_col1 = array('data' => $this->session->userdata('username'),  'colspan' => 6, 'class' => 'row1_col1');
$this->table->add_row($row1_col1);

// Create a row with rowspan and colspan
$row2_col0 = array('data' => 'Vreme', 'rowspan' => 1, 'class' => 'row2_col0');
$row2_col1 = array('data' => 'Ponedeljak', 'rowspan' => 1, 'class' => 'row2_col1');
$row2_col2 = array('data' => 'Utorak', 'colspan' => 1, 'class' => 'row2_col2');
$row2_col3 = array('data' => 'Sreda', 'colspan' => 1, 'rowspan' => 1, 'class' => 'row2_col3');
$row2_col4 = array('data' => 'Cetvrtak', 'colspan' => 1, 'rowspan' => 1, 'class' => 'row2_col4');
$row2_col5 = array('data' => 'Petak', 'colspan' => 1, 'rowspan' => 1, 'class' => 'row2_col5');
$this->table->add_row($row2_col0, $row2_col1, $row2_col2, $row2_col3, $row2_col4, $row2_col5);

$row3_col0 = array('data' => '08:00 - 09:00', 'rowspan' => 1, 'class' => 'row3_col0');
$row3_col1 = array('data' => $ponedeljak[1], 'rowspan' => 1, 'class' => 'row3_col1');
$row3_col2 = array('data' => $utorak[1], 'rowspan' => 1, 'class' => 'row3_col2');
$row3_col3 = array('data' => $sreda[1], 'rowspan' => 1, 'class' => 'row3_col3');
$row3_col4 = array('data' => $cetvrtak[1], 'colspan' => 1, 'class' => 'row3_col4');
$row3_col5 = array('data' => $petak[1], 'colspan' => 1, 'class' => 'row3_col5');
$this->table->add_row($row3_col0, $row3_col1, $row3_col2, $row3_col3, $row3_col4, $row3_col5);

$row4_col0 = array('data' => '09:00 - 10:00', 'rowspan' => 1, 'class' => 'row4_col0');
$row4_col1 = array('data' => $ponedeljak[2], 'colspan' => 1, 'class' => 'row4_col1');
$row4_col2 = array('data' => $utorak[2], 'colspan' => 1, 'class' => 'row4_col2');
$row4_col3 = array('data' => $sreda[2], 'colspan' => 1, 'class' => 'row4_col3');
$row4_col4 = array('data' => $cetvrtak[2], 'colspan' => 1, 'class' => 'row4_col4');
$row4_col5 = array('data' => $petak[2], 'colspan' => 1, 'class' => 'row4_col5');
$this->table->add_row($row4_col0, $row4_col1, $row4_col2, $row4_col3, $row4_col4, $row4_col5);

$row5_col0 = array('data' => '10:00 - 11:00', 'rowspan' => 1, 'class' => 'row5_col0');
$row5_col1 = array('data' => $ponedeljak[3], 'rowspan' => 1, 'class' => 'row5_col1');
$row5_col2 = array('data' => $utorak[3], 'class' => 'row5_col2');
$row5_col3 = array('data' => $sreda[3], 'class' => 'row5_col3');
$row5_col4 = array('data' => $cetvrtak[3], 'colspan' => 1, 'class' => 'row5_col4');
$row5_col5 = array('data' => $petak[3], 'colspan' => 1, 'class' => 'row5_col5');
$this->table->add_row($row5_col0, $row5_col1, $row5_col2, $row5_col3, $row5_col4, $row5_col5);

$row6_col0 = array('data' => '12:00 - 13:00', 'rowspan' => 1, 'class' => 'row6_col0');
$row6_col1 = array('data' => $ponedeljak[4], 'rowspan' => 1, 'class' => 'row6_col1');
$row6_col2 = array('data' => $utorak[4], 'class' => 'row6_col2');
$row6_col3 = array('data' => $sreda[4], 'class' => 'row6_col3');
$row6_col4 = array('data' => $cetvrtak[4], 'colspan' => 1, 'class' => 'row6_col4');
$row6_col5 = array('data' => $petak[4], 'colspan' => 1, 'class' => 'row6_col5');
$this->table->add_row($row6_col0, $row6_col1, $row6_col2, $row6_col3, $row6_col4, $row6_col5);

$row7_col0 = array('data' => '13:00 - 14:00', 'rowspan' => 1, 'class' => 'row7_col0');
$row7_col1 = array('data' => $ponedeljak[5], 'rowspan' => 1, 'class' => 'row7_col1');
$row7_col2 = array('data' => $utorak[5], 'class' => 'row7_col2');
$row7_col3 = array('data' => $sreda[5], 'class' => 'row7_col3');
$row7_col4 = array('data' => $cetvrtak[5], 'colspan' => 1, 'class' => 'row7_col4');
$row7_col5 = array('data' => $petak[5], 'colspan' => 1, 'class' => 'row7_col5');
$this->table->add_row($row7_col0, $row7_col1, $row7_col2, $row7_col3, $row7_col4, $row7_col5);

$row8_col0 = array('data' => '14:00 - 15:00', 'rowspan' => 1, 'class' => 'row8_col0');
$row8_col1 = array('data' => $ponedeljak[6], 'rowspan' => 1, 'class' => 'row8_col1');
$row8_col2 = array('data' => $utorak[6], 'class' => 'row8_col2');
$row8_col3 = array('data' => $sreda[6], 'class' => 'row8_col3');
$row8_col4 = array('data' => $cetvrtak[6], 'colspan' => 1, 'class' => 'row8_col4');
$row8_col5 = array('data' => $petak[6], 'colspan' => 1, 'class' => 'row8_col5');
$this->table->add_row($row8_col0, $row8_col1, $row8_col2, $row8_col3, $row8_col4, $row8_col5);

$row9_col0 = array('data' => '15:00 - 16:00', 'rowspan' => 1, 'class' => 'row9_col0');
$row9_col1 = array('data' => $ponedeljak[7], 'rowspan' => 1, 'class' => 'row9_col1');
$row9_col2 = array('data' => $utorak[7], 'class' => 'row9_col2');
$row9_col3 = array('data' => $sreda[7], 'class' => 'row9_col3');
$row9_col4 = array('data' => $cetvrtak[7], 'colspan' => 1, 'class' => 'row9_col4');
$row9_col5 = array('data' => $petak[7], 'colspan' => 1, 'class' => 'row9_col5');
$this->table->add_row($row9_col0, $row9_col1, $row9_col2, $row9_col3, $row9_col4, $row9_col5);

$row10_col0 = array('data' => '16:00 - 17:00', 'rowspan' => 1, 'class' => 'row10_col0');
$row10_col1 = array('data' => $ponedeljak[8], 'rowspan' => 1, 'class' => 'row10_col1');
$row10_col2 = array('data' => $utorak[8], 'class' => 'row10_col2');
$row10_col3 = array('data' => $sreda[8], 'class' => 'row10_col3');
$row10_col4 = array('data' => $cetvrtak[8], 'colspan' => 1, 'class' => 'row10_col4');
$row10_col5 = array('data' => $petak[8], 'colspan' => 1, 'class' => 'row10_col5');
$this->table->add_row($row10_col0, $row10_col1, $row10_col2, $row10_col3, $row10_col4, $row10_col5);

$row11_col0 = array('data' => '17:00 - 18:00', 'rowspan' => 1, 'class' => 'row11_col0');
$row11_col1 = array('data' => $ponedeljak[9], 'rowspan' => 1, 'class' => 'row11_col1');
$row11_col2 = array('data' => $utorak[9], 'class' => 'row11_col2');
$row11_col3 = array('data' => $sreda[9], 'class' => 'row11_col3');
$row11_col4 = array('data' => $cetvrtak[9], 'colspan' => 1, 'class' => 'row11_col4');
$row11_col5 = array('data' => $petak[9], 'colspan' => 1, 'class' => 'row11_col5');
$this->table->add_row($row11_col0, $row11_col1, $row11_col2, $row11_col3, $row11_col4, $row11_col5);

$row12_col0 = array('data' => '18:00 - 19:00', 'rowspan' => 1, 'class' => 'row12_col0');
$row12_col1 = array('data' => $ponedeljak[10], 'rowspan' => 1, 'class' => 'row12_col1');
$row12_col2 = array('data' => $utorak[10], 'class' => 'row12_col2');
$row12_col3 = array('data' => $sreda[10], 'class' => 'row12_col3');
$row12_col4 = array('data' => $cetvrtak[10], 'colspan' => 1, 'class' => 'row12_col4');
$row12_col5 = array('data' => $petak[10], 'colspan' => 1, 'class' => 'row12_col5');
$this->table->add_row($row12_col0, $row12_col1, $row12_col2, $row12_col3, $row12_col4, $row12_col5);

$row13_col0 = array('data' => '19:00 - 20:00', 'rowspan' => 1, 'class' => 'row13_col0');
$row13_col1 = array('data' => $ponedeljak[11], 'rowspan' => 1, 'class' => 'row13_col1');
$row13_col2 = array('data' => $utorak[11], 'class' => 'row13_col2');
$row13_col3 = array('data' => $sreda[11], 'class' => 'row13_col3');
$row13_col4 = array('data' => $cetvrtak[11], 'colspan' => 1, 'class' => 'row13_col4');
$row13_col5 = array('data' => $petak[11], 'colspan' => 1, 'class' => 'row13_col5');
$this->table->add_row($row13_col0, $row13_col1, $row13_col2, $row13_col3, $row13_col4, $row13_col5);
// Generate table
echo $this->table->generate();
?>
</div>
</center>
</body>
	
	
		
		
	</div>	
</div>
</div>


<?php echo form_close(); ?>