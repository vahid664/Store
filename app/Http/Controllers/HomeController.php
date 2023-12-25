<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\Helper\Helper;
use App\Jobs\SendRequestEmail;
use App\Mail\OrderShipped;
use App\Product;
use App\ProductAwesome;
use App\TagProductRelation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }
    public function mail()
    {
        $this->dispatch(new SendRequestEmail());
        return 'Email waaaaaaaaaaaaaaaaaaaas sent';
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //echo date('w');die();

        //return str_replace('public','',$request->url());
        $now=Carbon::now()->format('Y/m/d');
        $advertise=Advertise::active()->where('where_page',1)
            ->whereDate('date_start','<=',$now)
            ->orderBy('sort')
            ->get();
        $advertise=$advertise->map(function ($query) use($now){
            if ($query->date_end != '')
            {
                if($query->date_end >= $now)
                {
                    return $query;
                }
            }
            else
            {
                return $query;
            }
        });

        $product_awesome=ProductAwesome::where('date_start','<=',$now)
            ->where('date_end','>=',$now)->with(['product' => function($q){
                return $q->where('entity','>',0)->where('status',1);
            }])->orderBy('sort')->take(9)->get();
        //return $product_awesome;

        $product_id_awesome=$product_awesome->pluck('product_id')->toArray();
        $product_off=Product::where('price_type',2)
			->active()
            ->whereNotIn('id',$product_id_awesome)
            ->with(['picfirst'])
            ->orderByDesc('id')->limit(20)->get();
        if (count($product_off) >= 5)
        {
            $product_off=$product_off->random(5);
        }
        //return $product_off;
        $best_seller=TagProductRelation::where('tag_id',2)->whereNotIn('product_id',$product_id_awesome)->with(['product_exist'])->orderByDesc('id')->take(15)->get();
        $popular=TagProductRelation::where('tag_id',3)->whereNotIn('product_id',$product_id_awesome)->with(['product_exist'])->orderByDesc('id')->take(15)->get();
        $offer=TagProductRelation::where('tag_id',4)->whereNotIn('product_id',$product_id_awesome)->with(['product_exist'])->orderByDesc('id')->take(15)->get();

        $keywords='قالی خانه';
        $description='قالی خانه';
        $title='قالی خانه';
        return view('home',compact('title','keywords','description','advertise','product_off','product_awesome','best_seller','popular','offer'));
    }

}
