<?php
/**
 * Created by PhpStorm.
 * User: Behzad
 * Date: 5/30/2019
 * Time: 6:19 PM
 */

namespace App\Helper;

use GuzzleHttp\Client;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Helper
{
    public static function UrlParameterToArray($val)
    {
        $list=[];
        if (strpos($val, ',') !== false)
        {
            $list=explode(',',$val);
        }
        else{
            $list[0]=$val;
        }
        return $list;
    }
    public static function FullDateToYearMonth($val)
    {
        if ($val[1] < 10)
        {
            $val[1]='0'.$val[1];
        }
        $date=implode('-',array_slice($val,0,count($val)-1));
        return [$date.'-01',$date.'-31'];
    }

    public static function toGro($value)
    {
        /*$arr=[];
        $i=0;
        if (is_array($value))
        {
            foreach ($value as $item)
            {
                $ex=explode('/',$item);
                $d=Verta::getGregorian($ex[0],$ex[1],1);
                $arr[$i]=self::FullDateToYearMonth($d);
                $i++;
            }
        }else{*/
            $ex=explode('/',$value);
            $d=Verta::getGregorian($ex[0],$ex[1],1);
            $arr=self::FullDateToYearMonth($d);
       /* }*/
        return $arr;
    }
    public static function ApiValue($value,$message='Success',$code=200)
    {
        return ['response' => $value , 'message' => is_array($message) ? implode(',',$message) : $message , 'code' =>$code];
    }

    public static function CheckIsset($data)
    {
        if(isset($data['_token'])) {
            return count($data) > 1;
        } else {
            return count($data) > 0;
        }
    }
    public static function last_text_article($text)
    {
        $text=str_replace(
            '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">',
            '',$text);
        $text=str_replace('<?xml encoding="utf-8" ?><?xml encoding="utf-8" ?><html><body>','',$text);
        $text=str_replace('</body></html>','',$text);
        return $text;
    }
    public static function getRootDomain($url)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return implode('.', array_slice(explode('.', parse_url($url, PHP_URL_HOST)), -2));
    }
    public static function Nofollow($text)
    {
        $domains = array('stavitastore.net');
        $tell=array('tel:02188930845');
        $dom= new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' .$text);
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        foreach ($dom->getElementsByTagName('a') as $link) {
            $href = $link->getAttribute('href');
            if (!in_array(self::getRootDomain($href), $domains) && !in_array($href,$tell)) {
                if(mb_substr($href, 0, 1) != '#')
                {
                    $link->setAttribute('rel', 'nofollow noreferrer noopener');
                    $link->setAttribute('target', '_blank');
                }
            }
            $link->setAttribute('class', 'text-primary');

        }
        return $dom->saveHTML();
    }
    public static function PriceSend()
    {
        //dd(session('SendPrice'));
        $price=0;
        if(isset(session('SendPrice')->price))
        {

            if (session('basket_price') >= 2000000)
            {
                $price=0;
            }else{
                $price=session('SendPrice')->price;
            }
        }
        /*else
        {
            if(session('basket_price') > 200000)
            {
                $price=0;
            }
            else{
                $price=session('SendPrice');
            }
        }*/
        return $price;
    }

    public static function getTokenSms()
    {
        $client=new Client([
            'verify' => false
        ]);
        $res=$client->post('https://RestfulSms.com/api/Token',
            [
                'form_params' => [
                    'UserApiKey' => '92e24d546ecf7568c544d54',
                    'SecretKey' => 'SHNM0nshi*14241424'
                ]
            ]
        );
        $data=json_decode($res->getBody());
        return $data->TokenKey;
    }

    public static function smsBuy($factor)
    {
        $message=$factor->user->name != '' ?
            $factor->user->name.' عزیز ' :
            ($factor->user->family == '' ?
            $factor->user->mobile : $factor->user->family.' عزیز ');
        $message.=PHP_EOL;
        $message.=' سفارش شما با شناسه 000'.$factor->id.' ثبت شد و در صف انتظار بررسی می باشد. ';
        $message.=PHP_EOL.'با تشکر از اعتماد شما'.PHP_EOL;
        $message.='قالی خانه';
        try {
           // $token=self::getTokenSms();
            $client=new Client([
                'verify' => false
            ]);
            $res=$client->post('https://ippanel.com/services.jspd',
                [
                    'form_params' => [
                        "op" => "send",
                        'uname' => '09128556039',
                        'pass' => 'sina8991',
                        'message' => $message,
                        'from' => '3000505',
                        "to" => substr($factor->user->mobile, 1)
                    ]
                ]
            );
            $data=json_decode($res->getBody());
            return $data;
        }catch (\Exception $exception){}
    }

    public static function smsTest()
    {
        $message='بهزاد میرزازاده '.' عزیز ';
        $message.=PHP_EOL;
        $message.=' خرید شما با شناسه 000'.'12'.' ثبت شد. ';
        $message.=PHP_EOL.'زندگی زیباست!'.PHP_EOL;
        $message.='فروشگاه اینترنتی قالی خانه';
        try {
            // $token=self::getTokenSms();
            $client=new Client([
                'verify' => false
            ]);
            $res=$client->post('https://ippanel.com/services.jspd',
                [
                    'form_params' => [
                        "op" => "send",
                        'uname' => '09128556039',
                        'pass' => 'sina8991',
                        'message' => $message,
                        'from' => '3000505',
                        "to" => 9128556039
                    ]
                ]
            );

            $data=json_decode($res->getBody());
            return $data;
        }catch (\Exception $exception){
            dd($exception);
        }
    }

    public static function getImage($value)
    {
        if ($value != null)
        {
            return asset($value->link);
        }
        return asset('img/default.png');
    }

    public static function getImageAlt($value)
    {
        if ($value != null)
        {
            return $value->title;
        }
        return '';
    }

    public static function getTypePermission($title)
    {
        $route=Route::getCurrentRoute()->getName();
        if($route != null)
        {
            $explode=explode('.',$route);
            $route=strtolower(Arr::first($explode)).'-'.$title;
        }
        return $route;
    }

    public static function type_to_title_product_detail($value)
    {
        $title='';
        switch ($value)
        {
            case 1:
                $title='ویژگی های محصول';
                break;
            case 2:
                $title='مشخصات کلی';
                break;
            case 3:
                $title='امکانات';
                break;
            case 4:
                $title='سایر مشخصات';
                break;
			case 5:
                $title='ویدئو';
                break;
        }
        return $title;
    }

    public static function number_latin_to_persian($a)
    {
        $rep=str_replace('0','۰',$a);
        $rep=str_replace('1','۱',$rep);
        $rep=str_replace('2','۲',$rep);
        $rep=str_replace('3','۳',$rep);
        $rep=str_replace('4','۴',$rep);
        $rep=str_replace('5','۵',$rep);
        $rep=str_replace('6','۶',$rep);
        $rep=str_replace('7','۷',$rep);
        $rep=str_replace('8','۸',$rep);
        $rep=str_replace('9','۹',$rep);
        return $rep;
    }

    public static function number_persian_to_latin($a)
    {
        $rep=str_replace('۱','1',$a);
        $rep=str_replace('۰','0',$rep);
        $rep=str_replace('۲','2',$rep);
        $rep=str_replace('۳','3',$rep);
        $rep=str_replace('۴','4',$rep);
        $rep=str_replace('۵','5',$rep);
        $rep=str_replace('۶','6',$rep);
        $rep=str_replace('۷','7',$rep);
        $rep=str_replace('۸','8',$rep);
        $rep=str_replace('۹','9',$rep);
        return $rep;
    }
}
