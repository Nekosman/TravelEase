<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqCategory = FaqCategory::all();

        $faqs = Faq::all();

        return view('faqs.index', compact('faqs', 'faqCategory'));
    }

    public function create()
    {
        $faqCategory = FaqCategory::all();
        return view('faqs.create', compact('faqCategory'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'question' => 'required',
    //         'answer' => 'required',
    //         'faq_categories' => 'required|array',
    //     ]);

    //     // Buat FAQ baru
    //     $faq = Faq::create($request->only(['question', 'answer']));

    //     // Sinkronisasi kategori
    //     $faq->category()->sync($request->faq_categories);

    //     // Muat ulang data FAQ dengan relasi kategori
    //     $faq->load('category');

    //     return redirect()->route('faq.index')->with('success', 'FAQ created successfully.');
    // }

    public function store(Request $request)
{
    $request->validate([
        'question' => 'required',
        'answer' => 'required',
        'category_id' => 'required|exists:faq_categories,id', // Validasi id kategori
        'subcategory_id' => 'nullable|exists:subcategory_faq,id', // Validasi subkategori jika ada
    ]);

    $faq = Faq::create([
        'question' => $request->input('question'),
        'answer' => $request->input('answer'),
        'category_id' => $request->input('category_id'),
        'subcategory_id' => $request->input('subcategory_id'),
    ]);

    return redirect()->route('faq.index')->with('success', 'FAQ created successfully.');
}


    public function edit(Faq $faq)
    {
        // Ambil daftar kategori untuk dropdown jika diperlukan
        $faqCategory = FaqCategory::all();

        return view('faqs.edit', compact('faq', 'faqCategory'));
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
