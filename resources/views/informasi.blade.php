<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') . ' | Informasi Desa' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')

    <style>
        /* css for hidden text */
        .truncate-multiline {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

</head>

<body class="mytheme font-jakarta antialiased dark:bg-black dark:text-white/50 overflow-x-hidden">
    <x-navbar />
    <div class="mt-28 space-y-20 md:px-0">
        <!-- isi disini-->

        <!-- pengumuman-->
        <div id="pengumuman"></div>
        <div class="bg-blue-600 text-lightText w-full py-32 px-10">
            <div class="text-3xl font-semibold">Informasi Seputar Desa Papungan</div>
            <div class="text-sm font-normal">Home / Profil Desa</div>
        </div>

        <div class="container  flex flex-col md:flex-row space-y-10 md:space-y-0 md:space-x-6">
            <div class="flex-col p-10 space-y-6">
                <x-cardSubjudul class="max-w-sm" jenisJudul="INFORMASI" judul="PENGUMUMAN"
                    deskripsi="Berikut pengumuman penting bagi seluruh warga Desa Papungan. Jangan lupa untuk selalu membaca pengumuman dan menandai kalender Anda agar tidak melewatkan informasi penting di hari-hari mendatang!" />
                
                @foreach ($paginatedItemsPengumuman as $item)
                    <div class="flex flex-col justify-start items-end gap-1.5">
                        <div class="self-stretch flex flex-col justify-start items-start gap-1">
                            <div class="text-xl font-semibold font-jakarta">{{ $item->judul }}</div>
                            <div class="text-gray-700 font-normal font-jakarta">{{ $item->createdAt }}</div>
                            <div class="relative font-normal font-jakarta">
                                <div class="truncate-multiline">
                                    {!! nl2br(e($item->isi)) !!}
                                </div>
                            </div>
                            <div class="w-full flex justify-end mt-4 mb-2 pr-2">
                                <a href="{{ url('pengumuman/' . $item->id) }}" class="text-blue-500 flex items-center">
                                    Selengkapnya
                                    <img src="{{ asset('/img/arrow-selengkapnya.svg') }}" alt="" class="ml-2">
                                </a>
                            </div>
                        </div>
                        <div class="w-full border-b-2 border-gray-400 my-2"></div>
                    </div>
                @endforeach
                <!-- Pagination Section -->
                <section class="px-4 py-6  border-t">
                    @if ($paginatedItemsPengumuman->hasPages())
                        <div class="flex items-center justify-between w-full">
                            @if ($paginatedItemsPengumuman->onFirstPage())
                                <button disabled
                                    class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                    </svg>
                                    <div class="hidden md:block">Sebelumnya</div>
                                </button>
                            @else
                                <a href="{{ $paginatedItemsPengumuman->appends(request()->query())->previousPageUrl() }} #pengumuman"
                                    class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                    </svg>
                                    <div class="hidden md:block">Sebelumnya</div>
                                </a>
                            @endif

                            <div class="hidden lg:flex items-center gap-2">
                                @foreach ($paginatedItemsPengumuman->appends(request()->query())->getUrlRange(1, $paginatedItemsPengumuman->lastPage()) as $page => $url)
                                    @if ($page == $paginatedItemsPengumuman->currentPage())
                                        <button
                                            class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-blue-100 text-center align-middle font-sans text-xs font-semibold uppercase text-darkText transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                            <span
                                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                {{ $page }}
                                            </span>
                                        </button>
                                    @else
                                        <a href="{{ $url }} #pengumuman"
                                            class="hidden md:block relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20"
                                            type="button">
                                            <span
                                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                {{ $page }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="flex-col text-center items-center gap-2 lg:hidden">
                                <div class="">{{ $paginatedItemsBerita->currentPage() }} dari {{ $paginatedItemsBerita->lastPage() }}</div>
                       </div>
                            @if ($paginatedItemsPengumuman->hasMorePages())
                                <a href="{{ $paginatedItemsPengumuman->appends(request()->query())->nextPageUrl() }} #pengumuman"
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

                <!-- berita-->
                <div id="berita"></div>
                <x-cardSubjudul class="max-w-sm" jenisJudul="INFORMASI" judul="BERITA"
                    deskripsi="Berikut adalah Berita Terkini dari Desa Papungan. Simak informasi terbaru dan penting berikut untuk tetap terhubung dengan perkembangan desa kita!" />

                @foreach ($paginatedItemsBerita as $item)
                    <div class="flex flex-col justify-start items-end gap-1.5">
                        <div class="self-stretch flex flex-col justify-start items-start gap-1">
                            <div class="text-xl font-semibold font-jakarta">{{ $item->judul }}</div>
                            <div class="text-gray-700 font-normal font-jakarta">{{ $item->createdAt }}</div>
                            <div class="flex flex-col lg:flex-row gap-4">
                                <img src="{{ $item->foto }}" alt="fotoberita"
                                    class="w-full lg:w-[400px] h-[300px] object-cover">
                                <div class="font-normal font-jakarta relative w-full flex flex-col justify-between">
                                    <div class="truncate-multiline">
                                        {!! nl2br(e($item->isi)) !!}
                                    </div>
                                    <div class="w-full flex justify-end mt-2">
                                        <div class="w-full flex justify-end mt-6 mb-4 pr-2">
                                            <a href="{{ url('berita/' . $item->id) }}"
                                                class="text-blue-500 flex items-center">
                                                Selengkapnya
                                                <img src="{{ asset('/img/arrow-selengkapnya.svg') }}" alt=""
                                                    class="ml-2">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full border-b-2 border-gray-400 my-2"></div>
                        </div>
                    </div>
                @endforeach
                <!-- Pagination Section -->
                <section class="px-4 py-6 border-t">
                    @if ($paginatedItemsBerita->hasPages())
                        <div class="flex items-center justify-between w-full">
                            @if ($paginatedItemsBerita->onFirstPage())
                                <button disabled
                                    class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                    </svg>
                                    <div class="hidden md:block">Sebelumnya</div>
                                </button>
                            @else
                                <a href="{{ $paginatedItemsBerita->appends(request()->query())->previousPageUrl() }} #berita"
                                    class="flex border border-gray-300 items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                                    </svg>
                                    <div class="hidden md:block">Sebelumnya</div>
                                </a>
                            @endif

                            <div class="hidden lg:flex items-center gap-2">
                                @foreach ($paginatedItemsBerita->appends(request()->query())->getUrlRange(1, $paginatedItemsBerita->lastPage()) as $page => $url)
                                    @if ($page == $paginatedItemsBerita->currentPage())
                                        <button
                                            class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-blue-100 text-center align-middle font-sans text-xs font-semibold uppercase text-darkText transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                            <span
                                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                {{ $page }}
                                            </span>
                                        </button>
                                    @else
                                        <a href="{{ $url }} #berita"
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

                            <div class="flex-col text-center items-center gap-2 lg:hidden">
                                     <div class="">{{ $paginatedItemsBerita->currentPage() }} dari {{ $paginatedItemsBerita->lastPage() }}</div>
                            </div>
                            @if ($paginatedItemsBerita->hasMorePages())
                                <a href="{{ $paginatedItemsBerita->appends(request()->query())->nextPageUrl() }} #berita"
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
                <!-- aspirasi-->
                <div id="aspirasi"></div>
                <div class=" space-y-2">
                    <div class="flex items-center gap-2 text-blue-600 w- md:w-1/2 lg:w-1/4">
                        <div class="text-xl font-medium font-jakarta">FORMULIR</div>
                        <div class="border-b-2 border-blue-600 w-full"></div>
                    </div>
                    <div class="text-2xl font-semibold">Berikan Aspirasi mu!</div>
                    <div class="font-normal font-jakarta max-w-full lg:min-w-2xl">Kami sangat ingin mendengar pendapat
                        dan saran Anda untuk membuat desa kita lebih baik. Apapun yang ingin Anda sampaikan seperti
                        saran, ide, atau masukan semuanya sangat berarti. Yuk, isi formulir di bawah ini dan mari kita
                        bersama-sama membangun desa yang lebih nyaman dan bahagia. Terima kasih banyak atas
                        partisipasinya!</div>

                    <form method="POST" class="w-full" enctype="multipart/form-data"
                        action="{{ route('informasi.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-xl font-medium font-jakarta mb-2">Nama <span
                                    class="text-gray-500 font-jakarta">(Optional)</span></label>
                            <textarea name="nama" id="nama" placeholder="Tuliskan Nama anda"
                                class="w-full h-12 px-4 py-2 font-normal text-gray/700 border border-[#d0d5dd] rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#2d68f8] focus:border-[#2d68f8] resize-none"
                                rows="1"></textarea>
                        </div>
                        <label for="kategori" class="block text-xl font-medium font-jakarta mb-2">Kategori</label>
                        <select name="kategori" id="kategori"
                            class="w-full h-12 px-4 py-2 font-normal text-[#3d4350] border border-[#d0d5dd] rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#2d68f8] focus:border-[#2d68f8]">
                            <option value="" disabled selected>Kategori</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Berita">Berita</option>
                            <option value="Aspirasi">Aspirasi</option>
                        </select>
                        <div class="mb-4 mt-4">
                            <label for="judul" class="block text-xl font-medium font-jakarta mb-2">Judul</label>
                            <textarea name="judul" id="judul" placeholder="Tuliskan Judul"
                                class="w-full h-12 px-4 py-2 font-normal text-gray-700 border border-[#d0d5dd] rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#2d68f8] focus:border-[#2d68f8] resize-none"
                                rows="1"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="isi" class="block text-xl font-medium font-jakarta mb-2">Isi</label>
                            <textarea name="isi" id="isi" placeholder="Tuliskan Isi"
                                class="w-full h-32 px-4 py-2 font-normal text-gray-700 border border-[#d0d5dd] rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#2d68f8] focus:border-[#2d68f8] resize-none"
                                rows="1"></textarea>
                        </div>

                        <div id="foto-upload">
                            <label for="foto" class="block text-xl font-medium font-jakarta mb-2">Foto</label>
                            <div class="flex items-center border border-[#d0d5dd] rounded-md px-4 py-2">
                                <p id="file-label" class="text-gray-700 flex-grow">Tidak ada file yang terunggah</p>
                                <label for="foto"
                                    class="bg-blue-600 text-white flex items-center gap-2 px-4 py-2 rounded-md cursor-pointer">
                                    <img src="{{ asset('/img/unggah.svg') }}" alt="Unggah" class="w-5 h-5">
                                    <div class="hidden md:block">Unggah File</div>
                                </label>
                                <input type="file" name="foto" id="foto" class="hidden">
                            </div>
                            <p class="text-gray-700 text-sm mt-1">* file png atau jpg</p>
                        </div>

                        <div class="flex justify-end mt-4 rounded-[32px]">
                            <button type="submit"
                                class="flex items-center px-6 py-2 bg-[#2d68f8] text-white text-base lg:text-lg font-medium font-jakarta rounded-lg shadow-md hover:bg-[#1a4ebb] focus:outline-none focus:ring-2 focus:ring-[#2d68f8] focus:ring-opacity-50">
                                Kirim
                                <img src="{{ asset('/img/arrow-right.svg') }}" alt=""
                                    class="ml-2 inline-block">
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Side Bar start-->
            <div class="basis-1/4 pr-5 pt-8">
                <div class="hidden md:block text-lg font-semibold font-jakarta max-h-96 sticky top-40">
                    Lihat Informasi
                    <div class="w-full border-b-2 border-gray-400 my-2"></div>
                    <div
                        class="bg-white rounded-lg shadow border border-[#e0e2e7] flex flex-col p-4 space-y-2 w-full md:w-64">
                        <div class="px-2 flex flex-col">
                            <button id="pengumumanLink"
                                class="text-left px-2 text-base font-medium w-full font-jakarta hover:bg-primary hover:text-lightText rounded-lg transition duration-300">Pengumuman
                                <div class="w-full border-b-2 border-[#e0e2e7] my-2"></div>
                            </button>
                        </div>
                        <div class="px-2 flex flex-col">
                            <button id="beritaLink"
                                class="text-left px-2 text-base font-medium w-full font-jakarta hover:bg-primary hover:text-lightText rounded-lg transition duration-300">Berita
                                <div class="w-full border-b-2 border-[#e0e2e7] my-2"></div>
                            </button>
                        </div>
                        <div class="px-2 flex">
                            <button id="aspirasiLink"
                                class="text-left px-2 text-base font-medium w-full font-jakarta hover:bg-primary hover:text-lightText rounded-lg transition duration-300">Aspirasi
                                <div class="w-full border-b-2 border-[#e0e2e7] my-2"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function scrollToElement(elementId, offset = 120) {
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

                document.getElementById('pengumumanLink').addEventListener('click', function() {
                    scrollToElement('pengumuman');
                });

                document.getElementById('beritaLink').addEventListener('click', function() {
                    scrollToElement('berita');
                });

                document.getElementById('aspirasiLink').addEventListener('click', function() {
                    scrollToElement('aspirasi');
                });

                // js for change text on button upload file
                document.addEventListener('DOMContentLoaded', function() {
                    const fileInput = document.getElementById('foto');
                    const fileLabel = document.getElementById('file-label');

                    fileInput.addEventListener('change', function() {
                        if (fileInput.files.length > 0) {
                            fileLabel.textContent = fileInput.files[0].name;
                        } else {
                            fileLabel.textContent = "Tidak ada file yang terunggah";
                        }
                    });
                });

                // js for hidden form ungah file if user select kategori pengumuman & aspirasi
                document.addEventListener('DOMContentLoaded', function() {
                    const kategoriSelect = document.getElementById('kategori');
                    const fotoUploadDiv = document.getElementById('foto-upload');

                    function checkKategori() {
                        const selectedValue = kategoriSelect.value;
                        if (selectedValue === 'Aspirasi' || selectedValue === 'Pengumuman') {
                            fotoUploadDiv.style.display = 'none';
                        } else {
                            fotoUploadDiv.style.display = 'block';
                        }
                    }

                    checkKategori();

                    kategoriSelect.addEventListener('change', checkKategori);
                });
            </script>

            <!-- Side Bar Ends-->
        </div>
    </div>
</body>
<x-footer />

</html>
