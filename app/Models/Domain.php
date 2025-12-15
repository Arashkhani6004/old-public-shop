<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';
    protected $fillable = ['domain', 'error','out_of_service','not_similar_host','check','change_public','call-col', 'robots'];
}
