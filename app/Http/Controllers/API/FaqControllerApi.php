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
            $faqs = Faq::all();

            return response()->json([
                'status' => true,
                'message' => 'FAQS retrieved successfully',
                'data' => $faqs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve FAQS',
                'error' => $e->getMessage()
            ], 500);
        }
    }

// FaqController.php
public function getFaqsByCategory($categoryId)
{
    $faqs = Faq::where('category_id', $categoryId)->get();
    return response()->json(['data' => $faqs]);
}



}
