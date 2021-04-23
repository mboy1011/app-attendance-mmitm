<?php
require('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
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
        <li><a href="#" class="white-text">Courses <i class="small material-icons left white-text">class</i></a></li>
        <li>
            <div class="collapsible-header white-text"><i class="material-icons right white-text">people_alt</i>Students</div>
            <div class="collapsible-body white darken-5">
              <a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">group_add</i> Add Students</a>
              <div class="divider"></div>
              <div><a href="#" class="green-text"><i class="material-icons left green-text" style="font-size:25px; padding-left: 50px;">list</i> View Students</a></div>
              <div class="divider"></div>
            </div>
        </li>
        <li><a href="#" class="white-text">Class <i class="small material-icons left white-text">school</i></a></li>
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
        <div class="input-field col s12">
        <select id="fac" name="fac">
            <option value="" disabled selected>Choose Faculty</option>
            <?PHP
                require("config.php");
                $sql = mysqli_query($db, "SELECT * FROM faculty");
                while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
            ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            <?PHP
                }
            ?>
        </select>
        <label>Faculty</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
        <select id="sub" name="sub">
            
        </select>
        <label>Subject</label>
        </div>
    </div>
    <div class="row">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
            </tr>
        </thead>
        <!-- <input type="hidden" name="" class="pbtn abtn lbtn" data-id="n/a"> -->
        <tbody id="tbody">
                 
        </tbody>
    </table>
    </div>
    <div class="row">
    <a class="waves-effect waves-light btn" id="subtn">Submit</a>
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
                <li><a class="grey-text text-lighten-3" href="#!"></a></li>
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
        // 
        let fac = document.querySelector("#fac");
        fac.addEventListener('change',()=>{
            axios.post('post.php',{
                req:'getSubject',fa:fac.options[fac.selectedIndex].value
            }).then((response)=>{
                // console.log(response.data);
                let obj = response.data;
                let sub = document.querySelector("#sub");
                sub.M_FormSelect.$selectOptions.empty();
                sub.M_FormSelect.$selectOptions.remove();
                let opt1 = document.createElement("option");
                opt1.text = 'Choose Subject';
                opt1.value = 0;
                sub.options.add(opt1); 
                for (let i = 0; i < obj.length; i++) {
                    // console.log(obj[i].brgyDesc);
                    let opt = document.createElement("option");
                    opt.text = obj[i].sub_name;
                    opt.value = obj[i].class_id;
                    sub.options.add(opt);
                }
                // Load Form Select MaterializeCSS
                var elems = document.querySelectorAll('select');
                M.FormSelect.init(elems);
            }).catch((error)=>{
                console.log(error)
            });
        });
        // 
        
        // 
        let sub = document.querySelector("#sub");
        sub.addEventListener('change',()=>{
            let tb = document.querySelector("#tbody");
            if(tb.rows.length>0){
                document.querySelectorAll("table tbody tr").forEach(function(e){e.remove()})
                // console.log("not empty!");
            }
            // AXIOS
            axios.post('post.php',{
                req:'getStudents',cid:sub.value
            }).then((response)=>{
                console.log(response.data);
                let obj = response.data;
                for (let i = 0; i < obj.length; i++) {
                    let plb = document.createElement("label");
                    let psp = document.createElement("span");
                    let pbtn = document.createElement('input');
                    let alb = document.createElement("label");
                    let asp = document.createElement("span");
                    let abtn = document.createElement('input');
                    let llb = document.createElement("label");
                    let lsp = document.createElement("span");
                    let lbtn = document.createElement('input');

                    pbtn.setAttribute('class','pbtn');
                    abtn.setAttribute('class','abtn');
                    lbtn.setAttribute('class','lbtn');

                    pbtn.setAttribute('type','radio');
                    pbtn.setAttribute('name','group'+i);
                    abtn.setAttribute('type','radio');
                    abtn.setAttribute('name','group'+i);
                    lbtn.setAttribute('type','radio');
                    lbtn.setAttribute('name','group'+i);
                    
                    pbtn.setAttribute('data-sid',obj[i].sid);
                    pbtn.setAttribute('data-cid',obj[i].cid);
                    pbtn.setAttribute('data-ty',1);
                    abtn.setAttribute('data-sid',obj[i].sid);
                    abtn.setAttribute('data-cid',obj[i].cid);
                    abtn.setAttribute('data-ty',0);
                    lbtn.setAttribute('data-sid',obj[i].sid);
                    lbtn.setAttribute('data-cid',obj[i].cid);
                    lbtn.setAttribute('data-ty',2);
                        
                    tb.insertRow(i);
                    tb.rows[i].insertCell(0).innerText = i;
                    tb.rows[i].insertCell(1).innerText = obj[i].name;
                    tb.rows[i].insertCell(2).appendChild(plb).appendChild(pbtn).parentElement.appendChild(psp);
                    tb.rows[i].insertCell(3).appendChild(alb).appendChild(abtn).parentElement.appendChild(asp);
                    tb.rows[i].insertCell(4).appendChild(llb).appendChild(lbtn).parentElement.appendChild(lsp);
                }
            }).catch((error)=>{
                console.log(error);
            })      
        });   
        let subtn = document.querySelector("#subtn");
        subtn.addEventListener('click',()=>{
            let radbut = document.querySelectorAll("input[type='radio']");
            let data = [];
            for (let i = 0; i < radbut.length; i++) {
                if(radbut[i].checked==true){
                    data.push({
                        "class_id":radbut[i].dataset.cid,
                        "stud_id":radbut[i].dataset.sid,
                        "type":radbut[i].dataset.ty
                    });
                    // console.log("Type:"+radbut[i].dataset.ty+"|Student ID:"+radbut[i].dataset.sid);
                    console.log(data);
                }
            }
            axios.post('post.php',{
                req:'addAttend',data:data
            }).then((response)=>{
                console.log(response.data);
            }).catch((error)=>{
                console.log(error);
            })
        });
        function check() {
            // let radbut = document.querySelectorAll("input[type='radio']");
            // let data = {};
            // for (let i = 0; i < radbut.length; i++) {
            //     if(radbut[i].checked==true){
            //         data = {
            //             "class_id":radbut[i].cid,
            //             "stud_id":radbut[i].sid,
            //             "type":radbut[i].ty
            //         }
            //     }
            // }
            // console.log(data);
            // let prbtn = document.querySelectorAll(".pbtn");
            // let abbtn = document.querySelectorAll(".abtn");
            // let labtn = document.querySelectorAll(".lbtn");
            // for(i=0;i<prbtn.length;i++){
            //     prbtn[i].addEventListener('click',function(e){
                    
            //         console.log(this.dataset.cid);
            //         // inData(this.dataset.cid,this.dataset.sid,1);
            //     })
            //     abbtn[i].addEventListener('click',function(e){
            //         // this.parentElement.parentElement.remove();
            //         console.log(this.dataset.cid);
            //         // inData(this.dataset.cid,this.dataset.sid,0);
            //     })
            //     labtn[i].addEventListener('click',function(e){
            //         // this.parentElement.parentElement.remove();
            //         console.log(this.remove());
            //         // inData(this.dataset.cid,this.dataset.sid,2);
            //     })
            // }
        }
    </script>
</body>
</html>