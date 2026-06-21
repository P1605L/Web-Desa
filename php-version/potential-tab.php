<?php
// PHP Version: Potential Tab Content & Logic Component
// Pulls live tourism, agricultural, and UMKM items from DB with bulletproof fallbacks

// 1. Fetch Potential Items
$potentialItems = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM potential_items ORDER BY id ASC");
        while ($row = $stmt->fetch()) {
            $row['stats'] = json_decode($row['stats'], true);
            $potentialItems[] = $row;
        }
    } catch (\Exception $e) {
        // Fallback handled below
    }
}

// Fallback potential items list if database is empty/offline
if (empty($potentialItems)) {
    $potentialItems = [
        [
            'id' => 'pot-1',
            'title' => 'Padi Gogo Sawah Organik Lereng',
            'category' => 'pertanian',
            'subtitle' => 'Komoditas Unggulan Sektor Pangan',
            'tagline' => '✨ Beras aromatik premium tanpa tambahan bahan kimia sintetis.',
            'description' => 'Pertanian padi organik gogo sawah lereng perbukitan selatan desa ditanam penuh kasih dengan pupuk kompos organik hewani alami gratis. Sawah dialiri mata air pergunungan murni tanpa tercemar limbah pemukiman kota.',
            'image_url' => 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?q=80&w=700&auto=format&fit=crop',
            'stats' => ['produksi' => '1,200 Ton / Tahun', 'lahan' => '420 Hektar', 'petani' => '320 Kepala Keluarga', 'ekspor' => 'Pasar Regional & Nasional'],
            'pengelola' => 'Gapoktan (Gabungan Kelompok Tani) Lestari Nyata',
            'kontak' => '+62 813-9090-8800',
            'price_detail' => 'Membeli Beras Organik Kemasan 5kg'
        ],
        [
            'id' => 'pot-2',
            'title' => 'Kebun Kopi Arabika lereng Selo',
            'category' => 'pertanian',
            'subtitle' => 'Komoditas Kopi Khas Ketinggian',
            'tagline' => '☕ Cita rasa buah ceri merah dengan aroma harum bunga melati.',
            'description' => 'Kawasan perkebunan kopi arabika rakyat di lereng perbukitan dengan ketinggian mencapai 800-1100 MDPL. Biji kopi dipetik merah secara selektif oleh petani wanita dan diolah melalui metode pascapanen natural basah.',
            'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=700&auto=format&fit=crop',
            'stats' => ['produksi' => '45 Ton Biji Kering / Tahun', 'lahan' => '65 Hektar', 'petani' => '50 Kepala Keluarga', 'ekspor' => 'Kedai Kopi Khusus Ibu Kota'],
            'pengelola' => 'Kelompok Tani Tunas Jaya Sejahtera',
            'kontak' => '+62 811-3322-114',
            'price_detail' => 'Pesan Biji Kopi Arabika Roast/Greenbean'
        ],
        [
            'id' => 'pot-3',
            'title' => 'Wisata Alam Air Terjun Lembah Hijau',
            'category' => 'wisata',
            'subtitle' => 'Ekowisata Berkelanjutan Berbasis Komunitas',
            'tagline' => '🌊 Terjunan air jernih setinggi 30 meter di tengah hutan pinus asri.',
            'description' => 'Keindahan air terjun asri alami yang tersembunyi. Area wisata dikelola sepenuhnya oleh Pokdarwis (Kelompok Sadar Wisata) Karang Taruna desa dengan fasilitas jalur trekking rindang, flying fox safety, spot foto atas bukit, dan warung kuliner tradisional.',
            'image_url' => 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=700&auto=format&fit=crop',
            'stats' => ['pengunjung' => '2,500 Orang / Bulan', 'fasilitas' => 'Toilet, Camping Ground, Gazebo', 'tiket' => 'Rp 10.000 / Orang', 'jaringan' => 'Sinyal Telkomsel 4G Lancar'],
            'pengelola' => 'Pokdarwis Lembah Hijau Sejahtera',
            'kontak' => '+62 856-4455-667',
            'price_detail' => 'Booking Area Camping / Paket Wisata Outbound'
        ],
        [
            'id' => 'pot-4',
            'title' => 'Desa Agro Wisata Edukasi Kebun Buah',
            'category' => 'wisata',
            'subtitle' => 'Agrowisata Edukatif Petik Buah Segar',
            'tagline' => '🍊 Wisata petik buah durian montong, jeruk madu, dan kelengkeng.',
            'description' => 'Destinasi asyik edukatif memetik buah segar langsung dari tangkainya di lahan perkebunan desa seluas 12 hektar. Setiap pengunjung akan dibimbing oleh pemandu tani terpercaya tentang tata cara okulasi pembibitan pohon buah.',
            'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=700&auto=format&fit=crop',
            'stats' => ['panen' => 'Setiap Bulan Juni - Agustus', 'luas' => '12 Hektar Lahan Terbuka', 'pilihan' => 'Durian, Jeruk, Alpukat, Jambu', 'tiket' => 'Rp 15.000 (Free 1 Gelas Jus Jeruk)'],
            'pengelola' => 'Poktan Tunas Makmur Sentosa',
            'kontak' => '+62 812-7776-554',
            'price_detail' => 'Pesan Tiket Wisata Edukasi Rombongan Sekolah'
        ],
        [
            'id' => 'pot-5',
            'title' => 'Kerajinan Anyaman Bambu Lestari',
            'category' => 'umkm',
            'subtitle' => 'Pengembangan Ekonomi Kreatif Adat Lokal',
            'tagline' => '👜 Tas, keranjang, pot bunga estetis berbahan serat bambu ramah lingkungan.',
            'description' => 'Warisan urun-temurun menganyam bilah bambu yang ramah bumi. Melalui bimbingan PKK kelurahan, produk anyaman bambu kini diproduksi dengan model retro minimalis kekinian bermutu tinggi layak dipasarkan ke butik nasional serta ekspor.',
            'image_url' => 'https://images.unsplash.com/photo-1590736969955-71cc94801759?q=80&w=700&auto=format&fit=crop',
            'stats' => ['pengrajin' => '40 Ibu Rumah Tangga', 'kapasitas' => '1,500 Produk / Bulan', 'harga' => 'Rp 25.000 - Rp 250.000', 'pemasaran' => 'Shopee, Tokopedia, & Toko Oleh-oleh'],
            'pengelola' => 'Koperasi Kreatif Usaha Desa Wanita Mandiri',
            'kontak' => '+62 822-1111-222',
            'price_detail' => 'Pesan Kerajinan Anyaman Bambu Grosir/Custom'
        ],
        [
            'id' => 'pot-6',
            'title' => 'Batik Tulis Motif Khas Daun Sawah',
            'category' => 'umkm',
            'subtitle' => 'Karya Seni Adat Nilai Tinggi',
            'tagline' => '🎨 Cap tulis bermotif siluet alam padi dan daun srigading pegunungan.',
            'description' => 'Setiap helai kain katun prima dicanangkan malam tradisional secara manual menggunakan canting tembaga kuningan murni. Produk batik srigading mengekspresikan kehidupan agraris pedesaan yang damai, asri, nan makmur sejahtera lahiriah.',
            'image_url' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=700&auto=format&fit=crop',
            'stats' => ['pengrajin' => '15 Pemuda & Seniman Desa', 'pembuatan' => '3 Minggu per Helai Sutra', 'pewarna' => 'Alami dari Ekstrak Kulit Kayu', 'harga' => 'Rp 150.000 - Rp 1.500.000'],
            'pengelola' => 'Sanggar Seni & Batik Cipta Svara',
            'kontak' => '+62 821-4477-991',
            'price_detail' => 'Pesan Kain Batik Tulis Motif Adat Eksklusif'
        ]
    ];
}

