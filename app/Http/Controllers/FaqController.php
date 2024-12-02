<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategories;
use App\Models\FaqCategory;
use App\Models\SubcategoryFaq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        $subcategories = SubcategoryFaq::all();
        $faqcategories = FaqCategories::all();
        return view('faqs.create', compact('faqcategories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'category_id' => 'required|exists:faq_categories,id', // Validasi id kategori
            'subcategory_id' => 'nullable|exists:subcategory_faq,id', // Validasi subkategori jika ada
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        $subcategories = SubcategoryFaq::all();
        $faqcategories = FaqCategories::all();

        return view('faqs.edit', compact('faq', 'faqcategories', 'subcategories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'nullable',
            'category_id' => 'required|exists:faq_categories,id',
            'subcategory_id' => 'nullable|exists:subcategory_faq,id',
        ]);

        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully.');
    }
}
