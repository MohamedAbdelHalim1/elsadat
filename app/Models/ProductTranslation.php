<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'location',
        'phone',
        'open_at',
        'closed_at',
        'activities',
    ];

    public function images()
    {
        return $this->hasMany(ProductTranslationImage::class, 'product_translations_id');
    }
}
