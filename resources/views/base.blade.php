<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Devi Eye Hospital - Order Management System">
    <meta name="keyword" content="Devi Eye Hospital - Order Management System">
    <title>Devi Eye Hospital - Order Management</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    
    
    <!-- project layout css file -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/css/al.style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.q.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
       
</head>

<body>

<div id="layout-q" class="theme-green">

    <!-- Navigation -->
    <div class="top-header">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="/dash" class="logo d-flex align-items-center me-md-4 me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" viewBox="0 0 64 80" fill="none">
                        <path d="M58.8996 22.7L26.9996 2.2C23.4996 -0.0999999 18.9996 0 15.5996 2.5C12.1996 5 10.6996 9.2 11.7996 13.3L15.7996 26.8L3.49962 39.9C-3.30038 47.7 3.79962 54.5 3.89962 54.6L3.99962 54.7L36.3996 78.5C36.4996 78.6 36.5996 78.6 36.6996 78.7C37.8996 79.2 39.1996 79.4 40.3996 79.4C42.9996 79.4 45.4996 78.4 47.4996 76.4C50.2996 73.5 51.1996 69.4 49.6996 65.6L45.1996 51.8L58.9996 39.4C61.7996 37.5 63.3996 34.4 63.3996 31.1C63.4996 27.7 61.7996 24.5 58.8996 22.7ZM46.7996 66.7V66.8C48.0996 69.9 46.8996 72.7 45.2996 74.3C43.7996 75.9 41.0996 77.1 37.9996 76L5.89961 52.3C5.29961 51.7 1.09962 47.3 5.79962 42L16.8996 30.1L23.4996 52.1C24.3996 55.2 26.5996 57.7 29.5996 58.8C30.7996 59.2 31.9996 59.5 33.1996 59.5C35.0996 59.5 36.9996 58.9 38.6996 57.8C38.7996 57.8 38.7996 57.7 38.8996 57.7L42.7996 54.2L46.7996 66.7ZM57.2996 36.9C57.1996 36.9 57.1996 37 57.0996 37L44.0996 48.7L36.4996 25.5V25.4C35.1996 22.2 32.3996 20 28.9996 19.3C25.5996 18.7 22.1996 19.8 19.8996 22.3L18.2996 24L14.7996 12.3C13.8996 8.9 15.4996 6.2 17.3996 4.8C18.4996 4 19.8996 3.4 21.4996 3.4C22.6996 3.4 23.9996 3.7 25.2996 4.6L57.1996 25.1C59.1996 26.4 60.2996 28.6 60.2996 30.9C60.3996 33.4 59.2996 35.6 57.2996 36.9Z" fill="black"/>
                    </svg>
                    <span class="fs-4 fw-bold ms-2">DEVI</span>
                </a>
                <div class="d-flex">
                    <div class="dropdown notifications">
                        <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                        </a>
                        <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                            <div class="card border-0 w380">
                                <div class="card-header border-0 p-3">
                                    <h5 class="mb-0 fw-light d-flex justify-content-between">
                                        <span>Notifications Center</span>
                                        <span class="badge text-muted">0</span>
                                    </h5>
                                </div>
                                <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown mx-lg-3 mx-1">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle after-none" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/images/profile_av.png') }}" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <div class="card border-0 w240">
                                <div class="card-body border-bottom">
                                    <div class="d-flex">
                                        <img class="avatar rounded-circle" src="{{ asset('assets/images/profile_av.png') }}" alt="">
                                        <div class="flex-fill ms-3">
                                            <p class="mb-0"><span class="fw-bold">{{ Auth::user()->name }}</span></p>
                                            <small class="text-muted">{{ Auth::user()->roles->pluck('name')->implode(',') }}</small>
                                            <a href="/logout" class="d-block">Sign out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="nav-link" href="#" title="Settings" data-bs-toggle="modal" data-bs-target="#SettingsModal"><i class="fa fa-gear"></i></a>
                    <a class="nav-link pe-0 d-block d-xl-none menu-toggle" href="#" title=""><i class="fa fa-navicon"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar shadow-sm sticky-xl-top">
        <div class="container">
            <ul class="menu-list">
                <li><a class="m-link active" href="/dash"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="collapsed">
                    <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Pages" href="#"><i class="fa fa-file"></i> <span>Order</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Pages">
                        <li><a class="ms-link" href="/order">Order Management</a></li>
                        <li><a class="ms-link" href="/order/payment">Payment</a></li>
                        <li><a class="ms-link" href="/invoice">Invoice</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Pages" href="#"><i class="fa fa-user"></i> <span>User</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Pages">
                        <li><a class="ms-link" href="/user">User Management</a></li>
                        <li><a class="ms-link" href="/role">Roles & Permissions</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-briefcase"></i> <span>Administration</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/branch">Branch Management</a></li>
                        <li><a class="ms-link" href="/iehead">Income & Expense Heads</a></li>
                        <li><a class="ms-link" href="/ie">Income & Expense Management</a></li>
                        <li><a class="ms-link" href="/supplier">Supplier Management</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-cubes"></i> <span>Inventory</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/category">Category Management</a></li>
                        <li><a class="ms-link" href="/subcategory">Subcategory Management</a></li>
                        <li><a class="ms-link" href="/product">Product Management</a></li>                        
                        <li><a class="ms-link" href="/stockin">Stock Add</a></li>
                        <li><a class="ms-link" href="/stockout">Stock Transfer</a></li>
                        <li><a class="ms-link" href="/stockinhand">Stock In Hand</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-search"></i> <span>Stock Tracking</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/stock/tracking/material">Add Material</a></li>
                        <li><a class="ms-link" href="/stock/tracking/coating">Add Coating</a></li>
                        <li><a class="ms-link" href="/stock/tracking/type">Add Type</a></li>
                        <li><a class="ms-link" href="/stock/tracking/list">Product List</a></li>
                        <li><a class="ms-link" href="/stock/tracking/product">Add Product</a></li>
                        <li><a class="ms-link" href="/stock/tracking/track">Track Product</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-asterisk"></i> <span>Extras</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/dash">Extra</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-wrench"></i> <span>Settings</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/dash">Mobile Access</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-gift"></i> <span>Offers</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/dash">Offers</a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href="#"><i class="fa fa-files-o"></i> <span>Reports</span> <span class="arrow fa fa-plus ms-auto text-end"></span></a>

                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse" id="menu-Authentication">
                        <li><a class="ms-link" href="/dash">Reports</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- main body area -->
    <div class="main px-lg-5 px-md-2">

        @yield("content")

        <!-- Body: Footer -->
        <div class="body-footer px-xl-4 px-md-2">
            <div class="container">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <p class="font-size-sm mb-0">© Devi. <span class="d-none d-sm-inline-block"><script>document.write(/\d{4}/.exec(Date())[0])</script> Devi Eye Hospitals.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal: Setting -->
    <div class="modal fade" id="SettingsModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">AL-UI Setting</h5>
                    </div>
                    <div class="modal-body custom_scroll">
                    <!-- Settings: Font -->
                    <div class="setting-font">
                        <small class="card-title text-muted">Google font Settings</small>
                        <ul class="list-group font_setting mb-3 mt-1">
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-opensans" value="font-opensans" checked="">
                                    <label class="form-check-label" for="font-opensans">
                                        Open Sans Google Font
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-quicksand" value="font-quicksand">
                                    <label class="form-check-label" for="font-quicksand">
                                        Quicksand Google Font
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-nunito" value="font-nunito">
                                    <label class="form-check-label" for="font-nunito">
                                        Nunito Google Font
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-Raleway" value="font-raleway">
                                    <label class="form-check-label" for="font-Raleway">
                                        Raleway Google Font
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Settings: Color -->
                    <div class="setting-theme">
                        <small class="card-title text-muted">Theme Color Settings</small>
                        <ul class="list-unstyled d-flex justify-content-between choose-skin mb-2 mt-1">
                            <li data-theme="indigo"><div class="indigo"></div></li>
                            <li data-theme="blue"><div class="blue"></div></li>
                            <li data-theme="cyan"><div class="cyan"></div></li>
                            <li data-theme="green" class="active"><div class="green"></div></li>
                            <li data-theme="orange"><div class="orange"></div></li>
                            <li data-theme="blush"><div class="blush"></div></li>
                            <li data-theme="red"><div class="red"></div></li>
                            <li data-theme="dynamic"><div class="dynamic"><i class="fa fa-paint-brush"></i></div></li>
                        </ul>
                    </div>
                    <!-- Settings: bg image -->
                    <div class="setting-img mb-3">
                        <div class="form-check form-switch imagebg-switch mb-1">
                            <input class="form-check-input" type="checkbox" id="CheckImage">
                            <label class="form-check-label" for="CheckImage">Set Background Image (Sidebar)</label>
                        </div>
                        <div class="bg-images">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="sidebar-img-1 sidebar-img-active"><a class="rounded sidebar-img" id="img-1" href="#"><img src="../../../assets/images/sidebar-bg/sidebar-1.jpg" alt="" /></a></li>
                                <li class="sidebar-img-2"><a class="rounded sidebar-img" id="img-2" href="#"><img src="../../../assets/images/sidebar-bg/sidebar-2.jpg" alt="" /></a></li>
                                <li class="sidebar-img-3"><a class="rounded sidebar-img" id="img-3" href="#"><img src="../../../assets/images/sidebar-bg/sidebar-3.jpg" alt="" /></a></li>
                                <li class="sidebar-img-4"><a class="rounded sidebar-img" id="img-4" href="#"><img src="../../../assets/images/sidebar-bg/sidebar-4.jpg" alt="" /></a></li>
                                <li class="sidebar-img-5"><a class="rounded sidebar-img" id="img-5" href="#"><img src="../../../assets/images/sidebar-bg/sidebar-5.jpg" alt="" /></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Settings: Theme dynamics -->
                    <div class="dt-setting">
                        <small class="card-title text-muted">Dynamic Color Settings</small>
                        <ul class="list-group list-unstyled mb-3 mt-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label>Primary Color</label>
                                <button id="primaryColorPicker" class="btn bg-primary avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label>Secondary Color</label>
                                <button id="secondaryColorPicker" class="btn bg-secondary avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted small">Chart Color 1</label>
                                <button id="chartColorPicker1" class="btn chart-color1 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted small">Chart Color 2</label>
                                <button id="chartColorPicker2" class="btn chart-color2 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted small">Chart Color 3</label>
                                <button id="chartColorPicker3" class="btn chart-color3 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted small">Chart Color 4</label>
                                <button id="chartColorPicker4" class="btn chart-color4 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted small">Chart Color 5</label>
                                <button id="chartColorPicker5" class="btn chart-color5 avatar xs border-0 rounded-0"></button>
                            </li>
                        </ul>
                    </div>
                    <!-- Settings: Light/dark -->
                    <div class="setting-mode">
                        <small class="card-title text-muted">RTL Layout</small>
                        <ul class="list-group list-unstyled mb-0 mt-1">
                            <li class="list-group-item d-flex align-items-center py-1 px-2">
                                <div class="form-check form-switch theme-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-switch">
                                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-1 px-2">
                                <div class="form-check form-switch theme-high-contrast mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                    <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-1 px-2">
                                <div class="form-check form-switch theme-rtl mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-start text-center">
                    <button type="button" class="btn flex-fill btn-primary lift">Save Changes</button>
                    <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="branch_selector" value="{{ Session::get('branch') }}">
        <div class="modal fade branchSelector" id="staticBackdropLive" data-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="{{ route('store_branch_session') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLiveLabel">Branch Selector</h5>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12">
                                <label class="form-label">Select Branch<sup class="text-danger">*</sup></label>
                                <select class="form-control form-control-md show-tick ms" name="branch">
                                <option value="">Select</option>
                                    @if(session()->has('branches'))
                                        @php $branches = Session::get('branches'); @endphp
                                        @foreach($branches as $br)
                                            <option value="{{ $br->id }}" {{ old('branch') == $br->id ? 'selected' : '' }}>{{ $br->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('branch')
                                <small class="text-danger">{{ $errors->first('branch') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/logout" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-submit btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>

@if(Request::is('dash'))
<!-- Plugin Js -->
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/page/index.js') }}"></script>
@endif

<!-- Jquery Page Js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/bundles/select2.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>


</body>
</html>