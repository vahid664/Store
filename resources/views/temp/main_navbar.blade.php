<nav class="main-menu">
    <div class="container">
        <ul class="list float-right">
            @foreach(\App\Category::where('parent',1)->active()->menu()->with('childern')->orderBy('sort')->get() as $value)
                <li class="list-item list-item-has-children mega-menu mega-menu-col-5">
                    <a class="nav-link" title="{{ $value->title }}" href="{{ url(Illuminate\Support\Str::slug($value->title_en)) }}">{{ $value->title }}</a>
                    @if($value->childern()->count())
                        @include('temp.menu_cat',['child' => $value->childern,'parent' => $value])
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>
