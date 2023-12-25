<?php

namespace App\Helper;

use App\Advertise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertiseRepository extends Controller
{
    protected $advertise;
    protected $page;
    protected $date;
    protected $data;
  /*  protected $slider;
    protected $page_top;
    protected $right;
    protected $product;
    protected $end;*/
    public function __construct()
    {
        //$this->advertise=$advertise;
    }

    public function setPD($page,$start=null)
    {
        $this->page=$page;
        $this->date=$start;
    }

    public function findAll()
    {
        $query=Advertise::active()->where('where_page',$this->page)
            ->where('date_start','<=',$this->date)
            ->orderBy('sort')
            ->get();
        //return $query;
        $now=$this->date;
        //return $this->page;
        $data2=$query->map(function ($query) use($now){

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
        $this->data=$data2;
        //return $data2;
        return $this->getDataLast();
    }


    public function getDataLast()
    {
        return [
            'end' => $this->getEnd(),
            'product' => $this->getBetweenProduct(),
            'right' => $this->getRightSidebar(),
            'slider' => $this->getSlider(),
            'top' => $this->getTop(),
        ];
    }

    public function getEnd()
    {
        return $this->data->where('location',5);
    }

    public function getBetweenProduct(){
        return $this->data->where('location',4);
    }

    public function getRightSidebar()
    {
        return $this->data->where('location',3);
    }

    public function getSlider()
    {
        return $this->data->where('location',1);
    }
    public function getTop()
    {
        return $this->data->where('location',2);
    }
}
