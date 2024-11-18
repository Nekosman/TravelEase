<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        try {
            // Memuat FAQ beserta kategori terkaitnya
            $faqs = Faq::with('category')->get();

            // Menyusun data FAQ untuk menampilkan nama kategori
            $faqData = $faqs->map(function ($faq) {
                // Menyusun data untuk FAQ dengan nama kategori
                $categories = $faq->category->pluck('name'); // Ambil nama kategori
                return [
                    'id' => $faq->id,
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                    'categories' => $categories,
                ];
            });

            return response()->json(
                [
                    'status' => true,
                    'message' => 'FAQS retrieved successfully',
                    'data' => $faqData,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to retrieve FAQS',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
<<<<<<< HEAD:app/Http/Controllers/API/FaqControllerApi.php

// FaqController.php
public function getFaqsByCategory($categoryId)
{
    $faqs = Faq::where('category_id', $categoryId)->get();
    return response()->json(['data' => $faqs]);
}



=======
>>>>>>> 68ef37447414a93efb68cce63084b86540dd834f:app/Http/Controllers/API/FaqController.php
}
