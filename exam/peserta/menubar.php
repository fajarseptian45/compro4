<?php
error_reporting(E_ALL);
//session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}

if( $_SESSION['role'] === "admin" ) {
    header("location: ../pusatbahasaitech/index.php");
    exit;
}

?>
<!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) --> 
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <!-- <nav class="navbar fixed-top navbar-light bg-light"> -->
						  <a class="navbar-brand" href="home.php?token=<?= $_SESSION['token'] ?>">Home</a>
						  <a class="navbar-brand" href="profile.php?token=<?= $_SESSION['token'] ?>">Profile</a>
						  <a class="navbar-brand" href="jadwal_test.php?token=<?= $_SESSION['token'] ?>">Schedule Test</a>
						  <a class="navbar-brand" href="final_score.php?token=<?= $_SESSION['token'] ?>">Report</a>
						  <a class="navbar-brand" href="../logout.php">Logout</a>
						<!-- </nav> -->
                    </li>
              	</ul>
            </nav>
            <!-- End of Topbar -->
