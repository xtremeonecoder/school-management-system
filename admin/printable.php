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
</head>
<body>
    <div id="non-printable">
        <h3>SPCL Student ID & Password:</h3>
		<input type="button" value="Print The Page" onclick="window.print(); window.close();" />
    </div>

    <div id="printable">
        <h3>SPCL Student ID & Password:</h3>
		<p>Studen ID&nbsp;:&nbsp;<?php echo $_GET['user_id']; ?></p>
		<p>Password&nbsp;:&nbsp;<?php echo $_GET['password']; ?></p>		
    </div>
</body>
</html>
