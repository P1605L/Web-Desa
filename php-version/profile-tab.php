<?php
// PHP Version: Profile Tab Content & Logic Component
// Pulls live staff data and complaint feed from DB with bulletproof static fallbacks

// 1. Fetch Staff List
$staffList = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM staff ORDER BY id ASC");
        while ($row = $stmt->fetch()) {
            $row['duties'] = json_decode($row['duties'], true);
            $staffList[] = $row;
        }
    } catch (\Exception $e) {
        // Fallback handled below
    }
}

// Fallback staff configuration if database has not been seeded / connected
if (empty($staffList)) {
    $staffList = [
        [
            'id' => 1,
            'name' => 'Ir. H. Ahmad Fauzi',
            'role' => 'Kepala Desa',
            'detail_role' => 'Pimpinan Tertinggi Desa',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuALY1rhacXYRMqFmHMMTqV1F9amgBTviCav8bJfRDBIGWBeMdbF0XyC99s7B1b0Doi_zz3Obh3kU9ZS4VaSkPD9uZkO8UTWt5DBOqfR5hqCqRdTe-sFVIKbmwHKz49Yd2puwzjXn7tiKOkBzSxNq6BpGM3huUhcAASw8eCi4sZ9exnWPEQM3A2O3xBtiFCv0dNN8oeqp0UKLJKzauy873yDJERBKhZWcNZYWtjRSJj9-uSA33H-L6kIyo1n_QWyzT7OmA25W_NPBlY',
            'phone' => '+62 811-4433-221',
            'email' => 'ahmadfauzi@webdesa.go.id',
            'bio' => 'Lahir di Sukamaju, mengabdi selama lebih dari 15 tahun di bidang tata pamong desa. Lulusan Teknik Sipil Institut Teknologi dengan fokus pembangunan infrastruktur pedesaan ramah lingkungan.',
            'duties' => [
                'Memimpin penyelenggaraan pemerintahan desa berdasarkan kebijakan yang ditetapkan bersama BPD.',
                'Mengajukan rancangan peraturan desa menetapkan APBDesa.',
                'Membina ketentraman dan ketertiban masyarakat desa.'
            ]
        ],
        [
            'id' => 2,
            'name' => 'Siti Aminah, S.E.',
            'role' => 'Sekretaris Desa',
            'detail_role' => 'Kepala Sekretariat & Administrasi Umum',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDUETgEGPI_HAkJ8-UkUUFUU8OK0Ir3iSy58vJsjacBCVSHkwDIiMVeyxRMRKEX8-cwiM3pBRPJFsFFBQxJhL6QpnfI0cVLJzvmUtjSRQLHbAnu9xBHOR1ypSlAhv3PtNHaR0_AK-AEs4gO2yV106map7BL-22Seabv9SndhIhI2zMKQ6IFarv36eaMrtnQMTFoR_8Mptyu3re-59jBukgTAQSb9Pggp7TzYxwmAayNxixOYVHfq6fW4pZmp8t85ahm9qky52ytnsE',
            'phone' => '+62 812-5566-778',
            'email' => 'sitiaminah@webdesa.go.id',
            'bio' => 'Ahli administrasi keuangan publik daerah, berpengalaman menyusun Laporan Penyelenggaraan Pemerintahan Desa (LPPD) berstandar nasional.',
            'duties' => [
                'Mengoordinasikan tugas-tugas kepala seksi pembinaan administrasi.',
                'Menyusun draf peraturan desa serta mengelola arsip desa.',
                'Mempersiapkan rapat-rapat kerja koordinasi aparat desa.'
            ]
        ],
        [
            'id' => 3,
            'name' => 'Rahmat Hidayat',
            'role' => 'Bendahara Desa',
            'detail_role' => 'Kepala Urusan Keuangan',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCI3XpHDI-msIS1rD52uvXzmeWAJFBhAlScxg5E72Wr6jW7lgjpj5jAcsdCt-SiKBayJggnkWKLuxCGka0t3AMa0vPlInMOmoBkS8jgWI53MveGzM0gbzD-bBO0KyDfi-5T92qXoAro984EwdEL9F-folLKIReB3ITtHDpkCeeEvBBtFfdO1vR4b6eWxpKN6YAgaJm89oaGil1yLrHxBTB9hMf9NOrgxjIxWZ1c_KPAQym2GLBCEh1KgP8YYQoxwCCO9e_uqUwVhT0',
            'phone' => '+62 813-8877-665',
            'email' => 'rahmathidayat@webdesa.go.id',
            'bio' => 'Mengelola anggaran pendapatan dan belanja desa (APBDes) secara transparan. Terkenal jujur dan tegas dalam audit keuangan warga.',
            'duties' => [
                'Menerima, menyimpan, menyetorkan, serta membayarkan dana desa.',
                'Menyelenggarakan pembukuan keuangan kas desa secara periodik.',
                'Melaporkan realisasi penyerapan dana pajak & bantuan pemerintah.'
            ]
        ],
        [
            'id' => 4,
            'name' => 'Budi Santoso, S.T.',
            'role' => 'Kaur Perencanaan',
            'detail_role' => 'Kepala Urusan Perencanaan Pembangunan',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDHXLEHAFaVz6IRJQLxcNGttoK5JimoDXIrt_TGek6HI0O4W-ZDq_EzvGWAYS-4e8NDplgUy4ituS-UBSqkQZsM0cCQoYtrgt_XsNYA3KJjhyBuEixI9WzhQdM1fQUEuC1CWek19yXUtUmNEGw_rMs9ASypCYfmxjuoYFNR9Ier22PJZdypMSy7TYhMX9sZBqKVRHMIiJuV_rUGNXKTpA0-tZQFBnekbQiaR13xPB_5RfbjD-0pbefudYYLZ16vS7XU14TIUHoovWQ',
            'phone' => '+62 856-1122-334',
            'email' => 'budisantoso@webdesa.go.id',
            'bio' => 'Sarjana arsitektur wilayah pengembangan pedesaan. Merancang peta tata guna lahan digital serta sistem tata air modern untuk sawah pertanian.',
            'duties' => [
                'Menyusun Rencana Kerja Pembangunan Desa (RKPDesa) tahunan.',
                'Menyiapkan rancangan usulan musyawarah perencanaan pembangunan (Musrenbang).',
                'Mengawasi pengerjaan instalasi fisik infrastruktur umum.'
            ]
        ],
        [
            'id' => 5,
            'name' => 'Dewi Lestari',
            'role' => 'Kaur Umum',
            'detail_role' => 'Kepala Urusan Tata Usaha & Urusan Umum',
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD3QnTa_CKM1RVk5VZoUn2ZKLP0nmfVsNbPXFoSXroJw89PlUNYM2TtuhBbkSDWsJLGR3nrqgOnJdiy2axVHkg8b1DcJkTSke3-pe6PhkoCus59nQLIQjsN63YW0BZFOknthSc4ENOEujNSjw1v9zM0qAq3viUXMErGnkSRTUrY33XDCNQ3m6Y1LgTjsNZJueyfcvhRcRr5kNP5IFxAKdvjiHvS0CcFvmgQB_XBKo7feYmAszfzLuq5TKy6rGDJUAnX41BokxYfdiw',
            'phone' => '+62 821-3344-556',
            'email' => 'dewilestari@webdesa.go.id',
            'bio' => 'Fokus pada pelayanan internal, manajemen kehumasan, penyediaan sarana operasional balai desa, dan mengurusi inventarisasi aset desa.',
            'duties' => [
                'Mengelola surat menyurat keluar masuk serta urusan rumah tangga balai desa.',
                'Melakukan inventarisasi dan mencatat pendaftaran tanah kas desa.',
                'Memberikan dukungan administratif untuk upacara adat dan agenda penting.'
            ]
        ]
    ];
}

