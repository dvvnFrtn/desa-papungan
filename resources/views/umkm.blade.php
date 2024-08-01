<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') . ' | UMKM Desa' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')

</head>

<body class="mytheme font-jakarta antialiased dark:bg-black dark:text-white/50">
    <x-navbar />

    <div class="mt-28 space-y-20 md:px-0">
        <!-- profil umkm-->
        <div id="profilumkm"></div>
        <div class="bg-blue-600 text-white w-full py-32 px-10">
            <div class="text-3xl font-semibold">UMKM Desa Papungan</div>
            <div class="text-sm font-normal">Home / UMKM</div>
        </div>
    </div>

    <div class=" px-5 md:px-10 mt-10 space-y-5 md:space-y-10">
        <div class="container items-center mx-auto space-y-10 text-justify">
            <x-headerArtikel subJudul="Kenali UMKM " judul="Profil UMKM Desa Papungan" />
            <div class="text-sm font-normal ">Berikut adalah video singkat mengenai UMKM di Desa Papungan. Simak video
                berikut untuk mengetahui bagaimana masyarakat Desa Papungan mengembangkan potensi usaha mereka!</div>

            {{-- Video --}}
            <iframe width="560" height="315" src="{{ $videoUmkm->data->penjelasan }}" title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                class="mx-auto w-full md:w-[560px] aspect-video rounded-lg "></iframe>

            <x-cardSubjudul jenisJudul="Kenali UMKM" judul="Peta Digital UMKM Desa Papungan"
                deskripsi="Berikut adalah Peta UMKM dari Desa Papungan. Simak informasi berikut untuk mengetahui lokasi dan jenis usaha yang ada di desa  kita, serta bagaimana UMKM ini berkontribusi dalam perekonomian lokal!" />

        </div>

        <!-- peta umkm-->
        <div id="peta"></div>
        <div class="my-5 mb-5">
            <iframe src="/peta-umkm" title="" class="w-full h-screen md:h-[490px] py-20 md:p-0 px-5 md:px-0"
                id="petaumkm"></iframe>
        </div>

        <!-- peta umkm-->
        <div id="petaumkm"></div>

        <!-- daftar umkm-->
        <div id="daftarumkm"></div>

        <!-- Search -->
        <form action="{{ route('umkm.index') }}" method="GET">
            <div
                class="flex flex-wrap md:flex-nowrap space-y-2 md:space-y-0 items-center space-x-2 md:w-1/2 lg:w-1/4 hover:border-gray-400">
                <label class="input input-bordered flex items-center gap-2 border-gray-400 bg-white">
                    <input name="nama" type="search" class="grow" placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>

                <div>
                    <select name="jenis" id="jenis" class=" h-12 w-auto px-2 rounded-lg">
                        <option disabled selected>Jenis UMKM</option>
                        @foreach ($data->data->list as $item)
                            <option value="{{ $item->jenis }}">{{ $item->jenis }}</option>
                        @endforeach
                        <option value="">-</option>
                    </select>
                </div>
                </details>

                <button type="submit" class="btn bg-secondary text-lightText hover:bg-blue-800">Search</button>
            </div>
        </form>

        <!-- Tabel umkm -->
        <x-table.table :headers="['Nama UMKM', 'Jenis Produk', 'Alamat', 'Ijin Label', 'Detail UMKM']" jenisTabel="Daftar UMKM">
            @php
                $i = 1 + ($paginatedItems->currentPage() - 1) * $paginatedItems->perPage();
            @endphp
            @foreach ($paginatedItems as $umkm)
                <tr class="border-b">
                    <td class="p-2 text-center">{{ $i++ }}</td>
                    <td class="p-2 text-left">{{ $umkm->nama }}</td>
                    <td class="p-2 text-left">
                        @php
                            $jenisCollection = collect($umkm->jenis);
                            $jenisString = $jenisCollection->pluck('jenis')->unique()->implode(', ');
                        @endphp
                        {{ $jenisString }}
                    </td>
                    <td class="p-2 text-left">{{ $umkm->alamat }}</td>
                    <td class="p-2 text-center lg:text-left ">
                        @if ($umkm->no_pirt != '-')
                            <div class="badge bg-indigo-100 text-indigo-400 font-semibold border-0 text-xs ">P-IRT
                            </div>
                        @endif
                        @if ($umkm->no_nib != '-')
                            <div class="badge bg-blue-100 text-blue-400 font-semibold border-0 text-xs ">NIB</div>
                        @endif
                        @if ($umkm->no_bpom != '-')
                            <div class="badge bg-pink-100 text-pink-400 font-semibold border-0 text-xs ">BPOM</div>
                        @endif
                        @if ($umkm->no_halal != '-')
                            <div class="badge bg-green-100 text-green-400 font-semibold border-0 text-xs ">HALAL
                            </div>
                        @endif
                    </td>
                    <td class="p-2 "> <a class="btn btn-link" href="#petaumkm"
                            data-umkm-id="{{ $umkm->id }}">Detail UMKM</a></td>
                </tr>
            @endforeach
        </x-table.table>

        <!-- Pagination Links -->
        <section class="px-4 py-6 bg-white border-t">
            @if ($paginatedItems->hasPages())
                <div class="flex items-center justify-between w-full">
                    @if ($paginatedItems->onFirstPage())
                        <button disabled
                            class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                            </svg>
                            <div class="hidden md:block">Sebelumnya</div>
                        </button>
                    @else
                        <a href="{{ $paginatedItems->previousPageUrl() }}"
                            class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                            </svg>
                            <div class="hidden md:block">Sebelumnya</div>
                        </a>
                    @endif

                    <div class="flex items-center gap-2">
                        @foreach ($paginatedItems->getUrlRange(1, $paginatedItems->lastPage()) as $page => $url)
                            @if ($page == $paginatedItems->currentPage())
                                <button
                                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-blue-100 text-center align-middle font-sans text-xs font-semibold uppercase text-darkText transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <span
                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        {{ $page }}
                                    </span>
                                </button>
                            @else
                                <a href="{{ $url }}"
                                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20"
                                    type="button">
                                    <span
                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        {{ $page }}
                                    </span>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    @if ($paginatedItems->hasMorePages())
                        <a href="{{ $paginatedItems->nextPageUrl() }}"
                            class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20"
                            type="button">
                            <div class="hidden md:block">Berikutnya</div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                            </svg>
                        </a>
                    @else
                        <button disabled
                            class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <div class="hidden md:block">Berikutnya</div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            @endif
        </section>

    </div>

</body>
<x-footer />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailLinks = document.querySelectorAll('.btn-link');

        detailLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                const umkmId = this.dataset.umkmId;
                lihatDetail(umkmId);

                scrollToElement('peta');
            });
        });
    });

    function scrollToElement(elementId, offset = 60) {
        if (window.innerWidth >= 768) {
            offset = 120;
        }
        const targetElement = document.getElementById(elementId);
        if (targetElement) {
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }

    function lihatDetail(id) {
        document.getElementById('petaumkm').contentWindow.clickMarker(id);
    }
</script>

</html>

