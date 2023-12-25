<!-- Modal Core -->
<div class="modal-share modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                {{--<h4 class="modal-title" id="myModalLabel">اشتراک گذاری</h4>--}}
            </div>
            <div class="modal-body">
                <form class="form-share">
                    <div class="form-share-title">اشتراک گذاری در شبکه های اجتماعی</div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="btn-group-share">
                                <li>
                                    <a rel="publisher" title=" اشتراک {{ $query->title }} در تلگرام" target="_blank"
                                       class="btn btn-primary btn-sm"
                                       href="https://telegram.me/share/url?url={{ route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}?ref=telegram">
                                        <i class="fa fa-telegram py-1"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-danger btn-sm" rel="publisher" target="_blank" title=" اشتراک {{ $query->title }} در گوگل پلاس"
                                       href="https://plus.google.com/share?url={{ route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}?ref=googleplus">
                                        <i class="fa fa-google-plus py-1"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-info btn-sm" rel="publisher" target="_blank" title=" اشتراک {{ $query->title }} در فیس بوک"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}?ref=facebook">
                                        <i class="fa fa-facebook py-1"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-outline-primary btn-sm" rel="publisher" target="_blank" title=" اشتراک {{ $query->title }} در توییتر"
                                       href="https://twitter.com/share?url={{ route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}?ref=twitter&text={{ $query->title }}">
                                        <i class="fa fa-twitter py-1"></i>
                                    </a>
                                </li>
                                <li class="d-none d-lg-block">
                                    <a class="btn btn-success btn-sm" rel="publisher" target="_blank" title=" اشتراک {{ $query->title }} در واتس اپ"
                                       href="https://api.whatsapp.com/send?phone=whatsappphonenumber&text={{ route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}">
                                        <i class="fa fa-whatsapp py-1"></i>
                                    </a>
                                </li>
                                <li class="d-block d-lg-none">
                                    <a class="btn btn-success btn-sm" rel="publisher" target="_blank" title=" اشتراک {{ $query->title }} در واتس اپ"
                                       href="whatsapp://send?text={{ route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}">
                                        <i class="fa fa-whatsapp py-1"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->current() }}?ref=linkedin&amp;title={{ $query->title }}&amp;summary= {{ strip_tags(Illuminate\Support\Str::limit(str_replace('&nbsp;',' ',$query->text),400)) }}"
                                       target="_blank" class="btn btn-primary btn-sm" rel="publisher" title=" اشتراک {{ $query->title }} در لینکدین">
                                        <i class="fa fa-linkedin py-1"></i>
                                    </a>
                                </li>
                                {{--





                                --}}
                                {{--<li>
                                    <a href="#" class="btn-share btn-share-twitter" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li><a href="#" class="btn-share btn-share-facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="btn-share btn-share-google-plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    {{--<div class="form-share-title">ارسال به ایمیل</div>
                    <div class="row">
                        <div class="col-12">
                            <label class="ui-input ui-input-send-to-email"></label>
                            <input class="ui-input-field" type="email" placeholder="آدرس ایمیل را وارد نمایید.">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn-primary">ارسال</button>
                        </div>
                    </div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <form class="form-share-url default">
                    <div class="form-share-url-title">آدرس صفحه</div>
                    <div class="row">
                        <div class="col-12">
                            <label class="ui-url">
                                <input class="ui-url-field" value="{{  route('product.show',$query->id.'-'.Illuminate\Support\Str::slug($query->title_en)) }}">
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Core -->
