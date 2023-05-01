<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <base href="/">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/dist/css/adminlte.min.css') }}">
  <style>
    body{
            font-family: 'Open Sans', sans-serif;
        }
        #signUpForm {
            max-width: 500px;
        }
        #signUpForm .form-header .stepIndicator.active {
            font-weight: 600;
        }
        #signUpForm .form-header .stepIndicator.finish {
            font-weight: 600;
            color: #5a67d8;
        }
        #signUpForm .form-header .stepIndicator::before {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            z-index: 9;
            width: 20px;
            height: 20px;
            background-color: #c3dafe;
            border-radius: 50%;
            border: 3px solid #ebf4ff;
        }
        #signUpForm .form-header .stepIndicator.active::before {
            background-color: #a3bffa;
            border: 3px solid #c3dafe;
        }
        #signUpForm .form-header .stepIndicator.finish::before {
            background-color: #5a67d8;
            border: 3px solid #c3dafe;
        }
        #signUpForm .form-header .stepIndicator::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 8px;
            width: 100%;
            height: 3px;
            background-color: #f3f3f3;
        }
        #signUpForm .form-header .stepIndicator.active::after {
            background-color: #a3bffa;
        }
        #signUpForm .form-header .stepIndicator.finish::after {
            background-color: #5a67d8;
        }
        #signUpForm .form-header .stepIndicator:last-child:after {
            display: none;
        }
        #signUpForm input.invalid {
            border: 2px solid #ffaba5;
        }
        #signUpForm .step {
          display: none;
        }
    /* Position search bar to the right side of the page */
    .search-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 10px;
    }

    /* Style search bar */
    .search-container input[type=text] {
        padding: 3px;
        margin-top: 3px;
        font-size: 15px;
        border: none;
        border-bottom: 1px solid #ccc;
    }

    /* Style search bar placeholder */
    .search-container input[type=text]::placeholder {
        color: #aaa;
    }
</style>

<!-- tailwind css -->
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" />
<!-- google font -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="\css\tailwind.css">
    <link rel="stylesheet" href="\css\index.css">
    <link rel="stylesheet" href="\css\all.min.css">
</head>
<body class="hold-transition sidebar-mini control-sidebar-slide-open layout-navbar-fixed layout-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <div class="search-container">
    <input type="text" id="search" placeholder="Search...">
