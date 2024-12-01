<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    use HasFactory;
    protected $table = "content";

    public function category(){
        return $this->belongsTo(CategoryModel::class,"category_id");
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

}