// 2. Fetch Complaints List (E-Sambat Ticker Feed)
$complaintsList = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM complaints ORDER BY id DESC LIMIT 6");
        while ($row = $stmt->fetch()) {
            $complaintsList[] = $row;
        }
    } catch (\Exception $e) {
        // Fallback handled below
    }
}

// Session mock storage check if any offline submissions exist
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['complaints'])) {
    $complaintsList = array_merge($_SESSION['complaints'], $complaintsList);
}

// Fallback complaints list if database empty
if (empty($complaintsList)) {
    $complaintsList = [
        [
            'id' => 'c-1',
            'title' => 'Jalan Longsor Lingkar Dusun Timur',
            'category' => 'infrastruktur',
            'description' => 'Jalan semen lingkar timur mengalami retak parah dan sebagian amblas akibat hujan deras tadi malam. Sangat membahayakan pengguna jalan terutama motor.',
            'status' => 'Proses',
            'date_submitted' => '15 Juni 2026',
            'author' => 'Prasetyo',
            'tracking_id' => 'WD-SAMBAT-4819',
            'location' => 'RT 05 / RW 02 Dusun Timur',
            'response_message' => 'Laporan kerusakan jalan telah diverifikasi oleh tim perencana desa. Pemerintah desa sedang menyiapkan papan pembatas keselamatan darurat, semen beton cor akan ditambal mulai lusa menggunakan pagu anggaran darurat desa.'
        ],
        [
            'id' => 'c-2',
            'title' => 'Penumpukan Sampah Liar di Parit Sungai',
            'category' => 'kebersihan',
            'description' => 'Beberapa warga luar membuang sampah kantong plastik sembarangan di aliran anak sungai jembatan selatan. Air mulai tergenang dan menimbulkan bau menyengat.',
            'status' => 'Selesai',
            'date_submitted' => '14 Juni 2026',
            'author' => 'Warga Anonim',
            'tracking_id' => 'WD-SAMBAT-7391',
            'location' => 'Jembatan Sawah Selatan',
            'response_message' => 'Unit Satpol Pamong bekerjasama dengan Karang Taruna telah melakukan aksi bersih sungai mandiri kemarin. Spanduk larangan dan ancaman denda pidana kini terpasang kokoh di lokasi jembatan.'
        ]
    ];
}
?>

