<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ColumnController extends Controller
{
    public function addColumn(Request $request)
    {
        $table = $request['table'];
        $column = $request['column'];
        $type = $request['type'];
        $nullable = $request['nullable'];
        $default = $request['default'];
       if (Schema::connection('mysql')->hasTable($table) && !Schema::connection('mysql')->hasColumn($table, $column)) {
    Schema::connection('mysql')->table($table, function (Blueprint $table) use ($column, $type, $nullable, $default) {
        $isNullable = ($nullable === 'null');
        switch ($type) {
            case 'string':
                $col = $table->string($column);
                break;
            case 'integer':
                $col = $table->integer($column);
                break;
            case 'tinyInteger':
                $col = $table->tinyInteger($column);
                break;
            case 'boolean':
                $col = $table->boolean($column);
                break;
            case 'text':
                $col = $table->text($column);
                break;
            case 'date':
                $col = $table->date($column);
                break;
            default:
                throw new \Exception('نوع نامعتبر');
        }
        if ($isNullable) {
            $col->nullable();
        }
        if ($default !== null) {
            $col->default($default);
        }
    });

    return response()->json(['success' => "ستون $column به جدول $table اضافه شد."], 200);
} else {
    return response()->json(['error' => 'جدول وجود ندارد یا ستون از قبل موجود است.'], 400);
}

    }
}
