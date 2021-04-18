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
    <main>
    <center>
     <div class="container">
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; solid #EEE;">
        <div class="section"></div>
    <div class="section">logo</div>
    <form action="/" method="post">
    <div class="section"><i class="mdi-alert-error red-text"></i></div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type="text" name='username' id='email' required value=""/>
                <label for='email'>Username</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col m12'>
                <input class='validate' type='password' name='password' id='password' required />
                <label for='password'>Password</label>
              </div>
              <label style='float: right;'>
              <a><b style="color: #a1a1a1;">Forgot Password?</b></a>
              </label>
            </div>
            <br/>
            <center>
              <div class='row'>
                <button style="margin-left:65px;"  type='submit' name='btn_login' class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Login</button>
              </div>
            </center>
     
        </div>
    </div>
    </form>
      </center>
    <main>
    <?php
include 'php/config.php';
include 'php/query.php';
$oop = new QUERY();
if (isset($_POST['login'])) {
        $user = mysqli_real_escape_string($db,$_POST['username']);
        $pass = mysqli_real_escape_string($db,$_POST['password']);
        $sql = $oop->login($user,$pass);
        if (!$sql) {
           ?>
              <div>
                <strong>Invalid Username and Password!</strong> Try Again.
              </div>
          <?php
        }
}
?> 
     <!-- MCSS Offline -->
    <script src="assets/js/materialize-css.min.js"></script>
    <script src="assets/js/axios.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        M.AutoInit();
        //SideNave
        let slout = document.querySelector("#slide-out");
        let men = document.querySelector("#menu");
        men.addEventListener('click',()=>{
        if(slout.M_Sidenav.isOpen == false){
            slout.M_Sidenav.open(); 
            document.getElementsByTagName('footer')[0].style.paddingLeft = "300px";
            document.getElementsByTagName('main')[0].style.paddingLeft = "300px";
            document.getElementsByTagName('header')[0].style.paddingLeft = "300px";
        }else if(slout.M_Sidenav.isOpen == true){
        slout.M_Sidenav.close();
            document.getElementsByTagName('footer')[0].style.paddingLeft = 0;
            document.getElementsByTagName('main')[0].style.paddingLeft = 0;
            document.getElementsByTagName('header')[0].style.paddingLeft = 0;
        }
        })
        //
    </script>
</body>
</html>