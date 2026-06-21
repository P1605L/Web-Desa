<?php
// PHP Version: Services Tab Layout & Tracking System Component
// Integrates full search filtering, category tabs, and real database tracking engine

// 1. Handle tracking inquiries from forms
$trackedRecord = null;
$trackError = '';
$trackCodeInput = isset($_GET['track_code']) ? sanitizeInput($_GET['track_code']) : '';

if (!empty($trackCodeInput)) {
    if (isset($pdo)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM submissions WHERE tracking_id = :tracking_id LIMIT 1");
            $stmt->execute(['tracking_id' => $trackCodeInput]);
            $trackedRecord = $stmt->fetch();
            if (!$trackedRecord) {
                // Check offline session as fallback
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['submissions'])) {
                    foreach ($_SESSION['submissions'] as $sub) {
                        if (strtoupper($sub['tracking_id']) === strtoupper($trackCodeInput)) {
                            $trackedRecord = $sub;
                            break;
                        }
                    }
                }
            }
            if (!$trackedRecord) {
                $trackError = 'Maaf, Kode Pelacakan tersebut tidak ditemukan dalam sistem database desa kami. Periksa ejaan atau perbaiki kode Anda.';
            }
        } catch (\Exception $e) {
            $trackError = 'Sistem database sibuk: ' . $e->getMessage();
        }
    } else {
        // Fallback: search in session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['submissions'])) {
            foreach ($_SESSION['submissions'] as $sub) {
                if (strtoupper($sub['tracking_id']) === strtoupper($trackCodeInput)) {
                    $trackedRecord = $sub;
                    break;
                }
            }
        }
        // If not found in mock session list either, use pre-seeded mocks
        if (!$trackedRecord) {
            $mockSubmissions = [
                'WD-SERVICES-8321' => [
                    'service_name' => 'Penerbitan KTP & Kartu Keluarga Baru',
                    'nik' => '3275010203040001',
                    'name' => 'Andi Saputra',
                    'date_submitted' => '12 Juni 2026',
                    'status' => 'Selesai',
                    'notes' => 'Kartu Keluarga dan KTP fisik Anda telah selesai dicetak. Silakan ambil di Loket 3 Pelayanan Balai Desa pada jam kerja dengan membawa dokumen lama.'
                ],
                'WD-SERVICES-2941' => [
                    'service_name' => 'Registrasi Akta Kelahiran Baru',
                    'nik' => '3275010203040002',
                    'name' => 'Bambang Wijaya',
                    'date_submitted' => '14 Juni 2026',
                    'status' => 'Verifikasi',
                    'notes' => 'Petugas sedang memverifikasi scan buku nikah asli orang tua. Mohon pastikan scan berkas tidak buram / terpotong.'
                ],
                'WD-SERVICES-5730' => [
                    'service_name' => 'Permohonan Bantuan Sosial Mandiri',
                    'nik' => '3275010203040003',
                    'name' => 'Siti Rahmawati',
                    'date_submitted' => '16 Juni 2026',
                    'status' => 'Diajukan',
                    'notes' => 'Berkas Anda telah berhasil diterima oleh sistem digital. Tim Satgas Sosial Desa sedang menjadwalkan survey verifikasi faktual lapangan.'
                ]
            ];
            
            $upperCode = strtoupper($trackCodeInput);
            if (isset($mockSubmissions[$upperCode])) {
                $trackedRecord = $mockSubmissions[$upperCode];
            } else {
                $trackError = 'Maaf, Kode Pelacakan tersebut tidak ditemukan dalam database simulasi.';
            }
        }
    }
}

// 2. Fetch Services Catalog
$servicesList = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
        while ($row = $stmt->fetch()) {
            $row['requirements'] = json_decode($row['requirements'], true);
            $servicesList[] = $row;
        }
    } catch (\Exception $e) {
        // Fallback handled below
    }
}