<!-- 1. Hero Section -->
<section class="relative overflow-hidden rounded-3xl bg-emerald-950 text-white min-h-[480px] flex items-center shadow-xl">
    <div class="absolute inset-0 z-0">
        <img 
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVIiHqkwc4q7FoIbLy_URotVT9QfNZoHKwtq6oDZc8XXcyGKfYHNEFEwA-goag4NHXXqfbHS8StbVkSvTRPcBJtAwkvxD69xjkXnJhDeYlQQcsswHAa_uKpyzrp4fgfuUft5YdaRkYBh1j3BnVCOigTICgWkoCLKHGbyBed_Q25zHoBqhdaxv493uqVT52QZp_Yw5YRpwF6fNhV2jQQRCQ_YCbcDfsp6Nrqyk6E_kF_V8YKB2_1kE5UScyrh8n8s5LjpOzTWM-V_U" 
            alt="Desa Teropong Sunrise" 
            class="w-full h-full object-cover opacity-35 scale-105 transition-all duration-1000 select-none"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/70 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto text-center px-6 py-20 space-y-6">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-xs font-semibold backdrop-blur-sm shadow-sm mx-auto">
            <i class="w-3.5 h-3.5 text-emerald-300" data-lucide="sparkles"></i> Selayang Pandang WebDesa Sukamaju
        </div>
        
        <h1 class="font-display text-3xl sm:text-5xl md:text-6xl font-extrabold tracking-tight leading-[1.1] text-white">
            Mengenal Lebih Dekat <br />
            <span class="text-[#ffdf41] font-black underline decoration-wavy decoration-[#38a130] decoration-2">Desa Kami</span> yang Asri &amp; Berdaya
        </h1>
        
        <p class="text-sm sm:text-lg text-emerald-100/90 max-w-2xl mx-auto font-sans leading-relaxed">
            Menelusuri jejak sejarah yang melegenda, visi masa depan digital yang modern, serta dedikasi tulus seluruh aparatur pemerintah desa dalam melayani segenap kearifan masyarakat lokal.
        </p>

        <div class="pt-4 flex flex-wrap justify-center gap-3">
            <a 
                href="index.php?page=services"
                class="px-6 py-3 bg-[#ffdf41] text-emerald-950 font-bold text-xs uppercase tracking-wider rounded-full hover:bg-white hover:scale-105 active:scale-95 transition-all shadow-md font-display inline-flex items-center gap-1"
            >
                Lihat Layanan Digital <i class="w-4 h-4 text-emerald-950" data-lucide="arrow-right"></i>
            </a>
            <a 
                href="#sejarah-desa" 
                class="px-6 py-3 bg-emerald-800/80 text-white font-semibold text-xs uppercase tracking-wider rounded-full border border-emerald-700/50 hover:bg-emerald-800 transition-all text-center"
            >
                Telusuri Sejarah ↓
            </a>
        </div>
    </div>
</section>

<!-- 2. Sejarah Desa Column -->
<section id="sejarah-desa" class="py-20 border-b border-gray-100 scroll-smooth">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Left Art frame -->
        <div class="lg:col-span-5 relative">
            <div class="aspect-square rounded-2xl overflow-hidden shadow-2xl relative border-8 border-white p-1 bg-gray-50 bg-gradient-to-tr from-emerald-100 to-white">
                <img 
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAiy7tiJieFtG2l5QRe3KicDXG_fCeWQ-C9BY0WqHvYeXGMPKAe8xWn4EASYznz9Gtk3-x038BbKqvg-CBHM73MOjdoRwQOIzq424Ek93HlT889hTOydG8rfWC0chTqJBjnJJr4T5QNL0upc2RaP6gcWc8sKM0gpWuyoVWDrW9yFx8hBwvs1B9C9zT_Fo48vvO7TIpz422EPbh4W7JF0nZgPX12k7iKTU6JffUH0eAxZb0i_BwyzUoCMnC7wZx7HCZjFtl_acna4c" 
                    alt="Beringin Tua Desa Bersejarah" 
                    class="w-full h-full object-cover hover:scale-105 transition-all duration-700"
                />
                <div class="absolute inset-0 bg-emerald-950/10 pointer-events-none"></div>
            </div>

            <!-- Asymmetric Quote card -->
            <div class="absolute -bottom-8 lg:right-[-40px] bg-emerald-900 text-[#e6f4e4] p-6 rounded-2xl shadow-xl w-64 border border-emerald-800 font-serif leading-relaxed italic transform rotate-[-2deg]">
                <p class="text-sm">
                    "Berawal dari tiga keluarga pengembara di lereng perbukitan selatan, menembus sejarah lewat kokohnya tali persaudaraan..."
                </p>
            </div>
        </div>

        <!-- Right Text -->
        <div class="lg:col-span-7 space-y-5 lg:pl-10 text-left">
            <span class="inline-block px-3.5 py-1 bg-[#ffdf41]/10 text-yellow-700 rounded-full font-bold text-[11px] uppercase tracking-wider border border-[#ffdf41]/25 font-display">
                SEJARAH DESA
            </span>
            <h2 class="font-display text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                Asal-Usul &amp; Perkembangan Wilayah
            </h2>

            <div class="space-y-4 text-xs sm:text-sm text-gray-600 leading-relaxed font-sans">
                <p>
                    Desa ini dirintis pada pertengahan abad ke-18 oleh tiga bersaudara beraliran agraris yang melakukan babat alas di wilayah lereng perbukitan subur. Dengan semangat kekeluargaan yang tinggi dan prinsip gotong-royong, daerah yang dulunya berupa hutan belantara kini bertransformasi menjadi lumbung pangan andalan pariwisata daerah.
                </p>
                <p>
                    Selama masa perjuangan kemerdekaan, sejarah mencatat desa kami sebagai pertahanan logistik pejuang rakyat karena melimpahnya sumber air pegunungan alami serta hasil tani. Warisan kegigihan tersebut mengakar erat dalam diri warga kami hingga kini: tangguh menghadapi bencana, mandiri berwirausaha, serta menjunjung tinggi tata krama kesopanan daerah.
                </p>
                <p>
                    Melalui program digitalisasi terpadu, WebDesa diresmikan demi mewujudkan tata kelola administrasi desa yang bersih, cepat, transparan dari mana saja tanpa meninggalkan kearifan lokal yang luhur.
                </p>
            </div>
        </div>

    </div>
