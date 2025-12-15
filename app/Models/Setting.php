<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    protected $table = 'setting';
    use SoftDeletes;
    protected $fillable = [
        'title', 'logo','logo2','abouttitle', 'about', 'about2','aboutimg', 'contact', 'phone', 'maps', 'email', 'address', 'description_seo','favicon'
        ,'rules','tax','alert','disable','color1','color2','color3','color4','color5','noindex','h1','title_artcat', 'des_artcat', 'title_brand', 'des_brand'
        , 'title_offers', 'des_offers', 'title_contact', 'des_contact', 'title_rules', 'des_rules', 'title_products', 'des_products',
        'post_city','post_name1','post_price1','post_name2','post_price2','kave_phonenumber','special_img','kave_api','head_enamd'
        ,'footer_enamd','whatsapp','icon_fix','analytics','tagmanager','bank_type','merchent','title_1','title_2','title_3','meli_bank_terminal_id','meli_bank_terminal_key',
        'description_type', 'call_description','code1','code2', 'status_send', 'box_discount','icon_filter','status_police', 'domain_name', 'owner_mobile', 'owner_email', 
        'factor_address', 'factor_name','product_button_text', 'modal_img', 'modal_mobile_img'
    ];
    
    protected $casts = [
        'park_domains' => 'array',
    ];


    public function scopeSet($query)
    {
        $records = $query->whereType(1);
        return $records;
    }
    public function scopeDaily($query)
    {
        $records = $query->whereType('daily');
        return $records;
    }
    public function scopeMonthly($query)
    {
        $records = $query->whereType('monthly');
        return $records;
    }
    public function scopeWeekly($query)
    {
        $records = $query->whereType('weekly');
        return $records;
    }
    public function scopeYearly($query)
    {
        $records = $query->whereType('yearly');
        return $records;
    }
    
    public function getLogoImageAttribute(){
        $logoPath = 'assets/uploads/content/set/'.@$this->attributes['logo2'];
        return file_exists($logoPath) ? asset($logoPath) : asset('assets/site/images/notfound.png');
    }
}
