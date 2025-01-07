<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="/backend/login/style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div id="" class="container sign-up ">
        <div class="row">
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <form action="{{ route('forgot.password.send') }}" method="POST">
                            @csrf
                            <p><b>Forget your password?</b></p>
                            <div class="input-group">
                                <i class='bx bx-mail-send'></i>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    required>
                            </div>
                            
                            <button type="submit">Reset Password</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row content-row">
            <div class="col align-items-center flex-col">
            </div>
            <div class="col align-items-center flex-col">
                <div class="img sign-up"></div>
                <div class="text sign-up">
                    <h2>Join with us</h2>
                </div>
            </div>
        </div>
    </div>

    @if (session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        </script>
    @endif
</body>


</html>
