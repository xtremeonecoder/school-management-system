<?php
include_once('../sources/essential.php');
db_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SPCL | Student Support System</title>
<style type="text/css">
#printable { display: none; }
@media print
{
	#non-printable { display: none; }
	#printable { display: block; }
}
</style>
<script type="text/javascript">
function printThisPage()
{
	window.print();
	window.close();
}
</script>
</head>
<body onload="printThisPage()">
<div style="margin-left:14%; margin-right:14%;">
	<?php
	$userInfo = selectRow(array(), 'spcl_signup as T1, spcl_student_info as T2, spcl_student_request T3', "T1.uid = T2.uid AND T1.uid = T3.uid AND T1.uid = '".$_GET['user_id']."' AND T3.id = '".$_GET['id']."'");
	?>
    <div id="non-printable">
		<h3>Print Page</h3>
		<br /><br />
    </div>
    <div id="printable">
		<img src="../images/spcl_logo.gif" border="0" title="St. Peter College of London" width="100%" />
		<br /><br />
		<div style="border:1px solid #666666; padding:30px;">
			<table border="0" cellpadding="1" cellspacing="2" style="font-weight: bold;" width="100%">
				<tr bgcolor="#DFDFFF"><td width="35%">Student Name</td><td width="2%">:</td><td><?php echo $userInfo->title.' '.$userInfo->first_name.' '.$userInfo->last_name; ?></p></td></tr>
				<tr bgcolor="#DFDFFF"><td>Student ID</td><td>:</td><td><?php echo $userInfo->user_id; ?></p></td></tr>
				<tr bgcolor="#DFDFFF"><td>Request On</td><td>:</td><td><?php echo date('M d, Y', strtotime($userInfo->send_date)); ?></p></td></tr>
				<tr bgcolor="#DFDFFF"><td>Level</td><td>:</td><td><?php echo $userInfo->level; ?></p></td></tr>
				<tr bgcolor="#DFDFFF"><td>Study Session</td><td>:</td><td><?php echo $userInfo->session; ?></p></td></tr>
				<tr bgcolor="#DFDFFF"><td>Academic Year</td><td>:</td><td><?php echo $userInfo->academic; ?></p></td></tr>
				<tr bgcolor="#DFDFFF"><td>Awarding Body</td><td>:</td><td><?php echo $userInfo->awarding_body; ?></p></td></tr>
			</table>							
		</div>
    </div>
</div>	
</body>
</html>
