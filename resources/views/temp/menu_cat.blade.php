<ul class="sub-menu nav">
    @foreach($child as $item)
        @if($item->childern()->count())
            <li class="list-item list-item-has-children">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
                <a class="main-list-item nav-link " href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}" title="{{ $item->title }}">
                    {{ $item->title }}
                </a>
                @include('temp.menu_cat2',['child2' => $item->childern])
            </li>
        @else
            <li class="list-item list-item-has-children">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
                <a class="main-list-item nav-link" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}" title="{{ $item->title }}">
                    {{ $item->title }}
                </a>
            </li>
        @endif

    @endforeach
    @if($value->pic != '')
        <img src="{{ asset($value->pic) }}" alt="{{ $value->pic_alt }}">
    @endif
</ul>
