@extends('layouts.dashboard.app')

@section('title',__('dashboard.users'))

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{__('dashboard.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.users')}}</li>
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
                            <h3 class="mb-0">{{__('dashboard.users')}}</h3>                            
                        </div>
                        <div class="col-8 row">
                            <form action="{{route('dashboard.users.index')}}" method="get" class="row col-12">
                            <input type="text" name="search" class="form-control form-control-alternative col-8 mr-2" value="{{request('search')}}" style="background:#f8f9fe" placeholder="@lang('dashboard.search')" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search mx-1"></i> @lang('dashboard.search')</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('dashboard.first_name')}}</th>
                                    <th scope="col">{{__('dashboard.last_name')}}</th>
                                    <th scope="col">{{__('dashboard.email')}}</th>
                                    <th scope="col">{{__('dashboard.status')}}</th>
                                    <th scope="col">{{__('dashboard.image')}}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index=>$user)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                            <i class="{{ $user->status == __('dashboard.active')?'bg-success':'bg-warning'}}"></i> {{$user->status}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="{{$user->first_name.' '.$user->last_name}}">
                                            <img alt="Image placeholder" src="{{ $user->image_path }}" class="rounded-circle">
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            @if (auth()->user()->can('update_users'))
                                                <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-warning btn-sm rounded-circle" data-toggle="tooltip" data-original-title="{{__('dashboard.edit')}}">
                                                    <i class="fa fa-user-edit"></i>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-warning btn-sm rounded-circle disabled" disabled data-toggle="tooltip" data-original-title="{{__('dashboard.edit')}}">
                                                    <i class="fa fa-user-edit"></i>
                                                </a>
                                            @endif
                                            <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post" style="display:inline-block">
                                                @csrf
                                                @method('delete')
                                                @if (auth()->user()->can('delete_users'))
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
                            {{ $users->appends(request()->except('page'))->render() }}
                        </nav>
                    </div>
                @else
                    <h3>@lang('dashboard.data_not_found')</h3>
                @endif
            </div>
        </div>
    </div>
@endsection