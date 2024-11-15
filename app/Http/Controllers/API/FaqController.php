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
            $faqs = Faq::with('category')->get();

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

    
}
