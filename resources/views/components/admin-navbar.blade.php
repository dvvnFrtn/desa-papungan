<div class="w-12 h-screen bg-primary container flex flex-col justify-between fixed z-50">

    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer" class="btn btn-primary drawer-button p-3">
                <img src="img/hamburgerLogo.svg" class="w-5 h-5">
            </label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex flex-col min-h-screen">
                <ul class="menu bg-primary font-medium text-lightText w-80 p-6 pt-10 flex-grow">
                    <!-- Sidebar content here -->
                    <li class="text-lg font-semibold pt-3">DASHBOARD</li>
                    <li class="pt-3"><a>Profil Desa</a></li>
                    <li class="pt-3"><a>Pemerintahan</a></li>
                    <li class="pt-3"><a>Informasi</a></li>
                    <li class="pt-3"><a>UMKM Desa</a></li>
                    <li class="pt-3"><a>Pariwisata Desa</a></li>
                </ul>
                <button
                    class="flex items-center  text-lightText p-4 bg-primary hover:bg-blue-900  transition duration-300">
                    <img src="img/logoLogoutAdmin.svg" alt="logoutButton" class="mr-2">
                    <div class="">Keluar</div>
                </button>
            </div>
        </div>
    
    </div>

    <!-- Sidebar content -->
    <button
        class="flex items-center text-lightText p-4 bg-primary hover:bg-blue-900 transition duration-300">
        <img src="img/logoLogoutAdmin.svg" alt="logoutButton" class="mr-2">
    </button>
</div>