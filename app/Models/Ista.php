<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ista extends Model
{
    protected $table = 'istas';
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'image', 'status','sort',
         'description_seo', 'url', 'title_seo','footer','menu'
    ];
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
