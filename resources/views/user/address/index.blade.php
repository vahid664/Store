@extends('layouts.app')

@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row justify-content-center">
                <div class="profile-page col-xl-9 col-lg-8 col-md-12 order-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <h1 class="title-tab-content">ثبت آدرس جدید</h1>
                            </div>
                            <div class="content-section default">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form-account" method="post" action="{{ url('address/store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">نام و نام خانوادگی
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="form-account-row">
                                                <input class="input-field text-right" type="text"
                                                       name="name_family" id="name_family"
                                                       required value="{{ Auth::user()->name }} {{ Auth::user()->family }}"
                                                       placeholder="نام خود را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">موبایل
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="form-account-row">
                                                <input class="input-field text-right" type="text"
                                                       onkeyup="toEnglishNumber(this.value,'mobile');"
                                                       name="mobile" id="mobile" maxlength="11" minlength="11"
                                                       required value="{{ Auth::user()->mobile }}"
                                                       placeholder="شماره موبایل خود را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">تلفن ثابت</div>
                                            <div class="form-account-row">
                                                <input class="input-field text-right" type="text"
                                                       onkeyup="toEnglishNumber(this.value,'tell');"
                                                       name="tell" id="tell" maxlength="11" minlength="11"
                                                       placeholder="شماره تلفن ثابت خود را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">کد پستی
                                            </div>
                                            <div class="form-account-row">
                                                <input class="input-field text-right" type="text"
                                                       onkeyup="toEnglishNumber(this.value,'post_code');"
                                                       name="post_code" id="post_code"
                                                       placeholder="کد پستی خود را وارد نمایید">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">استان
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="form-account-row">
                                                <select class="input-field text-right"
                                                       name="province" id="province"
                                                        required >
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach(\App\ProvinceCity::where('parent',0)->orderBy('sort')->get() as $item)
                                                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-account-title">شهرستان
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="form-account-row">
                                                <select class="input-field text-right"
                                                        name="city" id="city"
                                                        required >
                                                    <option value="">انتخاب کنید</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-account-title">آدرس
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="form-account-row">
                                                <textarea name="address" id="address"
                                                          class="input-field text-right"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="btn btn-success btn-lg">ذخیره</button>
                                        <a href="{{ url('profile') }}" class="btn btn-default btn-lg">انصراف</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    <script>
        $('#province').on('change',function () {
            var id=$('#province').val();
            if(id != '')
            {
                $('body').css({"opacity": "0.5"});
                $.ajax({
                    url: '{{ url('address/city') }}', // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {
                        id: id
                    }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(data)   // A function to be called if request succeeds
                    {
                        //console.log(data);
                        $('#city').html('');
                        $.each(data, function (i, item) {
                            $('#city').append($('<option>', {
                                value: item.title,
                                text : item.title
                            }));
                        });
                        $('body').css({"opacity": "1"});
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $('body').css({"opacity": "1"});
                    }
                });
            }
        });
    </script>
@endsection
