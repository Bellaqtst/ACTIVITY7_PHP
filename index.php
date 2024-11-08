<?php 
session_start();
    $email = (isset($_POST['email'])) ? $_POST['email'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";
    $message = "";
    if($email == "rabe.arabella@mscmarinduque.edu.ph" && $password == "belle"){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $message = "<div class='alert alert-success'>Login Successfull</div>";
        echo "<script>window.location.href='./pages/dashboard.php';</script>";
        echo "<script>alert('Login Successful!');</script>";
    }elseif($email == "" && $password == ""){
        $message = "<div class='alert alert-danger'>Please enter your email and password</div>";
    }else{
        $message = "<div class='alert alert-danger'>Login Failed</div>";
        echo "<script>alert('Login Failed!');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-color: #f0f0f0;
            }
            .card {
                border-radius: 15px;
            }
            .card-header {
                background-color: #ff4d6d; /* Soft pink header */
                color: white;
            }
            .card-body {
                background-color: #ffffff;
            }
            .btn-primary {
                background-color: #ff4d6d; /* Soft pink button */
                border-color: #ff4d6d;
            }
            .btn-primary:hover {
                background-color: #e84560; /* Darker shade of pink on hover */
                border-color: #e84560;
            }
            .form-floating input {
                border-radius: 10px;
            }
            .form-check-input:checked {
                background-color: #ff4d6d;
                border-color: #ff4d6d;
            }
            .text-white {
                color: #ff4d6d !important;
            }
            .alert {
                border-radius: 10px;
            }
            .footer {
                background-color: #f8f9fa;
            }
            .show-password-btn {
                position: absolute;
                right: 10px;
                top: 10px;
                cursor: pointer;
                color: #ff4d6d;
            }
        </style>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post" onSubmit="return confirm('Are you sure you want to submit?');">
                                            <?php echo $message;?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3 position-relative">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                                <i class="fas fa-eye show-password-btn" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>

                                <table class="table table-stripped">
                                    <tr>
                                        <td><h4><b>Email:</b></h4></td>
                                        <td><h3 class="text-white"><b><?php echo $email;?></b></h3></td>
                                    </tr>
                                    <tr>
                                        <td><h4><b>Password:</b></h4></td>
                                        <td><h3 class="text-white"><b><?php echo $password;?></b></h3></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            // Toggle password visibility
            function togglePasswordVisibility() {
                var passwordField = document.getElementById('inputPassword');
                var toggleButton = document.getElementById('togglePassword');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleButton.classList.remove('fa-eye');
                    toggleButton.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    toggleButton.classList.remove('fa-eye-slash');
                    toggleButton.classList.add('fa-eye');
                }
            }
        </script>
    </body>
</html>
