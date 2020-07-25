<?php

namespace App\Models\Admin;

use App\Models\Admin\MainCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;


    protected $guarded = [];

    protected $hidden = ['category_id','password'];


    public function mainCategory(){
        return $this->belongsTo(MainCategory::class,"category_id","id");
    }

    public function getCaseActive()
    {
        return $this->active == 1 ? __("admin.enabled") : __("admin.not_enabled");
    }


    public function scopeSelection($query){
        return $query->select("id","name","logo","category_id","phone","active");
    }


    public function scopeDescending($query){
        return $query->orderBy("id","desc");
    }


    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }




}
