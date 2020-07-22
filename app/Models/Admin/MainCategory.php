<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $guarded = [];

    public function scopeSelection($query){
        return $query->select("id", "translation_lang", "name", "active", "photo");
    }


    public function getCaseActive()
    {
        return $this->active == 1 ? __("admin.enabled") : __("admin.not_enabled");
    }



    public function subCategories(){

        return $this->hasMany(self::class,"translation_of");
    }


}
