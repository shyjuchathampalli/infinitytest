<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\File;

use App\Rules\MinimumImageCount;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index',compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'unit'=>'required',
            'category'=>'required',
            'price'=>'required',
            'percentage'=>'required',
            'discount'=>'required',
            'start_date'=>'required|date|date_format:Y-m-d',
            'end_date'=>'required|date|date_format:Y-m-d|after:start_date',
            'tax_percentage'=>'required',
            'tax_amount'=>'required',
            'net_price'=>'required',
            'product_image'=> ['required','array', new MinimumImageCount(3)],
            'stock'=>'required',
        ]);

        $randomString = Str::random(4);
        $productID = 'PROD'.$randomString;

        $images = [];
        $list_allowed = array('jpg','png','jpeg','gif');

        if($request->hasFile('product_image'))
        {
            foreach($request->file('product_image') as $file)
            {

                if(in_array($file->extension(), $list_allowed))
                {

                $name = $request->name.time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('files'), $name);

                $image_id = File::create([
                    'name' => $name,
                    'file_path' => 'files/'.$name
                 ]);

                 $images[] = $image_id->id;

                }
            }
        }

        $images = implode(', ', $images);
        $images = json_encode($images);

        $product = new Product;
        $product->product_name = $request->name;
        $product->unit_type = $request->unit;
        $product->product_category = $request->category;
        $product->product_price = $request->price;
        $product->discount_percentage = $request->percentage;
        $product->discount_amount = $request->discount;
        $product->discount_start_date = $request->start_date;
        $product->discount_end_date = $request->end_date;
        $product->tax_percentage = $request->tax_percentage;
        $product->tax_amount = $request->tax_amount;
        $product->net_price = $request->net_price;
        $product->stock_quantity = $request->stock;
        $product->product_id = $productID;
        $product->images = $images;

        $product->save();

        return redirect()->route('products.index')->with('success','Product has been created successfully.');

    }


}
