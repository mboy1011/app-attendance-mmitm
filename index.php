<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Management System</title>
     <!-- MCSS Offline -->
    <link rel="stylesheet" href="assets/css/materializecss.min.css">
    <link rel="stylesheet" href="assets/css/materializecss-icons.css">
     <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
    @media only screen and (max-width : 992px) {
    header, main, footer {
      padding-left: 0;
        }
    }
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        margin: 0;
        font-size: 100;
    }
    main {
        flex: 1 0 auto;
    }
    .card {
        top: 40px;
        position: relative;
        z-index: 2;
    }
    </style>
</head>
<body>
    <header></header>
    <main>
        <div class="row">
        <div class="col s12 l4 offset-l4">
            <div class="card grey lighten-3">
            <div class="card-content">
                <h4 class="card-title center-align">
                    <img class="circle green white-text" width="100" src="./assets/img/slogo.png"><br>
                </h4>
                <p class="green-text center-align" style="font-size: 18px;"><b>S</b>tudent <b>A</b>ttendance <b>M</b>anagement <b>S</b>ystem</p>
                <form action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="green-text material-icons prefix">email</i>
                        <input class='validate' type="email" name='username' id='email' required />
                        <label for='email'>Email</label>
                        <span class="helper-text" data-error="Invalid Email" data-success="Valid Email"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="green-text material-icons prefix">vpn_key</i>
                        <input class='validate' type='password' name='password' id='password' required/>
                        <label for='password'>Password</label>
                        <span class="helper-text" data-error="Empty Password" data-success=""></span>
                    </div>
                </div>
                <div class="row center-align">
                    <button class="btn-large green waves-effect waves-light" type="submit" name="login">Login
                        <i class="material-icons right">power_settings_new</i>
                    </button>
                </div>
                </form>
            </div>
            </div>
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
    include("php/config.php");
    if(isset($_POST['login'])){
        $user = mysqli_real_escape_string($db,$_POST['username']);
        $pass = mysqli_real_escape_string($db,$_POST['password']);
        require("php/query.php");
        $oop = new Query();
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