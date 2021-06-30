<?php
require('session.php');
if($_SESSION['utype']==2){
  header("location: ./user/check_attendance.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
              <a href="#!" class="brand-logo center green-text">SAMS</a>
              <a href="#" data-target="slide-out" class="sidenav-trigger green-text"><i class="material-icons">menu</i></a>
              <ul id="nav-mobile" class="left hide-on-med-and-down green-text">
                  <li><a href="#" id="menu" class="green-text"><i class="material-icons green-text">menu</i></a></li>
              </ul>
          </div>
        </nav>
      </div>
    <ul id="slide-out" class="sidenav collapsible sidenav-fixed green darken-2 ">
        <li>
          <div class="user-view">
            <div class="background">
              <!-- <img src="" alt="" style="width:100%;"> -->
            </div>
            <a href="#user"><img class="circle" src="../assets/img/slogo.png"></a>
            <a href="#name"><span class="white-text name"><?PHP echo $_SESSION['name'];?></span></a>
            <a href="#email"><span class="white-text email"><?PHP echo $_SESSION['email'];?></span></a>
          </div>
        </li>
        <!-- menu navigation bar -->
        <li><a href="dashboard.php" class="white-text">Dashboard <i class="small material-icons left white-text">home</i></a></li>
        <li><a href="view_course.php" class="white-text">Courses <i class="small material-icons left white-text">class</i></a></li>
        <li><a href="view_students.php" class="white-text">Students <i class="small material-icons left white-text">people_alt</i></a></li>
        <li><a href="view_subject.php" class="white-text">Subjects <i class="small material-icons left white-text">school</i></a></li>
          
        <li><a href="view_class.php" class="white-text">Class <i class="small material-icons left white-text">school</i></a></li>       
        <li><a href="view_faculty.php" class="white-text">Faculty <i class="small material-icons left white-text">assignment_ind</i></a></li>
        <li><a href="view_class_subject.php" class="white-text">Class per Subject <i class="small material-icons left white-text">school</i></a></li>
        <li><a href="view_user.php" class="white-text">Users<i class="small material-icons left white-text">school</i></a></li>
        <li><a href="attendance.php" class="white-text">Check Attendance <i class="small material-icons left white-text">event_available</i></a></li>
        <li><a href="#" class="white-text">Attendance List <i class="small material-icons left white-text">check</i></a></li>
        <li><a href="view_attendance_record.php" class="white-text">Attendance Record <i class="small material-icons left white-text">grade</i></a></li>
        <li><a href="logout.php" class="white-text">Logout<i class="small material-icons left white-text">logout</i></a></li>
    </ul>
      
  </header>
  <main>
      <div class="container">
        <div class="row">
          <div class="col s12">
            <canvas id="myChart"></canvas>
          </div>  
        </div>
      </div>
  </main>
  <footer class="page-footer">
    <div class="container">
      
        <div class="footer-copyright">
        <div class="container">
        © 2021 Bacus
       
        </div>
    </div>
    </footer>
    <!-- ChartJS -->
    <script src="../assets/js/chart.js"></script>
    <!-- MCSS Offline -->
    <script src="../assets/js/materialize-css.min.js"></script>
    <script src="../assets/js/axios.min.js"></script>
    <script>
      axios.post('post.php',{
          req:'getCSC'
      }).then((response)=>{
        let obj = response.data;
        console.log(Object.keys(obj[0]))
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: Object.keys(obj[0]),
              datasets: [{
                  label: 'Students in Courses',
                  data: Object.values(obj[0]),
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(255, 206, 86, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(255, 206, 86, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
        });
      }).catch((error)=>{
          console.log(error)
      });
    </script>
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
        
    </script>
</body>
</html>