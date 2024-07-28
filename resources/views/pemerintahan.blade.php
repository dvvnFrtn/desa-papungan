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

</head>

<body class="mytheme font-jakarta antialiased dark:bg-black dark:text-white/50">
    <x-navbar />

    <div class="mt-28 space-y-20 md:px-0">
        <!-- isi disini-->


        <!-- struktural-->
        <div id="struktural"></div>
        <div class="bg-secondary text-base-100 w-full py-32 px-10">
            <div class="text-3xl font-semibold">Pemerintahan Desa Papungan</div>
            <div class="text-sm font-normal">Home / Pemerintahan</div>
        </div>
    </div>

    <div class=" px-5 md:px-0 ">
        <div class="container items-center mx-auto space-y-10 text-justify p-10 ">
            <x-headerArtikel subJudul="PENJELASAN" judul="Struktur Organisasi" />
            <div class="text-sm font-normal">Sebagai sebuah desa, sudah tentu struktur kepemimpinan Desa Papungan tidak bisa lepas dari struktur administratif pemerintahan pada level di atasnya. Hal ini dapat dilihat dalam bagan berikut ini:</div>
            <img src="{{ $struktur->data->foto }}" alt="struktur desa" class="rounded-lg w-full">

            <div class="text-sm font-normal">{{ $struktur->data->penjelasan }}</div>
            
                <!-- perangkat desa-->
            <div id="perangkatdesa"></div>
            <x-cardSubjudul jenisJudul="DAFTAR" judul="Perangkat Desa"
                deskripsi="Berikut adalah daftar nama-nama Perangkat Desa beserta dengan foto dan jabatannya." />
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-auto p-4">

                @foreach ($perangkatDesas->data->resource as $perangkatDesa)
                    <div class="bg-white rounded-lg shadow-md p-5 h-64 w-42 text-center xl:w-64 xl:h-80">
                        <img src="{{$perangkatDesa->foto}}" alt="kepala Desa"
                            class="w-40 h-40 object-cover mx-auto rounded-lg xl:w-56 xl:h-60">
                        <h3 class="text-lg font-semibold mt-2 overflow-hidden text-ellipsis whitespace-nowrap">
                            {{ $perangkatDesa->nama }}</h3>
                        <p class="text-gray-700 text-sm overflow-hidden text-ellipsis whitespace-nowrap">
                            {{ $perangkatDesa->jabatan }}</p>
                    </div>
                @endforeach

            </div>


                <!-- lembaga desa-->
            <div id="lembagadesa"></div>
            <x-cardSubjudul jenisJudul="PEMERINTAHAN" judul="Lembaga Desa"
                deskripsi="Berikut ini adalah daftar Lembaga Desa yang beroperasi di Desa Papungan beserta alamat kantornya:" />

            <x-table.table :headers="['Nama', 'Alamat']" jenisTabel="Daftar Lembaga">
                @php
                    $i = 1;
                @endphp
                @foreach ($lembagas->data as $lembaga)
                    <tr class="border-b">
                        <td class="p-2 text-left">{{ $i++ }}</td>
                        <td class="p-2 text-left">{{ $lembaga->nama }}</td>
                        <td class="p-2 text-left">{{ $lembaga->alamat }}</td>
                    </tr>
                @endforeach
            </x-table.table>

        </div>
    </div>
</body>
<x-footer />


</html>
