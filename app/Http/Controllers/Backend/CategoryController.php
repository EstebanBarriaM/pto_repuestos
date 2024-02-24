<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('backend.sections.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.sections.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', 'unique:categories,name'],
            'image_path' => ['required', 'mimes:jpg,jpeg,png']
        ]);

        $image = $request->file('image_path');
        $imageName = 'categories/' . time() . $image->getClientOriginalName();
        Storage::disk('public')->put($imageName, file_get_contents($image));

        Category::create([
            'name' => $request->get('name'),
            'image' => $imageName,
            'slug' => Str::slug($request->get('name'))
        ]);

        return to_route('categories.index')->with('flash', 'Registro creado exitosamente!');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('backend.sections.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', Rule::unique('categories', 'name')->ignore($id)],
            'image_path' => ['nullable', 'mimes:jpg,jpeg,png']
        ]);

        $category = Category::find($id);

        $category->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name'))
        ]);

        if ($request->has('image_path')) {
            Storage::disk('public')->delete($category->image);

            $image = $request->file('image_path');
            $imageName = 'categories/' . time() . $image->getClientOriginalName();
            Storage::disk('public')->put($imageName, file_get_contents($image));

            $category->update([
                'image' => $imageName
            ]);
        }

        return to_route('categories.index')->with('flash', 'Registro actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        Storage::disk('public')->delete($category->image);
        $category->delete();

        return to_route('categories.index')->with('flash', 'Registro eliminado exitosamente!');
    }
}
