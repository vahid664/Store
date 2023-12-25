@foreach($child as $item)
    @if(isset($data['category_id']) && in_array($item->id,$data['category_id']))
        <option selected value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @else
        <option value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @endif
    @if($item->childern_all->count())
        @php $i++; @endphp
        @include('admin.category.cat_report',['child' => $item->childern_all ,'i' => $i,'data' => $data])
    @endif
@endforeach
