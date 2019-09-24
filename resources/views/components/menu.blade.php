<div class="az-navbar">
    <div class="container">
        <div><a href="" class="az-logo">Dev<span>S</span>aaS</a></div>
        <div class="az-navbar-search">
          <input type="search" class="form-control" placeholder="Search for anything...">
          <button class="btn"><i class="fas fa-search "></i></button>
        </div><!-- az-navbar-search -->
        <ul class="nav">
          <li class="nav-label">Main Menu</li>
          <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link"><i class="typcn typcn-clipboard"></i>Dashboard</a>
          </li><!-- nav-item -->
          <li class="nav-item">
            <a href="{{ url('/form') }}" class="nav-link "><i class="typcn typcn-folder-delete"></i>List Forms</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/form/add') }}" class="nav-link "><i class="typcn typcn-edit"></i>Create New Form</a>
          </li>
        </ul><!-- nav -->
    </div><!-- container -->
</div><!-- az-navbar -->