@extends('products.layout')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
<div class="row" style="margin-top: 50px;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Unit:</strong>
                <select name="unit" id="unit" class="form-control">
                    <option value="Qty">Qty</option>
                    <option value="Ltr">Ltr</option>
                    <option value="KG">KG</option>
                    <option value="Meter">Meter</option>
                  </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                <input type="text" name="category" class="form-control" placeholder="Category">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="text" name="price" id="price" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Discount Percentage:</strong>
                <input type="text" name="percentage" id="percentage" class="form-control" placeholder="Discount Percentage">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Discount Amount:</strong>
                <input type="text" name="discount" id="discount" class="form-control" placeholder="Amount">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Discount Start Date:</strong>
                <input type="text" name="start_date" class="form-control" placeholder="Start Date">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Discount End Date:</strong>
                <input type="text" name="end_date" class="form-control" placeholder="End Date">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax Percentage:</strong>
                <input type="text" name="tax_percentage" id="tax_percentage" class="form-control" placeholder="Tax Percentage">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax Amount:</strong>
                <input type="text" name="tax_amount" id="tax_amount" class="form-control" placeholder="Amount">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Net Price:</strong>
                <input type="text" name="net_price" id="net_price" class="form-control" placeholder="Amount">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Stock:</strong>
                <input type="text" name="stock" class="form-control" placeholder="Stock">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Images:</strong>
                <input type="file" name="product_image[]" class="form-control" placeholder="image" multiple>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
<script>
    $(document).ready(function () {
        function calculateDiscount() {
            var price = parseFloat($('#price').val());
            var percentage = parseFloat($('#percentage').val());

            if (!isNaN(price) && !isNaN(percentage)) {
                var discountAmount = (price * percentage) / 100;
                $('#discount').val(discountAmount.toFixed(2));
            }
        }

        function calculateTax() {
            var price = parseFloat($('#price').val());
            var discount = parseFloat($('#discount').val());
            var taxPercentage = parseFloat($('#tax_percentage').val());

            if (!isNaN(price) && !isNaN(discount) && !isNaN(taxPercentage)) {
                var discountedPrice = price - discount;
                var taxAmount = (discountedPrice * taxPercentage) / 100;
                $('#tax_amount').val(taxAmount.toFixed(2));
            }
        }

        function calculateNetPrice() {
            var price = parseFloat($('#price').val());
            var discount = parseFloat($('#discount').val());
            var taxAmount = parseFloat($('#tax_amount').val());

            if (!isNaN(price) && !isNaN(discount) && !isNaN(taxAmount)) {
                var netPrice = (price - discount) + taxAmount;
                $('#net_price').val(netPrice.toFixed(2));
            }
        }

        $('#percentage').on('input', function () {
            calculateDiscount();
            calculateTax();
            calculateNetPrice();
        });

        $('#tax_percentage').on('input', function () {
            calculateTax();
            calculateNetPrice();
        });
    });
</script>
