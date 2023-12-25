<ul class="sub-menu nav">
    @foreach($child2 as $item)
        @if($item->childern()->count())
            <li class="list-item list-item-has-children ">
                {{-- @for($j=0;$j<$i;$j++) <i class="now-ui-icons arrows-1_minimal-left menu-child2"></i> @endfor--}}
                <a class="main-list-item nav-link menu-child2" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}" title="{{ $item->title }}">
                    {{ $item->title }}
                </a>
                {{--@php $i++; @endphp--}}
                @include('temp.menu_cat2',['child2' => $item->childern])
            </li>
        @else
            <li class="list-item ">
                {{-- @for($j=0;$j<$i;$j++) <i class="now-ui-icons arrows-1_minimal-left menu-child2"></i> @endfor--}}
                <a title="{{ $item->title }}" class="nav-link px-0" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}">{{ $item->title }}</a>
            </li>
        @endif

    @endforeach
</ul>