// Fallback services list if database is offline or empty
if (empty($servicesList)) {
    $servicesList = [
        [
            'id' => 'srv-1',
            'title' => 'Penerbitan KTP & Kartu Keluarga Baru',
            'category' => 'kependudukan',
            'description' => 'Pengurusan berkas pencatatan sipil perpindahan domisili, pembuatan KTP baru usia 17 tahun, serta pemecahan kartu keluarga mandiri.',
            'duration' => '2 - 3 Hari Kerja',
            'cost' => 'Gratis (Bebas Biaya)',
            'icon_name' => 'IdCard',
            'image_url' => 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?q=80&w=700&auto=format&fit=crop',
            'requirements' => ['Isi formulir pendaftaran digital pengajuan sipil', 'Unggah scan KTP asli', 'Fotokopi Kartu Keluarga lama', 'Surat Pengantar RT/RW']
        ],
        [
            'id' => 'srv-2',
            'title' => 'Surat Keterangan Pengantar RT / RW',
            'category' => 'izin',
            'description' => 'Penerbitan surat pengantar umum guna peruntukan pengurusan pernikahan, pembuatan SKCK, surat keterangan usaha, ataupun ijin domisili sementara.',
            'duration' => '1 Jam (Instan)',
            'cost' => 'Gratis (Bebas Biaya)',
            'icon_name' => 'FileText',
            'image_url' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=700&auto=format&fit=crop',
            'requirements' => ['NIK terdaftar valid di basis data desa', 'Scan asli KTP pemohon', 'Deskripsi jelas maksud pengajuan']
        ],
        [
            'id' => 'srv-3',
            'title' => 'Registrasi Akta Kelahiran Baru',
            'category' => 'kependudukan',
            'description' => 'Pelaporan kelahiran bayi dusun desa untuk diterbitkan dokumen pencatatan kutipan akta kelahiran resmi Kementerian Dalam Negeri.',
            'duration' => '3 - 5 Hari Kerja',
            'cost' => 'Gratis (Bebas Biaya)',
            'icon_name' => 'Baby',
            'image_url' => 'https://images.unsplash.com/photo-1519689680058-324335c77ebe?q=80&w=700&auto=format&fit=crop',
            'requirements' => ['Surat kelahiran asli Bidan/RS', 'Kutipan nikah orang tua', 'Scan KTP saksi-saksi', 'KK asli orang tua']
        ],
        [
            'id' => 'srv-4',
            'title' => 'Permohonan Bantuan Sosial Mandiri',
            'category' => 'sosial',
            'description' => 'Pengajuan data warga kurang mampu berhak menerima jatah beras raskin, subsidi listrik desa, bantuan langsung tunai (BLT), serta program KIP desa.',
            'duration' => '7 Hari Kerja Verifikasi',
            'cost' => 'Gratis (Bebas Biaya)',
            'icon_name' => 'Gift',
            'image_url' => 'https://images.unsplash.com/photo-1469571486040-0b3b27573b7f?q=80&w=700&auto=format&fit=crop',
            'requirements' => ['Surat Keterangan Tidak Mampu', 'Foto fisik rumah depan & ruang tamu', 'KTP & KK pemohon', 'Slip gaji / keterangan penghasilan']
        ],
        [
            'id' => 'srv-5',
            'title' => 'Izin Domisili Usaha Mikro & Niaga',
            'category' => 'izin',
            'description' => 'Penerbitan surat keterangan domisili usaha legalitas tingkat kelurahan/desa bagi pedagang mikro, UMKM industri rumahan, atau peternakan mandiri.',
            'duration' => '1 - 2 Hari Kerja',
            'cost' => 'Gratis (Bebas Biaya)',
            'icon_name' => 'Building2',
            'image_url' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=700&auto=format&fit=crop',
            'requirements' => ['Scan KTP penanggung jawab', 'Foto fisik lokasi usaha', 'Persetujuan tertulis tetangga', 'Bukti sewa/peta lahan']
        ]
    ];
}

// 3. Filter list dynamically
$selectedCategory = isset($_GET['cat']) ? sanitizeInput($_GET['cat']) : 'all';
$searchQuery = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

$filteredServices = [];
foreach ($servicesList as $srv) {
    // Filter Category
    if ($selectedCategory !== 'all' && $srv['category'] !== $selectedCategory) {
        continue;
    }
    // Filter Search Text
    if (!empty($searchQuery)) {
        if (stripos($srv['title'], $searchQuery) === false && stripos($srv['description'], $searchQuery) === false) {
            continue;
        }
    }
    $filteredServices[] = $srv;
}
?>

<!-- BANNER SUCCESS INJEKSI -->
<?php if (isset($_GET['submission_status']) && $_GET['submission_status'] === 'success'): ?>
    <div class="mb-10 text-left p-6 bg-emerald-50 border-l-4 border-emerald-600 rounded-xl max-w-4xl mx-auto flex gap-4 items-start shadow-sm animate-fade-in">
        <div class="p-2 bg-emerald-100 text-emerald-800 rounded-full">
            <i class="w-6 h-6" data-lucide="check"></i>
        </div>
        <div>
            <h3 class="font-display font-bold text-emerald-950 text-base">Pengajuan Administrasi Berhasil</h3>
            <p class="text-xs text-emerald-800 leading-relaxed mt-0.5">Kami telah menerima berkas pengajuan Anda ke sistem database kelurahan. Harap simpan Kode Pelacakan (Tracking Code) untuk memantau kelayakan berkas Anda:</p>
            <div class="mt-3 p-3 bg-white font-mono text-base font-bold text-primary max-w-sm rounded-lg border border-emerald-100/50 flex justify-between items-center">
                <span><?php echo htmlspecialchars($_GET['code']); ?></span>
                <a href="index.php?page=services&track_code=<?php echo htmlspecialchars($_GET['code']); ?>#tracker-section" class="text-xs bg-primary text-white hover:opacity-90 px-3 py-1 rounded">Lacak Sekarang</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- 1. Tracking Engine UI -->
