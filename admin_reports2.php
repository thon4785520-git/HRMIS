<?php
// กำหนด Header ให้เป็น Windows-874 เพื่อรองรับภาษาไทยในระบบเดิม
header('Content-Type: text/html; charset=windows-874');
session_start();

// ตรวจสอบสถานะ Admin
if($_SESSION['ss_status'] != "admin"){
	echo "<script>location='index.php';</script>";
    exit();
}

include "config.php";

// Convert Date Logic (Thai Buddhist Year to Christian Year for DB query)
// Input format assumption: d-m-Y (Thai Year) e.g., 01-10-2566
if(isset($_POST['date1']) && isset($_POST['date2'])) {
    $d1 = explode("-", $_POST['date1']);
    $d2 = explode("-", $_POST['date2']);
    
    // Check to prevent error if date is empty
    if(count($d1) == 3 && count($d2) == 3) {
        $_POST['date1'] = ($d1[2] - 543) . "-$d1[1]-$d1[0]";
        $_POST['date2'] = ($d2[2] - 543) . "-$d2[1]-$d2[0]";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Report Result - Absent Database System</title>

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

        /* Card */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .card-header-custom {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #003399;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
        }

        /* Complex Table Styling */
        .table-report {
            font-size: 0.85rem;
        }
        .table-report thead th {
            vertical-align: middle !important;
            text-align: center;
            background-color: #e9ecef;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        .table-report tbody td {
            vertical-align: middle;
        }
        .bg-header-primary {
            background-color: #003399 !important;
            color: white !important;
        }
        .bg-header-light {
            background-color: #f8f9fa !important;
        }
        .check-icon {
            color: #28a745;
            font-size: 1.1rem;
        }
        
        @media print {
            .sidebar, .navbar, .btn-print-hide { display: none !important; }
            .col-md-9 { flex: 0 0 100%; max-width: 100%; }
            body { background-color: white; }
        }

    </style>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></head>

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
                        <a href="admin.php"><i class="fas fa-home"></i> หน้าแรก</a>
                        <a href="admin_view_staff.php"><i class="fas fa-users"></i> ข้อมูลบุคลากร</a>
                        <a href="admin_view_control.php"><i class="fas fa-file-contract"></i> ทะเบียนคุมสัญญา พม.</a>
                        <a href="admin_view_work.php"><i class="fas fa-desktop"></i> ข้อมูลการปฏิบัติงาน</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> จัดการข้อมูลการลา</a>
                        <a href="admin_report.php" class="active"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-file-alt text-secondary"></i> รายงานสรุปผลข้อมูล</h1>
                </div>

                <div class="card card-custom">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h5 class="font-weight-bold">แบบรายงานข้อมูลการมาทำงาน และการลาต่าง ๆ</h5>
                            <p class="mb-1">
                                <strong>สังกัด:</strong> 
                                <?php
                                if($_POST['DEPARTMENTID'] != 4785520){
                                    $sql="select * from department where DEPARTMENTID=" . mysql_real_escape_string($_POST['DEPARTMENTID']);
                                    $res=mysql_query($sql);
                                    $ln=mysql_fetch_array($res);
                                    echo "<span class='text-primary'>" . $ln[1] . "</span>";
                                } else {
                                    echo "<span class='text-primary'>มหาวิทยาลัยราชภัฏสงขลา</span>";
                                }
                                ?>
                            </p>
                            <p class="mb-1">
                                <strong>เรื่อง:</strong> รายงานสรุปการมาปฏิบัติราชการของข้าราชการ พนักงานมหาวิทยาลัย พนักงานราชการ ลูกจ้างประจำ และพนักงานประจำตามสัญญา
                            </p>
                            <p class="mb-1">
                                <strong>ตั้งแต่วันที่:</strong> <span class="text-info"><?php echo DateThai($_POST['date1']); ?></span> 
                                <strong>ถึง</strong> <span class="text-info"><?php echo DateThai($_POST['date2']); ?></span>
                            </p>
                            <p class="mb-0"><strong>เรียน:</strong> อธิการบดี</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-report">
                                <thead class="bg-header-light">
                                    <tr>
                                        <th rowspan="2" width="3%">ที่</th>
                                        <th rowspan="2" width="15%">ชื่อ-สกุล</th>
                                        <th colspan="6">ประเภทบุคลากร</th>
                                        <th rowspan="2" width="10%">ตำแหน่ง</th>
                                        <th rowspan="2" class="text-danger">มาสาย</th>
                                        <th colspan="2">ลากิจ</th>
                                        <th colspan="2">ลาป่วย</th>
                                        <th colspan="2">ลาพักผ่อน</th>
                                        <th rowspan="2" class="text-warning">ไม่เซ็นเข้า</th>
                                        <th rowspan="2" class="text-warning">ไม่เซ็นกลับ</th>
                                        <th colspan="2">ไปราชการ</th>
                                        <th colspan="2">ลาคลอด</th>
                                        <th colspan="2">ลาอุปสมบท</th>
                                    </tr>
                                    <tr>
                                        <th>ขร.</th>
                                        <th>พม.</th>
                                        <th>พร.</th>
                                        <th>พส.</th>
                                        <th>ลจ.</th>
                                        <th>พบ.</th>
                                        <th>ครั้ง</th>
                                        <th>วัน</th>
                                        <th>ครั้ง</th>
                                        <th>วัน</th>
                                        <th>ครั้ง</th>
                                        <th>วัน</th>
                                        <th>ครั้ง</th>
                                        <th>วัน</th>
                                        <th>ครั้ง</th>
                                        <th>วัน</th>
                                        <th>ครั้ง</th>
                                        <th>วัน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query Construction
                                    $dept_id = mysql_real_escape_string($_POST['DEPARTMENTID']);
                                    $staff_type = mysql_real_escape_string($_POST['STAFFTYPE']);
                                    $date1 = mysql_real_escape_string($_POST['date1']);
                                    $date2 = mysql_real_escape_string($_POST['date2']);

                                    if($dept_id == 4785520 && $staff_type == 0){
                                        $sql="select * from staff order by STAFFNAME";
                                    } elseif($dept_id == 4785520 && $staff_type != 0){
                                        $sql="select * from staff where STAFFTYPE=$staff_type order by DEPARTMENTID";
                                    } elseif($dept_id != 4785520 && $staff_type == 0){
                                        $sql="select * from staff where DEPARTMENTID=$dept_id order by DEPARTMENTID";
                                    } else {
                                        $sql="select * from staff where DEPARTMENTID=$dept_id and STAFFTYPE=$staff_type order by DEPARTMENTID";	
                                    }

                                    $res = mysql_query($sql);
                                    $i = 0;
                                    
                                    while($ln = mysql_fetch_array($res)){
                                        $i++;
                                        $sid = $ln['STAFFID'];
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $ln['PREFIXNAME'] . $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?></td>
                                        
                                        <!-- Staff Type Check -->
                                        <td class="text-center"><?php if($ln['STAFFTYPE']==1) echo "<i class='fas fa-check check-icon'></i>"; ?></td>
                                        <td class="text-center"><?php if($ln['STAFFTYPE']==4) echo "<i class='fas fa-check check-icon'></i>"; ?></td>
                                        <td class="text-center"><?php if($ln['STAFFTYPE']==3) echo "<i class='fas fa-check check-icon'></i>"; ?></td>
                                        <td class="text-center"><?php if($ln['STAFFTYPE']==5) echo "<i class='fas fa-check check-icon'></i>"; ?></td>
                                        <td class="text-center"><?php if($ln['STAFFTYPE']==2) echo "<i class='fas fa-check check-icon'></i>"; ?></td>
                                        <td class="text-center"><?php if($ln['STAFFTYPE']==6) echo "<i class='fas fa-check check-icon'></i>"; ?></td>
                                        
                                        <td><?php echo $ln['POSITIONNAME']; ?></td>
                                        
                                        <!-- Late -->
                                        <td class="text-center text-danger font-weight-bold">
                                            <?php
                                            $sql1="select * from work1 where STAFFID=$sid and dated between '$date1' and '$date2'";
                                            $res1=mysql_query($sql1);
                                            $late_count=0;
                                            while($ln1=mysql_fetch_array($res1)){
                                                $t=explode(":",$ln1['timein']);
                                                if(count($t)>=2){
                                                    $time_val = (float)($t[0] . "." . $t[1]);
                                                    if($time_val > 8.30) $late_count++;
                                                }
                                            }
                                            echo $late_count > 0 ? $late_count : "-";
                                            ?>
                                        </td>

                                        <!-- Personal Leave (Type 2) -->
                                        <td class="text-center">
                                            <?php
                                            $count=0; $days=0;
                                            $sql1="select * from absent where STAFFID=$sid and type=2 and date1 between '$date1' and '$date2' and approve=1";
                                            $res1=mysql_query($sql1);
                                            while($ln1=mysql_fetch_array($res1)){ $count++; $days+=$ln1['amount']; }
                                            echo $count > 0 ? $count : "-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $days > 0 ? $days : "-"; ?></td>

                                        <!-- Sick Leave (Type 1) -->
                                        <td class="text-center">
                                            <?php
                                            $count=0; $days=0;
                                            $sql1="select * from absent where STAFFID=$sid and type=1 and date1 between '$date1' and '$date2' and approve=1";
                                            $res1=mysql_query($sql1);
                                            while($ln1=mysql_fetch_array($res1)){ $count++; $days+=$ln1['amount']; }
                                            echo $count > 0 ? $count : "-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $days > 0 ? $days : "-"; ?></td>

                                        <!-- Vacation Leave (Type 3) -->
                                        <td class="text-center">
                                            <?php
                                            $count=0; $days=0;
                                            $sql1="select * from absent where STAFFID=$sid and type=3 and date1 between '$date1' and '$date2' and approve=1";
                                            $res1=mysql_query($sql1);
                                            while($ln1=mysql_fetch_array($res1)){ $count++; $days+=$ln1['amount']; }
                                            echo $count > 0 ? $count : "-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $days > 0 ? $days : "-"; ?></td>

                                        <!-- No Sign In -->
                                        <td class="text-center text-warning">
                                            <?php
                                            $sql1="select count(*) as cnt from work1 where STAFFID=$sid and dated between '$date1' and '$date2' and timein = '00:00' and timeout != '00:00' and reason = '' ";
                                            $res1=mysql_query($sql1);
                                            $ln1=mysql_fetch_array($res1);
                                            echo $ln1['cnt'] > 0 ? $ln1['cnt'] : "-";
                                            ?>
                                        </td>

                                        <!-- No Sign Out -->
                                        <td class="text-center text-warning">
                                            <?php
                                            $sql1="select count(*) as cnt from work1 where STAFFID=$sid and dated between '$date1' and '$date2' and timein > '00:00' and timeout = '00:00' and reason = '' ";
                                            $res1=mysql_query($sql1);
                                            $ln1=mysql_fetch_array($res1);
                                            echo $ln1['cnt'] > 0 ? $ln1['cnt'] : "-";
                                            ?>
                                        </td>

                                        <!-- Gov/Work Trip (Type 4) -->
                                        <td class="text-center">
                                            <?php
                                            $count=0; $days=0;
                                            $sql1="select * from absent where STAFFID=$sid and type=4 and date1 between '$date1' and '$date2' and approve=1";
                                            $res1=mysql_query($sql1);
                                            while($ln1=mysql_fetch_array($res1)){ $count++; $days+=$ln1['amount']; }
                                            echo $count > 0 ? $count : "-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $days > 0 ? $days : "-"; ?></td>

                                        <!-- Maternity Leave (Type 5) -->
                                        <td class="text-center">
                                            <?php
                                            $count=0; $days=0;
                                            $sql1="select * from absent where STAFFID=$sid and type=5 and date1 between '$date1' and '$date2' and approve=1";
                                            $res1=mysql_query($sql1);
                                            while($ln1=mysql_fetch_array($res1)){ $count++; $days+=$ln1['amount']; }
                                            echo $count > 0 ? $count : "-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $days > 0 ? $days : "-"; ?></td>

                                        <!-- Ordination Leave (Type 6) -->
                                        <td class="text-center">
                                            <?php
                                            $count=0; $days=0;
                                            $sql1="select * from absent where STAFFID=$sid and type=6 and date1 between '$date1' and '$date2' and approve=1";
                                            $res1=mysql_query($sql1);
                                            while($ln1=mysql_fetch_array($res1)){ $count++; $days+=$ln1['amount']; }
                                            echo $count > 0 ? $count : "-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $days > 0 ? $days : "-"; ?></td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-center btn-print-hide">
                            <a href="admin_report.php" class="btn btn-secondary shadow-sm">
                                <i class="fas fa-arrow-left"></i> กลับหน้าเลือกรายงาน
                            </a> 
                            <a href="doc_report1.php?date1=<?php echo $_POST['date1']; ?>&date2=<?php echo $_POST['date2']; ?>&id=<?php echo $_POST['DEPARTMENTID']; ?>&type=<?php echo $_POST['STAFFTYPE']; ?>" class="btn btn-success shadow-sm ml-2">
                                <i class="fas fa-file-word"></i> ส่งออกไฟล์ WORD
                            </a>
                            <button onClick="window.print()" class="btn btn-info shadow-sm ml-2">
                                <i class="fas fa-print"></i> พิมพ์รายงาน
                            </button>
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>
</body>
</html>