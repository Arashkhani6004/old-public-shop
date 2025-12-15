<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sitemap extends Model
{
    protected $table = 'sitemap';
    // use SoftDeletes;
   protected $fillable = [
      'type','changefreq','priority'
   ];
}
