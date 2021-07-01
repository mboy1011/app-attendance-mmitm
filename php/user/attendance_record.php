<?php
require('../session.php');
if($_SESSION['utype']!=2){
    header("location: ../dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
     <!-- MCSS Offline -->
     <link rel="stylesheet" href="../../assets/css/materializecss.min.css">
    <link rel="stylesheet" href="../../assets/css/materializecss-icons.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- jQueryMaterializeCSS -->
    <link rel="stylesheet" href="../../assets/css/jq-data-material.css">
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
              <a href="#!" class="brand-logo center green-text">Attendance Record</a>
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
            <a href="#user"><img class="circle" src="../../assets/img/slogo.png"></a>
            <a href="#name"><span class="white-text name"><?PHP echo $_SESSION['name'];?></span></a>
            <a href="#email"><span class="white-text email"><?PHP echo $_SESSION['email'];?></span></a>
        </div>
        </li>
        <!-- menu navigation bar -->
        <li><a href="./user_dashboard.php" class="white-text">Dashboard <i class="small material-icons left white-text">home</i></a></li>
        <li><a href="./check_attendance.php" class="white-text">Check Attendance <i class="small material-icons left white-text">event_available</i></a></li>
        <li><a href="./class_list.php" class="white-text">Class List <i class="small material-icons left white-text">check</i></a></li>
        <li class="active"><a href="./attendance_record.php" class="white-text">Attendance Record <i class="small material-icons left white-text">grade</i></a></li>
        <li><a href="../logout.php" class="white-text">Logout<i class="small material-icons left white-text">logout</i></a></li>
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
                      <th>ID</th>
                      <th>Subject</th>
                      <th>Faculty</th>
                      <th>Date_Created</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $fid = $_SESSION['faid'];
                $result = mysqli_query($db,"select al.id as atl_id,sub.sub_name as subname,fac.name as facname,al.date_created from attendance_list as al inner join class_subject as cs on cs.id=al.class_subject_id LEFT JOIN subjects as sub on sub.id=cs.subject_id RIGHT join faculty as fac on fac.id=cs.faculty_id WHERE fac.id='$fid'");
                $i=1;
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                  <tr>
                    <td>
                      <label>
                        <input type="checkbox" class="chBx" data-id="<?PHP echo $row['atl_id']?>" />
                        <span></span>
                      </label>
                    </td>
                    <td><?PHP echo $row['atl_id'];?></td>
                    <td><?PHP echo $row['subname'];?></td>  
                    <td><?PHP echo $row['facname'];?></td>
                    <td><?PHP echo $row['date_created'];?></td>
                    <td>
                      <a class="waves-effect waves-light btn modal-trigger orange" href="#mupdate"><i class="material-icons white-text">edit</i></a>
                      <a data-position="bottom" data-tooltip="View Details" class="waves-effect waves-light btn tooltipped modal-trigger blue btn-view" href="#mview" data-id="<?PHP echo $row['atl_id'];?>" ><i class="material-icons white-text">details</i></a>
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
<!-- View Details Modal -->
  <div id="mview" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Attendance Details</h4>
      <p id="modal_details"></p>
      <div class="row">
        <table id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tbody">
                    
            </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
  <!-- MODAL END -->
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
    <script src="../../assets/js/materialize-css.min.js"></script>
    <script src="../../assets/js/axios.min.js"></script>
    <!-- jQueryMaterilizeCSS -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/jq-data-material.js"></script>
    <script type="text/javascript" charset="utf-8">
        M.AutoInit();
        const elems = document.querySelectorAll('.tooltipped');
        const instances = M.Tooltip.init(elems);
        // AXIOS AJAX
        // View Details
        let emptyTable = (e)=>{
          let tbody = document.querySelectorAll("tbody");
          if(tbody[1].rows.length>0){
              for (let o = 0; o < tbody[1].rows.length; o++) {
                tbody[1].deleteRow(o);                    
              }                     
          }
        }
        let bView = document.querySelectorAll(".btn-view");
        for (let p = 0; p < bView.length; p++) {
          bView[p].addEventListener('click',()=>{
            emptyTable();
            let tbody = document.querySelectorAll("tbody");
            if(tbody[1].rows.length>0){
                for (let o = 0; o < tbody[1].rows.length; o++) {
                  tbody[1].deleteRow(o);                    
                }                     
            }
            axios.post('../post.php',{
              req:'viewDetails',atlid:bView[p].dataset.id
            }).then((response)=>{
              let obj = response.data;
              let tb = document.querySelector("#tbody");
              for (let i= 0; i < obj.length; i++) {
                let pbtn = document.createElement('button');
                let abtn = document.createElement('button');
                let lbtn = document.createElement('button');
                let picon = document.createElement('I');
                let aicon = document.createElement('I');
                let licon = document.createElement('I');
                let ptext = document.createTextNode("check");
                let atext = document.createTextNode("close");
                let ltext = document.createTextNode("watch_later");
                picon.setAttribute('class','material-icons left')
                pbtn.setAttribute('class','btn green white-text ');
                pbtn.textContent = 'Present';
                aicon.setAttribute('class','material-icons left')
                abtn.setAttribute('class','btn red white-text ');
                abtn.textContent = 'Absent';
                licon.setAttribute('class','material-icons left')
                lbtn.setAttribute('class','btn yellow white-text ');
                lbtn.textContent = 'Late';
                tb.insertRow(i);
                tb.rows[i].insertCell(0).innerText = i+1;
                tb.rows[i].insertCell(1).innerText = obj[i].name;
                if(obj[i].stat==1){
                  tb.rows[i].insertCell(2).appendChild(pbtn).appendChild(picon).appendChild(ptext);
                }else if(obj[i].stat==2){
                  tb.rows[i].insertCell(2).appendChild(lbtn).appendChild(licon).appendChild(ltext);
                }else{
                  tb.rows[i].insertCell(2).appendChild(abtn).appendChild(aicon).appendChild(atext);
                }
                
              }
            }).catch((error)=>{
              console.log(error);
            })
          });  
        }
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
        
    </script>
</body>
</html>