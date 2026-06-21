<?php
// PHP Version: News Tab Content & Logic Component
// Pulls local village news updates from DB with fallback static details and search filters

// 1. Fetch News
$newsList = [];
if (isset($pdo)) {
    try {
        $stmt = $pdo->query("SELECT * FROM news ORDER BY id DESC");
        while ($row = $stmt->fetch()) {
             $newsList[] = $row;
        }
    } catch (\Exception $e) {
        // Fallback handled below
    }
}

// Fallback news list if database is empty or offline
if (empty($newsList)) {
    $newsList = [
        [
            'id' => 'news-1',
            'title' => 'Pembangunan Jalan Rabat Beton Dusun Makmur Selesai',
            'category' => 'Pembangunan',
            'date' => '15 Juni 2026',
            'excerpt' => 'Peningkatkan infrastruktur jalan penghubung pertanian rampung seratus persen demi kelancaran distribusi hasil panen gogo sawah organik warga.',
            'content' => "Pemerintah Desa secara resmi mengumumkan selesainya pembangunan jalan semen rabat beton di Dusun Makmur RT 02/RW 04 sepanjang 450 meter dengan lebar 3 meter. Proyek ini didanai sepenuhnya melalui alokasi Dana Desa (DD) anggaran tahun 2026 tahap I.\r\n\r\nKepala urusan perencanaan pembangunan desa, Budi Santoso, S.T., menyampaikan bahwa jalan pertanian ini memiliki peranan vital sebagai urat nadi penyaluran hasil agro tani warga desa seperti padi gogo sawah organik, kelapa genjah, kopi arabika, dan palawija rakyat.\r\n\r\n\"Sebelumnya jalan ini berlubang berbatu-batu liat licin apabila turun hujan, yang seringkali menghambat laju gerobak motor roda tiga pengangkut padi petani. Berkat dedikasi gotong royong warga selama 14 hari penuh, kini pengerjaan rabat beton selesai 3 hari lebih cepat dari tenggat perkiraan semula,\" ungkap Budi Santoso saat peresmian jalan desa bersama tokoh adat dusun.",
            'image_url' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=700&auto=format&fit=crop',
            'author' => 'Budi Santoso (Kaur Pembangunan)',
            'reads' => 247
        ],
        [
            'id' => 'news-2',
            'title' => 'Festival Bersih Desa & Kenduri Panen Raya Berlangsung Khidmat',
            'category' => 'Kegiatan',
            'date' => '10 Juni 2026',
            'excerpt' => 'Masyarakat menggelorakan doa syukur keselamatan agraris dan pagelaran tari adat tradisional srigading di pendopo agung balai desa.',
            'content' => "Sebagai wujud rasa syukur mendalam atas melimpahnya hasil panen padi sawah gogo organik, masyarakat menyelenggarakan pagelaran upacara adat 'Kenduri Bersih Desa' yang berlangsung meriah di pelataran terbuka Balai Desa.\r\n\r\nAcara tahunan luhur ini diawali pengerakan gunungan raksasa hasil pertanian buah jeruk gogo madu, buah alpukat segar, singkong keladi, dan tumpeng nasi gurih setinggi dua meter. Gunungan tersebut kemudian didoakan bersama oleh seluruh ketua keagamaan adat dusun demi keberkahan setahun mendatang.\r\n\r\nSekretaris desa, Siti Aminah, menerangkan bahwa upacara Bersih Desa bukan sekadar pelestarian adat kuno, melainkan perekat silaturahmi sosial persatuan warga antar dusun. Festival ditutup dengan pementasan seni tari srigading kolosal yang dibawakan secara apik oleh 30 pemudi karang taruna.",
            'image_url' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?q=80&w=700&auto=format&fit=crop',
            'author' => 'Siti Aminah (Sekretaris Desa)',
            'reads' => 382
        ],
        [
            'id' => 'news-3',
            'title' => 'Pengumuman Penyaluran Bantuan Langsung Tunai (BLT) Desa Tahap III',
            'category' => 'Pengumuman',
            'date' => '05 Juni 2026',
            'excerpt' => 'Sebanyak 120 kepala keluarga wajib penerima manfaat dijadwalkan berkumpul di aula pendopo desa membawa persayaratan fotokopi KK.',
            'content' => "Pemerintah desa melalui bendahara keuangan desa mengundang secara resmi warga Keluarga Penerima Manfaat (KPM) untuk mengantre tertib pencairan Bantuan Langsung Tunai (BLT) Dana Desa Triwulan Kedua untuk bulan April, Mei, dan Juni 2026.\r\n\r\nPembagian bantuan uang tunai senilai Rp 900.000,- per kepala keluarga akan disalurkan pada hari Kamis, 18 Juni 2026 di Pendopo Aula Desa Sukamaju mulai pukul 08.00 WIB s/d selesai.\r\n\r\nSyarat mutlak pengambilan bantuan tunai warga:\r\n1. Membawa undangan berkas fisik resmi berstempel basah kelurahan.\r\n2. Membawa Kartu Keluarga (KK) asli dan Kartu Tanda Penduduk (KTP) asli pemohon.\r\n3. Diwakilkan hanya boleh dalam 1 silsilah Kartu Keluarga yang sama disertai Surat Kuasa bermeterai asli apabila pemohon sakit/lansia lumpuh.",
            'image_url' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?q=80&w=700&auto=format&fit=crop',
            'author' => 'Rahmat Hidayat (Bendahara Desa)',
            'reads' => 412
        ],
        [
            'id' => 'news-4',
            'title' => 'WebDesa Dianugerahi Penghargaan Desa Digital Transparan Terbaik',
            'category' => 'Prestasi',
            'date' => '28 Mei 2026',
            'excerpt' => 'Sistem portal resmi desa meraih standarisasi transparansi piala emas dari Kementerian Komunikasi pedesaan mandiri.',
            'content' => "Desa kami kembali mengukir prestasi emas membanggakan di kancah nasional. Situs web portal resmi pelayanan digital desa kami resmi diganjar penghargaan prestisius 'Piala Emas Desa Digital Mandiri Transparan 2026' dari Kementerian Komunikasi dan Informasi pembangunan pedesaan.\r\n\r\nPenghargaan diserahkan langsung oleh Menteri Komunikasi dalam rapat rapat piala nasional di ibu kota kepada Kepala Desa, Ir. H. Ahmad Fauzi. Penilaian didasarkan atas efektivitas kemudahan warga melacak dokumen secara mandiri, sistem pengaduan E-Sambat yang selesai cepat di bawah 24 jam, serta keterbukaan neraca diagram rincian anggaran dana APBDesa secara online.\r\n\r\n\"Piala kebanggaan ini kami persembahkan sepenuhnya untuk warga desa tercinta yang terus berupaya cerdas dan adaptif menyambut era transformasi kebangkitan digital terpadu pedesaan,\" ujar Ahmad Fauzi dalam pidato sambutannya.",
            'image_url' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=700&auto=format&fit=crop',
            'author' => 'Ir. H. Ahmad Fauzi (Kades)',
            'reads' => 198
        ]
    ];
}

