@extends('layouts.dashboard.app')

@section('title','name of site')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.home') }}</li>
        </ol>
    </nav>
@endsection

@section('statices')
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('dashboard.users')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$users}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('dashboard.products')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$products}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('dashboard.orders')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{!empty($orders->price)?$orders->price:'0'}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('dashboard.clients')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$clients}}</span>
                                    </div> 
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart" >
                        <!-- Chart wrapper -->
                        <canvas id="chart-sales" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Charts
        //

        'use strict';

        //
        // Sales chart
        //

        var SalesChart = (function() {

        // Variables

        var $chart = $('#chart-sales');


        // Methods

        function init($chart) {

            var salesChart = new Chart($chart, {
            type: 'line',
            options: {
                scales: {
                yAxes: [{
                    gridLines: {
                    lineWidth: 1,
                    color: Charts.colors.gray[900],
                    zeroLineColor: Charts.colors.gray[900]
                    },
                    ticks: {
                    callback: function(value) {
                        if (!(value % 10)) {
                        return '$' + value ;
                        }
                    }
                    }
                }]
                },
                tooltips: {
                callbacks: {
                    label: function(item, data) {
                    var label = data.datasets[item.datasetIndex].label || '';
                    var yLabel = item.yLabel;
                    var content = '';

                    if (data.datasets.length > 1) {
                        content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                    }

                    content += '<span class="popover-body-value">$' + yLabel + 'k</span>';
                    return content;
                    }
                }
                }
            },
            data: {
                        labels: ['Jun','Feb','Mar','Apr' ,'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                        label: 'Performance',
                        data: [
                            @foreach($charts as $chart)
                                @if(is_array($chart))
                                    {{ $chart['price']}},
                                @else
                                    {{$chart}},
                                @endif
                            @endforeach
                        ]
                        }],
                    }
            });

            // Save to jQuery object

            $chart.data('chart', salesChart);

        };


        // Events

        if ($chart.length) {
            init($chart);
        }

})();










    </script>
@endsection

