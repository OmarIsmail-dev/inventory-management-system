<!doctype html>
<html lang=" ">

<head>

    <title>inventory system </title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="title" content="Volt - Premium Bootstrap 5 Dashboard">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="image/10951884.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/10951884.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/10951884.png">

    <link rel="mask-icon" href="image/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Sweet Alert -->
    <link type="text/css" href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <!-- Notyf -->
    <link type="text/css" href="assets/css/notyf.min.css" rel="stylesheet">
    <!-- Full Calendar  -->
    <link type="text/css" href="assets/css/main.min.css" rel="stylesheet">
    <!-- Apex Charts -->
    <link type="text/css" href="assets/css/apexcharts.css" rel="stylesheet">
    <!-- Dropzone -->
    <link type="text/css" href="assets/css/dropzone.min.css" rel="stylesheet">
    <!-- Choices  -->
    <link type="text/css" href="assets/css/choices.min.css" rel="stylesheet">
    <!-- Leaflet JS -->
    <link type="text/css" href="assets/css/leaflet.css" rel="stylesheet">
    <!-- Volt CSS -->
    <link type="text/css" href="assets/css/inventory.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
            <img class="navbar-brand-dark" src="image/10951884.png" alt="Volt logo">
            <img class="navbar-brand-light" src="image/10951884.png" alt="Volt logo">
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div class="user-card d-flex d-md-none justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="{{ asset(Auth::user()->image) }}" class="card-img-top rounded-circle border-white"
                            alt="Bonnie Green">
                    </div>
                    <div class="d-block">
                        <h2 class="h5 mb-3">Hi, {{ Auth::user()->name }}</h2>
                        <a href="sign-in.html" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg> Sign Out </a>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="image/10951884.png" height="20" width="20" alt="Volt Logo">
                        </span>
                        <span class="mt-1 sidebar-text">inventory</span>
                    </a>
                </li>

                <li class="nav-item">
                    <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#submenu-dashboard">
                        <span>
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Dashboard</span>
                        </span>
                        <span class="link-arrow">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </span>
                    <div class="multi-level collapse show" role="list" id="submenu-dashboard"
                        aria-expanded="false">
                        <ul class="flex-column nav">

                            <li class="nav-item active">
                                <a href="{{ route('home') }}" class="nav-link">
                                    <span class="sidebar-text-contracted">O</span>
                                    <span class="sidebar-text">Overview</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Users </span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('MessageAdmin') }}"
                            class="nav-link d-flex align-items-center justify-content-between">
                            <span>
                                <span class="sidebar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                </svg>

                                </span>
                                <span class="sidebar-text">Messages</span>
                            </span>
                            <span class="badge badge-sm bg-danger badge-pill notification-count"></span>
                        </a>
                    </li>
                @endif



                @if (auth()->user()->role == 'Manager')
                    <li class="nav-item">
                        <a href="{{ route('product') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">product</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('category') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">category</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('Order') }}" class="">

                            <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" data-bs-target="#submenu-pages">
                                <span>
                                    <span class="sidebar-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="sidebar-text">order </span>
                                </span>
                                <span class="link-arrow">


                                </span>
                            </span>
                    </li>



                    <li class="nav-item">

                        <a href="{{ route('RequestSupplier') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                                </svg> </span>
                            <span class="sidebar-text">RequestSupplier</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('AcceptableRequests') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                                </svg>
                            </span>
                            <span class="sidebar-text">AcceptableRequests</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('refusedRequest') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">refusedRequests</span>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="{{ route('WorkerOrder') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                    </path>
                                    <path
                                        d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Worker_Task</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('CustomerOrder') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">customer_order</span>
                        </a>
                    </li>


                    {{-- <li class="nav-item">
                        <a href="{{ route('report') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-graph-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M0 0h1v15h15v1H0zm14.817 11.887a.5.5 0 0 0 .07-.704l-4.5-5.5a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61 4.15 5.073a.5.5 0 0 0 .704.07" />
                                </svg>
                            </span>
                            <span class="sidebar-text">report</span>
                        </a>
                    </li> --}}

                    <li class="nav-item">
                        <a href="{{ route('MessageManager') }}"
                            class="nav-link d-flex align-items-center justify-content-between">
                            <span>
                                <span class="sidebar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                    </svg>
                                </span>
                                <span class="sidebar-text">Message</span>
                            </span>
                            <span class="badge badge-sm bg-danger badge-pill notification-count"></span>
                        </a>
                    </li>
                @endif


                @if (auth()->user()->role == 'supplier')
                    <li class="nav-item mt-3">
                        <a href="{{ route('SupplierOrder') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-exclamation" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                    <path
                                        d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                </svg>
                            </span>
                            <span class="sidebar-text">SupplierOrder</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('Requests') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Requests </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route("AcceptableSupplier") }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                                </svg>
                            </span>
                            <span class="sidebar-text">AcceptableRequests</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route("refusedSupplier") }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">refusedRequests</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('MessageSupplier') }}"
                            class="nav-link d-flex align-items-center justify-content-between">
                            <span>
                                <span class="sidebar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                </svg>
                            </span>
                                <span class="sidebar-text">Messages</span>
                            </span>
                            <span class="badge badge-sm bg-danger badge-pill notification-count"></span>
                        </a>
                    </li>
                @endif


                @if (auth()->user()->role == 'worker')
                    <li class="nav-item">
                        <a href="{{ route('Workertask') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" class="bi bi-person-exclamation" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                    <path
                                        d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                </svg>
                            </span>
                            <span class="sidebar-text">WorkerTask</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('CustomerOrder') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">customer_order</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('MessageWorker') }}"
                            class="nav-link d-flex align-items-center justify-content-between">
                            <span>
                                <span class="sidebar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                </svg>
                            </span>
                                <span class="sidebar-text">Messages</span>
                            </span>
                            <span class="badge badge-sm bg-danger badge-pill notification-count"></span>
                        </a>
                    </li>
                @endif


            </ul>
        </div>
    </nav>


    <main class="content">
        @yield('content')
    </main>

    <script src="assets/js/popper.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Vendor JS -->

    <script src="assets/js/on-screen.umd.min.js"></script>
    <!-- Slider -->

    <script src="assets/js/nouislider.min.js"></script>
    <!-- Smooth scroll -->

    <script src="assets/js/smooth-scroll.polyfills.min.js"></script>
    <!-- Count up -->

    <script src="assets/js/countUp.umd.js"></script>
    <!-- Apex Charts -->

    <script src="assets/js/apexcharts.min.js"></script>
    <!-- Datepicker -->

    <script src="assets/js/datepicker.min.js"></script>
    <!-- DataTables -->

    <script src="assets/js/simple-datatables.js"></script>
    <!-- Sweet Alerts 2 -->

    <script src="assets/js/sweetalert2.min.js"></script>
    <!-- Moment JS -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <!-- Vanilla JS Datepicker -->

    <script src="assets/js/datepicker.min.js"></script>
    <!-- Full Calendar -->

    <script src="assets/js/main.min.js"></script>
    <!-- Dropzone -->

    <script src="assets/js/dropzone.min.js"></script>
    <!-- Choices.js -->

    <script src="assets/js/choices.min.js"></script>
    <!-- Notyf -->

    <script src="assets/js/notyf.min.js"></script>
    <!-- Mapbox & Leaflet.js -->

    <script src="assets/js/leaflet.js"></script>
    <!-- SVG Map -->

    <script src="assets/js/svg-pan-zoom.min.js"></script>

    <script src="assets/js/svgMap.min.js"></script>
    <!-- Simplebar -->

    <script src="assets/js/simplebar.min.js"></script>
    <!-- Sortable Js -->

    <script src="assets/js/Sortable.min.js"></script>
    <!-- Github buttons -->

    <script async defer="defer" src="https://buttons.github.io/buttons.js"></script>
    <!-- Volt JS -->

    <script src="assets/js/volt.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
