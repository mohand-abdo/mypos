@extends('layouts.dashboard.app')

@section('title',__('dashboard.add').' '.__('dashboard.products'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">{{__('dashboard.products')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.add')}}</li>
        </ol>
    </nav>
@endsection

@section('content')
  <div class="col order-xl-1">
    @include('dashboard.partial.error')
    <div class="card bg-secondary shadow">
      <div class="card-header bg-white border-0">
      <h3 class="mb-0">{{__('dashboard.add').' '.__('dashboard.product')}}</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="{{route('dashboard.products.store')}}" enctype="multipart/form-data">
         {{--  <h6 class="heading-small text-muted mb-4">{{__('dashboard.add').' '.__('dashboard.product').' '.__('dashboard.new')}}</h6> --}}
          <div class="pl-lg-4">
            @include('dashboard.products.form')
            <button type="submit" class="btn btn-primary btn-md">{{__('dashboard.save')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
