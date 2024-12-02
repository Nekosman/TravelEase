<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Faq;
<<<<<<< HEAD
use App\Models\FaqCategories;
=======
use App\Models\FaqCategory;
>>>>>>> b2ab6ffd2b862af21161f18c71f7829551293ca9
use App\Models\SubcategoryFaq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
<<<<<<< HEAD
    public function getByCategory($categoryId)
    {
        return Faq::where('category_id', $categoryId)->get(); // Mengambil FAQ berdasarkan kategori
    }

    public function getsubsCategory($subsId)
    {
        return SubcategoryFaq::where('faq_category_id', $subsId)->get();
    }

    public function getFaqsBySubsCategory($faqId)
    {
        return Faq::where('subcategory_id', $faqId)->get();
    }

    public function getFaqCategoriesWithSubcategoriesAndFaqs()
    {
        // Ambil semua kategori dengan relasi subkategori dan FAQ
        $categories = FaqCategories::with(['subcategories.faqs', 'faqs'])->get();

        // Mengembalikan data dalam bentuk JSON
        return response()->json($categories);
    }
=======

public function getByCategory($categoryId)
{
    return Faq::where('category_id', $categoryId)->get(); // Mengambil FAQ berdasarkan kategori
}

public function getsubsCategory($subsId)
{
    return SubcategoryFaq::where('faq_category_id', $subsId)->get();
}

public function getFaqsBySubsCategory($faqId)
{
    return Faq::where('subcategory_id', $faqId)->get();
}


public function getFaqCategoriesWithSubcategoriesAndFaqs()
{
        // Ambil semua kategori dengan relasi subkategori dan FAQ
        $categories = FaqCategory::with(['subcategories.faqs','faqs'])->get();


        // Mengembalikan data dalam bentuk JSON
        return response()->json($categories);
}



>>>>>>> b2ab6ffd2b862af21161f18c71f7829551293ca9
}