// 2. Filter list dynamically
$selectedCategory = isset($_GET['cat']) ? sanitizeInput($_GET['cat']) : 'all';
$searchQuery = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

$filteredNews = [];
foreach ($newsList as $article) {
    if ($selectedCategory !== 'all' && stripos($article['category'], $selectedCategory) === false) {
        continue;
    }
    if (!empty($searchQuery)) {
        if (stripos($article['title'], $searchQuery) === false && stripos($article['excerpt'], $searchQuery) === false) {
            continue;
        }
    }
    $filteredNews[] = $article;
}
?>

<!-- Section Headings -->
<section class="mb-12">
    <div class="text-center max-w-xl mx-auto space-y-3">
         <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display block">Kilas Kabar &amp; Wawasan Terkini</span>
         <h2 class="font-display text-3xl font-extrabold text-[#111]">Warta &amp; Pengumuman Desa</h2>
         <p class="text-xs sm:text-sm text-gray-500">Membaca pembaruan kemajuan pembangunan jalan dusun, jadwal festival ritual adat bersih desa, serta pengumuman alur bansos tunai.</p>
    </div>

    <!-- Category Filters Navigation -->
    <div class="flex flex-wrap gap-2 justify-center mt-10 text-xs font-semibold">
        <a 
            href="index.php?page=news&cat=all" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'all') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            📣 Semua Kabar
        </a>
        <a 
            href="index.php?page=news&cat=pembangunan" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'pembangunan') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            🧱 Pembangunan
        </a>
        <a 
            href="index.php?page=news&cat=kegiatan" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'kegiatan') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            🎪 Kegiatan Adat
        </a>
        <a 
            href="index.php?page=news&cat=pengumuman" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'pengumuman') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            📋 Pengumuman
        </a>
        <a 
            href="index.php?page=news&cat=prestasi" 
            class="px-4 py-2.5 rounded-full border transition-all <?php echo ($selectedCategory === 'prestasi') ? 'bg-primary text-white border-transparent' : 'bg-white border-gray-200 text-gray-650 hover:bg-gray-50'; ?>"
        >
            🏆 Prestasi Desa
        </a>
    </div>
