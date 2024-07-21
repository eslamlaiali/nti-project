<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function index()
    {
        //
        $products = Product::where("isAgreed" , "!=" , 0)->get();
        $notAgreedProducts = Product::where('isAgreed', '=' , 0)->get();
        return view('dashboard.products.index',[
            'products' => $products,
            'notAgreedProducts' => $notAgreedProducts,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('dashboard.products.create', [
            'categories' => $categories,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'productName' => 'required',
            'productDescription' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'photo' => 'required',
        ]);

        $image = $request->file('photo');
        $imageName = time() . $request->photo->getClientOriginalName();
        $image->move(public_path('XproductImage'), $imageName);

        $product = new Product();

        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->photo = $imageName;
        $product->member_id = Session::get('userId');

        if ($request->isActive == null) {
            $product->isActive = 0;
        }else{
            $product->isActive = 1;
        }

        $product->save();

        return redirect()->route('product.index')
                        ->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $category = Category::where("id" , "=" , $product->category_id)->first();
        return view('dashboard.products.show',[
            'product' => $product,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if ($product->member_id != Session::get('userId')){
            Session::flush();
            return redirect()->route('login')->with("failed", "Login Failed");
        }
        $categories = Category::all();
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'productName' => 'required',
            'productDescription' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'photo' => 'mimes:png,jpg,bmp',
        ]);

        if ($request->photo != null) {
            unlink(public_path('XproductImage') . '/' . $product->photo);
            $image = $request->file('photo');
            $imageName = time() . $request->photo->getClientOriginalName();
            $image->move(public_path('XproductImage'), $imageName);
            $product->photo = $imageName;
        }



        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if ($request->isActive == null) {
            $product->isActive = 0;
        }else{
            $product->isActive = 1;
        }

        $product->update();

        return redirect()->route('product.index')
                        ->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->member_id != Session::get('userId')){
            Session::flush();
            return redirect()->route('login')->with("failed", "Login Failed");
        }
        unlink(public_path('XproductImage') . '/' . $product->photo);
        $product->delete();

        return redirect()->route('product.index')
                        ->with('success','Product deleted successfully.');
    }

    public function isActive(Product $product)
    {
        if ($product->member_id != Session::get('userId')){
            Session::flush();
            return redirect()->route('login')->with("failed", "Login Failed");
        }
        if($product->isActive == 0){
            $product->isActive = 1;
        }
        else{
            $product->isActive = 0;
        }

        $product->save();
        return redirect()->route('product.index')
                        ->with('success','Product Active Status Changed successfully');
    }

    public function showIsAgree(){
        $products = Product::where('isAgreed', '=', 0)->get();
        return view('dashboard.products.agree',[
            'products' => $products,
        ]);
    }
    public function agree(Product $product){

        $product->isAgreed = 1;

        $product->save();
        return redirect()->route('product.index')
                        ->with('success','Product Agreed successfully');
    }
}
