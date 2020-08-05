@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="category_id">{{__('dashboard.category_id')}}</label>
            <select class="form-control form-control-alternative" id="category_id" name="category_id">
                <option class="form-control form-control-alternative" value="">@lang('dashboard.all categories')</option>
                @foreach ($categories as $index => $category)
                
                    <option class="form-control form-control-alternative" value="{{$category->id}}" {{ $category->id == old('category_id')?'selected':''}} {{  $category->id == $product->category_id?'selected':''  }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


@foreach (config('translatable.locales') as $locale)
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="{{$locale}}[name]">{{__('dashboard.'.$locale.'.name')}}</label>
            <input type="text" id="{{$locale}}[name]" name="{{$locale}}[name]" class="form-control form-control-alternative" placeholder="{{__('dashboard.'.$locale.'.name')}}" value="{{old($locale.'.name') ?? $product->name}}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="{{$locale}}[desc]">{{__('dashboard.'.$locale.'.desc')}}</label>
            <textarea id="{{$locale}}[desc]" name="{{$locale}}[desc]" class="form-control form-control-alternative" placeholder="{{__('dashboard.'.$locale.'.desc')}}">{{old($locale.'.desc') ?? $product->desc}}</textarea>
            </div>
        </div>
    </div>
@endforeach
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="image">{{__('dashboard.image')}}</label>
            <input type="file" id="image" name="image" class="form-control form-control-alternative image" placeholder="{{__('dashboard.image')}}">
        </div>
         @if ($product->image != '')
            <img src="{{asset('dashboard_files/assets/upload/product_images/'.$product->image)}}" id="image-preview" style="width:100px;margin-bottom:1.5rem"/>
        @else
            <img src="{{asset('dashboard_files/assets/upload/product_images/default.png')}}" id="image-preview" style="width:100px;margin-bottom:1.5rem"/>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="purches_price">{{__('dashboard.purches_price')}}</label>
        <input type="number" step="0.01" id="purches_price" name="purches_price" class="form-control form-control-alternative" placeholder="{{__('dashboard.purches_price')}}" value="{{old('purches_price') ?? $product->purches_price}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="sale_price">{{__('dashboard.sale_price')}}</label>
        <input type="number" step="0.01" id="sale_price" name="sale_price" class="form-control form-control-alternative" placeholder="{{__('dashboard.sale_price')}}" value="{{old('sale_price') ?? $product->sale_price}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-control-label" for="stock">{{__('dashboard.stock')}}</label>
        <input type="text" id="stock" name="stock" class="form-control form-control-alternative" placeholder="{{__('dashboard.stock')}}" value="{{old('stock') ?? $product->stock}}">
        </div>
    </div>
</div>