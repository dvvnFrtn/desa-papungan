<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') . ' | Pariwisata Desa' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')

</head>

<body class="mytheme font-jakarta antialiased dark:bg-black dark:text-white/50">
    <x-navbar />

    <div class="mt-28 space-y-20 md:px-0">
        <!-- isi disini-->

        <!-- profil-->
        <div id="profil"></div>
        <div class="bg-blue-600 text-lightText w-full py-32 px-10">
            <div class="text-3xl font-semibold">Makam Mbah Moedjair Desa Papungan</div>
            <div class="text-sm font-normal">Home / Pariwisata Desa</div>
        </div>
    </div>

    <div class=" px-5 md:px-0 ">
        <div class="container p-10 items-center mx-auto space-y-10">
            <x-headerArtikel subJudul="Kenali Pariwisata Desa Papungan  " judul="Profil Makam Mbah Moedjair" />
            <div class="text-sm font-normal">Berikut adalah dokumenter singkat sebagai profil makam Mbah Moedjair. Simak
                video berikut untuk mengetahui bagaimana tempat peristirahat terakhir Sang Legenda Penemu Ikan Mujair!
            </div>

            {{-- Video --}}
            <div class="relative" style="padding-bottom: 56.25%;">
                <iframe class="mx-auto absolute top-0 left-0 w-full h-full rounded-lg"
                    src="{{ $dataVideo->data->penjelasan }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

            {{-- Carrousel foto --}}
            <div
                class="carousel carousel-center rounded-box space-x-1 w-full border border-neutral flex justify-items-center">

                @foreach ($pariwisata->data as $foto)
                    <div class="carousel-item w-44 h-32 md:h-40">
                        <img src="{{ $foto->foto }}" alt="-" class="object-contain mx-auto" />
                    </div>
                @endforeach

            </div>

            <!-- sejarah-->
            <div id="sejarah"></div>
            <x-cardSubjudul jenisJudul="PARIWISATA DESA" judul="Sejarah Makam Mbah Moedjair Penemu Ikan Moedjair"
                deskripsi="" />

            <div class="space-y-5">
                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span>Dalam sejarah
                    perikanan Indonesia, ada satu nama yang sering terlupakan namun tetap abadi sebagai simbol inovasi
                    dan dedikasi: Mbah Moedjair. Kisah inspiratifnya dalam membudidayakan ikan mujair telah mengubah
                    wajah perikanan di tanah air. Mbah Moedjair, atau yang lebih dikenal dengan nama aslinya Modjair,
                    merupakan sosok pembudidaya ikan air tawar dari Desa Papungan, Blitar, Jawa Timur. Berkat
                    dedikasinya yang luar biasa, ia berhasil mengubah wajah perikanan di Indonesia melalui penemuannya.
                    Tahun 2024 ini, kami, Tim 12 MMD Fakultas Ilmu Komputer Universitas Brawijaya, yang berkesempatan
                    melaksanakan MMD (Mahasiswa Membangun Desa) atau yang biasa disebut KKN (Kuliah Kerja Nyata) di Desa
                    Papungan kami tidak hanya melihat langsung dampak dari kontribusi Mbah Moedjair, tetapi juga
                    berkunjung ke kediaman keturunan Mbah Moedjair untuk mendapatkan informasi lebih mendalam tentang
                    riwayat hidup dan jasa-jasanya. Kami ditunjukkan bukti otentik berupa piagam penghargaan dari tahun
                    1951 yang ditulis dengan ejaan lama. Dalam piagam tersebut tertulis, “Bahwa kami Menteri Pertanian
                    atas nama Pemerintah Republik Indonesia memberi surat tanda djasa kepada Sdr. Moedjair, tempat
                    tinggal Desa Papungan, Kabupaten Blitar, Jawa Timur, sebagai penghargaan menemukan suatu djenis ikan
                    jang diberi nama ikan mudjair, yang ternjata memberi manfaat besar bagi masyarakat Indonesia,”. Dan
                    itulah, sebuah bukti nyata dari pengakuan atas jasa-jasanya.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>Menurut sebuah artikel terbaru yang diterbitkan oleh
                    Sapariah Saturi pada tahun 2022 tentang <a
                        href="https://www.mongabay.co.id/2022/11/26/mbah-moedjair-sang-pencipta-ikan-mujair-yang-terlupakan/"
                        class="text-secondary hover:text-blue-500 hover:border-b border-blue-500" target="_blank"> sang
                        “pencipta” ikan mujair yang terlupakan</a>, kisah dan riwayat hidup Mbah Moedjair diangkat
                    kembali dengan penuh penghargaan. Artikel ini, yang didasarkan pada referensi langsung dari buku
                    <span class="italic">Moedjair: Sejarah Tersembunyi Ikan Moedjair</span> karya Yanu Aribowo, membahas
                    bagaimana Mbah Moedjair, tokoh terkenal dari Desa Papungan, Blitar, Jawa Timur, berhasil menemukan
                    dan membudidayakan ikan mujair di Indonesia. Beliau tidak hanya membawa perubahan signifikan dalam
                    dunia perikanan, tetapi juga meninggalkan warisan yang berharga bagi masyarakat sekitar.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Latar Belakang</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span> Mbah
                    Moedjair, adalah seorang tokoh terkenal dari Desa Papungan, Blitar, Jawa Timur, yang dikenal sebagai
                    pelopor budidaya ikan mujair di Indonesia. Beliau lahir pada tahun 1890 dan meninggal pada tahun
                    1957. Kontribusinya dalam budidaya ikan sangat besar, terutama dalam upayanya untuk memperkenalkan
                    dan mengembangkan ikan mujair sebagai salah satu komoditas perikanan penting di Indonesia.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Penemuan Ikan Mujair</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span>Pada tahun
                    1939, Mbah Moedjair menemukan sekelompok ikan yang hidup di muara Sungai Serang, Blitar. Setelah
                    membawa beberapa ekor ikan tersebut ke desanya, beliau melakukan eksperimen untuk membudidayakannya
                    di air tawar. Atas penghargaan jasanya, ikan tersebut kemudian dikenal sebagai ikan mujair, diambil
                    dari nama Mbah Moedjair.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Proses Eksperimen</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span> Jarak antara
                    Pantai Serang dengan Desa Papungan menjadi tantangan tersendiri bagi Mbah Moedjair. Dengan membawa
                    pikulan, sebagaimana diceritakan dalam <span class="italic">Majalah Penjebar Semangat</span> edisi
                    20 Januari 1951, Mbah Moedjair berjalan kaki menelusuri jalanan sepanjang 40 kilometer itu. Tak
                    jarang, sebagian ikan yang dibawa banyak mati. Usaha beliau baru mulai membuahkan hasil setelah
                    perjalanan ke-10 membawa ikan dari Pantai Serang ke Papungan.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>Ikan yang berhasil dibawa beliau tersebut tidak semuanya
                    berhasil. Namun, beliau tetap mengamati ikan-ikan tersebut hingga terdapat dua ikan yang berkembang
                    dengan baik. Selanjutnya, ikan itu segera dipindah ke kolam lain agar lebih leluasa dalam memberikan
                    perhatian dan perawatan yang baik. Tak disangka, sebulan kemudian, ikan bertelur dan menghasilkan
                    anakan sangat banyak.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>"Betul, setelah sebulan di kolam baru ini sudah penuh
                    ikan-ikan kecil anak sepasang ikan tadi, lalu berkembang menjadi sangat banyak,” tulis Yanu,
                    mengutip laporan <span class="italic">Majalah Penjebar Semangat</span> Nomor 93 Edisi 20 Januari
                    1951.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Penyebaran dan Pengembangan</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span> Setelah
                    berhasil membudidayakan ikan mujair, Mbah Moedjair tidak hanya berhenti sampai di situ. Beliau juga
                    aktif menyebarkan pengetahuannya kepada masyarakat sekitar dan petani ikan lainnya. Majalah<span
                        class="italic"> Star Weekly</span> ke XV Nomor 744 Edisi 2 April 1960 merekam keberhasilan Mbah
                    Moedjair dalam melakukan domestikasi mujair ini. Beliau membudidayakan ribuan ikan itu dengan
                    ditampung di tiga kolam berbeda. Sayangnya, lahan bekas kolam itu kini berganti kepemilikan dan
                    kondisinya kurang terawat dan dipenuhi semak belukar.
                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>“Dengan keberhasilan itu, terbukalah lembaran sejarah baru
                    bagi dunia perikanan. Mulai saat itu, bintang Pak Moedjair naik. Banyak keuntungan yang
                    diperolehnya, baik moril maupun materiil,” tulisnya.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>“Pak Mujair, pemulia ikan, melepaskan ikan itu di kolam air
                    tawar, ikan berkembang. Hal lebih penting, mujair mampu bereproduksi lebih mudah daripada ikan yang
                    ada,” mengutip dari surat kabar <span class="italic">De Indische Courant 20ste Jaargang</span> Nomor
                    199, edisi 12 Mei 1941, yang secara tidak langsung mengakui keberhasilan Mbah Moedjair itu. Dalam
                    laporannya, surat kabar berbahasa Belanda itu semula menyebut ikan mas sebagai spesies paling cocok
                    untuk budidaya ikan sawah (tambak). Tetapi, ikan mujair yang ditemukan Mbah Moedjair lima tahun
                    sebelumnya (1936) menggantikan posisi ikan mas.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>Beberapa media lain seperti <span class="italic">De Vrije
                        Pers 8de Jaargang</span> edisi 27 Agustus 1951 atau <span class="italic">Java Bode</span> edisi
                    23 Maret 1954 juga menurunkan laporan serupa. Menurut buku <span class="italic">Tilapia: Biology,
                        Culture, and Nutrition</span> yang dipublikasikan pada tahun 2006, ikan mujair hasil budidaya
                    Mbah Moedjair berkembang dan menyebar ke berbagai wilayah. Tak hanya di Indonesia, juga lintas
                    benua.
                    Karena kesibukannya dengan urusan ikan, Mbah Moedjair memutuskan untuk mundur dari jabatan sebagai
                    jogoboyo yaitu sebagai pelaksana teknis membantu Kepala Desa di bidang keamanan dan ketertiban.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>Sebagaimana disebutkan dalam buletin perikanan <span
                        class="italic">Fishery Bulletin of The Fish and Wildlife Service</span> volume 62 tahun 1963:
                    <span class="italic">Tank Culture of Tilapia</span>, hampir semua populasi mujair di Indonesia,
                    Asia, Eropa, Amerika Tengah, Amerika Utara, dan Amerika Selatan adalah keturunan dari ikan yang
                    dibawa Mbah Moedjair dari muara Sungai Serang. Sebelum penemuan yang dilakukan oleh Mbah Moedjair,
                    mujair hanya dikenal sebagai makanan dan ikan buruan di Afrika Timur, tanpa adanya budidaya resmi.
                    “Tidak ada budidaya ikan tilapia (mujair) di Afrika sebelum akhirnya ikan ini muncul secara
                    misterius di Jawa Timur,” tulis buletin itu.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Keberadaan Mujair di Indonesia</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span>
                    Yanu Wibowo dalam <span class="italic">Moedjair: Sejarah Tersembunyi Ikan Mujair</span> (2022) juga
                    menyebut bahwa, kuat dugaan ikan itu dibawa para penggemar ikan aquarium, sebagaimana ditulis
                    sejumlah laporan. Di tempat asalnya, kata Yanu, ikan ini banyak dibudidayakan sebagai ikan aquarium.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>“Dalam perjalanan, ikan ini tidak cocok sebagai ikan
                    aquarium karena perilaku suka mengaduk tanah dan membuat air keruh,” kata Yanu, sebagaimana dikutip
                    dari <span class="italic">Biologische Inventarisatie van de Binnenvisserij Indonesie</span> (1947).

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>Untuk menghormati jasa Mbah Moedjair terlepas sebagaimana
                    riwayat ikan mujair yang berasal dari Afrika Timur itu, sebuah prasasti pun dibuat di lokasi makam
                    Mbah Moedjair dan 26 Maret 1936 dijadikan sebagai tanggal ketika pertama kali dia menemukan mujair.
                    Nama mujair begitu populer hingga kini, mengalahkan popularitas Mbah Moedjair, sosok dibalik penemu
                    ikan mujair dan melakukan penyebaran budidaya secara otodidak.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Penghargaan dan Pengakuan</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span>
                    Atas kontribusinya dalam bidang perikanan, Mbah Moedjair mendapatkan berbagai penghargaan dari
                    pemerintah Indonesia, termasuk pengakuan sebagai salah satu pionir dalam budidaya ikan di Indonesia.
                    Nama beliau dikenang dan dihormati sebagai tokoh yang berjasa besar dalam meningkatkan kesejahteraan
                    masyarakat melalui budidaya ikan mujair.

                    <br>
                    <br>
                    <span class="pl-10 inline-block"></span>Mbah Moedjair meninggal dunia Sabtu, 7 September 1957. Tiga
                    tahun kemudian, pemerintah melakukan pemugaran pada makamnya dari yang semula hanya gundukan tanah
                    menjadi seperti yang terlihat sekarang ini.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Peninggalan</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span>Hingga kini,
                    ikan mujair menjadi salah satu jenis ikan yang banyak dibudidayakan di Indonesia. Kontribusi Mbah
                    Moedjair dalam bidang perikanan tetap dihargai dan diingat oleh masyarakat, terutama di Desa
                    Papungan, Blitar, tempat asal beliau.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Warisan Budaya dan Edukasi</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span>Selain
                    kontribusi dalam bidang perikanan, Mbah Moedjair juga menjadi inspirasi bagi banyak petani ikan di
                    Indonesia. Pengetahuan dan semangat beliau dalam inovasi budidaya ikan terus diwariskan dari
                    generasi ke generasi. Makam Mbah Moedjair di Desa Papungan kini juga menjadi salah satu destinasi
                    wisata edukatif, di mana pengunjung dapat belajar tentang sejarah budidaya ikan mujair dan
                    kontribusi besar Mbah Moedjair.
                </div>

                <div class="font-semibold text-2xl text-left text-pretty">Penutup</div>

                <div class="font-normal text-justify text-pretty "><span class="pl-10 inline-block"></span> Kisah Mbah
                    Moedjair adalah contoh nyata bagaimana dedikasi dan inovasi seorang individu dapat memberikan dampak
                    besar bagi masyarakat. Pengabdian beliau dalam bidang perikanan tidak hanya meningkatkan
                    perekonomian lokal tetapi juga membawa perubahan positif bagi sektor perikanan di Indonesia. Mbah
                    Moedjair adalah pahlawan yang patut dikenang dan dijadikan teladan bagi generasi mendatang.
                </div>

            </div>

            <!-- lokasi-->
            <div id="lokasi"></div>
            <x-cardSubjudul jenisJudul="LOKASI" judul="Peta Digital Makam Mbah Moedjair Desa Papungan"
                deskripsi="Berikut adalah peta lokasi keberadaan Makam Mbah Moedjair. Peta tersebut interaktif, Anda dapat menyesuaikan tergantung dimana lokasi Anda. Selamat Berkunjung!" />
            <a href="https://www.google.com/maps/place/Makam+Moedjair+(Penemu+Ikan+Mujair)/@-8.1117038,112.1910492,1495m/data=!3m1!1e3!4m15!1m8!3m7!1s0x2e78ec8428e3dd43:0xba394b22de9e75f5!2sPapungan,+Kec.+Kanigoro,+Kabupaten+Blitar,+Jawa+Timur!3b1!8m2!3d-8.1060475!4d112.199654!16s%2Fg%2F12hhgw8cl!3m5!1s0x2e78eb778accc645:0x31909f880a684183!8m2!3d-8.1111685!4d112.1931771!16s%2Fg%2F11ckvknb79?entry=ttu"
                class="btn btn-secondary" target='blank'>Lihat di Google Maps</a>
            <iframe src="{{ route('peta-makam-mbah-moedjair') }}" title="" class="w-full min-h-96"></iframe>
        </div>

    </div>
</body>
<x-footer />

</html>

