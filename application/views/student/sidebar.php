  <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/student-dashboard')?>">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

        <!--   <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/')?>">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Create Course</span>
            </a>
          </li> -->

           <li class="nav-item">
            <a class="nav-link" href="<?= $_SESSION['dash_url'].'my_course'; ?>">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">My Course</span>
            </a>
          </li>

          
          
         
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="#">Profile Setting</a></li>
              </ul>
            </div>
          </li>
        
        </ul>
      </nav>