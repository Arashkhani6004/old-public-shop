<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ConvertRecipientController extends Controller
{
    public function inserAddress()
    {
        $tableNameAddresses = 'addresses';
        if (!Schema::connection('mysql')->hasTable($tableNameAddresses)) {
            dd('22');

            Schema::connection('mysql')->create($tableNameAddresses, function ($tableAddresses) {
                $tableAddresses->id();
                $tableAddresses->bigInteger('id')->unsigned();
                $tableAddresses->bigInteger('user_id');
                $tableAddresses->string('name')->nullable();
                $tableAddresses->bigInteger('state_id');
                $tableAddresses->bigInteger('city_id');
                $tableAddresses->longText('location');
                $tableAddresses->bigInteger('default_address');
                $tableAddresses->string('postal_code')->nullable();
                $tableAddresses->string('transferee_name')->nullable();
                $tableAddresses->string('transferee_family')->nullable();
                $tableAddresses->string('transferee_mobile')->nullable();
                $tableAddresses->string('recipient_name')->nullable();
                $tableAddresses->string('recipient_phone')->nullable();
                $tableAddresses->string('cookie_id')->nullable();
            });
        } else {

            $columnTypesAddresses = [
                'user_id' => 'integer',
                'state_id' => 'integer',
                'city_id' => 'integer',
                'default_address' => 'integer',
                'name' => 'string',
                'location' => 'text',
                'postal_code' => 'string',
                'transferee_name' => 'string',
                'transferee_family' => 'string',
                'transferee_mobile' => 'string',
                'recipient_name' => 'string',
                'recipient_phone' => 'string',
                'cookie_id' => 'string',
            ];
            foreach ($columnTypesAddresses as $columnAddresses => $typeAddresses) {
                if (!Schema::connection('mysql')->hasColumn($tableNameAddresses, $columnAddresses)) {
                    Schema::connection('mysql')->table($tableNameAddresses, function ($tableAddresses) use ($columnAddresses, $typeAddresses) {
                        if ($typeAddresses === 'string') {
                            $tableAddresses->{$typeAddresses}($columnAddresses)->nullable()->default(null);
                        } elseif ($typeAddresses === 'text') {
                            $tableAddresses->{$typeAddresses}($columnAddresses)->nullable()->default(null);
                        } elseif ($typeAddresses === 'timestamp') {
                            $tableAddresses->{$typeAddresses}($columnAddresses)->nullable()->default(null);
                        } else {
                            $tableAddresses->{$typeAddresses}($columnAddresses)->default(0);
                        }
                    });
                }
            }
        }
    }
}
