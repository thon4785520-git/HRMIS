<?php
// กำหนด Header ให้เป็น Windows-874 เพื่อรองรับภาษาไทยในระบบเดิม
header('Content-Type: text/html; charset=windows-874');
session_start();

// ตรวจสอบสถานะ Admin
if($_SESSION['ss_status'] != "admin"){
	echo "<script>location='index.php';</script>";
    exit();
}

// เชื่อมต่อฐานข้อมูล (สมมติว่ามีการ connect ใน config.php หรือทำไว้แล้ว)
include "config.php"; 

// ฟังก์ชันแปลงวันที่หรือข้อความหากจำเป็น (Optional Helper)
function thaiDate($date){
    // ใส่ logic แปลงวันที่ถ้าจำเป็น
    return $date;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Absent Database System - Administrator</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, #003399 0%, #001f66 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff !important;
        }
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
        }
        .nav-link:hover {
            color: #fff !important;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #fff;
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            border-left: 5px solid transparent;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #f0f4ff;
            color: #003399;
            border-left-color: #003399;
        }
        .sidebar i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        .page-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #003399;
        }

        /* Form Card */
        .card-form {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border-top: 5px solid #ff9900; /* Orange Accent */
        }

        /* Dashboard Cards */
        .stat-card {
            border: none;
            border-radius: 15px;
            color: #fff;
            margin-bottom: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .card-body {
            position: relative;
            z-index: 2;
        }
        .stat-card-icon {
            position: absolute;
            right: 20px;
            bottom: 10px;
            font-size: 4rem;
            opacity: 0.3;
            z-index: 1;
        }
        
        /* Colors */
        .bg-gradient-blue {
            background: linear-gradient(45deg, #003399, #4d79ff);
        }
        .bg-gradient-green {
            background: linear-gradient(45deg, #28a745, #5dd879);
        }
        .bg-gradient-orange {
            background: linear-gradient(45deg, #fd7e14, #ffb74d);
        }
        .bg-gradient-info {
            background: linear-gradient(45deg, #17a2b8, #6edff6);
        }

        .alert-custom {
            background-color: #e8f5e9;
            border-left: 5px solid #28a745;
            color: #1b5e20;
        }

        label.error {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
            border-left: 4px solid #003399;
            padding-left: 10px;
        }
    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script> <!-- Original jQuery -->
    <!-- ถ้า jquery เก่าเกินไปสำหรับ bootstrap 4 อาจต้องใช้ CDN ด้านล่างแทน -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.validate.js"></script>

    <script>
    $(document).ready(function(){
        $("#form1").validate();
    });

    function thon(i){
        // โหลดข้อมูล Staff ลงใน div #xxx
        $('#xxx').load("get_staff1.php?id="+i, function() {
             // เพิ่ม class bootstrap ให้ select ที่โหลดมา (ถ้าทำได้)
             $('#xxx select').addClass('form-control');
        });
    }
    function xxx(txt){
        // ฟังก์ชันเดิมของคุณ
        if(document.getElementById("reason")) {
            document.getElementById("reason").value=txt;
        }
    }
    </script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <a class="navbar-brand" href="admin.php">
            <i class="fas fa-calendar-check mr-2"></i> Absent DB
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-circle"></i> <?php echo $_SESSION['ss_name']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky">
                    <div class="list-group list-group-flush">
                        <a href="admin.php" class="active"><i class="fas fa-home"></i> หน้าแรก</a>
                        <a href="admin_view_staff.php"><i class="fas fa-users"></i> ข้อมูลบุคลากร</a>
                        <a href="admin_view_control.php"><i class="fas fa-file-contract"></i> ทะเบียนคุมสัญญา พม.</a>
                        <a href="admin_view_work.php"><i class="fas fa-desktop"></i> ข้อมูลการปฏิบัติงาน</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> จัดการข้อมูลการลา</a>
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-tachometer-alt text-warning"></i> ระบบฐานข้อมูลการลา</h1>
                    <div class="text-muted">มหาวิทยาลัยราชภัฏสงขลา</div>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-custom shadow-sm" role="alert">
                    <h5 class="alert-heading"><i class="fas fa-info-circle"></i> ยินดีต้อนรับเข้าสู่ระบบ</h5>
                    <p class="mb-0">ระบบฐานข้อมูลการลา ผ่านเครือข่ายออนไลน์ พัฒนาเพื่อความสะดวก รวดเร็ว เป็นปัจจุบัน และถูกต้องตามเกณฑ์มาตรฐาน ลดความซ้ำซ้อนของเอกสาร</p>
                </div>

                <!-- Search Form -->
                <div class="card card-form">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-4"><i class="fas fa-search"></i> ค้นหาข้อมูลวันลาสะสม</h5>
                        <form method="POST" action="" id="form1">
                            <div class="form-row align-items-end">
                                <div class="col-md-5 mb-3">
                                    <label for="DEPARTMENTID">เลือกชื่อหน่วยงาน</label>
                                    <select name="DEPARTMENTID" class="form-control" onChange="thon(this.value)" required>
                                        <option value="">--- เลือกหน่วยงาน ---</option>
                                        <?php
                                        // ใช้ config.php ที่ include ด้านบน
                                        $sql_dept = "select * from department";
                                        $res_dept = mysql_query($sql_dept);
                                        while($ln_dept = mysql_fetch_array($res_dept)){
                                            $selected = (isset($_POST['DEPARTMENTID']) && $ln_dept[0] == $_POST['DEPARTMENTID']) ? 'selected' : '';
                                            echo "<option value='$ln_dept[0]' $selected>$ln_dept[1]</option>";				
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label>เลือกบุคลากร</label>
                                    <span id="xxx">
                                        <!-- พื้นที่สำหรับ AJAX Load Dropdown -->
                                        <select class="form-control" disabled>
                                            <option>กรุณาเลือกหน่วยงานก่อน</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="submit" class="btn btn-primary btn-block bg-gradient-blue border-0">
                                        <i class="fas fa-search"></i> ค้นหา
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if(isset($_POST['STAFFID']) && $_POST['STAFFID'] != ""){
                    
                    $sql = "select * from staff where STAFFID = " . mysql_real_escape_string($_POST['STAFFID']);
                    $res = mysql_query($sql);
                    $ln = mysql_fetch_array($res);
                    $STAFFTYPE = $ln['STAFFTYPE'];
                    
                    if($ln){
                ?>

                <!-- Result Section -->
                <div class="section-title">
                    ข้อมูลบุคลากร: <span class="text-primary"><?php echo $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?></span>
                </div>

                <!-- 1. การลาพักผ่อน (Fiscal Year) -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white font-weight-bold text-success">
                        <i class="fas fa-umbrella-beach"></i> สรุปวันลาพักผ่อน (ปีงบประมาณ)
                    </div>
                    <div class="card-body bg-light">
                        <?php
                        // Logic การคำนวณสิทธิ (เหมือนเดิมเป๊ะ)
                        $sith = 0;
                        // ขร.
                        if($ln['STAFFTYPE']==1){ $sith=30; }
                        // พม.
                        if($ln['STAFFTYPE']==4){
                            // Array logic เดิมที่ยาวๆ
                            $staff_ids_special = array(254,229,491,502,521,492,482,506,509,486,295,299,300,352,216,252,258,221,317,325,327,242,40158,270,301,322,339,349,40165,230,288,272,276,282,335,343,354,232,233,240,243,255,273,311,316,319,341,364,293,304,306,359,514,525,493,40130,510,40105,485,320,533,251,266,365,217,291,250,289,40169,314,498,534,500,528,496,530,517,503,513,481,490,522,532,40136,229,253,275,278,297,676,484,501,290,332,336,340,345,526,494,519,527,1645,152,508,39,523,267,318,40184,40225,40157,40167,40156,257,265,40163,40164,357,40166,346,235,259,264,268,40195,331,504,246,338,244,40252,429,342,355,40199,324,236,206,197,203,193,753,667,545,711,1648,383,40134,529,488,764,631,194,40133,1968,40131,1988,1049,2490,635,40186,685,1305,1989,2719,2621,2523,2524,2664,400,402,452,1889,1059,391,398,1619,1507,696,2329,460,1866,1054,1605,2596,415,417,1984,431,1916,1872,453,455,472,893,1968,40259,872,1983,405,1982,424,429,2007,458,471,603,1139,40194,1862,595,646,2667,194,206,193,2678,1479,3,2443,411,511,581,1961,515,577,733,468,512,770,605,689,563,617,1962);
                            
                            if(in_array($ln['STAFFID'], $staff_ids_special)){
                                $sith=30;
                            }else{
                                $sith=20;
                            }
                        }
                        // พร.
                        if($ln['STAFFTYPE']==3){ $sith=15; }
                        // พส.
                        if($ln['STAFFTYPE']==5){ $sith=10; }

                        // คำนวณวันลาที่ใช้ไป
                        $sql1="select sum(amount) from absent where STAFFID=$ln[STAFFID] and type=3 and date1 between '2025-10-1' and '2026-9-30' ";
                        $res1=mysql_query($sql1);
                        $ln1=mysql_fetch_array($res1);
                        $la_used = $ln1[0] == "" ? 0 : $ln1[0];
                        $la_remain = $sith - $la_used;
                        ?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stat-card bg-gradient-blue">
                                    <div class="card-body">
                                        <h5 class="card-title">สิทธิวันลา (ปีนี้)</h5>
                                        <h2 class="font-weight-bold"><?php echo $sith; ?> <small style="font-size: 1rem;">วัน</small></h2>
                                    </div>
                                    <i class="fas fa-check-circle stat-card-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card bg-gradient-orange">
                                    <div class="card-body">
                                        <h5 class="card-title">ใช้ไปแล้ว</h5>
                                        <h2 class="font-weight-bold"><?php echo $la_used; ?> <small style="font-size: 1rem;">วัน</small></h2>
                                    </div>
                                    <i class="fas fa-history stat-card-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card bg-gradient-green">
                                    <div class="card-body">
                                        <h5 class="card-title">คงเหลือ</h5>
                                        <h2 class="font-weight-bold"><?php echo $la_remain; ?> <small style="font-size: 1rem;">วัน</small></h2>
                                    </div>
                                    <i class="fas fa-coins stat-card-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. การลาอื่นๆ (แยกตามประเภทพนักงาน) -->
                <?php if($STAFFTYPE == 5){ // พนักงานสายวิชาการ (พส.) ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-info text-white"><i class="fas fa-briefcase"></i> ลากิจ (พส.)</div>
                            <div class="card-body text-center">
                                <?php
                                $sith_kij = 10;
                                $sql_kij = "select sum(amount) from absent where STAFFID=$ln[STAFFID] and type=2 and date1 between '2025-10-1' and '2026-9-30' ";
                                $res_kij = mysql_query($sql_kij);
                                $ln_kij = mysql_fetch_array($res_kij);
                                $used_kij = $ln_kij[0] == "" ? 0 : $ln_kij[0];
                                ?>
                                <h3 class="text-info"><?php echo $sith_kij - $used_kij; ?> <small class="text-muted">/ <?php echo $sith_kij; ?> วัน</small></h3>
                                <div class="progress mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo ($used_kij/$sith_kij)*100; ?>%"></div>
                                </div>
                                <small>คงเหลือ</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-danger text-white"><i class="fas fa-procedures"></i> ลาป่วย (พส.)</div>
                            <div class="card-body text-center">
                                <?php
                                $sith_sick = 15;
                                $sql_sick = "select sum(amount) from absent where STAFFID=$ln[STAFFID] and type=1 and date1 between '2025-10-1' and '2026-9-30' ";
                                $res_sick = mysql_query($sql_sick);
                                $ln_sick = mysql_fetch_array($res_sick);
                                $used_sick = $ln_sick[0] == "" ? 0 : $ln_sick[0];
                                ?>
                                <h3 class="text-danger"><?php echo $sith_sick - $used_sick; ?> <small class="text-muted">/ <?php echo $sith_sick; ?> วัน</small></h3>
                                <div class="progress mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo ($used_sick/$sith_sick)*100; ?>%"></div>
                                </div>
                                <small>คงเหลือ</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- 3. คิดตามรอบประเมิน -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-white font-weight-bold text-primary">
                        <i class="fas fa-clipboard-list"></i> คิดตามรอบประเมิน (ป่วย/กิจ)
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ประเภท</th>
                                        <th>สิทธิสูงสุด</th>
                                        <th>ใช้ไป (ครั้ง/วัน)</th>
                                        <th>คงเหลือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            if($STAFFTYPE==1 || $STAFFTYPE==4) echo "ป่วย/กิจ";
                                            elseif($STAFFTYPE==5 || $STAFFTYPE==3) echo "ป่วย";
                                            else echo "-";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($STAFFTYPE==1) echo "9 ครั้ง (23 วัน)";
                                            if($STAFFTYPE==4) echo "6 ครั้ง (23 วัน)";
                                            if($STAFFTYPE==5) echo "7.5 วัน";
                                            if($STAFFTYPE==3) echo "15 วัน";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $c=0; $z=0;
                                            // Logic เดิมตามประเภท
                                            if($STAFFTYPE==1 || $STAFFTYPE==4){
                                                $sql="select * from absent where STAFFID=$_POST[STAFFID] and date1 between '2025-10-1' and '2026-3-31' and type in (1,2)";
                                                $res=mysql_query($sql);
                                                while($ln_eval=mysql_fetch_array($res)){
                                                    $c++;
                                                    $z+=$ln_eval['amount'];
                                                }
                                                echo "<span class='badge badge-warning'>$c ครั้ง</span> <span class='badge badge-secondary'>$z วัน</span>";
                                            }
                                            if($STAFFTYPE==5 || $STAFFTYPE==3){
                                                $sql="select * from absent where STAFFID=$_POST[STAFFID] and date1 between '2025-10-1' and '2026-3-31' and type in (1)";
                                                $res=mysql_query($sql);
                                                while($ln_eval=mysql_fetch_array($res)){
                                                    $c++;
                                                    $z+=$ln_eval['amount'];
                                                }
                                                echo "<span class='badge badge-secondary'>$z วัน</span>";
                                            }
                                            ?>
                                        </td>
                                        <td class="font-weight-bold text-success">
                                            <?php
                                            if($STAFFTYPE==1) echo (9-$c) . " ครั้ง (" . (23-$z) . " วัน )";
                                            if($STAFFTYPE==4) echo (6-$c) . " ครั้ง (" . (23-$z) . " วัน )";
                                            if($STAFFTYPE==5) echo (7.5-$z) . " วัน";
                                            if($STAFFTYPE==3) echo (15-$z) . " วัน";
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <?php if($STAFFTYPE==3 || $STAFFTYPE==5){ 
                                        $c=0; $z=0;
                                    ?>
                                    <tr>
                                        <td>กิจ</td>
                                        <td>5 วัน</td>
                                        <td>
                                            <?php
                                            $sql="select * from absent where STAFFID=$_POST[STAFFID] and date1 between '2025-10-1' and '2026-3-31' and type in (2)";
                                            $res=mysql_query($sql);
                                            while($ln_eval=mysql_fetch_array($res)){
                                                $c++;
                                                $z+=$ln_eval['amount'];
                                            }
                                            echo "<span class='badge badge-secondary'>$z วัน</span>";
                                            ?>
                                        </td>
                                        <td class="font-weight-bold text-success"><?php echo (5-$z) . " วัน"; ?></td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php 
                    } // end if $ln
                } // end if POST
                ?>

            </main>
        </div>
    </div>
</body>
</html>