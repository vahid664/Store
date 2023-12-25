@foreach($child as $item)
    <option {{ $query->parent == $item->id ? 'selected' : '' }} value="{{ $item->id }}"> @for($a=0;$a<$i;$a++) - @endfor {{ $item->title == '' ? \Illuminate\Support\Str::limit(strip_tags($item->text),60) : $item->title }}</option>
    @if($item->child->count())
        @php $i++; @endphp
        @include('admin.comment.child',['child' => $item->child ,'i' => $i])
    @endif
@endforeach
