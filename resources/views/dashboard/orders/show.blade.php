<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('dashboard.name') }}</th>
                <th scope="col">{{ __('dashboard.stock') }}</th>
                <th scope="col">{{ __('dashboard.price') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index=>$product)
                <tr>
                    <th scope="row">{{ $index+1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->quantity * $product->sale_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