<section id="tracker-section" class="mb-20">
    <div class="max-w-2xl mx-auto bg-emerald-950 rounded-2xl overflow-hidden shadow-xl text-white relative">
        <div class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-emerald-900/50 to-transparent"></div>
        
        <div class="relative z-10 p-8 text-center space-y-6">
            <div class="w-12 h-12 rounded-full bg-[#ffdf41]/10 text-[#ffdf41] flex items-center justify-center mx-auto">
                <i class="w-6 h-6" data-lucide="search-code"></i>
            </div>
            
            <div class="space-y-1.5">
                <h3 class="font-display text-xl sm:text-2xl font-extrabold">Informasi Real-Time Status Pengujian</h3>
                <p class="text-xs text-emerald-200">Masukkan kode lacak pengajuan dari kwitansi digital untuk mengetahui kesiapan berkas Anda.</p>
            </div>

            <!-- Form Tracker input -->
            <form method="GET" action="index.php" class="flex gap-2 max-w-md mx-auto relative bg-white/10 p-1.5 rounded-full border border-white/10">
                <input type="hidden" name="page" value="services">
                <input 
                    type="text" 
                    name="track_code"
                    value="<?php echo htmlspecialchars($trackCodeInput); ?>"
                    required
                    placeholder="Contoh: WD-SERVICES-2941" 
                    class="flex-grow bg-transparent border-0 px-4 text-xs font-mono font-bold text-white placeholder-emerald-150 py-3 focus:outline-none focus:ring-0"
                />
                
                <button 
                    type="submit"
                    class="bg-[#ffdf41] text-emerald-950 hover:bg-white text-xs font-bold px-6 py-3 rounded-full uppercase tracking-wider transition-all shadow font-display shrink-0"
                >
                    Lacak Berkas
                </button>
            </form>

            <!-- Results Output -->
            <?php if (!empty($trackError)): ?>
                <div class="p-4 bg-red-900/55 rounded-xl border border-red-700/50 text-left text-xs text-red-100/90 leading-relaxed flex gap-2">
                    <i class="w-5 h-5 text-red-300" data-lucide="shield-alert"></i>
                    <p><?php echo $trackError; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($trackedRecord): ?>
                <div class="bg-white text-gray-900 p-6 rounded-xl text-left border border-white/20 shadow-lg space-y-6 animate-fade-in-up mt-8">
                    <!-- Headings -->
                    <div class="flex justify-between items-start flex-wrap gap-2 border-b border-gray-100 pb-4">
                        <div>
                            <span class="text-[9px] font-bold text-[#795900] uppercase tracking-widest font-display">Status Layanan Digital</span>
                            <h4 class="font-display font-black text-gray-900 text-sm sm:text-base leading-tight mt-0.5"><?php echo $trackedRecord['service_name']; ?></h4>
                            <p class="text-[10px] text-gray-400 mt-1">Diajukan Tanggal: <span class="font-bold text-gray-700"><?php echo isset($trackedRecord['date_submitted']) ? $trackedRecord['date_submitted'] : '-'; ?></span></p>
                        </div>

                        <!-- Badge -->
                        <?php 
                        $stat = isset($trackedRecord['status']) ? $trackedRecord['status'] : 'Diajukan'; 
                        if ($stat === 'Selesai'): ?>
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 font-bold rounded-lg text-xs border border-emerald-200">✓ Selesai Cetak</span>
                        <?php elseif ($stat === 'Verifikasi'): ?>
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 font-bold rounded-lg text-xs border border-blue-200">🔍 Verifikasi Petugas</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-orange-50 text-orange-600 font-bold rounded-lg text-xs border border-orange-200">⏳ Menunggu Antrean</span>
                        <?php endif; ?>
                    </div>

                    <!-- Steps Timeline horizontal -->
                    <div class="grid grid-cols-4 gap-2 items-center text-center">
                        <?php 
                        $stages = ['Draft', 'Diajukan', 'Verifikasi', 'Selesai'];
                        $activeIndex = array_search($stat, $stages);
                        if ($activeIndex === false) $activeIndex = 1; // default to diajukan

                        foreach ($stages as $idx => $stg):
                        ?>
                            <div class="space-y-1.5 flex flex-col items-center">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold <?php echo ($idx <= $activeIndex) ? 'bg-primary text-white' : 'bg-gray-100 text-gray-400'; ?>">
                                    <?php if ($idx < $activeIndex): ?>
                                        ✓
                                    <?php else: ?>
                                        <?php echo $idx + 1; ?>
                                    <?php endif; ?>
                                </div>
                                <p class="text-[10px] font-bold <?php echo ($idx <= $activeIndex) ? 'text-primary' : 'text-gray-400'; ?>"><?php echo $stg; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Response Note official -->
                    <div class="bg-gray-50 border border-gray-100 p-4 rounded-xl space-y-1.5">
                        <div class="flex items-center gap-1.5 border-b border-gray-100 pb-1.5">
                            <i class="w-4 h-4 text-primary" data-lucide="info"></i>
                            <span class="text-[10px] font-bold text-emerald-900 uppercase tracking-widest font-display">Catatan Peninjau Balai Desa</span>
                        </div>
                        <p class="text-xs text-gray-650 leading-relaxed font-sans italic"><?php echo $trackedRecord['notes']; ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- 2. Services List Header Catalog -->
