<ul class="nav nav-third-level mr-3">
    <li><a href="{{ url('Admin/Product?cat='.$parent->id) }}"> تمام مطالب {{ $parent->title }}</a></li>
    @foreach($child as $item)
        @if($item->childern_all->count())
            <li>
                <a href="#"> {{ $item->title }} <span class="fa arrow ml-2"></span> </a>
                @include('admin.temp.cat_sidebar',['child' => $item->children])
            </li>
        @else
            <li>
                <a href="{{ url('Admin/Product?cat='.$item->id) }}">{{ $item->title }}</a>
            </li>
        @endif
    @endforeach
</ul>
