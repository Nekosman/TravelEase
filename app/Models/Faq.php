<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{ use HasFactory;

    protected $fillable = ['question', 'answer', 'category_id', 'subcategory_id'];

    /**
     * Relasi ke FaqCategory (Many-to-One).
     */
    public function category()
    {
        return $this->belongsTo(FaqCategories::class, 'category_id');
    }

    /**
     * Relasi ke SubcategoryFaq (Many-to-One).
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategoryFaq::class, 'subcategory_id');
    }
}
