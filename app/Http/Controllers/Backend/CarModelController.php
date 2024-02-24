<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\CarBrand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CarModelController extends Controller
{
    public function index()
    {
        $car_models = CarModel::with('carBrand')->get();
        return view('backend.sections.car_models.index', compact('car_models'));
    }

    public function create()
    {
        $car_brands = CarBrand::all();
        return view ('backend.sections.car_models.create', compact('car_brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'car_brand_id' => ['required'],
            'title' => ['required', 'unique:car_models,title']
        ]);
        CarModel::create([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'car_brand_id' => $request->get('car_brand_id')
        ]);

        return to_route('car_model.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $car_models = CarModel::find($id);
        $car_brands = CarBrand::all();

        return view('backend.sections.car_models.edit', compact('car_models', 'car_brands'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'car_brand_id' => ['required'],
            'title' => ['required', Rule::unique('car_models', 'title')->ignore($id)]
        ]);

        $car_models = CarModel::find($id);
        $car_models->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'car_brand_id' => $request->get('car_brand_id')
        ]);

        return to_route('car_model.index')->with('flash', 'Registro editado exitosamente!');
    }

    public function destroy($id)
    {
        $car_models = CarModel::find($id);
        $car_models->delete($id);

        return to_route('car_model.index')->with('flash', 'Registro eliminado exitosamente!');
    }
}
