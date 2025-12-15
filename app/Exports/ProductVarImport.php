<?php

namespace App\Exports;



use App\Library\Helper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\InventoryReceipt;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use App\Models\ProductSpecificationTypeCategory;
use App\Models\ProductVariable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ProductVarImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use SkipsFailures;

    protected $productId;

    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    public function model(array $row)
    {
        $productId = $row['kd_mhsol'];
        $variableId = $row['kd_mtghyyr'];

        $product = Product::find($productId);

        if (!$product) {
            session()->flash('error', 'محصول با شناسه ' . $productId . ' یافت نشد.');
            return null;
        }

        $price = intval(Helper::persian2LatinDigit($row['kymt_mtghyyr']));
        $discounted_price = intval(Helper::persian2LatinDigit($row['kymt_tkhfyf_khordh_mtghyyr']));
        $stock = intval(Helper::persian2LatinDigit($row['taadad_mtghyyr']));

        $var = ProductVariable::where('id', $variableId)->first();

        if ($var) {
            $var->update([
                'title' => @$row['nam_mtghyyr'],
                'stock' => $stock,
                'price' => $price,
                'discounted_price' => $discounted_price,
            ]);
        } else {
            $var = ProductVariable::create([
                'title' => @$row['nam_mtghyyr'],
                'stock' => $stock,
                'price' => $price,
                'discounted_price' => $discounted_price,
                'product_id' => $productId,
            ]);
        }

        InventoryReceipt::updateOrCreate(
            ['product_id' => $productId, 'product_variable_id' => $var->id],
            ['inventory_type_id' => 1, 'count' => $stock]
        );

        Price::updateOrCreate(
            ['priceable_id' => $var->id, 'priceable_type' => 'App\Models\ProductVariable'],
            ['old_price' => $price, 'price' => $discounted_price]
        );

        $this->updateProduct($productId);
    }

    protected function updateProduct($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $variables = ProductVariable::where('product_id', $productId)->get();

            $count = $variables->sum('stock');
            $price_min = $variables->min('price');
            $variablesPrice = $variables->where('price', $price_min)->first();

            $product->update([
                'count' => $count,
                'old_price' => intval($variablesPrice->price),
                'price' => intval($variablesPrice->discounted_price),
            ]);
        } else {
            session()->flash('error', 'محصول با شناسه ' . $productId . ' یافت نشد.');
            return redirect()->back();
        }
    }

    public function rules(): array
    {
        return [
            'nam_mtghyyr' => 'required',
            'taadad_mtghyyr' => 'required',
            'kd_mtghyyr' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nam_mtghyyr.required' => 'عنوان را وارد کنید',
            'taadad_mtghyyr.required' => 'تعداد را وارد کنید',
            'kd_mtghyyr.required' => 'کد متغیر را وارد کنید',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $row) {
                echo "ردیف " . $failure->row() . " ستون " . $failure->attribute() . ' خطا: ' . $row . '<br>';
            }
        }
    }
}
