<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'default_name',
        'default_location',
        'default_phone',
        'default_open_at',
        'default_closed_at',
        'default_activities',
        'default_rating',
        'default_image',
    ];

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale(); // Use current locale if none is passed

        return $this->hasOne(ProductTranslation::class)->where('locale', $locale);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductTranslationImage::class, 'product_id');
    }
    
}
