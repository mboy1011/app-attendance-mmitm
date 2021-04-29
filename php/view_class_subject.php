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
            <title>Register</title>
            <!-- MCSS Offline -->
            <link rel="stylesheet" href="../assets/css/materializecss.min.css">
            <link rel="stylesheet" href="../assets/css/materializecss-icons.css">
            <!-- Style CSS -->
            <link rel="stylesheet" href="../assets/css/style.css">
            <!-- jQueryMaterializeCSS -->
            <link rel="stylesheet" href="../assets/css/jq-data-material.css">
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
              <a href="#!" class="brand-logo center green-text">Class</a>
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
            <!-- <a href="#user"><img class="circle" src=""></a>
            <a href="#name"><span class="white-text name">Admin</span></a>
            <a href="#email"><span class="white-text email">admin@gcc.com</span></a> -->
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
  <div class="row">
      <div id="man" class="col s12">
        <div class="card material-table">
            <div class="table-header">
              <span class="table-title">Classes</span>
              <div class="actions">
                <a class="waves-effect waves-effect btn-flat modal-trigger nopadding" id="delUA" href="#dupdate"><i class="material-icons">delete</i></a>
                <a href="#demo-modal-fixed-footer" class="modal-trigger waves-effect btn-flat nopadding"><i class="material-icons">person_add</i></a>
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
        <table id="datatable" class="responsive-table">
        <thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Class</th>
									<th class="">Subject</th>
									<th class="">Faculty</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
              <?php
                 $i=1;
                $result = mysqli_query($db,"SELECT cs.*,concat(co.course,' ',c.level,'-',c.section) as `class`,s.sub_name,f.name as fname FROM class_subject cs inner join `class` c on c.id = cs.class_id inner join courses co on co.id = c.course_id inner join faculty f on f.id = cs.faculty_id inner join subjects s on s.id = cs.subject_id order by concat(co.course,' ',c.level,'-',c.section) asc");
                 while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<p> <b><?php echo $row['class'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['sub_name'] ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['fname'] ?></b></p>
									</td>
                  <td>
                      <a class="waves-effect waves-light btn modal-trigger orange" href="#mupdate"><i class="material-icons white-text">edit</i></a>
                      <a class="waves-effect waves-light btn modal-trigger red" href="#mdelete"><i class="material-icons white-text">delete</i></a>
                    </td>
								</tr>
                <?php 
                    } //end while
                ?>
							</tbody>
          </table>
          </div>
        </div>
      </div>

    

    <!-- modal for adding a class -->
    <div id="demo-modal-fixed-footer" class="modal modal-fixed-footer">
      <div class="modal-content">
                    <h4>Assign Class</h4>
                    <p class="center">
    
            <div class="row">
            <div class="col s12" id="reg-form">
                  <?php 
                    include 'config.php'; 
                    if(isset($_GET['id'])){
                    $qry = $db>query("SELECT * FROM class_subject where id= ".$_GET['id']);
                    foreach($qry->fetch_array() as $k => $val){
                      $$k=$val;
                  }
                  }
                  ?>
       
                 <div class="row">
                    <div class="input-field col s12">
                    <label for="" class="control-label">Class</label>
                    <select name="class" id="class">
                        <option value=""></option>
                        <?php
                        $class = $db->query("SELECT c.*,concat(co.course,' ',c.level,'-',c.section) as `class` FROM `class` c inner join courses co on co.id = c.course_id order by concat(co.course,' ',c.level,'-',c.section) asc");
                        while($row=$class->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($c) && $c == $row['id'] ? 'selected' : '' ?>><?php echo $row['class'] ?></option>
                        <?php endwhile; ?>
                    </select>
                   </div>
                </div>


   
                  <div class="row">
                    <div class="input-field col s12">
                    <label for="" class="control-label">Faculty</label>
                    <select name="faculty" id="faculty">
                      <option value=""></option>
                      <?php
                      $class = $db->query("SELECT * FROM faculty order by name asc");
                      while($row=$class->fetch_assoc()):
                      ?>
                      <option value="<?php echo $row['id'] ?>" <?php echo isset($f) && $f == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
                      <?php endwhile; ?>
                    </select>
                    </div>
                  </div>
     
                  <div class="row">
                    <div class="input-field col s12">
                    <label for="" class="control-label">Subject</label>
                    <select name="subject" id="subject">
                      <option value=""></option>
                      <?php
                      $class = $db->query("SELECT * FROM subjects order by sub_name asc");
                      while($row=$class->fetch_assoc()):
                      ?>
                      <option value="<?php echo $row['id'] ?>" <?php echo isset($s) && $s == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['sub_name']) ?></option>
                      <?php endwhile; ?>
                  </select>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="input-field col s12">
                
                    </div>
                  </div> 

              </div>
            </div>          
                  
            <div class="modal-footer">
                  <button id="regBtnSave" class="btn btn-small btn-register waves-effect waves-light" type="submit" name="action">Register
                    <i class="material-icons right">done</i>
                  </button>
                   <a href="#!" class="modal-action  modal-close btn red darken-1">Cancel</a>
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
    <!-- MCSS Offline -->
    <script src="../assets/js/materialize-css.min.js"></script>
    <script src="../assets/js/axios.min.js"></script>
    <!-- jQueryMaterilizeCSS -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/jq-data-material.js"></script>

    <script type="text/javascript" charset="utf-8">
        M.AutoInit();
        //SideNave
        let men = document.querySelector("#menu");
        let slout = document.querySelector("#slide-out");
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
        
        // 
        // CheckBox
    let mChBx = document.querySelector("#mChBx");
    let chBx = document.querySelectorAll(".chBx");
    mChBx.addEventListener('click',function(){
      if(mChBx.checked == true){
        for (let i = 0; i < chBx.length; i++) {
          chBx[i].checked = true;            
        }
      }else{
        for (let i = 0; i < chBx.length; i++) {
          chBx[i].checked = false;            
        }
      }
    });
    let modal = document.querySelectorAll(".modal");
    let delData = [];
    let check = (e)=>{
      for (let i = 0; i < chBx.length; i++) {
        if(chBx[i].checked == true){
          delData.push(chBx[i].dataset.id);
        }          
      }
    }
    
    let b = document.querySelector("#regBtnSave");
        b.addEventListener('click',()=>{
          let c = document.querySelector("#class");
            let f= document.querySelector("#faculty");
            let s = document.querySelector("#subject");
                  axios.post('post.php',{
                    req:'addClassSubject',c:c.value,f:f.value,s:s.value
                }).then((response)=>{
                  if(response.data=="dup"){
                      M.toast({html:"Class Assignment Already Exist!"});
                  }else if(response.data == "fai"){
                      M.toast({html:"Failed to register class assignment!"});
                  }else if(response.data=='suc'){
                      M.toast({html:"Successfully Added!"});
                      c.value="";
                        f.value="";
                        s.value="";
                       
                  }
                }).catch((error)=>{
                    console.log(error)
                });
            
            // console.log("CLICKED");
        });
    </script>
</body>
</html>