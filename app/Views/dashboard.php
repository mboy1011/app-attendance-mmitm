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
    <ul id="slide-out" class="sidenav sidenav-fixed green darken-2">
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
        <li ><a href="/admin" class="white-text">Home <i class="small material-icons right white-text">home</i></a></li>
        <li class="active"><a href="/admin" class="white-text">User <i class="small material-icons right white-text">account_box</i></a></li>
        <li><a href="/logout" class="white-text">Logout<i class="small material-icons right white-text">logout</i></a></li>
    </ul>
      
  </header>
  <main>
  <div class="container">
    <div class="row">
        <form class="col s12" id="reg-form">
        <div class="row">
            <div class="input-field col s6">
            <input id="first_name" type="text" class="validate" required>
            <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
            <input id="last_name" type="text" class="validate" required>
            <label for="last_name">Last Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="email" type="email" class="validate" required>
            <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="password" type="password" class="validate" minlength="6" required>
            <label for="password">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="password" type="password" class="validate" minlength="6" required>
            <label for="password">Password Confirm</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <button class="btn btn-large btn-register waves-effect waves-light" type="submit" name="action">Register
                <i class="material-icons right">done</i>
            </button>
            </div>
        </div>
        </form>
    </div>
    <a title="Login" class="ngl btn-floating btn-large waves-effect waves-light red"><i class="material-icons">input</i></a>
    </div>
  </main>
