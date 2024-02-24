<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductBrand;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductBrandController extends Controller
{
    public function index()
    {
        $product_brands = ProductBrand::all();
        return view('backend.sections.product_brands.index', compact('product_brands'));
    }

    public function create()
    {
        return view('backend.sections.product_brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', 'unique:product_brands,name']
        ]);

        ProductBrand::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name'))
        ]);

        return to_route('product_brand.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $product_brands = ProductBrand::find($id);
        return view('backend.sections.product_brands.edit', compact('product_brands'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', Rule::unique('product_brands', 'name')->ignore($id)]
        ]);

        $product_brands = ProductBrand::find($id);
        $product_brands->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name'))
        ]);

        return to_route('product_brand.index')->with('flash', 'Registro actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $product_brands = ProductBrand::find($id);
        $product_brands->delete();

        return to_route('product_brand.index')->with('flash', 'Registro eliminado exitosamente!');
    }
}