</section>

<!-- 3. Visi & Misi Bento Grid -->
<section id="visi-misi" class="py-20 border-b border-gray-100">
    <div class="text-center max-w-xl mx-auto space-y-3 mb-16">
        <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display block">Arah &amp; Sasaran Pembangunan</span>
        <h2 class="font-display text-3xl font-extrabold text-gray-950">Visi &amp; Misi Utama</h2>
        <p class="text-xs sm:text-sm text-gray-500">Komitmen tulus pemerintah desa demi peningkatan kualitas hidup masyarakat yang berkelanjutan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Main Visi card -->
        <div class="md:col-span-3 bg-gradient-to-r from-emerald-950 to-emerald-900 p-8 sm:p-10 rounded-2xl text-center relative overflow-hidden group border border-emerald-800 shadow-lg text-white">
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 rounded-full translate-x-1/3 -translate-y-1/3 group-hover:scale-105 transition-transform duration-700"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-700/15 rounded-full -translate-x-1/4 translate-y-1/4 pointer-events-none"></div>
            
            <span class="inline-flex p-3 rounded-2xl bg-white/10 text-[#ffdf41] mb-4">
                <i class="w-8 h-8 text-[#ffdf41]" data-lucide="milestone"></i>
            </span>
            <h3 class="font-display text-xl sm:text-2xl font-bold tracking-tight text-white mb-4">Visi Pembangunan Desa</h3>
            <p class="font-serif text-base sm:text-xl text-emerald-100 italic max-w-2xl mx-auto leading-relaxed">
                "Mewujudkan Desa Mandiri yang Berbasis Digitalisasi Pelayanan Terpadu, Berkarakter Adat Budaya, serta Sejahtera Lahir Batin Secara Merata Pada Tahun 2029."
            </p>
        </div>

        <!-- Misi Item 1 -->
        <div class="p-6 rounded-2xl bg-white border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition-shadow text-left">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 border border-emerald-100 flex-shrink-0">
                <i class="w-5.5 h-5.5 text-emerald-700" data-lucide="users"></i>
            </div>
            <h4 class="font-display text-base font-bold text-gray-900 mb-2">Pemberdayaan Masyarakat</h4>
            <p class="text-xs text-gray-500 leading-relaxed">
                Membangun kemandirian ekonomi warga melalui forum Musrenbang yang inklusif, pendampingan UMKM, kelompok tani, sertifikasi keahlian, dan pemerataan bantuan modal produktif kerja.
            </p>
        </div>

        <!-- Misi Item 2 -->
        <div class="p-6 rounded-2xl bg-white border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition-shadow text-left">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 border border-emerald-100 flex-shrink-0">
                <i class="w-5.5 h-5.5 text-emerald-700" data-lucide="smartphone"></i>
            </div>
            <h4 class="font-display text-base font-bold text-gray-900 mb-2">Digitalisasi Pelayanan</h4>
            <p class="text-xs text-gray-500 leading-relaxed">
                Mengadopsi pemanfaatan teknologi informasi untuk mempermudah akses layanan keadministrasian kependudukan, pengaduan keluhan, serta efisiensi transparansi dana tunai anggaran desa.
            </p>
        </div>

        <!-- Misi Item 3 -->
        <div class="p-6 rounded-2xl bg-white border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition-shadow text-left">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 border border-emerald-100 flex-shrink-0">
                <i class="w-5.5 h-5.5 text-emerald-700" data-lucide="sprout"></i>
            </div>
            <h4 class="font-display text-base font-bold text-gray-900 mb-2">Lingkungan yang Asri</h4>
            <p class="text-xs text-gray-500 leading-relaxed">
                Menjaga kelestarian lingkungan hidup dan sumber daya alam hayati lewat program penghijauan hulu sungai, penataan limbah sampah warga mandiri, serta konservasi sawah beririgasi.
            </p>
        </div>

    </div>
</section>

