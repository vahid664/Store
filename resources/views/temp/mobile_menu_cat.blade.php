<ul>
    <li>
        <a title="همه موارد این دسته"
           href="{{ url(Illuminate\Support\Str::slug($parent->title_en)) }}">
            <span class="pr-2 fa fa-angle-left"></span>
            همه موارد این دسته
        </a>
    </li>
    @foreach($child as $item)
        @if($item->childern()->count())
            <li class="sub-menu">
                <a title="{{ $item->title }}" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}">{{ $item->title }}</a>
                @include('temp.mobile_menu_cat',['child' => $item->childern,'parent' => $item])
            </li>
        @else
            <li>
                <a title="{{ $item->title }}" href="{{ url(Illuminate\Support\Str::slug($item->title_en)) }}">{{ $item->title }}</a>
            </li>
        @endif
    @endforeach
</ul>
