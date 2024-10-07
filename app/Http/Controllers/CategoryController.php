<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Categories::all();

        return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name_category' => 'required',
            'description' => 'nullable',
        ]);

        Categories::create($request->all());

        return redirect()->route('categories')
            ->with('success', 'Category created successfully.');
    }
}