</section>

<!-- Content Grid list -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php foreach ($filteredNews as $article): ?>
    <div 
        onclick="openNewsModal('<?php echo $article['id']; ?>')"
        class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-350 cursor-pointer flex flex-col md:flex-row text-left group"
    >
        <!-- Image Left/Full -->
        <div class="aspect-[16/10] md:w-52 h-48 md:h-full relative overflow-hidden bg-gray-150 shrink-0">
            <img 
                src="<?php echo $article['image_url']; ?>" 
                alt="<?php echo $article['title']; ?>" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
            
            <span class="absolute top-4 left-4 inline-flex px-2.5 py-1 rounded bg-white text-emerald-800 text-[10px] font-extrabold uppercase font-display select-none">
                <?php echo $article['category']; ?>
            </span>
        </div>

        <!-- Text Right -->
        <div class="p-6 flex-grow flex flex-col justify-between space-y-3">
            <div class="space-y-1.5">
                <span class="text-[10px] text-gray-400 font-bold"><?php echo $article['date']; ?></span>
                <h3 class="font-display font-extrabold text-[#111] text-base leading-snug group-hover:text-primary transition-colors"><?php echo $article['title']; ?></h3>
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2"><?php echo $article['excerpt']; ?></p>
            </div>

            <div class="flex justify-between items-center text-[10px] text-gray-400 font-semibold border-t border-gray-100 pt-3">
                 <span>Penulis: <strong class="text-gray-700"><?php echo $article['author']; ?></strong></span>
                 <span class="flex items-center gap-1"><i class="w-3.5 h-3.5" data-lucide="eye"></i> <?php echo $article['reads']; ?> Dibaca</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<!-- Dynamic Article view details modal -->
<div id="newsModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/65 overflow-y-auto">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card">
        
        <!-- Feature image banner -->
        <div class="h-60 relative w-full overflow-hidden bg-gray-100">
            <img id="newsModalImg" src="" alt="" class="w-full h-full object-cover select-none" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
            
            <button 
                onclick="toggleModal('newsModal', false)"
                class="absolute top-4 right-4 p-1.5 rounded-full bg-black/40 hover:bg-black/60 text-white transition-colors"
            >
                <i class="w-5 h-5 text-white" data-lucide="x"></i>
            </button>

            <!-- Categorization -->
            <span id="newsModalCategory" class="absolute bottom-4 left-6 px-3 py-1 bg-primary text-white rounded font-display font-bold text-xs uppercase tracking-wider">
                Pengumuman
            </span>
        </div>

        <div class="p-6 sm:p-8 space-y-5 text-left max-h-[50vh] overflow-y-auto">
            <p id="newsModalDate" class="text-xs font-bold text-gray-400">12 Juni 2026</p>
            <h3 id="newsModalTitle" class="font-display font-black text-[#1a2e1d] text-lg sm:text-2xl leading-tight">Judul Berita</h3>

            <!-- Author & views -->
            <div class="flex justify-between items-center text-xs text-gray-400 border-y border-gray-100 py-3">
                <span>Ditulis: <strong id="newsModalAuthor" class="text-gray-700">-</strong></span>
                <span id="newsModalReads" class="font-bold flex items-center gap-1"><i class="w-4 h-4" data-lucide="eye"></i> - Dibaca</span>
            </div>

            <!-- Content body -->
            <p id="newsModalContent" class="text-xs sm:text-sm text-gray-600 leading-relaxed font-sans whitespace-pre-line">
                 Konten lengkap
            </p>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end">
            <button onclick="toggleModal('newsModal', false)" class="px-5 py-2.5 bg-gray-800 text-white hover:bg-gray-900 font-bold text-xs rounded-xl transition-colors font-display">
                Tutup Bacaan
            </button>
        </div>

    </div>
</div>

<script>
    const newsArray = <?php echo json_encode($newsList); ?>;

    function openNewsModal(id) {
        const article = newsArray.find(x => x.id === id);
        if (!article) return;

        document.getElementById('newsModalImg').src = article.image_url;
        document.getElementById('newsModalCategory').innerText = article.category;
        document.getElementById('newsModalDate').innerText = article.date;
        document.getElementById('newsModalTitle').innerText = article.title;
        document.getElementById('newsModalAuthor').innerText = article.author;
        document.getElementById('newsModalReads').innerText = "✓ " + article.reads + " Dibaca";
        document.getElementById('newsModalContent').innerText = article.content;

        toggleModal('newsModal', true);
    }
</script>
