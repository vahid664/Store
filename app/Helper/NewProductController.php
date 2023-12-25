<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewProductController extends Controller
{
    protected $index;
    protected $price_type;
    protected $order;
    protected $now;
    protected $limit;

    public function __construct()
    {
        $this->now=Carbon::now()->format('Y/m/d');
    }

    public function setData($index,$order,$limit=0,$price_type=null)
    {
        $this->index=$index;
        $this->price_type=$price_type;
        $this->limit=$limit;
        $this->order=$order;
    }
    public function news()
    {
        $query=Product::active()->where('index',$this->index)
            ->with(['picfirst'])
            ->orderBy('id',$this->order);
        if($this->limit > 0)
        {
            $query->limit($this->limit);
        }
        $query=$query->get();
        return $query;
    }
}
