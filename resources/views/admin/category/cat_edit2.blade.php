@foreach($child as $item)
    @if($item->id$query->category->id)
        <option selected value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @else
        <option value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @endif
    @if($item->childern_all->count())
        @php $i++; @endphp
        @if(isset($category_id))
            @include('admin.category.cat_edit2',['child' => $item->childern_all ,'i' => $i ,'parent' => $parent])
        @else
            @include('admin.category.cat_edit2',['child' => $item->childern_all ,'i' => $i])
        @endif

    @endif
@endforeach
