<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = [];



    public function scopeSelection($query){
        return $query->select("id", "abbr", "local","active" , "name", "direction");
    }


    public function scopeActive($query){
        return $query->where("active",1);
    }

    public function getCaseActive(){
       return $this->active == 1 ? __("admin.enabled") : __("admin.not_enabled");
    }
}
