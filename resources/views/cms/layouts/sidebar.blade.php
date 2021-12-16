<!-- Sidebar -->
<div class="sidebar">




    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->


             <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-header">Content Management</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-map-marker-alt"></i>
              <p>
                 Cities
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{route('cities.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cities.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                  <p>Index</p>
                </a>
              </li>

            </ul>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
