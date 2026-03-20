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
                        <a href="admin_view_absent.php" class="active"><i class="fas fa-edit"></i> Ѵâš</a>
                        <a href="admin_report.php"><i class="fas fa-chart-bar"></i> §ҹŢ</a>
                        <a href="logout.php" class="text-danger"><i class="fas fa-lock"></i> ͡ҡк</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 page-header">
                    <h1 class="h2"><i class="fas fa-edit text-info"></i> Ѵâš</h1>
                </div>

                <!-- Action Toolbar -->
                <div class="card card-custom mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <a href="admin_add_absent.php" class="btn btn-success shadow-sm">
                                    <i class="fas fa-plus-circle"></i> š
                                </a>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="admin_search_absent.php" class="btn btn-primary shadow-sm">
                                    <i class="fas fa-search"></i> Ңš
                                </a>
                            </div>
                        </div>
                    </div>
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
                                        <th width="20%"> - ʡ</th>
                                        <th width="20%">ǧѹ</th>
                                        <th width="15%"></th>
                                        <th width="30%">ʶҹС͹ѵ</th>
                                        <th width="15%" class="text-center">Ѵ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Pagination Logic
                                    $limit = 70;
                                    $start = isset($_GET['start']) ? $_GET['start'] : 0;
                                    
                                    // Count total rows
                                    $sql_count = "select count(*) as total from absent A, staff B where A.STAFFID=B.STAFFID";
                                    $res_count = mysql_query($sql_count);
                                    $ln_count = mysql_fetch_array($res_count);
                                    $total_rows = $ln_count['total'];

                                    // Fetch data
                                    //$sql = "select * from absent A, staff B where A.STAFFID=B.STAFFID order by date1 DESC limit $start, $limit";
									$sql="SELECT * FROM absent 
									INNER JOIN (
									SELECT * FROM staff 
									) AS s ON absent.STAFFID=s.STAFFID
									order by absent.date1 DESC limit $start, $limit  ";
                                    $res = mysql_query($sql);
                                    
                                    // Type Array
                                    $type_arr = array("","һ","ҡԨ","Ҿѡ͹","Ҫ","Ҥʹ","ػ","§ٺص","WFH","СͺԸѨ");

                                    if(mysql_num_rows($res) > 0) {
                                        while($ln = mysql_fetch_array($res)){
                                            $absent_type = isset($type_arr[$ln['type']]) ? $type_arr[$ln['type']] : "к";
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold">
                                            <?php echo $ln['PREFIXNAME'] . $ln['STAFFNAME'] . " " . $ln['STAFFSURNAME']; ?>
                                        </td>
                                        <td>
                                            <i class="far fa-calendar-alt text-muted"></i> <?php echo DateThai($ln['date1']); ?> <br>
                                            <small class="text-muted">֧</small> <?php echo DateThai($ln['date2']); ?>
                                        </td>
                                        <td><span class="badge badge-light border"><?php echo $absent_type; ?></span>
												<div class="small text-danger mt-1 font-weight-bold">(<?php echo $ln['amount']; ?> ѹ)</div>
										</td>
                                        <td>
                                           <?php
                                            // HR Advise
                                            if($ln['advise']==1) echo "<div class='status-badge badge-soft-purple'><i class='fas fa-user-tie'></i> ҹؤҡ: <span class='text-success font-weight-bold'>繤</span></div>";
                                            if($ln['advise']==2) echo "<div class='status-badge badge-soft-purple'><i class='fas fa-user-tie'></i> ҹؤҡ: <span class='text-danger font-weight-bold'>繤</span></div>";
                                            
                                            // Head Approve
                                            if($ln['approve']==1) echo "<div class='status-badge badge-soft-green'><i class='fas fa-check-circle'></i> .: <span class='font-weight-bold'>͹ѵ</span></div>";
                                            if($ln['approve']==2) echo "<div class='status-badge badge-soft-red'><i class='fas fa-times-circle'></i> .: <span class='font-weight-bold'>͹ѵ</span></div>";
                                            
                                            // Top Approve
                                            if($ln['approve1']==1) echo "<div class='status-badge badge-soft-blue'><i class='fas fa-signature'></i> .٧: <span class='font-weight-bold'>͹ѵ</span></div>";
                                            if($ln['approve1']==2) echo "<div class='status-badge badge-soft-red'><i class='fas fa-times-circle'></i> .٧: <span class='font-weight-bold'>͹ѵ</span></div>";
                                            ?>
                                        </td>
                                        <td class="text-center"> 
                                            <a href="form1.php?id=<?php echo $ln['id']; ?>" class="btn btn-info action-btn shadow-sm" title="Ẻ" target="_blank">
                                                <i class="fas fa-print" style="font-size: 0.8rem;"></i>
                                            </a>  
                                            <a href="admin_edit_absent.php?id=<?php echo base64_encode($ln['id']); ?>" class="btn btn-warning action-btn text-white shadow-sm" title="">
                                                <i class="fas fa-pencil-alt" style="font-size: 0.8rem;"></i>
                                            </a>
                                            <a href="admin_del_absent.php?id=<?php echo base64_encode($ln['id']); ?>" class="btn btn-danger action-btn shadow-sm" title="ź" onClick="return confirm('׹ѹ¡ԡšҹ?');">
                                                <i class="fas fa-times" style="font-size: 0.8rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>辺š</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Pagination Footer -->
                    <div class="card-footer bg-white">
                        <nav aria-label="Page navigation">
                            <ul class="pagination m-0" style="width:100%;overflow:scroll">
                                <?php
                                $total_pages = ceil($total_rows / $limit);
                                $current_page = ($start / $limit) + 1;
                                
                                // Previous
                                if($start > 0) {
                                    $prev_start = $start - $limit;
                                    echo "<li class='page-item'><a class='page-link' href='admin_view_absent.php?start=$prev_start'><i class='fas fa-chevron-left'></i></a></li>";
                                } else {
                                    echo "<li class='page-item disabled'><span class='page-link'><i class='fas fa-chevron-left'></i></span></li>";
                                }

                                // Pages logic (Simplified for display)
                                for($i = 0; $i < $total_rows; $i += $limit){
                                    $page_num = ($i / $limit) + 1;
                                    $active = ($start == $i) ? 'active' : '';
                                    
                                    // Show only some pages if too many (Optional simple logic: show all for now as per original code structure)
                                    echo "<li class='page-item $active'><a class='page-link' href='admin_view_absent.php?start=$i'>$page_num</a></li>";
                                }

                                // Next
                                if(($start + $limit) < $total_rows) {
                                    $next_start = $start + $limit;
                                    echo "<li class='page-item'><a class='page-link' href='admin_view_absent.php?start=$next_start'><i class='fas fa-chevron-right'></i></a></li>";
                                } else {
                                    echo "<li class='page-item disabled'><span class='page-link'><i class='fas fa-chevron-right'></i></span></li>";
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>

                </div>

            </main>
        </div>
    </div>
</body>
</html>