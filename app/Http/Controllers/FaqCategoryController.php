<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
   public function index(){
    $faqCategory = FaqCategory::all();

    return view('faqs.categories.index', compact('faqCategory'));
   }

   public function create(){
        return view('faqs.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        FaqCategory::create($request->all());

        return redirect()->route('faq.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(FaqCategory $faqCategory){
        return view('faqs.categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $faqCategory->update($request->all());

        return redirect()->route('faq.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $faq = FaqCategory::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.index')
            ->with('success', 'FAQ deleted successfully.');
    }

}
