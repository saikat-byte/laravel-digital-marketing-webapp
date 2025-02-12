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
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Content</h4>
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
                                <a href="{{ route('page.index') }}">
                                    <span class="sub-item">All Pages</span>
                                </a>
                            </li>

                            {{-- Add New Page --}}
                            <li>
                                <a href="{{ route('page.create') }}">
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
                                <a href="{{ route('page.edit', $page->id) }}">
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
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-th-large"></i>
                        <p>Common section</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
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
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-th-large"></i>
                        <p>Category</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
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
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#post">
                        <i class="fas fa-edit"></i>
                        <p>Post</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="post">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('post.index') }}">
                                    <span class="sub-item">List</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('post.create') }}">
                                    <span class="sub-item">Create</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
