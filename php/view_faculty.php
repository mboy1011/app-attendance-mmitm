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
              <a href="#!" class="brand-logo center green-text">Register User</a>
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
              <span class="table-title">User Accounts</span>
              <div class="actions">
                <a class="waves-effect waves-effect btn-flat modal-trigger nopadding" id="delFac" href="#dupdate"><i class="material-icons">delete</i></a>
                <a href="#modFac" class="modal-trigger waves-effect btn-flat nopadding"><i class="material-icons">person_add</i></a>
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
                      <th>ID no.</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Address</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="tbody">
                <?php
                $result = mysqli_query($db,"SELECT * FROM faculty");
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
                    <td><?PHP echo $row['name']?></td>
                    <td><?PHP echo $row['email']?></td>
                    <td><?PHP echo $row['contact']?></td>
                    <td><?PHP echo $row['address']?></td>
                    <td>
                    <a href="#modal-edit" class="waves-effect waves-light btn modal-trigger orange btn-up" data-fn="<?PHP echo $row['name']?>" data-email="<?PHP echo $row['email']?>" data-id="<?PHP echo $row['id_no']?>" data-idno="<?PHP echo $row['id']?>" data-add="<?PHP echo $row['address']?>" data-cont="<?PHP echo $row['contact']?>" href="#mupdate"><i class="material-icons white-text">edit</i></a>
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
<!-- Modal Structure -->
  <div id="delMod" class="modal">
      <form action="post.php" method="post">
      <div class="modal-content">
        <h4>Delete Faculty</h4>
          <input type="text" name="arrData" id="arrData" hidden>
          Are you sure you want to delete the following data?
      </div>
      <div class="modal-footer">
        <button href="#!" type="submit" name="mulDel" class="modal-close waves-effect waves-green btn-flat">Agree</button>
      </div>
      </form>
    </div>
    <!-- modal for adding a faculty -->
    <div id="modFac" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Add Faculty</h4>
                    
                    
                    <div class="row">
                       <div class="col s12" id="reg-form">

                        <div class="row">
                            <div class="input-field col s6">
                            <input id="idno" type="number" class="validate" required>
                            <label for="idno">ID No.</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                            <input id="fac" type="text" class="validate" required>
                            <label for="fac">Full Name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                            <input id="em" type="email" class="validate" required>
                            <label for="em">Email</label>
                            </div>
                        </div>

                        <div class="row">
                            <b>+639</b>
                            <div class="input-field inline">
                                <input id="con" type="number" class="validate" required>
                                <label for="con">Contact No.</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                            <input id="addr" type="text">
                            <label for="addr">Address</label>
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
    </div>

<!-- Modal for editing faculty -->
    <div id="modal-edit" 
                class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Edit Faculty</h4>
                    <p class="center">
                    <div class="row">
                    <label>ID no:</label>
                    <input type="text" name="idno" id="edit-idno" disabled>
                    <label>Faculty no:</label>
                    <input type="text" name="id" id="edit-id">
                    <label>Full Name:</label>
                    <input type="text" name="fn" id="edit-fn">
                    <label>Email:</label>
                    <input type="text" name="email" id="edit-email">
                    <label>Contact:</label>
                    <input type="text" name="email" id="edit-cont">
                    <label>Address:</label>
                    <input type="text" name="add" id="edit-add">
                    
                   
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
    
    
    
    // 
    let delFac = document.querySelector("#delFac");
    delFac.addEventListener('click',()=>{
      let deltoData = [];
      let check = (e)=>{
        for (let i = 0; i < chBx.length; i++) {
          if(chBx[i].checked == true){
            deltoData.push(chBx[i].dataset.id);
          }          
        }
      }
      check();
      let delM = document.querySelector("#delMod");
      delM.M_Modal.open()
      let arrD = document.querySelector("#arrData");
      arrD.value = JSON.stringify(deltoData);
    });
    
    //modal
 


        // AXIOS AJAX
        let btn = document.querySelector("#regBtn");
        btn.addEventListener('click',()=>{
                let id = document.querySelector("#idno");
                let fac = document.querySelector("#fac");
                let em = document.querySelector("#em");
                let con = document.querySelector("#con");
                let addr = document.querySelector("#addr");
                axios.post('post.php',{
                    req:'addFaculty',id:id.value,fac:fac.value,em:em.value,con:con.value,addr:addr.value
                }).then((response)=>{
                    console.log(response.data);
                    if(response.data=="dup"){
                        M.toast({html:"Already Exist!"});
                    }else if(response.data == "fai"){
                        M.toast({html:"Failed to register course!"});
                    }else if(response.data=='suc'){
                        M.toast({html:"Successfully Added!"});
                        // course_name.value="";
                        // course_desc.value="";
                       
                    }
                }).catch((error)=>{
                    console.log(error)
                });
        });
        // 
        <?php
        if(isset($_SESSION['mulDel'])){
          echo "let arr =".$_SESSION['mulDel']."; M.toast({html:arr.length+' data has been deleted!'}) ";
          unset($_SESSION['mulDel']);
        }else if(isset($_SESSION['addFac'])){
          echo "M.toast({html:'Succesfully Added!'})";
          unset($_SESSION['addFac']);
        }
        ?>
        // 

        let btnup = document.querySelectorAll(".btn-up");
   
   for (let i = 0; i < btnup.length; i++) {
     
       btnup[i].addEventListener('click',function(){
        
         let edit_fn = document.querySelector("#edit-fn");
         edit_fn.value = this.dataset.fn;
         let edit_email = document.querySelector("#edit-email");
         edit_email.value = this.dataset.email;
         let edit_cont = document.querySelector("#edit-cont");
         edit_cont.value = this.dataset.cont;
         let edit_id = document.querySelector("#edit-id");
         edit_id.value = this.dataset.id;
         let edit_idno = document.querySelector("#edit-idno");
         edit_idno.value = this.dataset.idno;
         let edit_add = document.querySelector("#edit-add");
         edit_add.value = this.dataset.add;
       // console.log(this.dataset.id);
     });
   }


        let upbtn = document.querySelector("#upBtn");
        upbtn.addEventListener('click',()=>{
            let id = document.querySelector("#edit-id");
            let idno = document.querySelector("#edit-idno");
            let fn = document.querySelector("#edit-fn");
            let email = document.querySelector("#edit-email");
            let cont = document.querySelector("#edit-cont");
            let add = document.querySelector("#edit-add");
           


                axios.post('post.php',{
                    req:'updateFaculty',fn:fn.value,email:email.value,cont:cont.value,add:add.value,id:id.value,idno:idno.value
                }).then((response)=>{
                    console.log(response.data);
                    
                        M.toast({html:"Update Successfully!"});
                        
                        modal[0].M_Modal.close();
                    
                }).catch((error)=>{
                    console.log(error)
                });
            
            // console.log("CLICKED");
        });






    </script>
</body>
</html>