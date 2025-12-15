<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\VariableRequest;
use App\Library\Help;
use App\Library\Helper;
use App\Library\Logs;
use app\Library\MakeTree;
use App\Library\Relate;
use app\Library\UploadImg;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Price;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Image;
use App\Models\InventoryReceipt;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use App\Models\ProductVariable;
use App\Models\Redirects;
use App\Models\RelateData;
use App\Models\Tag;
use App\Models\Taggable;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use SebastianBergmann\Type\NullType;
use Swift_InputByteStream;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Translation\Provider\Dsn;

class ProductController extends Controller
{
    public static function  is_english($str)
    {
        $str = preg_replace("/[^a-zA-Z0-9]/", "", $str);
        if (strlen($str) == strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }
    public function getProduct(Request $request)
    {
        $query = Product::orderBy('id', 'DESC');
        $searchTerm = $request->get('title');
        if ($searchTerm) {
            $latinSearchTerm = Helper::persian2LatinDigit($searchTerm);
            $query->where(function ($subQuery) use ($latinSearchTerm, $searchTerm) {
                $subQuery->where('title', 'LIKE', '%' . $latinSearchTerm . '%')
                    ->orWhere('title', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        $categoryId = $request->get('category_id');
        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }
        $products = $query->paginate(50);
        $categorySort = Product::orderby('sort', 'ASC')->get();
        $cat = Category::get();
        $brands = Brand::get();

        return View('admin.products.index')
            ->with('products', $products)
            ->with('categorySort', $categorySort)
            ->with('category', $cat)
            ->with('brands', $brands);

    }




    public function getAddProduct()
    {

        $category = Category::all()->toArray();

        //        if (!empty($category)) {
        //            MakeTree::getData($category);
        //            $parent_id = array(null => 'بدون والد') + MakeTree::GenerateSelect();
        //        } else {
        //            $parent_id = array(null => 'بدون والد');
        //        }

        if (!empty($category)) {
            MakeTree::getData($category);
            $category = MakeTree::GenerateArray(array('get'));
        }




        $tags = Tag::get();
        $brands = Brand::get();
        return View('admin.products.add')

            ->with('tags', $tags)
            ->with('brands', $brands)
            ->with('category', $category)

            ->with('parent_id', $category);
    }

    public function postAddProduct(ProductRequest $request)
    {

        $input = $request->all();
        $input['status'] = $request->has('status');
        $input['special'] = $request->has('special');
        $input['available'] = $request->has('available');
        $input['popular'] = $request->has('popular');
        $input['newest'] = $request->has('newest');
        $input['sell'] = $request->has('sell');
        $input['soon'] = $request->has('soon');
        $input['url'] = str_replace(' ', '-', $request->get('url'));
        if (self::is_english($request['url'])) {
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');
        }
        $input['title'] = str_replace(',', '', Helper::persian2LatinDigit($input['title']));
        $input['title2'] = str_replace(',', '', Helper::persian2LatinDigit($input['title2']));
        $input['title_seo'] = str_replace(',', '', Helper::persian2LatinDigit($input['title_seo']));
        $input['description_seo'] = str_replace(',', '', Helper::persian2LatinDigit($input['description_seo']));
        $input['description'] = str_replace(',', '', Helper::persian2LatinDigit($input['description']));
        $input['old_price'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['old_price'])));
        $input['price'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['price'])));
        $input['count'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['count'])));
        $input['max'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['max'])));
        if ($request->get('url')) {
            $u = Str::slug($input['url']);
            $url = Product::where('url', $u)->where('id', '<>', $request->get('id'))->count();
            if ($url === 0) {
                $input['url'] = $u;
            } else {
                return \redirect()->back()->with('error', 'url وارد شده تکراریست')
                    ->withInput($request->input());
            }
        }
        $product = Product::create($input);
        if($input['count'] != null){
            $receipt = InventoryReceipt::create([
                'product_id' => $product->id,
                'inventory_type_id'  => 1,
                'count' => $product->count ,
            ]);
        }
        if ($request->has('relates_ids')) {
            Relate::relates($input['relates_ids'], $product->id, $input['datable_type'], 1, false);
        }
        if ($request->has('comps_ids')) {
            Relate::relates($input['comps_ids'], $product->id, $input['datable_type'], 2, false);
        }

        $product->update($input);

        if ($input['old_price'] != null || $input['price'] != null) {
            $price = Price::create([
                'old_price' => intval(str_replace(',', '', Helper::persian2LatinDigit($input['old_price']))),
                'price' => intval(str_replace(',', '', Helper::persian2LatinDigit($input['price']))),
                'priceable_id' => $product->id,
                'priceable_type' => 'App\Models\Product',


            ]);
        }

        if ($request->has('tag_id')) {
            $tags = $request->tag_id;
            foreach($tags as $tag)
            {

                Taggable::create([
                    'taggable_type' => 'App\Models\Product',
                    'taggable_id' => $product->id,
                    'tag_id'=> $tag,
                ]);

            }
        }
        if ($request->has('category_id')) {
            $product->assignCategory($request['category_id']);
        } else {
            return redirect()->back()->with('error', ' حداقل یک دسته را انتخاب کنید');
        }


        $array = array($input);
        $serialized_array = serialize($array);

        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $product->id);
        if ($request->has('back')) {
            return Redirect::action('Admin\ProductController@getEditProduct', $product->id)->with('success', 'کد مورد نظر با موفقیت اضافه شد');
        } else {
            return Redirect::action('Admin\ProductController@getProduct');
        }
    }

    public function getEditProduct($id)
    {

        $category = Category::all()->toArray();

        if (!empty($category)) {
            MakeTree::getData($category);
            $category = MakeTree::GenerateArray(array('get'));
        }
        $brands = Brand::get();

        $data = Product::find($id);


        $cat_pro = $data->categories->pluck('id')->toArray();
        $tag_pro = Taggable::where('taggable_id', $id)->where('taggable_type', 'App\Models\Product')->pluck('tag_id')->toArray();

        // $tags = Tag::whereIn('id', $tag_pro)->get();
        $tags = Tag::all();
        $tas = Taggable::where('taggable_type', 'App\Models\Product')->where('taggable_id', $id)->pluck('tag_id')->toArray();
        return View('admin.products.edit')
            ->with('data', $data)
            ->with('brands', $brands)
            ->with('tags', $tags )
            ->with('cat_pro', $cat_pro)
            ->with('category', $category)
            ->with('parent_id', $category)
            ->with('tas', $tas);
    }

    public function postEditProduct($id, ProductRequest $request)
    {
        $input = $request->all();
        // Validation:
        if ($input['old_price'] == null) {
            return redirect()->back()->with('error', 'قیمت را وارد کنید');
        }
        if ($input['old_price'] < $input['price']) {
            return redirect()->back()->with('error', 'قیمت بعد تخفیف باید کوچک تر از قیمت باشد');
        }
        $input['status'] = $request->has('status');
        $input['special'] = $request->has('special');
        $input['popular'] = $request->has('popular');
        $input['available'] = $request->has('available');
        $input['newest'] = $request->has('newest');
        $input['sell'] = $request->has('sell');
        $input['soon'] = $request->has('soon');
        $input['count'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['count'])));
        $input['url'] = str_replace(' ', '-', $input['url']);
        if (self::is_english($request['url'])) {
            return redirect()->back()->with('error', 'آدرس url را به انگلیسی بنویسید');
        }
        $product = Product::orderBy('id', 'DESC')->find($id);
        $input['title'] = str_replace(',', '', Helper::persian2LatinDigit($input['title']));
        $input['title2'] = str_replace(',', '', Helper::persian2LatinDigit($input['title2']));
        $input['title_seo'] = str_replace(',', '', Helper::persian2LatinDigit($input['title_seo']));
        $input['description_seo'] = str_replace(',', '', Helper::persian2LatinDigit($input['description_seo']));
        $input['description'] = str_replace(',', '', Helper::persian2LatinDigit($input['description']));
        $input['old_price'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['old_price'])));
        $input['price'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['price'])));
        $input['count'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['count'])));
        $input['max'] = intval(str_replace(',', '', Helper::persian2LatinDigit($input['max'])));
        if ($request->get('url')) {
            $u = Str::slug($input['url']);
            $url = Product::where('url', $u)->where('id', '!=', $id)->count();
            if ($url === 0) {
                $input['url'] = $u;
            } else {
                return \redirect()->back()->with('error', 'url وارد شده تکراریست');
            }
        }
        $input['count'] = Helper::persian2LatinDigit($input['count']);
        if($input['count'] != $product->count && $input['count'] != null){
            if($product->count == "")
            {
                $product->count = 0;
            }
	        if($input['count'] - $product->count > 0){
	            $receipt = InventoryReceipt::create([
	                'product_id' => $product->id,
	                'inventory_type_id'  => 1,
	                'count' => $input['count'] - $product->count ,
	            ]);
	        }else{
	            $receipt = InventoryReceipt::create([
	                'product_id' => $product->id,
	                'inventory_type_id'  => 2,
	                'count' =>  $product->count - $input['count'] ,
	            ]);
	        }
        }
        $product->update($input);
        if ($request->get('relates_ids') !== null) {
            Relate::relates($input['relates_ids'], $product->id, $input['datable_type'], 1, true);
        } else {
            $relate = RelateData::where('datable_id', $product->id)->where('datable_type', "App\Models\Product")->delete();
        }
        if ($request->get('comps_ids') !== null) {
            Relate::relates($input['comps_ids'], $product->id, $input['datable_type'], 2, true);
        } else {
            $comp = RelateData::where('datable_id', $product->id)->where('datable_type', "App\Models\Product")->delete();
        }
        if ($input['old_price'] != null || $input['price'] != null) {
            $price =  Price::create([
                'old_price' => intval(str_replace(',', '', Helper::persian2LatinDigit($input['old_price']))),
                'price' => intval(str_replace(',', '', Helper::persian2LatinDigit($input['price']))),
                'priceable_id' => $product->id,
                'priceable_type' => 'App\Models\Product',
            ]);
        }
        if ($request->has('tag_id')) {
            $tags = $request->tag_id;
            Taggable::where('taggable_id', $product->id)->where('taggable_type', 'App\Models\Product')->delete();
            foreach($tags as $tag)
            {
                Taggable::create([
                    'taggable_type' => 'App\Models\Product',
                    'taggable_id' => $product->id,
                    'tag_id'=> $tag,
                ]);
            }
        }
        $product->categories()->detach();
        $product->assignCategory($request['category_id']);
        $array = array($input);
        $serialized_array = serialize($array);
        $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $product->id);
        if ($request->has('back')) {
            return Redirect::back()->with('success', 'کد مورد نظر با موفقیت ویرایش شد');
        } else {
            return Redirect::action('Admin\ProductController@getProduct')->with('success', 'آیتم موردنظر با موفقیت ثبت شد.');
        }
    }
    public function getDeleteProduct($id)
    {
        $content = Product::find($id);
        $order_ids = OrderItem::orderBy('id', 'DESC')->where('product_id', $content->id)->pluck('order_id');
        $order = Order::orderBy('id', 'DESC')->whereIn('id', $order_ids)->whereIn('order_status_id', [1, 2])->first();
        if ($order) {
            return redirect::back()
                ->with('error', 'محصول دارای فاکتور فعال می باشد.');
        } else {
            $array = array($content);
            $serialized_array = serialize($array);

            $log = Logs::log(url()->current(), $serialized_array, Auth::id(), $content->id);
            Product::destroy($id);
            return Redirect::action('Admin\ProductController@getProduct')->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }
    public function postDeleteProduct(Request $request)
    {
        if (Product::destroy($request->get('deleteId'))) {
            ProductCategory::where('product_id', $request->get('deleteId'))->delete();
            return Redirect::back()
                ->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }

    public function postSort(Request $request)
    {
        if ($request->get('update') == "update") {
            $count = 1;
            if ($request->get('update') == 'update') {
                foreach ($request->get('arrayorder') as $idval) {
                    $category = Product::find($idval);
                    $category->sort = $count;
                    $category->save();
                    $count++;
                }
                echo 'با موفقیت ذخیره شد.';
            }
        }
    }

    public function export(Request  $request)
    {
        return Excel::download(new ProductExport($request), 'products.xlsx');
    }
    //========================== PRODUCT IMAGE =================================================

    public function getImage($id)
    {
        $image = Product::find($id);
        if($image == null){
            abort(404);
        }
        $data = Image::whereProductId($image->id)->orderBy('id', 'DESC')->paginate(100);
        return view('admin.product_image.index')->with('data', $data)->with('image', $image);
    }

    public function getAddImage($product_id)
    {
        $image = Product::find($product_id);
        $data = Image::whereProductId($image->id)->paginate(100);
        return view('admin.product_image.add')
            ->with('data', $data)
            ->with('image', $image)
            ->with('product_id', $product_id);
    }

    public function postAddImage(Request $request)
    {
        set_time_limit(2000);
        $product_id = $request->input('product_id');

        if ($request->hasFile('file')) {
            $path = "assets/uploads/content/pro/";
            $uploader = new UploadImg();
            foreach ($request->file('file') as $index => $file) {
                $fileName = $uploader->uploadPic($file, $path);
                $isThumbnail = $request->get('thumbnail') ? 1 : 0;
                if ($fileName) {
                    $newImage = Image::create([
                        'file' => $fileName,
                        'product_id' => $product_id,
                        'thumbnail' => $isThumbnail,
                    ]);
                    if ($isThumbnail) {
                        Image::where('product_id', $product_id)->where('id', '<>', $newImage->id)->update(['thumbnail' => 0]);
                    }
                } else {
                    return Redirect::back()->with('error', 'عکس ارسالی صحیح نیست.');
                }
            }
        }
        return redirect('/adminstrator/products/image/' . $product_id)->with('success', 'آیتم‌های موردنظر با موفقیت ثبت شدند.');
    }

    public function getEditImage($product_id)
    {
        $data = Image::find($product_id);
        return view('admin.product_image.edit')->with('data', $data)->with('product_id', $product_id);
    }

    public function postEditImage($id, Request $request)
    {
        $input = $request->all();
        $input['thumbnail'] = $request->has('thumbnail');
        $image = Image::find($id);
        set_time_limit(2000);
        if ($request->hasFile('file')) {
            $path = "assets/uploads/content/pro/";
            File::delete($path . '/big/' . $image->file);
            File::delete($path . '/medium/' . $image->file);
            File::delete($path . '/small/' . $image->file);
            $uploader = new UploadImg();
            $fileName = $uploader->uploadPic($request->file('file'), $path);
            if ($fileName) {
                $input['file'] = $fileName;
            } else {
                return Redirect::back()->with('error', 'عکس ارسالی صحیح نیست.');
            }
        } else {
            $input['file'] = $image->file;
        }
        $input['product_id'] = $image->product_id;
        $image->update($input);
        if ($input['thumbnail']) {
            Image::where('product_id', $image->product_id)->where('id', '<>', $image->id)->update(['thumbnail' => 0]);
        }
        return \redirect('/adminstrator/products/image/' . $image->product_id)->with('success', 'آیتم موردنظر با موفقیت ویرایش شد.');
    }

    public function editThumbnail($id, Request $request)
    {
        $image = Image::find($id);
        if (!$image) {
            return redirect()->back()->with('error', 'تصویر یافت نشد.');
        }
        $image->update(['thumbnail' => 1]);
        Image::where('product_id', $image->product_id)->where('id', '<>', $image->id)->update(['thumbnail' => 0]);
        return \redirect()->back()->with('success', 'آیتم موردنظر با موفقیت ویرایش شد.');
    }

    public function postDeleteImage(Request $request)
    {
        $images = Image::whereIn('id', $request->get('deleteId'))->pluck('file');
        foreach ($images as $item) {
            File::delete('assets/uploads/content/pro/small/' . $item);
            File::delete('assets/uploads/content/pro/big/' . $item);
            File::delete('assets/uploads/content/pro/medium/' . $item);
        }
        if (Image::destroy($request->get('deleteId'))) {
            return \redirect()->back()->with('success', 'کدهای مورد نظر با موفقیت حذف شدند.');
        }
    }

    //========================== PRODUCT Timer =================================================

    public function getTimer($id)
    {
        $data = Product::find($id);
        return view('admin.timer.add')
            ->with('data', $data)
            ->with('id', $id);
    }

    public function postTimer(Request $request)
    {
        $input = $request->all();
        $product = Product::find($input['product_id']);
        $time = explode('/', $request->get('date'));
        $b = jalali_to_gregorian($time[2], $time[1], $time[0]);
        $hour = explode(':', Help::persian2LatinDigit($input['hour']));
        $date = Carbon::create($b[0], $b[1], $b[2], $hour[0], $hour[1]);
        $product->update([
            'date' => @$date ? @$date : null,
            'timer' => 1
        ]);
        return Redirect::back()
            ->with('success', 'محصول مورد نظر با موفقیت در بخش فروش ویژه قرار گرفت');
    }


    public function postEditTimer($id, Request $request)
    {
        $input = $request->all();
        $product = Product::find($id);
        if (@$input['date']) {
            $time = explode('/', $request->get('date'));
            $b = jalali_to_gregorian($time[2], $time[1], $time[0]);
            $hour = explode(':', Help::persian2LatinDigit($input['hour']));
            $date = Carbon::create($b[0], $b[1], $b[2], $hour[0], $hour[1]);
        }
        $product->update([
            'date' => @$date ? @$date : null,
            'timer' => $request['timer'] ? 1 : 0
        ]);
        return Redirect::back()
            ->with('success', 'محصول مورد نظر با موفقیت ویرایش شد');
    }



    // ======================= Change ================
    public function changePrice(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $pro_id = $input['pro_id'];
        $variable = ProductVariable::where('product_id', $pro_id)->pluck('id');
        if (count($variable) > 0) {
            foreach ($variable as $key => $var_id) {
                $var = ProductVariable::where('id', $var_id)->first();
                foreach ($input['price'] as $key_price => $price) {
                    if ($price == null) {
                        $price = $var->price;
                    } else {
                        if ($key == $key_price) {
                            $var->update([
                                'price' => Helper::persian2LatinDigit($price),
                            ]);
                        }
                    }
                }
                foreach ($input['new_price'] as $key_price => $new_price) {
                    if ($new_price == null) {
                        $new_price = 0;
                    }
                    if($new_price > $input['price'][$key_price] ){
                        return redirect()->back()->with('error', 'قیمت تخفیف نباید بیشتر از قیمت اصلی باشد!!!');
                    }
                    if ($key == $key_price) {
                        $var->update([
                            'discounted_price' => Helper::persian2LatinDigit($new_price),
                        ]);
                    }
                }
                $pricess = Price::firstOrCreate([
                    'priceable_id' => $var->id,
                    'old_price' => $var->price,
                    'price' => $var->discounted_price,
                    'priceable_type' => 'App\Models\ProductVariable',
                ]);
            }
            $variable_prices = ProductVariable::where('product_id', $pro_id)->pluck('price')->toArray();
            $price_min = min($variable_prices);
            $variablesPrice = ProductVariable::where('price',$price_min)->first();
            $product = Product::where('id', $pro_id)->first();
            $product->update([
                'old_price' => $variablesPrice->price ,
                'price' => $variablesPrice->discounted_price,
            ]);
        } else {
            $product = Product::where('id', $pro_id)->first();
            if($input['price'] > $input['old_price']){
                return redirect()->back()->with('error', 'قیمت تخفیف نباید بیشتر از قیمت اصلی باشد!!!');
            }
            $product->update([
                'old_price' => $input['old_price'],
                'price' => $input['price'],
            ]);
            $pricess = Price::create([
                'priceable_id' => $product->id,
                'old_price' => $input['old_price'],
                'price' => $input['price'],
                'priceable_type' => 'App\Models\Product',
            ]);
        }
        return redirect()->back();
    }

    public function changeStock(Request $request)
    {
        $input = $request->all();
        $variables = ProductVariable::where('product_id', $input['pro_id'])->get();
        $stocks = Helper::persian2LatinDigit($input['stock']);
        if (count($variables) > 0) {
            foreach ($variables as $index => $variable) {
                if (!is_numeric($stocks[$index])) {
                    return redirect()->back()->with('error', 'مقدار موجودی باید عدد باشد');
                }
                $stock = $stocks[$index];
                if ($stock != $variable->stock) {
                    InventoryReceipt::create([
                        'product_id' => $input['pro_id'],
                        'inventory_type_id' => 2,
                        'product_variable_id' => $variable->id,
                        'count' => $stock,
                    ]);
                    $variable->update(['stock' => $stock]);
                }
            }
            $product = Product::find($input['pro_id']);
            $sumStock = $variables->sum('stock');
            $minPriceVariable = $product->variable()
                ->where('stock', '<>', 0)
                ->where('price', '<>', 0)
                ->orderBy('price', 'ASC')
                ->first();
            $product->update([
                'count' => $sumStock,
                'price' => $minPriceVariable ? $minPriceVariable->discounted_price : 0,
                'old_price' => $minPriceVariable ? $minPriceVariable->price : 0,
            ]);
        } else {
            $product = Product::find($input['pro_id']);
            $newStock = $input['stock'];
            $difference = $newStock - $product->count;
            $typeId = $difference < 0 ? 2 : 1;
            InventoryReceipt::create([
                'product_id' => $input['pro_id'],
                'inventory_type_id' => $typeId,
                'count' => $difference,
            ]);
            $product->update([
                'count' => $newStock,
            ]);
        }

        return redirect()->back();
    }



}
