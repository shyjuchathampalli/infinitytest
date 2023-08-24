@extends('products.layout')

@section('content')
    <div class="row" style="margin-top: 50px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>PRODUCTS</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Product ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Unit</th>
            <th>Category</th>
            <th>Price</th>
            <th>Discount Percentage</th>
            <th>Tax Percentage</th>
            <th>Net Price</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->product_id }}</td>
            <td>

                @foreach(explode(', ', $product->images) as $imageId)
                @php
                    $image = App\Models\File::find($imageId);
                @endphp
                @if ($image)
                <img src="{{ asset($image->file_path) }}" style="height: 50px; width:50px;" alt="Product Image">
                @endif
                @endforeach

            </td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->unit_type }}</td>
            <td>{{ $product->product_category }}</td>
            <td>{{ $product->product_pricey }}</td>
            <td>{{ $product->discount_percentage }}</td>
            <td>{{ $product->tax_percentage }}</td>
            <td>{{ $product->net_price }}</td>
        </tr>
        @endforeach
    </table>

    {!! $products->links() !!}

@endsection
