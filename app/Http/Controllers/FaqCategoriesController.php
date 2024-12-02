<?php

namespace App\Http\Controllers;

use App\Models\FaqCategories;
use App\Models\SubcategoryFaq;
use Illuminate\Http\Request;

class FaqCategoriesController extends Controller
{
    public function index()
    {
        $faqCategory = FaqCategories::all();

        return view('faqs.categories.index', compact('faqCategory'));
    }

    public function create()
    {
        return view('faqs.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        FaqCategories::create($request->all());

        return redirect()->route('faqCategory.index')->with('success', 'FAQ category created successfully.');
    }

    public function edit(FaqCategories $faqCategory)
    {
        return view('faqs.categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategories $faqCategory)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $faqCategory->update($request->all());

        return redirect()->route('faqCategory.index')->with('success', 'FAQ Category updated successfully.');
    }

    public function destroy($id)
    {
        $faq = FaqCategories::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqCategory.index')->with('success', 'FAQ Category deleted successfully.');
    }
}
