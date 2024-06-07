<?php
$query=$_POST["textfield"];
$global_dbh = mysql_connect("mundoprogresivocom.powwebmysql.com","ce_clima","Asdfg@12345");
mysql_select_db ("climaorganizacional", $global_dbh) OR die ("No se puede conectar");
function display_db_query($query_string, $connection, $header_bool, $table_params) {
	// perform the database query
	$result_id = mysql_query($query_string, $connection)
	or die(mysql_error());
	// find out the number of columns in result
	$column_count = mysql_num_fields($result_id)
	or die(mysql_error());
	// Here the table attributes from the $table_params variable are added
	print("<TABLE $table_params >\n");
	// optionally print a bold header at top of table
	if($header_bool) {
		print("<TR>");
		for($column_num = 0; $column_num < $column_count; $column_num++) {
			$field_name = mysql_field_name($result_id, $column_num);
			print("<TH>$field_name</TH>");
		}
		print("</TR>\n");
	}
	// print the body of the table
	while($row = mysql_fetch_row($result_id)) {
		print("<TR ALIGN=LEFT VALIGN=TOP>");
		for($column_num = 0; $column_num < $column_count; $column_num++) {
			print("<TD>$row[$column_num]</TD>\n");
		}
		print("</TR>\n");
	}
	print("</TABLE>\n"); 
}
function display_db_table($tablename, $connection, $header_bool, $table_params) {
	$query=$_POST["textfield"];
	$query_string = $query;
	display_db_query($query_string, $connection, $header_bool, $table_params);
}
?>
<style type="text/css">
<!--
.style4 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
<HTML><HEAD><TITLE>Query Analizer</TITLE></HEAD>
<body style="background-color:#EDE8E4;">
<form name="form1" method="post" action="">
<textarea name="textfield" cols="150" rows="4" type="text"><?php echo $query ?></textarea>
<input name="Submit"  type="submit" class="btn btn-lg btn-primary"  class="style4" value="RUN" valign="top">
</form>
<TABLE><TR><TD>
<?php
display_db_table($table, $global_dbh, TRUE, "class='style4' border='1' cellspacing='0' cellpadding='1' bordercolor='#FFFFFF' bgcolor='#BBBBBB'");
?>
</TD></TR></TABLE></BODY></HTML>