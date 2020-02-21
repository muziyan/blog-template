<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function hasSection(){
        return $this->hasOne("App\Models\Section","id",'section_id');
    }
}
