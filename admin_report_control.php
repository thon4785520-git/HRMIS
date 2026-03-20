<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>HRMIS</title>
</head>

<body>
<strong>รายงานทะเบียนคุมสัญญา พนักงานมหาวิทยาลัย 
</strong><br /><br />
<?
include"config.php";
if($_POST[DEPARTMENTID]==4785520)
	$sql="select * from staff where STAFFTYPE=4 order by STAFFNAME";
else
	$sql="select * from staff where DEPARTMENTID=$_POST[DEPARTMENTID] and STAFFTYPE=4 order by STAFFNAME";
$res=mysql_query($sql);
while($ln=mysql_fetch_array($res)){
	$sql1="select * from controls where STAFFID=$ln[STAFFID]";
	$res1=mysql_query($sql1);
	$ln1=mysql_fetch_array($res1);
?>
<table cellpadding="7" cellspacing="0" width="100%" style="font-size:13px;border:1px solid #000">
<tr bgcolor="#33CCFF">
	<th width="12%" align="left">เลขที่ตำแหน่ง</th>
	<th width="22%" align="left">ชื่อ - สกุล</th>
	<th width="22%" align="left">ตำแหน่ง</th>
	<th width="22%" align="left">ครบ 6 เดือน ครั้งที่ 1</th>
	<th width="22%" align="left">ครบ 6 เดือน ครั้งที่ 2</th>
</tr>
<tr valign="top">
	<td><?=$ln[STAFFNO]?> </td>
	<td> <?=$ln[PREFIXNAME]?><?=$ln[STAFFNAME]?> <?=$ln[STAFFSURNAME]?> </td>
	<td><?=$ln[POSITIONNAME]?> </td>
	<td>   
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch1])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch2]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch3])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch4])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch5])?></td></tr>        
        </table>
	</td>
	<td>   
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch6])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch7]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch8])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch9])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch10])?></td></tr>        
        </table>            
	</td>
</tr>
<tr bgcolor="#CCFFFF">
	<th align="left">ระยะการจ้าง ครั้งที่ 2</th>
	<th align="left">ระยะการจ้าง ครั้งที่ 3</th>
	<th align="left">ระยะการจ้าง ครั้งที่ 4</th>
	<th align="left">ระยะการจ้าง ครั้งที่ 5</th>
	<th align="left">ระยะการจ้าง ครั้งที่ 6</th>    
