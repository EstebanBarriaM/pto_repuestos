<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarBrand;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CarBrandController extends Controller
{
    public function index()
    {
        $car_brands = CarBrand::all();

        return view ('backend.sections.car_brands.index', compact('car_brands'));
    }

    public function create()
    {
        return view('backend.sections.car_brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => ['required', 'unique:car_brands,title']
        ]);

        CarBrand::create([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title'))
        ]);

        return to_route('car_brand.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $car_brand = CarBrand::find($id);

        return view('backend.sections.car_brands.edit', compact('car_brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => ['required', Rule::unique('car_brands', 'title')->ignore($id)]
        ]);

        $car_brand = CarBrand::find($id);
        $car_brand->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
        ]);

        return to_route('car_brand.index')->with('flash', 'Registro editado exitosamente!');

    }

    public function destroy($id)
    {
        $car_brand = CarBrand::find($id);
        $car_brand->delete($id);

        return to_route('car_brand.index')->with('flash', 'Registro eliminado exitosamente!');
    }
}
