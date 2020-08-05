@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="name">{{__('dashboard.name')}}</label>
        <input type="text" id="name" name="name" class="form-control form-control-alternative" placeholder="{{__('dashboard.name')}}" value="{{old('name') ?? $client->name}}">
        </div>
    </div>
</div>

@for ($i = 0; $i < 2; $i++)
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
            <label class="form-control-label" for="phone-{{$i}}">{{__('dashboard.phone')}}</label>
            <input type="text"  name="phone[]" class="form-control form-control-alternative" placeholder="{{__('dashboard.phone')}}" value="{{ old('phone.'.$i) ?? $client->phone[$i]??''}}">
            </div>
        </div>
    </div>
@endfor

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="address">{{__('dashboard.address')}}</label>
        <textarea id="address" name="address" class="form-control form-control-alternative" placeholder="{{__('dashboard.address')}}">{{old('address') ?? $client->address}}</textarea>
        </div>
    </div>
</div>