// 2. Filter list dynamically
$selectedCategory = isset($_GET['cat']) ? sanitizeInput($_GET['cat']) : 'all';
$searchQuery = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

$filteredItems = [];
foreach ($potentialItems as $item) {
    if ($selectedCategory !== 'all' && $item['category'] !== $selectedCategory) {
        continue;
    }
    if (!empty($searchQuery)) {
        if (stripos($item['title'], $searchQuery) === false && stripos($item['description'], $searchQuery) === false) {
            continue;
        }
    }
    $filteredItems[] = $item;
}
?>

<!-- BANNER SUCCESS INJEKSI -->
<?php if (isset($_GET['inquire_status']) && $_GET['inquire_status'] === 'success'): ?>
    <div class="mb-10 text-left p-6 bg-yellow-50 border-l-4 border-yellow-600 rounded-xl max-w-4xl mx-auto flex gap-4 items-start shadow-sm animate-fade-in">
        <div class="p-2 bg-yellow-105 text-yellow-850 rounded-full">
            <i class="w-6 h-6 text-yellow-600" data-lucide="check"></i>
        </div>
        <div>
            <h3 class="font-display font-bold text-yellow-950 text-base">Inquiry Sukses Terkirim</h3>
            <p class="text-xs text-yellow-905 leading-relaxed mt-0.5">Kami telah mencatat data minat Anda untuk <strong><?php echo htmlspecialchars($_GET['item']); ?></strong>. Tim pengelola BUMDES setempat akan segera menghubungi nomor telepon Anda untuk mendiskusikan rincian kemitraan / pemesanan.</p>
        </div>
    </div>
