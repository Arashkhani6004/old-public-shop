<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ConvertButtonTextController extends Controller
{
    public function inserSetting()
    {
        $tableNameSettings = 'setting';
        if (!Schema::connection('mysql')->hasTable($tableNameSettings)) {
            Schema::connection('mysql')->create($tableNameSettings, function ($tableSettings) {
                $tableSettings->id();
                $tableSettings->bigInteger('id')->unsigned();
                $tableSettings->string('title')->nullable();
                $tableSettings->string('logo')->nullable();
                $tableSettings->string('favicon')->nullable();
                $tableSettings->string('abouttitle')->nullable();
                $tableSettings->longText('about');
                $tableSettings->longText('about2');
                $tableSettings->string('aboutimg')->nullable();
                $tableSettings->longText('contact');
                $tableSettings->longText('maps');
                $tableSettings->longText('email');
                $tableSettings->longText('address');
                $tableSettings->longText('description_seo');
                $tableSettings->longText('phone');
                $tableSettings->timestamps();
                $tableSettings->softDeletes();
                $tableSettings->longText('rules')->nullable();
                $tableSettings->string('tax')->nullable();
                $tableSettings->text('alert');
                $tableSettings->integer('disable')->default(0);
                $tableSettings->string('color1')->nullable();
                $tableSettings->string('color2')->nullable();
                $tableSettings->string('color3')->nullable();
                $tableSettings->string('color4')->nullable();
                $tableSettings->integer('noindex')->default(0);
                $tableSettings->string('h1')->nullable();
                $tableSettings->text('logo2');
                $tableSettings->text('title_artcat');
                $tableSettings->text('des_artcat');
                $tableSettings->text('title_brand');
                $tableSettings->text('des_brand');
                $tableSettings->text('title_offers');
                $tableSettings->text('des_offers');
                $tableSettings->text('title_contact');
                $tableSettings->text('des_contact');
                $tableSettings->text('title_rules');
                $tableSettings->text('des_rules');
                $tableSettings->text('title_products');
                $tableSettings->text('des_products');
                $tableSettings->integer('post_city')->nullable();
                $tableSettings->string('post_name1')->nullable();
                $tableSettings->integer('post_price1')->nullable();
                $tableSettings->string('post_name2')->nullable();
                $tableSettings->integer('post_price2')->nullable();
                $tableSettings->text('kave_phonenumber');
                $tableSettings->string('special_img')->nullable();
                $tableSettings->text('kave_api');
                $tableSettings->string('head_enamd')->nullable();
                $tableSettings->text('footer_enamd');
                $tableSettings->string('whatsapp')->nullable();
                $tableSettings->text('analytics');
                $tableSettings->text('tagmanager');
                $tableSettings->integer('bank_type')->default(1);
                $tableSettings->text('merchent');
                $tableSettings->string('title_1');
                $tableSettings->string('title_2');
                $tableSettings->string('title_3');
                $tableSettings->boolean('description_type')->default(1);
                $tableSettings->text('code1');
                $tableSettings->text('code2');
                $tableSettings->integer('status_send')->nullable();
                $tableSettings->integer('box_discount')->nullable();
                $tableSettings->string('icon_fix')->nullable();
                $tableSettings->string('icon_filter')->nullable();
                $tableSettings->text('call_description');
                $tableSettings->string('meli_bank_terminal_id')->nullable();
                $tableSettings->string('meli_bank_terminal_key')->nullable();
                $tableSettings->boolean('status_police')->default(0);
                $tableSettings->string('color5')->nullable();
                $tableSettings->text('domain_name');
                $tableSettings->text('domain_name');
                $tableSettings->text('owner_email')->nullable();
                $tableSettings->text('owner_mobile')->nullable();
                $tableSettings->string('factor_name')->nullable();
                $tableSettings->string('factor_address')->nullable();
                $tableSettings->boolean('product_button_text')->default(1);
            });
        } else {
            $columnTypesSettings = [
                'title' => 'string',
                'logo' => 'string',
                'favicon' => 'string',
                'abouttitle' => 'string',
                'about' => 'text',
                'about2' => 'text',
                'aboutimg' => 'string',
                'contact' => 'text',
                'maps' => 'text',
                'email' => 'text',
                'address' => 'text',
                'description_seo' => 'text',
                'phone' => 'text',
                'rules' => 'text',
                'tax' => 'string',
                'alert' => 'text',
                'disable' => 'integer',
                'color1' => 'string',
                'color2' => 'string',
                'color3' => 'string',
                'color4' => 'string',
                'noindex' => 'integer',
                'h1' => 'string',
                'logo2' => 'text',
                'title_artcat' => 'text',
                'des_artcat' => 'text',
                'title_brand' => 'text',
                'des_brand' => 'text',
                'title_offers' => 'text',
                'des_offers' => 'text',
                'title_contact' => 'text',
                'des_contact' => 'text',
                'title_rules' => 'text',
                'des_rules' => 'text',
                'title_products' => 'text',
                'des_products' => 'text',
                'post_city' => 'integer',
                'post_name1' => 'string',
                'post_price1' => 'integer',
                'post_name2' => 'string',
                'post_price2' => 'integer',
                'kave_phonenumber' => 'text',
                'special_img' => 'string',
                'kave_api' => 'text',
                'head_enamd' => 'string',
                'footer_enamd' => 'text',
                'whatsapp' => 'string',
                'analytics' => 'text',
                'tagmanager' => 'text',
                'bank_type' => 'integer',
                'merchent' => 'text',
                'title_1' => 'string',
                'title_2' => 'string',
                'title_3' => 'string',
                'description_type' => 'boolean',
                'code1' => 'text',
                'code2' => 'text',
                'status_send' => 'integer',
                'box_discount' => 'integer',
                'icon_fix' => 'string',
                'icon_filter' => 'string',
                'call_description' => 'text',
                'meli_bank_terminal_id' => 'string',
                'meli_bank_terminal_key' => 'string',
                'status_police' => 'boolean',
                'color5' => 'string',
                'domain_name' => 'string',
                'owner_email' => 'string',
                'owner_mobile' => 'string',
                'factor_name' => 'string',
                'factor_address' => 'string',
                'product_button_text' => 'integer',
            ];

            foreach ($columnTypesSettings as $columnSettings => $typeSettings) {
                if (!Schema::connection('mysql')->hasColumn($tableNameSettings, $columnSettings)) {
                    Schema::connection('mysql')->table($tableNameSettings, function ($tableSettings) use ($columnSettings, $typeSettings) {
                        if ($typeSettings === 'string') {
                            $tableSettings->{$typeSettings}($columnSettings)->nullable()->default(null);
                        } elseif ($typeSettings === 'text') {
                            $tableSettings->{$typeSettings}($columnSettings)->nullable()->default(null);
                        } elseif ($typeSettings === 'timestamp') {
                            $tableSettings->{$typeSettings}($columnSettings)->nullable()->default(null);
                        } else {
                            $tableSettings->{$typeSettings}($columnSettings)->default(1);
                        }
                    });
                }
            }
        }
    }
}
