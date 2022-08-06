@extends('admin.layouts.my')

@section('content')
			<div class="page-content">

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            
            <div class="row flex-grow">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">{{ __('Users') }}</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2" id="get-user">00</h3>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                      <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">{{ __('Accounts') }}</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2" id="get-accounts" >00</h3>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">{{ __('Address') }}</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2" id="get-address">00</h3>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">{{ __('Weekly Report') }}</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton4">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">{{ __('Statics') }}</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">{{ __('Print') }}</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">{{ __('Download') }}</span></a>
                    </div>
                  </div>
                </div>
                <div class="row align-items-start mb-2">
                  <div class="col-md-7">
                  <p class="text-muted mb-4">{{ __('Sales are activities related to selling or the number of goods or services sold in a given time period.') }}</p>
                  </div>
                  <div class="col-md-5 d-flex justify-content-md-end">
                    <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                      <button type="button" data-type="bar" class="btn btn-primary chart_change">{{ __('Bar') }}</button>
                      <button type="button" data-type="line" class="btn btn-outline-primary chart_change">{{ __('Line') }}</button>
                    </div>
                  </div>
                </div>
                <div class="monthly-sales-chart-wrapper">
                  <canvas id="monthly-sales-chart"></canvas>
                </div>
              </div> 
            </div>
          </div>
          <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">{{ __('Weekly Tickets') }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

			</div>
      @include('layouts.footer')
  @endsection
  @section('create-chart')
  <script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
  <script src="{{asset('assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <script>
    $(document).ready(function(){
        callback();
    });
    var type = 'bar';
    var gridLineColor = 'rgba(77, 138, 240, .1)';
    var colors = {
      primary:         "#f8cf40",
      secondary:       "#7987a1",
      success:         "#42b72a",
      info:            "#68afff",
      warning:         "#fbbc06",
      danger:          "#ff3366",
      light:           "#ececec",
      dark:            "#282f3a",
      muted:           "#686868"
    }
    var countusers = $('#get-user');
    var countaccounts = $('#get-accounts');
    var countaddress = $('#get-address');
    
    function callback() {

      $.ajax({
        url:'{{ route('admin.chart.create') }}',
        type: 'post',
        dataType:'json',
        success: function(json) {
          if(json.status) {
            countusers.html(json.user);
            countaddress.html(json.address);
            countaccounts.html(json.account);
            // Apex chart1 start
            if($('#apexChart1').length) {
              var options1 = {
                chart: {
                  type: "line",
                  height: 60,
                  sparkline: {
                    enabled: !0
                  }
                },
                series: [{
                    data: json.userDaily
                }],
                stroke: {
                  width: 2,
                  curve: "smooth"
                },
                markers: {
                  size: 0
                },
                colors: [colors.info],
                tooltip: {
                  fixed: {
                    enabled: !1
                  },
                  x: {
                    show: !1
                  },
                  y: {
                    title: {
                      formatter: function(e) {
                        return 'Daily User Register: '
                      }
                    }
                  },
                  marker: {
                    show: 1
                  }
                }
              };
              new ApexCharts(document.querySelector("#apexChart1"),options1).render();
            }
            // Apex chart2 start
            if($('#apexChart2').length) {
              var options2 = {
                chart: {
                  type: "bar",
                  height: 60,
                  sparkline: {
                    enabled: !0
                  }
                },
                series: [{
                    data: json.accountDaily
                }],
                stroke: {
                  width: 2,
                  curve: "smooth"
                },
                markers: {
                  size: 0
                },
                colors: [colors.info],
                tooltip: {
                  fixed: {
                    enabled: !1
                  },
                  x: {
                    show: !1
                  },
                  y: {
                    title: {
                      formatter: function(e) {
                        return 'Daily Account: '
                      }
                    }
                  },
                  marker: {
                    show: 1
                  }
                }
              };
              new ApexCharts(document.querySelector("#apexChart2"),options2).render();
            }
            // Apex chart2 start
            if($('#apexChart3').length) {
              var options3 = {
                chart: {
                  type: "line",
                  height: 60,
                  sparkline: {
                    enabled: !0
                  }
                },
                series: [{
                    data: json.addressDaily
                }],
                stroke: {
                  width: 2,
                  curve: "smooth"
                },
                markers: {
                  size: 0
                },
                colors: [colors.info],
                tooltip: {
                  fixed: {
                    enabled: !1
                  },
                  x: {
                    show: !1
                  },
                  y: {
                    title: {
                      formatter: function(e) {
                        return 'Daily Address: '
                      }
                    }
                  },
                  marker: {
                    show: 1
                  }
                }
              };
              new ApexCharts(document.querySelector("#apexChart3"),options3).render();
            }
            // Monthly sales chart start
            if($('#monthly-sales-chart').length) {
              var monthlySalesChart = document.getElementById('monthly-sales-chart').getContext('2d');
                new Chart(monthlySalesChart, {
                  type: type,
                  data: {
                    labels: json.tickets_bar.days,
                    datasets: [
                      {
                        label: '{{__('Normal priority') }}',
                        data: json.tickets_bar.normalTickets,
                        backgroundColor: colors.primary
                      },
                      {
                        label: '{{ __('Urgent priority') }}',
                        data: json.tickets_bar.urgentTickets,
                        backgroundColor: colors.danger
                      },
                      {
                        label: '{{ __('High priority') }}',
                        data: json.tickets_bar.hightTickets,
                        backgroundColor: colors.success
                      },
                      {
                        label: '{{ __('Active issues') }}',
                        data: json.tickets_bar.dailyActiveTickets,
                        backgroundColor: colors.info
                      },
                      {
                        label: '{{ __('Closed issues') }}',
                        data: json.tickets_bar.dailyCloseTickets,
                        backgroundColor: colors.dark
                      }
                  
                  ]
                  },
                  options: {
                    maintainAspectRatio: false,
                    legend: {
                      display: true,
                        labels: {
                          display: true
                        }
                    },
                    scales: {
                      xAxes: [{
                        display: true,
                        barPercentage: .3,
                        categoryPercentage: .6,
                        gridLines: {
                          display: false
                        },
                        ticks: {
                          fontColor: '#8392a5',
                          fontSize: 10
                        }
                      }],
                      yAxes: [{
                        gridLines: {
                          color: gridLineColor
                        },
                        ticks: {
                          fontColor: '#8392a5',
                          fontSize: 10,
                          min: 0,
                          max: json.tickets.weekTickets
                        }
                      }]
                    }
                  }
                }
              );
            }
            // Monthly sales chart end
          }
        },
        error: function(xhr,error) {

        }
      });
    }
  </script>
  @endsection

