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
<<<<<<< HEAD
        return $this->belongsTo(FaqCategories::class, 'category_id');
=======
        return $this->belongsTo(FaqCategory::class, 'category_id');
>>>>>>> b2ab6ffd2b862af21161f18c71f7829551293ca9
    }

    /**
     * Relasi ke SubcategoryFaq (Many-to-One).
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategoryFaq::class, 'subcategory_id');
    }
}
