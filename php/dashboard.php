<?php
// require('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <!-- MCSS Offline -->
     <link rel="stylesheet" href="../assets/css/materializecss.min.css">
    <link rel="stylesheet" href="../assets/css/materializecss-icons.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <style>
         #mapid { height: 180px; }
      header, main, footer {
        padding-left: 300px;
      }

      @media only screen and (max-width : 1024px) {
        header, main, footer {
          padding-left: 0;
        }
      }
     </style>
</head>
<body>
<header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper white">
              <a href="#!" class="brand-logo center green-text">Register</a>
              <a href="#" data-target="slide-out" class="sidenav-trigger green-text"><i class="material-icons">menu</i></a>
              <ul id="nav-mobile" class="left hide-on-med-and-down green-text">
                  <li><a href="#" id="menu" class="green-text"><i class="material-icons green-text">menu</i></a></li>
              </ul>
          </div>
        </nav>
      </div>
    <ul id="slide-out" class="sidenav sidenav-fixed green darken-2">
        <li>
          <div class="user-view">
            <div class="background">
              <img src="" alt="" style="width:100%;">
            </div>
            <a href="#user"><img class="circle" src=""></a>
            <a href="#name"><span class="white-text name">Admin</span></a>
            <a href="#email"><span class="white-text email">admin@gcc.com</span></a>
          </div>
        </li>
        <li ><a href="/admin" class="white-text">Home <i class="small material-icons right white-text">home</i></a></li>
        <li class="active"><a href="/admin" class="white-text">User <i class="small material-icons right white-text">account_box</i></a></li>
        <li><a href="/logout" class="white-text">Logout<i class="small material-icons right white-text">logout</i></a></li>
    </ul>
      
  </header>
  <main>
  <div class="container">
    <div class="row"></div>
    <div class="row">
        <div class="col s12" id="reg-form">
        <div class="row">
            <div class="input-field col s6">
            <input id="first_name" type="text" class="validate" required>
            <label for="first_name">First Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="email" type="email" class="validate" required>
            <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="password" type="password" class="validate" minlength="6" required>
            <label for="password">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="password-conf" type="password" class="validate" minlength="6" required>
            <label for="password-conf">Password Confirm</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <button id="regBtn" class="btn btn-large btn-register waves-effect waves-light" type="submit" name="action">Register
                <i class="material-icons right">done</i>
            </button>
            </div>
        </div>
    </div>
    </div>
    
    </div>
  </main>
    <footer>

    </footer>
    <!-- MCSS Offline -->
    <script src="../assets/js/materialize-css.min.js"></script>
    <script src="../assets/js/axios.min.js"></script>
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
        // AXIOS AJAX
        let btn = document.querySelector("#regBtn");
        btn.addEventListener('click',()=>{
            let nm = document.querySelector("#first_name");
            let un = document.querySelector("#email");
            let pw = document.querySelector("#password");
            let pwc = document.querySelector("#password-conf");
            if(pw.value==pwc.value){
                axios.post('post.php',{
                    req:'addUser',nm:nm.value,un:un.value,pw:pw.value
                }).then((response)=>{
                    if(response.data=="exists"){
                        M.toast({html:"Email Already Exist"})
                        nm.value="";
                        un.value="";
                        pw.value="";
                        pwc.value="";
                    }
                }).catch((error)=>{
                    console.log(error)
                });
            }else{
                M.toast({html:"Password doesn't matched!"});
            }
            // console.log("CLICKED");
        });
    </script>
</body>
</html>