@extends('layouts.dashboard.app')

@section('title',__('dashboard.clients'))

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.clients') }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col">
        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-4">
                        <h3 class="mb-0">{{ __('dashboard.clients') }}</h3>
                    </div>
                    <div class="col-8 row">
                        <form action="{{ route('dashboard.clients.index') }}" method="get"
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
            @if($clients->count() > 0)
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('dashboard.name') }}</th>
                                <th scope="col">{{ __('dashboard.phone') }}</th>
                                <th scope="col">{{ __('dashboard.address') }}</th>
                                <th scope="col">{{ __('dashboard.address') }}</th>
                                <th scope="col">@lang('dashboard.add') @lang('dashboard.order')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $index=>$client)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ implode($client->phone ,'-') }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>
                                        @if (auth()->user()->can('create_orders'))
                                            <a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-info btn-sm">@lang('dashboard.add') @lang('dashboard.order')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled" disabled>@lang('dashboard.add') @lang('dashboard.order')</a>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if(auth()->user()->can('update_clients'))
                                            <a href="{{ route('dashboard.clients.edit',$client->id) }}"
                                                class="btn btn-warning btn-sm rounded-circle" data-toggle="tooltip"
                                                data-original-title="{{ __('dashboard.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-warning btn-sm rounded-circle disabled"
                                                data-toggle="tooltip"
                                                data-original-title="{{ __('dashboard.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                        <form
                                            action="{{ route('dashboard.clients.destroy',$client->id) }}"
                                            method="post" style="display:inline-block">
                                            @csrf
                                            @method('delete')
                                            @if(auth()->user()->can('delete_clients'))
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
                        {{ $clients->appends(request()->except('page'))->render() }}
                    </nav>
                </div>
            @else
                <h3>@lang('dashboard.data_not_found')</h3>
            @endif
        </div>
    </div>
</div>
@endsection
