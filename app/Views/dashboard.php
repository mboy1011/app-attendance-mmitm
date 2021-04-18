<header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper white">
              <a href="#!" class="brand-logo center green-text">Login</a>
              <a href="#" data-target="slide-out" class="sidenav-trigger green-text"><i class="material-icons">menu</i></a>
              <ul id="nav-mobile" class="left hide-on-med-and-down green-text">
                  <li><a href="#" id="menu" class="green-text"><i class="material-icons green-text">menu</i></a></li>
              </ul>
          </div>
        </nav>
      </div>
    <ul id="slide-out" class="sidenav sidenav-fixed green darken-2">
        <li>
          <div class="user-view">
            <div class="background">
              <img src="{{url_for('static',filename='assets/img/bg.jpg')}}" alt="" style="width:100%;">
            </div>
            <a href="#user"><img class="circle" src="{{ url_for('static',filename='assets/img/gcclogo.png')}}"></a>
            <a href="#name"><span class="white-text name">Admin</span></a>
            <a href="#email"><span class="white-text email">admin@gcc.com</span></a>
          </div>
        </li>
        <li class="active"><a href="/admin" class="white-text">Home <i class="material-icons right white-text">home</i></a></li>
        <li><a href="/logout" class="white-text">Logout<i class="material-icons right white-text">logout</i></a></li>
    </ul>
      
  </header>
  <main>
    <div class="container">

    </div>
  </main>
