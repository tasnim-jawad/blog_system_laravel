<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info @yield('user_theme')">
            <div class="image">
                <img src="{{asset('backend')}}/images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                <div class="email">{{Auth::user()->email}}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{route('logout')}}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <i class="material-icons">input</i>Sign Out
                                </a>
                            </form>
                            {{-- <a href="{{Route('logout')}}"><i class="material-icons">input</i>Sign Out</a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                @if (Request::is('admin*'))
                    <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                        <a href="{{Route('admin.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/tag*') ? 'active' : ''}}">
                        <a href="{{Route('admin.tag.index')}}">
                            <i class="material-icons">label</i>
                            <span>Tag</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/category*') ? 'active' : ''}}">
                        <a href="{{Route('admin.category.index')}}">
                            <i class="material-icons">apps</i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/post*') ? 'active' : ''}}">
                        <a href="{{Route('admin.post.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>Post</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/pending/post') ? 'active' : ''}}">
                        <a href="{{Route('admin.post.pending')}}">
                            <i class="material-icons">pending_actions</i>
                            <span>Pending Post</span>
                        </a>
                    </li>
                    <li class="header">System</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="material-icons">input</i>
                                <span>Logout</span>
                            </a>
                        </form>
                    </li>


                @endif
                @if (Request::is('author*'))
                    <li class="{{Request::is('author/dashboard') ? 'active' : ''}}">
                        <a href="{{Route('author.dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/post*') ? 'active' : ''}}">
                        <a href="{{Route('author.post.index')}}">
                            <i class="material-icons">library_books</i>
                            <span>Post</span>
                        </a>
                    </li>
                    <li class="header">System</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="material-icons">input</i>
                                <span>Logout</span>
                            </a>
                        </form>
                    </li>

                @endif

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2023 <a href="javascript:void(0);">Muhammad Tasnimul Hasan</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
