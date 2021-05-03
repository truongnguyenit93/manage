<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::query();
        if ($request->search) {
            $search = $request->search;
            $products->where('name', "%{$search}%")
                ->orWhere('transportation_fee', $search)
                ->orWhere('funds', $search)
                ->orWhere('interest', $search);
        }
        $products = $products->orderBy('id', 'DESC')->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $except = ['_token'];
            $request = request();
            $cleanup = $request->except($except);
            if ($request->hasFile('image')) {
                $cleanup['image'] = $this->upload($request);
            }
            $cleanup['created_at'] = Carbon::now();

            Products::insert([$cleanup]);

            return redirect(route('products.index'));
        } catch (\Throwable $th) {
            return redirect(back())->with('error', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Products::find($id);
            $except = ['_token', '_method'];
            $request = request();
            $cleanup = $request->except($except);
            
            if ($request->hasFile('image')) {
                $productImage = str_replace('/storage', '', $product->image);
                Storage::delete('/public' . $productImage);
                $product->image = $this->upload($request);
            }
            $product->name = $cleanup['name'];
            $product->product_type = $cleanup['product_type'];
            $product->transportation_fee = $cleanup['transportation_fee'];
            $product->funds = $cleanup['funds'];
            $product->interest = $cleanup['interest'];
            $product->name_fb_customer = $cleanup['name_fb_customer'];
            $product->customer_type = $cleanup['customer_type'];
            $product->description = $cleanup['description'];
            $product->save();

            return redirect(route('products.index'));
        } catch (\Throwable $th) {
            return redirect(back())->with('error', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::destroy($id);

        return redirect(route('products.index'));
    }

    /**
     * Upload the image
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function upload($request)
    {
        $image = $request->file('image');
        // Make a image name based on user name and current timestamp
        $name = Str::slug($request->input('name')).'_'.time();
        // Define folder path
        $folder = '/uploads/images/';
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();

        $this->uploadOne($image, $folder, 'public', $name);

        return $filePath;
    }
}
