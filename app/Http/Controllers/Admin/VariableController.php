<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductImport;
use App\Exports\ProductVarExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\VariableRequest;
use App\Library\Helper;
use app\Library\UploadImg;
use App\Exports\ProductVarImport;

use App\Models\Image;
use App\Models\InventoryReceipt;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductVariable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class VariableController extends Controller
{
    public function getAddVariable($id)
    {
        $product = Product::find($id);
        $variables = ProductVariable::where('product_id', $product->id)->get();

        return view('admin.variable.index')->with(compact('variables', 'product'));
    }

    public function postAddVariable(Request $request)
    {
        $input = $request->all();
        $product = Product::find($input['product_id']);
        if ($request->has('values')) {
            foreach ($input['values'] as $value) {
                $price = Helper::persian2LatinDigit($value['price']);
                $discounted_price = Helper::persian2LatinDigit($value['discounted_price']);
                $stock = Helper::persian2LatinDigit($value['stock']);
                if ($discounted_price != null && $discounted_price != 0) {
                    if ($discounted_price > $price) {
                        return redirect()->back()->with('error', 'قیمت بعد تخفیف نمیتواند از قیمت اولیه بیشتر باشد');
                    }
                    $variable = ProductVariable::create([
                        'title' => $value['title'],
                        'stock' => $stock,
                        'image' => $value['image'][0],
                        'price' => $price,
                        'discounted_price' => $discounted_price,
                        'product_id' => $input['product_id'],
                    ]);
                } else{
                    $variable = ProductVariable::create([
                        'title' => $value['title'],
                        'stock' => $value['stock'],
                        'image' => $value['image'][0],
                        'price' => $price,
                        'product_id' => $input['product_id'],
                    ]);
                }
                foreach ($value['image'] as $key => $image) {
                    if ($image) {
                        $path = "assets/uploads/content/pro/";
                        $uploader = new UploadImg();
                        $fileName = $uploader->uploadPic($image, $path);
                        if ($fileName) {
                            $image = $fileName;
                        } else {
                            return Redirect::back()->with('error', 'عکس ارسالی صحیح نیست.');
                        }
                        $img = Image::create([
                            'product_id' => $input['product_id'],
                            'product_variable_id' => $variable->id,
                            'file' => $image,
                        ]);

                    }
                    if ($key == 0) {
                        $variable->update([
                            'image' => $image,
                        ]);
                    }
                }
                $inventory = InventoryReceipt::create([
                    'product_id' => $input['product_id'],
                    'product_variable_id' => $variable->id,
                    'inventory_type_id' => 1,
                    'count' => $variable->stock,
                ]);
                $price = Price::create([
                    'old_price' => $price,
                    'price' => $discounted_price,
                    'priceable_id' => $variable->id,
                    'priceable_type' => 'App\Models\VariableProduct',
                ]);
            }
        }
        $minimum_price = $product->variable()
            ->orderBy('price', 'ASC')
            ->where('stock', '<>', '0')->where('price', '<>', '0')
            ->first();
        $stock = ProductVariable::where('product_id', $product->id)->sum('stock');
        $product->update([
            'count' => $stock,
            'price' => $minimum_price ? $minimum_price->discounted_price : 0,
            'old_price' => $minimum_price ? $minimum_price->price : 0
        ]);
        return redirect()->back()->with('success', 'ایتم شما با موفقیت اضافه شد');
    }

    public function postEditVariable(VariableRequest $request, $id)
    {
        $input = $request->all();
        $stock = Helper::persian2LatinDigit($input['stock']);
        $price = Helper::persian2LatinDigit($input['price']);
        $discounted_price = isset($input['discounted_price']) ? Helper::persian2LatinDigit($input['discounted_price']) : 0;
        $variable = ProductVariable::find($id);
        $product = Product::where('id', $input['pro_id'])->first();
        if(isset($discounted_price)){
            if($discounted_price > $price){
                return redirect()->back()->with('error', 'قیمت بعد تخفیف نمیتواند از قیمت اولیه بیشتر باشد');
            }
        }
        if (isset($input['image'])) {
            foreach ($input['image'] as $key => $img) {
                $path = "assets/uploads/content/pro/";
                File::delete($path . '/big/' . $variable->file);
                File::delete($path . '/medium/' . $variable->file);
                File::delete($path . '/small/' . $variable->file);
                $uploader = new UploadImg();
                $fileName = $uploader->uploadPic($img, $path);
                if ($fileName) {
                    $newImage = Image::create([
                        'product_id' => $input['pro_id'],
                        'product_variable_id' => $variable->id,
                        'file' => $fileName,
                    ]);
                } else {
                    return Redirect::back()->with('error', 'عکس ارسالی صحیح نیست.');
                }
            }
        }
        if ($input['stock'] != $variable->stock) {
            if ($input['stock'] < $variable->stock) {
                $invertory = InventoryReceipt::create([
                    'product_id' => $input['pro_id'],
                    'inventory_type_id' => 2,
                    'product_variable_id' => $variable->id,
                    'count' => $variable->stock - $input['stock'],
                ]);
            } else {
                $invertory = InventoryReceipt::create([
                    'product_id' => $input['pro_id'],
                    'inventory_type_id' => 1,
                    'product_variable_id' => $variable->id,
                    'count' => $input['stock'] - $variable->stock,
                ]);
            }
        }
        if ($input['price'] != $variable->price || $input['discounted_price'] != $variable->discounted_price) {
            $price_table = Price::create([
                "old_price" => $price,
                'price' => $discounted_price,
                'priceable_id' => $variable->id,
                'priceable_type' => 'App\Models\VariableProduct',
            ]);
        }
        $variable->update([
            'title' => $input['title'],
            'price' => $price,
            'discounted_price' => $discounted_price,
            'stock' => $input['stock'],
        ]);
        $minimum_price = $product->variable()
            ->orderBy('price', 'ASC')
            ->where('stock', '<>', '0')->where('price', '<>', '0')
            ->first();
        $stock = ProductVariable::where('product_id', $product->id)->sum('stock');
        $product->update([
            'price' => $minimum_price ? $minimum_price->discounted_price : 0,
            'old_price' => $minimum_price ? $minimum_price->price : 0,
            'count' => $stock,
        ]);
        return redirect()->back()->with('success', 'ایتم شما با موفقیت ویرایش شد');
    }

    public function getDeleteVariable($id)
    {
        $variable = ProductVariable::find($id);
        $product = Product::where('id', $variable['product_id'])->first();
        $receipt = InventoryReceipt::create([
            'product_id' => $variable->product_id,
            'inventory_type_id' => 2,
            'product_variable_id' => $id,
            'count' => $variable->stock
        ]);
        $variable->delete();
        $minimum_price = $product->variable()
            ->orderBy('price', 'ASC')
            ->where('stock', '<>', '0')->where('price', '<>', '0')
            ->first();
        $variables = ProductVariable::where('product_id', $product->id)->get();
        $stock = $variables->sum('stock');
        $product->update([
            'count' => $stock ? $stock : 0,
            'price' => $minimum_price ? $minimum_price->discounted_price : 0,
            'old_price' => $minimum_price ? $minimum_price->price : 0
        ]);
        return redirect()->back()->with('success', 'ایتم شما با موفیقت حذف شد');
    }

    public function getDeleteImageVar($id)
    {
        $img = Image::find($id)->delete();
        return redirect()->back()->with('success', 'ایتم شما با موفقیت حذف شد');
    }

    public function getExportVar(Request $request2)
    {
        return Excel::download(new ProductVarExport($request2), 'productVar.xlsx');
    }

    public function getImportVar()
    {
        $product = Product::all();
        return view('admin.variable.excel',compact('product'));
    }

    public function postExcel(Request $request)
    {
        $productId = $request->input('product_id');


        Excel::import(new ProductVarImport($productId), $request->file('excel_file'));

        return redirect()->back()->with('success', 'متغیرهای محصول با موفقیت اضافه شدند.');
    }
}
