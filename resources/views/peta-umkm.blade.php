<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') . ' | Umkm Papungan' }}</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="{{ asset('map-style.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body>
    <div id="map"></div>
    <div id='test' class="hidden">
        <div class="">
            <div id="carousel" class="carousel carousel-center aspect-square snap-x snap-mandatory rounded-2xl">
            </div>
            <p id="nama" class="font-bold text-2xl my-0"></p>
            <p id="jam-buka" class="font-normal text-lg text-gray-500"></p>
            <div class="space-y-0 my-0">
                <p class="font-normal text-lg text-gray-500">Jenis Produk:</p>
                <p id="jenis" class="font-normal text-lg text-black"></p>
            </div>
            <div>
                <p class="font-normal text-lg text-gray-500">Alamat:</p>
                <p id="alamat" class="font-normal text-lg text-black"></p>
            </div>
            <div>
                <p class="font-normal text-lg text-gray-500">Nomor Kontak:</p>
                <p id="kontak" class="font-normal text-lg text-black"></p>
            </div>
            <div>
                <p class="font-normal text-lg text-gray-500">Perizinan:</p>
                <p class="font-normal text-lg text-gray-500">P-IRT <span id='pirt'
                        class="font-normal text-lg text-black"></span></p>
                <p class="font-normal text-lg text-gray-500">Halal <span id='halal'
                        class="font-normal text-lg text-black"></span></p>
                <p class="font-normal text-lg text-gray-500">NIB <span id='nib'
                        class="font-normal text-lg text-black"></span></p>
            </div>
            <div>
                <p class="font-normal text-lg text-gray-500">Deskripsi:</p>
                <p id="deskripsi" class="font-normal text-lg text-black"></p>
            </div>

        </div>
    </div>
    </div>
    <script>
        // map configuration
        let config = {
            minZoom: 14,
            maxZoom: 18,
            zoomControl: false,
            attributionControl: false,
        };
        // inital zoom level
        const zoom = 14;
        // inital co-ordinates
        const lat = -8.101885;
        const lng = 112.197382;

        // calling map
        const map = L.map("map", config);

        // initailize the borderline of desa papungan
        let batasDaerah = [
            [-8.08854, 112.202775],
            [-8.088252, 112.2051],
            [-8.090349, 112.206055],
            [-8.093103, 112.206595],
            [-8.093596, 112.208007],
            [-8.113905, 112.203107],
            [-8.115025, 112.199428],
            [-8.11404, 112.193291],
            [-8.111905, 112.19343],
            [-8.111577, 112.192241],
            [-8.111987, 112.191356],
            [-8.11333, 112.190527],
            [-8.113922, 112.186348],
            [-8.112106, 112.187073],
            [-8.111388, 112.1859],
            [-8.110924, 112.185793],
            [-8.10818, 112.187968],
            [-8.107758, 112.18779],
            [-8.107313, 112.187787],
            [-8.106657, 112.18791],
            [-8.106107, 112.188075],
            [-8.105685, 112.188342],
            [-8.105441, 112.188379],
            [-8.10529, 112.188443],
            [-8.105105, 112.188711],
            [-8.105006, 112.189038],
            [-8.105056, 112.189439],
            [-8.105206, 112.189765],
            [-8.105194, 112.189906],
            [-8.105035, 112.19002],
            [-8.104377, 112.189861],
            [-8.103889, 112.189837],
            [-8.103725, 112.189918],
            [-8.103614, 112.190147],
            [-8.103142, 112.191367],
            [-8.10297, 112.191539],
            [-8.102804, 112.19156],
            [-8.102092, 112.191395],
            [-8.101955, 112.191431],
            [-8.101704, 112.191615],
            [-8.101562, 112.191662],
            [-8.101461, 112.191659],
            [-8.101303, 112.191692],
            [-8.100834, 112.191877],
            [-8.100766, 112.191996],
            [-8.100736, 112.192299],
            [-8.100512, 112.192549],
            [-8.100318, 112.192643],
            [-8.099838, 112.193317],
            [-8.100451, 112.193496],
            [-8.100609, 112.194025],
            [-8.093764, 112.197815],
            [-8.093068, 112.198984],
            [-8.09363, 112.199626],
            [-8.092139, 112.201737],
            [-8.089854, 112.202737],
            [-8.089511, 112.203082],
            [-8.088888, 112.2027],
        ];
        // create a polygon from the borderline of desa papungan
        let polygon = L.polygon(batasDaerah, {
            color: "#2D68F8",
            weight: 2,
            fillOpacity: 0.05,
            dashArray: "8, 5",
        }).addTo(map);

        // set the view of the map
        map.setView(polygon.getBounds().getCenter(), zoom);

        // array to store all of the markers in the map
        const markers = [];
        let isPopupOpen = false;

        // Used to load and display tile layers on the map
        // Most tile servers require attribution, which you can set under `Layer`
        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: config.maxZoom,
            minZoom: config.minZoom,
            attribution: "",
        }).addTo(map);

        // add zoom control on the top right of the map
        L.control
            .zoom({
                position: "topright",
            })
            .addTo(map);

        // pane for the fixed popup
        let pane = map.createPane("fixed", document.getElementById("map"));

        // create a default icon for the marker
        const icon = L.icon({
            iconUrl: "/img/map.svg",
            iconSize: [32, 56],
            iconAnchor: [17, 40],
        });

        // create the marker icon that will be active when the marker is clicked
        const clickedIcon = L.icon({
            iconUrl: "/img/clicked-map.svg",
            iconSize: [40, 40],
            iconAnchor: [21, 36],
        });

        // data dummy
        const points = JSON.parse('<?= json_encode($data->data->resource) ?>')

        polygon.addTo(map);

        // create the marker for each data in the data
        points.map(({
            id,
            jenis,
            foto,
            alamat,
            lat,
            long,
            deskripsi,
            nama,
            kontak,
            jam_buka,
            no_pirt,
            no_halal,
            no_nib,
            no_bpom
        }) => {
            // add the marker to the map
            const marker = L.marker([lat, long], {
                icon: icon,
                nama: nama,
                id: id,
            }).addTo(map);

            // put the marker to the markers array
            markers.push(marker);

            const carousel = document.getElementById('carousel');
            foto.forEach(obj => {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('carousel-item');
                imgContainer.classList.add('w-full');
                imgContainer.classList.add('h-auto');
                const img = document.createElement('img');
                img.src = obj.foto;
                img.classList.add('w-full');
                img.classList.add('h-full');
                img.classList.add('bg-black');
                img.classList.add('object-contain');
                imgContainer.appendChild(img);
                carousel.appendChild(imgContainer);
            });

            document.getElementById('nama').innerHTML = nama;
            document.getElementById('jam-buka').innerHTML = 'Jam buka' + " " + jam_buka;
            const jenis_name = jenis.map(item => item.jenis)
            document.getElementById('jenis').innerHTML = jenis_name.join(', ');
            document.getElementById('alamat').innerHTML = alamat;
            document.getElementById('kontak').innerHTML = kontak;
            document.getElementById('pirt').innerHTML = "No. " + no_pirt;
            document.getElementById('halal').innerHTML = no_halal;
            document.getElementById('nib').innerHTML = no_nib;
            document.getElementById('deskripsi').innerHTML = deskripsi;

            // create a popup object for each marker / data
            const popup = L.popup({
                pane: "fixed",
                className: "popup-fixed",
                autoPan: false,
            }).setContent(document.getElementById('test').innerHTML);

            // add event listener to the marker
            marker.bindPopup(popup).on("click", fitBoundsPadding);
        });

        map.on("popupclose", function(e) {
            isPopupOpen = false;
            removeAllAnimationClassFromMap();
        });

        const mediaQueryList = window.matchMedia("(min-width: 687px)");

        mediaQueryList.addEventListener("change", (event) => onMediaQueryChange(event));

        onMediaQueryChange(mediaQueryList);

        function onMediaQueryChange(event) {
            if (event.matches) {
                document.documentElement.style.setProperty("--min-width", "true");
            } else {
                document.documentElement.style.removeProperty("--min-width");
            }
        }

        let boxInfoWith = 0;
        let paddingTopLeft = 0;

        function fitBoundsPadding() {
            isPopupOpen = true;
            removeAllAnimationClassFromMap();
            // Get width of info div
            const boxInfoWith = document.querySelector(".popup-fixed").offsetWidth;
            const boxInfoHeight = document.querySelector(".popup-fixed").offsetHeight;

            // Create a feature group with the marker
            const featureGroup = L.featureGroup([this]).addTo(map);

            // Get popup container
            const popupContainer = document.querySelector(".leaflet-popup");

            // Check screen width for responsiveness
            const isSmallScreen = window.innerWidth <= 687;

            let paddingLeft = 0;
            let paddingTop = 10;

            // Adjust padding based on popup position and screen size
            if (popupContainer) {
                if (isSmallScreen) {
                    // Bottom popup on small screen
                    paddingTopLeft = boxInfoWith / 2; // Center marker horizontally
                    paddingTop = -boxInfoHeight;
                } else {
                    // Default: Left popup or non-bottom popup
                    paddingLeft = boxInfoWith + 10;
                }
            }
            // Fit bounds with adjusted padding
            map.fitBounds(featureGroup.getBounds(), {
                paddingTopLeft: [paddingLeft, paddingTop],
            });
            this.setIcon(clickedIcon);
            this.off("click", fitBoundsPadding);
        }

        function removeAllAnimationClassFromMap() {
            markers.forEach((marker) => {
                marker.setIcon(icon);
                marker.on("click", fitBoundsPadding);
            });
            map.setView([lat, lng], zoom);
        }

        function clickMarker(id) {
            if (isPopupOpen) {
                map.closePopup();
                return;
            }
            removeAllAnimationClassFromMap();
            const selectedMarker = markers.find(marker => marker.options.id === parseInt(id));
            selectedMarker.fire('click');
        }

        setInterval(function() {
            if (map.getZoom() >= 16) {
                for (const marker of markers) {
                    marker.bindTooltip(marker.options.nama, {
                        permanent: true,
                        direction: "bottom",
                        offset: L.point(0, 0),
                    });
                }
            } else {
                for (const marker of markers) {
                    marker.unbindTooltip();
                }
            }
        }, 1000);
    </script>
</body>

</html>

