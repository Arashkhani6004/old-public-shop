<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ChangeDataBaseController extends Controller
{
    protected $signature = 'migrate:multiple';
    protected $description = 'Run migrations on multiple databases';

    public function ChangeDatabase()
    {
        $domains = Domain::OrderByDesc('id')->whereNull('out_of_service')->whereNull('not_similar_host')->get();
        $result = [];


        foreach ($domains as $domain) {
            $x = explode('.', $domain->domain);
            $result[] = $x[0];
        }

        foreach ($result as $row) {


            \Log::info("Checking database: mainsite_{$row}");

            // تنظیم کانکشن به صورت داینامیک
            Config::set('database.connections.dynamic', array_merge(
                config('database.connections.mysql'),
                [
                    "username" => 'mainsite_'.$row,
                    'database' => 'mainsite_'.$row
                ]
            ));

            DB::purge('dynamic');

            try {
                // چک کردن اتصال به دیتابیس
                DB::connection('dynamic')->getPdo();
                \Log::info("Migrating database: mainsite_{$row}");

                // اجرای مایگریشن‌ها برای این دیتابیس
                Artisan::call('migrate', [
                    '--database' => 'dynamic',
                    '--force' => true,
                ]);

                \Log::info("Migrated database: mainsite_{$row}");
            } catch (\Exception $e) {
                \Log::info($e->getMessage());
                \Log::error("Database mainsite_{$row} does not exist or connection failed.");
            }
        }

        \Log::info('All migrations completed!');
    }




}
