<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubOfSubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_of_subcategories';

    protected $fillable = ['name', 'sub_category_id', 'category_id'];

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
