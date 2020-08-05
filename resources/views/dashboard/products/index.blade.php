@extends('layouts.dashboard.app')

@section('title',__('dashboard.products'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.products')}}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col">        
            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    {{session('message')}}
                </div>
            @endif
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <h3 class="mb-0">{{__('dashboard.products')}}</h3>                            
                        </div>
                        <div class="col-8 row">
                            <form action="{{route('dashboard.products.index')}}" method="get" class="row col-12">
                                <input type="text" name="search" class="form-control form-control-alternative col-4 mr-2" style="background:#f8f9fe" value="{{request()->search}}" placeholder="@lang('dashboard.search')" />
                                <select  name="category_id" class="form-control form-control-alternative col-4 mr-2" style="background:#f8f9fe"  placeholder="@lang('dashboard.search')">
                                    <option value="">@lang('dashboard.all categories')</option>
                                    @foreach ($categories as $index => $category)
                                        <option value="{{$category->id}}" {{old('category_id') == $index?'selected':'' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search mx-1"></i> @lang('dashboard.search')</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($products->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('dashboard.name')}}</th>
                                    <th scope="col">{{__('dashboard.desc')}}</th>
                                    <th scope="col">{{__('dashboard.image')}}</th>
                                    <th scope="col">{{__('dashboard.purches_price')}}</th>
                                    <th scope="col">{{__('dashboard.sale_price')}}</th>
                                    <th scope="col">{{__('dashboard.stock')}}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index=>$product)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->desc}}</td>
                                        <td>
                                            <div class="avatar-group">
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="{{$product->name}}">
                                            <img alt="Image placeholder" src="{{$product->image_path}}" class="rounded-circle">
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{intWithStyle($product->purches_price)}}</td>
                                        <td>{{intWithStyle($product->sale_price)}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td class="text-right">
                                            @if (auth()->user()->can('update_products'))
                                                <a href="{{route('dashboard.products.edit',$product->id)}}" class="btn btn-warning btn-sm rounded-circle" data-toggle="tooltip" data-original-title="{{__('dashboard.edit')}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-warning btn-sm rounded-circle disabled" data-toggle="tooltip" data-original-title="{{__('dashboard.edit')}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                            <form action="{{route('dashboard.products.destroy',$product->id)}}" method="post" style="display:inline-block">
                                                @csrf
                                                @method('delete')
                                                @if (auth()->user()->can('delete_products'))
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-circle" data-toggle="tooltip" data-original-title="{{__('dashboard.delete')}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger btn-sm rounded-circle disabled" disabled data-toggle="tooltip" data-original-title="{{__('dashboard.delete')}}">
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
                            {{ $products->appends(request()->except('page'))->render() }}
                        </nav>
                    </div>
                @else
                    <h3>@lang('dashboard.data_not_found')</h3>
                @endif
            </div>
        </div>
    </div>
@endsection