<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable=['abbr','local','name','direction','active'];


    public function getActive(){
        return $this->active == 1 ? 'مفعل':'غير مفعل' ;
    }

    public function scopeSelection($q){
        return $q->select('id','abbr','name','direction','active');
    }

}
