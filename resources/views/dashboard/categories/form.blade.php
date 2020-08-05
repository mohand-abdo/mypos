@csrf
@foreach (config('translatable.locales') as $locale)
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="{{$locale}}[name]">{{__('dashboard.'.$locale.'.name')}}</label>
            <input type="text" id="{{$locale}}[name]" name="{{$locale}}[name]" class="form-control form-control-alternative" placeholder="{{__('dashboard.'.$locale.'.name')}}" value="{{old($locale.'.name') ?? $category->name}}">
            </div>
        </div>
    </div>
@endforeach