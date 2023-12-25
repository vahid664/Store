<ul>
    @foreach($child as $item)
        @if($item->child()->count())
            <li id="cat{{ $item->id }}"><a onclick="cat({{ $item->id }});">{{ $item->title }}</a>
            @include('admin.temp.cat-size',['child' => $item->child])
        @else
            <li id="cat{{ $item->id }}"><a onclick="cat({{ $item->id }});">{{ $item->title }}</a>
        @endif
    @endforeach
</ul>
