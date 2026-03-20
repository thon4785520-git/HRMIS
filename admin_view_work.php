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
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Work Attendance - Absent Database System</title>

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

        /* Custom Cards */
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card-header-custom {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #003399;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
        }
        
        /* Buttons */
        .btn-custom-group .btn {
            margin-right: 5px;
            margin-bottom: 5px;
            border-radius: 50px;
            padding-left: 20px;
            padding-right: 20px;
        }

        /* Table */
        .table thead th {
            border-top: none;
            border-bottom: 2px solid #003399;
            color: #003399;
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f4ff;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            padding: 0;
            border-radius: 50%;
            margin: 0 2px;
        }

        .stat-val {
            font-weight: 600;
            font-size: 1.1rem;
        }
        .text-late { color: #dc3545; }
        .text-normal { color: #28a745; }
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
                        <a href="admin_view_work.php" class="active"><i class="fas fa-desktop"></i> ข้อมูลการปฏิบัติงาน</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> จัดการข้อมูลการลา</a>
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> รายงานผลข้อมูล</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ออกจากระบบ</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-desktop text-primary"></i> จัดการข้อมูลการมาปฏิบัติงาน</h1>
                </div>

                <!-- Action Toolbar -->
                <div class="card card-custom mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-8 btn-custom-group">
                                <span class="text-muted mr-2 font-weight-bold">นำเข้าข้อมูล:</span>
                                <a href="XLS/1.php" class="btn btn-warning text-white shadow-sm" target="_blank">
                                    <i class="fas fa-file-excel"></i> ตรวจสอบ Excel
                                </a>  
                                <a href="XLS/" class="btn btn-info shadow-sm" target="_blank">
                                    <i class="fas fa-cloud-upload-alt"></i> นำเข้า Excel เดิม
                                </a> 
                                <a href="XLS/3.php" class="btn btn-success shadow-sm" target="_blank">
                                    <i class="fas fa-fingerprint"></i> นำเข้า Excel เครื่องสแกน
                                </a> 
                            </div>
                            <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                                <a href="admin_search_work.php" class="btn btn-primary btn-block shadow-sm">
                                    <i class="fas fa-search"></i> ค้นหาประวัติรายบุคคล
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter & Results -->
                <div class="row">
                    <!-- Date Selection Filter -->
                    <div class="col-md-4">
                        <div class="card card-custom">
                            <div class="card-header card-header-custom">
                                <i class="fas fa-calendar-alt"></i> เลือกวันที่ต้องการดู
                            </div>
                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="dated" class="font-weight-bold">วันที่:</label>
                                        <input type="date" name="dated" id="dated" class="form-control" required value="<?php echo isset($_POST['dated']) ? $_POST['dated'] : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block shadow-sm">
                                        <i class="fas fa-eye"></i> แสดงข้อมูล
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Result Table -->
                    <div class="col-md-8">
                        <div class="card card-custom">
                            <div class="card-header card-header-custom">
                                <i class="fas fa-list-alt"></i> สรุปข้อมูลการปฏิบัติงาน
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>วันที่</th>
                                                <th class="text-center text-success">ปกติ</th>
                                                <th class="text-center text-danger">สาย</th>
                                                <th class="text-center">ขาด/ไม่เซ็น</th>
                                                <th class="text-center">ไม่เซ็นเข้า</th>
                                                <th class="text-center">ไม่เซ็นออก</th>
                                                <th class="text-center">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(isset($_POST['dated']) && $_POST['dated'] != "") {
                                                $selected_date = mysql_real_escape_string($_POST['dated']);
                                                // Query หลัก
                                                $sql="select distinct dated from work1 where dated='$selected_date' order by dated DESC";
                                                $res=mysql_query($sql); //or die(mysql_error());
                                                
                                                if(mysql_num_rows($res) > 0) {
                                                    while($ln=mysql_fetch_array($res)){
                                                        // Calculate Stats
                                                        $sql1="select * from work1 where dated = '$ln[dated]' ";
                                                        $res1=mysql_query($sql1);
                                                        $y1=0; // ปกติ
                                                        $y2=0; // สาย
                                                        $y3=0; // ไม่เซ็นชื่อ
                                                        $y4=0; // ไม่เซ็นเข้า
                                                        $y5=0; // ไม่เซ็นออก
                                                        
                                                        while($ln1=mysql_fetch_array($res1)){
                                                            if(Timing($ln1['timein']) != 0 && Timing($ln1['timein']) < 8.31) $y1++;
                                                            if(Timing($ln1['timein']) != 0 && Timing($ln1['timein']) > 8.30) $y2++;
                                                            if(Timing($ln1['timein']) == 0 && Timing($ln1['timeout']) == 0) $y3++;
                                                            if(Timing($ln1['timein']) == 0 && Timing($ln1['timeout']) != 0) $y4++;
                                                            if(Timing($ln1['timein']) > 0 && Timing($ln1['timeout'])== 0) $y5++;
                                                        }
                                            ?>
                                            <tr>
                                                <td class="font-weight-bold"><?php echo DateThai($ln['dated']); ?></td>
                                                <td class="text-center"><span class="stat-val text-success"><?php echo $y1; ?></span></td>
                                                <td class="text-center"><span class="stat-val text-late"><?php echo $y2; ?></span></td>
                                                <td class="text-center"><span class="stat-val text-muted"><?php echo $y3; ?></span></td>
                                                <td class="text-center"><span class="stat-val text-warning"><?php echo $y4; ?></span></td>
                                                <td class="text-center"><span class="stat-val text-warning"><?php echo $y5; ?></span></td>
                                                <td class="text-center">   
                                                    <a href="admin_show_works.php?id=<?php echo $ln['dated']; ?>" class="btn btn-success action-btn shadow-sm" title="สายวิชาการ" target="_blank">
                                                        <i class="fas fa-chalkboard-teacher" style="font-size: 0.8rem;"></i>
                                                    </a> 
                                                    <a href="admin_show_work.php?id=<?php echo $ln['dated']; ?>" class="btn btn-info action-btn shadow-sm" title="สายสนับสนุน" target="_blank">
                                                        <i class="fas fa-user-cog" style="font-size: 0.8rem;"></i>
                                                    </a>
                                                    <a href="admin_edit_work.php?id=<?php echo $ln['dated']; ?>" class="btn btn-warning action-btn text-white shadow-sm" title="แก้ไข" target="_blank">
                                                        <i class="fas fa-pencil-alt" style="font-size: 0.8rem;"></i>
                                                    </a>
                                                    <a href="admin_del_work.php?id=<?php echo $ln['dated']; ?>" class="btn btn-danger action-btn shadow-sm" title="ลบ" onClick="return confirm('ยืนยันการลบข้อมูลวันที่นี้? การกระทำนี้ไม่สามารถย้อนกลับได้');">
                                                        <i class="fas fa-times" style="font-size: 0.8rem;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7' class='text-center py-4 text-muted'>ไม่พบข้อมูลการปฏิบัติงานในวันที่เลือก</td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7' class='text-center py-5 text-muted'><i class='fas fa-arrow-left fa-2x mb-2'></i><br>กรุณาเลือกวันที่ทางด้านซ้ายเพื่อแสดงข้อมูล</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>
</html>