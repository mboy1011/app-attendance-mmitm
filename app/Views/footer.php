    <!-- MCSS Offline -->
    <script src="assets/js/materialize-css.min.js"></script>
    <script src="assets/js/axios.min.js"></script>
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
    </script>
</body>
</html>