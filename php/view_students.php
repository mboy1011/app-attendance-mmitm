<?php
require('session.php');
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
              <a href="#!" class="brand-logo center green-text"> Student</a>
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
            <a href="#user"><img class="circle" src=""></a>
            <a href="#name"><span class="white-text name">Admin</span></a>
            <a href="#email"><span class="white-text email">admin@gcc.com</span></a>
          </div>
        </li>
        <li><a href="dashboard.php" class="white-text">Dashboard <i class="small material-icons left white-text">home</i></a></li>
        <li><a href="view_course.php" class="white-text">Courses <i class="small material-icons left white-text">class</i></a></li>
        <li><a href="view_students.php" class="white-text">Students <i class="small material-icons left white-text">people_alt</i></a></li>
        <li><a href="view_class.php" class="white-text">Class <i class="small material-icons left white-text">school</i></a></li>
        <li><a href="view_faculty.php" class="white-text">Faculty <i class="small material-icons left white-text">assignment_ind</i></a></li>
        <li><a href="#" class="white-text">Class per Subject <i class="small material-icons left white-text">school</i></a></li>
        <li><a href="view_user.php" class="white-text">Users<i class="small material-icons left white-text">school</i></a></li>
        <li><a href="#" class="white-text">Check Attendance <i class="small material-icons left white-text">event_available</i></a></li>
        <li><a href="#" class="white-text">Attendance List <i class="small material-icons left white-text">check</i></a></li>
        <li><a href="#" class="white-text">Attendance Record <i class="small material-icons left white-text">grade</i></a></li>
        <li><a href="logout.php" class="white-text">Logout<i class="small material-icons left white-text">logout</i></a></li>
      </ul>
  </header>


  <main>
  <div class="row">
      <div id="man" class="col s12">
        <div class="card material-table">
            <div class="table-header">
              <span class="table-title">Courses</span>
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
                      <th>ID_No</th>
                      <th>Class_ID</th>
                      <th>Name</th>
                      <th>Action</th>
                      </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($db,"SELECT * FROM students");
                $i=1;
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                  <tr>
                    <td>
                      <label>
                        <input type="checkbox" class="chBx" data-id="<?PHP echo $row['id']?>" />
                        <span></span>
                      </label>
                    </td>
                    <td><?PHP echo $row['id_no']?></td>
                    <td><?PHP echo $row['class_id']?></td>
                    <td><?PHP echo $row['name']?></td>
                    <td>
                      <a class="waves-effect waves-light btn modal-trigger orange modUp" href="#mupdate" data-id="<?PHP echo $row['id_no']?>" data-cid="<?PHP echo $row['class_id']?>" data-name="<?PHP echo $row['name']?>"><i class="material-icons white-text">edit</i></a>
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
    </div>



  <div id="mupdate" class="modal">
   

    <div class="modal-content">
      <h4>Update Student</h4>
      
        <div>
            <label for="" class="control-label">ID #</label>
            <input type="text" name="id_no" id="modID"  value="" required> 
        </div> 
        
        <div>
            <label for="" class="control-label">Name</label>
            <input type="text" name="name" id="modNAME"  value="" required>
        </div>
        
        <div>
            <label for="" class="control-label">Class</label>
            <select name="class_id" id="" class="custom-select select2">
                <option value=""></option>
                <?php
                $class = $db->query("SELECT c.*,concat(co.course,' ',c.level,'-',c.section) as `class` FROM `class` c inner join courses co on co.id = c.course_id order by concat(co.course,' ',c.level,'-',c.section) asc");
                while($row=$class->fetch_assoc()):
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['class'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="input-field col s12">
                <button id="regBtn" class="btn btn-large btn-register waves-effect waves-light" type="submit" name="action">Save
                <i class="material-icons right">done</i>
                </button>
        </div>    
             
    </div>

</div>

    <div id="demo-modal-fixed-footer" class="modal modal-fixed-footer">
      <div class="modal-content">
                    <h4>Add Students</h4>
                    <p class="center">

          <div class="row">
              <div class="col s12" id="reg-form">
                
                <div class="row">
                  <div class="input-field col s12">
                  <input id="id_no" type="text" class="validate" required>
                  <label for="id_no">ID Number</label>
                  </div>
                </div>


          <div class="row">
            <div class="input-field col s12">
                <input id="name" type="text" class="validate" required>
                <label for="name">Name</label>
            </div>
          </div>
                  
          <div class="row">
            <div class="input-field col s12">
                <select name="class_id" id="class_id">
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
                
                  </div>
              </div>
      </div>
    </div>

  </div>
      <div class="modal-footer">
                    
                    <button id="regBtn" class="btn btn-small btn-register waves-effect waves-light" type="submit" name="action">Register
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
    let modUp = document.querySelectorAll(".modUp");
    for (let i = 0; i < modUp.length; i++) {
      modUp[i].addEventListener('click',(e)=>{
        let mid = document.querySelector("#modID");
        let mn = document.querySelector("#modNAME");
        // console.log(modUp[i].dataset.id);
        mid.value=modUp[i].dataset.id;
        mn.value=modUp[i].dataset.name;
      });      
    }
    // 
    // AXIOS AJAX
    let btn = document.querySelector("#regBtn");
        btn.addEventListener('click',()=>{
          
            let id_no = document.querySelector("#id_no");
            let name = document.querySelector("#name");
            let class_id = document.querySelector("#class_id");

            if(id_no.value!="" && name.value!="" && class_id.value!=""){
                axios.post('post.php',{
                    req:'addStudent',id_no:id_no[id_no.selectedIndex].value,class_id:class_id[class_id.selectedIndex].value,name:name[name.selectedIndex].value
                }).then((response)=>{
                    console.log(response.data);
                    if(response.data=="dup"){
                        M.toast({html:"Student Already Exist!"});
                    }else if(response.data == "fai"){
                        M.toast({html:"Failed to register Student!"});
                    }else if(response.data=='suc'){
                        M.toast({html:"Successfully Added!"});
                        id_no.value="";
                        class_id.value="";
                        name.value="";
                        modal[0].M_Modal.close();
                       
                    }
                }).catch((error)=>{
                    console.log(error)
                });
            }else{
                M.toast({html:"Empty!"});
            }
            // console.log("CLICKED");
        });
    
    </script>
</body>
</html>