</tr>
<tr>
	<td>
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch11])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch12]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch13])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch14])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch15])?></td></tr>   
        <tr>
        	<td colspan="2">
            <br />เอกสารประกอบ<br />
        <?
		 $x=explode(",", $ln1[ch16]);
		 ?>
         <font style="font-size:10px;">
		<input type="checkbox"  <? if(in_array(1,$x))echo"checked";?>> MOU สองรอบประเมิน<br>
		<input type="checkbox"  <? if(in_array(2,$x))echo"checked";?>> ผลประเมินภาษาอังกฤษ<br>
 		<input type="checkbox"  <? if(in_array(3,$x))echo"checked";?>> หลักฐานพิมพ์ลายนิ้วมือ<br>
		<input type="checkbox"  <? if(in_array(4,$x))echo"checked";?>> ผลงานทางวิชาการ<br>
		<input type="checkbox"  <? if(in_array(5,$x))echo"checked";?>> คู่มือการปฏิบัติงาน<br>
        </font>
            </td>
        </tr>    
        <tr><td>ไฟล์เอกสาร</td><td><a href="file/<?=$ln1[ch17]?>" target="_blank">Download</a></td></tr> 
        <tr><td colspan="2"><br />สถานะ <br />
         <?
		 $y=explode(",", $ln1[ch18]);
		 ?> 
		<input type="checkbox" <? if(in_array(1,$y))echo"checked";?>> ส่งงานคลัง<br>
		<input type="checkbox" <? if(in_array(2,$y))echo"checked";?>> ส่งนิติกร<br>        
        </td>
        </tr>
        </table>     
    </td>
	<td>
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch19])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch20]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch21])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch22])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch23])?></td></tr>   
        <tr>
        	<td colspan="2">
            <br />เอกสารประกอบ<br />
        <?
		 $x=explode(",", $ln1[ch24]);
		 ?>
         <font style="font-size:10px;">
		<input type="checkbox"  <? if(in_array(1,$x))echo"checked";?>> MOU สองรอบประเมิน<br>
		<input type="checkbox"  <? if(in_array(2,$x))echo"checked";?>> ผลประเมินภาษาอังกฤษ<br>
 		<input type="checkbox"  <? if(in_array(3,$x))echo"checked";?>> หลักฐานพิมพ์ลายนิ้วมือ<br>
		<input type="checkbox"  <? if(in_array(4,$x))echo"checked";?>> ผลงานทางวิชาการ<br>
		<input type="checkbox"  <? if(in_array(5,$x))echo"checked";?>> คู่มือการปฏิบัติงาน<br>
        </font>
            </td>
        </tr>    
        <tr><td>ไฟล์เอกสาร</td><td><a href="file/<?=$ln1[ch25]?>" target="_blank">Download</a></td></tr> 
        <tr><td colspan="2"><br />สถานะ <br />
         <?
		 $y=explode(",", $ln1[ch26]);
		 ?> 
		<input type="checkbox" <? if(in_array(1,$y))echo"checked";?>> ส่งงานคลัง<br>
		<input type="checkbox" <? if(in_array(2,$y))echo"checked";?>> ส่งนิติกร<br>        
        </td>
        </tr>
        </table>    
    </td>
	<td>
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch27])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch28]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch29])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch30])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch31])?></td></tr>   
        <tr>
        	<td colspan="2">
            <br />เอกสารประกอบ<br />
        <?
		 $x=explode(",", $ln1[ch32]);
		 ?>
         <font style="font-size:10px;">
		<input type="checkbox"  <? if(in_array(1,$x))echo"checked";?>> MOU สองรอบประเมิน<br>
		<input type="checkbox"  <? if(in_array(2,$x))echo"checked";?>> ผลประเมินภาษาอังกฤษ<br>
 		<input type="checkbox"  <? if(in_array(3,$x))echo"checked";?>> หลักฐานพิมพ์ลายนิ้วมือ<br>
		<input type="checkbox"  <? if(in_array(4,$x))echo"checked";?>> ผลงานทางวิชาการ<br>
		<input type="checkbox"  <? if(in_array(5,$x))echo"checked";?>> คู่มือการปฏิบัติงาน<br>
        </font>
            </td>
        </tr>    
        <tr><td>ไฟล์เอกสาร</td><td><a href="file/<?=$ln1[ch33]?>" target="_blank">Download</a></td></tr> 
        <tr><td colspan="2"><br />สถานะ <br />
         <?
		 $y=explode(",", $ln1[ch34]);
		 ?> 
		<input type="checkbox" <? if(in_array(1,$y))echo"checked";?>> ส่งงานคลัง<br>
		<input type="checkbox" <? if(in_array(2,$y))echo"checked";?>> ส่งนิติกร<br>        
        </td>
        </tr>
        </table>      
    </td>
	<td>
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch35])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch36]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch37])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch38])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch39])?></td></tr>   
        <tr>
        	<td colspan="2">
            <br />เอกสารประกอบ<br />
        <?
		 $x=explode(",", $ln1[ch40]);
		 ?>
         <font style="font-size:10px;">
		<input type="checkbox"  <? if(in_array(1,$x))echo"checked";?>> MOU สองรอบประเมิน<br>
		<input type="checkbox"  <? if(in_array(2,$x))echo"checked";?>> ผลประเมินภาษาอังกฤษ<br>
 		<input type="checkbox"  <? if(in_array(3,$x))echo"checked";?>> หลักฐานพิมพ์ลายนิ้วมือ<br>
		<input type="checkbox"  <? if(in_array(4,$x))echo"checked";?>> ผลงานทางวิชาการ<br>
		<input type="checkbox"  <? if(in_array(5,$x))echo"checked";?>> คู่มือการปฏิบัติงาน<br>
        </font>
            </td>
        </tr>    
        <tr><td>ไฟล์เอกสาร</td><td><a href="file/<?=$ln1[ch41]?>" target="_blank">Download</a></td></tr> 
        <tr><td colspan="2"><br />สถานะ <br />
         <?
		 $y=explode(",", $ln1[ch42]);
		 ?> 
		<input type="checkbox" <? if(in_array(1,$y))echo"checked";?>> ส่งงานคลัง<br>
		<input type="checkbox" <? if(in_array(2,$y))echo"checked";?>> ส่งนิติกร<br>        
        </td>
        </tr>
        </table>      
    </td>
	<td>
		<!--mini-->
        <table style="font-size:12px;">
        <tr><td width="50%">วันที่ครบ</td><td><?=DateThai($ln1[ch43])?></td></tr>
        <tr><td>คำสั่งที่</td><td><?=$ln1[ch44]?></td></tr>
        <tr><td>สั่ง ณ วันที่</td><td><?=DateThai($ln1[ch45])?></td></tr>
        <tr><td>ตั้งแต่</td><td><?=DateThai($ln1[ch46])?></td></tr>
        <tr><td>สิ้นสุด</td><td><?=DateThai($ln1[ch47])?></td></tr>   
        <tr>
        	<td colspan="2">
            <br />เอกสารประกอบ<br />
        <?
		 $x=explode(",", $ln1[ch48]);
		 ?>
         <font style="font-size:10px;">
		<input type="checkbox"  <? if(in_array(1,$x))echo"checked";?>> MOU สองรอบประเมิน<br>
		<input type="checkbox"  <? if(in_array(2,$x))echo"checked";?>> ผลประเมินภาษาอังกฤษ<br>
 		<input type="checkbox"  <? if(in_array(3,$x))echo"checked";?>> หลักฐานพิมพ์ลายนิ้วมือ<br>
		<input type="checkbox"  <? if(in_array(4,$x))echo"checked";?>> ผลงานทางวิชาการ<br>
		<input type="checkbox"  <? if(in_array(5,$x))echo"checked";?>> คู่มือการปฏิบัติงาน<br>
        </font>
            </td>
        </tr>    
        <tr><td>ไฟล์เอกสาร</td><td><a href="file/<?=$ln1[ch49]?>" target="_blank">Download</a></td></tr> 
        <tr><td colspan="2"><br />สถานะ <br />
         <?
		 $y=explode(",", $ln1[ch50]);
		 ?> 
		<input type="checkbox" <? if(in_array(1,$y))echo"checked";?>> ส่งงานคลัง<br>
		<input type="checkbox" <? if(in_array(2,$y))echo"checked";?>> ส่งนิติกร<br>        
        </td>
        </tr>
        </table>     
    </td>    
</tr>
</table><br /><br />
<? }?>
</body>
</html>
