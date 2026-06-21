-- Database: `webdesa_sukamaju`
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `webdesa_sukamaju` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `webdesa_sukamaju`;

-- --------------------------------------------------------
-- Table structure for table `staff`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `detail_role` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `duties` text NOT NULL, -- JSON-formatted list of duties
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `staff`
INSERT INTO `staff` (`id`, `name`, `role`, `detail_role`, `image_url`, `phone`, `email`, `bio`, `duties`) VALUES
(1, 'Ir. H. Ahmad Fauzi', 'Kepala Desa', 'Pimpinan Tertinggi Desa', 'https://lh3.googleusercontent.com/aida-public/AB6AXuALY1rhacXYRMqFmHMMTqV1F9amgBTviCav8bJfRDBIGWBeMdbF0XyC99s7B1b0Doi_zz3Obh3kU9ZS4VaSkPD9uZkO8UTWt5DBOqfR5hqCqRdTe-sFVIKbmwHKz49Yd2puwzjXn7tiKOkBzSxNq6BpGM3huUhcAASw8eCi4sZ9exnWPEQM3A2O3xBtiFCv0dNN8oeqp0UKLJKzauy873yDJERBKhZWcNZYWtjRSJj9-uSA33H-L6kIyo1n_QWyzT7OmA25W_NPBlY', '+62 811-4433-221', 'ahmadfauzi@webdesa.go.id', 'Lahir di Sukamaju, mengabdi selama lebih dari 15 tahun di bidang tata pamong desa. Lulusan Teknik Sipil Institut Teknologi dengan fokus pembangunan infrastruktur pedesaan ramah lingkungan.', '["Memimpin penyelenggaraan pemerintahan desa berdasarkan kebijakan yang ditetapkan bersama BPD.", "Mengajukan rancangan peraturan desa menetapkan APBDesa.", "Membina ketentraman dan ketertiban masyarakat desa."]'),
(2, 'Siti Aminah, S.E.', 'Sekretaris Desa', 'Kepala Sekretariat & Administrasi Umum', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDUETgEGPI_HAkJ8-UkUUFUU8OK0Ir3iSy58vJsjacBCVSHkwDIiMVeyxRMRKEX8-cwiM3pBRPJFsFFBQxJhL6QpnfI0cVLJzvmUtjSRQLHbAnu9xBHOR1ypSlAhv3PtNHaR0_AK-AEs4gO2yV106map7BL-22Seabv9SndhIhI2zMKQ6IFarv36eaMrtnQMTFoR_8Mptyu3re-59jBukgTAQSb9Pggp7TzYxwmAayNxixOYVHfq6fW4pZmp8t85ahm9qky52ytnsE', '+62 812-5566-778', 'sitiaminah@webdesa.go.id', 'Ahli administrasi keuangan publik daerah, berpengalaman menyusun Laporan Penyelenggaraan Pemerintahan Desa (LPPD) berstandar nasional.', '["Mengoordinasikan tugas-tugas kepala seksi pembinaan administrasi.", "Menyusun draf peraturan desa serta mengelola arsip desa.", "Mempersiapkan rapat-rapat kerja koordinasi aparat desa."]'),
(3, 'Rahmat Hidayat', 'Bendahara Desa', 'Kepala Urusan Keuangan', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCI3XpHDI-msIS1rD52uvXzmeWAJFBhAlScxg5E72Wr6jW7lgjpj5jAcsdCt-SiKBayJggnkWKLuxCGka0t3AMa0vPlInMOmoBkS8jgWI53MveGzM0gbzD-bBO0KyDfi-5T92qXoAro984EwdEL9F-folLKIReB3ITtHDpkCeeEvBBtFfdO1vR4b6eWxpKN6YAgaJm89oaGil1yLrHxBTB9hMf9NOrgxjIxWZ1c_KPAQym2GLBCEh1KgP8YYQoxwCCO9e_uqUwVhT0', '+62 813-8877-665', 'rahmathidayat@webdesa.go.id', 'Mengelola anggaran pendapatan dan belanja desa (APBDes) secara transparan. Terkenal jujur dan tegas dalam audit keuangan warga.', '["Menerima, menyimpan, menyetorkan, serta membayarkan dana desa.", "Menyelenggarakan pembukuan keuangan kas desa secara periodik.", "Melaporkan realisasi penyerapan dana pajak & bantuan pemerintah."]'),
(4, 'Budi Santoso, S.T.', 'Kaur Perencanaan', 'Kepala Urusan Perencanaan Pembangunan', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDHXLEHAFaVz6IRJQLxcNGttoK5JimoDXIrt_TGek6HI0O4W-ZDq_EzvGWAYS-4e8NDplgUy4ituS-UBSqkQZsM0cCQoYtrgt_XsNYA3KJjhyBuEixI9WzhQdM1fQUEuC1CWek19yXUtUmNEGw_rMs9ASypCYfmxjuoYFNR9Ier22PJZdypMSy7TYhMX9sZBqKVRHMIiJuV_rUGNXKTpA0-tZQFBnekbQiaR13xPB_5RfbjD-0pbefudYYLZ16vS7XU14TIUHoovWQ', '+62 856-1122-334', 'budisantoso@webdesa.go.id', 'Sarjana arsitektur wilayah pengembangan pedesaan. Merancang peta tata guna lahan digital serta sistem tata air modern untuk sawah pertanian.', '["Menyusun Rencana Kerja Pembangunan Desa (RKPDesa) tahunan.", "Menyiapkan rancangan usulan musyawarah perencanaan pembangunan (Musrenbang).", "Mengawasi pengerjaan instalasi fisik infrastruktur umum."]'),
(5, 'Dewi Lestari', 'Kaur Umum', 'Kepala Urusan Tata Usaha & Urusan Umum', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD3QnTa_CKM1RVk5VZoUn2ZKLP0nmfVsNbPXFoSXroJw89PlUNYM2TtuhBbkSDWsJLGR3nrqgOnJdiy2axVHkg8b1DcJkTSke3-pe6PhkoCus59nQLIQjsN63YW0BZFOknthSc4ENOEujNSjw1v9zM0qAq3viUXMErGnkSRTUrY33XDCNQ3m6Y1LgTjsNZJueyfcvhRcRr5kNP5IFxAKdvjiHvS0CcFvmgQB_XBKo7feYmAszfzLuq5TKy6rGDJUAnX41BokxYfdiw', '+62 821-3344-556', 'dewilestari@webdesa.go.id', 'Fokus pada pelayanan internal, manajemen kehumasan, penyediaan sarana operasional balai desa, dan mengurusi inventarisasi aset desa.', '["Mengelola surat menyurat keluar masuk serta urusan rumah tangga balai desa.", "Melakukan inventarisasi dan mencatat pendaftaran tanah kas desa.", "Memberikan dukungan administratif untuk upacara adat dan agenda penting."]');

-- --------------------------------------------------------
-- Table structure for table `services`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `services` (
  `id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('kependudukan','sosial','izin') NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(100) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `icon_name` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `requirements` text NOT NULL, -- JSON-formatted list of requirements
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `services`
INSERT INTO `services` (`id`, `title`, `category`, `description`, `duration`, `cost`, `icon_name`, `image_url`, `requirements`) VALUES
('srv-1', 'Penerbitan KTP & Kartu Keluarga Baru', 'kependudukan', 'Pengurusan berkas pencatatan sipil perpindahan domisili, pembuatan KTP baru usia 17 tahun, serta pemecahan kartu keluarga mandiri.', '2 - 3 Hari Kerja', 'Gratis (Bebas Biaya)', 'IdCard', 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?q=80&w=700&auto=format&fit=crop', '["Isi formulir pendaftaran digital pengajuan sipil", "Unggah scan KTP asli / Surat Pengantar Kehilangan", "Fotokopi Kartu Keluarga lama", "Surat Pengantar RT/RW setempat yang ditandatangani basah"]'),
('srv-2', 'Surat Keterangan Pengantar RT / RW', 'izin', 'Penerbitan surat pengantar umum guna peruntukan pengurusan pernikahan, pembuatan SKCK, surat keterangan usaha, ataupun ijin domisili sementara.', '1 Jam (Instan)', 'Gratis (Bebas Biaya)', 'FileText', 'https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=700&auto=format&fit=crop', '["NIK terdaftar valid di basis data kependudukan desa", "Scan asli KTP pemohon", "Deskripsi jelas mengenai maksud peruntukan surat pengantar"]'),
('srv-3', 'Registrasi Akta Kelahiran Baru', 'kependudukan', 'Pelaporan kelahiran bayi dusun desa untuk diterbitkan dokumen pencatatan kutipan akta kelahiran resmi Kementerian Dalam Negeri.', '3 - 5 Hari Kerja', 'Gratis (Bebas Biaya)', 'Baby', 'https://images.unsplash.com/photo-1519689680058-324335c77ebe?q=80&w=700&auto=format&fit=crop', '["Surat keterangan kelahiran asli dari Bidan, Puskesmas, atau Rumah Sakit", "Fotokopi Buku Nikah / Kutipan Akta Perkawinan orang tua", "Scan KTP kedua orang tua kandung & minimal 2 orang saksi", "Scan Kartu Keluarga asli orang tua"]'),
('srv-4', 'Permohonan Bantuan Sosial Mandiri', 'sosial', 'Pengajuan data warga kurang mampu berhak menerima jatah beras raskin, subsidi listrik desa, bantuan langsung tunai (BLT), serta program KIP desa.', '7 Hari Kerja Verifikasi', 'Gratis (Bebas Biaya)', 'Gift', 'https://images.unsplash.com/photo-1469571486040-0b3b27573b7f?q=80&w=700&auto=format&fit=crop', '["Surat Pernyataan Tidak Mampu ditandatangani RT & RW setempat", "Foto kondisi fisik rumah bagian tampak depan dan ruang tamu dalam", "KTP asli & Kartu Keluarga pemohon utama", "Slip gaji / Surat keterangan penghasilan bulanan di bawah upah minimum"]'),
('srv-5', 'Izin Domisili Usaha Mikro & Niaga', 'izin', 'Penerbitan surat keterangan domisili usaha legalitas tingkat kelurahan/desa bagi pedagang mikro, UMKM industri rumahan, atau peternakan mandiri.', '1 - 2 Hari Kerja', 'Gratis (Bebas Biaya)', 'Building2', 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=700&auto=format&fit=crop', '["Scan KTP penanggung jawab usaha", "Foto fisik lokasi tempat usaha mikro", "Persetujuan tertulis bertandatangan tetangga radius terdekat usaha", "Surat pengantar kepemilikan lahan atau bukti perjanjian sewa tempat"]');

-- --------------------------------------------------------
-- Table structure for table `potential_items`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `potential_items` (
  `id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('pertanian','wisata','umkm') NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `stats` text NOT NULL, -- JSON-formatted stats dictionary
  `pengelola` varchar(255) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `price_detail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `potential_items`
INSERT INTO `potential_items` (`id`, `title`, `category`, `subtitle`, `tagline`, `description`, `image_url`, `stats`, `pengelola`, `kontak`, `price_detail`) VALUES
('pot-1', 'Padi Gogo Sawah Organik Lereng', 'pertanian', 'Komoditas Unggulan Sektor Pangan', '✨ Beras aromatik premium tanpa tambahan bahan kimia sintetis.', 'Pertanian padi organik gogo sawah lereng perbukitan selatan desa ditanam penuh kasih dengan pupuk kompos organik hewani alami gratis. Sawah dialiri mata air pergunungan murni tanpa tercemar limbah pemukiman kota.', 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?q=80&w=700&auto=format&fit=crop', '{"produksi": "1,200 Ton / Tahun", "lahan": "420 Hektar", "petani": "320 Kepala Keluarga", "ekspor": "Pasar Regional & Nasional"}', 'Gapoktan (Gabungan Kelompok Tani) Lestari Nyata', '+62 813-9090-8800', 'Membeli Beras Organik Kemasan 5kg'),
('pot-2', 'Kebun Kopi Arabika lereng Selo', 'pertanian', 'Komoditas Kopi Khas Ketinggian', '☕ Cita rasa buah ceri merah dengan aroma harum bunga melati.', 'Kawasan perkebunan kopi arabika rakyat di lereng perbukitan dengan ketinggian mencapai 800-1100 MDPL. Biji kopi dipetik merah secara selektif oleh petani wanita dan diolah melalui metode pascapanen natural basah.', 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=700&auto=format&fit=crop', '{"produksi": "45 Ton Biji Kering / Tahun", "lahan": "65 Hektar", "petani": "50 Kepala Keluarga", "ekspor": "Kedai Kopi Khusus Ibu Kota"}', 'Kelompok Tani Tunas Jaya Sejahtera', '+62 811-3322-114', 'Pesan Biji Kopi Arabika Roast/Greenbean'),
('pot-3', 'Wisata Alam Air Terjun Lembah Hijau', 'wisata', 'Ekowisata Berkelanjutan Berbasis Komunitas', '🌊 Terjunan air jernih setinggi 30 meter di tengah hutan pinus asri.', 'Keindahan air terjun asri alami yang tersembunyi. Area wisata dikelola sepenuhnya oleh Pokdarwis (Kelompok Sadar Wisata) Karang Taruna desa dengan fasilitas jalur trekking rindang, flying fox safety, spot foto atas bukit, dan warung kuliner tradisional.', 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=700&auto=format&fit=crop', '{"pengunjung": "2,500 Orang / Bulan", "fasilitas": "Toilet, Camping Ground, Gazebo", "tiket": "Rp 10.000 / Orang", "jaringan": "Sinyal Telkomsel 4G Lancar"}', 'Pokdarwis Lembah Hijau Sejahtera', '+62 856-4455-667', 'Booking Area Camping / Paket Wisata Outbound'),
('pot-4', 'Desa Agro Wisata Edukasi Kebun Buah', 'wisata', 'Agrowisata Edukatif Petik Buah Segar', '🍊 Wisata petik buah durian montong, jeruk madu, dan kelengkeng.', 'Destinasi asyik edukatif memetik buah segar langsung dari tangkainya di lahan perkebunan desa seluas 12 hektar. Setiap pengunjung akan dibimbing oleh pemandu tani terpercaya tentang tata cara okulasi pembibitan pohon buah.', 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=700&auto=format&fit=crop', '{"panen": "Setiap Bulan Juni - Agustus", "luas": "12 Hektar Lahan Terbuka", "pilihan": "Durian, Jeruk, Alpukat, Jambu", "tiket": "Rp 15.000 (Free 1 Gelas Jus Jeruk)"}', 'Poktan Tunas Makmur Sentosa', '+62 812-7776-554', 'Pesan Tiket Wisata Edukasi Rombongan Sekolah'),
('pot-5', 'Kerajinan Anyaman Bambu Lestari', 'umkm', 'Pengembangan Ekonomi Kreatif Adat Lokal', '👜 Tas, keranjang, pot bunga estetis berbahan serat bambu ramah lingkungan.', 'Warisan turun-temurun menganyam bilah bambu yang ramah bumi. Melalui bimbingan PKK kelurahan, produk anyaman bambu kini diproduksi dengan model retro minimalis kekinian bermutu tinggi layak dipasarkan ke butik nasional serta ekspor.', 'https://images.unsplash.com/photo-1590736969955-71cc94801759?q=80&w=700&auto=format&fit=crop', '{"pengrajin": "40 Ibu Rumah Tangga", "kapasitas": "1,500 Produk / Bulan", "harga": "Rp 25.000 - Rp 250.000", "pemasaran": "Shopee, Tokopedia, & Toko Oleh-oleh"}', 'Koperasi Kreatif Usaha Desa Wanita Mandiri', '+62 822-1111-222', 'Pesan Kerajinan Anyaman Bambu Grosir/Custom'),
('pot-6', 'Batik Tulis Motif Khas Daun Sawah', 'umkm', 'Karya Seni Adat Nilai Tinggi', '🎨 Cap tulis bermotif siluet alam padi dan daun srigading pegunungan.', 'Setiap helai kain katun prima dicanangkan malam tradisional secara manual menggunakan canting tembaga kuningan murni. Produk batik srigading mengekspresikan kehidupan agraris pedesaan yang damai, asri, nan makmur sejahtera lahiriah.', 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=700&auto=format&fit=crop', '{"pengrajin": "15 Pemuda & Seniman Desa", "pembuatan": "3 Minggu per Helai Sutra", "pewarna": "Alami dari Ekstrak Kulit Kayu", "harga": "Rp 150.000 - Rp 1.500.000"}', 'Sanggar Seni & Batik Cipta Svara', '+62 821-4477-991', 'Pesan Kain Batik Tulis Motif Adat Eksklusif');

-- --------------------------------------------------------
-- Table structure for table `news`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `news` (
  `id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('Pembangunan','Kegiatan','Pengumuman','Prestasi') NOT NULL,
  `date` varchar(50) NOT NULL,
  `excerpt` text NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `reads` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `news`
INSERT INTO `news` (`id`, `title`, `category`, `date`, `excerpt`, `content`, `image_url`, `author`, `reads`) VALUES
('news-1', 'Pembangunan Jalan Rabat Beton Dusun Makmur Rampung Selesai', 'Pembangunan', '15 Juni 2026', 'Peningkatkan infrastruktur jalan penghubung pertanian rampung seratus persen demi kelancaran distribusi hasil panen gogo sawah warga.', 'Pemerintah Desa secara resmi mengumumkan selesainya pembangunan jalan semen rabat beton di Dusun Makmur RT 02/RW 04 sepanjang 450 meter dengan lebar 3 meter. Proyek ini didanai sepenuhnya melalui alokasi Dana Desa (DD) anggaran tahun 2026 tahap I.\r\n\r\nKepala urusan perencanaan pembangunan desa, Budi Santoso, S.T., menyampaikan bahwa jalan pertanian ini memiliki peranan vital sebagai urat nadi penyaluran hasil agro tani warga desa seperti padi gogo sawah organik, kelapa genjah, kopi arabika, dan palawija rakyat.\r\n\r\n\"Sebelumnya jalan ini berlubang berbatu-batu liat licin apabila turun hujan, yang seringkali menghambat laju gerobak motor roda tiga pengangkut padi petani. Berkat dedikasi gotong royong warga selama 14 hari penuh, kini pengerjaan rabat beton selesai 3 hari lebih cepat dari tenggat perkiraan semula,\" ungkap Budi Santoso saat peresmian jalan desa bersama tokoh adat dusun.', 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=700&auto=format&fit=crop', 'Budi Santoso (Kaur Pembangunan)', 247),
('news-2', 'Festival Bersih Desa & Kenduri Panen Raya Berlangsung Khidmat', 'Kegiatan', '10 Juni 2026', 'Masyarakat menggelorakan doa syukur keselamatan agraris dan pagelaran tari adat tradisional srigading di pendopo agung balai desa.', 'Sebagai wujud rasa syukur mendalam atas melimpahnya hasil panen padi sawah gogo organik, masyarakat menyelenggarakan pagelaran upacara adat \'Kenduri Bersih Desa\' yang berlangsung meriah di pelataran terbuka Balai Desa.\r\n\r\nAcara tahunan luhur ini diawali pengerakan gunungan raksasa hasil pertanian buah jeruk gogo madu, buah alpukat segar, singkong keladi, dan tumpeng nasi gurih setinggi dua meter. Gunungan tersebut kemudian didoakan bersama oleh seluruh ketua keagamaan adat dusun demi keberkahan setahun mendatang.\r\n\r\nSekretaris desa, Siti Aminah, menerangkan bahwa upacara Bersih Desa bukan sekadar pelestarian adat kuno, melainkan perekat silaturahmi sosial persatuan warga antar dusun. Festival ditutup dengan pementasan seni tari srigading kolosal yang dibawakan secara apik oleh 30 pemudi karang taruna.', 'https://images.unsplash.com/photo-1533105079780-92b9be482077?q=80&w=700&auto=format&fit=crop', 'Siti Aminah (Sekretaris Desa)', 382),
('news-3', 'Pengumuman Penyaluran Bantuan Langsung Tunai (BLT) Desa Tahap III', 'Pengumuman', '05 Juni 2026', 'Sebanyak 120 kepala keluarga wajib penerima manfaat dijadwalkan berkumpul di aula pendopo desa membawa persayaratan fotokopi KK.', 'Pemerintah desa melalui bendahara keuangan desa mengundang secara resmi warga Keluarga Penerima Manfaat (KPM) untuk mengantre tertib pencairan Bantuan Langsung Tunai (BLT) Dana Desa Triwulan Kedua untuk bulan April, Mei, dan Juni 2026.\r\n\r\nPembagian bantuan uang tunai senilai Rp 900.000,- per kepala keluarga akan disalurkan pada hari Kamis, 18 Juni 2026 di Pendopo Aula Desa Sukamaju mulai pukul 08.00 WIB s/d selesai.\r\n\r\nSyarat mutlak pengambilan bantuan tunai warga:\r\n1. Membawa undangan berkas fisik resmi berstempel basah kelurahan.\r\n2. Membawa Kartu Keluarga (KK) asli dan Kartu Tanda Penduduk (KTP) asli pemohon.\r\n3. Diwakilkan hanya boleh dalam 1 silsilah Kartu Keluarga yang sama disertai Surat Kuasa bermeterai asli apabila pemohon sakit/lansia lumpuh.', 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?q=80&w=700&auto=format&fit=crop', 'Rahmat Hidayat (Bendahara Desa)', 412),
('news-4', 'WebDesa Dianugerahi Penghargaan Desa Digital Transparan Terbaik', 'Prestasi', '28 Mei 2026', 'Sistem portal resmi desa meraih standarisasi transparansi piala emas dari Kementerian Komunikasi pedesaan mandiri.', 'Desa kami kembali mengukir prestasi emas membanggakan di kancah nasional. Situs web portal resmi pelayanan digital desa kami resmi diganjar penghargaan prestisius \'Piala Emas Desa Digital Mandiri Transparan 2026\' dari Kementerian Komunikasi dan Informasi pembangunan pedesaan.\r\n\r\nPenghargaan diserahkan langsung oleh Menteri Komunikasi dalam rapat rapat piala nasional di ibu kota kepada Kepala Desa, Ir. H. Ahmad Fauzi. Penilaian didasarkan atas efektivitas kemudahan warga melacak dokumen secara mandiri, sistem pengaduan E-Sambat yang selesai cepat di bawah 24 jam, serta keterbukaan neraca diagram rincian anggaran dana APBDesa secara online.\r\n\r\n\"Piala kebanggaan ini kami persembahkan sepenuhnya untuk warga desa tercinta yang terus berupaya cerdas dan adaptif menyambut era transformasi kebangkitan digital terpadu pedesaan,\" ujar Ahmad Fauzi dalam pidato sambutannya.', 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=700&auto=format&fit=crop', 'Ir. H. Ahmad Fauzi (Kades)', 198);

-- --------------------------------------------------------
-- Table structure for table `submissions`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  `status` enum('Draft','Diajukan','Verifikasi','Selesai') NOT NULL,
  `tracking_id` varchar(50) NOT NULL,
  `files` text NOT NULL, -- JSON-formatted list of file names
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracking_id` (`tracking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `submissions`
INSERT INTO `submissions` (`id`, `service_id`, `service_name`, `nik`, `name`, `phone`, `email`, `date_submitted`, `status`, `tracking_id`, `files`, `notes`) VALUES
('sub-1', 'srv-1', 'Penerbitan KTP & Kartu Keluarga Baru', '3275010203040001', 'Andi Saputra', '081298765432', 'andisaputra@email.com', '12 Juni 2026', 'Selesai', 'WD-SERVICES-8321', '["KTP_Lama.pdf", "Surat_RT.pdf"]', 'Kartu Keluarga dan KTP fisik Anda telah selesai dicetak. Silakan ambil di Loket 3 Pelayanan Balai Desa pada jam kerja dengan membawa dokumen lama.'),
('sub-2', 'srv-3', 'Registrasi Akta Kelahiran Baru', '3275010203040002', 'Bambang Wijaya', '081311223344', 'bambangw@email.com', '14 Juni 2026', 'Verifikasi', 'WD-SERVICES-2941', '["Suket_Lahir.jpg", "Buku_Nikah.pdf"]', 'Petugas sedang memverifikasi scan buku nikah asli orang tua. Mohon pastikan scan berkas tidak buram / terpotong.'),
('sub-3', 'srv-4', 'Permohonan Bantuan Sosial Mandiri', '3275010203040003', 'Siti Rahmawati', '085699887766', 'sitirahma@email.com', '16 Juni 2026', 'Diajukan', 'WD-SERVICES-5730', '["Suket_Miskin.pdf", "Depan_Rumah.jpg"]', 'Berkas Anda telah berhasil diterima oleh sistem digital. Tim Satgas Sosial Desa sedang menjadwalkan survey verifikasi faktual lapangan.');

-- --------------------------------------------------------
-- Table structure for table `complaints`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `complaints` (
  `id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` enum('infrastruktur','sosial','keamanan','kebersihan','lainnya') NOT NULL,
  `description` text NOT NULL,
  `status` enum('Draft','Diterima','Proses','Selesai') NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `tracking_id` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `response_message` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracking_id` (`tracking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed data for `complaints`
INSERT INTO `complaints` (`id`, `title`, `category`, `description`, `status`, `date_submitted`, `author`, `tracking_id`, `location`, `response_message`) VALUES
('c-1', 'Jalan Longsor Lingkar Dusun Timur', 'infrastruktur', 'Jalan semen lingkar timur mengalami retak parah dan sebagian amblas akibat hujan deras tadi malam. Sangat membahayakan pengguna jalan terutama motor.', 'Proses', '15 Juni 2026', 'Prasetyo', 'WD-SAMBAT-4819', 'RT 05 / RW 02 Dusun Timur', 'Laporan kerusakan jalan telah diverifikasi oleh tim perencana desa. Pemerintah desa sedang menyiapkan papan pembatas keselamatan darurat, semen beton cor akan ditambal mulai lusa menggunakan pagu anggaran darurat desa.'),
('c-2', 'Penumpukan Sampah Liar di Parit Sungai', 'kebersihan', 'Beberapa warga luar membuang sampah kantong plastik sembarangan di aliran anak sungai jembatan selatan. Air mulai tergenang dan menimbulkan bau menyengat.', 'Selesai', '14 Juni 2026', 'Warga Anonim', 'WD-SAMBAT-7391', 'Jembatan Sawah Selatan', 'Unit Satpol Pamong bekerjasama dengan Karang Taruna telah melakukan aksi bersih sungai mandiri kemarin. Spanduk larangan dan ancaman denda pidana kini terpasang kokoh di lokasi jembatan.');

-- --------------------------------------------------------
-- Table structure for table `potential_inquiries`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `potential_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `price_detail` varchar(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_phone` varchar(50) NOT NULL,
  `date_submitted` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
