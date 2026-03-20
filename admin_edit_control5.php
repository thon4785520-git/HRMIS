<?
session_start();
if($_SESSION[ss_status]!="admin"){
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
        <h3> <i class="fa fa-pencil text-success"></i> ระยะการจ้างครั้งที่ 4 </h3>
</div>

<?
include"config.php";

$_GET[id]=base64_decode($_GET[id]);

$sql="select * from controls where STAFFID=$_GET[id]";
$res=mysql_query($sql);
$rs=mysql_fetch_array($res);
?>

<!-- form -->
<FORM METHOD="POST" ACTION="admin_edit_control52.php" id="form1" class="well jumbotron" enctype="multipart/form-data">

<div class="form-group">
         <label>วันที่ครบ</label>
         <input class="form-control required" type="date" name="ch27" value="<?=$rs[ch27]?>">
</div>
<div class="form-group">
         <label>คำสั่งที่</label>
         <input class="form-control required number" type="text" name="ch28" value="<?=$rs[ch28]?>">
</div>
<div class="form-group">
         <label>สั่ง ณ วันที่</label>
         <input class="form-control required" type="date" name="ch29" value="<?=$rs[ch29]?>">
</div>
<div class="form-group">
         <label>ตั้งแต่</label>
         <input class="form-control required" type="date" name="ch30" value="<?=$rs[ch30]?>">
</div>
<div class="form-group">
         <label>สิ้นสุด</label>
         <input class="form-control required" type="date" name="ch31" value="<?=$rs[ch31]?>">
</div>
<div class="form-group">
         <label>เอกสารประกอบการประเมิน</label><br>
         <?
		 $x=explode(",", $rs[32]);
		 ?>
		<input type="checkbox" name="ch32[]" value="1" <? if(in_array(1,$x))echo"checked";?>> MOU สองรอบประเมิน<br>
		<input type="checkbox" name="ch32[]" value="2" <? if(in_array(2,$x))echo"checked";?>> ผลการประเมินตนเองด้านภาษาอังกฤษ<br>
 		<input type="checkbox" name="ch32[]" value="3" <? if(in_array(3,$x))echo"checked";?>> หลักฐานการพิมพ์ลายนิ้วมือ<br>
		<input type="checkbox" name="ch32[]" value="4" <? if(in_array(4,$x))echo"checked";?>> ผลงานทางวิชาการ<br>
		<input type="checkbox" name="ch32[]" value="5" <? if(in_array(5,$x))echo"checked";?>> คู่มือการปฏิบัติงาน<br>
</div>
<div class="form-group">
         <label>ไฟล์คำสั่งจ้าง</label>
         <input class="form-control" type="file" name="ch33" value="<?=$rs[ch33]?>">         
</div>
        <?
		 $y=explode(",", $rs[ch34]);
		 ?>
<div class="form-group">
         <label>สถานะ</label><br>
		<input type="checkbox" name="ch34[]" value="1" <? if(in_array(1,$y))echo"checked";?>> ส่งงานคลัง<br>
		<input type="checkbox" name="ch34[]" value="2" <? if(in_array(2,$y))echo"checked";?>> ส่งนิติกร<br>
</div>

<INPUT TYPE="hidden" name="id" value="<?=$_GET[id]?>">
<INPUT TYPE="hidden" name="old" value="<?=$rs[ch33]?>">
<INPUT TYPE="submit" class="btn btn-success" value="Save">
<INPUT TYPE="reset" class="btn btn-warning" value="Reset">

</FORM>

</body>

</html>