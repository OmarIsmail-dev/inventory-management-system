//delete 

  
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
  },
  buttonsStyling: false
});
swalWithBootstrapButtons.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel!",
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire({
      title: "Cancelled",
      text: "Your imaginary file is safe :)",
      icon: "error"
    });
  }
});

















//


<div class="container-fluid">     
        {{-- Charts Section --}}
        <div class="row g-4 mb-4">
            {{-- Bar Chart --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Bar Chart</h5>
                    </div>
                    <div class="card-body">
                        <div id="barChart" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
    
            {{-- Pie Chart --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Pie Chart</h5>
                    </div>
                    <div class="card-body">
                        <div id="pieChart" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>  

        {{-- Cards Section --}}
        <div class="row g-4 mb-4">
            {{-- Total Customers --}}
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between">
                            <div>
                                <span class="avatar avatar-md avatar-rounded bg-primary">
                                    <i class="ti ti-users fs-16"></i>
                                </span>
                            </div>
                            <div class="flex-fill ms-3">
                                <p class="text-muted mb-0">Total Customers</p>
                                <h4 class="fw-semibold mt-1">1,02,890</h4>
                                <p class="mb-0 text-success fw-semibold mt-2">+40%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Total Revenue --}}
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between">
                            <div>
                                <span class="avatar avatar-md avatar-rounded bg-secondary">
                                    <i class="ti ti-wallet fs-16"></i>
                                </span>
                            </div>
                            <div class="flex-fill ms-3">
                                <p class="text-muted mb-0">Total Revenue</p>
                                <h4 class="fw-semibold mt-1">$56,562</h4>
                                <p class="mb-0 text-success fw-semibold mt-2">+25%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Conversion Ratio --}}
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between">
                            <div>
                                <span class="avatar avatar-md avatar-rounded bg-success">
                                    <i class="ti ti-wave-square fs-16"></i>
                                </span>
                            </div>
                            <div class="flex-fill ms-3">
                                <p class="text-muted mb-0">Conversion Ratio</p>
                                <h4 class="fw-semibold mt-1">12.08%</h4>
                                <p class="mb-0 text-danger fw-semibold mt-2">-12%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Total Deals --}}
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between">
                            <div>
                                <span class="avatar avatar-md avatar-rounded bg-warning">
                                    <i class="ti ti-briefcase fs-16"></i>
                                </span>
                            </div>
                            <div class="flex-fill ms-3">
                                <p class="text-muted mb-0">Total Deals</p>
                                <h4 class="fw-semibold mt-1">2,543</h4>
                                <p class="mb-0 text-success fw-semibold mt-2">+19%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    
            let barChart = null;
            let pieChart = null;
    
            function renderCharts() {
                // Destroy old charts if exist
                if (barChart) {
                    barChart.destroy();
                }
                if (pieChart) {
                    pieChart.destroy();
                }
    
                // Bar Chart
                const barOptions = {
                    chart: {
                        type: 'bar',
                        height: 250
                    },
                    series: [{
                        name: 'Sales',
                        data: [30, 40, 45, 50, 49, 60]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                    }
                };
    
                barChart = new ApexCharts(document.querySelector("#barChart"), barOptions);
                barChart.render();
    
                // Pie Chart
                const pieOptions = {
                    chart: {
                        type: 'pie',
                        height: 250
                    },
                    series: [44, 55, 13, 33],
                    labels: ['Product A', 'Product B', 'Product C', 'Product D']
                };
    
                pieChart = new ApexCharts(document.querySelector("#pieChart"), pieOptions);
                pieChart.render();
            }
    
            // أول تحميل
            renderCharts();
    
            // إعادة الرسم عند فتح أو غلق المينيو
            document.querySelectorAll('.menu-toggle, .sidebar-toggle').forEach(btn => {
                btn.addEventListener('click', () => {
                    setTimeout(() => {
                        renderCharts();
                    }, 500); // ندي وقت للأنيميشن
                });
            });
    
             window.addEventListener('resize', () => {
                setTimeout(() => {
                    renderCharts();
                }, 300);
            });
        });
    </script>


SELECT p.name AS product_name, SUM(o.quantity) AS total_quantity_sold FROM orders o JOIN products p ON o.product_id = p.id WHERE o.order_status = 'completed' AND MONTH(o.created_at) = 4 AND YEAR(o.created_at) = 2025 GROUP BY p.name ORDER BY total_quantity_sold DESC;

