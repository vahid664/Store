<ol class="children list-group">
    @foreach($child as $value)
        <li class="list-group-item pb-0">
            <div class="comment-body mt-0 pt-0">
                <div class="comment-author">
                    <cite class="fn">
                        {{ $value->user->full_name }}
                    </cite> <span class="says"></span>
                </div>

                <div class="commentmetadata text-primary">
                    {{ new Verta($value->updated_at) }}
                </div>

                <p>{!! \App\Helper\Helper::last_text_article(\App\Helper\Helper::Nofollow($value->text)) !!}</p>

                @guest
                    <div class="reply">
                        برای ثبت پاسخ باید وارد
                        <a href="{{ url('login') }}">
                            <u>
                                حساب کاربری
                            </u>
                        </a>
                        خود شود
                    </div>
                @else
                    <div class="reply">
                        <a href="#" data-toggle="modal" data-target="#myModal_comment"
                           onclick="commentID('{{$value->id}}');" class="comment-reply-link">
                            پاسخ
                        </a>
                    </div>
                @endguest
            </div>
            @if($value->child->count())
                @include('visitor.product.commet_temp',['child' => $value->child])
            @endif
        </li>
    @endforeach
</ol>
