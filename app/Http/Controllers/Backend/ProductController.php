<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'productBrand')->get();

        return view('backend.sections.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $product_brands = ProductBrand::all();

        return view('backend.sections.products.create', compact('categories', 'product_brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:191', 'unique:products,name'],
            'description' => ['required'],
            'price' => ['required', 'integer'],
            'stock' => ['required'],
            'category_id' => ['required'],
            'product_brand_id' => ['required'],
            'images' => ['required']
        ]);

        $product = Product::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'category_id' => $request->get('category_id'),
            'product_brand_id' => $request->get('product_brand_id'),
            'slug' => Str::slug($request->get('name'))
        ]);

        $images = $request->file('images');

        foreach ($images as $image) {
            $imageName = 'products/' . time() . $image->getClientOriginalName();
            Storage::disk('public')->put($imageName, file_get_contents($image));

            ProductImage::create([
                'name' => $imageName,
                'product_id' => $product->id
            ]);
        }

        return to_route('products.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $product = Product::with('productImages')->find($id);
        $categories = Category::all();
        $product_brands = ProductBrand::all();

        return view('backend.sections.products.edit', compact('product', 'categories', 'product_brands'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'max:191', Rule::unique('products', 'name')->ignore($id)],
            'description' => ['required'],
            'price' => ['required', 'integer'],
            'stock' => ['required'],
            'category_id' => ['required'],
            'product_brand_id' => ['required'],
        ]);

        $product = Product::find($id);
        $product->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'category_id' => $request->get('category_id'),
            'product_brand_id' => $request->get('product_brand_id'),
            'slug' => Str::slug($request->get('name'))
        ]);

        return to_route('products.index')->with('flash', 'Registro actualizado exitosamente!');
    }

    public function destroyImage($id)
    {
        $productImage = ProductImage::find($id);
        $product = Product::find($productImage->product_id);
        $imageQuantity = $product->productImages->count();

        if ($imageQuantity > 1) {
            Storage::disk('public')->delete($productImage->name);
            $productImage->delete();

            return redirect()->back()->with('flash', 'Imagen eliminada exitosamente!');
        }

        return redirect()->back()->with('error', 'El producto debe tener al menos una imagen');
    }

    public function addImages(Request $request, $id)
    {
        $this->validate($request, [
            'images' => ['required']
        ]);

        $product = Product::find($id);
        $images = $request->file('images');

        foreach ($images as $image) {
            $imageName = 'products/' . time() . $image->getClientOriginalName();
            Storage::disk('public')->put($imageName, file_get_contents($image));

            ProductImage::create([
                'name' => $imageName,
                'product_id' => $product->id
            ]);
        }

        return redirect()->back()->with('flash', 'Imagen agregada exitosamente!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $productImages = $product->productImages;

        foreach ($productImages as $productImage) {
            Storage::disk('public')->delete($productImage->name);
        }

        $product->productImages()->delete();
        $product->delete();

        return redirect()->back()->with('flash', 'Producto eliminado exitosamente!');
    }

    public function compatibleModels($id)
    {
        $product = Product::with('carModels')->find($id);
        $allModels = CarModel::all();

        return view('backend.sections.products.compatible_models', compact('product', 'allModels'));
    }

    public function storeCompatibleModels(Request $request, $id)
    {
        $product = Product::find($id);
        $product->carModels()->sync($request->get('car_models'));

        return to_route('products.index')->with('flash', 'Modelos actualizados exitosamente!');
    }
}
