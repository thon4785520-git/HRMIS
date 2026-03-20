<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
  <!-- jQuery -->
   <script src="js/jquery.js"></script>
   
   <!-- css datepicker -->
    <link rel="stylesheet" href="jquery.datetimepicker.css">

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Theme CSS -->
    <link href="css/united.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
	
<title>HRMIS</title>
</head>

<body style="background:#FFF;padding:10px;">
<!--Header-->
<div class="page-header">
        <h4> ѹԺѵԧҹ </h4>
</div>

<?php
include"config.php";
$sql="select * from work1 A,staff B where A.STAFFID=B.STAFFID and A.dated='{$_GET['dated']}' and A.STAFFID={$_GET['id']}";
//echo $sql;
$res=mysql_query($sql);
$rs=mysql_fetch_array($res);
?>

<!-- form -->
<FORM METHOD="POST" ACTION="" id="form1" class="well jumbotron">

<div class="form-group">
         <label> - ʡ ؤҡ</label>
         <input class="form-control required" type="text" name="xxx" value="<?=$rs['STAFFNAME']?> <?=$rs['STAFFSURNAME']?>">
</div>
<div class="form-group">
         <label>ѹ軯Ժѵԧҹ</label>
         <input class="form-control required" type="date" name="dated" value="<?=$rs['dated']?>">		 
</div>
<div class="form-group">
         <label>һԺѵԧҹ</label>
         <input class="required" type="text" name="timein" value="<?=$rs['timein']?>">	- 	
		 <input class="required" type="text" name="timeout" value="<?=$rs['timeout']?>">
</div>
<div class="form-group">
         <label>˵ؼ</label>
         <input class="form-control required" type="text" name="reason" value="<?=$rs['reason']?>">		 
</div>

<INPUT TYPE="submit" class="btn btn-success" value="Save" name="submit">
<INPUT TYPE="reset" class="btn btn-warning" value="Reset">
<INPUT TYPE="hidden" class="btn btn-warning" value="<?=$_GET['id']?>" name="id">
</FORM>
</body>
</html>
<?php
if($_POST['submit']){
	$sql="update work1 set reason='{$_POST['reason']}', timein='{$_POST['timein']}', timeout='{$_POST['timeout']}' where STAFFID={$_POST['id']} and dated='{$_POST['dated']}' ";
	$res=mysql_query($sql);
	echo "<div class='alert alert-success'>Save OK</div>";
}
?>