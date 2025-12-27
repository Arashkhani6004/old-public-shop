<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use App\Http\Requests\ContactRequest;
use App\Library\Helper;
use App\Library\Relate;
use App\Library\SliderBanner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Comment;
use App\Models\Ista;
use App\Models\Like;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\ProductSpecificationType;
use App\Models\ProductSpecificationTypeCategory;
use App\Models\Properties;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\RelateData;
use App\Models\Sloagen;
use App\Models\Social;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\ProductVariable;
use App\Models\Image;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

use App\Models\Setting;
use App\Models\Price;
use App\Models\Role;
use App\Models\InventoryReceipt;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function getIndex()
    {


        $setting = Setting::first();



        $sliders = Content::orderby('sort', 'ASC')->Slider()->whereStatus('0')->get();
        $slider = Content::orderby('sort', 'ASC')->Slider()->whereStatus('1')->get();
        $brands = Brand::orderby('id', 'DESC')->whereStatus('1')->take(9)->get();
        $categories = Category::orderby('sort', 'ASC')->whereStatus('1')->take(8)->get();
        $discounts_products = Product::orderBy('id', 'DESC')->where('status', 1)->whereNotNull('price')->whereNotNull('old_price')->where('price', '>', 0)->where('old_price', '>', 0)->where('count', '>', 0)->whereColumn('old_price', '>', 'price')->Active()->take(10)->get();
        $new_products = Product::orderby('id', 'DESC')->where('status', 1)->where('newest', '1')->Active()->take(10)->get();
        $popular_products = Product::orderby('sort', 'ASC')->where('status', 1)->where('popular', '1')->Active()->take(10)->get();
        $most_products = Product::orderby('sort', 'ASC')->where('status', 1)->where('special', '1')->Active()->take(10)->get();
        $timer_products = Product::orderby('sort', 'ASC')->where('status', 1)->where('price', '>', 0)->where('timer', '1')->Active()->where('date', '>', Carbon::now())->take(6)->get();
        $articles = Content::orderby('id', 'DESC')->Article()->whereNotNull('image')->whereStatus('1')->take(4)->where('baner_type', '<>', '1')->get();
        $article_s = Content::orderby('id', 'DESC')->Article()->whereNotNull('image')->whereStatus('1')->where('baner_type', '1')->first();
        return view('site.first-page.index')
            ->with('brands', $brands)
            ->with('banners', SliderBanner::Banner())
            ->with('mobiles', SliderBanner::Mobile())
            ->with('sliders', $sliders)
            ->with('slider', $slider)
            ->with('new_products', $new_products)
            ->with('discounts_products', $discounts_products)
            ->with('popular_products', $popular_products)
            ->with('most_products', $most_products)
            ->with('timer_products', $timer_products)
            ->with('articles', $articles)
            ->with('article_s', $article_s)
            ->with('categories', $categories);
    }
    public function getMost()
    {
        $most_products = Product::orderby('sort', 'ASC')->where('special', '1')->Active()->get();
        return view('site.most-list.index')
            ->with('most_products', $most_products);
    }
    public function getCategory()
    {
        $categories = Category::orderby('sort', 'ASC')->get();
        return view('site.product-category.index')
            ->with('categories', $categories);
    }
    public function getDiscounts()
    {
        $discounts_products = Product::orderBy('id', 'DESC')->where('status', 1)->whereNotNull('price')->whereNotNull('old_price')->where('price', '>', 0)->where('old_price', '>', 0)->where('count', '>', 0)->whereColumn('old_price', '>', 'price')->Active()->get();
        return view('site.discounts-list.index')
            ->with('discounts_products', $discounts_products);
    }
    public function getPopular()
    {
        $popular_products = Product::orderby('sort', 'ASC')->where('status', 1)->where('popular', '1')->Active()->get();
        return view('site.popular-list.index')
            ->with('popular_products', $popular_products);
    }
    public function getTimer()
    {
        $timer_products = Product::orderby('sort', 'ASC')->where('status', 1)->where('price', '>', 0)->where('timer', '1')->Active()->where('date', '>', Carbon::now())->get();
        return view('site.timer-product-list.index')
            ->with('timer_products', $timer_products);
    }
    public function getNew()
    {
        $new_products = Product::orderby('id', 'DESC')->where('status', 1)->where('newest', '1')->Active()->get();
        return view('site.new-list.index')
            ->with('most_products', $new_products);
    }
    public function banner(Request $request, $id)
    {
        $seg = $request->segments();
        $banner = Content::findOrFail($id);
        return view('site.banner', compact('banner'));
    }
    public function brandList()
    {
        $brands = Brand::all();
        return view('site.brands-list.index', compact('brands'));
    }
    public function brandDetail(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }

        $brand = Brand::whereUrl($id)->first();
        if (!$brand) {
            return redirect('/');
        }
        $products = Product::orderBy('id', 'DESC')->whereBrandId($brand->id)->get();
        $proid = $products->pluck('id');
        $cat_pro = ProductCategory::whereIn('product_id', $proid)->pluck('category_id');
        $categories = Category::whereIn('id', $cat_pro)->get();
        $max = Product::orderBy('old_price', 'DESC')->whereIn('id', $proid)->where('count', '<>', 0)->first();

        return view('site.brand-detail.index', compact('brand', 'products', 'categories', 'max'));
    }
    public function postNumber(Request $request)
    {
        $input = $request->all();
        $contact = Contact::create($input);
        return redirect()->back()->with('success', 'شماره شما با موفقیت ثبت شد. ');
    }
    public function list(Request $request, $id)
    {
        $seg = $request->segments();
        $category = Category::whereUrl($id)->first();
        if (!$category) {
            return redirect('/');
        }
        $fields = [];

        if ($category->products->count() > 0) {
            $product_ids = ProductCategory::where('category_id', $category['id'])->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $product_ids)->get();
            $max = Product::orderBy('old_price', 'DESC')->whereIn('id', $product_ids)->where('count', '<>', 0)->first();
        } else {
            $c = [];
            foreach ($category->childs as $ch) {
                $c[] = $ch['id'];
                if ($ch->has('childs')) {
                    foreach ($ch->childs as $child) {
                        $c[] = $child['id'];
                    }
                }
            }
            $product_ids = ProductCategory::whereIn('category_id', $c)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $product_ids)->get();
            $max = Product::orderBy('old_price', 'DESC')->whereIn('id', $product_ids)->where('count', '<>', 0)->first();
        }
        if ($category->products->count() > 0) {
            $fieldId = ProductSpecificationTypeCategory::whereCategoryId($category->id)->pluck('pst_id')->all();
            $fields = ProductSpecificationType::whereIn('id', $fieldId)->where('status', 1)->whereNull('parent_id')->with('children')->get();
        } else {
            $c = [];
            foreach ($category->childs as $ch) {
                $c[] = $ch['id'];
                if ($ch->has('childs')) {
                    foreach ($ch->childs as $child) {
                        $c[] = $child['id'];
                    }
                }
                $fieldId = ProductSpecificationTypeCategory::whereIn('category_id', $c)->pluck('pst_id')->all();
                $fields = ProductSpecificationType::whereIn('id', $fieldId)->where('status', 1)->whereNull('parent_id')->with('children')->get();
            }
        }
        $brand_ids = $products->pluck('brand_id');
        $brands = Brand::whereIn('id', $brand_ids)->get();

        return view('site.product-list.index', compact('category', 'fields', 'products', 'brands', 'max'));
    }

    public function detail($id)
    {
        $product = Product::whereUrl($id)->first();
        if (!$product) {
            return redirect('/');
        }
        $specificationsa_types = ProductSpecificationType::whereHas('sp', function ($query2) use ($id, $product) {
                $query2->where('product_id', $product->id)->whereHas('prices');
            })->get();
        $specifications = $product->specifications()->get();
        $parents = [];
        foreach ($specifications as $p) {
            $parents[] =
                @$p->parent->id;;
        }
        $types = ProductSpecificationType::whereIn('id', $parents)->orderBy('sort', 'ASC')->get();
        $typeIds = $types->pluck('id');
        $product_specifications = ProductSpecification::where('product_id', $product->id)->whereIn('product_specification_type_id', $typeIds)->get();
        $top_properties = Properties::where('product_id', $product->id)->orderby('sort', 'ASC')->whereStatus('1')->get();
        $bottom_properties = Properties::where('product_id', $product->id)->orderby('sort', 'ASC')->whereStatus('0')->get();
        $questions = Question::where('product_id', $product->id)->whereNotNull('answer')->get();
        $comments = Comment::where('commentable_id', $product->id)->whereNull('parent_id')->whereStatus(1)->where('commentable_type', 'App\Models\Product')->get();
        $averageRating = Comment::where('commentable_id', $product->id)
            ->where('commentable_type', 'App\Models\Product')
            ->whereNull('parent_id')
            ->whereStatus(1)
            ->avg('star');
        $comments_count = Comment::where('commentable_id', $product->id)->whereStatus(1)->where('commentable_type', 'App\Models\Product')->count();
        $likes_count = Like::where('likeable_id', $product->id)->where('likeable_type', 'App\Models\Product')->count();
        $relate_ids  =  RelateData::where('datable_id', $product->id)->where('datable_type', 'App\Models\Product')->where('type', 1)->pluck('relatable_id');
        $relate = Product::whereStatus(1)->whereIn('id', $relate_ids)->get();
        $complement_ids  =  RelateData::where('datable_id', $product->id)->where('datable_type', 'App\Models\Product')->where('type', 2)->where('relatable_id', '<>', '-1')->pluck('relatable_id');
        $complement = Product::whereIn('id', $complement_ids)->get();
        $tag_pro = Taggable::where('taggable_id', $product->id)->where('taggable_type', 'App\Models\Product')->pluck('tag_id')->toArray();
        $tags = Tag::whereIn('id', $tag_pro)->whereNotNull('title')->get();
        $categoryId = @$product->cats[0]->id;
        $sloagens = Sloagen::orderby('id', 'DESC')
            ->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })
            ->with('categories')
            ->get();


        return view('site.product-detail.index', compact(
            'product',
            'specifications',
            'top_properties',
            'bottom_properties',
            'questions',
            'comments',
            'comments_count',
            'specificationsa_types',
            'relate',
            'complement',
            'tags',
            'tag_pro',
            'likes_count',
            'sloagens',
            'types',
            'product_specifications',
            'averageRating'
        ));
    }

    public function postComment(CommentFormRequest $request)
    {
        if (Auth::check()) {
            Comment::create([
                'content' => $request->get('content'),
                'title' => $request->get('title'),
                'commentable_id' => $request->get('commentable_id'),
                'commentable_type' => $request->get('commentable_type'),
                'user_id' => Auth::id(),
                'star' => $request->get('star'),
                'status' => 0,
                'readat' => 0,
            ]);
            return \redirect()->back()->with('success', 'دیدگاه شما با موفقیت ثبت گردید.');
        } else {
            return \redirect()->back()->with('error', 'ابتدا وارد شوید.');
        }
    }
    public function postReply(Request $request)
    {
        if (Auth::check()) {
            Comment::create([
                'content' => $request->get('content'),
                'title' => $request->get('title'),
                'commentable_id' => $request->get('commentable_id'),
                'commentable_type' => $request->get('commentable_type'),
                'user_id' => Auth::id(),
                'parent_id' => $request->get('parent_id'),
                'star' => $request->get('star'),
                'status' => 0,
                'readat' => 0,
            ]);
            return \redirect()->back()->with('success', 'دیدگاه شما با موفقیت ثبت گردید.');
        } else {
            return \redirect()->back()->with('error', 'ابتدا وارد شوید.');
        }
    }
    public function postFaq(Request $request)
    {
        Question::create([
            'question' => $request->get('question'),
            'product_id' => $request->get('product_id'),
        ]);
        return \redirect()->back()->with('success', 'پرسش شما با موفقیت ثبت گردید.');
    }
    public function getAbout()
    {
        return view('site.us-new.about-us');
    }
    public function getRules()
    {
        return view('site.us.rules');
    }
    public function getFaq()
    {
        $questions = Question::whereNotNull('answer')->whereNull('product_id')->get();
        return view('site.us.faq')
            ->with('questions', $questions);
    }
    public static function is_english($str)
    {
        if (strlen($str) != strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }
    public function getSearch(Request $request)
    {
        $products = [];
        $brands = [];
        $articles = [];
        if ($request->get('search')) {
            $searchTerm =  Helper::persian2LatinDigit($request->get('search'));
            $products = Product::where('title', 'LIKE', "%{$searchTerm}%")
                ->orWhere('title_en', 'LIKE', "%{$searchTerm}%")
                ->get()->sortByDesc('stockCount');
            $brands = Brand::where('title', 'LIKE', "%{$searchTerm}%")
                ->get();
            $articles = Content::article()->where('title', 'LIKE', "%{$searchTerm}%")
                ->get();
        }
        $mergedResults = collect()->concat($brands)->concat($products)->concat($articles)->toArray();
        $count = count($mergedResults);
        $all = $this->paginate($mergedResults, 10);
        $search = $request->get('search');
        return view('site.us-new.search')
            ->with('all', $all)
            ->with('count', $count)
            ->with('products', $products)
            ->with('brands', $brands)
            ->with('search', $search)
            ->with('articles', $articles);
    }

    public function paginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
    public function contentListByTag($tag)
    {


        $x = str_replace('-', ' ', $tag);
        $seo = Tag::where('url', $tag)->first();
        if (!$seo) {
            abort(404);
        }
        $tags = Tag::where('url', $tag)->pluck('id');

        $data = Taggable::whereIn('tag_id', $tags)->get();

        $count = Taggable::whereIn('tag_id', $tags)->count();
        return view('site.us.tag')
            ->with('count', $count)
            ->with('x', $x)
            ->with('tag', $tag)
            ->with('seo', $seo)
            ->with('data', $data);
    }
    public function blogCat()
    {
        $blogs = Content::orderby('id', 'DESC')->ArticleCat()->get();
        return view('site.blog-category.index')
            ->with('blogs', $blogs);
    }
    public function blogList(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }
        $seg = $request->segments();
        $blog_category = Content::orderby('id', 'DESC')->ArticleCat()->find($id);
        if (!$blog_category) {
            return redirect('/');
        }
        $blogs = Content::orderby('id', 'DESC')->where('parent_id', $id)->get();
        return view('site.blog-list.index')
            ->with('blog_category', $blog_category)
            ->with('blogs', $blogs);
    }
    public function blogDetail(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }
        $seg = $request->segments();
        $blog = Content::orderby('id', 'DESC')->Article()->find($id);
        if (!$blog) {
            return redirect('/');
        }
        $blog->update([
            'view' => $blog->view + 1
        ]);
        $blogs = Content::orderby('id', 'DESC')->where('parent_id', $blog->parent_id)->where('id', '<>', $id)->take(5)->get();
        $comments = Comment::where('commentable_id', $blog->id)->whereNull('parent_id')->whereStatus(1)->where('commentable_type', 'App\Models\Content')->get();
        $comments_count = Comment::where('commentable_id', $blog->id)->whereStatus(1)->where('commentable_type', 'App\Models\Content')->count();
        return view('site.blog-detail.index')
            ->with('blog', $blog)
            ->with('comments_count', $comments_count)
            ->with('comments', $comments)
            ->with('blogs', $blogs);
    }
    public function pageDetail(Request $request, $id)
    {
        if (!$id) {
            abort(404);
        }
        $seg = $request->segments();
        $blog = Ista::orderby('id', 'DESC')
            ->where('url', $id)
            ->withStatus(1)
            ->first();
        if (!$blog) {
            return redirect('/');
        }
        $blogs = Ista::orderby('id', 'DESC')
            ->where('id', '<>', $blog->id)
            ->withStatus(1)
            ->take(5)
            ->get();
        return view('site.page.details')
            ->with('blog', $blog)
            ->with('blogs', $blogs);
    }
    public function getContact()
    {
        $socials = Social::orderby('id')->get();
        return view('site.us-new.contact-us')
            ->with('socials', $socials);
    }
    public function postContact(ContactRequest $request)
    {
        $input = $request->all();
        if (preg_match('/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/', $input['name'])) {
            return redirect()->back()->with('error', 'لطفا برای قسمت نام از کلمات فارسی استفاده کنید');
        } else {
            $contact = Contact::create($input);
            return redirect()->back()->with('success', 'پیام شما با موفقیت ثبت شد.');
        }
    }
    public function tracking()
    {
        $order = null;
        return view('site.tracking')
            ->with('order', $order);
    }
    public function track(Request $request)
    {
        $input = $request->all();
        $user = User::where('mobile', $input['mobile'])->first();
        if ($user) {
            $order = Order::orderby('id', 'DESC')->where('user_id', $user->id)->where('id', $input['ref_id'])->first();
            if ($order == null) {
                return redirect()->back()->with('error', 'کد پیگیری وارد شده اشتباه است');
            } else {
                return view('site.tracking')
                    ->with('order', $order);
            }
        } else {
            return redirect()->back()->with('error', 'کاربری با این شماره وجود ندارد');
        }
    }
    public function all(Request $request)
    {
        $seg = $request->segments();
        $query = Product::whereHas('categories')->pluck('brand_id');
        $brands = Brand::whereIn('id', $query)->get();
        $products = Product::all();
        $max = Product::orderby('old_price', 'DESC')->where('count', '<>', 0)->first();
        return view('site.all-product-list.index', compact('products', 'brands', 'max'));
    }
    public function convert(Request $request)
    {
        $products = Product::get();
        foreach ($products as $product) {
            $product->update([
                'max' => 0
            ]);
        }
    }
    public function get(Request $request)
    {
        $req = $request->all();
        $query = Product::orderBy('id', 'DESC');
        if ($request->get('available')) {
            $query->whereHas('inventoryReceipts', function ($q) {
                $q->where('inventory_type_id', 1);
            });
        }
        $products = $query->paginate(20)->sortByDesc('calcute');
        $product_list = [];
        foreach ($products as $product) {
            $product_list[] = [
                'id' => $product->id,
                'title' => $product->title,
                'url' => '/pro/' . $product->url,
                'price' => $product->price_first['old'],
                'old_price' => $product->price_first['price'],
                'is_available' => $product->stock_count > 1 ? true : false,
            ];
        }
        return response()->json(['products' => $product_list], 200);
    }
    public function FindVariable(Request $request)
    {
        $input = $request->all();
        $variable = ProductVariable::find($input['body']['id']);
        $images = Image::where('product_variable_id', $variable->id)->get();
        if ($variable->discounted_price != null) {
            $price = number_format($variable->discounted_price);
            $price2 = number_format($variable->price);
            $percent = round((($variable->price - $variable->discounted_price) * 100) / $variable->price);
        } else {
            $price = number_format($variable->price);
            $price2 = "";
            $percent = "";
        }
        // dd($variable);
        $allimage = [];
        if (count($images) > 0) {
            foreach ($images as $img) {
                $image1 = asset('assets/uploads/content/pro/small/' . $img->file);
                $image2 = asset('assets/uploads/content/pro/big/' . $img->file);
                $allimage[] = $image1;
            }
        } else {
            $image2 = null;
        }
        if (!file_exists('assets/uploads/content/pro/big/' . $variable->image))
            $image = null;
        else {
            $image = asset('assets/uploads/content/pro/big/' . $variable->image);
        }
        // dd($variable->image && file_exists(asset('assets/uploads/content/pro/big/'.$variable->image)));
        return response()->json(['price' => $price, 'price2' => $price2, 'percent' => $percent, 'variable' => $variable, 'image' => $image, 'allimage' => $allimage, 'image2' => $image2]);
    }
    public function convertPrice()
    {
        $products = Product::whereHas('variable')->orderBy('id', 'ASC')->get();

        foreach ($products as $product) {

            $check = ProductVariable::where('product_id', $product['id'])->where('discounted_price', '<>', 0)->orderBy('discounted_price', 'ASC')->first();
            if ($check != null) {
                $product->update(
                    [
                        'price' => $check['discounted_price'],
                        'old_price' => $check['price']
                    ]
                );
            }
        }
    }

    public function getCaptcha()
    {
        return captcha_img();
    }

    public function checkCaptcha(Request $request)
    {
        if ($request->get('family') == null && $request->get('content') == null) {
            return redirect()->back()->with('error', 'نام/ایمیل الزامیست!');
        }
        $request->merge([
            'captcha' => Helper::persian2LatinDigit($request->input('captcha'))
        ]);

        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'کد امنیتی اشتباه است!'], 422);
        }
        return response()->json(['success' => 'کد امنیتی صحیح است!']);
    }
    public function showRobots()
    {
        $url = route('sitemap');
        $content = "User-agent: *
Allow: /
Sitemap:$url
Disallow: /adminstrator
Disallow: /adminstratorlogin
Disallow: /admin*
Disallow: /search?*
Disallow: *utm_*
Disallow: /panel/*
Disallow: /checkout
Disallow: /privacy-policy
Disallow: /vue*
Disallow: /register*
Disallow: /cart/*";
        return response($content)
            ->header('Content-Type', 'text/plain');
    }
    public function numbersConvert()
    {
        $products = Product::all();
        $convertFields = [
            'title',
            'title_seo',
            'old_price',
            'price',
            'title2',
            'description_seo',
            'description',
            'count',
        ];
        foreach ($products as $product) {
            $changed = false;
            foreach ($convertFields as $field) {
                if (!empty($product->$field)) {
                    $product->$field = Helper::persian2LatinDigit($product->$field);
                    $changed = true;
                }
            }
            if ($changed) {
                $product->save();
            }
        }

        return "Numbers converted successfully!";
    }
}
