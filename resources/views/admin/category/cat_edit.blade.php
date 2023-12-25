@foreach($child as $item)
    @if(in_array($item->id,$query->category_rel->pluck('category_id')->toArray()))
        <option selected value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @else
        <option value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @endif
    @if($item->childern_all->count())
        @php $i++; @endphp
        @if(isset($category_id))
            @include('admin.category.cat_edit',['child' => $item->childern_all ,'i' => $i ,'parent' => $parent])
        @else
            @include('admin.category.cat_edit',['child' => $item->childern_all ,'i' => $i])
        @endif

    @endif
@endforeach
