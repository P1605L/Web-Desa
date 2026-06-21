import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { Calendar, Eye, Search, X, Sparkles, User, ChevronRight, Share2, Clipboard, Heart } from 'lucide-react';
import { NewsItem } from '../types';

interface NewsTabProps {
  searchQuery: string;
}

export default function NewsTab({ searchQuery }: NewsTabProps) {
  const [activeCategory, setActiveCategory] = useState<'Semua' | 'Pembangunan' | 'Kegiatan' | 'Pengumuman' | 'Prestasi'>('Semua');
  const [selectedArticle, setSelectedArticle] = useState<NewsItem | null>(null);
  const [likedArticles, setLikedArticles] = useState<Record<string, boolean>>({});
  const [isCopied, setIsCopied] = useState(false);

  const newsList: NewsItem[] = [
    {
      id: 'news-1',
      title: 'Pembangunan Jalan Rabat Beton Dusun Makmur Rampung Selesai',
      category: 'Pembangunan',
      date: '15 Juni 2026',
      excerpt: 'Peningkatkan infrastruktur jalan penghubung pertanian rampung seratus persen demi kelancaran distribusi hasil panen gogo sawah warga.',
      author: 'Budi Santoso (Kaur Pembangunan)',
      reads: 247,
      image: 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=700&auto=format&fit=crop',
      content: `Pemerintah Desa secara resmi mengumumkan selesainya pembangunan jalan semen rabat beton di Dusun Makmur RT 02/RW 04 sepanjang 450 meter dengan lebar 3 meter. Proyek ini didanai sepenuhnya melalui alokasi Dana Desa (DD) anggaran tahun 2026 tahap I.

Kepala urusan perencanaan pembangunan desa, Budi Santoso, S.T., menyampaikan bahwa jalan pertanian ini memiliki peranan vital sebagai urat nadi penyaluran hasil agro tani warga desa seperti padi gogo sawah organik, kelapa genjah, kopi arabika, dan palawija rakyat.

"Sebelumnya jalan ini berlubang berbatu-batu liat licin apabila turun hujan, yang seringkali menghambat laju gerobak motor roda tiga pengangkut padi petani. Berkat dedikasi gotong royong warga selama 14 hari penuh, kini pengerjaan rabat beton selesai 3 hari lebih cepat dari tenggat perkiraan semula," ungkap Budi Santoso saat peresmian jalan desa bersama tokoh adat dusun.`
    },
    {
      id: 'news-2',
      title: 'Festival Bersih Desa & Kenduri Panen Raya Berlangsung Khidmat',
      category: 'Kegiatan',
      date: '10 Juni 2026',
      excerpt: 'Masyarakat menggelorakan doa syukur keselamatan agraris dan pagelaran tari adat tradisional srigading di pendopo agung balai desa.',
      author: 'Siti Aminah (Sekretaris Desa)',
      reads: 382,
      image: 'https://images.unsplash.com/photo-1533105079780-92b9be482077?q=80&w=700&auto=format&fit=crop',
      content: `Sebagai wujud rasa syukur mendalam atas melimpahnya hasil panen padi sawah gogo organik, masyarakat menyelenggarakan pagelaran upacara adat 'Kenduri Bersih Desa' yang berlangsung meriah di pelataran terbuka Balai Desa.

Acara tahunan luhur ini diawali pengerakan gunungan raksasa hasil pertanian buah jeruk gogo madu, buah alpukat segar, singkong keladi, dan tumpeng nasi gurih setinggi dua meter. Gunungan tersebut kemudian didoakan bersama oleh seluruh ketua keagamaan adat dusun demi keberkahan setahun mendatang.

Sekretaris desa, Siti Aminah, menerangkan bahwa upacara Bersih Desa bukan sekadar pelestarian adat kuno, melainkan perekat silaturahmi sosial persatuan warga antar dusun. Festival ditutup dengan pementasan seni tari srigading kolosal yang dibawakan secara apik oleh 30 pemudi karang taruna.`
    },
    {
      id: 'news-3',
      title: 'Pengumuman Penyaluran Bantuan Langsung Tunai (BLT) Desa Tahap III',
      category: 'Pengumuman',
      date: '05 Juni 2026',
      excerpt: 'Sebanyak 120 kepala keluarga wajib penerima manfaat dijadwalkan berkumpul di aula pendopo desa membawa persayaratan fotokopi KK.',
      author: 'Rahmat Hidayat (Bendahara Desa)',
      reads: 412,
      image: 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?q=80&w=700&auto=format&fit=crop',
      content: `Pemerintah desa melalui bendahara keuangan desa mengundang secara resmi warga Keluarga Penerima Manfaat (KPM) untuk mengantre tertib pencairan Bantuan Langsung Tunai (BLT) Dana Desa Triwulan Kedua untuk bulan April, Mei, dan Juni 2026.

Pembagian bantuan uang tunai senilai Rp 900.000,- per kepala keluarga akan disalurkan pada hari Kamis, 18 Juni 2026 di Pendopo Aula Desa Sukamaju mulai pukul 08.00 WIB s/d selesai.

Syarat mutlak pengambilan bantuan tunai warga:
1. Membawa undangan berkas fisik resmi berstempel basah kelurahan.
2. Membawa Kartu Keluarga (KK) asli dan Kartu Tanda Penduduk (KTP) asli pemohon.
3. Diwakilkan hanya boleh dalam 1 silsilah Kartu Keluarga yang sama disertai Surat Kuasa bermeterai asli apabila pemohon sakit/lansia lumpuh.`
    },
    {
      id: 'news-4',
      title: 'WebDesa Dianugerahi Penghargaan Desa Digital Transparan Terbaik',
      category: 'Prestasi',
      date: '28 Mei 2026',
      excerpt: 'Sistem portal resmi desa meraih standarisasi transparansi piala emas dari Kementerian Komunikasi pedesaan mandiri.',
      author: 'Ir. H. Ahmad Fauzi (Kades)',
      reads: 198,
      image: 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=700&auto=format&fit=crop',
      content: `Desa kami kembali mengukir prestasi emas membanggakan di kancah nasional. Situs web portal resmi pelayanan digital desa kami resmi diganjar penghargaan prestisius 'Piala Emas Desa Digital Mandiri Transparan 2026' dari Kementerian Komunikasi dan Informasi pembangunan pedesaan.

Penghargaan diserahkan langsung oleh Menteri Komunikasi dalam rapat rapat piala nasional di ibu kota kepada Kepala Desa, Ir. H. Ahmad Fauzi. Penilaian didasarkan atas efektivitas kemudahan warga melacak dokumen secara mandiri, sistem pengaduan E-Sambat yang selesai cepat di bawah 24 jam, serta keterbukaan neraca diagram rincian anggaran dana APBDesa secara online.

"Piala kebanggaan ini kami persembahkan sepenuhnya untuk warga desa tercinta yang terus berupaya cerdas dan adaptif menyambut era transformasi kebangkitan digital terpadu pedesaan," ujar Ahmad Fauzi dalam pidato sambutannya.`
    }
  ];

  const filteredNews = newsList.filter(news => {
    const matchesSearch = news.title.toLowerCase().includes(searchQuery.toLowerCase()) || 
                          news.content.toLowerCase().includes(searchQuery.toLowerCase());
    const matchesCategory = activeCategory === 'Semua' || news.category === activeCategory;
    return matchesSearch && matchesCategory;
  });

  const toggleLike = (id: string, e: React.MouseEvent) => {
    e.stopPropagation();
    setLikedArticles(prev => ({
      ...prev,
      [id]: !prev[id]
    }));
  };

  const copyLink = (title: string) => {
    navigator.clipboard.writeText(`WebDesa Portal - Berita: ${title}`);
    setIsCopied(true);
    setTimeout(() => setIsCopied(false), 2000);
  };

  return (
    <div className="space-y-12">
      
      {/* 1. Header Hero Page */}
      <div className="text-center max-w-2xl mx-auto space-y-4">
        <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200">
          <Sparkles size={13} className="text-emerald-700" /> Kabar Informasi Terkini &amp; Akurat
        </span>
        <h1 className="font-display text-4xl font-extrabold tracking-tight text-gray-950">
          Warta &amp; Berita Kelurahan Desa
        </h1>
        <p className="text-sm sm:text-base text-gray-500 leading-relaxed font-sans">
          Mengabarkan seputar pengerjaan rincian proyek pembangunan fisik dusun, pelaksanaan musyawarah desa, agenda kebudayaan kenduri warga, serta lembaran maklumat pengumuman penting pemerintah.
        </p>
      </div>

      {/* 2. Category Filters inside News page */}
      <div className="flex flex-wrap justify-center gap-2">
        {(['Semua', 'Pembangunan', 'Kegiatan', 'Pengumuman', 'Prestasi'] as const).map((cat) => (
          <button
            key={cat}
            onClick={() => setActiveCategory(cat)}
            className={`px-4.5 py-2 rounded-full font-bold text-xs uppercase tracking-wider transition-all border shadow-sm ${
              activeCategory === cat 
                ? 'bg-primary border-primary text-white scale-105' 
                : 'bg-white border-gray-100 text-gray-600 hover:bg-gray-50'
            }`}
          >
            {cat}
          </button>
        ))}
      </div>

      {/* 3. News Grid layout */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
        {filteredNews.length > 0 ? (
          filteredNews.map((news) => (
            <motion.div
              layout
              key={news.id}
              onClick={() => setSelectedArticle(news)}
              whileHover={{ y: -5 }}
              className="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between cursor-pointer group"
              id={`news-card-${news.id}`}
            >
              {/* Thumbnail Image section */}
              <div className="aspect-[16/10] relative bg-emerald-50 overflow-hidden">
                <img 
                  src={news.image} 
                  alt={news.title} 
                  className="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500 select-none" 
                />
                
                <div className="absolute top-3 left-3 px-2.5 py-1 bg-white/94 text-primary font-bold text-[10px] uppercase tracking-wider rounded-full shadow-sm backdrop-blur-sm">
                  {news.category}
                </div>

                {/* Overlaid transparent statistics */}
                <div className="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/60 to-transparent p-4 flex justify-between items-center text-white text-[11px] font-medium font-sans">
                  <span className="flex items-center gap-1"><Calendar size={13} /> {news.date}</span>
                  <span className="flex items-center gap-1"><Eye size={13} /> {news.reads} x Dibaca</span>
                </div>
              </div>

              {/* Text content block */}
              <div className="p-5 flex-1 flex flex-col justify-between space-y-4 text-left">
                <div className="space-y-2">
                  <h3 className="font-display font-extrabold text-[#111] text-base leading-snug group-hover:text-primary transition-colors line-clamp-2">
                    {news.title}
                  </h3>
                  <p className="text-[11.5px] text-gray-500 leading-relaxed font-sans line-clamp-3">
                    {news.excerpt}
                  </p>
                </div>

                <div className="pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
                  <span className="truncate max-w-[150px] font-semibold">{news.author.split('(')[0]}</span>
                  
                  <div className="flex items-center gap-2">
                    <button 
                      onClick={(e) => toggleLike(news.id, e)}
                      className={`p-1.5 rounded-full border hover:scale-105 transition-all transition-colors ${
                        likedArticles[news.id] 
                          ? 'bg-red-50 text-red-600 border-red-200' 
                          : 'bg-white text-gray-400 border-gray-100 hover:text-red-500'
                      }`}
                    >
                      <Heart size={14} className={likedArticles[news.id] ? 'fill-current' : ''} />
                    </button>

                    <span className="text-primary font-bold text-[10px] uppercase tracking-wider inline-flex items-center gap-0.5 group-hover:translate-x-1 transition-transform">
                      Selengkapnya <ChevronRight size={13} />
                    </span>
                  </div>
                </div>
              </div>
            </motion.div>
          ))
        ) : (
          <div className="col-span-full py-16 text-center space-y-3">
            <span className="text-4xl">📰</span>
            <p className="text-sm font-bold text-gray-650">Tidak ada berita desa</p>
            <p className="text-xs text-gray-400">Coba cek kata kunci penulisan lain di kolom pencarian.</p>
          </div>
        )}
      </div>

      {/* Full News Detail Modal overlay */}
      <AnimatePresence>
        {selectedArticle && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 overflow-y-auto">
            <motion.div 
              initial={{ opacity: 0, scale: 0.95, y: 20 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 20 }}
              className="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card"
            >
              <div className="p-5 bg-gradient-to-r from-emerald-950 to-emerald-900 text-white flex justify-between items-center">
                <div>
                  <span className="text-[10px] font-bold text-emerald-300 uppercase tracking-widest block mb-0.5">
                    {selectedArticle.category}
                  </span>
                  <h4 className="font-display font-bold text-sm sm:text-base leading-tight">Detail Informasi Desa</h4>
                </div>
                <button 
                  onClick={() => setSelectedArticle(null)} 
                  className="p-1 px-1.5 rounded-full hover:bg-white/10 transition-colors"
                >
                  <X size={18} />
                </button>
              </div>

              {/* Scrollable image & main text body */}
              <div className="p-6 max-h-[70vh] overflow-y-auto space-y-6 text-left">
                {/* Wide banner frame */}
                <div className="aspect-[16/9] rounded-xl overflow-hidden relative shadow-md">
                  <img src={selectedArticle.image} alt={selectedArticle.title} className="w-full h-full object-cover" />
                  <div className="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-4 text-white flex justify-between items-center text-xs">
                    <span className="font-bold flex items-center gap-1">👤 Penulis: {selectedArticle.author}</span>
                    <span className="font-semibold flex items-center gap-1">📅 Rilis: {selectedArticle.date}</span>
                  </div>
                </div>

                <div className="space-y-4">
                  <h3 className="font-display text-lg sm:text-2xl font-black text-gray-900 leading-snug">
                    {selectedArticle.title}
                  </h3>

                  <div className="flex gap-2.5 pb-2.5 border-b border-gray-100">
                    <button 
                      onClick={(e) => toggleLike(selectedArticle.id, e)}
                      className={`px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1 border transition-colors ${
                        likedArticles[selectedArticle.id] 
                          ? 'bg-red-50 text-red-600 border-red-200' 
                          : 'bg-white text-gray-600 border-gray-105 hover:bg-red-50 hover:text-red-600 hover:border-red-200'
                      }`}
                    >
                      <Heart size={14} className={likedArticles[selectedArticle.id] ? 'fill-current' : ''} />
                      {likedArticles[selectedArticle.id] ? 'Menyukai Berita' : 'Suka Berita'}
                    </button>

                    <button 
                      onClick={() => copyLink(selectedArticle.title)}
                      className="px-3 py-1.5 bg-gray-50 text-gray-600 rounded-full text-xs font-bold border border-gray-200 hover:bg-gray-100 transition-colors flex items-center gap-1"
                    >
                      <Share2 size={13} />
                      {isCopied ? 'Tersalin! ✨' : 'Bagikan Berita'}
                    </button>
                  </div>

                  {/* Body text paragraphs */}
                  <div className="text-xs sm:text-sm leading-relaxed text-gray-700 font-sans space-y-4 whitespace-pre-line">
                    {selectedArticle.content}
                  </div>
                </div>

                <div className="pt-4 border-t border-gray-100 text-[11px] text-gray-400 flex justify-between">
                  <span>Warta Digital Resmi - WebDesa</span>
                  <span>* Total akses baca: {selectedArticle.reads + 1} x dibaca</span>
                </div>
              </div>

              <div className="p-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button 
                  onClick={() => setSelectedArticle(null)}
                  className="px-6 py-2.5 bg-gray-900 text-white hover:bg-black text-xs font-bold uppercase rounded-xl transition-all"
                >
                  Tutup Bacaan
                </button>
              </div>

            </motion.div>
          </div>
        )}
      </AnimatePresence>

    </div>
  );
}
