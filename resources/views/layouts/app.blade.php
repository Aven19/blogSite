<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog Site</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="">

    <!-- FontAwesome JS-->

    <style>
        .error-class-labels {
            color:#FF0000;  /* red */
            padding-top: 10px;
            padding-bottom: 15px;
        }
    </style>
    <!-- Theme CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite([
    'resources/assets/css/main.css',
    'resources/assets/js/blog.js',
    'resources/assets/fontawesome/js/all.min.js',
    'resources/assets/plugins/popper.min.js',
    'resources/assets/plugins/popper.min.js',
    'resources/js/app.js'
    ])
</head>


<body>

    @if (Session::has('success'))
    <div style="position: absolute; top: 0; right: 0;">
        <div class="toast fade show" id="myToast">
            <div class="toast-header">
                <strong class="me-auto"><i class="bi-gift-fill"></i>Success</strong>
                <small></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif
    @if (Session::has('error'))
    <div style="position: absolute; top: 0; right: 0;">
        <div class="toast fade show" id="myToast">
            <div class="toast-header">
                <strong class="me-auto"><i class="bi-gift-fill"></i>Error</strong>
                <small></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            {{ Session::get('error') }}
            </div>
        </div>
    </div>
    @endif
    @yield('content')
    @yield('scripts')
</body>
</html>