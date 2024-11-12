<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $faqs = Faq::all();

        return view('faqs.index', compact('faqs'));
    }

    public function create(){
        return view('faqs.create');
    }

    public function store(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq){
        return view('faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'nullable',
        ]);

        $faq->update($request->all());

        return redirect()->route('faq.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.index')
            ->with('success', 'FAQ deleted successfully.');
    }
    
}
