@extends('layouts.dashboard.app')

@section('title',__('dashboard.add').' '.__('dashboard.order'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}">{{__('dashboard.orders')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.add')}}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        @include('dashboard.partial.error')
        <div class="col-12">
            <div class="alert alert-danger d-none alert-custom">@lang('dashboard.stock_must_greater_than_zerro')</div>
        </div>
        <div class="col-xs-12 col-lg-6">        
            <div class="card shadow pb-3">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="mb-0">{{__('dashboard.categories')}}</h3>                            
                        </div>
                    </div>
                </div>
                @forelse ($categories as $category)
                    <a class="btn btn-primary mb-2" data-toggle="collapse" href="#{{ str_replace(' ','-',$category->name).'-'.$category->id}}" role="button"aria-expanded="false" aria-controls="{{$category->name.'-'.$category->id}}">{{$category->name}}</a>
                    <div class="collapse" id="{{ str_replace(' ','-',$category->name).'-'.$category->id}}"> 
                        @if ($category->products()->count() > 0)
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('dashboard.name') }}</th>
                                            <th scope="col">{{ __('dashboard.stock') }}</th>
                                            <th scope="col">{{ __('dashboard.price') }}</th>
                                            <th scope="col">{{ __('dashboard.add') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="product-list">
                                        @foreach ($category->products as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td class="stock-{{$product->id}} qty">{{$product->stock}}</td>
                                                <td>{{$product->sale_price}}</td>
                                                <td><a href="" class="btn btn-success btn-sm fa fa-plus btn-add-product rounded-circle" id="product-{{$product->id}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->sale_price}}" data-qty="{{$product->stock}}"></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @lang('dashboard.data_not_found')
                        @endif                
                        
                    </div>
                @empty
                    @lang('dashboard.data_not_found')
                @endforelse
            </div>
        </div>
        <div class="col-xs-12 col-lg-6">        
            <div class="card shadow pb-3 mb-3">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('dashboard.orders')}}</h3>                            
                        </div>
                    </div>
                </div>
                <form action="{{route('dashboard.clients.orders.store',$client->id)}}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{__('dashboard.name')}}</th>
                                    <th scope="col">{{__('dashboard.stock')}}</th>
                                    <th scope="col">{{__('dashboard.price')}}</th>
                                    <th scope="col">@lang('dashboard.delete')</th>
                                </tr>
                            </thead>
                            <tbody class="body-list">
                            </tbody>
                        </table>
                    </div>
                    <h3 class="mt-3">المجــموع : <span class="total-price">0</span></h3>
                    <button type="submit" class="btn btn-primary btn-block disabled btn-form-product">@lang('dashboard.add')</button>
                </form>
            </div>
            @if ($orders->count() > 0)
                <div class="card shadow pb-3">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h3 class="mb-0">{{__('dashboard.history_orders')}}</h3>                            
                            </div>
                        </div>
                    </div>
                    @foreach ($orders as $order)
                        <a class="btn btn-primary mb-2" data-toggle="collapse" href="#order-{{$order->id}}" role="button"aria-expanded="false" aria-controls="{{$order->id}}">{{ date('j-M-Y',strtotime($order->created_at))}}</a>
                        <div class="collapse" id="order-{{$order->id}}"> 
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('dashboard.name') }}</th>
                                            <th scope="col">{{ __('dashboard.stock') }}</th>
                                            <th scope="col">{{ __('dashboard.price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->pivot->quantity}}</td>
                                                <td>{{$product->sale_price}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>             
                        </div>
                    @endforeach
                </div>  
            @endif
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('dashboard_files/assets/js/plugins/jquery-number/jquery.number.min.js')}}"></script>
<script src="{{asset('dashboard_files/assets/js/product.js')}}"></script>
@endsection