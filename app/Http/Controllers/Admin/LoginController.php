<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriveLoginRequest;
use App\Models\Setting;
use App\Models\Role;
use App\Library\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Kavenegar\KavenegarApi;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.logins');

    }

    public function postLogin(Request $request)
    {
    $setting = Setting::first();
    $input = $request->all();
    $password = trim($input['password']);
    $login = Auth::attempt([
        'email' => $request->get('email'),
        'password' => Helper::persian2LatinDigit($password),
        'admin' => 1,
    ]);

    if ($login) {
        return redirect('/adminstrator')->with('success', 'خوش آمدید');
    } else {
        return redirect('/adminstratorlogin')->with('error', 'اطلاعات ورودی اشتباه است');
    }
    }

        public function postResetPassword()
    {

        $setting = Setting::first();
        $user = \App\User::where('admin', '1')->orderBy('id', 'ASC')->first();


        if ((strval($setting->owner_mobile) > 0 && $setting->owner_mobile !== null )|| $setting->owner_email !== null && $user) {
            if ($setting->owner_mobile !== null) {

                $pass = random_int(100000, 999999);
                $user->password = $pass;
                $user->password = bcrypt($pass);

                $user->save();
                try {
                    $api = new KavenegarApi($setting->kave_api);
                    $receptor = $setting->owner_mobile;
                    $token = $pass;
                    $token2 = $user->email;
                    $token3 = "";
                    $template = "password";
                    $type = "sms"; //sms | call
                    $result = $api->VerifyLookup($receptor, $token, $token2, $token3, $template, $type);
                } catch (ApiException $e) {
                    \Log::info($e->errorMessage());
                } catch (HttpException $e) {
                    \Log::info($e->errorMessage());
                }

                return redirect('/adminstratorlogin')->with('success', 'با رمز عبور ارسال شده به شماره اصلی وارد پنل ادمین شوید.');
            } else {
                $pass = random_int(100000, 999999);
                $user->password = $pass;
                $user->password = bcrypt($pass);

                $user->save();

                try {
                    Mail::raw('From:send', function ($message) use ($setting, $pass) {
                        $message->from('resetpassword@mahamitim.com', 'بازیابی رمز عبور ادمین');
                        $message->to($setting->owner_email)->subject('رمز عبور سایت شما تغییر یافت : ' . $pass);
                    });
                } catch (ApiException $e) {
                    \Log::info($e->errorMessage());
                } catch (HttpException $e) {
                    \Log::info($e->errorMessage());
                }

                return redirect('/adminstratorlogin')->with('success', 'با رمز عبور ارسال شده به ایمیل اصلی وارد پنل ادمین شوید.');
            }
        } else {
            return redirect()->back()->with('error', 'شماره مدیریت سایت تنظیم نشده است, لطفا با پشتیبانی ارتباط بگیرید');
        }
    }
}
