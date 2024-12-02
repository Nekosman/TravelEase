<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryFaq extends Model
{
    use HasFactory;

    protected $table = 'subcategory_faq'; 
    protected $fillable = ['faq_category_id', 'name'];

    /**
     * Relasi ke FaqCategory (Many-to-One).
     */
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    /**
     * Relasi One-to-Many dengan Faq.
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'subcategory_id');
    }
}