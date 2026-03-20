<?php
// ˹ Header  Windows-874 ͧѺк
header('Content-Type: text/html; charset=windows-874');
session_start();

// Ǩͺʶҹ Admin
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
    <title>Manage Absent - Absent Database System</title>

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

        /* Cards */
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

        /* Table */
        .table thead th {
            border-top: none;
            border-bottom: 2px solid #003399;
            color: #003399;
            background-color: #f8f9fa;
            font-weight: 600;
            vertical-align: middle;
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
        
        /* Status Badges */
        .status-badge {
            display: block;
            font-size: 0.8rem;
            margin-bottom: 3px;
            text-align: left;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-badge i { width: 15px; text-align: center; margin-right: 5px; }

        /* Pagination */
        .pagination .page-link {
            color: #003399;
            border-radius: 50%;
            margin: 0 3px;
            width: 36px;
            height: 36px;
            line-height: 36px; /* ѺŢҧǵ */
            text-align: center;
            padding: 0;
            border: none;
        }
        .pagination .page-item.active .page-link {
            background-color: #003399;
            border-color: #003399;
            color: white;
        }
        .pagination .page-item:hover .page-link {
            background-color: #e9ecef;
        }
        .status-badge i { width: 20px; text-align: center; }

        .badge-soft-purple { background-color: rgba(111, 66, 193, 0.1); color: #6f42c1; }
        .badge-soft-green { background-color: rgba(40, 167, 69, 0.1); color: #28a745; }
        .badge-soft-red { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .badge-soft-blue { background-color: rgba(23, 162, 184, 0.1); color: #17a2b8; }		

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
                        <i class="fas fa-sign-out-alt"></i> ͡ҡк
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
                        <a href="admin.php"><i class="fas fa-home"></i> ˹á</a>
                        <a href="admin_view_staff.php"><i class="fas fa-users"></i> źؤҡ</a>
                        <a href="admin_view_work.php"><i class="fas fa-desktop"></i> šûԺѵԧҹ</a>
                        <a href="admin_view_absent.php"><i class="fas fa-edit"></i> Ѵâš</a>
                        <a href="admin_report.php" class="active"><i class="fas fa-chart-bar"></i> §ҹŢ</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ͡ҡк</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-desktop text-info"></i> ѵԡҹк</h1>
                </div>

                  <!-- Data Table -->
                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <i class="fas fa-list-ul"></i> ¡âšش
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Date</th>
                                        <th>IP Address</th>
                                        <th>Agent</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
<?php
$sql="select * from stories where username != '' order by id DESC";
$res=mysql_query($sql);
while($ln=mysql_fetch_array($res)){
?>								
                                <tbody>
  										<td><?=$ln['username']?></td>
  										<td><?=$ln['dated']?></td>
  										<td><?=$ln['ip']?></td>
  										<td><?=$ln['agents']?></td>
  										<td>
										<?php
										if($ln['username']!="thanapat.je")echo $ln['actions'];
										else echo "";
										?>
										</td>										
                                </tbody>
<?php }?>								
                            </table>
                        </div>
                    </div>
                    
  

                </div>

            </main>
        </div>
    </div>
</body>
</html>