<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class ConvertStaticController extends Controller
{
    public function insertStaticPages()
    {
        $tableNameSettings = 'Static_pages';
        if (!Schema::connection('mysql')->hasTable($tableNameSettings)) {
            Schema::connection('mysql')->create($tableNameSettings, function ($tableSettings) {
                $tableSettings->id();
                $tableSettings->string('title')->nullable();
                $tableSettings->string('h1')->nullable();
                $tableSettings->Text('description')->nullable();
                $tableSettings->integer('noindex')->nullable();
                $tableSettings->string('url')->nullable();
                $tableSettings->string('image')->nullable();
                $tableSettings->string('image_alt')->nullable();
                $tableSettings->integer('status')->nullable();
                $tableSettings->string('title_seo')->nullable();
                $tableSettings->Text('description_seo')->nullable();
                $tableSettings->Text('keywords')->nullable();
                $tableSettings->string('canonical')->nullable();
                $tableSettings->integer('listorder')->nullable();
                $tableSettings->timestamps();
            });
        } else {
            $columnTypesSettings = [
                'title' => 'string',
                'h1' => 'string',
                'description' => 'string',
                'noindex' => 'integer',
                'url' => 'string',
                'image' => 'string',
                'image_alt' => 'string',
                'status' => 'integer',
                'title_seo' => 'string',
                'description_seo' => 'string',
                'keywords' => 'string',
                'canonical' => 'string',
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
                            $tableSettings->{$typeSettings}($columnSettings)->default(0);
                        }
                    });
                }
            }
        }
    }
}