<!-- 4. Struktur Organisasi -->
<section id="aparatur" class="py-20 border-b border-gray-100">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12 text-left">
        <div class="space-y-2">
            <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display block">Aparatur Berintegritas</span>
            <h2 class="font-display text-3xl font-extrabold text-[#111]">Struktur Urusan Kepengurusan</h2>
            <p class="text-xs sm:text-sm text-gray-500">Pemerintah Desa Terpilih yang mengemban tugas amanah masa bakti 2021 - 2027.</p>
        </div>

        <button 
            onclick="toggleModal('orgModal')" 
            class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-bold hover:bg-emerald-100 hover:scale-105 active:scale-95 transition-all w-fit font-display shadow-sm uppercase tracking-wide leading-none"
        >
            Lihat Bagan Lengkap <i class="w-3.5 h-3.5" data-lucide="arrow-right"></i>
        </button>
    </div>

    <!-- Leader Profile Card Spotlights -->
    <div class="flex justify-center mb-12">
        <div 
            onclick="openStaffModal(0)"
            class="w-full max-w-sm p-6 rounded-2xl border border-emerald-100/30 bg-emerald-50/50 hover:bg-emerald-50 text-center flex flex-col items-center shadow-md relative cursor-pointer group hover:border-emerald-200 transition-all"
        >
            <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-white shadow-md relative z-10 flex-shrink-0 bg-gray-100">
                <img 
                    src="<?php echo $staffList[0]['image_url']; ?>" 
                    alt="<?php echo $staffList[0]['name']; ?>" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300"
                />
            </div>
            
            <div class="mt-4 space-y-1">
                <h4 class="font-display text-lg font-extrabold text-gray-900 leading-none"><?php echo $staffList[0]['name']; ?></h4>
                <p class="text-xs font-bold text-emerald-800 uppercase tracking-widest font-display"><?php echo $staffList[0]['role']; ?></p>
                <p class="text-[10px] text-gray-400 mt-1">✨ Klik untuk detail tanggung jawab</p>
            </div>

            <div class="flex gap-2 justify-center pt-3 mt-4 border-t border-gray-100 w-full text-gray-400">
                <span class="p-2 rounded-full hover:bg-white hover:text-emerald-700 transition-all shadow-sm">
                    <i class="w-4 h-4 text-gray-400" data-lucide="mail"></i>
                </span>
                <span class="p-2 rounded-full hover:bg-white hover:text-emerald-700 transition-all shadow-sm">
                    <i class="w-4 h-4 text-gray-400" data-lucide="phone"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Staff Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <?php for ($i = 1; $i < count($staffList); $i++): ?>
        <div
            onclick="openStaffModal(<?php echo $i; ?>)"
            class="p-5 rounded-2xl bg-white border border-gray-100 text-center flex flex-col items-center hover:shadow-md cursor-pointer transition-all hover:bg-gray-50/50 group"
        >
            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-emerald-100/50 shadow-sm relative z-10 flex-shrink-0 bg-gray-100 mb-3">
                <img 
                    src="<?php echo $staffList[$i]['image_url']; ?>" 
                    alt="<?php echo $staffList[$i]['name']; ?>" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300"
                />
            </div>
            <h5 class="font-display text-xs sm:text-sm font-extrabold text-gray-900 tracking-tight leading-snug"><?php echo $staffList[$i]['name']; ?></h5>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-display mt-1"><?php echo $staffList[$i]['role']; ?></p>
        </div>
        <?php endfor; ?>
    </div>
</section>

