<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <!-- MCSS Offline -->
     <link rel="stylesheet" href="assets/css/materializecss.min.css">
    <link rel="stylesheet" href="assets/css/materializecss-icons.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <header></header>
   <main>
        <div class="container">
            <div class="z-depth-2 y-depth-2 x-depth-2 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; solid #EEE;">
                <div class="section"></div>
                <div class="section">Logo</div>
                <div class="section"><i class="mdi-alert-error red-text"></i></div>
                <form action="" method="post">
                <div class='row'>
                <div class='input-field col s12'>
                    <i class="material-icons prefix">email</i>
                    <input class='validate' type="email" name='username' id='email' required />
                    <label for='email'>Username</label>
                    <span class="helper-text" data-error="Invalid Email" data-success="Valid Email"></span>
                </div>
                </div>
                <div class='row'>
                    <div class='input-field col m12'>
                        <i class="material-icons prefix">lock</i>
                        <input class='validate' type='password' name='password' id='password' required/>
                        <label for='password'>Password</label>
                        <span class="helper-text" data-error="Empty Password" data-success=""></span>
                    </div>
                    <label style='float: right;'>
                        <a><b style="color: #a1a1a1;">Forgot Password?</b></a>
                    </label>
                </div>
                <br/>
                <center>
                <div class='row'>
                    <button style="margin-left:65px;"  type='submit' name='login' class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Login</button>
                </div>
                </center>
                </form>
            </div>
        </div>
    </main>
    <footer></footer>
     <!-- MCSS Offline -->
    <script src="assets/js/materialize-css.min.js"></script>
    <script src="assets/js/axios.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        M.AutoInit();
    <?php
    include("php\config.php");
    include("php\query.php");
    $oop = new Query();
    if(isset($_POST['login'])){
        $user = mysqli_real_escape_string($db,$_POST['username']);
        $pass = mysqli_real_escape_string($db,$_POST['password']);
        $sql = $oop->login($user,$pass);
        if(!$sql){
            echo "M.toast({html:'Invalid Username & Password!'});";
        }
    }
    ?>
        //SideNave
        //
    </script>

</body>
</html>