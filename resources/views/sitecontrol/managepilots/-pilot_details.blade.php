@include($_directory . "_common_header")

<div class="row g-5 g-xxl-8">

    <div class="col-xl-12">

        <div class="card-header border-0 pt-6">

            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black" />
                        </svg>
                    </span>
                    <input type="text" data-kt-user-table-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Search Flight History" />
                </div>

            </div>



        </div>



        <div class="card mb-5 mb-xxl-8">

            <div class="card-body pb-0">

                <div class="">

                    <table class="table align-middle table-row-dashed fs-6 gy-5 datatable ">

                        <thead>

                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="">Flight Number</th>
                                <th class="">Aircraft</th>
                                <th class="">Airport Depart</th>
                                <th class="">Airport Arrive</th>
                                <th class="">Flight Time</th>
                                <th class="">Status</th>

                            </tr>

                        </thead>


                        <tbody class="text-gray-600 fw-bold">
                            @foreach ($table_record->get() as $result)
                            <tr>

                                <td>{!! $result->flight_number !!}</td>

                                <td>{!! $result->aircraft_name !!}</td>


                                <td>{!! GeneralHelper::format_date( $result->airport_depart, "d-m-Y") !!}</td>
                                <td>{!! GeneralHelper::format_date( $result->airport_arrive, "d-m-Y") !!}</td>

                                <td>{!! GeneralHelper::format_date( $result->flight_time, "H:i A") !!}</td>

                                <td>{!! DropdownHelper::YesNo_dropdown($result->status) !!}</td>

                            </tr>

                            @endforeach
                        </tbody>

                    </table>


                </div>






            </div>

        </div>


    </div>


    <!-- <div class="col-xl-4">

        <div class="card mb-5 mb-xxl-8">

            <div class="card-header border-0 pt-5">

                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Aircrafts</span>
                    <!-- <span class="text-muted fw-bold fs-7">More than 400 new members</span> -->
                </h3>


                <div class="card-toolbar">

                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">



                    </button>



                </div>

            </div>


            <div class="card-body">

                <div id="kt_charts_widget_80_chart" style="height: 350px"></div>



            </div>

        </div>


    </div> -->

</div>

@section("script")

<script>
$(document).ready(function(){
    
    
    var initChartsWidget80 = function() {
        var element = document.getElementById("kt_charts_widget_80_chart");
        
        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');
        
        if (!element) {
            return;
        }
        
        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58]
            }, {
                name: 'Revenue',
                data: [76, 85, 101, 98, 87, 105]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                                    borderRadius: 4
                                },
                            },
                            legend: {
                                show: false
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                show: true,
                                width: 2,
                                colors: ['transparent']
                            },
                            xaxis: {
                                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false
                                },
                                labels: {
                                    style: {
                                        colors: labelColor,
                                        fontSize: '12px'
                                    }
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: labelColor,
                                        fontSize: '12px'
                                    }
                                }
                            },
                            fill: {
                                opacity: 1
                            },
                            states: {
                                normal: {
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                },
                                hover: {
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                },
                                active: {
                                    allowMultipleDataPointsSelection: false,
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                }
                            },
                            tooltip: {
                                style: {
                                    fontSize: '12px'
                                },
                                y: {
                                    formatter: function (val) {
                                        return "$" + val + " thousands"
                                    }
                                }
                            },
                            colors: [baseColor, secondaryColor],
                            grid: {
                                borderColor: borderColor,
                                strokeDashArray: 4,
                                yaxis: {
                                    lines: {
                                        show: true
                                    }
                                }
                            }
                        };
                        
                        var chart = new ApexCharts(element, options);
                        chart.render();      
                        
                        
                        
                        
                    }
                    
                    
                                        // initChartsWidget80();

    });
                
</script>
@endsection