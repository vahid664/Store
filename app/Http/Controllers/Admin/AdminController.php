<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategoryRelation;
use App\ProvinceCity;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        /*$type2=Product::where('price_type',2)->select('id')->get();
        //return $type2;
        foreach ($type2 as $value)
        {
            $count=ProductCategoryRelation::where('product_id',$value->id)
                ->where('category_id',232)->count();
            if($count==0)
            {
                ProductCategoryRelation::create([
                    'product_id' => $value->id,
                    'category_id' => 232
                ]);
            }
        }*/

       /* $i=0;
        if (($handle = fopen(asset('city.csv'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                //echo $data[3].'<br>';
               ProvinceCity::create([
                    'user_id' => 1,
                    'parent' => $data[1],
                    'title' => $data[3],
                ]);
                $i++;
            }
            fclose($handle);
        }
        echo $i;die();*/
        $v=verta();
        //$v->format('%B');
       // return $v->dayOfWeek;
        $now=Carbon::now()->format('Y/m/d');
        $visit=Visit::whereDate('created_at',$now)->count();
        return view('admin.index',compact('v','visit','now'));
    }
}
