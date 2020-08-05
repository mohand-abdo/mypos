@extends('layouts.dashboard.app')

@section('title',__('dashboard.edit').' '.__('dashboard.order'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}">{{__('dashboard.orders')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.edit')}}</li>
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
            <div class="card shadow">
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
                                        @foreach ($category->products as $index=>$product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td class="stock-{{$product->id}} qty">{{$product->stock}}</td>
                                                <td>{{$product->sale_price}}</td>
                                                <td><a  href="#" 
                                                        class="btn btn-sm fa fa-plus rounded-circle btn-add-product {{in_array($product->id,$order->products->pluck('id')->toArray())?'btn-white disabled':'btn-success'}}" 
                                                        id="product-{{$product->id}}" 
                                                        data-id="{{$product->id}}" 
                                                        data-name="{{$product->name}}" 
                                                        data-price="{{$product->sale_price}}" 
                                                        data-qty="{{in_array($product->id,$order->products->pluck('id')->toArray())?$product->stock + $order->products->toArray()[$index]['pivot']['quantity']:$product->stock}}">
                                                    </a>
                                                </td>
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
            {{-- list of orders --}}
            <div class="card shadow pb-3 mb-3">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('dashboard.orders')}}</h3>                            
                        </div>
                    </div>
                </div>
                <form action="{{route('dashboard.clients.orders.update',['order'=>$order->id ,'client'=>$client->id])}}" method="post">
                    @csrf
                    @method('PATCH')
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
                                @foreach ($order->products as $product)
                                    <tr class="row-{{ $product->id }}">
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <input type="number" name="products[{{ $product->id }}][quantity]" class="form-control form-control-alternative input-sm input-qty input-val" min="1" value="{{ $product->pivot->quantity }}" data-price="{{ $product->sale_price }}" data-id="{{ $product->id }}" data-qty="{{ $product->stock + $product->pivot->quantity }}"/>
                                        </td>
                                        <td class="price">{{ $product->sale_price * $product->pivot->quantity }}</td>
                                        <td>
                                            <a  href="#" 
                                                class="btn btn-danger btn-sm fa fa-trash rounded-circle btn-remove-product" 
                                                id="{{ $product->id }}" 
                                                data-qty="{{ $product->stock + $product->pivot->quantity }}">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h3 class="mt-3">المجــموع : <span class="total-price">{{ $order->total_price }}</span></h3>
                    <button type="submit" class="btn btn-primary btn-block btn-form-product disabled">@lang('dashboard.print')</button>
                </form>
            </div>

            {{-- history orders for this client --}}
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