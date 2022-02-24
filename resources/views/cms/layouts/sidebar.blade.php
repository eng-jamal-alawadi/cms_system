<!-- Sidebar -->
<div class="sidebar">


    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('cms/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{auth()->user()->name}}</a> --}}
          <a href="#" class="d-block">{{auth()->user()->name}} </a>
        </div>
      </div>

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
        {{-- @can('role-permissions') --}}
        @hasrole('Super-Admin')


        <li class="nav-header">Roles & Permissions </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-user-tag"></i>
              <p>
                 Roles
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                {{-- @can('role-create') --}}

              <li class="nav-item">
                <a href="{{route('roles.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li>
              {{-- @endcan --}}
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                  <p>Index</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-user-tie"></i>
              <p>
                Permissions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                {{-- @can('permission-create') --}}
              {{-- <li class="nav-item">
                <a href="{{route('permissions.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li> --}}
                {{-- @endcan --}}
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                  <p>Index</p>
                </a>
              </li>

            </ul>
          </li>
          @endhasrole

          {{-- @endcan --}}

          {{-- @can('admins-users') --}}

      @hasanyrole('Super-Admin|HR-Admin')

          @can('Read-Users')


        <li class="nav-header">Human Resources</li>
        @can('Read-Admin')
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-user-tie"></i>
              <p>
                 Admins
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Admin')
              <li class="nav-item">
                <a href="{{route('admins.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li>
                @endcan
              <li class="nav-item">
                <a href="{{route('admins.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                  <p>Index</p>
                </a>
              </li>

            </ul>
          </li>


          @endcan

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-user-tie"></i>
              <p>
                 Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-User')
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li>
                @endcan

              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                  <p>Index</p>
                </a>
              </li>

            </ul>
          </li>
            @endcan
          @endhasanyrole
          {{-- @endcan --}}



          {{-- @hasanyrole('Super-Admin|Content-Admin') --}}



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
                @can('Create-Cities')
              <li class="nav-item">
                <a href="{{route('cities.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li>
              @endcan
              @can('Read-Cities')


              <li class="nav-item">
                <a href="{{route('cities.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                  <p>Index</p>
                </a>
              </li>
                @endcan
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-layer-group"></i>
              <p>
                 Categories
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @can('Create-Categories')
              <li class="nav-item">
                <a href="{{route('categories.create')}}" class="nav-link">
                    <i class="far fa-plus-square"></i>
                  <p>create</p>
                </a>
              </li>
              @endcan
                @can('Read-Categories')
              <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="fas fa-list-ul"></i>

                  <p>Index</p>
                </a>
              </li>
                @endcan
            </ul>
          </li>
          {{-- @endcan --}}
          {{-- @endhasanyrole --}}
        <li class="nav-header">Settings</li>
        <li class="nav-item">
            <a href="{{route('edit-profile')}}" class="nav-link">
                <i class="fas fa-edit"></i>
              <p>
                 Edit Profile
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{route('change-password')}}" class="nav-link">
                <i class="fas fa-lock"></i>
              <p>
                 Change Password
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
              <p>
                 Logout
              </p>
            </a>
          </li>





      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->









