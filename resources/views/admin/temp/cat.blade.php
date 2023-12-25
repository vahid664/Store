<ul>
    @foreach($child as $item)
        @if($item->childern()->count())
            <li id="cat{{ $item->id }}"><a onclick="cat({{ $item->id }});">{{ $item->title }}</a>
            @include('admin.temp.cat',['child' => $item->childern])
        @else
            <li id="cat{{ $item->id }}"><a onclick="cat({{ $item->id }});">{{ $item->title }}</a>
        @endif
    @endforeach
</ul>
