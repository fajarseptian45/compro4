<?php
error_reporting(E_ALL);
session_start();

 
if(isset($_SESSION["login"])){
    header("location: pusatbahasaitech/index.php");
    exit;
} 

require 'functions.php';

// Fungsi untuk membuat token
function generateToken() {
    $token = bin2hex(random_bytes(32));
    return $token;
}

// Jika form login sudah disubmit
if( isset($_POST["submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tb_peserta WHERE email = '$username'");

    //cek username
    if(mysqli_num_rows($result) === 1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        //decrypt hash password
        if(password_verify($password, $row["password"])) {

            // Jika benar, buat token dan simpan ke session
            $token = generateToken();
            $_SESSION['token'] = $token;
            $_SESSION["login"] = true;
            $_SESSION["nama"] = $row["nm_user"];
            $_SESSION["iduser"] = $row["id_user"];
            $_SESSION["role"] = $row["role"];

            // Redirect ke halaman utama dengan mengirimkan token sebagai parameter GET
            if( $row["role"] === "peserta" ) {
                header("location: peserta/home.php?token=" . $token);
                exit;
            }
            elseif( $row["role"] === "admin" ) {
                header("location: pusatbahasaitech/index.php?token=" . $token);   
                exit;                
            }
            else{
                header("location: login.php");
                exit;
            }
        }
    }
   
//}
 
    // Jika token ada pada session atau parameter GET
    if (isset($_SESSION['token']) || isset($_GET['token'])) {
        // Periksa apakah token benar
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : $_GET['token'];
        if ($token !== $correct_token) {
            // Jika salah, redirect ke halaman login
            header('Location: login.php');
            exit;
        }
    } else {
        // Jika tidak ada token, redirect ke halaman login
        header('Location: login.php');
        exit;
    }
    $error = true;
}

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Pusat Bahasa Itech</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="img/itech.jpg" width="450px" height="600px"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Pusat Bahasa <br>I-Tech!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div> 
                                        </div>-->
                                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        Don't have account?
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="registrasi.php">Register here!</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>