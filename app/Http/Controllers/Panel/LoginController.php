<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Library\Helper;
use App\Models\Order;
use App\Models\Basket;
use App\Models\Setting;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

//    public function getLogin()
//    {
//        $check=Auth::check();
//
//        if ($check)
//        {
//            return redirect('/panel/dashboard')->with('success', 'خوش آمدید');
//        } else {
//            return view('site.auth.login');
//        }
//
//    }
    /////==============Pass===========================================
    public function getPassword(Request $request)
    {
        $product_id = @$request->product_id;
        $user = \App\User::where('mobile',$request['mobile'])->first();

        if($request->has('order')){
            return view('site.auth.pass')
                ->with('user',$user)
                ->with('order',1)
                ->with('product_id', $product_id);
        }else{
            return view('site.auth.pass')
                ->with('user',$user)
                ->with('product_id', $product_id);
        }


    }
    public function postPassword(Request $request)
    {
        $setting = Setting::first();
        if ($request['mobile'] != null){
            $user = \App\User::where('mobile',$request['mobile'])->first();


            if($user != null) {
                if ($user->mobile_confirm == 1) {
                    $new = random_int(100000, 999999);
                    $user['temp_password'] = $new;

                    $user->save();
                    try {
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = $user->mobile;
                        $token = $new;
                        $token2 = "";
                        $token3 = "";
                        $template = "password";
                        $type = "sms";//sms | call
                        $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
                    } catch (ApiException $e) {
                        \Log::info($e->errorMessage());
                    } catch (HttpException $e) {
                        \Log::info($e->errorMessage());
                    }
                    if(@$request->has('order')){
                        return redirect('/panel/login-pass/' . $user->mobile.'?order=1')
                            ->with('success', 'با رمز عبور ارسال شده به شماره همراهتان وارد پنل کاربری شوید.')
                            ->with('user',$user);
                    }else{
                        return redirect('/panel/login-pass/' . $user->mobile)
                            ->with('success', 'با رمز عبور ارسال شده به شماره همراهتان وارد پنل کاربری شوید.')
                            ->with('user',$user);
                    }

                }
                else {

                    $code= random_int(100000, 999999);
                    $user['confirm_code'] = $code;
                    $user->save();
                    try{
                        $api = new KavenegarApi($setting->kave_api);
                        $receptor = $user->mobile;
                        $token = $code;
                        $token2 = "";
                        $token3 = "";
                        $template = "verify";
                        $type = "sms";//sms | call
                        $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
                    }
                    catch(ApiException $e){
                        \Log::info($e->errorMessage());
                    }
                    catch(HttpException $e){
                        \Log::info($e->errorMessage());
                    }
                    return redirect('panel/confirm/'.$request['mobile'])->with('error', 'لطفا شماره خود را تایید کنید');

                }
            }
            else
            {
                return redirect()->back()->with('error',' شما در سایت عضو نیستید لطفا ثبت نام کنید');
            }
        }
        else{
            return redirect()->back()->with('error',' لطفا شماره خود را وارد کنید');
        }
    }

    public function postRePassword($mobile)
    {
        $setting = Setting::first();
        $user = \App\User::where('mobile',$mobile)->first();
        if($user)
        {
            $new = random_int(100000, 999999);
            $user['temp_password'] = $new ;

            $user->save();
            try{
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $user->mobile;
                $token = $new;
                $token2 = "";
                $token3 = "";
                $template = "password";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
            }
            catch(ApiException $e){
                \Log::info($e->errorMessage());
            }
            catch(HttpException $e){
                \Log::info($e->errorMessage());
            }
            return redirect('/panel/login-pass/'.$user->mobile)->with('success','با رمز عبور ارسال شده به شماره همراهتان وارد پنل کاربری شوید.');
        }
        else
        {
            return redirect()->back()->with('error',' شما در سایت عضو نیستید لطفا ثبت نام کنید');
        }

    }
 /////==============Login With Pass===========================================
    public function getLoginWpass()
    {
        return view('site.auth.loginwithpass');
    }
    public function getPanelLogin(Request $request)
    {

        $product_id = @$request->product_id;
        if($request->has('order')){
            return view('site.auth.login')
                ->with('product_id', $product_id)
                ->with('order', 1)
                ->with('info', 'کاربر گرامی, برای ادامه فرایند خرید وارد پنل کاربری خود شوید.');
        }elseif($request->has('address')){
            return view('site.auth.login')
                ->with('product_id', $product_id)
                ->with('order', 1)
                ->with('info', 'کاربر گرامی, برای انتخاب ادرس ابتدا وارد پنل کاربری خود شوید.');
        }else{
            return view('site.auth.login')
                ->with('product_id', $product_id);
        }
    }

    /////==============Login Panel===========================================
    public function postPanelLogin(Request $request)
    {

        $input = $request->all();
        $user = User::where('mobile',$request->get('mobile'))->first();

        if ($user->mobile_confirm == 0){

            return redirect('panel/confirm/'.$user->mobile.'?product_id='.@$request->product_id)->with('success', 'لطفا شماره خود را تایید کنید');
        }

            if ($user->temp_password == $request->get('temp_password')){
                Auth::loginUsingId($user->id);
                setcookie('mobileLoginCookie',$request->get('mobile') , time()+(60*60*24*180));
                $user->update([
                    'last_login'=> Carbon::Now(),
                ]);
                $currentOrder = Basket::cookieUser()->whereNull('user_id')->CurrentBasket()->first();
                if($currentOrder){
                $currentOrders = Basket::where('user_id',$user->id)->where('id', '<>', $currentOrder->id)->CurrentBasket()->get();

                    foreach($currentOrders as $row){
                       $row->delete();

                    }
                    $currentOrder->update([
                        'user_id'=>Auth::id()
                    ]);
                }

                if(@$request->has('order')){
                    return redirect('checkout/')->with('success',' ورود شما با موفقیت انجام شد, به خرید خود ادامه بدهید.');
                }else{
                    return redirect('panel/dashboard');
                }
            }
            else {
                return redirect('/panel/login')->with('error', 'رمز عبور اشتباه است');
            }



    }
    /////==============Login===========================================
    public function postLogin(Request $request)
    {
        $input = $request->all();
        $login = request()->input('username');

        if(is_numeric(Helper::persian2LatinDigit($login))){
            $login = Auth::attempt([
                'mobile' => Helper::persian2LatinDigit($login),
                'password' =>Helper::persian2LatinDigit($request->get('password')),
                'mobile_confirm' => true,
                'status' => true,
            ]);
            $user = User::whereMobile($request->get('username'))->first();
        }

        elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $login = Auth::attempt([
                'email' => $login,
                'password' =>Helper::persian2LatinDigit($request->get('password')),
                'mobile_confirm' => true,
                'status' => true,
            ]);
            $user = User::where('email',$request->get('username'))->first();
        }


        if ($login) {
            setcookie('mobileLoginCookie',$request->get('mobile') , time()+(60*60*24*180));
            $user->update([
                'last_login'=> Carbon::Now(),
            ]);
            return redirect('panel/dashboard')->with('success', 'خوش آمدید');
        } else {
            return redirect('/panel/register')->with('error', 'شما ثبت نام نکردید');
        }
    }
    /////==============Register===========================================

    public function getRegister(Request $request)
    {
        $input = $request->all();
        $gender = [

            '2' => 'خانم',
            '1' => 'آقا',
        ];


        $product_id = @$request->product_id;
        if($request->has('order')){
            return view('site.auth.register')
                ->with('order', 1)
                ->with('product_id', $product_id)
                ->with('gender', $gender);
        }else{
            return view('site.auth.register')
                ->with('product_id', $product_id)
                ->with('gender', $gender);
        }

    }

    protected function postRegister(Request $request)
    {
        $input = $request->all();
        $setting = Setting::first();
        
        if ($request->name == null) {
            return redirect()->back()->with('error', 'لطفا نام و نام خانوادگی خود را وارد کنید');
        }
        if ($request->gender == null) {
            return redirect()->back()->with('error', 'لطفا تمام بخش ها را پر کنید');
        }
        if ($request->mobile == null && $request->email == null) {
            return redirect()->back()->with('error', 'لطفا شماره همراه یا ایمیل را وارد کنید');
        }
        if ($request->captcha == null) {
            return redirect()->back()->with('error', 'لطفا کد امنیتی را وارد کنید');
        }

        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'کد امنیتی اشتباه است');
        }

        $code = random_int(10000, 99999);
        $password = bcrypt($request['password']);

        $user = User::create([
            'name' => $input['name'],
            'family' => @$input['family'],
            'gender' => $input['gender'],
            'email' => @$input['email'],
            'mobile' => Helper::persian2LatinDigit(@$input['mobile']),
            'confirm_code' => $code,
            'password' => $password,
            'status' => true,
        ]);
        if ($request->mobile != null){
            try {
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $user->mobile;
                $token = $code;
                $token2 = "";
                $token3 = "";
                $template = "verify";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
            } catch (ApiException $e) {
                \Log::info($e->errorMessage());
            } catch (HttpException $e) {
                \Log::info($e->errorMessage());
            }
            if($request->has('order')){
                return redirect('panel/confirm/'.$user->mobile.'?product_id='.@$request->product_id.'&order=1')->with('success', 'کد تایید ارسال شده به شماره موبایلتان را وارد کنید');
            }else{
                return redirect('panel/confirm/'.$user->mobile.'?product_id='.@$request->product_id)->with('success', 'کد تایید ارسال شده به شماره موبایلتان را وارد کنید');
            }
        }
        elseif($request->email != null){
            Mail::raw('کد تایید:'.$code , function ($message) use ($input)  {
                $message->from("msp-test@fanagahan.com"  , 'From:admin');
                $message->to($input['email'])->subject('کد تایید'.'  To:'.$input['email']);
            });

            if($request->has('order')) {
                return redirect('panel/confirm/'.$user->email.'&order=1')->with('success', 'کد تایید ارسال شده به شماره ایمیلتان را وارد کنید');
            }

            }else{
                return redirect('panel/confirm/'.$user->email)->with('success', 'کد تایید ارسال شده به شماره ایمیلتان را وارد کنید');
            }
        }

    /////==============Confirm===========================================
    public function getConfirm($mobile,Request $request)
    {
        $product_id = @$request->product_id;
        if($request->has('order')){
            return view('site.auth.confirm-code')->with('product_id', $product_id)->with('mobile',$mobile)
                ->with('order',1);
        }else{
            return view('site.auth.confirm-code')->with('product_id', $product_id)->with('mobile',$mobile);
        }
    }
    public function postConfirm(Request $request)
    {
        $input = $request->all();
        $user = User::where('confirm_code', $request->get('confirm_code'))->first();

        if ($user) {
            $user->mobile_confirm = true;
            $user->status = true;
            $user->save();
            $user->assignRole([4]);
            Auth::loginUsingId($user->id);

                  $currentOrder = Basket::cookieUser()->whereNull('user_id')->CurrentBasket()->first();
                if($currentOrder){
                $currentOrders = Basket::where('user_id',$user->id)->where('id', '<>', $currentOrder->id)->CurrentBasket()->get();
                foreach($currentOrders as $row){
                    $x = Basket::find($row->id);
                 $x->delete();
                }
                $currentOrder->update([
                    'user_id'=>Auth::id()
                ]);
            }

            if(@$request->has('order')) {
                return redirect('checkout/')->with('success', 'ثبت نام شما با موفقیت انجام شد, به خرید خود ادامه بدهید.');
            }
            return redirect('panel/dashboard');
        } else {
            return redirect()->back()->with('error', ' کد وارد شده صحیح نمی باشد');
        }
    }
    public function postReCon()
    {

        $input = request()->all();
        $setting = Setting::first();
        $user = \App\User::where('mobile',$input['field'])->orWhere('email',$input['field'])->first();
        if($user)
        {
            $code = random_int(100000, 999999);
            $user['confirm_code'] = $code ;
            $user->save();
            if(is_numeric(Helper::persian2LatinDigit($input['field']))){
                try{
                    $api = new KavenegarApi($setting->kave_api);
                    $receptor = $user->mobile;
                    $token = $code;
                    $token2 = "";
                    $token3 = "";
                    $template = "verify";
                    $type = "sms";//sms | call
                    $result = $api->VerifyLookup($receptor,$token,$token2,$token3,$template,$type);
                }
                catch(ApiException $e){
                    \Log::info($e->errorMessage());
                }
                catch(HttpException $e){
                    \Log::info($e->errorMessage());
                }
            }

            elseif (filter_var($input['field'], FILTER_VALIDATE_EMAIL)) {
                Mail::raw('کد تایید:'.$code , function ($message) use ($input)  {
                    $message->from("msp-test@fanagahan.com"  , 'From:admin');
                    $message->to($input['field'])->subject('کد تایید'.'  To:'.$input['field']);
                });
            }


        }
        else
        {
            return redirect()->back()->with('error',' شما در سایت عضو نیستید لطفا ثبت نام کنید');
        }
        return redirect('panel/confirm/'.$input['field'])->with('success', 'لطفا شماره خود را تایید کنید');

    }
    /////==============Logout===========================================
    public function getlogout()
    {

        Auth::logout();

        return redirect('/')->with('success', 'به امید دیدار مجدد');
    }

    protected function LoginCart(Request $request)
    {
        $input = $request->all();
        $setting = Setting::first();
        $order = Basket::where('id',$request['product_id'])->first();
        $code = random_int(10000, 99999);
        $y =  Helper::persian2LatinDigit($input['mobile']);
        $user = User::where('mobile' , $y)->first();
        if($user){
            $user->update([
                'confirm_code' => $code ,
            ]);
            try {
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $user->mobile;
                $token = $code;
                $token2 = "";
                $token3 = "";
                $template = "verify";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
            } catch (ApiException $e) {
                \Log::info($e->errorMessage());
            } catch (HttpException $e) {
                \Log::info($e->errorMessage());
            }
            if($order){
                $order->update([
                    'user_id' => $user->id,
                ]);
            }
            $currentOrders = Basket::where('user_id',$user->id)->where('id', '<>', @$order->id)->CurrentBasket()->get();
            foreach($currentOrders as $row){
                 $row->delete();

            }
            return response()->json(['check' => 1]);

        }else{
            return response()->json(['check' => 0 ,'err' => 1 ,]);

        }
    }

    public function ConfirmCart(Request $request)
    {
        $input = $request->all();
        $user = User::where('mobile',Helper::persian2LatinDigit($request->get('mobile')))->first();
        $y =  Helper::persian2LatinDigit($input['confirm_code']);
        
        if ($user) {
            if ($user->confirm_code == $y) {
                Auth::login($user);
                $user->update(['mobile_confirm' => 1]);
                return redirect()->back()->with('success', ' با موفقیت وارد شدید . به خرید خود ادامه دهید.');
            } else {
                return redirect()->back()->with('error', ' کد وارد شده صحیح نمی باشد');
            }
        } else {
            return redirect()->back()->with('error', ' کاربر گرامی با این شماره اکانتی وجود ندارد');

        }
    }
    protected function RegisterCart(Request $request)
    {
        $input = $request->all();
        $order = Basket::where('id',$request['product_id'])->first();
        $setting = Setting::first();
        $y =  Helper::persian2LatinDigit($input['mobile']);

        $user = User::where('mobile' , $y)->first();
        if ($user) {
            return response()->json(['check' => 0 ,'err' => 1 ,]);        }
        else{
        $code = random_int(10000, 99999);
            $u = User::create([
                'name' => $request['name'],
                'mobile' => $y,
                'email' => $request['email'],
                'gender' => $request['type'],
                'confirm_code' => $code,
                'status' => true,
            ]);
                if($order){
                $order->update([
                    'user_id' => $u->id,
                ]);
            }
             $currentOrders = Basket::where('user_id',@$u->id)->where('id', '<>', @$order->id)->CurrentBasket()->get();
            foreach($currentOrders as $row){
                $row->delete();

            }
            try {
                $api = new KavenegarApi($setting->kave_api);
                $receptor = $u->mobile;
                $token = $code;
                $token2 = "";
                $token3 = "";
                $template = "verify";
                $type = "sms";//sms | call
                $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
            } catch (ApiException $e) {
                \Log::info($e->errorMessage());
            } catch (HttpException $e) {
                \Log::info($e->errorMessage());
            }
            return response()->json(['check' => 2]);
        }
        if($user){
            $user->update([
                'confirm_code' => $code ,
            ]);


        }else{
            $err = 'کاربری با این شماره وجود ندارد' ;
            return response()->json(['check' => 0 ,'err' => $err ,]);

        }
    }



}
