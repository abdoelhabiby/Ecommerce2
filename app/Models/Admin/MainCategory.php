<?php

namespace App\Models\Admin;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        MainCategory::observe(MainCategoryObserver::class);
    }

    public function scopeSelection($query){
        return $query->select("id", "translation_lang", "name", "active", "photo");
    }

    public function scopeActive($query){
         return $query->where("active",1);
    }


    public function getCaseActive()
    {
        return $this->active == 1 ? __("admin.enabled") : __("admin.not_enabled");
    }

    public function scopeDataCurrentLanguage($query){
        return $query->where("translation_lang", languageLocal());
    }



    public function translations(){

        return $this->hasMany(self::class,"translation_of");
    }

    public function vendors(){

        return $this->hasMany(Vendor::class,"category_id","id");
    }




}
