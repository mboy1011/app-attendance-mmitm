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
    <title>Add Class</title>
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
              <a href="#!" class="brand-logo center green-text">Add Class</a>
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
              <img src="" alt="" style="width:100%;">
            </div>
            <a href="#user"><img class="circle" src="../assets/img/slogo.png"></a>
            <a href="#name"><span class="white-text name"><?PHP echo $_SESSION['name'];?></span></a>
            <a href="#email"><span class="white-text email"><?PHP echo $_SESSION['email'];?></span></a>
          </div>
        </li>
        <li><a href="dashboard.php" class="white-text">Dashboard <i class="small material-icons left white-text">home</i></a></li>
        <li>
            <div class="collapsible-header white-text"><i class="material-icons right white-text">people_alt</i>Courses</div>
            <div class="collapsible-body white darken-5">
              <a href="add_course.php" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">group_add</i> Add Course</a>
              <div class="divider"></div>
              <div><a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">list</i> View Course</a></div>
              <div class="divider"></div>
            </div>
        </li>
        <li>
            <div class="collapsible-header white-text"><i class="material-icons right white-text">people_alt</i>Students</div>
            <div class="collapsible-body white darken-5">
              <a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">group_add</i> Add Students</a>
              <div class="divider"></div>
              <div><a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">list</i> View Students</a></div>
              <div class="divider"></div>
            </div>
        </li>
        <li class="active">
            <div class="collapsible-header white-text"><i class="material-icons right white-text">people_alt</i>Class</div>
            <div class="collapsible-body white darken-5">
              <a href="add_class.php" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">group_add</i> Add Class</a>
              <div class="divider"></div>
              <div><a href="view_class.php" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">list</i> View Classes</a></div>
              <div class="divider"></div>
            </div>
        </li>
        <li>
            <div class="collapsible-header white-text"><i class="material-icons right white-text">assignment_ind</i>Faculty</div>
            <div class="collapsible-body white darken-5">
              <a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">group_add</i> Add Faculties</a>
              <div class="divider"></div>
              <div><a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">list</i> View Facultiess</a></div>
              <div class="divider"></div>
            </div>
        </li>
        <li>
            <div class="collapsible-header white-text"><i class="material-icons right white-text">badge</i>Users</div>
            <div class="collapsible-body white darken-5">
              <a href="add_user.php" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">group_add</i> Add Users</a>
              <div class="divider"></div>
              <a href="view_user.php" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">list</i> View Users</a>
              <div class="divider"></div>
            </div>
        </li>
        <li><a href="#" class="white-text">Check Attendance <i class="small material-icons left white-text">event_available</i></a></li>
        <li><a href="#" class="white-text">Attendance List <i class="small material-icons left white-text">check</i></a></li>
        <li><a href="#" class="white-text">Attendance Record <i class="small material-icons left white-text">grade</i></a></li>
        <li><a href="logout.php" class="white-text">Logout<i class="small material-icons left white-text">logout</i></a></li>
    </ul>
      
  </header>
  <main>
  <div class="container">
    
    <div class="row">
        <div class="col s12" id="reg-form">
        
        
        <div class="row">
            <div class="input-field col s6">
            <select name="class" id="class">
                    <option value="" disabled selected>Choose Class</option>
                <?php
                   require('config.php');
                  $class = $db->query("SELECT c.*,concat(co.course,' ',c.level,'-',c.section) as `class` FROM `class` c inner join courses co on co.id = c.course_id order by concat(co.course,' ',c.level,'-',c.section) asc");
                         while($row=$class->fetch_assoc()):
                ?>
                
                <option value="<?php echo $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['class'] ?></option>
                          <?php endwhile; ?>
                 </select>
            </div>
        </div>
        
          <div class="row">
            <div class="input-field col s6">
            <select name="faculty" id="faculty" class="custom-select select2">
            <option value="" disabled selected>Faculty</option>
								<?php 
								$course = $db->query("SELECT * FROM faculty order by name asc");
								while($row=$course->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
							</select>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
            <select name="subject" id="subject" class="custom-select select2">
            <option value="" disabled selected>Subjects</option>
								<?php 
								$course = $db->query("SELECT * FROM subjects order by sub_name asc");
								while($row=$course->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>"><?php echo $row['sub_name'] ?></option>
							<?php endwhile; ?>
							</select>
            </div>
        </div>

        
        
        
        <div class="row">
            <div class="input-field col s6">
            <button id="regBtn" class="btn btn-large btn-register waves-effect waves-light" type="submit" name="action">Add
                <i class="material-icons right">done</i>
            </button>
            </div>
        </div>
    </div>
    </div>
    
    </div>
  </main>
  <footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
            <h5 class="white-text">Footer Content</h5>
            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
            </div>
            <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Links</h5>
            <ul>
                <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
            </ul>
            </div>
        </div>
        </div>
        <div class="footer-copyright">
        <div class="container">
        © 2021 Bacus
        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
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
            let c = document.querySelector("#class");
            let f= document.querySelector("#faculty");
            let s = document.querySelector("#subject");
                axios.post('post.php',{
                    req:'addClassSubject',c:c.value,f:f.value,s:s.value
                }).then((response)=>{
                  if(response.data=="dup"){
                      M.toast({html:"Course Already Exist!"});
                  }else if(response.data == "fai"){
                      M.toast({html:"Failed to register course!"});
                  }else if(response.data=='suc'){
                      M.toast({html:"Successfully Added!"});
                      
                  }
                }).catch((error)=>{
                    console.log(error)
                });
            
            // console.log("CLICKED");
        });
    </script>
</body>
</html>