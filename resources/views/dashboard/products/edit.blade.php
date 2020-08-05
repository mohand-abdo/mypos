@extends('layouts.dashboard.app')

@section('title',__('dashboard.edit').' '.__('dashboard.products'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">{{__('dashboard.products')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.edit').' '.__('dashboard.products')}}</li>
        </ol>
    </nav>
@endsection

@section('content')
  <div class="col order-xl-1">
    @include('dashboard.partial.error')
    <div class="card bg-secondary shadow">
      <div class="card-header bg-white border-0">
      <h3 class="mb-0">{{__('dashboard.edit').' '.__('dashboard.products')}}</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="{{route('dashboard.products.update',$product->id)}}" enctype="multipart/form-data">
          @method('PATCH')
          <h6 class="heading-small text-muted mb-4">{{__('dashboard.edit').' '.__('dashboard.data').' '.$product->name }}</h6>
          <div class="pl-lg-4">
            @include('dashboard.products.form')
            <button type="submit" class="btn btn-primary btn-md">{{__('dashboard.update')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection