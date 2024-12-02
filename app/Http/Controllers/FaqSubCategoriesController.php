<?php

namespace App\Http\Controllers;

use App\Models\FaqCategories;
use App\Models\SubcategoryFaq;
use Illuminate\Http\Request;

class FaqSubCategoriesController extends Controller
{
    public function index()
    {
        $subcategories = SubcategoryFaq::all();

        return view('faqs.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $faqcategories = FaqCategories::all();
        return view('faqs.subcategories.create', compact('faqcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'name' => 'required',
        ]);

        SubcategoryFaq::create($request->all());

        return redirect()->route('faqSubCategory.index')->with('success', 'FAQ  subcategory created successfully.');
    }

    public function edit(SubcategoryFaq $faqSubCategory)
    {
        $faqcategories = FaqCategories::all();

        return view('faqs.subcategories.edit', compact('faqSubCategory', 'faqcategories'));
    }

    public function update(Request $request, SubcategoryFaq $faqSubCategory)
    {
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'name' => 'required',
        ]);

        $faqSubCategory->update($request->all());

        return redirect()->route('faqSubCategory.index')->with('success', 'FAQ subcategory updated successfully.');
    }

    public function destroy($id)
    {
        $faq = SubcategoryFaq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqSubCategory.index')->with('success', 'FAQ subcategory deleted successfully.');
    }
}
