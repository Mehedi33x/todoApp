<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/backend/login/style.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        #toast-container>.toast-error {
            background-color: #BD362F;
        }

        .toast-success {
            background-color: green;
        }

        .toast-info {
            background-color: blue;
        }

        .toast-warning {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <div id="container" class="container {{ request()->routeIs('auth.register') ? 'sign-up' : 'sign-in' }}">
        <div class="row">
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <form action="{{ route('do.register') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Username"
                                    required>
                            </div>
                            <div class="input-group">
                                <i class='bx bx-mail-send'></i>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    required>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="password" value="{{ old('password') }}"
                                    placeholder="Password" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}"
                                    placeholder="Confirm password" required>
                            </div>
                            <button type="submit">Sign up</button>
                        </form>
                        <p>
                            <span>Already have an account?</span>
                            <b onclick="toggle()" class="pointer">Sign in here</b>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                        <form action="{{ route('do.login') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit">Sign in</button>
                        </form>
                        <p><b>Forgot password?</b></p>
                        <p>
                            <span>Don't have an account?</span>
                            <b onclick="toggle()" class="pointer">Sign up here</b>
                        </p>
                    </div>
                </div>
                <div class="form-wrapper"></div>
            </div>
        </div>


        <div class="row content-row">
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>Welcome</h2>
                </div>
                <div class="img sign-in"></div>
            </div>

            <div class="col align-items-center flex-col">
                <div class="img sign-up"></div>
                <div class="text sign-up">
                    <h2>Join with us</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- TOASTR -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        let container = document.getElementById('container');

        function toggle() {
            container.classList.toggle('sign-in');
            container.classList.toggle('sign-up');
        }
    </script>
</body>


</html>
