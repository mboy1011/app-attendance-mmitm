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
    <title>Check Attendance</title>
     <!-- MCSS Offline -->
     <link rel="stylesheet" href="../../assets/css/materializecss.min.css">
    <link rel="stylesheet" href="../../assets/css/materializecss-icons.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
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
              <a href="#!" class="brand-logo center green-text">Check Attendance</a>
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
        <li class="active"><a href="./check_attendance.php" class="white-text">Check Attendance <i class="small material-icons left white-text">event_available</i></a></li>
        <li><a href="./class_list.php" class="white-text">Class List <i class="small material-icons left white-text">check</i></a></li>
        <li><a href="./attendance_record.php" class="white-text">Attendance Record <i class="small material-icons left white-text">grade</i></a></li>
        <li><a href="../logout.php" class="white-text">Logout<i class="small material-icons left white-text">logout</i></a></li>
    </ul>
      
  </header>
  <main>
  <div class="container">
    <div class="row">
        
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
      
        <div class="footer-copyright">
        <div class="container">
        © 2021 Bacus
       
        </div>
    </div>
    </footer>
    <!-- MCSS Offline -->
    <script src="../../assets/js/materialize-css.min.js"></script>
    <script src="../../assets/js/axios.min.js"></script>
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
        window.addEventListener('load',(event)=>{
            axios.post('../post.php',{
                req:'getSubject',fa:<?php echo $_SESSION['faid'];?>
            }).then((response)=>{
                // console.log(response.data);
                let obj = response.data;
                let sub = document.querySelector("#sub");
                sub.M_FormSelect.$selectOptions.empty();
                sub.M_FormSelect.$selectOptions.remove();
                let opt1 = document.createElement("option");
                opt1.setAttribute('disabled','');
                opt1.setAttribute('selected','');
                opt1.text = 'Choose Subject';
                opt1.value = 0;
                sub.options.add(opt1); 
                for (let i = 0; i < obj.length; i++) {
                    // console.log(obj[i].brgyDesc);
                    let opt = document.createElement("option");
                    // opt.setAttribute('selected');
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
            axios.post('../post.php',{
                req:'getStudents',cid:sub.value
            }).then((response)=>{
                let datas;
                // console.log(response.data);
                let obj = response.data;
                axios.post('../post.php',{
                    req:'checkStat',cid:obj[0].cid
                }).then((response)=>{
                    datas = response.data;
                    //
                    if(datas==1){
                        M.toast({html:'Attendance already checked!'})
                    }else{
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
                            abtn.setAttribute('checked','');
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
                        }//endfor
                    }//endif
                    // 
                }).catch((error)=>{
                    datas = error;
                });
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
            if(data.length==0){
                M.toast({html:"Select a student first before submitting!"});
            }else{
                axios.post('../post.php',{
                    req:'addAttend',data:data
                }).then((response)=>{
                    console.log(response.data);
                    let obj = response.data;
                    if(obj==1){
                        M.toast({html:"Attendance already checked!"});
                        let tb = document.querySelector("#tbody");
                        if(tb.rows.length>0){
                            document.querySelectorAll("table tbody tr").forEach(function(e){e.remove()})
                            // console.log("not empty!");
                        }
                    }else if(data.length==obj.length){
                        M.toast({html:"All students successfully attendend!"});
                        let tb = document.querySelector("#tbody");
                        if(tb.rows.length>0){
                            document.querySelectorAll("table tbody tr").forEach(function(e){e.remove()})
                            // console.log("not empty!");
                        }
                        console.log(data.length);
                        console.log(obj.length);
                    }
                }).catch((error)=>{
                    console.log(error);
                })
            }
        });
        
        function check() {
            
        }
    </script>
</body>
</html>