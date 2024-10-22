<?php

// app/Models/Post.php

// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content']; // Add fields that are mass assignable

    protected $dates = ['deleted_at']; // Define the soft delete column
}
