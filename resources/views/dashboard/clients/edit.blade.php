@extends('layouts.dashboard.app')

@section('title',__('dashboard.edit').' '.__('dashboard.clients'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}">{{__('dashboard.clients')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.edit').' '.__('dashboard.clients')}}</li>
        </ol>
    </nav>
@endsection

@section('content')
  <div class="col order-xl-1">
    @include('dashboard.partial.error')
    <div class="card bg-secondary shadow">
      <div class="card-header bg-white border-0">
      <h3 class="mb-0">{{__('dashboard.edit').' '.__('dashboard.clients')}}</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="{{route('dashboard.clients.update',$client->id)}}">
          @method('PATCH')
          <h6 class="heading-small text-muted mb-4">{{__('dashboard.edit').' '.__('dashboard.data').' '.$client->name }}</h6>
          <div class="pl-lg-4">
            @include('dashboard.clients.form')
            <button type="submit" class="btn btn-primary btn-md">{{__('dashboard.update')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection