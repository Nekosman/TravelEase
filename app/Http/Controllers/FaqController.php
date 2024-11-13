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

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'category_id' => 'required|exists:faq_categories,id',
        ]);

        Faq::create($request->all());

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
            'category_id' => 'required|exists:faq_categories,id', // Validasi category_id harus ada di tabel faq_category
        ]);

        // Update data faq termasuk category_id
        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $request->input('category_id'),
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
