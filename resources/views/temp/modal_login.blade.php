<!-- Modal Core -->
<div class="modal-share modal fade" id="Modal_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="main-content col-12">
                    <div class="account-box">
                        <a href="#" class="logo">
                            <img src="{{ asset('img/logo.png') }}" alt="">
                        </a>
                        <div class="account-box-title text-right">ورود به تاپ کالا</div>
                        <div class="account-box-content">
                            <form id="Login" class="form-account" action="{{ url('UserAuth/login') }}">
                                @csrf
                                <div class="form-account-title">ایمیل یا شماره موبایل</div>
                                <div class="form-account-row">
                                    <label class="input-label"><i class="now-ui-icons users_single-02"></i></label>
                                    <input class="input-field" type="text" name="email"
                                           placeholder="ایمیل یا شماره موبایل خود را وارد نمایید">
                                </div>
                                <div class="form-account-title">رمز عبور
                                    <a href="" class="btn-link-border form-account-link">رمز
                                        عبور خود را فراموش
                                        کرده ام</a>
                                </div>
                                <div class="form-account-row">
                                    <label class="input-label"><i
                                                class="now-ui-icons ui-1_lock-circle-open"></i></label>
                                    <input class="input-field" type="password" name="password"
                                           placeholder="رمز عبور خود را وارد نمایید">
                                </div>
                                <div class="form-account-row form-account-submit">
                                    <div class="parent-btn">
                                        <button class="dk-btn dk-btn-info">
                                            ورود به تاپ کالا
                                            <i class="fa fa-sign-in"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-account-agree">
                                    <label class="checkbox-form checkbox-primary">
                                        <input type="checkbox" checked="checked" id="agree">
                                        <span class="checkbox-check"></span>
                                    </label>
                                    <label for="agree">مرا به خاطر داشته باش</label>
                                </div>
                            </form>
                        </div>
                        <div class="account-box-footer">
                            <span>کاربر جدید هستید؟</span>
                            <a href="#" class="btn-link-border">ثبت‌نام در
                                تاپ کالا</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Core -->