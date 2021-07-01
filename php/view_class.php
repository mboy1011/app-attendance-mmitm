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
          
        <li class="active"><a href="view_class.php" class="white-text">Class <i class="small material-icons left white-text">school</i></a></li>       
        <li><a href="view_faculty.php" class="white-text">Faculty <i class="small material-icons left white-text">assignment_ind</i></a></li>
        <li><a href="view_class_subject.php" class="white-text">Class per Subject <i class="small material-icons left white-text">school</i></a></li>
        <li><a href="view_user.php" class="white-text">Users<i class="small material-icons left white-text">school</i></a></li>
        <li><a href="attendance.php" class="white-text">Check Attendance <i class="small material-icons left white-text">event_available</i></a></li>
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
                      <th>
                        <label>
                          <input type="checkbox" id="mChBx" />
                          <span>Select All</span>
                        </label>
                      </th>
                      <th>ID</th>
                      <th>Class</th>
                      <th>Action</th>
                      
                  </tr>
              </thead>
              <tbody>
              <?php 
								$i = 1;
                $cname;
								$class = $db->query("SELECT c.*,concat(co.course,' ',c.level,'-',c.section) as `class`,co.id as `courseID`FROM `class` c inner join courses co on co.id = c.course_id order by concat(co.course,' ',c.level,'-',c.section) asc");
								while($row=$class->fetch_assoc()):
                  

								?>
                  <tr>
                    <td>
                      <label>
                        <input type="checkbox" class="chBx" data-id="<?PHP echo $row['id']?>" />
                        <span></span>
                      </label>
                    </td>
                   <td class="text-center"><?php echo $row['id'] ?></td>
									  <td class=""><p><b><?php echo $row['class'] ?></b></p>
								  </td>
                  
                    <td>
                      <a href="#modal-edit" class="waves-effect waves-light btn modal-trigger orange btn-up" data-courseid="<?PHP echo $row['courseID']?>" data-hid="<?PHP echo $row['courseID']?>" data-level="<?PHP echo $row['level']?>" data-sect="<?PHP echo $row['section']?>" data-id="<?PHP echo $row['id']?>"><i class="material-icons white-text">edit</i></a>
                      <!-- <a class="waves-effect waves-light btn modal-trigger red" href="#mdelete"><i class="material-icons white-text">delete</i></a> -->
                    </td>
                  </tr>
                  
                  <?php
               
                endwhile; ?>
              </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>


    <!-- modal for adding a class -->
    <div id="demo-modal-fixed-footer" class="modal modal-fixed-footer">
      <div class="modal-content">
                    <h4>Add Class</h4>
                    <p class="center">
    
            <div class="row">
            <div class="col s12" id="reg-form">
       
       
                 <div class="row">
                    <div class="input-field col s12">
                       <select name="course_id" id="course_id" class="custom-select select2">
                          <option value="" disabled selected>Course</option>
							            	<?php 
                            $course = $db->query("SELECT * FROM courses order by course asc");
                            while($row=$course->fetch_assoc()):
                            ?>
								          <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?></option>
						            	<?php endwhile; ?>
							          </select>
                    </div>
                  </div>

   
                  <div class="row">
                    <div class="input-field col s12">
                      <select name="year" id="year" class="custom-select select2">
                         <option value="" disabled selected>Year</option>
							
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
						
							        </select>
                    </div>
                  </div>
     
                  <div class="row">
                    <div class="input-field col s12">
                      <select name="section" id="section" class="custom-select select2">
                        <option value="" disabled selected>Section</option>
                
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="D">E</option>
			                </select>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="input-field col s12">
                
                    </div>
                  </div> 

              </div>
            </div>          
    </div>
    <div class="modal-footer">
      <button id="regBtn" class="btn btn-small btn-register waves-effect waves-light" type="submit" name="action">Register
        <i class="material-icons right">done</i>
      </button>
      <a href="#!" class="modal-action  modal-close btn red darken-1">Cancel</a>
    </div>
  </div>
    

    <!-- Modal for editing class -->
    <div id="modal-edit" 
                class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Edit Class</h4>
                    <p class="center">
                    <div class="row">
                    <label>ID no:</label>
                    <input type="text" name="id" id="edit-id" disabled>
                    <label>Course:</label>
                    <div class="input-field col s12">
                    <select name="edit-course" id="edit-course">
                    <?PHP 
                    $sql = $db->query("SELECT * FROM `courses`");
                    while($row=$sql->fetch_assoc()):
                    ?>
                      <option value="<?PHP echo $row['id'];?>"><?PHP echo $row['course'];?></option>
                    <?PHP endwhile;?>
                    </select>
                    </div>
                    <div class="input-field col s12">
                    <select name="edit-level" id="edit-level" class="custom-select select2">
                        <option value="" disabled selected>Section</option>
                
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                        
			                </select>
                   </div>
                    <div class="input-field col s12">
                    <select name="edit-sect" id="edit-sect" class="custom-select select2">
                        <option value="" disabled selected>Section</option>
                
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="D">E</option>
			                </select>
                   </div>
                   
                    </div>
                </div>
                <div class="modal-footer">
                    
                <button id="upBtn" class="btn btn-small btn-register waves-effect waves-light" type="submit" name="action">Save Changes
                <i class="material-icons right">done</i>
            </button>
                    <a href="#!" class="modal-action 
                        modal-close btn red darken-1">
                        Cancel
                    </a>
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
    
    let btn = document.querySelector("#regBtn");
        btn.addEventListener('click',()=>{
            let id = document.querySelector("#course_id");
            let yr = document.querySelector("#year");
            let sec = document.querySelector("#section");
                axios.post('post.php',{
                    req:'addClass',id:id.value,yr:yr.value,sec:sec.value
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

        let btnup = document.querySelectorAll(".btn-up");
        let edit_course = document.querySelector("#edit-course");
        let edit_id = document.querySelector("#edit-id");
   for (let i = 0; i < btnup.length; i++) {
     
       btnup[i].addEventListener('click',function(){
        
         
         edit_id.value = this.dataset.id;
         
         console.log(this.dataset.courseid);
         for (let o = 0; o < edit_course.length; o++) {
           if(edit_course[o].value == this.dataset.courseid){console.log('this is'+o); 
              edit_course.selectedIndex=o;
              M.FormSelect.init(edit_course);  
              break;
           }
          }
        //  edit_course.value = this.dataset.courseID;
         let edit_level = document.querySelector("#edit-level");
         edit_level.value = this.dataset.level;
         let edit_sect = document.querySelector("#edit-sect");
         edit_sect.value = this.dataset.sect;
       // console.log(this.dataset.id);
     });
   }

   let upbtn = document.querySelector("#upBtn");
   upbtn.addEventListener('click',()=>{
            let id = document.querySelector("#edit-id");
            let course = document.querySelector("#edit-course");
            let level = document.querySelector("#edit-level");
            let sect = document.querySelector("#edit-sect");
                axios.post('post.php',{
                    req:'updateClass',id:id.value,course:course.value,level:level.value,sect:sect.value
                }).then((response)=>{
                    console.log(response.data);
                    let obj = response.data;
                    if(obj=='suc'){
                      location.reload();
                    }else{
                      location.reload();
                    }
                        
                    modal[0].M_Modal.close();
                    
                }).catch((error)=>{
                    console.log(error)
                });
            
            // console.log("CLICKED");
        });



    </script>
</body>
</html>