@extends('layouts.dashboard.app')

@section('title',__('dashboard.orders'))

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.orders') }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-lg-8">
        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-4">
                        <h3 class="mb-0">{{ __('dashboard.orders') }}</h3>
                    </div>
                    <div class="col-8 row">
                        <form action="{{ route('dashboard.orders.index') }}" method="get"
                            class="row col-12">
                            <input type="text" name="search" class="form-control form-control-alternative col-8 mr-2"
                                style="background:#f8f9fe" value="{{ request()->search }}"
                                placeholder="@lang('dashboard.search')" />
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search mx-1"></i>
                                @lang('dashboard.search')</button>
                        </form>
                    </div>
                </div>
            </div>
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('dashboard.name') }}</th>
                                <th scope="col">{{ __('dashboard.price') }}</th>
                                <th scope="col">{{ __('dashboard.date') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index=>$order)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $order->client->name }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td class="text-right">
                                        <button data-url="{{route('dashboard.orders.show',$order->id)}}" data-method="get" class="btn btn-info btn-sm rounded-circle btn-show-order" data-toggle="tooltip" data-original-title="{{ __('dashboard.show') }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        @if(auth()->user()->can('update_orders'))
                                            <a href="{{ route('dashboard.clients.orders.edit',[$order->client->id,$order->id]) }}"
                                                class="btn btn-warning btn-sm rounded-circle" data-toggle="tooltip"
                                                data-original-title="{{ __('dashboard.edit') }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-warning btn-sm rounded-circle disabled"
                                                data-toggle="tooltip"
                                                data-original-title="{{ __('dashboard.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                        <form
                                            action="{{ route('dashboard.orders.destroy',$order->id) }}"
                                            method="post" style="display:inline-block">
                                            @csrf
                                            @method('delete')
                                            @if(auth()->user()->can('delete_orders'))
                                                <button type="submit" class="btn btn-danger btn-sm rounded-circle"
                                                    data-toggle="tooltip"
                                                    data-original-title="{{ __('dashboard.delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-danger btn-sm rounded-circle disabled" disabled
                                                    data-toggle="tooltip"
                                                    data-original-title="{{ __('dashboard.delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        {{ $orders->appends(request()->except('page'))->render() }}
                    </nav>
                </div>
            @else
                <h3>@lang('dashboard.data_not_found')</h3>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-lg-4">
        <div class="card shadow pb-3">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{__('dashboard.show').' '.__('dashboard.orders')}}</h3>                            
                    </div>
                </div>
            </div>
            <div id="show-product">

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('dashboard_files/assets/js/product.js')}}"></script>
@endsection