<?php endif; ?>

<!-- Section Title -->
<section class="mb-12">
    <div class="text-center max-w-xl mx-auto space-y-3">
         <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display block">Sinergi Kemandirian Daerah</span>
         <h2 class="font-display text-3xl font-extrabold text-[#111]">Potensi Desa &amp; Produk Kreatif</h2>
         <p class="text-xs sm:text-sm text-gray-500">Mempelajari keindahan ekowisata, komoditas pangan organik lereng bukit, serta anyaman eksklusif warisan leluhur desa.</p>
    </div>

    <!-- Category Filters Navigation -->
    <div class="flex flex-wrap gap-2 justify-center mt-10 text-xs font-semibold">
        <a 
            href="index.php?page=potential&cat=all" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'all') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            🌍 Semua Potensi
        </a>
        <a 
            href="index.php?page=potential&cat=pertanian" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'pertanian') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            🌾 Pertanian &amp; Kebun
        </a>
        <a 
            href="index.php?page=potential&cat=wisata" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'wisata') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            🌊 Ekowisata Alam
        </a>
        <a 
            href="index.php?page=potential&cat=umkm" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'umkm') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            👜 Industri Kreatif UMKM
        </a>
    </div>
</section>

<!-- Items Grid list -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($filteredItems as $item): ?>
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full text-left">
        
        <!-- Image Header -->
        <div class="aspect-[16/10] relative w-full overflow-hidden bg-gray-100 shrink-0">
            <img 
                src="<?php echo $item['image_url']; ?>" 
                alt="<?php echo $item['title']; ?>" 
                class="w-full h-full object-cover select-none"
                referrerpolicy="no-referrer"
            />
            
            <span class="absolute top-4 left-4 inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/95 text-yellow-800 text-[10px] font-bold shadow font-display uppercase tracking-wider">
                <?php echo $item['category'] === 'pertanian' ? '🌾 Tani' : ($item['category'] === 'wisata' ? '🌊 Wisata' : '👜 UMKM'); ?>
            </span>
        </div>

        <!-- Content -->
        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
            <div class="space-y-1.5">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block leading-none"><?php echo $item['subtitle']; ?></span>
                <h3 class="font-display font-extrabold text-[#1a2d1d] text-base leading-snug"><?php echo $item['title']; ?></h3>
                <p class="text-xs text-gray-500 line-clamp-3 font-sans leading-relaxed"><?php echo $item['description']; ?></p>
            </div>

            <div class="border-t border-gray-100 pt-4 text-xs">
                <p class="text-orange-850 font-bold mb-3"><?php echo $item['tagline']; ?></p>
                
                <button 
                    onclick="openInquireModal('<?php echo $item['id']; ?>')"
                    class="w-full py-3 bg-emerald-50 text-emerald-800 hover:bg-primary hover:text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all font-display text-center flex items-center justify-center gap-1.5 border border-emerald-100/50 cursor-pointer"
                >
                    <i class="w-4 h-4" data-lucide="store"></i> Hubungi Pengelola
                </button>
            </div>
        </div>

    </div>
    <?php endforeach; ?>
