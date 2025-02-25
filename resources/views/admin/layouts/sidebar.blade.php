<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/admin/img/cloudspace/cloudspace.jpg') }}" alt="navbar brand" class="navbar-brand img-fluid" height="40" width="200" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <!-- Dashboard:for all user -->
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(auth()->user()->isAdmin())
                {{-- content --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Content</h4>
                </li>
                {{-- Header & Footer management --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#header_footer">
                        <i class="fas fa-hand-point-right"></i>
                        <p>Header & Footer</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="header_footer">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('header_footer.index') }}" class="nav-link {{ request()->routeIs('header_footer.index') ? 'active' : '' }}">
                                    <span class="sub-item">Update Header & Footer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Pages Management Section --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesDropdown">
                        <i class="fas fa-file-alt"></i>
                        <p>Pages Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="pagesDropdown">
                        <ul class="nav nav-collapse">
                            {{-- All Pages with their Sections --}}
                            <li>
                                <a href="{{ route('page.index') }}" class="nav-link {{ request()->routeIs('page.index') ? 'active' : '' }}">
                                    <span class="sub-item">All Pages</span>
                                </a>
                            </li>

                            {{-- Add New Page --}}
                            <li>
                                <a href="{{ route('page.create') }}" class="nav-link {{ request()->routeIs('page.create') ? 'active' : '' }}">
                                    <span class="sub-item">Add New Page</span>
                                </a>
                            </li>

                            {{-- Individual Pages for Quick Access --}}
                            <li style="padding-left: 20px;">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Quick Access</h4>
                            </li>

                            @foreach(App\Models\Page::where('status', 1)->get() as $page)
                            <li>
                                <a href="{{ route('page.edit', $page->id) }}" class="nav-link {{ request()->routeIs('page.edit', $page->id) ? 'active' : '' }}">
                                    <span class="sub-item">
                                        <i class="fas fa-angle-right"></i>
                                        {{ ucfirst($page->name) }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @endif
                @if(auth()->user()->isAdmin() || auth()->user()->isModerator())
                {{-- Manage SEO --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#seo_manage">
                        <i class="fas fa-search"></i>
                        <p>Manage SEO</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="seo_manage">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('seo.index') }}">
                                    <span class="sub-item">Seo List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('post.seo.index') }}">
                                    <span class="sub-item">Post Seo List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @if(auth()->user()->isAdmin())
                {{-- Common section --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#common_section">
                        <i class="fas fa-puzzle-piece"></i>
                        <p>Common section</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="common_section">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('common.section.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('common.section.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- reviews --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#reviews">
                        <i class="fas fa-star"></i>
                        <p>Reviews</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="reviews">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('reviews.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('reviews.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Post --}}
                @endif
                @if(auth()->user()->isAdmin() || auth()->user()->isModerator())
                {{-- Post --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#post" class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }}">
                        <i class="fas fa-edit"></i>
                        <p>Post</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="post">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('post.index') }}" class="nav-link {{ request()->routeIs('post.index') ? 'active' : '' }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('post.create') }}" class="nav-link {{ request()->routeIs('post.create') ? 'active' : '' }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- category --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#category">
                        <i class="fas fa-th-large"></i>
                        <p>Category</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('category.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('category.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- sub category --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base2">
                        <i class="fas fa-th"></i>
                        <p>Sub category</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base2">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('sub-category.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sub-category.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Tags --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base3">
                        <i class="fas fa-tag"></i>
                        <p>Tag</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base3">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('tag.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tag.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @if(auth()->user()->isAdmin())
                {{-- Comments --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#comment">
                        <i class="fas fa-comment"></i>
                        <p>Comments</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="comment">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.comments.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Appointments --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#appointment">
                        <i class="fas fa-calendar-check"></i>
                        <p>Appointments</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="appointment">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.appointments.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.holidays.index') }}">
                                    <span class="sub-item">Holidays</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- User list --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#users">
                        <i class="fas fa-user"></i>
                        <p>Users list</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.users.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Subscribers --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#subscribers">
                        <i class="fas fa-user-check"></i>
                        <p>Subscribers</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="subscribers">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.subscribers.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.edit.showPdf') }}">
                                    <span class="sub-item">Pdf file update</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Leads --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#leads">
                        <i class="fas fa-handshake"></i>
                        <p>CRM Leads</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="leads">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.leads') }}">
                                    <span class="sub-item">Leads list</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>
