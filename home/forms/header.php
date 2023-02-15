<?php 
 session_start();

 error_reporting(1);
 
 if(isset($_SESSION["userName"]))
 {
?>

<?php
session_start();
include "../private/verAndApprFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $pageTitle?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/dashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/dashboard/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/dashboard/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
  #sidebar-nav{
    background-color:green;
  }
  li a.nav-link.collapsed{
    background-color:green;
  }

</style>

<body style="min-height:100vh; display:flex; flex-direction:column;">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo2.jpg" alt="">
        <span class="d-none d-lg-block">NGL</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <!-- <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form> -->
    </div><!-- End Search Bar -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <i class="bi bi-person-circle" style="font-size:30px;"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION["userName"];?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$_SESSION["fullName"];?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" style="background-color:green;">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" id="collapsed"data-bs-target="#verify-nav" data-bs-toggle="collapse" href="#" >
          <i class="bi bi-pen-fill"></i><span>Verification &#38; Approval</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="verify-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../verification/pendingVerification">
              <i class="bi bi-circle"></i><span>Verification<?php getAllPendingVerifications($totalPendVer); ?></span>
            </a>
          </li>
          <li>
            <a href="../approval/pendingApproval">
              <i class="bi bi-circle"></i><span>Approval<?php getAllPendingApprovals($totalPendAppr); ?></span>
            </a>
          </li>
        </ul>
      </li><!-- End verify Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-house"></i><span>Processing</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../inventory/Goods_Received_Note">
              <i class="bi bi-circle"></i><span>Receive Goods</span>
            </a>
          </li>
          <li>
            <a href="../processing/batchProcessingOrder">
              <i class="bi bi-circle"></i><span>Batch Processing Order</span>
            </a>
          </li>
          <li>
            <a href="../processing/BatchOrderSelection">
              <i class="bi bi-circle"></i><span>Batch Report</span>
            </a>
          </li>
          <li>
            <a href="../inventory/transfer">
              <i class="bi bi-circle"></i><span>Transfer</span>
            </a>
          </li>
          <li>
            <a href="../processing/drying">
              <i class="bi bi-circle"></i><span>Drying</span>
            </a>
          </li>
          <li>
            <a href="../processing/hulling">
              <i class="bi bi-circle"></i><span>Hulling</span>
            </a>
          </li>
          <li>
            <a href="../inventory/release">
              <i class="bi bi-circle"></i><span>Release Request</span>
            </a>
          </li>
        </ul>
      </li><!-- End Processing Nav  -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-coin"></i><span>Marketing</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../marketing/valuation">
              <i class="bi bi-circle"></i><span>Valuation</span>
            </a>
          </li>
          <li>
            <a href="../marketing/SalesReport">
              <i class="bi bi-circle"></i><span>Sales Report</span>
            </a>
          </li>
          <li>
            <a href="../inventory/release">
              <i class="bi bi-circle"></i><span>Release Request</span>
            </a>
          </li>
        </ul>
      </li><!-- End Marketing Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-brightness-high-fill"></i><span>Roast  &#38; Ground</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../inventory/Goods_Received_Note">
              <i class="bi bi-circle"></i><span>Receive Goods</span>
            </a>
          </li>
          <li>
            <a href="../forms/activtySheet">
              <i class="bi bi-circle"></i><span>Services</span>
            </a>
          </li>
          <li>
            <a href="../forms/activtySheet">
              <i class="bi bi-circle"></i><span>Release Request</span>
            </a>
          </li>
        </ul>
      </li><!-- End Roast and Ground Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#quality-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-brightness-alt-high"></i><span>Quality</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="quality-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../quality/preoffloadingSample">
              <i class="bi bi-circle"></i><span>Pre Offloading Sample</span>
            </a>
          </li>
          <li>
            <a href="../quality/qualityAssessment">
              <i class="bi bi-circle"></i><span>General Sample</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Quality Assessment</span>
            </a>
          </li>
        </ul>
      </li><!-- End Quality activity Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart-fill"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../inventory/Goods_Received_Note">
              <i class="bi bi-circle"></i><span>Receive Goods</span>
            </a>
          </li>
          <li>
            <a href="../inventory/bulking">
              <i class="bi bi-circle"></i><span>Bulking</span>
            </a>
          </li>
          <li>
            <a href="../inventory/transfer">
              <i class="bi bi-circle"></i><span>Transfer</span>
            </a>
          </li>
          <li>
            <a href="../inventory/pendingDispatch">
              <i class="bi bi-circle"></i><span>Dispatch</span>
            </a>
          </li>
          <li>
            <a href="../inventory/adjustment">
              <i class="bi bi-circle"></i><span>Adjustment</span>
            </a>
          </li>
          <li>
            <a href="../inventory/stkCountCustomer">
              <i class="bi bi-circle"></i><span>Stock Count</span>
            </a>
          </li>
          <li>
            <a href="../inventory/release">
              <i class="bi bi-circle"></i><span>Release Request</span>
            </a>
          </li>
        </ul>
      </li><!-- End Inventory Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#admin-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-briefcase-fill"></i><span>Administration</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../forms/pettyCash">
              <i class="bi bi-circle"></i><span>Petty Cash Request</span>
            </a>
          </li>
          <li>
            <a href="../forms/fundsRequisition">
              <i class="bi bi-circle"></i><span>Funds Requisition</span>
            </a>
          </li>
        </ul>
      </li><!-- End Administration Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#member-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-plus-fill"></i><span>Membership &#38; Production</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="member-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../forms/newClient">
              <i class="bi bi-circle"></i><span>Add New Client</span>
            </a>
          </li>
        </ul>
      </li><!-- End Membership Nav -->
      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Reports &#38; Analytics</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <!-- <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tran-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bank"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tran-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../transactions/grnList">
              <i class="bi bi-circle"></i><span>Goods Received</span>
            </a>
          </li>
          <li>
            <a href="../reports/stockTransactions">
              <i class="bi bi-circle"></i><span>Batch Reports</span>
            </a>
          </li>
        </ul>
      </li><!-- End Transaction Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#stock-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-arrow-down-fill"></i><span>Stock Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="stock-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../reports/stockBalances">
              <i class="bi bi-circle"></i><span>Stock Balances</span>
            </a>
          </li>
          <li>
            <a href="../reports/stockTransactions">
              <i class="bi bi-circle"></i><span>Stock Transactions</span>
            </a>
          </li>
        </ul>
      </li><!-- End Stock Nav -->
      <?php if(isset($_SESSION["Access"]))
             {
              if($_SESSION["Access"]==1)
              {
                ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#adduser-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-plus-fill"></i><span>Add New User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="adduser-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../forms/signup">
              <i class="bi bi-circle"></i><span>Create New User</span>
            </a>
          </li>
          <li>
          </li>
        </ul>
      </li><!-- End User Addition Nav -->
      <?php
              }
             }
          ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#inventadd-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart"></i><span>Add New Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="inventadd-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../inventory/NewItem">
              <i class="bi bi-circle"></i><span>Add New Item</span>
            </a>
          </li>
          <li>
          </li>
        </ul>
      </li><!-- End Inventory Addition Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#gensettings-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>General Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="gensettings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="../settings/exchangeRate">
              <i class="bi bi-circle"></i><span>Exchange Rate</span>
            </a>
          </li>
          <li>
          </li>
        </ul>
      </li><!-- End General Settings Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
  
<?php
}else{
  include "redirect.php";
 }
 ?>
            
