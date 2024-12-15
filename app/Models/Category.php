<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['default_name' , 'image'];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale(); // Use current locale if none is passed
        return $this->hasOne(CategoryTranslation::class)->where('locale', $locale);
    }

        // Helper method to search categories by translated name
    public static function searchCategories($search)
    {
        return self::whereHas('translations', function ($query) use ($search) {
            $query->where('locale', app()->getLocale())
                ->where('name', 'LIKE', "%$search%");
        })->get();
    }
}
