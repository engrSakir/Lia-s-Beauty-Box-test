<div class="scroll-sidebar">
    <!-- User Profile-->
    <div class="user-profile">
        <div class="user-pro-body">
            <div><img src="{{ asset(auth()->user()->image ?? 'uploads/images/no_image.png') }}" alt="user-img" class="img-circle"></div>
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ auth()->user()->name }} <span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <!-- text-->
                    <a href="{{route('backend.profile')}}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="javascript:void(0)" class="dropdown-item logout-btn"><i class="fas fa-power-off"></i> Logout</a>
                    <!-- text-->
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li class="nav-small-cap">--- MENU ITEMS</li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('backend.invoice.index') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">Invoice</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('backend.appointment.index') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">Appointment</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('backend.schedule.index') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">Schedule</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('backend.setting') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">Setting</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('backend.user.index') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">User</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="{{ route('backend.client.index') }}" aria-expanded="false">
                    <i class="far fa-circle text-danger"></i>
                    <span class="hide-menu">Client</span>
                </a>
            </li>

            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Gallery</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('backend.gallery.index') }}">Gallery List</a></li>
                    <li><a href="{{ route('backend.imageCategory.index') }}">Image Category</a></li>
                </ul>
            </li>
            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Services</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('backend.service.index') }}">Service List </a></li>
                    <li><a href="{{ route('backend.serviceCategory.index') }}">Service Category List </a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