</div>

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> Account
          
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          
        @if(\Request::is('admin/*') && Auth::guard('admin')->check())

           @include('layouts.admin-topMenus')

        @elseif(\Request::is('user/*') && Auth::guard('web')->check())

           @include('layouts.user-topMenus')

        @elseif(\Request::is('doctor/*') && Auth::guard('doctor')->check())

           @include('layouts.doctor-topMenus')

         @endif
         

        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-dark-olive">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
    <i class="nav-icon fas fa-home"></i>
      <span class="brand-text font-weight-light">Home </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-3.1.0/dist/img/3d-illustration-person-with-sunglasses_23-2149436188.avif') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">
            @if(\Request::is('admin/*') && Auth::guard('admin')->check())
                   {{ Auth::guard('admin')->user()->name }}
            @elseif(\Request::is('user/*') && Auth::guard('web')->check())
                  {{ \Auth::guard('web')->user()->name }}
            @elseif(\Request::is('doctor/*') && Auth::guard('doctor')->check())
                  {{ \Auth::guard('doctor')->user()->name }}
            @endif
          
          </a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          @if(\Request::is('admin/*') && Auth::guard('admin')->check())

               @include('layouts.admin-sideMenus')

          @elseif(\Request::is('user/*') && Auth::guard('web')->check())

               @include('layouts.user-sideMenus')

          @elseif(\Request::is('doctor/*') && Auth::guard('doctor')->check())

               @include('layouts.doctor-sideMenus')

          @endif
         
        

        </ul>
      </nav>
      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.1.0/dist/js/adminlte.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      charset="utf-8"
    ></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script type="text/javascript">
      /* Make dynamic date appear */
      (function () {
        if (document.getElementById("get-current-year")) {
          document.getElementById("get-current-year").innerHTML =
            new Date().getFullYear();
        }
      })();
      /* Sidebar - Side navigation menu on mobile/responsive mode */
      function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("bg-white");
        document.getElementById(collapseID).classList.toggle("m-2");
        document.getElementById(collapseID).classList.toggle("py-3");
        document.getElementById(collapseID).classList.toggle("px-6");
      }
      /* Function for dropdowns */
      function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
          element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
          placement: "bottom-start"
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
      }

      (function () {
        /* Chart initialisations */
        /* Line Chart */
        var config = {
          type: "line",
          data: {
            labels: [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July"
            ],
            datasets: [
              {
                label: new Date().getFullYear(),
                backgroundColor: "#4c51bf",
                borderColor: "#4c51bf",
                data: [65, 78, 66, 44, 56, 67, 75],
                fill: false
              },
              {
                label: new Date().getFullYear() - 1,
                fill: false,
                backgroundColor: "#fff",
                borderColor: "#fff",
                data: [40, 68, 86, 74, 56, 60, 87]
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            title: {
              display: false,
              text: "Sales Charts",
              fontColor: "white"
            },
            legend: {
              labels: {
                fontColor: "white"
              },
              align: "end",
              position: "bottom"
            },
            tooltips: {
              mode: "index",
              intersect: false
            },
            hover: {
              mode: "nearest",
              intersect: true
            },
            scales: {
              xAxes: [
                {
                  ticks: {
                    fontColor: "rgba(255,255,255,.7)"
                  },
                  display: true,
                  scaleLabel: {
                    display: false,
                    labelString: "Month",
                    fontColor: "white"
                  },
                  gridLines: {
                    display: false,
                    borderDash: [2],
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.3)",
                    zeroLineColor: "rgba(0, 0, 0, 0)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2]
                  }
                }
              ],
              yAxes: [
                {
                  ticks: {
                    fontColor: "rgba(255,255,255,.7)"
                  },
                  display: true,
                  scaleLabel: {
                    display: false,
                    labelString: "Value",
                    fontColor: "white"
                  },
                  gridLines: {
                    borderDash: [3],
                    borderDashOffset: [3],
                    drawBorder: false,
                    color: "rgba(255, 255, 255, 0.15)",
                    zeroLineColor: "rgba(33, 37, 41, 0)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2]
                  }
                }
              ]
            }
          }
        };
        var ctx = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(ctx, config);

        /* Bar Chart */
        config = {
          type: "bar",
          data: {
            labels: [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July"
            ],
            datasets: [
              {
                label: new Date().getFullYear(),
                backgroundColor: "#ed64a6",
                borderColor: "#ed64a6",
                data: [30, 78, 56, 34, 100, 45, 13],
                fill: false,
                barThickness: 8
              },
              {
                label: new Date().getFullYear() - 1,
                fill: false,
                backgroundColor: "#4c51bf",
                borderColor: "#4c51bf",
                data: [27, 68, 86, 74, 10, 4, 87],
                barThickness: 8
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            title: {
              display: false,
              text: "Orders Chart"
            },
            tooltips: {
              mode: "index",
              intersect: false
            },
            hover: {
              mode: "nearest",
              intersect: true
            },
            legend: {
              labels: {
                fontColor: "rgba(0,0,0,.4)"
              },
              align: "end",
              position: "bottom"
            },
            scales: {
              xAxes: [
                {
                  display: false,
                  scaleLabel: {
                    display: true,
                    labelString: "Month"
                  },
                  gridLines: {
                    borderDash: [2],
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.3)",
                    zeroLineColor: "rgba(33, 37, 41, 0.3)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2]
                  }
                }
              ],
              yAxes: [
                {
                  display: true,
                  scaleLabel: {
                    display: false,
                    labelString: "Value"
                  },
                  gridLines: {
                    borderDash: [2],
                    drawBorder: false,
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.2)",
                    zeroLineColor: "rgba(33, 37, 41, 0.15)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2]
                  }
                }
              ]
            }
          }
        };
        ctx = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(ctx, config);
      })();
    </script>



    <script>
    // Get the coverage amount input field and the policy type select element
    var coverageAmountInput = document.getElementById('coverage_amount');
    var policyTypeSelect = document.getElementById('policy_id');

    // Add event listener to the policy type select element
    policyTypeSelect.addEventListener('change', function() {
        var selectedOption = policyTypeSelect.options[policyTypeSelect.selectedIndex];
        var maxCoverageAmount = selectedOption.getAttribute('data-max-coverage');
        var coverageRate = selectedOption.getAttribute('data-coverage-rate');

        // Calculate coverage values based on the coverage rate
        var coverage35 = Math.round(maxCoverageAmount * 0.35);
        var coverage65 = Math.round(maxCoverageAmount * 0.65);
        var coverage100 = maxCoverageAmount;

        // Set button values and click event listeners
        document.getElementById('coverage_button_35').innerText = '35% (' + coverage35 + ')';
        document.getElementById('coverage_button_35').addEventListener('click', function() {
            coverageAmountInput.value = coverage35;
        });

        document.getElementById('coverage_button_65').innerText = '65% (' + coverage65 + ')';
        document.getElementById('coverage_button_65').addEventListener('click', function() {
            coverageAmountInput.value = coverage65;
        });

        document.getElementById('coverage_button_100').innerText = '100% (' + coverage100 + ')';
        document.getElementById('coverage_button_100').addEventListener('click', function() {
            coverageAmountInput.value = coverage100;
        });
    });
</script>

<script>
    // Get the coverage amount input field and the policy type select element for Edit Client modal
    var coverageAmountInput1 = document.getElementById('1coverage_amount');
    var policyTypeSelect1 = document.getElementById('1policy_id');

    // Add event listener to the policy type select element for Edit Client modal
    policyTypeSelect1.addEventListener('change', function() {
        var selectedOption1 = policyTypeSelect1.options[policyTypeSelect1.selectedIndex];
        var maxCoverageAmount1 = selectedOption1.getAttribute('data-max-coverage');
        var coverageRate1 = selectedOption1.getAttribute('data-coverage-rate');

        // Calculate coverage values based on the coverage rate
        var coverage351 = Math.round(maxCoverageAmount1 * 0.35);
        var coverage651 = Math.round(maxCoverageAmount1 * 0.65);
        var coverage1001 = maxCoverageAmount1;

        // Set button values and click event listeners
        document.getElementById('1coverage_button_35').innerText = '35% (' + coverage351 + ')';
        document.getElementById('1coverage_button_35').addEventListener('click', function() {
            coverageAmountInput1.value = coverage351;
        });

        document.getElementById('1coverage_button_65').innerText = '65% (' + coverage651 + ')';
        document.getElementById('1coverage_button_65').addEventListener('click', function() {
            coverageAmountInput1.value = coverage651;
        });

        document.getElementById('1coverage_button_100').innerText = '100% (' + coverage1001 + ')';
        document.getElementById('1coverage_button_100').addEventListener('click', function() {
            coverageAmountInput1.value = coverage1001;
        });
    });
</script>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }
        
        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("step");
          // Exit the function if any field in the current tab is invalid:
          if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("signUpForm").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }
        
        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("step");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }
        
        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("stepIndicator");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }
  </script>
    
</body>
</html>
