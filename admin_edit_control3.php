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
        <h3> <i class="fa fa-pencil text-success"></i> Сèҧ駷 2 </h3>
</div>

<?php
include"config.php";

$_GET['id']=base64_decode($_GET['id']);

$sql="select * from controls where STAFFID={$_GET['id']}";
$res=mysql_query($sql);
$rs=mysql_fetch_array($res);
?>

<!-- form -->
<FORM METHOD="POST" ACTION="admin_edit_control32.php" id="form1" class="well jumbotron" enctype="multipart/form-data">

<div class="form-group">
         <label>ѹú</label>
         <input class="form-control required" type="date" name="ch11" value="<?=$rs['ch11']?>">
</div>
<div class="form-group">
         <label>觷</label>
         <input class="form-control required number" type="text" name="ch12" value="<?=$rs['ch12']?>">
</div>
<div class="form-group">
         <label>  ѹ</label>
         <input class="form-control required" type="date" name="ch13" value="<?=$rs['ch13']?>">
</div>
<div class="form-group">
         <label></label>
         <input class="form-control required" type="date" name="ch14" value="<?=$rs['ch14']?>">
</div>
<div class="form-group">
         <label>ش</label>
         <input class="form-control required" type="date" name="ch15" value="<?=$rs['ch15']?>">
</div>
<div class="form-group">
         <label>͡ûСͺûԹ</label><br>
         <?php
		 $x=explode(",", $rs[16]);
		 ?>
		<input type="checkbox" name="ch16[]" value="1" <?php if(in_array(1,$x))echo"checked";?>> MOU ͧͺԹ<br>
		<input type="checkbox" name="ch16[]" value="2" <?php if(in_array(2,$x))echo"checked";?>> šûԹͧҹѧ<br>
 		<input type="checkbox" name="ch16[]" value="3" <?php if(in_array(3,$x))echo"checked";?>> ѡҹþ¹<br>
		<input type="checkbox" name="ch16[]" value="4" <?php if(in_array(4,$x))echo"checked";?>> ŧҹҧԪҡ<br>
		<input type="checkbox" name="ch16[]" value="5" <?php if(in_array(5,$x))echo"checked";?>> ͡ûԺѵԧҹ<br>
</div>
<div class="form-group">
         <label>觨ҧ</label>
         <input class="form-control" type="file" name="ch17" value="<?=$rs['ch17']?>">         
</div>
        <?php
		 $y=explode(",", $rs['ch18']);
		 ?>
<div class="form-group">
         <label>ʶҹ</label><br>
		<input type="checkbox" name="ch18[]" value="1" <?php if(in_array(1,$y))echo"checked";?>> 觧ҹѧ<br>
		<input type="checkbox" name="ch18[]" value="2" <?php if(in_array(2,$y))echo"checked";?>> 觹Եԡ<br>
</div>

<INPUT TYPE="hidden" name="id" value="<?=$_GET['id']?>">
<INPUT TYPE="hidden" name="old" value="<?=$rs['ch17']?>">
<INPUT TYPE="submit" class="btn btn-success" value="Save">
<INPUT TYPE="reset" class="btn btn-warning" value="Reset">

</FORM>

</body>

</html>