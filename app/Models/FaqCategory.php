<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Relasi One-to-Many dengan SubcategoryFaq.
     */
    public function subcategories()
    {
        return $this->hasMany(SubCategoryFaq::class, 'faq_category_id');
    }

    /**
     * Relasi One-to-Many dengan Faq.
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id');
    }
}