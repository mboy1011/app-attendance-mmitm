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
              <a href="#!" class="brand-logo center green-text">Course</a>
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
              <span class="table-title">Courses</span>
              <div class="actions">
                <a class="waves-effect waves-effect btn-flat modal-trigger nopadding" id="delSub"><i class="material-icons">delete</i></a>
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
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Date_Created</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="tbody">
                <?php
                $result = mysqli_query($db,"SELECT * FROM subjects");
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
                    <td><?PHP echo $row['id']?></td>
                    <td><?PHP echo $row['sub_name']?></td>
                    <td><?PHP echo $row['description']?></td>
                    <td><?PHP echo $row['date_created']?></td>
                   
                    <td>
                    <a href="#modal-edit" class="waves-effect waves-light btn modal-trigger orange btn-up" data-id="<?PHP echo $row['id']?>" data-date="<?PHP echo $row['date_created']?>" data-sub="<?PHP echo $row['sub_name']?>" data-desc="<?PHP echo $row['description']?>"><i class="material-icons white-text">edit</i></a>

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
</div>
<!-- modal for delete -->
<div id="delMod" class="modal">
  <form action="post.php" method="post">
  <div class="modal-content">
    <h4>Delete Course</h4>
      <input type="text" name="arrData" id="arrData" hidden>
      Are you sure you want to delete the following data?
  </div>
  <div class="modal-footer">
    <button href="#!" type="submit" name="mulDelSub" class="modal-close waves-effect waves-green btn-flat">Agree</button>
  </div>
  </form>
</div>
<!-- Modal for editing course -->
<div id="modal-edit" 
                class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Edit Subject</h4>
                    <p class="center">
                    <div class="row">
                    <label>ID no:</label>
                    <input type="text" name="id" id="edit-id" disabled>
                    <label>Subject</label>
                    <input type="text" name="cname" id="edit-sub">
                    <label>Description</label>
                    <input type="text" name="cdesc" id="edit-desc">
              
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
  </div>
<!-- modal for adding course -->
<div id="demo-modal-fixed-footer" class="modal modal-fixed-footer">
      <div class="modal-content">
                    <h4>Add Subject</h4>
                    <p class="center">

          <div class="row">
              <div class="col s12" id="reg-form">
    
   
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="subject_name" type="text" class="validate" required>
                      <label for="subject_name">Subject</label>
                    </div>
                  </div>

                  <div class="row">
                      <div class="input-field col s12">
                        <input id="subject_desc" type="text" class="validate" required>
                        <label for="subject_desc">Description</label>
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
        let modal = document.querySelectorAll(".modal");
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
    let delData = [];
    let check = (e)=>{
      for (let i = 0; i < chBx.length; i++) {
        if(chBx[i].checked == true){
          delData.push(chBx[i].dataset.id);
        }          
      }
    }
    // Delete Button 
    let delSub = document.querySelector("#delSub");
    delSub.addEventListener('click',()=>{
      let deltoData = [];
      let check = (e)=>{
        for (let i = 0; i < chBx.length; i++) {
          if(chBx[i].checked == true){
            deltoData.push(chBx[i].dataset.id);
          }          
        }
      }
      check();
      modal[0].M_Modal.open();
      let arrD = document.querySelector("#arrData");
      arrD.value = JSON.stringify(deltoData);
    });
    // 
    let btn = document.querySelector("#regBtn");
        btn.addEventListener('click',()=>{
            let subject_name = document.querySelector("#subject_name");
            let subject_desc = document.querySelector("#subject_desc");
            
            if(subject_name.value!="" && subject_desc.value!=""){
                axios.post('post.php',{
                    req:'addSubject',subject_name:subject_name.value,subject_desc:subject_desc.value
                }).then((response)=>{
                    console.log(response.data);
                    if(response.data=="dup"){
                        M.toast({html:"Subject Already Exist!"});
                    }else if(response.data == "fai"){
                        M.toast({html:"Failed to register subject!"});
                    }else if(response.data=='suc'){
                        M.toast({html:"Successfully Added!"});
                        subject_name.value="";
                        subject_desc.value="";
                        let obj = response.data;
                        location.reload();
                    }
                }).catch((error)=>{
                    console.log(error)
                });
            }else{
                M.toast({html:"Empty!"});
            }
            // console.log("CLICKED");
        });




        let btnup = document.querySelectorAll(".btn-up");
   for (let i = 0; i < btnup.length; i++) {
     
       btnup[i].addEventListener('click',function(){
        
         let edit_id = document.querySelector("#edit-id");
         edit_id.value = this.dataset.id;
         let edit_sub = document.querySelector("#edit-sub");
         edit_sub.value = this.dataset.sub;
         let edit_desc = document.querySelector("#edit-desc");
         edit_desc.value = this.dataset.desc;
         
       // console.log(this.dataset.id);
     });
   }
        let upbtn = document.querySelector("#upBtn");
        upbtn.addEventListener('click',()=>{
            let id = document.querySelector("#edit-id");
            let desc = document.querySelector("#edit-desc");
            let sub = document.querySelector("#edit-sub");
            axios.post('post.php',{
                req:'updateSubject',id:id.value,sub:sub.value,desc:desc.value
            }).then((response)=>{
                console.log(response.data);
                
                    M.toast({html:"Update Successfully!"});
                    modal[0].M_Modal.close();
                
            }).catch((error)=>{
                console.log(error)
            });
            // console.log("CLICKED");
        });
        // 
        <?php
        if(isset($_SESSION['mulDelSub'])){
          echo "let arr =".$_SESSION['mulDelSub']."; M.toast({html:arr.length+' data has been deleted!'}) ";
          unset($_SESSION['mulDelSub']);
        }else if(isset($_SESSION['mulDelSub'])){
          echo "M.toast({html:'Successfully Added!'})";
          unset($_SESSION['mulDelSub']);
        }
        ?>
        // 
    </script>
</body>
</html>