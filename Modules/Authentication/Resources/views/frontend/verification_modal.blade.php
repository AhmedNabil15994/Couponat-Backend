@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .captcha {
            display: block;
            margin: auto;
            width: 70%;
        }

        .py-1 {
            padding-top: 1em;
            padding-bottom: 1em;
        }

        .py-2 {
            padding-top: 2em;
            padding-bottom: 2em;
        }

        .font-roboto {
            font-family: 'Roboto', sans-serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .text-white {
            color: #efefef;
        }

        .text-light {
            color: #dee2e6;
        }

        .link {
            text-decoration: none;
            color: #fca311;
        }


        .glass {
            max-width: 550px;
            width: 100%;
            padding: 65px 90px 45px;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 10px 10px 80px rgba(0, 0, 0, 0.3);
            /* important property */
            backdrop-filter: blur(5px);
        }

        .glass .title h1 {
            font-size: 35px;
        }

        .glass form .form-control {
            width: 80px;
            padding: .3em .1em;
            font-size: 25px;
            border-radius: 5px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .glass form .col .btn {
            width: 90%;
            padding: .6em .1em;
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            background-color: #fca311;
            color: #efefef;
            border: none;
        }

        .modal-dialog {
            max-width: 100%;
            margin: 0;
            height: 100%;
        }

        .modal-content {
            display: block;
            width: max-content;
            margin: auto;
            margin-top: 15%;
        }

        #enterCode .row.col {
            margin: 0;
        }

        #enterCode .btn-primary {
            width: 100%;
            background-color: #FA0D5F !important;
        }

        .font-poppins {
            padding: 0 15px;
            margin-bottom: 10px;
        }

        .mb-15 {
            margin-bottom: 15px !important;
        }
    </style>
@endpush

<div class="modal" tabindex="-1" id="enterCode" role="dialog">
    <div class="modal-dialog glass" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('authentication::frontend.verification.title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-poppins">{{ __('authentication::frontend.verification.send_to') }}</p>
                <p class="font-poppins">+<span class="mobile"></span></p>

                <form action="{{ route('frontend.auth.verify') }}" method="post" class="py-2">
                    @csrf
                    <h5 class="font-poppins">{{ __('authentication::frontend.verification.enter_otp') }}:</h5>

                    <div class="col row py-1 mb-15">
                        <input type="text" class="form-control code" maxlength="1"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                        <input type="text" class="form-control code" maxlength="1"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                        <input type="text" class="form-control code" maxlength="1"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                        <input type="text" class="form-control code" maxlength="1"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                        <input type="hidden" name="user_id">
                    </div>

                    <div class="col">
                        <button type="submit"
                            class="btn submit-v btn-primary">{{ __('authentication::frontend.verification.verify') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(function() {
            var _loadingImg = $(".loading-s");
            $(document).on('keyup', '.code', function() {
                if ($(this).val()) {
                    $(this).blur();
                    $(this).next('.code').focus()
                }
            });

            $('form.register').submit(function(e) {
                var _submit = $(this).find(".submit")
                _submit.hide()
                _loadingImg.show();
                e.preventDefault();
                e.stopPropagation();
                _submit.prop('disabled', true);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'name': $('input[name="name"]').val(),
                        'email': $('input[name="email"]').val(),
                        'mobile': $('input[name="mobile"]').val(),
                        'birthday': $('input[name="birthday"]').val(),
                        'gender': $('select[name="gender"]').val(),
                        'password': $('input[name="password"]').val(),
                        'password_confirmation': $('input[name="password_confirmation"]').val(),
                        'captcha': $('input[name="captcha"]').val(),
                    },
                    success: function(data) {
                        toastr['success'](
                            "{{ __('authentication::frontend.verification.send_to') }}" +
                            " +" + data.user.mobile)

                        $('#enterCode input[type="text"]').val('');
                        $('#enterCode input[name="user_id"]').val(data.user.id);
                        $('#enterCode .mobile').html(data.user.mobile);
                        _submit.prop('disabled', false);
                        _loadingImg.hide();
                        _submit.show()

                        $('#enterCode').show();
                        $('input.code:first').focus();
                    },
                    error: function(error) {
                        _submit.prop('disabled', false);
                        _submit.show()
                        _loadingImg.hide();
                        $.each(error.responseJSON.errors, function(index, item) {
                            toastr['error'](item.toString())
                        })
                    }
                })
            });

            $('#enterCode form').submit(function(e) {
                var _submit = $(this).find(".submit-v")
                e.preventDefault();
                e.stopPropagation();
                _submit.prop('disabled', true);
                let code = '';
                $.each($('input.code'), function(index, item) {
                    code += $(item).val();
                });
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'user_id': $('input[name="user_id"]').val(),
                        'code': code,
                    },
                    success: function(data) {
                        _submit.show()
                        if (data.success === true) {
                            toastr['success'](data.message)
                            setTimeout(function() {
                                window.location.href = data.url
                            }, 2000)
                        } else {
                            toastr['error'](data.message)
                        }
                    },
                    error: function(error) {
                        _submit.prop('disabled', false);
                        _submit.show()
                        $.each(error.responseJSON.errors, function(index, item) {
                            toastr['error'](item.toString())
                        })
                    }
                })

            });

            $('form.forget').submit(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'email': $('input[name="email"]').val(),
                    },
                    success: function(data) {
                        toastr['success'](
                            "{{ __('authentication::frontend.verification.send_to') }}" +
                            " +" + data.user.mobile)

                        $('#enterCode input[type="text"]').val('');
                        $('#enterCode input[name="user_id"]').val(data.user.id);
                        $('#enterCode .mobile').html(data.user.mobile);

                        $('#enterCode').show();
                        $('input.code:first').focus();
                    },
                    error: function(error) {
                        $.each(error.responseJSON.errors, function(index, item) {
                            toastr['error'](item.toString())
                        })
                    }
                })
            });

            $('form.login').submit(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'email': $('input[name="email"]').val(),
                        'password': $('input[name="password"]').val(),
                    },
                    success: function(data) {
                        if (data.hasOwnProperty('url')) {
                            toastr['success'](data.message)
                            setTimeout(function() {
                                window.location.href = data.url
                            }, 2000)
                        } else {
                            toastr['success'](
                                "{{ __('authentication::frontend.verification.send_to') }}" +
                                " +" + data.user.mobile)

                            $('#enterCode input[type="text"]').val('');
                            $('#enterCode input[name="user_id"]').val(data.user.id);
                            $('#enterCode .mobile').html(data.user.mobile);

                            $('#enterCode').show();
                            $('input.code:first').focus();
                        }
                    },
                    error: function(error) {
                        $.each(error.responseJSON.errors, function(index, item) {
                            toastr['error'](item.toString())
                        })
                    }
                })
            });
        });
    </script>
@endpush
