@extends('layouts.app')





@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>
        nav.navbar {
            overflow: visible;
            position: relative;
            z-index: 1000;
        }

        .custom-dropdown {
            position: absolute;
            z-index: 9999;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px;
            display: none;
            width: 300px !important;
        }

        .custom-dropdown .list-group-item {
            padding: 10px 12px;
            font-size: 14px;
            width: 288px !important;
        }

        .custom-dropdown h6 {
            font-size: 13px;
        }

        .custom-dropdown p {
            font-size: 12px;
            margin-bottom: 0;
        }

        .custom-dropdown svg.icon {
            width: 20px;
            height: 20px;
        }

        /* Reset Bootstrap’s default positioning inside nav */
        .navbar .dropdown-menu {
            position: static !important;
        }

        .custom-dropdown {
            position: absolute;
            z-index: 9999;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px;
            display: none;
            width: 300px !important;

        }

        .custom-dropdown .dropdown-item {
            font-size: 14px;
            padding: 8px 12px;
            width: 248px !important;

        }


        .custom-dropdown img.avatar {
            width: 30px;
            height: 30px;
            object-fit: cover;
        }

        .custom-dropdown svg.dropdown-icon {
            width: 18px;
            height: 18px;
        }

        .custom-dropdown .dropdown-divider {
            margin: 6px 0;
        }

        li.nav-item.dropdown.position-relative.me-3 {
            margin-top: 8px;
        }
    </style>
    </head>

    <body>





        <main style="margin-bottom: 20px">
            <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0 bg-dark">
                <div class="container-fluid px-0">
                    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                        <!-- Sidebar toggle (left) -->
                        <div class="d-flex align-items-center">
                            <button id="sidebar-toggle"
                                class="sidebar-toggle me-3 btn btn-icon-only d-none d-lg-inline-block align-items-center justify-content-center">
                                <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20" width="30"
                                    height="30">
                                    <path fill-rule="evenodd"
                                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Right‑side icons -->
                        <ul class="navbar-nav align-items-center">
                            <!-- Notifications -->
                            <li class="nav-item dropdown position-relative me-3">

                                <button id="notifToggle" class="btn btn-dark">
                                    <svg class="icon icon-sm text-light" fill="currentColor" viewBox="0 0 20 20"
                                        width="25" height="25">
                                        <path
                                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                        </path>

                                    </svg>
                                    @if (session('warnings') && count(session('warnings')) > 0)
                                        <span
                                            class="position-absolute   translate-middle p-1 bg-danger border border-light rounded-circle"
                                            style="right: 9px !important; top:37% !important">
                                        </span>
                                    @endif


                                </button>

                                <div id="notifMenu" class="custom-dropdown">

                                    <a class="nav-link position-relative" id="notifIcon" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-bell"></i>
                                    </a>

                                    <div class="list-group list-group-flush">

                                        <a href="#"
                                            class="text-center text-primary fw-bold border-bottom border-light py-2">

                                            Notifications
                                        </a>

                                        <div class="notif-scroll">

                                            @if (session('warnings') && count(session('warnings')) > 0)
                                                @foreach (session('warnings') as $warning)
                                                    <div class="list-group-item text-danger px-3 py-2  "
                                                        style="font-size: 17px">
                                                        {{ $warning }}
                                                        <hr>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="list-group-item text-muted text-center px-3 py-3">
                                                    No notifications
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </li>

                            <!-- Profile -->
                            <li class="nav-item dropdown position-relative">
                                <button id="profileToggle" class="btn btn-dark d-flex align-items-center">
                                    <img src="{{ asset(auth()->user()->image) }}" class="avatar rounded-circle me-2"
                                        alt="User">
                                    <span class="text-light">{{ auth()->user()->name }}</span>
                                </button>

                                <div id="profileMenu" class="custom-dropdown py-1">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <img class="avatar rounded-circle me-2" style="margin-right: 15px" width="30px  "
                                            src="{{ asset(auth()->user()->image) }}">

                                        <label for="" style="font-size: 14px"> My Profile</label>

                                    </a>
                                    <div class="dropdown-divider my-1"></div>
                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                        href="{{ route('Logout') }}">
                                        <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" width="16" height="16">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0
                                              01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Log out
                                    </a>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </main>

        @if (auth()->user()->role != 'Manager')
            <!-- Timeline -->
            <div class="col-12 col-md-6 col-xxl-4 mb-4 mt-6">
                <div class="card notification-card border-0 shadow">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="fs-5 fw-bold mb-0">Notifications</h2>

                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush list-group-timeline">

                            <!-- List Item 3 -->
                            <div class="list-group-item border-0">
                                <div class="row ps-lg-1">
                                    <div class="col-auto">
                                        <div class="icon-shape icon-xs icon-shape-warning rounded">
                                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col ms-n2 mb-3">
                                        <h3 class="fs-6 fw-bold mb-1"> </h3>
                                        <p class="mb-0"> </p>

                                        <div class="d-flex align-items-center">
                                            {{-- <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg> --}}
                                            <span class="small"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif


        @if (auth()->user()->role == 'Manager')
            <div class="container-fluid">
                {{--
                <select id="yearFilter" class="form-select mb-3" style="width: 200px;">
                     <label for="yearSelect">choose year:</label>
                     <option value="2025">2025</option>
                     <option value="2024">2024</option>
                     <option value="2023">2023</option>

                    </select> --}}


                    <label for="yearFilter">Select Year:</label>
                    <select id="yearFilter4" class="form-select w-25 mb-3">

                        @foreach ($OptionYears as $OptionYear)
                            <option value="{{ $OptionYear }}" selected>{{ $OptionYear }}</option>
                        @endforeach


                    </select>

                <div class="row g-4 mb-4">



                    <div class="col-md-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">refused Products</h5>
                            </div>
                            <div class="card-body">
                                <div id="AllRefusedProductsBarChart" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Top 5 Sold products</h5>
                            </div>
                            <div class="card-body">
                                <div id="pieChart" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-3 d-flex">
                    <div class="select" >
                    <label for="yearFilter">Select Year:</label>
                    <select id="yearFilter3" class="form-select w-100 mb-3">
                    </select>
                </div>

                <div class="select ms-4 " >
                    <label for="yearFilter">Select Products:</label>
                    <select id="productFilter" style="padding: 10px 9px;" class="form-select w-100 mb-3 ">
                        <option class=" w-100" value="all">All Products</option>

                    </select>
                </div>
                
                </div>



                <div class="row g-4 mb-4">


                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">All Sold Products</h5>
                            </div>
                            <div class="card-body">
                                <div id="allProductsBarChart" style="margin-top: 40px; height: 300px; "></div>
                            </div>
                        </div>
                    </div>
                </div>


                <label for="yearFilter">Select Year:</label>
                <select id="yearFilter" class="form-select w-25 mb-3">

                    @foreach ($OptionYears as $OptionYear)
                        <option value="{{ $OptionYear }}" selected>{{ $OptionYear }}</option>
                    @endforeach


                </select>

                <div class="row g-4 mb-4">


                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Total Sold Quantity</h5>
                            </div>
                            <div class="card-body">
                                <div id="salesLineChart" style="height: 350px"></div>
                            </div>
                        </div>
                    </div>
                </div>



                <label for="yearFilter2">Select Year:</label>
                <select class="form-select w-25 mb-3" id="yearFilter2">
                    @foreach ($OptionYears as $OptionYear)
                        <option value="{{ $OptionYear }}" selected>{{ $OptionYear }}</option>
                    @endforeach

                </select>

                <div class="row g-4 mb-4">


                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">monthly Total Value </h5>
                            </div>
                            <div class="card-body">
                                <div id="monthlyTotalChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="alert alert-primary mt-2 mb-6 text-center" role="alert">

                    ABC Analysis

                </div>

                <div class="row g-4 mb-6">

                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">ABC Analysis</h5>
                            </div>
                            <div class="card-body">
                                <div id="abcPieChart" style="max-width: 470px; margin: auto;"></div>
                            </div>


                        </div>
                    </div>



                    <div class="col-md-12 col-lg-8 " style="max-height: 500px; overflow: auto;">
                        <table class="table" style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">TotalValue</th>
                                    <th scope="col">Cumulative</th>
                                    <th scope="col">Category</th>
                                </tr>

                            </thead>
                            <tbody id="table-body">

                            </tbody>

                        </table>

                    </div>
                </div>



            </div>



            <div class="alert alert-primary mt-2 mb-6 text-center" role="alert">

                ROP Analysis

            </div>

            <div class="row g-4 mb-6">
                <div class="col-md-12 col-lg-8  m-auto " style="max-height: 500px; overflow: auto;">
                    <table class="table" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th scope="col">Product_id</th>
                                <th scope="col">product_name</th>
                                <th scope="col">std_daily_demand</th>
                                <th scope="col">mean_daily_demand</th>
                                <th scope="col">Safety Stock</th>
                                <th scope="col">Rop</th>
                            </tr>

                        </thead>
                        <tbody>


                            @foreach ($stds as $std)
                                <tr>
                                    <td>{{ $std['product_id'] ?? 'N/A' }}</td>
                                    <td>{{ $std['product_name'] ?? 'N/A' }}</td>
                                    <td>{{ $std['std_daily_demand'] ?? 'N/A' }}</td>
                                    <td>{{ $std['mean_daily_demand'] ?? 'N/A' }}</td>
                                    <td>{{ $SafetyStock = $z * ($std['std_daily_demand'] ?? 0) * $L }}</td>
                                    <td>{{ (int) round($SafetyStock + ($std['mean_daily_demand'] ?? 0) * $L) }}</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>


            <div class="alert alert-primary mt-2 mb-6 text-center" role="alert">

                For Casting

            </div>


            <div class="row g-4 mb-4">


                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">forecastChart</h5>
                        </div>
                        <div class="card-body">
                            <div id="forecastChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">


                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">forecastChart</h5>
                        </div>
                        <div class="card-body">
                            <div id="BarForecastChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        @endif


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const byId = id => document.getElementById(id);
                const cfg = [{
                        btn: 'notifToggle',
                        menu: 'notifMenu'
                    },
                    {
                        btn: 'profileToggle',
                        menu: 'profileMenu'
                    }
                ];

                // store original parent to restore later
                const original = {};
                cfg.forEach(({
                    menu
                }) => {
                    const m = byId(menu);
                    original[menu] = m.parentElement;
                });

                function closeAll() {
                    cfg.forEach(({
                        menu
                    }) => {
                        const m = byId(menu);
                        m.style.display = 'none';
                        if (m.parentElement === document.body) {
                            original[menu].appendChild(m);
                        }
                    });
                }

                cfg.forEach(({
                    btn,
                    menu
                }) => {
                    const b = byId(btn),
                        m = byId(menu);

                    b.addEventListener('click', e => {
                        e.stopPropagation();
                        closeAll();
                        // lift out into <body> so it always sits on top
                        document.body.appendChild(m);
                        // position right under button
                        const r = b.getBoundingClientRect();
                        m.style.top = `${window.scrollY + r.top + 45 }px`; // خليه قريب أكتر
                        m.style.left = `${window.scrollX + r.left - 90}px`;
                        m.style.display = 'block';
                    });
                });

                // close when clicking anywhere else
                document.addEventListener('click', closeAll);
            });
        </script>




        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



        <style>
            button.swal2-confirm.btn.btn-success {
                margin-left: 7px;
            }

            button.swal2-confirm.swal2-styled.swal2-default-outline {
                padding: 9px 16px;
                font-size: 13px;
            }

            button.swal2-cancel.swal2-styled.swal2-default-outline {
                padding: 9px 16px;
                font-size: 13px;
            }

            div#swal2-html-container {
                font-size: 17px;
            }
        </style>

        @if (session('success'))
            <script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Success! 🥳',
                        html: `<span style="font-size: 20px;">{!! session('success') !!}</span>`,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        width: '600px',
                        padding: '2em',
                    });
                };
            </script>
        @endif

        @if (session('warnings') && count(session('warnings')) > 0)
            <audio id="alertSound" src="{{ asset('sounds/alert.mp3') }}"></audio>

            <script>
                document.getElementById('alertSound').play();
                window.onload = async function() {
                    var warnings = @json(session('warnings'));

                    for (let i = 0; i < warnings.length; i++) {
                        await Swal.fire({
                            title: 'Warning 😬',
                            html: `<span style="font-size: 20px;">${warnings[i]}</span>`,
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            width: '600px',
                            padding: '2em',
                        });
                    }
                };
            </script>
        @endif


        {{-- Total Sold Quantity per Month --}}

        <script>

