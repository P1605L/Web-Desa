import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { Sprout, Mountain, ShoppingBag, Eye, X, Phone, Globe, Star, Sparkles, MapPin, Check } from 'lucide-react';

export default function PotentialTab() {
  const [activePotentialTab, setActivePotentialTab] = useState<'pertanian' | 'wisata' | 'umkm'>('pertanian');
  const [selectedItem, setSelectedItem] = useState<any | null>(null);
  const [inquireSuccess, setInquireSuccess] = useState(false);
  const [inquireName, setInquireName] = useState('');
  const [inquirePhone, setInquirePhone] = useState('');

  const potentialList = [
    {
      id: 'pot-1',
      title: 'Padi Gogo Sawah Organik Lereng',
      category: 'pertanian',
      subtitle: 'Komoditas Unggulan Sektor Pangan',
      tagline: '✨ Beras aromatik premium tanpa tambahan bahan kimia sintetis.',
      description: 'Pertanian padi organik gogo sawah lereng perbukitan selatan desa ditanam penuh kasih dengan pupuk kompos organik hewani alami gratis. Sawah dialiri mata air pergunungan murni tanpa tercemar limbah pemukiman kota.',
      image: 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?q=80&w=700&auto=format&fit=crop',
      stats: {
        produksi: '1,200 Ton / Tahun',
        lahan: '420 Hektar',
        petani: '320 Kepala Keluarga',
        ekspor: 'Pasar Regional & Nasional'
      },
      pengelola: 'Gapoktan (Gabungan Kelompok Tani) Lestari Nyata',
      kontak: '+62 813-9090-8800',
      priceDetail: 'Membeli Beras Organik Kemasan 5kg'
    },
    {
      id: 'pot-2',
      title: 'Kebun Kopi Arabika lereng Selo',
      category: 'pertanian',
      subtitle: 'Komoditas Kopi Khas Ketinggian',
      tagline: '☕ Cita rasa buah ceri merah dengan aroma harum bunga melati.',
      description: 'Kawasan perkebunan kopi arabika rakyat di lereng perbukitan dengan ketinggian mencapai 800-1100 MDPL. Biji kopi dipetik merah secara selektif oleh petani wanita dan diolah melalui metode pascapanen natural basah.',
      image: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=700&auto=format&fit=crop',
      stats: {
        produksi: '45 Ton Biji Kering / Tahun',
        lahan: '65 Hektar',
        petani: '50 Kepala Keluarga',
        ekspor: 'Kedai Kopi Khusus Ibu Kota'
      },
      pengelola: 'Kelompok Tani Tunas Jaya Sejahtera',
      kontak: '+62 811-3322-114',
      priceDetail: 'Pesan Biji Kopi Arabika Roast/Greenbean'
    },
    {
      id: 'pot-3',
      title: 'Wisata Alam Air Terjun Lembah Hijau',
      category: 'wisata',
      subtitle: 'Ekowisata Berkelanjutan Berbasis Komunitas',
      tagline: '🌊 Terjunan air jernih setinggi 30 meter di tengah hutan pinus asri.',
      description: 'Keindahan air terjun asri alami yang tersembunyi. Area wisata dikelola sepenuhnya oleh Pokdarwis (Kelompok Sadar Wisata) Karang Taruna desa dengan fasilitas jalur trekking rindang, flying fox safety, spot foto atas bukit, dan warung kuliner tradisional.',
      image: 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=700&auto=format&fit=crop',
      stats: {
        pengunjung: '2,500 Orang / Bulan',
        fasilitas: 'Toilet, Camping Ground, Gazebo',
        tiket: 'Rp 10.000 / Orang',
        jaringan: 'Sinyal Telkomsel 4G Lancar'
      },
      pengelola: 'Pokdarwis Lembah Hijau Sejahtera',
      kontak: '+62 856-4455-667',
      priceDetail: 'Booking Area Camping / Paket Wisata Outbound'
    },
    {
      id: 'pot-4',
      title: 'Desa Agro Wisata Edukasi Kebun Buah',
      category: 'wisata',
      subtitle: 'Agrowisata Edukatif Petik Buah Segar',
      tagline: '🍊 Wisata petik buah durian montong, jeruk madu, dan kelengkeng.',
      description: 'Destinasi asyik edukatif memetik buah segar langsung dari tangkainya di lahan perkebunan desa seluas 12 hektar. Setiap pengunjung akan dibimbing oleh pemandu tani terpercaya tentang tata cara okulasi pembibitan pohon buah.',
      image: 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=700&auto=format&fit=crop',
      stats: {
        panen: 'Setiap Bulan Juni - Agustus',
        luas: '12 Hektar Lahan Terbuka',
        pilihan: 'Durian, Jeruk, Alpukat, Jambu',
        tiket: 'Rp 15.000 (Free 1 Gelas Jus Jeruk)'
      },
      pengelola: 'Poktan Tunas Makmur Sentosa',
      kontak: '+62 812-7776-554',
      priceDetail: 'Pesan Tiket Wisata Edukasi Rombongan Sekolah'
    },
    {
      id: 'pot-5',
      title: 'Kerajinan Anyaman Bambu Lestari',
      category: 'umkm',
      subtitle: 'Pengembangan Ekonomi Kreatif Adat Lokal',
      tagline: '👜 Tas, keranjang, pot bunga estetis berbahan serat bambu ramah lingkungan.',
      description: 'Warisan turun-temurun menganyam bilah bambu yang ramah bumi. Melalui bimbingan PKK kelurahan, produk anyaman bambu kini diproduksi dengan model retro minimalis kekinian bermutu tinggi layak dipasarkan ke butik nasional serta ekspor.',
      image: 'https://images.unsplash.com/photo-1590736969955-71cc94801759?q=80&w=700&auto=format&fit=crop',
      stats: {
        pengrajin: '40 Ibu Rumah Tangga',
        kapasitas: '1,500 Produk / Bulan',
        harga: 'Rp 25.000 - Rp 250.000',
        pemasaran: 'Shopee, Tokopedia, & Toko Oleh-oleh'
      },
      pengelola: 'Koperasi Kreatif Usaha Desa Wanita Mandiri',
      kontak: '+62 822-1111-222',
      priceDetail: 'Pesan Kerajinan Anyaman Bambu Grosir/Custom'
    },
    {
      id: 'pot-6',
      title: 'Batik Tulis Motif Khas Daun Sawah',
      category: 'umkm',
      subtitle: 'Karya Seni Adat Nilai Tinggi',
      tagline: '🎨 Cap tulis bermotif siluet alam padi dan daun srigading pegunungan.',
      description: 'Setiap helai kain katun prima dicanangkan malam tradisional secara manual menggunakan canting tembaga kuningan murni. Produk batik srigading mengekspresikan kehidupan agraris pedesaan yang damai, asri, nan makmur sejahtera lahiriah.',
      image: 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=700&auto=format&fit=crop',
      stats: {
        pengrajin: '15 Pemuda & Seniman Desa',
        pembuatan: '3 Minggu per Helai Sutra',
        pewarna: 'Alami dari Ekstrak Kulit Kayu',
        harga: 'Rp 150.000 - Rp 1.500.000'
      },
      pengelola: 'Sanggar Seni & Batik Cipta Svara',
      kontak: '+62 821-4477-991',
      priceDetail: 'Pesan Kain Batik Tulis Motif Adat Eksklusif'
    }
  ];

  const filteredItems = potentialList.filter(item => item.category === activePotentialTab);

  const handleInquireSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!inquireName || !inquirePhone) return;

    setInquireSuccess(true);
    setTimeout(() => {
      setInquireSuccess(false);
      setInquireName('');
      setInquirePhone('');
      setSelectedItem(null);
    }, 2500);
  };

  return (
    <div className="space-y-12">
      
      {/* 1. Header Hero Panel */}
      <div className="text-center max-w-2xl mx-auto space-y-4">
        <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-850 text-xs font-bold border border-emerald-200">
          <Sparkles size={13} className="text-emerald-700" /> Hasil Bumi &amp; Kreativitas Mandiri
        </span>
        <h1 className="font-display text-4xl font-extrabold tracking-tight text-gray-950">
          Potensi Ekonomi &amp; Keberdayaan Desa
        </h1>
        <p className="text-sm sm:text-base text-gray-500 leading-relaxed font-sans">
          Jelajahi keunggulan komoditas pertanian organik, keelokan objek wisata alam pedesaan, serta kreasi seni adat dari pelaku usaha mikro kecil menengah (UMKM) mandiri binaan Kelurahan Desa.
        </p>
      </div>

      {/* 2. Custom Tabs */}
      <div className="flex justify-center border-b border-gray-100 pb-3">
        <div className="flex gap-1.5 p-1 bg-gray-100 rounded-full text-xs font-bold font-display shadow-inner">
          <button
            onClick={() => setActivePotentialTab('pertanian')}
            className={`px-5 py-2.5 rounded-full flex items-center gap-1.5 transition-all ${
              activePotentialTab === 'pertanian' ? 'bg-primary text-white shadow' : 'text-gray-500 hover:text-primary'
            }`}
          >
            <Sprout size={16} /> Pertanian &amp; Perkebunan
          </button>
          
          <button
            onClick={() => setActivePotentialTab('wisata')}
            className={`px-5 py-2.5 rounded-full flex items-center gap-1.5 transition-all ${
              activePotentialTab === 'wisata' ? 'bg-primary text-white shadow' : 'text-gray-500 hover:text-primary'
            }`}
          >
            <Mountain size={16} /> Ekowisata Alam Desa
          </button>

          <button
            onClick={() => setActivePotentialTab('umkm')}
            className={`px-5 py-2.5 rounded-full flex items-center gap-1.5 transition-all ${
              activePotentialTab === 'umkm' ? 'bg-primary text-white shadow' : 'text-gray-500 hover:text-primary'
            }`}
          >
            <ShoppingBag size={16} /> UMKM &amp; Ekonomi Kreatif
          </button>
        </div>
      </div>

      {/* 3. Potential Grid Output */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
        <AnimatePresence mode="popLayout">
          {filteredItems.map((item) => (
            <motion.div
              layout
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.95 }}
              key={item.id}
              className="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row"
              id={`potential-card-${item.id}`}
            >
              {/* Image Frame */}
              <div className="md:w-1/2 aspect-square md:aspect-auto relative bg-gray-100">
                <img src={item.image} alt={item.title} className="w-full h-full object-cover select-none" />
                <div className="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-black/50 via-transparent to-transparent pointer-events-none" />
              </div>

              {/* Info Area */}
              <div className="p-6 md:w-1/2 flex flex-col justify-between text-left space-y-4">
                <div className="space-y-2">
                  <span className="text-[9px] uppercase font-bold text-emerald-800 tracking-wider">
                    {item.subtitle}
                  </span>
                  <h3 className="font-display font-extrabold text-[#111] text-base leading-snug">
                    {item.title}
                  </h3>
                  <p className="text-[10px] text-gray-500 font-semibold leading-relaxed">
                    {item.tagline}
                  </p>
                </div>

                <p className="text-[11px] text-gray-500 line-clamp-3 leading-relaxed">
                  {item.description}
                </p>

                <div className="pt-2 border-t border-gray-100 flex items-center justify-between">
                  <span className="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none">
                    Oleh: {item.pengelola.split(' ')[0]}...
                  </span>

                  <button
                    onClick={() => setSelectedItem(item)}
                    className="px-4.5 py-2.5 bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-extrabold rounded-xl hover:bg-emerald-100 active:scale-95 transition-all font-display uppercase tracking-wide inline-flex items-center gap-1"
                    id={`more-potential-btn-${item.id}`}
                  >
                    <Eye size={13} />
                    Rincian Info
                  </button>
                </div>
              </div>
            </motion.div>
          ))}
        </AnimatePresence>
      </div>

      {/* Potential Detail Modal */}
      <AnimatePresence>
        {selectedItem && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 overflow-y-auto">
            <motion.div 
              initial={{ opacity: 0, scale: 0.95, y: 20 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 20 }}
              className="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card"
            >
              <div className="p-5 bg-emerald-950 text-white flex justify-between items-center">
                <div>
                  <h4 className="font-display font-extrabold text-base">{selectedItem.title}</h4>
                  <p className="text-[10px] text-emerald-200">{selectedItem.subtitle}</p>
                </div>
                <button 
                  onClick={() => { setSelectedItem(null); setInquireSuccess(false); }} 
                  className="p-1 rounded-full hover:bg-white/10 transition-colors"
                >
                  <X size={18} />
                </button>
              </div>

              <div className="p-6 max-h-[70vh] overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {/* Visual Image & Bio */}
                <div className="space-y-4">
                  <div className="aspect-video rounded-xl overflow-hidden border border-gray-100 shadow">
                    <img src={selectedItem.image} alt={selectedItem.title} className="w-full h-full object-cover" />
                  </div>

                  <p className="text-xs text-gray-550 leading-relaxed font-sans text-left">
                    {selectedItem.description}
                  </p>

                  <div className="p-3 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-100/30 text-xs text-left">
                    <p className="font-bold flex items-center gap-1 mb-1">🤝 Hubungan Sektor Pengelola:</p>
                    <p className="text-[11px] leading-relaxed text-emerald-900">{selectedItem.pengelola}</p>
                  </div>
                </div>

                {/* Specs agricultural stats & Inquiry form */}
                <div className="space-y-5 text-left">
                  <div className="p-4 rounded-xl border border-gray-100 bg-gray-50/50 space-y-3">
                    <p className="text-xs font-bold text-gray-500 uppercase tracking-widest font-display pb-1 border-b border-gray-100">
                      IKHTISAR STATISTIK
                    </p>
                    <div className="grid grid-cols-1 gap-2 text-xs">
                      {Object.entries(selectedItem.stats).map(([k, v]: any) => (
                        <div key={k} className="flex justify-between">
                          <span className="text-gray-400 capitalize">{k.replace('_', ' ')}:</span>
                          <span className="font-bold text-gray-800">{v}</span>
                        </div>
                      ))}
                    </div>
                  </div>

                  {/* Inquiry form section */}
                  <div className="p-4 border border-emerald-100 bg-emerald-50/10 rounded-2xl relative overflow-hidden">
                    <h5 className="font-display font-extrabold text-sm text-gray-800 tracking-tight pb-1 mb-3">
                      Layanan Hubungi / Pemesanan
                    </h5>

                    <AnimatePresence mode="wait">
                      {!inquireSuccess ? (
                        <form onSubmit={handleInquireSubmit} className="space-y-3.5" key="inquire-form">
                          <p className="text-[10px] text-gray-450 leading-relaxed">
                            Butuh koordinasi pembelian produk, pasokan sayur gogo, atau reservasi camping outbound? Ajukan formulir ini langsung ke bendahara pengelola:
                          </p>

                          <div>
                            <label className="block text-[10px] font-bold text-gray-500 uppercase mb-0.5">Membeli / Memesan:</label>
                            <input 
                              type="text" 
                              value={selectedItem.priceDetail} 
                              className="w-full text-xs font-semibold bg-gray-100 p-2.5 rounded-lg text-gray-700 outline-none select-none"
                              readOnly 
                            />
                          </div>

                          <div className="grid grid-cols-2 gap-2">
                            <div>
                              <label className="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Pemesan *</label>
                              <input 
                                type="text" 
                                value={inquireName} 
                                onChange={(e) => setInquireName(e.target.value)}
                                placeholder="Nama Anda" 
                                className="w-full px-2.5 py-2 border border-gray-200 text-xs rounded-lg bg-white"
                                required
                              />
                            </div>
                            <div>
                              <label className="block text-[10px] font-bold text-gray-500 uppercase mb-1">No. HP / WA *</label>
                              <input 
                                type="text" 
                                value={inquirePhone} 
                                onChange={(e) => setInquirePhone(e.target.value)}
                                placeholder="Contoh: 0812..." 
                                className="w-full px-2.5 py-2 border border-gray-200 text-xs rounded-lg bg-white"
                                required
                              />
                            </div>
                          </div>

                          <button 
                            type="submit"
                            className="w-full py-2.5 bg-emerald-700 text-white text-xs font-bold uppercase rounded-lg hover:bg-emerald-800 transition-all font-display"
                          >
                            Kirim Permintaan Pesanan
                          </button>
                        </form>
                      ) : (
                        <motion.div 
                          key="inquire-success"
                          initial={{ opacity: 0, scale: 0.9 }}
                          animate={{ opacity: 1, scale: 1 }}
                          exit={{ opacity: 0 }}
                          className="py-6 text-center space-y-2.5"
                        >
                          <div className="w-11 h-11 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
                            <Check size={20} />
                          </div>
                          <h6 className="font-display font-extrabold text-sm text-gray-850">Pesanan Berhasil Diajukan</h6>
                          <p className="text-[10px] text-gray-400 max-w-xs mx-auto">
                            Pesan tiket/hubungi pembelian Anda telah dicatat oleh sistem pengelola {selectedItem.pengelola}. Kontak resmi pengelola: <span className="font-mono font-bold text-emerald-800">{selectedItem.kontak}</span>
                          </p>
                        </motion.div>
                      )}
                    </AnimatePresence>
                  </div>

                </div>

              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

    </div>
  );
}
