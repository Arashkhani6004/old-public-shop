<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Domain;
use App\Models\Product;
use App\Models\ProductVariable;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ShipMent;
use App\Models\ShipmentCity;
use App\Models\Order;
use App\Models\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
class ConvertCategoryController extends Controller
{
    public function convertCat(Request $request)
    {
      
     

        $tableName1 = 'categories';

        if (!Schema::connection('mysql')->hasTable($tableName1)) {
            Schema::connection('mysql')->create($tableName1, function ($table1) {
                $table1->id();
                $table1->bigInteger('old_id', 20)->nullable()->default(null);
                $table1->string('title');
                $table1->string('title_seo')->nullable()->default(null);
                $table1->string('description_seo');
                $table1->text('description');
                $table1->text('keyword');
                $table1->bigInteger('parent_id');
                $table1->string('mega_url')->nullable()->default(null);
                $table1->string('mega')->nullable()->default(null);
                $table1->string('cover')->nullable()->default(null);
                $table1->string('image')->nullable()->default(null);
                $table1->string('parent_title')->nullable()->default(null);
                $table1->string('old_image')->nullable()->default(null);
                $table1->string('old_link')->nullable()->default(null);
                $table1->integer('status')->default(0);
                $table1->integer('footer')->default(0);
                $table1->integer('show_footer')->default(0);
                $table1->integer('show_menu')->default(0);
                $table1->integer('sort')->default(0);
                $table1->string('old_link')->nullable()->default(null);
                $table1->string('old_image')->nullable()->default(null);
                $table1->string('title2')->nullable()->default(null);
                $table1->timestamp('created_at')->useCurrent();
                $table1->timestamp('updated_at')->useCurrent();
                $table1->timestamp('deleted_at')->nullable()->default(null);
            });
        } else {
            $columnTypes1 = [
                'old_id' => 'bigInteger',
                'parent_id' => 'bigInteger',
                'title' => 'string',
                'title_seo' => 'string',
                'description_seo' => 'text',
                'description' => 'text',
                'keyword' => 'text',
                'url' => 'string',
                'mega_url' => 'string',
                'mega' => 'string',
                'cover' => 'string',
                'image' => 'string',
                'parent_title' => 'string',
                'old_image' => 'string',
                'old_link' => 'string',
                'image' => 'string',
                'status' => 'integer',
                'show_footer' => 'integer',
                'show_menu' => 'integer',
                'sort' => 'integer',
                'footer' => 'integer',
                'old_link' => 'string',
                'old_image' => 'string',
                'title2' => 'string',
            ];

            foreach ($columnTypes1 as $column1 => $type1) {
                if (!Schema::connection('mysql')->hasColumn($tableName1, $column1)) {
                    Schema::connection('mysql')->table($tableName1, function ($table1) use ($column1, $type1) {
                        if ($type1 === 'string') {
                            $table1->{$type1}($column1)->nullable()->default(null);
                        } elseif ($type1 === 'text') {
                            $table1->{$type1}($column1)->nullable()->default(null);
                        } elseif ($type1 === 'bigInteger') {
                            $table1->{$type1}($column1, 20)->nullable()->default(null);
                        }
                        elseif ($type1 === 'timestamp') {
                            $table1->{$type1}($column1)->nullable()->default(null);
                        }
                        else {
                            $table1->{$type1}($column1)->default(0);
                        }
                    });
                }
            }
        }


    }

}
