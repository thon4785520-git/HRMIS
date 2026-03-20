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
        $db_date1 = ($d1[2] - 543) . "-$d1[1]-$d1[0]";
        $db_date2 = ($d2[2] - 543) . "-$d2[1]-$d2[0]";
    } else {
        $db_date1 = date('Y-m-d');
        $db_date2 = date('Y-m-d');
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Work Report - Absent Database System</title>

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
        
        /* Table */
        .table thead th {
            border-top: none;
            border-bottom: 2px solid #003399;
            color: #003399;
            background-color: #f8f9fa;
            font-weight: 600;
            vertical-align: middle;
            text-align: center;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f4ff;
        }
        
        @media print {
            .sidebar, .navbar, .btn-print-hide { display: none !important; }
            .col-md-9 { flex: 0 0 100%; max-width: 100%; margin-top: 0 !important; }
            body { background-color: white; padding-top: 0 !important; }
            .card-custom { box-shadow: none; }
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
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header btn-print-hide">
                    <h1 class="h2"><i class="fas fa-chart-line text-success"></i> รายงานการมาปฏิบัติงาน</h1>
                </div>

                <div class="card card-custom">
                    <div class="card-body">
                        
                        <div class="text-center mb-4">
                            <h4 class="font-weight-bold text-dark">รายงานข้อมูลการมาปฏิบัติงาน</h4>
                            <h5 class="text-muted">ระหว่างวันที่ <span class="text-primary"><?php echo isset($_POST['date1']) ? $_POST['date1'] : '-'; ?></span> ถึง <span class="text-primary"><?php echo isset($_POST['date2']) ? $_POST['date2'] : '-'; ?></span></h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="25%">ชื่อ - สกุล</th>
                                        <th width="25%">หน่วยงาน</th>
                                        <th width="15%">ประเภทบุคลากร</th>
                                        <th width="10%" class="text-success">ปกติ</th>
                                        <th width="10%" class="text-danger">สาย</th>
                                        <th width="15%" class="text-secondary">ไม่มา/ไม่เซ็น</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query Staff (Support Staff Only - Group 2)
                                    $sql = "select * from staff A, department B where A.DEPARTMENTID=B.DEPARTMENTID and A.STAFFGROUP=2 order by A.STAFFTYPE, A.DEPARTMENTID";
                                    $res = mysql_query($sql); //or die(mysql_error());
                                    
                                    if(mysql_num_rows($res) > 0) {
                                        while($ln = mysql_fetch_array($res)){
                                            $a=0; $b=0; $c=0; $d=0; $e=0;
                                            
                                            $sql1 = "select * from work1 where STAFFID=$ln[STAFFID] and dated between '$db_date1' and '$db_date2' ";
                                            $res1 = mysql_query($sql1);
                                            while($ln1 = mysql_fetch_array($res1)){
                                                // Using Timing function logic
                                                if(Timing($ln1['timein']) != 0 && Timing($ln1['timein']) < 8.31) $a++; 
                                                if(Timing($ln1['timein']) != 0 && Timing($ln1['timein']) > 8.30) $b++; 
                                                if(Timing($ln1['timein']) == 0 && Timing($ln1['timeout']) == 0) $c++; 
                                                if(Timing($ln1['timein']) == 0 && Timing($ln1['timeout']) != 0) $d++; 
                                                if(Timing($ln1['timein']) > 0 && Timing($ln1['timeout'])== 0) $e++; 
                                            }

                                            // Check Half-day leave to adjust late count
                                            $x=0; $y=0;
                                            $sql2 = "select * from absent where STAFFID=$ln[STAFFID] and date1 between '$db_date1' and '$db_date2' and amount=0.5";
                                            $res2 = mysql_query($sql2);
                                            while($ln2 = mysql_fetch_array($res2)){
                                                $y += $ln2['amount'];
                                            }
                                            // Simple logic from original code: subtract leave amount from late count? 
                                            // (Original logic: $b=$b-$y; if($b<0)$b=0; Note: $y is sum of amount (e.g. 0.5+0.5=1), $b is count of late days)
                                            // Assuming logic implies if user took half day leave, late might be excused?
                                            // Keeping original logic for consistency.
                                            $b = $b - ceil($y); 
                                            if($b < 0) $b = 0;
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold text-primary"><?php echo $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?></td>
                                        <td><?php echo $ln['DEPARTMENTNAME']; ?></td>
                                        <td>
                                            <?php
                                            $types = [
                                                1 => "ข้าราชการ",
                                                2 => "ลูกจ้างประจำ",
                                                3 => "พนักงานราชการ",
                                                4 => "พนักงานมหาวิทยาลัย",
                                                5 => "พนักงานตามสัญญา",
                                                6 => "จ้างเหมาบริการ"
                                            ];
                                            echo isset($types[$ln['STAFFTYPE']]) ? $types[$ln['STAFFTYPE']] : "-";
                                            ?>
                                        </td>
                                        <td class="text-center font-weight-bold text-success"><?php echo $a > 0 ? $a : "-"; ?></td>
                                        <td class="text-center font-weight-bold text-danger"><?php echo $b > 0 ? $b : "-"; ?></td>
                                        <td class="text-center text-muted">
                                            <?php 
                                            $miss = $c + $d + $e;
                                            echo $miss > 0 ? $miss : "-"; 
                                            ?>
                                            <?php if($d > 0) echo "<small class='d-block text-warning'>ไม่เซ็นเข้า: $d</small>"; ?>
                                            <?php if($e > 0) echo "<small class='d-block text-warning'>ไม่เซ็นกลับ: $e</small>"; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center py-4 text-muted'>ไม่พบข้อมูลบุคลากร</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-center btn-print-hide">
                            <a href="admin_report.php" class="btn btn-secondary shadow-sm">
                                <i class="fas fa-arrow-left"></i> กลับหน้าเลือกรายงาน
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