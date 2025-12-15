<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySlogan;
use App\Models\Domain;
use App\Models\Product;
use App\Models\ProductVariable;
use App\Models\Sloagen;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ShipMent;
use App\Models\ShipmentCity;
use App\Models\Order;
use App\Models\City;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;

class AddCatSloganController extends Controller
{
    public function convertCatSlogan(Request $request)
    {
        $tableName1 = 'category_sloagen';

        if (!Schema::connection('mysql')->hasTable($tableName1)) {
            Schema::connection('mysql')->create($tableName1, function ($table1) {
                $table1->integer('sloagen_id');
                $table1->integer('category_id');
            });
        } else {
            $columnTypes1 = [
                'sloagen_id' => 'integer',
                'category_id' => 'integer',
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
                        } elseif ($type1 === 'timestamp') {
                            $table1->{$type1}($column1)->nullable()->default(null);
                        } else {
                            $table1->{$type1}($column1)->default(0);
                        }
                    });
                }
            }
        }


    }

    public function convertSloagens()
    {
        $sloagens = Sloagen::all();
        foreach ($sloagens as $sloagen) {
                $test = CategorySlogan::create([
                    'category_id' => $sloagen->category_id,
                    'sloagen_id' => $sloagen->id,
                ]);
        }
        return "done !";
    }

}
