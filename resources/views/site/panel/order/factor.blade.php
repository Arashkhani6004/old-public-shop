<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/site/css/factor.css?V0.3')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">
</head>

<body>
<button class="print-button" id="print-button">
    چاپ فاکتور
</button>
<div class="page">
    <table class="header-table tableyek" style="width: 100%">
        <tbody>
        <tr>
            <td style="padding: 0 0 5px;">
                <div class="bordered grow header-item-data">
                    <table class="grow centered">
                        <tbody>
                        <tr
                            style="display: flex;align-items: center;justify-content: space-between;">
                            <td
                                style="border: 1px solid #ddd; padding:5px;width: 5cm;font-size: 1rem;text-align: center;">
                                شماره فاکتور : {{@$order->id}}
                            </td>
                            <td style="padding:5px;width: 7cm;font-size: 1rem;font-weight: bolder;text-align: center;">
                                @php
                                    $settings = App\Models\Setting::first();
                                @endphp
                                @if($settings->factor_name != null)
                                    <p style="width: 5cm; font-size: 1rem; text-align: start;">
                                        فرستنده : {{@$settings->factor_name}}
                                    </p>
                                    <p style="width: 8cm; font-size: 1rem; text-align: start;">
                                        ادرس فروشگاه : {{@$settings->factor_address}}
                                    </p>
                                @else
                                    فرستنده : فروشگاه
                                @endif
                            </td>
                        </tr>
                        <tr
                            style="display: flex; align-items: center;justify-content: space-between;">
                            <td style="width: 18cm; font-size: 1rem; text-align: start;">
                                روش ارسال :
                                {{@$order->shipment->title}}

                            </td>
                        </tr>
                        <tr style="display: flex;align-items: center;justify-content: space-between;">
                            <td style="padding:5px;width: max-content;font-size: 1rem">
                                @if(@$order->address->recipient_name != null)
                                    فرستنده :
                                @else
                                    گیرنده :
                                @endif
                                @if(@$order->address->transferee_name != null &&
                                @$order->address->transferee_family != null)
                                    {{@$order->address->transferee_name . ' ' . @$order->address->transferee_family}}
                                @else
                                    @if($order->user->gender == 2)
                                        خانم
                                    @else
                                        آقای
                                    @endif
                                    {{@$order->user->name . ' ' . @$order->user->family}}
                                @endif
                            </td>
                            @if(@$order->address->recipient_name != null)
                                <td style="padding:5px;width: max-content;font-size: 1rem">
                                    @if(@$order->address->recipient_name != null)
                                        نام و نام خانوادگی تحویل گیرنده :
                                    @endif
                                    {{@$order->address->recipient_name}}
                                </td>
                            @endif
                            @if(@$order->address->recipient_phone != null)
                                <td style="padding:5px;width: max-content;font-size: 1rem">
                                    @if(@$order->address->recipient_phone != null)
                                        شماره تماس  تحویل گیرنده :
                                    @endif
                                    {{@$order->address->recipient_phone}}
                                </td>
                            @endif
                            <td style="padding:10px 5px;width: 50%;font-size: 1rem">
                                آدرس:{{@$order->city->state->name}} {{@$order->city->name}}
                                {{@$order->address->location}}
                            </td>
                        </tr>
                        <tr style="display: flex;align-items: center;justify-content: start;">
                            <td style="padding:5px;width: max-content;font-size: 1rem;">
                                تلفن : <span
                                    style="border: 1px solid #ddd;padding: 3px 30px 0;">{{@$order->user->mobile}}</span>
                            </td>
                            <td style="padding:5px;width: max-content;font-size: 1rem;">
                                کد پستی : <span
                                    style="border: 1px solid #ddd;padding: 3px 30px 0;">{{@$order->address->postal_code}}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="content-table tabledo" style="margin-bottom:0.25rem">
        <thead>
        <tr>
            <th class="do">
                نام خریدار : {{@$order->user->name . ' ' . @$order->user->family}}
            </th>
            <th class="do">
                تاریخ خرید : {{jdate(' H:s Y/m/d ',@$order->created_at->timestamp)}}
            </th>
            <th class="chehar">
                تعداد اقلام : {{$order->orderItems->count()}}
            </th>
            <th class="pang">
                روش ارسال :
                {{@$order->shipment->title}}
            </th>
        </tr>
        </thead>
    </table>
    <table class="content-table tablese">
        <thead>
        <tr>
            <th>
                ردیف
            </th>
            <th>
                عکس محصول
            </th>
            <th>
                نام محصول
            </th>
            <th>
                تعداد
            </th>
            <th>
                قیمت اصلی (تومان)
            </th>

            <th>
                مبلغ کل (تومان)
            </th>
        </tr>
        </thead>
        <tbody>
        @php $discount = 0 @endphp
        @foreach($order->orderItems as $key=> $item)
            @if($item->quantity > 0)
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        @if(@$item->productspecification !== null)
                            <img src="{{@$item->productspecification->pro_image}}" height="50" width="50">
                        @else
                            <img src="{{asset('assets/uploads/content/pro/big/'.@$item->product->image[0]->file)}}"
                                    height="50" width="50">
                        @endif
                    </td>
                    <td>
                        <div class="title">
                            {{@$item->product->title . ' | '.@$item->productSpecificationValue->title . ' | '.@$item->product->title_en}}
                        </div>
                    </td>

                    <td>
                        <span class="ltr">
                            {{$item->quantity}}
                    </span>
                    </td>
                    <td>
                        <span class="ltr">
                                        {{number_format(@$item->price)}}
                        </span>
                    </td>
                    <td>
                <span class="ltr">
                {{number_format(@$item->quantity * @$item->price)}}
                </span>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3"></td>

            <td class="font-small">
                <span class="ltr">
                    تعداد کل :@ {{$order->orderItems->sum('quantity')}}
                </span>
            </td>
            <td>
                ــــ
            </td>
            <td>
                <span class="ltr">
                    قیمت کل : {{number_format(@$order->total_prices)}}
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="ltr">
                    شماره فاکتور : {{$order->id}}
                </span>
            </td>
            <td colspan="2">
                <span class="ltr">
                    شماره پیگیری بانک :
                    {{@$order->tracking_code}}

                </span>
            </td>
            <td>
                <span class="ltr">
                    هزینه پست : {{number_format(@$order->post_price)}}
                </span>
            </td>
            <td>
                <span class="ltr">
                    جمع کل پرداختی : {{number_format(@$order->payment)}}
                </span>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<script>
    var printButton = document.getElementById('print-button');
    printButton.addEventListener('click', function () {
        window.print();
    })
    window.onload = function () {
        try {
            if (screen.width >= 300 && screen.width < 500) {
                var mvp = document.getElementById('vp');
                mvp.setAttribute('content', 'initial-scale=0.35,width=device-width');
            } else if (screen.width > 500 && screen.width < 600) {
                var mvp = document.getElementById('vp');
                mvp.setAttribute('content', 'initial-scale=0.6,width=device-width');
            } else if (screen.width > 600 && screen.width < 700) {
                var mvp = document.getElementById('vp');
                mvp.setAttribute('content', 'initial-scale=0.7,width=device-width');
            }

        } catch (e) {

        }
    }
</script>
</body>

</html>
