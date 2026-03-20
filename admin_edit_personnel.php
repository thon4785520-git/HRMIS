<?php
session_start();
if($_SESSION['ss_status']!="admin"){
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Absent Database System</title>

    <!-- jQuery --> 
   <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Theme CSS -->
    <link href="css/clean.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

<!--begin validate-->
<script type="text/javascript" src="js/jquery.validate.js" charset="utf-8"></script>
<style type="text/css">
label.error{
color: red;
font-weight:bold;
font-size: 13px;
}
</style>
  <script>
  $(document).ready(function(){
    $("#form1").validate();
  });
  </script>
<!--end validate-->

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="container-fluid" style="background:#FFF">

<!--Header-->
<div class="page-header">
        <h3> <i class="fa fa-pencil text-success"></i> 䢢ǹؤ </h3>
</div>

<?php
include"config.php";

$_GET['id']=base64_decode($_GET['id']);

$sql="select * from staff where STAFFID={$_GET['id']}";
$res=mysql_query($sql);
$rs=mysql_fetch_array($res);
?>

<!-- form -->
<FORM METHOD="POST" ACTION="admin_edit_personnel2.php" id="form1" class="well jumbotron">

<div class="form-group">
         <label>ŢѵûЪҪ</label>
         <input class="form-control required" type="text" name="CITIZENID" value="<?=$rs['CITIZENID']?>">
</div>
<div class="form-group">
         <label>Ţ˹</label>
         <input class="form-control required" type="text" name="STAFFNO" value="<?=$rs['STAFFNO']?>">
</div>
<div class="form-group">
         <label>ѹӧҹ</label>
         <input class="form-control required" type="date" name="STARTDATE" value="<?=$rs['STARTDATE']?>">
</div>
<div class="form-group">
         <label>ѹè</label>
         <input class="form-control required" type="date" name="PACKDATE" value="<?=$rs['PACKDATE']?>">
</div>

<INPUT TYPE="hidden" name="STAFFID" value="<?=$rs[0]?>">
<INPUT TYPE="submit" class="btn btn-success" value="Save">
<INPUT TYPE="reset" class="btn btn-warning" value="Reset">

</FORM>

</body>

</html>