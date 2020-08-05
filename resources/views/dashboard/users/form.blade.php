@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="first_name">{{__('dashboard.first_name')}}</label>
            <input type="text" id="first_name" name="first_name" class="form-control form-control-alternative" placeholder="{{__('dashboard.first_name')}}" value="{{old('first_name') ?? $user->first_name}}">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="last_name">{{__('dashboard.last_name')}}</label>
            <input type="text" id="last_name" name="last_name" class="form-control form-control-alternative" placeholder="{{__('dashboard.last_name')}}" value="{{old('last_name') ?? $user->last_name}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="email">{{__('dashboard.email')}}</label>
            <input type="email" id="email" name="email" class="form-control form-control-alternative" placeholder="{{__('dashboard.email')}}" value="{{old('email') ?? $user->email}}">
        </div>
    </div>
</div>
<div class="row">
    @if ($user->id =='')
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="password">{{__('dashboard.password')}}</label>
                <input type="password" id="password" name="password" class="form-control form-control-alternative" placeholder="{{__('dashboard.password')}}" >
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="password_confirmation">{{__('dashboard.password_confirmation')}}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-alternative" placeholder="{{__('dashboard.password_confirmation')}}">
            </div>
        </div>
    @endif
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label" for="status">{{__('dashboard.status')}}</label>
            <select id="status" class="form-control form-control-alternative" name="status">
                @foreach (status() as $key=>$status)
                    <option class="form-control form-control-alternative" value="{{ $key }}" {{ old('status') == $key?'selected':'' }}  {{ $user->status == $status ? 'selected' : '' }}>{{$status}}</option>  
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label" for="image">{{__('dashboard.image')}}</label>
            <input type="file" id="image" name="image" class="form-control form-control-alternative image">
        </div>
        @if ($user->image != '')
            <img src="{{asset('dashboard_files/assets/upload/user_images/'.$user->image)}}" id="image-preview" style="width:100px;margin-bottom:1.5rem"/>
        @else
            <img src="{{asset('dashboard_files/assets/upload/user_images/default.png')}}" id="image-preview" style="width:100px;margin-bottom:1.5rem"/>
        @endif
    </div>
</div>

@if (auth()->user()->can('create_permissions'))
    <hr class="my-4" />
    <!-- permission -->
    @php
        $models = ['users','categories','products','clients','orders'];
        $maps   = ['create','read','update','delete'];
    @endphp

    <label class="form-control-label" for="permission">{{__('dashboard.permission')}}</label>
    <div class="tab">
        <ul class="d-flex flex-column d-lg-block">
            @foreach ($models as $index => $model)
                <li id="{{$model}}" class="btn {{$index==0?'active':''}}">{{ __('dashboard.'.$model) }}</li>
            @endforeach
        </ul>

        @foreach ($models as $model)
            <div id="{{$model}}-content">
                @foreach ($maps as $index => $map)
                    <label for="{{$map.'_'.$model}}" class="mx-3 checkbox">
                        <input type="checkbox" id="{{$map.'_'.$model}}"  name="permission[]" value="{{$map.'_'.$model}}"{{ $user->can($map.'_'.$model)?'checked':''}}>
                        <span>@lang('dashboard.'.$map)</span>
                    </label>
                @endforeach
            </div>
        @endforeach
    </div>
@endif
<hr class="my-4" />
    