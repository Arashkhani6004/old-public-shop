<?php
return [
    'admin' => 'adminstrator',
    'panel' => 'panel',
    'permisions' => [
        'user' => array(
            'title' => 'مدیران',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'status' => 'وضعیت',
                'special' => 'ویژه',
                'passEdit' => '  ویرایش پسورد',
                'address' => 'آدرس کاربران',
                'editAddress' => 'ویرایش آدرس کاربران',
                'group' => 'مشاهده دسترسی',
                'groupAdd' => 'اضافه دسترسی',
                'groupEdit' => 'ویرایش دسترسی',
                'groupDelete' => 'حذف دسترسی',
            )
        ),
        'users' => array(
            'title' => 'کاربران',
            'access' => array(
                'index' => 'مشاهده',
                'export' => 'خروجی',
            )
        ),
        'products' => array(
            'title' => 'محصولات  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'image'=>'مشاهده تصاویر',
                'imageAdd'=>'اضافه تصاویر',
                'imageEdit'=>'ویرایش تصاویر',
                'imageDelete'=>'حذف تصاویر',
                'sort' => 'مرتب سازی',
                'export' => 'خروجی اکسل',
                'variable' => 'متغیر ها',
                'add-variable' => 'افزودن متغیر',
                'edit-variable' => 'ویرایش متغیر',
                'delete-variable' => 'حذف متغیر',
                'cheng-price' => 'ویرایش قیمت',
                'cheng-stock' => 'ویرایش موجودی',
                'delete-image' => 'حذف عکس متغیر ها',
            )
        ),
        'product-specification-type' => array(
            'title' => 'مشخصه ها  ',
            'access' => array(
                'index' => 'مشاهده',
                'list' => 'مشاهده',
                'add' => 'اضافه',
                'addMain' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'catAdd' => 'دسته',
                'catDelete'=>'حذف دسته',
                'view' => 'نمایش',
                'status' => 'نمایش در فیلتر',
            )
        ),
        'product-specification' => array(
            'title' => 'مشخصات  ',
            'access' => array(
                'list' => 'مشاهده',
                'add' => 'اضافه',
                'order' => 'درخواست',
                'addOrder' => 'اضافه کردن درخواست',
                'delete' => 'حذف',
            )
        ),
        'pages' => array(
            'title' => 'صفحات ایستا  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'sort' => 'مرتب سازی',
            )
        ),
        'articles' => array(
            'title' => 'مقاله  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'sort' => 'مرتب سازی',
            )
        ),
        'article-cat' => array(
            'title' => 'دسته بندی مقاله  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'sort' => 'مرتب سازی',
            )
        ),
        'inventory' => array(
            'title' => ' انبار ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'inventory-receipt' => array(
            'title' => ' رسید انبار ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'export' => 'خروجی اکسل',
            )
        ),
        'status' => array(
            'title' => ' وضعیت ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'departments' => array(
            'title' => ' دپارتمان ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'discounts' => array(
            'title' => 'تخفیف  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'brands' => array(
            'title' => 'برندها  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'sort' => 'مرتب سازی',
            )
        ),
        'category' => array(
            'title' => 'دسته بندی محصولات  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                 'delete' => 'حذف',
                 'search' => 'جستجو',
                 'sort' => 'مرتب سازی',
            )
        ),
        'order' => array(
            'title' => 'فاکتورها  ',
            'access' => array(
                'index' => 'مشاهده',
                'det' => 'جزئیات',
                'status' => 'وضعیت',
                'delete' => 'حذف',
                'export' => 'خروجی اکسل',
            )
        ),
        'shipment' => array(
            'title' => 'روش ارسال  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                 'delete' => 'حذف',
                 'sort' => 'مرتب سازی',
            )
        ),
        'order-status' => array(
            'title' => 'وضعیت فاکتورها',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'tags' => array(
            'title' => 'تگ ها  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'sloagen' => array(
            'title' => 'شعارها',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'slider' => array(
            'title' => ' اسلایدر و بنر',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'sort' => 'مرتب سازی',
            )
        ),
        'mobile-slider' => array(
            'title' => ' اسلایدر و بنر موبایل',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
                'sort' => 'مرتب سازی',
            )
        ),
           'setting' => array(
            'title' => 'تنظیمات',
            'access' => array(
                'index' => 'مشاهده',
                'edit' => 'ویرایش',
                'deleteModalImg' => 'حذف عکس موبایل',
                'deleteModalMobileImg' => 'حذف عکس مودال موبایل',
            )
        ),
        'redirect' => array(
            'title' => 'ریدایرکت',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'delete' => 'حذف',
            )
        ),
        'question' => array(
            'title' => 'سوالات متداول محصولات ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'questions' => array(
            'title' => 'سوالات متداول کلی ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
            )
        ),
        'users-questions' => array(
            'title' => 'سوالات متداول کاربران',
            'access' => array(
                'index' => 'مشاهده',
                'add-answer' => 'پاسخ دادن',
            )
        ),
        'properties' => array(
            'title' => 'سایر مشخصات  ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'uploader' => array(
            'title' => 'آپلودر ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'social' => array(
            'title' => 'تنظیمات شبکه اجتماعی ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'cropper' => array(
            'title' => 'کراپر ',
            'access' => array(
                'index' => 'مشاهده',
            )
        ),
        'comment' => array(
            'title' => 'کامنت ها',
            'access' => array(
                'index' => 'مشاهده',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            )
        ),
        'tickets' => array(
            'title' => 'تیکت',
            'access' => array(
                'index' => 'مشاهده',
                'detail' => 'جزئیات',
                'reply' => 'پاسخ',
                'ticketStatus' => 'وضعیت',
                'ticketReturn' => 'مرجوع',
            )
        ),
        'contact' => array(
            'title' => 'پیام   ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
                'delete' => 'حذف',

            )
        ),
        'sitemap' => array(
            'title' => 'سایت مپ   ',
            'access' => array(
                'index' => 'مشاهده',
                'add' => 'اضافه',
                'edit' => 'ویرایش',
            )
        ),
    ]
];