document.addEventListener("DOMContentLoaded", function() {
                const yearFilter = document.getElementById("yearFilter");


                loadingChart(yearFilter.value);


                yearFilter.addEventListener("change", function() {
                    loadingChart(this.value);
                });

            });

            async function loadingChart(selectedYear) {
                try {
                    const response = await fetch("https://ecommers.shop/api/CustomerOrder");
                    const json = await response.json();

                    const orders = Array.isArray(json) ? json : json.data;

                    const monthlyTotals = {};

                    orders.forEach(order => {
                        if (order.order_status === 'completed') {
                            const [day, month, year] = order.created_at.split("-");
                            const fullYear = `20${year}`;

                            if (fullYear === selectedYear) {
                                const date = new Date(`${fullYear}-${month}-${day}`);
                                const monthName = date.toLocaleString('en-US', {
                                    month: 'long'
                                });

                                monthlyTotals[monthName] = (monthlyTotals[monthName] || 0) + (parseFloat(order
                                    .quantity) || 0);
                            }
                        }
                    });

                    const monthOrder = ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ];

                    const labels = [];
                    const data = [];

                    monthOrder.forEach(month => {
                        labels.push(month);
                        data.push(monthlyTotals[month] || 0);
                    });

                    console.log("Labels:", labels);
                    console.log("Data:", data);

                    const options = {
                        chart: {
                            type: 'line',
                            height: 400,
                            toolbar: {
                                show: true
                            }
                        },
                        series: [{
                            name: 'Total Sold Quantity',
                            data: data
                        }],
                        xaxis: {
                            categories: labels
                        },
                        tooltip: {
                            shared: true,
                            intersect: false
                        },
                        stroke: {
                            width: 2
                        },
                        title: {
                            text: `Total Sold Quantity per Month (${selectedYear})`,
                            align: 'center'
                        }
                    };

                    document.querySelector("#salesLineChart").innerHTML = "";

                    const chart = new ApexCharts(document.querySelector("#salesLineChart"), options);
                    chart.render();

                } catch (error) {
                    console.error("Error fetching or processing data:", error);
                }
            }
        </script>


        {{-- Total price per Month --}}

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const yearFilter = document.getElementById("yearFilter2");

                loadChart(yearFilter.value);

                yearFilter.addEventListener("change", function() {
                    loadChart(this.value);
                });
            });

            async function loadChart(selectedYear) {
                try {
                    const response = await fetch("https://ecommers.shop/api/CustomerOrder");
                    const json = await response.json();

                    const orders = Array.isArray(json) ? json : json.data;

                    const monthlyTotals = {};

                    orders.forEach(order => {
                        if (order.order_status === 'completed') {
                            const [day, month, year] = order.created_at.split("-");
                            const fullYear = `20${year}`;

                            if (fullYear === selectedYear) {
                                const date = new Date(`${fullYear}-${month}-${day}`);
                                const monthName = date.toLocaleString('default', {
                                    month: 'long'
                                });

                                monthlyTotals[monthName] = (monthlyTotals[monthName] || 0) + parseFloat(order
                                .price);
                            }
                        }
                    });

                    const monthOrder = ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ];

                    const labels = [];
                    const data = [];

                    monthOrder.forEach(month => {
                        labels.push(month);
                        data.push(monthlyTotals[month] || 0);
                    });

                    console.log("Labels:", labels);
                    console.log("Data:", data);

                    const options = {
                        chart: {
                            type: 'line',
                            height: 400,
                            toolbar: {
                                show: true
                            }
                        },
                        series: [{
                            name: 'Total Value',
                            data: data
                        }],
                        xaxis: {
                            categories: labels
                        },
                        tooltip: {
                            shared: true,
                            intersect: false
                        },
                        stroke: {
                            width: 2
                        },
                        title: {
                            text: `Total Value per Month (${selectedYear})`,
                            align: 'center'
                        }
                    };

                    document.querySelector("#monthlyTotalChart").innerHTML = "";

                    const chart = new ApexCharts(document.querySelector("#monthlyTotalChart"), options);
                    chart.render();

                } catch (error) {
                    console.error("Error fetching or processing data:", error);
                }
            }
        </script>


        {{-- for casting --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {


                const rawData = [{
                        "YearMonth": "2020-03-01T00:00:00.000",
                        "quantity": 44,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-04-01T00:00:00.000",
                        "quantity": 228,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-05-01T00:00:00.000",
                        "quantity": 229,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-06-01T00:00:00.000",
                        "quantity": 120,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-07-01T00:00:00.000",
                        "quantity": 58,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-08-01T00:00:00.000",
                        "quantity": 101,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-09-01T00:00:00.000",
                        "quantity": 227,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-10-01T00:00:00.000",
                        "quantity": 283,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-11-01T00:00:00.000",
                        "quantity": 259,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2020-12-01T00:00:00.000",
                        "quantity": 146,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-01-01T00:00:00.000",
                        "quantity": 62,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-02-01T00:00:00.000",
                        "quantity": 187,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-03-01T00:00:00.000",
                        "quantity": 201,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-04-01T00:00:00.000",
                        "quantity": 148,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-05-01T00:00:00.000",
                        "quantity": 245,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-06-01T00:00:00.000",
                        "quantity": 213,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-07-01T00:00:00.000",
                        "quantity": 148,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-08-01T00:00:00.000",
                        "quantity": 191,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-09-01T00:00:00.000",
                        "quantity": 117,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-10-01T00:00:00.000",
                        "quantity": 232,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-11-01T00:00:00.000",
                        "quantity": 295,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2021-12-01T00:00:00.000",
                        "quantity": 319,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-01-01T00:00:00.000",
                        "quantity": 292,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-02-01T00:00:00.000",
                        "quantity": 230,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-03-01T00:00:00.000",
                        "quantity": 226,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-04-01T00:00:00.000",
                        "quantity": 247,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-05-01T00:00:00.000",
                        "quantity": 276,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-06-01T00:00:00.000",
                        "quantity": 356,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-07-01T00:00:00.000",
                        "quantity": 217,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-08-01T00:00:00.000",
                        "quantity": 409,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-09-01T00:00:00.000",
                        "quantity": 108,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-10-01T00:00:00.000",
                        "quantity": 263,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-11-01T00:00:00.000",
                        "quantity": 105,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2022-12-01T00:00:00.000",
                        "quantity": 505,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-01-01T00:00:00.000",
                        "quantity": 192,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-02-01T00:00:00.000",
                        "quantity": 144,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-03-01T00:00:00.000",
                        "quantity": 183,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-04-01T00:00:00.000",
                        "quantity": 236,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-05-01T00:00:00.000",
                        "quantity": 174,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-06-01T00:00:00.000",
                        "quantity": 167,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-07-01T00:00:00.000",
                        "quantity": 319,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-08-01T00:00:00.000",
                        "quantity": 182,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-09-01T00:00:00.000",
                        "quantity": 238,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-10-01T00:00:00.000",
                        "quantity": 267,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-11-01T00:00:00.000",
                        "quantity": 163,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2023-12-01T00:00:00.000",
                        "quantity": 232,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-01-01T00:00:00.000",
                        "quantity": 163,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-02-01T00:00:00.000",
                        "quantity": 214,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-03-01T00:00:00.000",
                        "quantity": 265,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-04-01T00:00:00.000",
                        "quantity": 147,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-05-01T00:00:00.000",
                        "quantity": 220,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-06-01T00:00:00.000",
                        "quantity": 342,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-07-01T00:00:00.000",
                        "quantity": 284,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-08-01T00:00:00.000",
                        "quantity": 148,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-09-01T00:00:00.000",
                        "quantity": 201,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-10-01T00:00:00.000",
                        "quantity": 180,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-11-01T00:00:00.000",
                        "quantity": 177,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2024-12-01T00:00:00.000",
                        "quantity": 182,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2025-01-01T00:00:00.000",
                        "quantity": 177,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2025-02-01T00:00:00.000",
                        "quantity": 157,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2025-03-01T00:00:00.000",
                        "quantity": 104,
                        "Type": "Actual",
                        "Lower_CI": null,
                        "Upper_CI": null
                    },
                    {
                        "YearMonth": "2025-04-01T00:00:00.000",
                        "quantity": 175.6968861773,
                        "Type": "Forecast",
                        "Lower_CI": -11.9286260259,
                        "Upper_CI": 363.3223983805
                    },
                    {
                        "YearMonth": "2025-05-01T00:00:00.000",
                        "quantity": 205.4418373255,
                        "Type": "Forecast",
                        "Lower_CI": 17.3183054033,
                        "Upper_CI": 393.5653692478
                    },
                    {
                        "YearMonth": "2025-06-01T00:00:00.000",
                        "quantity": 235.8561547436,
                        "Type": "Forecast",
                        "Lower_CI": 45.3780370012,
                        "Upper_CI": 426.3342724861
                    },
                    {
                        "YearMonth": "2025-07-01T00:00:00.000",
                        "quantity": 195.7526782424,
                        "Type": "Forecast",
                        "Lower_CI": 3.1385669981,
                        "Upper_CI": 388.3667894868
                    },
                    {
                        "YearMonth": "2025-08-01T00:00:00.000",
                        "quantity": 169.7789865619,
                        "Type": "Forecast",
                        "Lower_CI": -24.9629587023,
                        "Upper_CI": 364.5209318261
                    },
                    {
                        "YearMonth": "2025-09-01T00:00:00.000",
                        "quantity": 163.5169902284,
                        "Type": "Forecast",
                        "Lower_CI": -33.3285387478,
                        "Upper_CI": 360.3625192046
                    },
                    {
                        "YearMonth": "2025-10-01T00:00:00.000",
                        "quantity": 211.6516398657,
                        "Type": "Forecast",
                        "Lower_CI": 12.724671486,
                        "Upper_CI": 410.5786082453
                    },
                    {
                        "YearMonth": "2025-11-01T00:00:00.000",
                        "quantity": 176.0775547429,
                        "Type": "Forecast",
                        "Lower_CI": -24.9093336821,
                        "Upper_CI": 377.064443168
                    },
                    {
                        "YearMonth": "2025-12-01T00:00:00.000",
                        "quantity": 231.8496328535,
                        "Type": "Forecast",
                        "Lower_CI": 28.8243076372,
                        "Upper_CI": 434.8749580698
                    },
                    {
                        "YearMonth": "2026-01-01T00:00:00.000",
                        "quantity": 152.5146874745,
                        "Type": "Forecast",
                        "Lower_CI": -52.5364780803,
                        "Upper_CI": 357.5658530293
                    },
                    {
                        "YearMonth": "2026-02-01T00:00:00.000",
                        "quantity": 160.3293316346,
                        "Type": "Forecast",
                        "Lower_CI": -46.5952553402,
                        "Upper_CI": 367.2539186093
                    },
                    {
                        "YearMonth": "2026-03-01T00:00:00.000",
                        "quantity": 140.7374760362,
                        "Type": "Forecast",
                        "Lower_CI": -68.1276325049,
                        "Upper_CI": 349.6025845773
                    },
                ];

                const actualData = [];
                const forecastData = [];
                const lowerCI = [];
                const upperCI = [];

                rawData.forEach(item => {
                    const date = new Date(item.YearMonth).toISOString().split('T')[0];
                    if (item.Type === "Actual") {
                        actualData.push({
                            x: date,
                            y: item.quantity
                        });
                    } else {
                        forecastData.push({
                            x: date,
                            y: item.quantity
                        });
                        if (item.Lower_CI != null && item.Upper_CI != null) {
                            lowerCI.push({
                                x: date,
                                y: item.Lower_CI
                            });
                            upperCI.push({
                                x: date,
                                y: item.Upper_CI
                            });
                        }
                    }
                });

                const options = {
                    chart: {
                        type: 'line',
                        height: 400,
                        toolbar: {
                            show: true
                        }
                    },
                    series: [{
                            name: "Actual",
                            data: actualData,
                            color: "#00BFFF"
                        },
                        {
                            name: "Forecast",
                            data: forecastData,
                            color: "#FFA500",
                            dashArray: 5
                        },
                        {
                            name: "Lower CI",
                            data: lowerCI,
                            color: "#FFB6C1",
                            strokeDashArray: 0
                        },
                        {
                            name: "Upper CI",
                            data: upperCI,
                            color: "#FFB6C1",
                            strokeDashArray: 0
                        }
                    ],
                    xaxis: {
                        type: 'datetime',
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        min: 0, // يبدأ من صفر

                        labels: {
                            formatter: function(value) {
                                return Math.round(value); // يجعل القيمة رقم صحيح بدون فواصل
                            }
                        },
                        title: {
                            text: 'Quantity'
                        }
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    },
                    stroke: {
                        width: [2, 2, 1, 1]
                    }
                };

                const chart = new ApexCharts(document.querySelector("#forecastChart"), options);
                chart.render();
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {


                const rawData = [

                    {
                        "product_name": "Nike Revolution 7",
                        "year": 2025,
                        "predicted_quantity": 137
                    },
                    {
                        "product_name": "Nike Revolution 7",
                        "year": 2026,
                        "predicted_quantity": 123
                    },
                    {
                        "product_name": "ADIDAS Tensaur Sport 2.0 Cf K Running Shoes",
                        "year": 2025,
                        "predicted_quantity": 183
                    },
                    {
                        "product_name": "ADIDAS Tensaur Sport 2.0 Cf K Running Shoes",
                        "year": 2026,
                        "predicted_quantity": 175
                    },
                    {
                        "product_name": "Adidas Men's Ultrarun 5 Running Shoes",
                        "year": 2025,
                        "predicted_quantity": 120
                    },
                    {
                        "product_name": "Adidas Men's Ultrarun 5 Running Shoes",
                        "year": 2026,
                        "predicted_quantity": 109
                    },
                    {
                        "product_name": "NIKE Superfly 9 Academy MG Men's Football",
                        "year": 2025,
                        "predicted_quantity": 163
                    },
                    {
                        "product_name": "NIKE Superfly 9 Academy MG Men's Football",
                        "year": 2026,
                        "predicted_quantity": 153
                    },
                    {
                        "product_name": "iphone13",
                        "year": 2025,
                        "predicted_quantity": 157
                    },
                    {
                        "product_name": "iphone13",
                        "year": 2026,
                        "predicted_quantity": 141
                    },
                    {
                        "product_name": "iphone12",
                        "year": 2025,
                        "predicted_quantity": 126
                    },
                    {
                        "product_name": "iphone12",
                        "year": 2026,
                        "predicted_quantity": 114
                    },
                    {
                        "product_name": "Dell XPS (9310)",
                        "year": 2025,
                        "predicted_quantity": 136
                    },
                    {
                        "product_name": "Dell XPS (9310)",
                        "year": 2026,
                        "predicted_quantity": 125
                    },
                    {
                        "product_name": "Liberty Air 2Pro",
                        "year": 2025,
                        "predicted_quantity": 139
                    },
                    {
                        "product_name": "Liberty Air 2Pro",
                        "year": 2026,
                        "predicted_quantity": 114
                    },
                    {
                        "product_name": "Apple AirPods Pro (2nd Generation)",
                        "year": 2025,
                        "predicted_quantity": 86
                    },
                    {
                        "product_name": "Apple AirPods Pro (2nd Generation)",
                        "year": 2026,
                        "predicted_quantity": 74
                    },
                    {
                        "product_name": "MacBook Air (M1)",
                        "year": 2025,
                        "predicted_quantity": 121
                    },
                    {
                        "product_name": "MacBook Air (M1)",
                        "year": 2026,
                        "predicted_quantity": 87
                    },
                    {
                        "product_name": "T-shirt basic",
                        "year": 2025,
                        "predicted_quantity": 127
                    },
                    {
                        "product_name": "T-shirt basic",
                        "year": 2026,
                        "predicted_quantity": 112
                    },
                    {
                        "product_name": "jacket",
                        "year": 2025,
                        "predicted_quantity": 165
                    },
                    {
                        "product_name": "jacket",
                        "year": 2026,
                        "predicted_quantity": 144
                    }

                ];

                const years = [2025, 2026];
                const productIds = [...new Set(rawData.map(item => item.product_name))];

                const series = years.map(year => ({
                    name: year.toString(),
                    data: productIds.map(pid => {
                        const item = rawData.find(d => d.product_name === pid && d.year === year);
                        return item ? item.predicted_quantity : 0;
                    })
                }));

                const options = {
                    chart: {
                        type: 'bar',
                        height: 450
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            dataLabels: {
                                position: 'top'
                            },
                            columnWidth: '60%'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    series: series,
                    xaxis: {
                        categories: productIds.map(pid => `Product ${pid}`),
                        title: {
                            text: 'Product'
                        }
                    },
                    yaxis: {
                        min: 0,
                        title: {
                            text: 'Predicted Quantity'
                        }
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    }
                };

                const chart = new ApexCharts(document.querySelector("#BarForecastChart"), options);
                chart.render();

            });
        </script>


        {{-- All charts --}}

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const barChartEl = document.querySelector("#barChart");
                const pieChartEl = document.querySelector("#pieChart");

                let barChart = null;
                let pieChart = null;


                const normalizeProductName = name => name.trim().toLowerCase().replace(/\s+/g, ' ');
                const productAliasMap = {};
                const getAlias = name => {
                    const normalized = normalizeProductName(name);
                    if (productAliasMap[normalized]) return productAliasMap[normalized];
                    productAliasMap[normalized] = name.trim();
                    return productAliasMap[normalized];
                };


                const generateColors = (num) => {
                    const colors = [];
                    for (let i = 0; i < num; i++) {
                        const hue = (i * 137.508) % 360;
                        colors.push(`hsl(${hue}, 65%, 55%)`);
                    }
                    return colors;
                };




                fetch("https://ecommers.shop/api/CustomerOrder")
                    .then(res => res.json())
                    .then(response => {
                        const orders = response.data;

                        if (pieChart) pieChart.destroy();


                        const monthlyTopProductRefused = {
                            Jan: {
                                product: '',
                                qty: 0
                            },
                            Feb: {
                                product: '',
                                qty: 0
                            },
                            Mar: {
                                product: '',
                                qty: 0
                            },
                            Apr: {
                                product: '',
                                qty: 0
                            },
                            May: {
                                product: '',
                                qty: 0
                            },
                            Jun: {
                                product: '',
                                qty: 0
                            },
                            Jul: {
                                product: '',
                                qty: 0
                            },
                            Aug: {
                                product: '',
                                qty: 0
                            },
                            Sep: {
                                product: '',
                                qty: 0
                            },
                            Oct: {
                                product: '',
                                qty: 0
                            },
                            Nov: {
                                product: '',
                                qty: 0
                            },
                            Dec: {
                                product: '',
                                qty: 0
                            }
                        };

                        const monthlyRefusedMap = {};
                        const monthlyProductMap = {};
                        const productValues = {};
                        const productQuantities = {};







                        for (const month in monthlyRefusedMap) {
                            let topProduct = '',
                                topQty = 0;
                            for (const product in monthlyRefusedMap[month]) {
                                const qty = monthlyRefusedMap[month][product];
                                if (qty > topQty) {
                                    topQty = qty;
                                    topProduct = product;
                                }
                            }
                            monthlyTopProductRefused[month] = {
                                product: topProduct,
                                qty: topQty
                            };
                        }


                        // حساب إجمالي المبيعات



                        // حساب أفضل 5 منتجات مبيعًا بالـ units


                        const barLabels = Object.keys(monthlyTopProductRefused);
                        const barData = Object.values(monthlyTopProductRefused).map(item => item.qty);



                        if (barChart) barChart.destroy();
                        if (pieChart) pieChart.destroy();

                        barChart = new ApexCharts(barChartEl, {
                            chart: {
                                type: 'bar',
                                height: 400,
                                width: '100%',
                                toolbar: {
                                    show: false
                                },
                                animations: {
                                    enabled: true,
                                    easing: 'easeinout',
                                    speed: 800
                                }
                            },
                            plotOptions: {
                                bar: {
                                    borderRadius: 6,
                                    horizontal: false,
                                    columnWidth: '900%',
                                    distributed: false
                                }
                            },
                            colors: ['#0ea5e9', '#22c55e', '#e11d48', '#f97316', '#7c3aed',
                                '#06b6d4', '#facc15', '#6366f1', '#84cc16', '#db2777',
                                '#14b8a6', '#3b82f6'
                            ],
                            dataLabels: {
                                enabled: false
                            },
                            series: [{
                                name: 'Top Refused Products',
                                data: barData
                            }],
                            xaxis: {
                                categories: barLabels,
                                labels: {
                                    style: {
                                        fontSize: '14px',
                                        fontWeight: 600,
                                        width: '270px'
                                    }
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Refused Quantity',
                                    style: {
                                        fontSize: '20px',
                                        fontWeight: 800
                                    }
                                },
                                labels: {
                                    style: {
                                        fontSize: '14px',
                                        width: '270px'
                                    }
                                }
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val, opts) {
                                        const month = opts.w.globals.labels[opts.dataPointIndex];
                                        const topRefused = monthlyTopProductRefused[month].product;
                                        return `${val} units - ${topRefused}`;
                                    }
                                },
                                custom: function({
                                    series,
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    const month = w.globals.labels[dataPointIndex];
                                    const topRefused = monthlyTopProductRefused[month].product;
                                    const quantity = series[seriesIndex][dataPointIndex];
                                    return `
                <div style="padding: 8px; font-size: 14px; font-weight: 500;">
                  <strong>${month}</strong><br/>
                  <span style="color: #dc2626; font-weight: bold;">${quantity}</span> units<br/>
                  <span style="color: #555; font-style: italic;">${topRefused}</span>
                </div>`;
                                }
                            }
                        });

                        barChart.render();

                        function normalizeProductName(name) {
                            return name
                                .toLowerCase()
                                .replace(/\s+/g, '') // إزالة المسافات
                                .replace(/[^a-z0-9]/gi, '') // إزالة الرموز الخاصة
                                .replace(/iphone\s*13/g, 'iphone13') // مثال على توحيد اسم
                                .replace(/iphone\s*12/g, 'iphone12') // مثال آخر حسب الحاجة
                                .trim();
                        }



                        orders.forEach(order => {
                            const dateParts = order.created_at.split("-");
                            const monthNum = parseInt(dateParts[1]);
                            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                            ];
                            const monthName = monthNames[monthNum - 1];

                            const qty = parseInt(order.quantity);
                            const rawProduct = order.product_name;
                            const product = normalizeProductName(rawProduct);

                            if (order.order_status === "refused") {
                                if (!monthlyRefusedMap[monthName]) monthlyRefusedMap[monthName] = {};
                                if (!monthlyRefusedMap[monthName][product]) monthlyRefusedMap[monthName][
                                    product
                                ] = 0;
                                monthlyRefusedMap[monthName][product] += qty;
                            }

                            if (order.order_status === "completed") {
                                const unitPrice = parseFloat(order.price || 0);
                                const value = qty * unitPrice;

                                if (!productValues[product]) productValues[product] = 0;
                                productValues[product] += value;

                                if (!productQuantities[product]) productQuantities[product] = 0;
                                productQuantities[product] += qty;

                                if (!monthlyProductMap[monthName]) monthlyProductMap[monthName] = {};
                                if (!monthlyProductMap[monthName][product]) monthlyProductMap[monthName][
                                    product
                                ] = 0;
                                monthlyProductMap[monthName][product] += qty;
                            }
                        });

                        const totalSales = Object.values(productValues).reduce((acc, val) => acc + val, 0);
                        const sortedABC = Object.entries(productValues).sort((a, b) => b[1] - a[1]);

                        let cumulative = 0;
                        const abcCategories = {
                            A: [],
                            B: [],
                            C: []
                        };

                        sortedABC.forEach(([product, value]) => {
                            const percentage = (value / totalSales) * 100;
                            cumulative += percentage;

                            const productData = {
                                product,
                                qty: productQuantities[product],
                                totalValue: value
                            };

                            if (cumulative <= 70) {
                                abcCategories.A.push(productData);
                            } else if (cumulative <= 90) {
                                abcCategories.B.push(productData);
                            } else {
                                abcCategories.C.push(productData);
                            }
                        });

                        // pie chart
                        const categoryTotals = {
                            A: abcCategories.A.reduce((sum, item) => sum + item.qty, 0),
                            B: abcCategories.B.reduce((sum, item) => sum + item.qty, 0),
                            C: abcCategories.C.reduce((sum, item) => sum + item.qty, 0)
                        };

                        const abcPieChart = new ApexCharts(document.querySelector("#abcPieChart"), {
                            chart: {
                                type: 'pie',
                                height: 400
                            },
                            labels: ['Category A', 'Category B', 'Category C'],
                            series: [categoryTotals.A, categoryTotals.B, categoryTotals.C],
                            legend: {
                                position: 'bottom',
                                fontSize: '14px',
                                fontWeight: 600
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold'
                                },
                                formatter: function(val) {
                                    return `${val.toFixed(1)}%`;
                                }
                            },
                            tooltip: {
                                custom: function({
                                    seriesIndex,
                                    w
                                }) {
                                    const category = ['A', 'B', 'C'][seriesIndex];
                                    const products = abcCategories[category];
                                    const color = w.config.colors[seriesIndex];

                                    let html = `
        <div style="padding: 10px; font-size: 14px;">
          <div style="font-weight: bold; font-size: 15px; color: ${color};">Category ${category}</div>
          <div style="margin-top: 6px; max-height: 200px; overflow-y: auto;">
      `;

                                    products.forEach(({
                                        product,
                                        qty
                                    }) => {
                                        html += `
          <div style="margin-bottom: 4px;">
            <span style="color: #333;">${product}</span>
            <span style="color: #999;"> - ${qty.toLocaleString()}</span>
          </div>
        `;
                                    });

                                    html += `</div></div>`;
                                    return html;
                                }
                            },
                            colors: ['#008FFB', '#00E396', '#FEB019']
                        });

                        abcPieChart.render();

                        // جدول التحليل ABC
                        const tableBody = document.getElementById("table-body");
                        const data = [
                            ...abcCategories.A.map(p => ({
                                ...p,
                                category: 'A'
                            })),
                            ...abcCategories.B.map(p => ({
                                ...p,
                                category: 'B'
                            })),
                            ...abcCategories.C.map(p => ({
                                ...p,
                                category: 'C'
                            }))
                        ].map((item, index, arr) => {
                            const cumulative = arr.slice(0, index + 1).reduce((sum, el) => sum + (el
                                .totalValue / totalSales) * 100, 0);
                            return {
                                id: index + 1,
                                product: item.product,
                                qty: item.qty,
                                totalValue: item.totalValue,
                                cumulative,
                                category: item.category
                            };
                        });

                        data.forEach(item => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
    <td>${item.id}</td>
    <td>${item.product}</td>
    <td>${item.qty.toLocaleString()}</td>
    <td>${item.totalValue.toLocaleString()}</td>
    <td>${item.cumulative.toFixed(2)}%</td>
    <td>${item.category}</td>
  `;
                            tableBody.appendChild(row);
                        });





                        const allRefusedProductsMonthly = {};
                        Object.keys(monthlyRefusedMap).forEach(month => {
                            for (const product in monthlyRefusedMap[month]) {
                                if (!allRefusedProductsMonthly[product]) allRefusedProductsMonthly[
                                    product] = Array(12).fill(0);
                                const monthIndex = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",
                                    "Sep", "Oct", "Nov", "Dec"
                                ].indexOf(month);
                                allRefusedProductsMonthly[product][monthIndex] = monthlyRefusedMap[month][
                                    product
                                ];
                            }
                        });

                        const refusedProductNames = Object.keys(allRefusedProductsMonthly);
                        const refusedColors = generateColors(refusedProductNames.length);

                        const refusedSeriesData = refusedProductNames.map((product, index) => ({
                            name: product,
                            data: allRefusedProductsMonthly[product],
                            color: refusedColors[index]
                        }));

                        const refusedBarChart = new ApexCharts(document.querySelector("#refusedProductsBarChart"), {
                            chart: {
                                type: 'bar',
                                height: 500,
                                stacked: false,
                                toolbar: {
                                    show: true
                                },
                                zoom: {
                                    enabled: true
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '75%'
                                }
                            },
                            colors: refusedColors,
                            dataLabels: {
                                enabled: false
                            },
                            xaxis: {
                                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                ],
                                labels: {
                                    style: {
                                        fontSize: '12px',
                                        fontWeight: 600
                                    }
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Refused Products'
                                }
                            },
                            legend: {
                                position: 'bottom',
                                fontSize: '13px'
                            },
                            tooltip: {
                                shared: true,
                                intersect: false,
                                custom: function({
                                    series,
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    const month = w.globals.labels[dataPointIndex];
                                    const tooltipItems = [];

                                    w.config.series.forEach((s, i) => {
                                        const qty = s.data[dataPointIndex];
                                        if (qty > 0) {
                                            const color = w.config.colors[i];
                                            tooltipItems.push({
                                                name: s.name,
                                                qty,
                                                color
                                            });
                                        }
                                    });

                                    tooltipItems.sort((a, b) => b.qty - a.qty);

                                    let tooltipHtml = `
                <div style="padding: 10px; font-size: 14px; line-height: 1.5;">
                  <strong style="font-size: 15px;">${month}</strong><br/>
              `;

                                    tooltipItems.forEach(t => {
                                        tooltipHtml += `
                  <div style="margin: 4px 0;">
                    <span style="display: inline-block; width: 10px; height: 10px; background-color: ${t.color}; border-radius: 50%; margin-right: 6px;"></span>
                    <span style="font-weight: bold; color: ${t.color};">${t.name}</span>
                    <span style="color: #555;"> - ${t.qty} unit${t.qty > 1 ? 's' : ''}</span>
                  </div>
                `;
                                    });

                                    tooltipHtml += `</div>`;
                                    return tooltipHtml;
                                }
                            },
                            series: refusedSeriesData
                        });

                        refusedBarChart.render();
                    })

                    .catch(err => console.error("API fetch error:", err));
            });
        </script>


        {{-- All sold products --}}


        <script>

document.addEventListener("DOMContentLoaded", function() {
    const yearFilter = document.getElementById("yearFilter3");
    const productFilter = document.getElementById("productFilter"); // فلتر المنتجات
    const chartContainer = document.querySelector("#allProductsBarChart");
    let allOrders = [];
    let selectedProduct = "all"; // تحديد المنتج الافتراضي

    const productAliasMap = {};
    const getAlias = name => {
        const normalized = normalizeProductName(name);
        if (productAliasMap[normalized]) return productAliasMap[normalized];
        productAliasMap[normalized] = name.trim();
        return productAliasMap[normalized];
    };

    function normalizeProductName(name) {
        return name
            .toLowerCase()
            .replace(/\s+/g, '')
            .replace(/[^a-z0-9]/gi, '')
            .replace(/iphone\s*13/g, 'iphone13')
            .replace(/iphone\s*12/g, 'iphone12')
            .trim();
    }

    const generateColors = (num) => {
        const colors = [];
        for (let i = 0; i < num; i++) {
            const hue = (i * 137.508) % 360;
            colors.push(`hsl(${hue}, 65%, 55%)`);
        }
        return colors;
    };

    let allProductsBarChart;

    function renderChartForYearAndProduct(selectedYear, selectedProduct) {
        const monthlyProductMap = {};

        allOrders.forEach(order => {
            if (order.order_status !== 'completed') return;

            let createdAt;
            if (order.created_at.includes('-') && order.created_at.split('-')[0].length === 2) {
                const [day, month, yearShort] = order.created_at.split('-');
                const year = parseInt(yearShort, 10) + 2000;
                createdAt = new Date(`${year}-${month}-${day}`);
            } else {
                createdAt = new Date(order.created_at);
            }

            const year = createdAt.getFullYear();
            if (year !== selectedYear) return;

            const month = createdAt.toLocaleString('default', {
                month: 'short'
            });
            const alias = getAlias(order.product_name);
            const qty = parseInt(order.quantity);

            // فلتر المنتجات هنا
            if (selectedProduct !== "all" && alias !== selectedProduct) return;

            if (!monthlyProductMap[month]) monthlyProductMap[month] = {};
            if (!monthlyProductMap[month][alias]) monthlyProductMap[month][alias] = 0;
            monthlyProductMap[month][alias] += qty;
        });

        const allProductsMonthly = {};
        Object.keys(monthlyProductMap).forEach(month => {
            for (const product in monthlyProductMap[month]) {
                if (!allProductsMonthly[product]) allProductsMonthly[product] = Array(12).fill(0);
                const monthIndex = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ].indexOf(month);
                allProductsMonthly[product][monthIndex] = monthlyProductMap[month][product];
            }
        });

        const productNames = Object.keys(allProductsMonthly);
        const colors = generateColors(productNames.length);

        const seriesData = productNames.map((product, index) => ({
            name: product,
            data: allProductsMonthly[product],
            color: colors[index]
        }));

        if (allProductsBarChart) {
            allProductsBarChart.updateSeries(seriesData);
        } else {
            allProductsBarChart = new ApexCharts(chartContainer, {
                chart: {
                    type: 'bar',
                    height: 500,
                    stacked: false,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '75%'
                    }
                },
                colors: colors,
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                    ],
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 600
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'All products sold'
                    }
                },
                legend: {
                    position: 'bottom',
                    fontSize: '13px'
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        const month = w.globals.labels[dataPointIndex];
                        const tooltipItems = [];
                        w.config.series.forEach((s, i) => {
                            const qty = s.data[dataPointIndex];
                            if (qty > 0) {
                                tooltipItems.push({
                                    name: s.name,
                                    qty,
                                    color: w.config.colors[i]
                                });
                            }
                        });
                        tooltipItems.sort((a, b) => b.qty - a.qty);
                        let tooltipHtml =
                            `<div style="padding: 10px; font-size: 14px;"><strong>${month}</strong><br/>`;
                        tooltipItems.forEach(t => {
                            tooltipHtml += `<div style="margin: 4px 0;">
                                <span style="width:10px;height:10px;background:${t.color};display:inline-block;border-radius:50%;margin-right:6px;"></span>
                                <span style="font-weight:bold;color:${t.color};">${t.name}</span>
                                <span style="color:#555;"> - ${t.qty} unit${t.qty > 1 ? 's' : ''}</span>
                            </div>`;
                        });
                        return tooltipHtml + `</div>`;
                    }
                },
                series: seriesData
            });
            allProductsBarChart.render();
        }
    }

    fetch("https://ecommers.shop/api/CustomerOrder")
        .then(res => res.json())
        .then(response => {
            allOrders = response.data;

            const years = new Set();
            const products = new Set();

            allOrders.forEach(order => {
                let createdAt;
                if (order.created_at.includes('-') && order.created_at.split('-')[0].length === 2) {
                    const [day, month, yearShort] = order.created_at.split('-');
                    const year = parseInt(yearShort, 10) + 2000;
                    createdAt = new Date(`${year}-${month}-${day}`);
                } else {
                    createdAt = new Date(order.created_at);
                }
                years.add(createdAt.getFullYear());
                products.add(getAlias(order.product_name));
            });

            const sortedYears = Array.from(years).sort((a, b) => b - a);
            const sortedProducts = Array.from(products).sort();

            // إضافة السنوات في الفلتر
            sortedYears.forEach(y => {
                const opt = document.createElement("option");
                opt.value = y;
                opt.textContent = y;
                yearFilter.appendChild(opt);
            });

            // إضافة المنتجات في الفلتر
            sortedProducts.forEach(product => {
                const opt = document.createElement("option");
                opt.value = product;
                opt.textContent = product;
                productFilter.appendChild(opt);
            });

            yearFilter.addEventListener("change", () => {
                renderChartForYearAndProduct(parseInt(yearFilter.value), selectedProduct);
            });

            productFilter.addEventListener("change", () => {
                selectedProduct = productFilter.value;
                renderChartForYearAndProduct(parseInt(yearFilter.value), selectedProduct);
            });

            if (sortedYears.length > 0) {
                yearFilter.value = sortedYears[0];
                renderChartForYearAndProduct(sortedYears[0], selectedProduct);
            }
        });
});

        </script>


        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                const yearFilter = document.getElementById("yearFilter3");
                const chartContainer = document.querySelector("#allProductsBarChart");
                let allOrders = [];

                const productAliasMap = {};
                const getAlias = name => {
                    const normalized = normalizeProductName(name);
                    if (productAliasMap[normalized]) return productAliasMap[normalized];
                    productAliasMap[normalized] = name.trim();
                    return productAliasMap[normalized];
                };

                function normalizeProductName(name) {
                    return name
                        .toLowerCase()
                        .replace(/\s+/g, '')
                        .replace(/[^a-z0-9]/gi, '')
                        .replace(/iphone\s*13/g, 'iphone13')
                        .replace(/iphone\s*12/g, 'iphone12')
                        .trim();
                }

                const generateColors = (num) => {
                    const colors = [];
                    for (let i = 0; i < num; i++) {
                        const hue = (i * 137.508) % 360;
                        colors.push(`hsl(${hue}, 65%, 55%)`);
                    }
                    return colors;
                };

                let allProductsBarChart;

                function renderChartForYear(selectedYear) {
                    const monthlyProductMap = {};

                    allOrders.forEach(order => {
                        if (order.order_status !== 'completed') return;

                        let createdAt;
                        if (order.created_at.includes('-') && order.created_at.split('-')[0].length === 2) {
                            const [day, month, yearShort] = order.created_at.split('-');
                            const year = parseInt(yearShort, 10) + 2000;
                            createdAt = new Date(`${year}-${month}-${day}`);
                        } else {
                            createdAt = new Date(order.created_at);
                        }

                        const year = createdAt.getFullYear();
                        if (year !== selectedYear) return;

                        const month = createdAt.toLocaleString('default', {
                            month: 'short'
                        });
                        const alias = getAlias(order.product_name);
                        const qty = parseInt(order.quantity);

                        if (!monthlyProductMap[month]) monthlyProductMap[month] = {};
                        if (!monthlyProductMap[month][alias]) monthlyProductMap[month][alias] = 0;
                        monthlyProductMap[month][alias] += qty;
                    });

                    const allProductsMonthly = {};
                    Object.keys(monthlyProductMap).forEach(month => {
                        for (const product in monthlyProductMap[month]) {
                            if (!allProductsMonthly[product]) allProductsMonthly[product] = Array(12).fill(0);
                            const monthIndex = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                            ].indexOf(month);
                            allProductsMonthly[product][monthIndex] = monthlyProductMap[month][product];
                        }
                    });

                    const productNames = Object.keys(allProductsMonthly);
                    const colors = generateColors(productNames.length);

                    const seriesData = productNames.map((product, index) => ({
                        name: product,
                        data: allProductsMonthly[product],
                        color: colors[index]
                    }));

                    if (allProductsBarChart) {
                        allProductsBarChart.updateSeries(seriesData);
                    } else {
                        allProductsBarChart = new ApexCharts(chartContainer, {
                            chart: {
                                type: 'bar',
                                height: 500,
                                stacked: false,
                                toolbar: {
                                    show: true
                                },
                                zoom: {
                                    enabled: true
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '75%'
                                }
                            },
                            colors: colors,
                            dataLabels: {
                                enabled: false
                            },
                            xaxis: {
                                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                ],
                                labels: {
                                    style: {
                                        fontSize: '12px',
                                        fontWeight: 600
                                    }
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'All products sold'
                                }
                            },
                            legend: {
                                position: 'bottom',
                                fontSize: '13px'
                            },
                            tooltip: {
                                shared: true,
                                intersect: false,
                                custom: function({
                                    series,
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    const month = w.globals.labels[dataPointIndex];
                                    const tooltipItems = [];
                                    w.config.series.forEach((s, i) => {
                                        const qty = s.data[dataPointIndex];
                                        if (qty > 0) {
                                            tooltipItems.push({
                                                name: s.name,
                                                qty,
                                                color: w.config.colors[i]
                                            });
                                        }
                                    });
                                    tooltipItems.sort((a, b) => b.qty - a.qty);
                                    let tooltipHtml =
                                        `<div style="padding: 10px; font-size: 14px;"><strong>${month}</strong><br/>`;
                                    tooltipItems.forEach(t => {
                                        tooltipHtml += `<div style="margin: 4px 0;">
                                    <span style="width:10px;height:10px;background:${t.color};display:inline-block;border-radius:50%;margin-right:6px;"></span>
                                    <span style="font-weight:bold;color:${t.color};">${t.name}</span>
                                    <span style="color:#555;"> - ${t.qty} unit${t.qty > 1 ? 's' : ''}</span>
                                    </div>`;
                                    });
                                    return tooltipHtml + `</div>`;
                                }
                            },
                            series: seriesData
                        });
                        allProductsBarChart.render();
                    }
                }

                fetch("https://ecommers.shop/api/CustomerOrder")
                    .then(res => res.json())
                    .then(response => {
                        allOrders = response.data;

                        const years = new Set();
                        allOrders.forEach(order => {
                            let createdAt;
                            if (order.created_at.includes('-') && order.created_at.split('-')[0].length ===
                                2) {
                                const [day, month, yearShort] = order.created_at.split('-');
                                const year = parseInt(yearShort, 10) + 2000;
                                createdAt = new Date(`${year}-${month}-${day}`);
                            } else {
                                createdAt = new Date(order.created_at);
                            }
                            years.add(createdAt.getFullYear());
                        });

                        const sortedYears = Array.from(years).sort((a, b) => b - a);
                        sortedYears.forEach(y => {
                            const opt = document.createElement("option");
                            opt.value = y;
                            opt.textContent = y;
                            yearFilter.appendChild(opt);
                        });

                        yearFilter.addEventListener("change", () => {
                            renderChartForYear(parseInt(yearFilter.value));
                        });

                        if (sortedYears.length > 0) {
                            yearFilter.value = sortedYears[0];
                            renderChartForYear(sortedYears[0]);
                        }
                    });
            });
        </script> --}}


        {{-- All refused products --}}





        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const yearFilter = document.getElementById("yearFilter4");
                let barChart = null;
                const productAliasMap = {};

                const getAlias = name => {
                    const normalized = normalizeProductName(name);
                    if (productAliasMap[normalized]) return productAliasMap[normalized];
                    productAliasMap[normalized] = name.trim();
                    return productAliasMap[normalized];
                };

                function normalizeProductName(name) {
                    return name
                        .toLowerCase()
                        .replace(/\s+/g, '')
                        .replace(/[^a-z0-9]/gi, '')
                        .replace(/iphone\s*13/g, 'iphone13')
                        .replace(/iphone\s*12/g, 'iphone12')
                        .trim();
                }

                function generateColors(count) {
                    const baseColors = [
                        '#4f46e5', '#0ea5e9', '#22c55e', '#f97316', '#e11d48',
                        '#14b8a6', '#6366f1', '#84cc16', '#facc15', '#7c3aed',
                        '#dc2626', '#06b6d4', '#9333ea', '#10b981', '#f43f5e'
                    ];
                    while (baseColors.length < count) {
                        baseColors.push('#' + Math.floor(Math.random()*16777215).toString(16));
                    }
                    return baseColors.slice(0, count);
                }

                function loadChartData(selectedYear = 'all') {
    fetch("https://ecommers.shop/api/CustomerOrder")
        .then(res => res.json())
        .then(response => {
            const orders = response.data;

            const monthlyRefusedMap = {
                January: {}, February: {}, March: {}, April: {}, May: {}, June: {},
                July: {}, August: {}, September: {}, October: {}, November: {}, December: {}
            };

            const monthMapShortToFull = {
                Jan: 'January', Feb: 'February', Mar: 'March', Apr: 'April',
                May: 'May', Jun: 'June', Jul: 'July', Aug: 'August',
                Sep: 'September', Oct: 'October', Nov: 'November', Dec: 'December'
            };

            orders.forEach(order => {
                if (order.order_status === 'refused') {
                    let createdAt;
                    if (order.created_at.includes('-') && order.created_at.split('-')[0].length === 2) {
                        const [day, month, yearShort] = order.created_at.split('-');
                        const year = parseInt(yearShort, 10) + 2000;
                        createdAt = new Date(`${year}-${month}-${day}`);
                    } else {
                        createdAt = new Date(order.created_at);
                    }

                    const year = createdAt.getFullYear().toString();
                    if (selectedYear !== 'all' && year !== selectedYear) return;

                    const shortMonth = createdAt.toLocaleString('default', { month: 'short' });
                    const fullMonth = monthMapShortToFull[shortMonth];
                    if (!fullMonth) return;

                    const productName = getAlias(order.product_name || 'Unknown');
                    if (!monthlyRefusedMap[fullMonth][productName]) {
                        monthlyRefusedMap[fullMonth][productName] = 0;
                    }

                    monthlyRefusedMap[fullMonth][productName] += parseFloat(order.quantity) || 0;
                }
            });

            const allRefusedProductsMonthly = {};
            Object.keys(monthlyRefusedMap).forEach(month => {
                for (const product in monthlyRefusedMap[month]) {
                    if (!allRefusedProductsMonthly[product])
                        allRefusedProductsMonthly[product] = Array(12).fill(0);
                    const monthIndex = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ].indexOf(month);
                    allRefusedProductsMonthly[product][monthIndex] = monthlyRefusedMap[month][product];
                }
            });

            const refusedProductNames = Object.keys(allRefusedProductsMonthly);
            const refusedColors = generateColors(refusedProductNames.length);

            const refusedSeriesData = refusedProductNames.map((product, index) => ({
                name: product,
                data: allRefusedProductsMonthly[product],
                color: refusedColors[index]
            }));

            if (barChart) barChart.destroy();

            barChart = new ApexCharts(document.querySelector("#AllRefusedProductsBarChart"), {
                chart: {
                    type: 'bar',
                    height: 500,
                    stacked: false,
                    toolbar: { show: true },
                    zoom: { enabled: true }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '75%'
                    }
                },
                colors: refusedColors,
                dataLabels: { enabled: false },
                xaxis: {
                    categories:["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                    ],
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 600
                        }
                    }
                },
                yaxis: {
                    title: { text: 'Refused Products' }
                },
                legend: {
                    position: 'bottom',
                    fontSize: '13px'
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                        const month = w.globals.labels[dataPointIndex];
                        const tooltipItems = [];

                        w.config.series.forEach((s, i) => {
                            const qty = s.data[dataPointIndex];
                            if (qty > 0) {
                                const color = w.config.colors[i];
                                tooltipItems.push({ name: s.name, qty, color });
                            }
                        });

                        tooltipItems.sort((a, b) => b.qty - a.qty);

                        let tooltipHtml = `
                            <div style="padding: 10px; font-size: 14px; line-height: 1.5;">
                                <strong style="font-size: 15px;">${month}</strong><br/>`;

                        tooltipItems.forEach(t => {
                            tooltipHtml += `
                                <div style="margin: 4px 0;">
                                    <span style="display: inline-block; width: 10px; height: 10px; background-color: ${t.color}; border-radius: 50%; margin-right: 6px;"></span>
                                    <span style="font-weight: bold; color: ${t.color};">${t.name}</span>
                                    <span style="color: #555;"> - ${t.qty} unit${t.qty > 1 ? 's' : ''}</span>
                                </div>`;
                        });

                        tooltipHtml += `</div>`;
                        return tooltipHtml;
                    }
                },
                series: refusedSeriesData
            });

            barChart.render();
        });
}

                // تحميل البيانات عند فتح الصفحة
                loadChartData(yearFilter.value);

                // تحميل البيانات حسب السنة المختارة
                yearFilter.addEventListener("change", function () {
                    const selectedYear = yearFilter.value;
                    console.log("Selected year:", selectedYear); // للتأكد من أن القيمة تُلتقط
                    loadChartData(selectedYear);
                });
            });
            </script>


{{-- top5Products  --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const yearFilter = document.getElementById("yearFilter4"); // فلتر السنة
        const pieChartEl = document.querySelector("#pieChart");

        let barChart = null;
        let pieChart = null;

        const productAliasMap = {};
        const getAlias = name => {
            const normalized = normalizeProductName(name);
            if (productAliasMap[normalized]) return productAliasMap[normalized];
            productAliasMap[normalized] = name.trim();
            return productAliasMap[normalized];
        };

        function normalizeProductName(name) {
            return name
                .toLowerCase()
                .replace(/\s+/g, '')
                .replace(/[^a-z0-9]/gi, '')
                .replace(/iphone\s*13/g, 'iphone13')
                .replace(/iphone\s*12/g, 'iphone12')
                .trim();
        }

        const generateColors = (num) => {
            const colors = [];
            for (let i = 0; i < num; i++) {
                const hue = (i * 137.508) % 360;
                colors.push(`hsl(${hue}, 65%, 55%)`);
            }
            return colors;
        };

        // دالة لتحميل البيانات بناءً على السنة المختارة
        function loadChartData(selectedYear = 'all') {
            fetch("https://ecommers.shop/api/CustomerOrder")
                .then(res => res.json())
                .then(response => {
                    const orders = response.data;

                    if (pieChart) pieChart.destroy();

                    const productUnits = {};
                    orders.forEach(order => {
                        if (order.order_status === "completed") {
                            let createdAt;
                            if (order.created_at.includes('-') && order.created_at.split('-')[0].length === 2) {
                                const [day, month, yearShort] = order.created_at.split('-');
                                const year = parseInt(yearShort, 10) + 2000;
                                createdAt = new Date(`${year}-${month}-${day}`);
                            } else {
                                createdAt = new Date(order.created_at);
                            }

                            const year = createdAt.getFullYear().toString();
                            if (selectedYear !== 'all' && year !== selectedYear) return; // فلترة حسب السنة

                            const product = normalizeProductName(order.product_name);
                            const qty = parseInt(order.quantity);
                            if (!productUnits[product]) productUnits[product] = 0;
                            productUnits[product] += qty;
                        }
                    });

                    // ترتيب المنتجات حسب الـ units واختيار أول 5
                    const top5ProductsByUnits = Object.entries(productUnits)
                        .sort((a, b) => b[1] - a[1])
                        .slice(0, 5);

                    const pieLabelsUnits = top5ProductsByUnits.map(item => getAlias(item[0]));
                    const pieDataUnits = top5ProductsByUnits.map(item => item[1]);

                    pieChart = new ApexCharts(pieChartEl, {
                        chart: {
                            type: 'pie',
                            height: 400,
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800
                            }
                        },
                        labels: pieLabelsUnits,
                        series: pieDataUnits,
                        legend: {
                            position: 'bottom',
                            fontSize: '14px',
                            fontWeight: 600
                        },
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontSize: '14px',
                                fontWeight: 'bold'
                            },
                            formatter: val => `${val.toFixed(1)}%`
                        },
                        tooltip: {
                            y: {
                                formatter: val => `${val} units`
                            }
                        },
                        colors: ['#1E90FF', '#FF6347', '#32CD32', '#FFD700', '#BA55D3']
                    });

                    pieChart.render();
                });
        }

        // تحميل البيانات عند فتح الصفحة
        loadChartData(yearFilter.value);

        // تحميل البيانات حسب السنة المختارة
        yearFilter.addEventListener("change", function () {
            const selectedYear = yearFilter.value;
            console.log("Selected year:", selectedYear); // للتأكد من أن القيمة تُلتقط
            loadChartData(selectedYear);
        });

    });
</script>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const notifIcon = document.getElementById("notifToggle");

                notifIcon?.addEventListener("click", function() {
                    fetch("/clear-warning", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({})
                    }).then(() => {
                        // امسح البادج من الواجهة
                        const badge = notifIcon.querySelector(".position-absolute");
                        if (badge) badge.remove();
                    });
                });
            });
        </script>




    @endsection
 