<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
               {{-- <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('admincssjs/img/profile_small.jpg') }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }} {{ \Illuminate\Support\Facades\Auth::user()->family }}</span>
                        <span class="text-muted text-xs block">مدیریت سیستم<b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="#">پروفایل</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">خروج</a></li>
                    </ul>
                </div>--}}
                <div class="logo-element">
                    J+
                </div>
            </li>

            <li class="active">
                <a href="{{ url('Admin') }}"><i class="fa fa-th-large"></i> <span class="nav-label">داشبورد</span></a>
            </li>

            @can('product-index')
            <li>
                <a href="#"><i class="fa fa-twitter-square"></i> <span class="nav-label"> محصولات</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('product-create')
                    <li><a href="{{ route('Product.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ url('Admin/Product') }}">تمام محصولات</a></li>
                    @foreach(\App\Category::active()->where('parent',1)->get() as $cat)
                        @if($cat->childern_all->count())
                            <li class="mr-3">
                                <a href="#"> {{ $cat->title }} <span class="fa arrow ml-2"></span></a>
                                @include('admin.temp.catsidebar',['childpro' => $cat->childern_all,'parent' => $cat])
                            </li>
                        @else
                            <li class="mr-3"><a href="{{ url('Admin/Product?cat='.$cat->id) }}">{{ $cat->title }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
            @endcan
            @can('productreport-index')
                <li>
                    <a href="{{ url('Admin/ProductReport') }}"><i class="fa fa-cubes"></i> <span class="nav-label">گزارش گیری محصول</span></a>
                </li>
            @endcan
            @can('commentadmin-index')
                <li>
                    <a href="{{ url('Admin/CommentAdmin') }}"><i class="fa fa-comments"></i> <span class="nav-label">نظرات</span></a>
                </li>
            @endcan
            @can('searchadmin-index')
                <li>
                    <a href="#"><i class="fa fa-search"></i> <span class="nav-label">گزارش جستجو</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('Admin/SearchAdmin') }}">لیست</a></li>
                    </ul>
                </li>
            @endcan
            @can('redirect-index')
                <li>
                    <a href="#"><i class="fa fa-map-signs"></i> <span class="nav-label">انتقال</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('redirect-create')
                            <li><a href="{{ route('Redirect.create') }}">افزودن</a></li>
                        @endcan
                        <li><a href="{{ url('Admin/Redirect') }}">لیست</a></li>
                    </ul>
                </li>
            @endcan
            @can('code-index')
                <li>
                    <a href="#"><i class="fa fa-tags"></i> <span class="nav-label">کد تخفیف</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('code-create')
                            <li><a href="{{ route('Code.create') }}">افزودن</a></li>
                        @endcan
                        <li><a href="{{ url('Admin/Code') }}">لیست</a></li>
                    </ul>
                </li>
            @endcan
            @can('gift-index')
                <li>
                    <a href="#"><i class="fa fa-gift"></i> <span class="nav-label">هدیه</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('gift-create')
                            <li><a href="{{ route('Gift.create') }}">افزودن</a></li>
                        @endcan
                        <li><a href="{{ url('Admin/Gift') }}">لیست</a></li>
                    </ul>
                </li>
            @endcan
            @can('peyk-index')
                <li>
                    <a href="#"><i class="fa fa-paper-plane"></i> <span class="nav-label">زمانبندی پیک</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('peyk-create')
                            <li><a href="{{ route('Peyk.create') }}">افزودن</a></li>
                        @endcan
                        <li><a href="{{ url('Admin/Peyk') }}">لیست</a></li>
                    </ul>
                </li>
            @endcan
            @can('color-index')
                <li>
                    <a href="#"><i class="fa fa-twitter-square"></i> <span class="nav-label"> رنگبندی محصولات</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('color-create')
                            <li><a href="{{ route('Color.create') }}">افزودن</a></li>
                        @endcan
                        <li><a href="{{ url('Admin/Color') }}">فهرست</a></li>
                    </ul>
                </li>
            @endcan
            @can('size-index')
                <li>
                    <a href="#"><i class="fa fa-text-height"></i> <span class="nav-label"> سایز محصولات</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('size-create')
                            <li><a href="{{ route('Size.create') }}">افزودن</a></li>
                        @endcan
                        <li><a href="{{ url('Admin/Size') }}">فهرست</a></li>
                    </ul>
                </li>
            @endcan
            @can('factor-index')
            <li>
                <a href="#"><i class="fa fa-industry"></i> <span class="nav-label"> فاکتور</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('Admin/Factor') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('financial-index')
                <li>
                    <a href="{{ route('Financial.index') }}"><i class="fa fa-money"></i> <span class="nav-label">گزارش مالی</span></a>
                </li>
            @endcan
            @can('contact-index')
                <li>
                    <a href="#"><i class="fa fa-comment"></i> <span class="nav-label"> مشاوره</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('Admin/Contact') }}">لیست</a></li>
                    </ul>
                </li>
            @endcan
            @can('user-index')
            <li>
                <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label"> کاربران</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('Admin/User') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('productawesome-index')
            <li>
                <a href="#"><i class="fa fa-product-hunt"></i> <span class="nav-label"> محصولات ویژه</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('productawesome-create')
                    <li><a href="{{ route('ProductAwesome.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('ProductAwesome.index') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('article-index')
            <li>
                <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">مقالات</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('article-create')
                    <li><a href="{{ route('Article.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Article.index') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('brand-index')
            <li>
                <a href="#"><i class="fa fa-paint-brush"></i> <span class="nav-label"> برند</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('brand-create')
                    <li><a href="{{ route('Brand.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Brand.index') }}">لیست</a></li>
                    @can('managementbrand-index')
                        <li><a href="{{ route('ManagementBrand.index') }}">مدیریت محصولات با برند</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('category-index')
            <li>
                <a href="#"><i class="fa fa-reply-all"></i> <span class="nav-label"> دسته بندی</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('category-create')
                    <li><a href="{{ route('Category.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Category.index') }}">لیست</a></li>
{{--                    @can('managementbrand-index')--}}
                        <li><a href="{{ route('ManagementCategory.index') }}">مدیریت محصولات با دسته بندی</a></li>
{{--                    @endcan--}}
                </ul>
            </li>
            @endcan
            @can('advertise-index')
            <li>
                <a href="#"><i class="fa fa-braille"></i> <span class="nav-label"> بنرهای سایت</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('advertise-create')
                    <li><a href="{{ route('Advertise.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Advertise.index') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('tag-index')
            <li>
                <a href="#"><i class="fa fa-tag"></i> <span class="nav-label"> تگ های سایت</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('tag-create')
                    <li><a href="{{ route('Tag.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Tag.index') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('social-index')
            <li>
                <a href="#"><i class="fa fa-facebook"></i> <span class="nav-label"> شبکه های اجتماعی</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('social-create')
                    <li><a href="{{ route('Social.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Social.index') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('page-index')
            <li>
                <a href="#"><i class="fa fa-pagelines"></i> <span class="nav-label">صفحات ثابت</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('page-create')
                    <li><a href="{{ route('Page.create') }}">افزودن</a></li>
                    @endcan
                    <li><a href="{{ route('Page.index') }}">لیست</a></li>
                </ul>
            </li>
            @endcan
            @can('news-index')
            <li>
                <a href="{{ route('News.index') }}"><i class="fa fa-envelope"></i> <span class="nav-label">لیست ایمیل خبرنامه</span></a>
            </li>
            @endcan
            @can('productofferadmin-index')
                <li>
                    <a href="{{ route('ProductOfferAdmin.index') }}">
                        <i class="fa fa-envelope"></i> <span class="nav-label">قیمت های پیشنهادی</span>
                        <span class="position-absolute badge rounded-pill bg-danger mr-2">
                                {{ \App\ProductOffer::where('status',0)->count() }}
                            </span>
                    </a>
                </li>

            @endcan
        </ul>
    </div>
</nav>
