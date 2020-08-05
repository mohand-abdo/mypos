@extends('layouts.dashboard.app')

@section('title',__('dashboard.edit').' '.__('dashboard.categories'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">{{__('dashboard.categories')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.edit').' '.__('dashboard.categories')}}</li>
        </ol>
    </nav>
@endsection

@section('content')
  <div class="col order-xl-1">
    @include('dashboard.partial.error')
    <div class="card bg-secondary shadow">
      <div class="card-header bg-white border-0">
      <h3 class="mb-0">{{__('dashboard.edit').' '.__('dashboard.categories')}}</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="{{route('dashboard.categories.update',$category->id)}}">
          @method('PATCH')
          <h6 class="heading-small text-muted mb-4">{{__('dashboard.edit').' '.__('dashboard.data').' '.$category->name }}</h6>
          <div class="pl-lg-4">
            @include('dashboard.categories.form')
            <button type="submit" class="btn btn-primary btn-md">{{__('dashboard.update')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection