<?php

namespace App\Http\Controllers\Api\Snapp\V1\Product;

use App\FactorSnapp;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Snapp\Product\Products;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group  Product
 *
 * APIs for managing users
 */
class ProductController extends Controller
{

    /**
     * List Product with paginate 1000
     * @queryParam  page The page number to return
     * @response{
     *  "response": {
    "data": [
    {
    "id": 3,
    "title": "شامپو استم سل مخصوص موهای خشک و آسیب دیده حجم 250 میلی لیتر",
    "title_en": "stem cell dry and damage therapy",
    "link": "http://stavita.test/product/3-stem-cell-dry-and-damage-therapy",
    "price": "66000",
    "entity": 0,
    "status": 0,
    "short_text": null,
    "long_text": "<p style=\"text-align:justify\">استم سل علاوه بر حذف سولفات، تمام پارابن&zwnj;ها، سیلیکون&zwnj;ها و 7 ماده مضرو سرطانی دیگر را نیز از ترکیب خود حذف کرده است.استفاده از این شامپو باعث آبرسانی و بهبود خشکی پوست سر شده و از مشکلات ناشی از موی خشک و آسیب دیده از جمله ریزش مو، نازک شدن تار موها، شوره سر، خارش پوست سر و &hellip; نیز پیشگیری می کند ، همچنین این شامپوها سبوم (چربی) نرمال پوست سر را حفظ می نماید. و به تسریع جریان خون در پوست سر کمک کرده و باعث تسکین التهاب می شود. محتویات این شامپو ترکیبات گیاهی موثر عصاره بابونه، عصاره آلوئه ورا، پروتئین هیدرولیز شده سبزیجات، پروویتامینB5 و شی باتر و روغن آرگان و روغن جوانه گندم می باشد.شی باتر به عنوان یک لایه محافظتی قوی اطراف مو آن را در برابر آسیب های احتمالی اتو مو و سشوار مصون نگه می دارد.روغن آرگان، باعث رشد موی سالم و قوی به جای موی ضعیف و شکننده میشود.و در از بین بردن وز شدگی مو و موخوره بسیار موثر است.و موجب نرمی ،&zwnj; لطافت و درخشندگی موها میشود. همچنین روغن جوانه گندم حاوی مقادیر بالایی از ویتامینE و A و D و سرشار از پروتئین است و در درمان ریزش مو، رفع شوره سر و تقویت موی سر موثر می باشد، و آثار زیانبار رادیکالهای آزاد را خنثی نموده و برای موهای خشک بسیار مفید است. نا گفته نماند تمامی شامپوهای استم سل مناسب برای شستشو بعد از کراتینه کردن ، دکلره و رنگ مو است.</p>",
    "color": [],
    "size": {
    "data": [
    {
    "title": "متوسط"
    }
    ]
    },
    "brand": {
    "title": "ال جی",
    "title_en": "LG",
    "link": "http://stavita.test/brand/lg"
    },
    "pics": {
    "data": [
    {
    "title": "شامپو استم سل مخصوص موهای خشک و آسیب دیده حجم 250 میلی لیتر",
    "link": "http://stavita.test/upload/product/2020/09/26212841.jpg"
    }
    ]
    }
    },
    {
    "id": 4,
    "title": "شامپو استم سل پرو مخصوص موهای هایلایت و رنگ شده مدل Colour Care حجم 250 میلی لیتر",
    "title_en": "Pro stem cell color care shampoo",
    "link": "http://stavita.test/product/4-pro-stem-cell-color-care-shampoo",
    "price": "46000",
    "entity": 5,
    "status": 1,
    "short_text": null,
    "long_text": "<p>شامپوی حرفه&zwnj;ای&nbsp;<strong>استم سل پرو&nbsp;</strong>با استفاده از مواد کاملا گیاهی و مواد موثره ملایم و فاقد هرگونه مواد شیمیایی مضر می&zwnj;باشد و بدون آسیب به پوست سر و ایجاد خشکی موجب تقویت موهای هایلایت و رنگ شده گشته و به بهبود ساختار مو، درخشندگی بیشتر و دوام رنگ موها کمک می&zwnj;نماید.</p>\r\n\r\n<p><strong>دستور مصرف</strong>: مقدار مناسبی از شامپو را روی موهای خیس ماساژ داده و در حین شستشو آب اضافه نموده و به طور کامل آبکشی نمایید.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ویژگی&zwnj;های این محصول</p>\r\n\r\n<ul>\r\n\t<li>فاقد هرگونه مواد شیمیایی</li>\r\n\t<li>بدون آسیب به پوست</li>\r\n\t<li>بدون ایجاد خشکی پوست سر</li>\r\n\t<li>آبرسانی و احیای موهای دکلره، رنک و هایلایت شده</li>\r\n\t<li>فاقد سولفات، پارابن و نمک</li>\r\n\t<li>فاقد مواد شیمیایی مضر تثبیت کننده رنگ مو</li>\r\n\t<li>مناسب برای بعد از کراتین، صافی و ریباندینگ</li>\r\n</ul>",
    "color": [],
    "size": {
    "data": [
    {
    "title": "متوسط"
    }
    ]
    },
    "brand": {
    "title": "استم سل",
    "title_en": "Stem Cell",
    "link": "http://stavita.test/brand/stem-cell"
    },
    "pics": {
    "data": [
    {
    "title": "شامپو استم سل پرو مخصوص موهای هایلایت و رنگ شده مدل Colour Care حجم 250 میلی لیتر",
    "link": "http://stavita.test/upload/product/2020/09/21950523.jpg"
    }
    ]
    }
    },
    {
    "id": 5,
    "title": "شامپو ضد ریزش و تقویت کننده موهای چرب استم سل پرو مدل Oily Scalp حجم 250 میلی لیتر",
    "title_en": "pro stem cell anti hair loss care",
    "link": "http://stavita.test/product/5-pro-stem-cell-anti-hair-loss-care",
    "price": "9000",
    "entity": 0,
    "status": 0,
    "short_text": null,
    "long_text": "<p>شامپوی حرفه&zwnj;ای&nbsp;<strong>استم سل پرو&nbsp;</strong>با استفاده از مواد کاملا گیاهی و مواد موثره ملایم و فاقد هرگونه مواد شیمیایی مضر می&zwnj;باشد و با جلوگیری از خشکی بیش از حد و آسیب به پوست سر و موها چربی ااضافی را از بین می&zwnj;برد و ترشح چربی غدد سسباسه را کنترل و تنظیم می&zwnj;کند.</p>\r\n\r\n<p><strong>دستور مصرف</strong>: مقدار مناسبی از شامپو را روی موهای خیس ماساژ داده و در حین شستشو آب اضافه نموده و به طور کامل آبکشی نمایید.</p>",
    "color": [],
    "size": [],
    "brand": {
    "title": "ال جی",
    "title_en": "LG",
    "link": "http://stavita.test/brand/lg"
    },
    "pics": {
    "data": [
    {
    "title": "شامپو ضد ریزش و تقویت کننده موهای چرب استم سل پرو مدل Oily Scalp",
    "link": "http://stavita.test/upload/product/2020/09/13015363.jpg"
    }
    ]
    }
    },
    {
    "id": 6,
    "title": "شامپو استم سل پرو مدل Hair loss care حجم 250 میلی لیتر",
    "title_en": "stem cell pro hair loss care",
    "link": "http://stavita.test/product/6-stem-cell-pro-hair-loss-care",
    "price": "46000",
    "entity": 6,
    "status": 1,
    "short_text": null,
    "long_text": "<p>شامپوی حرفه&zwnj;ای&nbsp;<strong>استم سل پرو&nbsp;</strong>با استفاده از مواد کاملا گیاهی و مواد موثره ملایم و فاقد هرگونه مواد شیمیایی مضر می&zwnj;باشد و موجب جلوگیری از حشکی و آسیب به پوست سر و موها می&zwnj;شود. فعالیت آنزیم 5-آلفا-ردوکتاز را مهار کرده و از تولید DHT (عامل اصلی ریزش مو) پیشگیری می&zwnj;نماید.</p>\r\n\r\n<p><strong>دستور مصرف</strong>: مقدار مناسبی از شامپو را روی موهای خیس ماساژ داده و در حین شستشو آب اضافه نموده و به طور کامل آبکشی نمایید.</p>",
    "color": [],
    "size": [],
    "brand": {
    "title": "استم سل",
    "title_en": "Stem Cell",
    "link": "http://stavita.test/brand/stem-cell"
    },
    "pics": {
    "data": [
    {
    "title": "شامپو استم سل پرو مدل Hair loss care",
    "link": "http://stavita.test/upload/product/2020/09/34813177.jpg"
    }
    ]
    }
    },
    {
    "id": 7,
    "title": "شامپو استم سل پرو مخصوص موهای خشک و آسیب دیده مدل Dry & Damage Care حجم 250 میلی لیتر",
    "title_en": "pro stem cell dry and damage shampoo",
    "link": "http://stavita.test/product/7-pro-stem-cell-dry-and-damage-shampoo",
    "price": "46000",
    "entity": 6,
    "status": 1,
    "short_text": null,
    "long_text": "<p>شامپوی حرفه&zwnj;ای&nbsp;<strong>استم سل پرو&nbsp;</strong>با استفاده از مواد کاملا گیاهی و مواد موثره ملایم و فاقد هرگونه مواد شیمیایی مضر می&zwnj;باشد و بدون آسیب به پوست سر و ایجاد خشکی، موها را آبرسانی و تقویت می&zwnj;کند.</p>\r\n\r\n<p><strong>دستور مصرف</strong>: مقدار مناسبی از شامپو را روی موهای خیس ماساژ داده و در حین شستشو آب اضافه نموده و به طور کامل آبکشی نمایید.</p>",
    "color": [],
    "size": [],
    "brand": {
    "title": "استم سل",
    "title_en": "Stem Cell",
    "link": "http://stavita.test/brand/stem-cell"
    },
    "pics": {
    "data": [
    {
    "title": "شامپو استم سل پرو مخصوص موهای خشک و آسیب دیده مدل Dry & Damage Care",
    "link": "http://stavita.test/upload/product/2020/09/43622496.jpg"
    }
    ]
    }
    }
    ],
    "pagination": {
    "total": 69,
    "count": 5,
    "per_page": 5,
    "current_page": 1,
    "total_pages": 14
    }
    },
    "message": "Success",
    "code": 200
     * }
     */
    public function index()
    {
        $query=Product::active()->where('price','>',0)->paginate(1000);
        return Helper::ApiValue(new Products($query));
    }

    /**
     * Get Product Details
     * @response{
    "response": {
    "id": 72,
    "title": "نرم کننده و ترمیم کننده ال جی سری Elastine مدل Silk Repair Shining حجم 400",
    "title_en": "LG silk repair shining elastine conditioner",
    "link": "http://stavita.test/product/72-lg-silk-repair-shining-elastine-conditioner",
    "price": "380000",
    "entity": 1,
    "status": 1,
    "short_text": "<ul>\r\n\t<li>مناسب&nbsp;موهای خشک و موهای آسیب دیده</li>\r\n\t<li>&nbsp;ترمیم کننده، درخشان کننده و نرم کننده موهای آسیب دیده و خشک</li>\r\n\t<li>دارای روغن نارگیل</li>\r\n\t<li>\r\n\t<p>نرم&zwnj;کننده و ترمیم کننده</p>\r\n\t</li>\r\n</ul>",
    "long_text": "<ul>\r\n\t<li>مناسب&nbsp;موهای خشک و موهای آسیب دیده</li>\r\n\t<li>&nbsp;ترمیم کننده، درخشان کننده و نرم کننده موهای آسیب دیده و خشک</li>\r\n\t<li>دارای روغن نارگیل</li>\r\n\t<li>\r\n\t<p>نرم&zwnj;کننده و ترمیم کننده</p>\r\n\t</li>\r\n</ul>",
    "color": {
    "data": [
    {
    "title": "سبز",
    "color": "#00ff11",
    "title_factory": "st000"
    },
    {
    "title": "قرمز",
    "color": "#ff0000",
    "title_factory": "stro33"
    },
    {
    "title": "ان 1",
    "color": "#bb936f",
    "title_factory": "stn01"
    }
    ]
    },
    "size": {
    "data": [
    {
    "title": "کوچک"
    }
    ]
    },
    "brand": {
    "title": "ال جی",
    "title_en": "LG",
    "link": "http://stavita.test/brand/lg"
    },
    "pics": {
    "data": [
    {
    "title": "dsds",
    "link": "http://stavita.test/upload/product/2020/11/61866559.png"
    }
    ]
    }
    },
    "message": "Success",
    "code": 200
     * }
     */
    public function show($id)
    {
        $query=Product::active()->findOrFail($id);
        return Helper::ApiValue(new \App\Http\Resources\Snapp\Product\Product($query));
    }

    /**
     * Update Entity Product
     * @bodyParam  _method string required value PUT.  Example: PUT
     * @bodyParam  entity numeric required Number of user purchases of the desired product. Example: 2
     * @response{
     * "response": {
     * "response": null,
     * "message": "ثبت موفق خرید اسنپ",
     * "code": 200
     * }
     * }
     */
    public function update(Request $request, $id)
    {
        $query=Product::active()->findOrFail($id);
        $validator=Validator::make($request->all(),[
            'entity' => 'required|numeric',
        ]);
        if($validator->fails()) {
            return Helper::ApiValue(null,$validator->errors()->all(),400);
        }
        if ($query->status == 1 && $request->entity <= $query->entity)
        {
            $entity_save=$query->entity - $request->entity;
            $query->update(['entity' => $entity_save]);
            FactorSnapp::create([
                'product_id' => $id,
                'entity' => $request->entity,
                'price' => $query->price
            ]);
            return Helper::ApiValue(null,'ثبت موفق خرید اسنپ');
        }
        return Helper::ApiValue(null,'موجودی ناکافی',400);
    }


}