<!-- 5. Geografis & Demografis -->
<section id="geografis" class="py-20">
    <div class="text-center max-w-xl mx-auto space-y-3 mb-16">
        <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display block">Luas &amp; Penduduk Wilayah</span>
        <h2 class="font-display text-3xl font-extrabold text-gray-950">Geografis &amp; Demografis</h2>
        <p class="text-xs sm:text-sm text-gray-500">Kondisi topografi tanah serta persebaran diagram penduduk desa kami.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Geografis Box -->
        <div class="lg:col-span-6 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6 text-left">
            <div class="flex items-center gap-2.5">
                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-700">
                    <i class="w-5 h-5 text-emerald-700" data-lucide="map-pin"></i>
                </div>
                <div>
                    <h3 class="font-display text-base font-bold text-gray-900">Wilayah Batas Teritorial</h3>
                    <p class="text-[11px] text-gray-400">Total Luas Daerah: 1,240 Hektar</p>
                </div>
            </div>

            <!-- Satellite Map -->
            <div class="aspect-[16/10] rounded-xl overflow-hidden relative border border-gray-100 shadow-inner group">
                <img 
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjvGNSvxEQ_Y2tGNZFrOIkSHXZADGKntB9v_q-kMHdHsjRzQ_k1ebWokxvdv2PCEpuNlACaYdbAXrrifjeqQMVzADcDwgVTx3FBhXnHhDcj_WlxxWnidizr-ovl9p3wMr_8PYvVkbL3iGOqBQ4bs2eGhDRVDZaNWy08lclTXZXILxYsoRtCM8zXFjoWZs5hxC5f6Vroveqo5MMGpe38jyskYbSYbaQ1t3SLwimok2JeYcfVIWGCEX5jmHlzFxXzURETCF2k_qi3A0" 
                    alt="Peta Satelit Wilayah Desa" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 select-none"
                />
                <div class="absolute inset-0 bg-emerald-950/5 pointer-events-none"></div>
                
                <!-- Overlay Legend -->
                <div class="absolute top-3 right-3 bg-white/90 p-3 rounded-lg border border-gray-100 shadow-sm max-w-[170px] text-[10px] space-y-1.5 backdrop-blur-sm pointer-events-none text-left">
                    <p class="font-bold text-gray-700 border-b border-gray-200 pb-1 mb-1 font-display">BATAS WILAYAH</p>
                    <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-500"></span> <span>Utara: Desa Makmur</span></div>
                    <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-500"></span> <span>Timur: Kec. Harapan</span></div>
                    <div class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> <span>Selatan: Hutan Lindung</span></div>
                </div>
            </div>

            <!-- Stats grid -->
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/55 p-4 text-center">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-display">Luas Wilayah</p>
                    <p class="text-lg font-extrabold text-emerald-800">1,240 Ha</p>
                </div>
                <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/55 p-4 text-center">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-display">Ketinggian Rata-Rata</p>
                    <p class="text-lg font-extrabold text-emerald-800">450 MDPL</p>
                </div>
            </div>
        </div>

        <!-- Demografis Box with Tab switchters -->
        <div class="lg:col-span-6 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between min-h-[440px] text-left">
            <div class="space-y-6">
                <div class="flex justify-between items-center flex-wrap gap-2">
                    <div class="flex items-center gap-2.5">
                        <div class="p-2.5 rounded-xl bg-orange-50 text-orange-700">
                            <i class="w-5 h-5 text-orange-700" data-lucide="activity"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-base font-bold text-gray-900">Statistik Kependudukan</h3>
                            <p class="text-[11px] text-gray-400">Total: <span class="font-bold text-emerald-700">4,829 Jiwa</span></p>
                        </div>
                    </div>
                    
                    <!-- Switchers -->
                    <div class="flex gap-1 bg-gray-100 rounded-full p-1 text-[10px] font-bold">
                        <button 
                            onclick="setDemoTab('gender_age')"
                            id="demoBtnGenderAge"
                            class="px-3 py-1 rounded-full bg-white text-gray-900 shadow-sm"
                        >
                            Usia &amp; Gender
                        </button>
                        <button 
                            onclick="setDemoTab('pencaharian')"
                            id="demoBtnPencaharian"
                            class="px-3 py-1 rounded-full text-gray-500 hover:text-gray-900"
                        >
                            Mata Pencaharian
                        </button>
                    </div>
                </div>

                <!-- Section: Usia & Gender -->
                <div id="demoContentGenderAge" class="space-y-6">
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs font-semibold text-gray-700">
                            <span class="flex items-center gap-1">👨 Laki-laki: 2,450 (51%)</span>
                            <span class="flex items-center gap-1">👩 Perempuan: 2,379 (49%)</span>
                        </div>
                        <div class="h-6.5 w-full bg-gray-100 rounded-full overflow-hidden flex shadow-inner p-1">
                            <div class="h-full bg-emerald-700 rounded-l-full flex items-center justify-center text-[10px] font-bold text-white transition-all py-1.5" style="width: 51%">51%</div>
                            <div class="h-full bg-[#fca26e] rounded-r-full flex items-center justify-center text-[10px] font-bold text-emerald-950 transition-all py-1.5" style="width: 49%">49%</div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest font-display">Kelompok Golongan Usia</p>
                        
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs text-gray-600">
                                <span>Anak-Anak (0-18 Tahun)</span>
                                <span class="font-bold text-emerald-900">25% (1.207 jiwa)</span>
                            </div>
                            <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-600 transition-all" style="width: 25%"></div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between text-xs text-gray-600">
                                <span>Usia Produktif (19-55 Tahun)</span>
                                <span class="font-bold text-emerald-900 font-display">60% (2.897 jiwa)</span>
                            </div>
                            <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-700 transition-all" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between text-xs text-gray-600">
                                <span>Lansia (&gt; 55 Tahun)</span>
                                <span class="font-bold text-emerald-900">15% (725 jiwa)</span>
                            </div>
                            <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#ffdf41] transition-all" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Kerja -->
                <div id="demoContentPencaharian" class="hidden space-y-4">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest font-display mb-2">Sebaran Lapangan Pekerjaan Utama</p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl border border-gray-100 bg-emerald-50/30 flex gap-3 items-center">
                            <span class="text-2xl">🌾</span>
                            <div>
                                <p class="text-xs text-gray-400">Petani &amp; Pekebun</p>
                                <p class="text-xl font-bold text-emerald-800 font-display">72%</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl border border-gray-100 bg-orange-50/30 flex gap-3 items-center">
                            <span class="text-2xl">🏪</span>
                            <div>
                                <p class="text-xs text-gray-400">Pedagang Mandiri</p>
                                <p class="text-xl font-bold text-orange-900 font-display">18%</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl border border-gray-100 bg-blue-50/30 flex gap-3 items-center">
                            <span class="text-2xl">🏗️</span>
                            <div>
                                <p class="text-xs text-gray-400">Buruh &amp; Konstruksi</p>
                                <p class="text-xl font-bold text-blue-800">6%</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl border border-gray-100 bg-yellow-50/30 flex gap-3 items-center">
                            <span class="text-2xl">💼</span>
                            <div>
                                <p class="text-xs text-gray-400">PNS / TNI / Swasta</p>
                                <p class="text-xl font-bold text-yellow-700">4%</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-lg text-[10px] text-[#4d514e]">
                        💡 Mayoritas lahan adalah sawah basah, sehingga mayoritas penduduk bermatapencaharian bercocok tanam padi gogo sawah organik andalan perbukitan selatan.
                    </div>
                </div>

            </div>

            <div class="pt-4 border-t border-gray-100 mt-6 text-[10px] text-gray-400 flex justify-between items-center">
                <span>* Data diupdate secara manual per semester dari KK jemaat</span>
                <span class="text-emerald-700 font-bold">Terakreditasi A</span>
            </div>
        </div>

    </div>
</section>

<!-- Feedback transparent E-Sambat complaints feed lists -->
<section class="mt-24 border-t border-gray-100 pt-16 text-left">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-3 mb-10">
        <div class="space-y-2">
            <span class="text-xs font-bold text-yellow-700 uppercase tracking-widest font-display block">Pantau Aduan Masyarakat</span>
            <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-[#111] tracking-tight">Feed Transparansi E-Sambat</h2>
            <p class="text-xs sm:text-sm text-gray-500 max-w-xl">Laporan aspirasi, gangguan infrastruktur, serta usulan pembangunan desa yang diungkapkan secara jujur dan ditindaklanjuti secara terbuka.</p>
        </div>

        <button 
            onclick="toggleModal('reportModal')"
            class="px-5 py-2.5 bg-yellow-600 text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-yellow-700 transition-all shadow-md w-fit font-display flex items-center gap-1 leading-none shrink-0"
        >
            <i class="w-4 h-4 text-white" data-lucide="shield-alert"></i> Kirim Aduan Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($complaintsList as $ticket): ?>
        <div class="bg-white border border-gray-100 rounded-2xl p-6 space-y-4 text-left hover:shadow-md transition-shadow relative">
            <div class="flex justify-between items-center bg-gray-50/50 p-2.5 rounded-xl border border-gray-100 text-xs">
                <div>
                    <span class="text-gray-400 font-semibold uppercase text-[9px] block">Kode Laporan</span>
                    <span class="font-bold text-primary text-[11px] font-mono select-all tracking-wide"><?php echo $ticket['tracking_id']; ?></span>
                </div>
                <?php if ($ticket['status'] === 'Selesai'): ?>
                    <span class="bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-extrabold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider block transition-colors border border-emerald-100">
                        ✅ Selesai Dikerjakan
                    </span>
                <?php else: ?>
                    <span class="bg-orange-50 text-orange-700 font-extrabold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider block border border-orange-100">
                        ⏳ Sedang Diproses
                    </span>
                <?php endif; ?>
            </div>

            <div class="space-y-1">
                <span class="px-2 py-0.5 bg-gray-100 rounded text-[9px] uppercase font-bold text-gray-500 tracking-wider">
                    🏡 <?php echo ucfirst($ticket['category']); ?>
                </span>
                <h4 class="font-display font-extrabold text-gray-900 text-base leading-snug"><?php echo $ticket['title']; ?></h4>
                <p class="text-xs text-gray-400">Oleh: <span class="font-bold"><?php echo $ticket['author']; ?></span> • <?php echo $ticket['date_submitted']; ?></p>
            </div>

            <p class="text-xs text-gray-500 leading-relaxed font-sans bg-gray-50/50 p-3 rounded-lg border border-gray-50 italic">
                "<?php echo $ticket['description']; ?>"
            </p>

            <div class="text-[11px] text-gray-400 flex items-center gap-1">
                <i class="w-3.5 h-3.5" data-lucide="map-pin"></i> Lokasi peristiwa: <span class="font-semibold text-gray-700"><?php echo $ticket['location']; ?></span>
            </div>

            <!-- Respon Aparatur balai desa -->
            <div class="bg-emerald-50/15 p-4 rounded-xl border border-emerald-100/50 space-y-2">
                <div class="flex items-center gap-1.5 border-b border-emerald-100/20 pb-1.5">
                    <div class="w-5 h-5 bg-primary text-white rounded-full flex items-center justify-center text-[10px] font-bold">S</div>
                    <span class="text-[10px] font-bold text-primary uppercase tracking-widest">Respon Resmi Kelurahan</span>
                </div>
                <p class="text-xs text-emerald-950 font-sans leading-relaxed"><?php echo $ticket['response_message']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Staff Detail Modal -->
<div id="staffModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 overflow-y-auto">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden glass-card">
        <div class="p-5 bg-primary text-white flex justify-between items-center">
            <h4 class="font-display font-bold text-base">Profil Pejabat Pemerintahan</h4>
            <button onclick="closeStaffModal()" class="p-1 rounded-full hover:bg-white/10 transition-colors">
                <i class="w-5 h-5 text-white" data-lucide="x"></i>
            </button>
        </div>

        <div class="p-6 space-y-6 text-left">
            <div class="flex gap-4 items-center">
                <div class="w-16 h-16 rounded-full overflow-hidden border border-gray-200 flex-shrink-0">
                    <img id="staffModalImg" src="" alt="" class="w-full h-full object-cover" />
                </div>
                <div>
                     <h5 id="staffModalName" class="font-display font-extrabold text-base text-gray-900">-</h5>
                     <p id="staffModalRole" class="text-xs font-bold text-emerald-800 uppercase tracking-widest">-</p>
                     <p id="staffModalDetailRole" class="text-[10px] text-gray-400">-</p>
                </div>
            </div>

            <div class="space-y-2">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Bio Singkat</p>
                <p id="staffModalBio" class="text-xs text-gray-600 leading-relaxed bg-gray-50 p-3.5 rounded-xl border border-gray-100 italic">
                    -
                </p>
            </div>

            <div class="space-y-2.5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Tugas Instansi Utama</p>
                <div id="staffModalDuties" class="space-y-1.5 text-xs text-gray-650">
                    <!-- Loaded via JS -->
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-between text-xs text-gray-500">
                <span id="staffModalEmail" class="font-mono">📬 -</span>
                <span id="staffModalPhone" class="font-mono">📞 -</span>
            </div>
        </div>
    </div>
</div>

<!-- Org structures modal -->
<div id="orgModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 overflow-y-auto">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card">
        <div class="p-5 bg-gradient-to-r from-emerald-950 to-primary text-white flex justify-between items-center">
            <div class="text-left">
                <h4 class="font-display font-bold text-lg">Bagan Alur Kepengurusan Desa</h4>
                <p class="text-[10px] text-emerald-200">Interaksi Struktural Pemerintah Desa Sukamaju</p>
            </div>
            <button onclick="toggleModal('orgModal', false)" class="p-1.5 rounded-full hover:bg-white/10 transition-colors">
                <i class="w-5 h-5 text-white" data-lucide="x"></i>
            </button>
        </div>

        <div class="p-8 space-y-8 overflow-x-auto text-center">
            <div class="min-w-[650px] space-y-8 mx-auto">
                <!-- Level 1 Kepala -->
                <div class="flex justify-center">
                    <div class="p-3 bg-emerald-900 text-white rounded-lg border-2 border-emerald-600 text-center w-56 font-display shadow-md">
                        <p class="text-[10px] uppercase font-bold text-emerald-300">Kepala Desa</p>
                        <p class="font-extrabold text-xs"><?php echo $staffList[0]['name']; ?></p>
                    </div>
                </div>

                <!-- Level 2 Sekretaris -->
                <div class="flex justify-center relative">
                    <div class="absolute top-[-32px] bottom-[32px] w-0.5 bg-gray-300 left-1/2"></div>
                    
                    <div class="p-3 bg-emerald-50 text-emerald-950 rounded-lg border-2 border-emerald-400 text-center w-56 font-display shadow-sm z-10">
                        <p class="text-[10px] uppercase font-bold text-emerald-700">Sekretaris Desa</p>
                        <p class="font-extrabold text-xs"><?php echo $staffList[1]['name']; ?></p>
                    </div>
                </div>

                <!-- Level 3 staff -->
                <div class="relative">
                    <div class="absolute top-[-32px] left-1/2 w-0.5 h-8 bg-gray-300"></div>
                    <div class="absolute top-0 left-[16.6%] right-[16.6%] h-0.5 bg-gray-300"></div>
                    
                    <div class="grid grid-cols-3 gap-4 pt-8">
                        <div class="flex flex-col items-center relative">
                            <div class="absolute top-[-32px] w-0.5 h-8 bg-gray-300"></div>
                            <div class="p-3 bg-white border border-gray-200 rounded-lg text-center w-48 font-display shadow-inner">
                                <p class="text-[9px] uppercase font-bold text-gray-400">Keuangan / Bendahara</p>
                                <p class="font-bold text-xs text-gray-800"><?php echo $staffList[2]['name']; ?></p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center relative">
                            <div class="absolute top-[-32px] w-0.5 h-8 bg-gray-300"></div>
                            <div class="p-3 bg-white border border-gray-200 rounded-lg text-center w-48 font-display shadow-inner">
                                <p class="text-[9px] uppercase font-bold text-gray-400">Kaur Perencanaan</p>
                                <p class="font-bold text-xs text-gray-800"><?php echo $staffList[3]['name']; ?></p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center relative">
                            <div class="absolute top-[-32px] w-0.5 h-8 bg-gray-300"></div>
                            <div class="p-3 bg-white border border-gray-200 rounded-lg text-center w-48 font-display shadow-inner">
                                <p class="text-[9px] uppercase font-bold text-gray-400">Kaur Umum &amp; Humas</p>
                                <p class="font-bold text-xs text-gray-800"><?php echo $staffList[4]['name']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-xs text-gray-400 italic pt-6 bg-gray-50 rounded-xl leading-relaxed">
                Bagan kepengurusan ini disusun transparan dalam kerangka tata kerja kolaboratif. Klik salah satu pejabat di halaman utama untuk melihat rincian riwayat kepemimpinan serta kontak dinas resmi masing-masing aparatur.
            </p>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <button onclick="toggleModal('orgModal', false)" class="px-5 py-2.5 bg-gray-800 text-white hover:bg-gray-900 font-bold text-xs rounded-xl transition-colors font-display">
                Selesai
            </button>
        </div>
    </div>
</div>

<script>
    // Staff details array prefilled from php to make modal binding simple
    const staffArray = <?php echo json_encode($staffList); ?>;

    function openStaffModal(index) {
        const staff = staffArray[index];
        if (!staff) return;

        document.getElementById('staffModalImg').src = staff.image_url;
        document.getElementById('staffModalName').innerText = staff.name;
        document.getElementById('staffModalRole').innerText = staff.role;
        document.getElementById('staffModalDetailRole').innerText = staff.detail_role;
        document.getElementById('staffModalBio').innerText = `"${staff.bio}"`;
        document.getElementById('staffModalEmail').innerText = "📬 " + staff.email;
        document.getElementById('staffModalPhone').innerText = "📞 " + staff.phone;

        const dutiesContainer = document.getElementById('staffModalDuties');
        dutiesContainer.innerHTML = '';
        staff.duties.forEach(duty => {
            dutiesContainer.innerHTML += `
                <div class="flex gap-2 items-start text-left">
                    <i class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" data-lucide="check-circle"></i>
                    <span>${duty}</span>
                </div>
            `;
        });

        toggleModal('staffModal', true);
        lucide.createIcons();
    }

    function closeStaffModal() {
        toggleModal('staffModal', false);
    }

    function setDemoTab(type) {
        const btnGeo = document.getElementById('demoBtnGenderAge');
        const btnWork = document.getElementById('demoBtnPencaharian');
        const contentGeo = document.getElementById('demoContentGenderAge');
        const contentWork = document.getElementById('demoContentPencaharian');

        if (type === 'gender_age') {
            btnGeo.className = "px-3 py-1 rounded-full bg-white text-gray-900 shadow-sm";
            btnWork.className = "px-3 py-1 rounded-full text-gray-500 hover:text-gray-900";
            contentGeo.classList.remove('hidden');
            contentWork.classList.add('hidden');
        } else {
            btnWork.className = "px-3 py-1 rounded-full bg-white text-gray-900 shadow-sm";
            btnGeo.className = "px-3 py-1 rounded-full text-gray-500 hover:text-gray-900";
            contentWork.classList.remove('hidden');
            contentGeo.classList.add('hidden');
        }
    }
</script>
