<footer class="flex-row  bg-primary mt-10">
    <div class="footer  text-lightText p-10">
        <aside>
            <a class="flex gap-3 btn w-fit h-fit text-left pl-0 bg-transparent text-white border-0 hover:bg-blue-900" href="{{route('landingPage.index')}}">
                <img src="{{asset('img/logokab.png')}}" alt="lambang" class=" w-14 h-14">
                <div class="">
                    <div class="text-2xl font-bold">Papungan</div>
                    <div class="text-xs font-medium">Portal Resmi Desa Papungan</div>
                </div>
            </a>
            <div class=" mt-5 md:mt-0 max-w-80 text-justify">“Gotong – royong membangun desa Papungan sebagai kawasan agropolitan, Desa yang jujur, transparan, adil, sejahtera, berdaya saing, mandiri, religious dan berbudaya” </div>
        </aside>
        <nav class="font-medium">
            <h6 class="footer-title font-semibold">Tautan</h6>
            <a class="link link-hover" href="{{route('profilDesa.index') }}">Profil Desa</a>
            <a class="link link-hover" href="{{route('pemerintahan.index')}}">Pemerintahan</a>
            <a class="link link-hover" href="{{route('informasi.index')}}">Informasi</a>
            <a class="link link-hover" href="{{route('umkm.index')}}">UMKM Desa</a>
            <a class="link link-hover" href="{{route('publc.pariwisata.index')}}">Pariwisata Desa</a>
        </nav>
        <ul class="font-medium">
            <h6 class="footer-title font-semibold">Kontak Kami</h6>
            <li class="max-w-96 ">Jl. Setro Jati No. 1, Papungan, Kec. Kanigoro, Kabupaten Blitar, Jawa Timur 66171</li>
            <li class="p-1 flex items-center text-center gap-3 mt-5">
                <img src="{{asset('img/phoneLogo.svg')}}" alt="phoneLogo" class="w-4 h-4">
                <div class="">(0342) 814031</div>
            </li>
            <li class="p-1 flex items-center text-center gap-3">
                <img src="{{asset('img/emailLogo.svg')}}" alt="emailLogo" class="w-4 h-4">
                <div class="">desapapungan@gmail.com</div>
            </li>
            <li class="p-1 flex items-center text-center gap-3">
                <a class="link link-hover" target="_blank" href="https://wa.me/+6285856665522">Hubungi kami di WhatsApp</a>
            </li>
        </ul>
    </div>
    <div
        class="w-auto border-t-2 p-1 mx-10 text-center gap-2 items-center space-y-5 md:space-y-0 md:py-3 text-white md:flex justify-center">
        <div class="py-2 md:py-0">© 2024 MAHASISWA MEMBANGUN DESA FAKULTAS ILMU KOMPUTER UNIVERSITAS BRAWIJAYA</div>
        <div class="border-r-2 h-auto p-2 hidden md:block"></div>
        <div class="py-2 md:py-0 border-t-2 mt-2 md:border-0 md:mt-0">Made with ♡ by Kelompok 12 Pasukan Papungan</div>
    </div>

</footer>