<section>
    <div class="text-center max-w-xl mx-auto space-y-3 mb-12">
         <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display block">Satu Tempat, Sejuta Solusi Berkas</span>
         <h2 class="font-display text-3xl font-extrabold text-[#111]">Katalog Pengurusan Surat Kelurahan</h2>
         <p class="text-xs sm:text-sm text-gray-500">Pilih salah satu layanan administrasi di bawah ini untuk memulai pengurusan secara paperless (tanpa kertas) lewat form interaktif.</p>
    </div>

    <!-- Filter Buttons layout -->
    <div class="flex flex-wrap gap-2 justify-center mb-10 text-xs font-semibold">
        <a 
            href="index.php?page=services&cat=all#tracker-section" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'all') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50'; ?>"
        >
            🗂️ Semua Layanan
        </a>
        <a 
            href="index.php?page=services&cat=kependudukan#tracker-section" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'kependudukan') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50'; ?>"
        >
            👤 Kependudukan (KTP &amp; KK)
        </a>
        <a 
            href="index.php?page=services&cat=izin#tracker-section" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'izin') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50'; ?>"
        >
            🔑 Izin &amp; Pengantar
        </a>
        <a 
            href="index.php?page=services&cat=sosial#tracker-section" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'sosial') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50'; ?>"
        >
            🤝 Bantuan Sosial
        </a>
    </div>

    <!-- Grid List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($filteredServices as $service): ?>
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-transform hover:-translate-y-1 duration-300 flex flex-col h-full text-left">
            <div class="aspect-[16/10] relative w-full overflow-hidden bg-gray-100 shrink-0">
                <img 
                    src="<?php echo $service['image_url']; ?>" 
                    alt="<?php echo $service['title']; ?>" 
                    class="w-full h-full object-cover select-none"
                    referrerpolicy="no-referrer"
                />
                
                <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/95 text-emerald-800 text-[10px] font-bold shadow font-display uppercase tracking-wider">
                    <?php echo $service['category'] === 'kependudukan' ? '👤 Kependudukan' : ($service['category'] === 'izin' ? '🔑 Pengantar' : '🤝 Sosial'); ?>
                </span>
            </div>

            <!-- Content -->
            <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <h3 class="font-display font-extrabold text-blue-950 text-base leading-snug"><?php echo $service['title']; ?></h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-sans"><?php echo $service['description']; ?></p>
                </div>

                <div class="border-t border-gray-100 pt-4 space-y-3">
                    <div class="flex items-center justify-between text-[11px] text-gray-400">
                        <span class="flex items-center gap-1"><i class="w-3.5 h-3.5 text-gray-400" data-lucide="clock"></i> <?php echo $service['duration']; ?></span>
                        <span class="flex items-center gap-1 font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded"><?php echo $service['cost']; ?></span>
                    </div>

                    <!-- Trigger Button -->
                    <button 
                        onclick="openSubmissionModal('<?php echo $service['id']; ?>')"
                        class="w-full py-3 bg-[#e8efe7] text-primary hover:bg-primary hover:text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all font-display text-center flex items-center justify-center gap-1 border border-primary/5 cursor-pointer"
                    >
                        Ajukan Sekarang <i class="w-3.5 h-3.5" data-lucide="arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
