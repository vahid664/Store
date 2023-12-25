<ul>
    @foreach($child2 as $item)
        {{-- <li>
             <a title="{{ $item2->title }}" href="{{ url(Illuminate\Support\Str::slug($item2->title_en)) }}">{{ $item2->title }}</a>
         </li>--}}
        @if($item->childern()->count())
            <li class="sub-menu">
                <a title="{{ $item->title }}" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}">{{ $item->title }}</a>
                @include('temp.mobile_menu_cat2',['child2' => $item->childern])
            </li>
        @else
            <li>
                <a title="{{ $item->title }}" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}">{{ $item->title }}</a>
            </li>
        @endif
    @endforeach
</ul>