</section>

<!-- Inquire pop-up controller -->
<div id="inquireModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 overflow-y-auto">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden glass-card">
        
        <div class="p-5.5 bg-primary text-white flex justify-between items-center">
            <div class="text-left">
                <h4 class="font-display font-bold text-base">Inquiry &amp; Kerjasama BUMDES</h4>
                <p id="inquireModalItemTitle" class="text-xs text-white/80 mt-0.5">Nama Potensi</p>
            </div>
            <button onclick="toggleModal('inquireModal', false)" class="p-1 rounded-full hover:bg-white/10 transition-colors">
                <i class="w-5 h-5 text-white" data-lucide="x"></i>
            </button>
        </div>

        <form action="submit-potential.php" method="POST" class="p-6 space-y-4 text-left">
            <input type="hidden" name="item_id" id="inquireItemIdField" value="">
            <input type="hidden" name="item_title" id="inquireItemTitleField" value="">

            <div class="bg-primary-bg p-4 rounded-xl border border-primary/5 space-y-2.5 text-xs text-emerald-950">
                <p class="font-bold font-display uppercase tracking-widest text-[10px] text-primary">Rincian Pengelola &amp; Perizinan</p>
                <div class="flex justify-between"><span class="text-gray-400">Instansi Pengelola:</span> <span id="inquireDetailPengelola" class="font-semibold text-right max-w-[200px]">-</span></div>
                <div class="flex justify-between"><span class="text-gray-400">Kontak Dinas:</span> <span id="inquireDetailKontak" class="font-mono font-semibold">-</span></div>
                <div class="flex justify-between border-t border-gray-100 pt-2"><span class="text-gray-400">Jenis Layanan Komersial:</span> <span id="inquireDetailPrice" class="font-bold text-emerald-800 text-right max-w-[200px] font-display">-</span></div>
            </div>

            <div class="space-y-3.5 pt-2">
                <h5 class="text-xs font-bold text-gray-500 uppercase tracking-widest font-display">Isi Formulir Minat / Pesanan</h5>
                
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Nama Lengkap Pemohon / Institusi *</label>
                    <input 
                        type="text" 
                        name="buyer_name" 
                        required 
                        placeholder="Contoh: Budi Santoso atau Instansi Koperasi" 
                        class="w-full px-3 py-2 border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm rounded-lg transition-colors"
                    />
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 uppercase mb-1">Nomor Telepon Dinas / WhatsApp Aktif *</label>
                    <input 
                        type="tel" 
                        name="buyer_phone" 
                        required 
                        placeholder="Contoh: +62 812-4433-2211" 
                        class="w-full px-3 py-2 border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm rounded-lg transition-colors"
                    />
                </div>

                <div class="p-3 bg-yellow-50 rounded-lg text-[10px] leading-relaxed border border-yellow-105 flex gap-2">
                    <i class="w-4 h-4 text-yellow-600 flex-shrink-0" data-lucide="info"></i>
                    <p>Setelah mengirimkan inquiry ini, data Anda akan diverifikasi oleh unit BUMDES terkait dalam waktu kurang dari 24 jam guna penyusunan jadwal pembicaraan lanjutan.</p>
                </div>
            </div>

            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-3 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-md transition-colors font-display"
                >
                    Kirim Formulir Sinergi Kemitraan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    const potentialArray = <?php echo json_encode($potentialItems); ?>;

    function openInquireModal(id) {
        const item = potentialArray.find(x => x.id === id);
        if (!item) return;

        document.getElementById('inquireModalItemTitle').innerText = item.title;
        document.getElementById('inquireItemIdField').value = item.id;
        document.getElementById('inquireItemTitleField').value = item.title;
        document.getElementById('inquireDetailPengelola').innerText = item.pengelola;
        document.getElementById('inquireDetailKontak').innerText = item.kontak;
        document.getElementById('inquireDetailPrice').innerText = item.price_detail;

        toggleModal('inquireModal', true);
    }
</script>
