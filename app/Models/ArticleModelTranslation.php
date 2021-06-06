<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleModelTranslation extends Model
{
    protected $table='article_translations';
    public $timestamps=false;
    protected $guarded=[];
}
