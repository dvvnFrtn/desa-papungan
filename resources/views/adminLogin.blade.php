<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
    <style>
        #bgAdminLogin {
          background-image: url('img/bgAdminLogin.png');
          background-size: cover; /* Optional: covers the entire element */
          background-position: center; /* Optional: centers the background image */
          background-repeat: no-repeat; /* Optional: prevents repeating the background image */
        }
      </style>
      
</head>

<body class="mytheme font-jakarta antialiased dark:bg-black dark:text-white/50 ">
    <img src="" alt="" class="">

    <div class="flex items-center justify-center min-h-screen bg-gray-200 z-50">
        <div class="w-[392px] py-10 bg-gradient-to-b from-[#f2f2f2] to-[#8c8c8c] rounded-[28px] p-4">

            <div class="mx-auto text-center">
                <div class="text-lg">Admin Login</div>
                <div class="">lorem ipsum dkdfk dkfdfkk</div>
            </div>
            <label class="form-control w-full max-w-xs mx-auto">
                <div class="label">
                    <span class="label-text">Username</span>
                    <span class="label-text-alt">Top Right label</span>
                </div>
                <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                <div class="label">
                    <span class="label-text-alt">Bottom Left label</span>
                    <span class="label-text-alt">Bottom Right label</span>
                </div>
            </label>

            <label class="form-control w-full max-w-xs mx-auto">
                <div class="label">
                    <span class="label-text">Password</span>
                    <span class="label-text-alt">Top Right label</span>
                </div>
                <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                <div class="label">
                    <span class="label-text-alt">Bottom Left label</span>
                    <span class="label-text-alt">Bottom Right label</span>
                </div>
            </label>
        </div>
    </div>

</body>

</html>

<!-- (bagian) Start -->
<!-- (bagian) End -->
