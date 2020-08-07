<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maincategory extends Model
{

    protected $fillable=['name','translation_lang','translation_off','photo','slug','active'];

    public function categories()
    {
        return $this->hasMany(self::class,'translation_off');
    }

    public function scopeActive($q)
    {
        return $q->where('active',1);
    }


    public function scopeSelection($q)
    {
        return $q->select('id','name','translation_lang','photo','active');
    }


    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('public/assest/' . $val) : "";

    }




}
