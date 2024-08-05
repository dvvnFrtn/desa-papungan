<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env("APP_NAME") . " | Berita Desa" }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')

</head>

<body class="mytheme font-jakarta antialiased dark:bg-black dark:text-white/50 overflow-x-hidden">
    <x-navbar />
    <!-- Container -->
    <div class="mt-36 container items-center mx-auto space-y-10 text-justify px-10">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs text-base text-primary rounded-lg w-auto bg-gray-200 mx-auto">
            <ul class="px-5">
                <li><a href="{{ route('landingPage.index') }}"><img src="{{ asset('/img/home-icon.svg') }}"
                            alt="" class="min-w-[18px] min-h-[18px] "></a></li>
                <li><a href="{{ route('informasi.index', ['targetID' => 'pengumuman']) }}">Informasi</a></li>
                <li><a href="{{ route('informasi.index', ['targetID' => 'berita']) }}">Berita</a></li>
                <li class="truncate">{{ $berita->data->judul }}</li>
            </ul>
        </div>
        <div class="flex flex-row items-center ">
            <!-- Judul -->
            <div class="space-y-5 md:basis-3/4 text-pretty ">
                <div class=" text-black text-2xl md:text-4xl font-semibold text-left font-jakarta">{{ $berita->data->judul }}
                </div>
                <!-- Tanggal and Admin info -->
                <div
                    class="flex flex-col md:flex-row md:space-x-5 md:text-nowrap justify-items-start space-y-2 md:space-y-0 p-2 md:p-0">
                    <div class="flex flex-row space-x-3 items-center">
                        <img src="{{ asset('img/calendar-icon.svg') }}" alt=""
                            class="max-h-[18px] max-w-[18px]">
                        <p class="text-lg">{{ $berita->data->createdAt }}</p>
                    </div>
                    <div class="flex flex-row space-x-3 items-center grow">
                        <img src="{{ asset('img/avatar-icon.svg') }}" alt="" class="max-h-[18px] max-w-[18px]">
                        <p class="text-lg truncate">Admin Desa Papungan</p>
                    </div>
                </div>
                <!-- berita img -->
                <img src="{{ $berita->data->foto }}" alt="" class="max-h-96 min-w-full object-cover rounded-lg ">
                <!-- isi berita -->
                <p class="text-lg">{!! nl2br(e($berita->data->isi)) !!}</p>
            </div>

            <!-- Side content -->
            <div class="basis-1/4 md:pl-10 sticky top-40">
                <div class="hidden md:block text-lg font-semibold font-jakarta max-h-96">
                    Lihat Informasi Lainnya
                    <div class="w-full border-b-2 border-gray-400 my-2"></div>
                    <div class="bg-white rounded-lg shadow border border-[#e0e2e7] flex flex-col p-4 space-y-2 w-full md:w-64">
                        <div class="px-2 flex flex-col">
                            <a href="{{ route('informasi.index', ['targetID' => 'pengumuman']) }}" class="text-left px-2 text-base font-medium w-full font-jakarta hover:bg-primary hover:text-lightText rounded-lg transition duration-300">Pengumuman
                                <div class="w-full border-b-2 border-[#e0e2e7] my-2"></div>
                            </a>
                        </div>
                        <div class="px-2 flex flex-col">
                            <a href="{{ route('informasi.index', ['targetID' => 'berita']) }}" class="text-left px-2 text-base font-medium w-full font-jakarta hover:bg-primary hover:text-lightText rounded-lg transition duration-300">Berita
                                <div class="w-full border-b-2 border-[#e0e2e7] my-2"></div>
                            </a>
                        </div>
                        <div class="px-2 flex">
                            <a href="{{ route('informasi.index', ['targetID' => 'aspirasi']) }}" class="text-left px-2 text-base font-medium w-full font-jakarta hover:bg-primary hover:text-lightText rounded-lg transition duration-300">Aspirasi
                                <div class="w-full border-b-2 border-[#e0e2e7] my-2"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    <x-footer />

</body>

</html>

<!-- (bagian) Start -->
<!-- (bagian) End -->

