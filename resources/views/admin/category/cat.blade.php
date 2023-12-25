@foreach($child as $item)
    @if(isset($query->category_id))
        <option {{ $query->category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @elseif(old('category_id') != '' && in_array($item->id,old('category_id')))
        <option {{ old('category_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @else
        <option value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title }}</option>
    @endif
    @if($item->childern_all->count())
        @php $i++; @endphp
        @if(isset($category_id))
            @include('admin.category.cat',['child' => $item->childern_all ,'i' => $i ,'parent' => $parent])
        @else
            @include('admin.category.cat',['child' => $item->childern_all ,'i' => $i])
        @endif

    @endif
@endforeach
