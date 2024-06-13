<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"         => ":attribute باید پذیرفته شده باشد.",
    "active_url"       => "آدرس :attribute معتبر نیست",
    "after"            => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha"            => ":attribute باید شامل حروف الفبا باشد.",
    "lower_upper"            => ":attribute باید شامل حروف کوچک و بزرگ باشد.",
    "num"            => ":attribute باید شامل عدد باشد.",
    "alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array"            => ":attribute باید شامل آرایه باشد.",
    "before"           => ":attribute باید تاریخی قبل از :date باشد.",
    "between"          => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array"   => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean"          => "The :attribute field must be true or false",
    "confirmed"        => ":attribute با تکرار رمز عبور مطابقت ندارد.",
    "date"             => ":attribute یک تاریخ معتبر نیست.",
    "date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
    "different"        => ":attribute و :other باید متفاوت باشند.",
    "digits"           => ":attribute باید :digits رقم باشد.",
    "digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
    "email"            => "فرمت :attribute معتبر نیست.",
    "exists"           => ":attribute انتخاب شده، معتبر نیست.",
    "image"            => ":attribute باید تصویر باشد.",
    "in"               => ":attribute انتخاب شده، معتبر نیست.",
    "integer"          => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip"               => ":attribute باید IP آدرس معتبر باشد.",
    "max"              => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file"    => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes"            => ":attribute باید یکی از فرمت های :values باشد.",
    "min"              => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file"    => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array"   => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in"           => ":attribute انتخاب شده، معتبر نیست.",
    "numeric"          => ":attribute باید شامل عدد باشد.",
    "regex"            => ":attribute یک فرمت معتبر نیست",
    "required"         => "فیلد :attribute الزامی است",
    "required_if"      => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all"=> ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same"             => ":attribute و :other باید مانند هم باشند.",
    "size"             => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string"  => ":attribute باید برابر با :size کاراکتر باشد.",
        "array"   => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone"         => "The :attribute must be a valid zone.",
    "unique"           => ":attribute قبلا انتخاب شده است.",
    "url"              => "فرمت آدرس :attribute اشتباه است.",
    "exists_code"      => "کد ارسالی در سیستم وجود ندارد",
    "expire_code"      => "اعتبار کد ارسالی به پایان رسیده است",
    "used"             => "این کد قبلا مورد استفاده قرار گرفته است",
    "exists_phone"     => "چنین شماره ای در سیستم ثبت نشده است",
    "recaptcha"        => "کپچا اعتبار لازم را ندارد",
    "invalid_nationalCode"        => "کد ملی به درستی وارد نشده است.",
    'captcha' =>'کد امنیتی وارد شده صحیح نمیباشد',
    'jdate'                  => ':attribute معتبر نمی باشد.',
    'jdate_equal'            => ':attribute برابر :date نمی باشد.',
    'jdate_not_equal'        => ':attribute نامساوی :date نمی باشد.',
    'jdatetime'              => ':attribute معتبر نمی باشد.',
    'jdatetime_equal'        => ':attribute مساوی :date نمی باشد.',
    'jdatetime_not_equal'    => ':attribute نامساوی :date نمی باشد.',
    'jdate_after'            => ':attribute باید بعد از :date باشد.',
    'jdate_after_equal'      => ':attribute باید بعد یا برابر از :date باشد.',
    'jdatetime_after'        => ':attribute باید بعد از :date باشد.',
    'jdatetime_after_equal'  => ':attribute باید بعد یا برابر از :date باشد.',
    'jdate_before'           => ':attribute باید قبل از :date باشد.',
    'jdate_before_equal'     => ':attribute باید قبل یا برابر از :date باشد.',
    'jdatetime_before'       => ':attribute باید قبل از :date باشد.',
    'jdatetime_before_equal' => ':attribute باید قبل یا برابر از :date باشد.',
    'rule_check_user_acl' => ':attribute کاربر معتبر نمی باشد.',
    'used_discount' => 'شما از تعداد مجاز استفاده از :attribute فراتر رفته اید.',
    'expired_discount' => ':attribute منقضی شده است.',
    'min_required_discount' => 'حداقل مبلغ سبد خرید باید :amount باشد.',
    'max_required_discount' => 'حداکثر مبلغ سبد خرید باید :amount باشد.',
    'national_code' => ':attribute معتبر نمی باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'table_native'=>array(
        "gt"            =>':attribute باید بزرگتر از :value باشد.',
        "lt"            =>':attribute باید کوچکتر از :value باشد.',
        "gte"            =>':attribute باید بزرگتر یا مساوی با :value باشد.',
        "lte"            =>':attribute باید کوچکتر یا مساوی با :value باشد.',
        "required"      =>':attribute الزامی است.',
    ),
    'attributes' => array(
        'start_date'      => 'تاریخ شروع',
        'expire_datetime' => 'تاریخ انقضا',
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "body" => "متن",
        "comment" => "کامنت",
        "contact" => "مخاطب",
        "contacts" => "مخاطبین",
        "roles" => "نقش ها",
        "code" => "کد",
        'captcha' => 'کد امنیتی',
        'length'=> 'طول کاراکتر',
        'file'=> 'فایل',
        'position' => 'جایگاه',
        'province' => 'استان',
        'district' => 'بخش',
        'village' => 'روستا',
        'smallVillage' => 'آبادی',
        'parentCategory' => 'دسته بندی',
        'category' => 'زیر دسته',
        'cover' => 'تصویر',
        'galleries' => 'گالری',
        'galleries.*' => 'گالری',
        'national_code' => 'کد ملی',
        'verification_code.*' => 'کد تأیید',
        'value' => 'مقدار',
        'attribute' => 'ویژگی',
        'priority' => 'اولویت نمایش',
        'image' => 'تصویر',
        'gallery' => 'گالری',
        'summary' => 'خلاصه',
        'description' => 'توضیحات',
        'sku' => 'شماره SKU',
        'sales_price' => 'قیمت فروش',
        'discount_type' => 'نوع تخفیف',
        'discount_value' => 'مقدار تخفیف',
        'active' => 'فعال',
        'has_comment' => 'کامنت فعال',
        'inventory' => 'موجودی انبار',
        'unit' => 'واحد',
        'option' => 'آپشن',
        'optionValue' => 'مقدار آپشن',
        'categories' => 'دسته بندی',
        'expired_at' => 'تاریخ انقضا',
        'national_code' => 'کد ملی',
        'slug' => 'شناسه محصول',
        'quantity' => 'تعداد',
        'message' => 'پیام',
    ),
);
