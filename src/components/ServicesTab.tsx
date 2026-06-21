import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { 
  FileText, ShieldAlert, CreditCard, Clock, Baby, Gift, 
  Building2, Search, ArrowRight, ClipboardCheck, Sparkles, AlertCircle, ChevronDown, Check, UserCheck
} from 'lucide-react';
import { ServiceItem, DocumentSubmission } from '../types';

interface ServicesTabProps {
  searchQuery: string;
  onSelectService: (service: ServiceItem) => void;
  submissionsList: DocumentSubmission[];
}

export default function ServicesTab({ searchQuery, onSelectService, submissionsList }: ServicesTabProps) {
  const [activeCategory, setActiveCategory] = useState<'semua' | 'kependudukan' | 'sosial' | 'izin'>('semua');
  const [trackCode, setTrackCode] = useState('');
  const [trackedSubmission, setTrackedSubmission] = useState<DocumentSubmission | null>(null);
  const [trackingError, setTrackingError] = useState('');

  const servicesList: ServiceItem[] = [
    {
      id: 'srv-1',
      title: 'Penerbitan KTP & Kartu Keluarga Baru',
      category: 'kependudukan',
      description: 'Pengurusan berkas pencatatan sipil perpindahan domisili, pembuatan KTP baru usia 17 tahun, serta pemecahan kartu keluarga mandiri.',
      duration: '2 - 3 Hari Kerja',
      cost: 'Gratis (Bebas Biaya)',
      iconName: 'IdCard',
      image: 'https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?q=80&w=700&auto=format&fit=crop',
      requirements: [
        'Isi formulir pendaftaran digital pengajuan sipil',
        'Unggah scan KTP asli / Surat Pengantar Kehilangan',
        'Fotokopi Kartu Keluarga lama',
        'Surat Pengantar RT/RW setempat yang ditandatangani basah'
      ]
    },
    {
      id: 'srv-2',
      title: 'Surat Keterangan Pengantar RT / RW',
      category: 'izin',
      description: 'Penerbitan surat pengantar umum guna peruntukan pengurusan pernikahan, pembuatan SKCK, surat keterangan usaha, ataupun ijin domisili sementara.',
      duration: '1 Jam (Instan)',
      cost: 'Gratis (Bebas Biaya)',
      iconName: 'FileText',
      image: 'https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=700&auto=format&fit=crop',
      requirements: [
        'NIK terdaftar valid di basis data kependudukan desa',
        'Scan asli KTP pemohon',
        'Deskripsi jelas mengenai maksud peruntukan surat pengantar'
      ]
    },
    {
      id: 'srv-3',
      title: 'Registrasi Akta Kelahiran Baru',
      category: 'kependudukan',
      description: 'Pelaporan kelahiran bayi dusun desa untuk diterbitkan dokumen pencatatan kutipan akta kelahiran resmi Kementerian Dalam Negeri.',
      duration: '3 - 5 Hari Kerja',
      cost: 'Gratis (Bebas Biaya)',
      iconName: 'Baby',
      image: 'https://images.unsplash.com/photo-1519689680058-324335c77ebe?q=80&w=700&auto=format&fit=crop',
      requirements: [
        'Surat keterangan kelahiran asli dari Bidan, Puskesmas, atau Rumah Sakit',
        'Fotokopi Buku Nikah / Kutipan Akta Perkawinan orang tua',
        'Scan KTP kedua orang tua kandung & minimal 2 orang saksi',
        'Scan Kartu Keluarga asli orang tua'
      ]
    },
    {
      id: 'srv-4',
      title: 'Permohonan Bantuan Sosial Mandiri',
      category: 'sosial',
      description: 'Pengajuan data warga kurang mampu berhak menerima jatah beras raskin, subsidi listrik desa, bantuan langsung tunai (BLT), serta program KIP desa.',
      duration: '7 Hari Kerja Verifikasi',
      cost: 'Gratis (Bebas Biaya)',
      iconName: 'Gift',
      image: 'https://images.unsplash.com/photo-1469571486040-0b3b27573b7f?q=80&w=700&auto=format&fit=crop',
      requirements: [
        'Surat Pernyataan Tidak Mampu ditandatangani RT & RW setempat',
        'Foto kondisi fisik rumah bagian tampak depan dan ruang tamu dalam',
        'KTP asli & Kartu Keluarga pemohon utama',
        'Slip gaji / Surat keterangan penghasilan bulanan di bawah upah minimum'
      ]
    },
    {
      id: 'srv-5',
      title: 'Izin Domisili Usaha Mikro & Niaga',
      category: 'izin',
      description: 'Penerbitan surat keterangan domisili usaha legalitas tingkat kelurahan/desa bagi pedagang mikro, UMKM industri rumahan, atau peternakan mandiri.',
      duration: '1 - 2 Hari Kerja',
      cost: 'Gratis (Bebas Biaya)',
      iconName: 'Building2',
      image: 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=700&auto=format&fit=crop',
      requirements: [
        'Scan KTP penanggung jawab usaha',
        'Foto fisik lokasi tempat usaha mikro',
        'Persetujuan tertulis bertandatangan tetangga radius terdekat usaha',
        'Surat pengantar kepemilikan lahan atau bukti perjanjian sewa tempat'
      ]
    }
  ];

  const filteredServices = servicesList.filter(service => {
    const matchesSearch = service.title.toLowerCase().includes(searchQuery.toLowerCase()) || 
                          service.description.toLowerCase().includes(searchQuery.toLowerCase());
    const matchesCategory = activeCategory === 'semua' || service.category === activeCategory;
    return matchesSearch && matchesCategory;
  });

  const handleTrackSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setTrackingError('');
    setTrackedSubmission(null);

    if (!trackCode) {
      setTrackingError('Masukkan Kode Pelacakan (Tracking Code) terlebih dahulu!');
      return;
    }

    const cleanCode = trackCode.trim();
    const found = submissionsList.find(sub => sub.trackingId.toLowerCase() === cleanCode.toLowerCase());

    if (found) {
      setTrackedSubmission(found);
    } else {
      setTrackingError('Kode Pelacakan tidak ditemukan! Silakan cek kembali penulisan kode Anda atau lakukan pengajuan baru.');
    }
  };

  const getStatusStep = (status: string) => {
    switch (status) {
      case 'Draft': return 1;
      case 'Diajukan': return 2;
      case 'Verifikasi': return 3;
      case 'Selesai': return 4;
      default: return 2;
    }
  };

  const getIcon = (name: string) => {
    switch (name) {
      case 'Baby': return <Baby size={22} />;
      case 'FileText': return <FileText size={22} />;
      case 'Gift': return <Gift size={22} />;
      case 'Building2': return <Building2 size={22} />;
      default: return <ClipboardCheck size={22} />;
    }
  };

  return (
    <div className="space-y-12">
      
      {/* 1. Header Hero Page */}
      <div className="text-center max-w-2xl mx-auto space-y-4">
        <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-semibold border border-emerald-200">
          <Sparkles size={13} className="text-emerald-600" /> Layanan Publik Digital Terpadu 24/7
        </span>
        <h1 className="font-display text-4xl font-extrabold tracking-tight text-gray-950">
          Administrasi Desa Berbasis Digital
        </h1>
        <p className="text-sm sm:text-base text-gray-500 leading-relaxed">
          Ajukan pengurusan berkas kependudukan, surat pengantar desa, administrasi akta pencatatan sipil, serta pendaftaran bantuan jaminan sosial secara transparan, mudah, dan bebas biaya pungutan liar.
        </p>
      </div>

      {/* 2. Track / Pelacakan Status Card */}
      <section className="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 shadow-sm max-w-3xl mx-auto">
        <div className="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
          <div className="w-10 h-10 rounded-xl bg-orange-50 text-orange-700 flex items-center justify-center">
            <ClipboardCheck size={20} />
          </div>
          <div>
            <h3 className="font-display text-base font-bold text-gray-900">Pelacakan Berkas Pengajuan</h3>
            <p className="text-[11px] text-gray-400">Pantau perkembangan status pengurusan surat administrasi Anda secara real-time</p>
          </div>
        </div>

        <form onSubmit={handleTrackSubmit} className="flex flex-col sm:flex-row gap-3">
          <input 
            type="text"
            value={trackCode}
            onChange={(e) => setTrackCode(e.target.value)}
            placeholder="Contoh: WD-SERVICES-5821 atau WD-SAMBAT-7482"
            className="flex-1 px-4.5 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all shadow-inner font-mono tracking-wide"
          />
          <button 
            type="submit"
            className="px-6 py-3 bg-gray-900 text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-black transition-all font-display shadow-sm flex items-center justify-center gap-1.5"
            id="track-submit-btn"
          >
            Lacak Berkas
          </button>
        </form>

        {trackingError && (
          <div className="mt-4 p-3 bg-red-50 text-red-700 rounded-xl text-xs flex items-center gap-2 border border-red-100">
            <AlertCircle size={16} />
            <span>{trackingError}</span>
          </div>
        )}

        {/* Dynamic Track Result Output */}
        <AnimatePresence>
          {trackedSubmission && (
            <motion.div 
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
              className="mt-8 pt-6 border-t border-gray-100 space-y-6 overflow-hidden"
              key={trackedSubmission.trackingId}
            >
              <div className="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100 flex flex-col sm:flex-row justify-between gap-3 text-xs">
                <div>
                  <p className="text-gray-400 font-semibold uppercase text-[10px]">Nama Pemohon</p>
                  <p className="font-extrabold text-gray-800 text-sm mt-0.5">{trackedSubmission.name}</p>
                </div>
                <div>
                  <p className="text-gray-400 font-semibold uppercase text-[10px]">Jenis Layanan</p>
                  <p className="font-extrabold text-gray-800 text-sm mt-0.5">{trackedSubmission.serviceName}</p>
                </div>
                <div>
                  <p className="text-gray-400 font-semibold uppercase text-[10px]">Nomor Pelacakan</p>
                  <p className="font-mono text-primary font-bold text-sm mt-0.5">{trackedSubmission.trackingId}</p>
                </div>
              </div>

              {/* Status Timeline */}
              <div className="space-y-4">
                <p className="text-xs font-bold text-gray-500 uppercase tracking-widest font-display">Timeline Progres Berkas</p>
                
                <div className="flex flex-col sm:flex-row justify-between items-center gap-6 px-4">
                  {/* Step Draft / Diajukan */}
                  <div className="flex sm:flex-col items-center gap-3 text-center">
                    <div className={`w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold ${
                      getStatusStep(trackedSubmission.status) >= 2 
                        ? 'bg-emerald-600 text-white' 
                        : 'bg-gray-100 text-gray-400'
                    }`}>
                      {getStatusStep(trackedSubmission.status) >= 2 ? <Check size={16} /> : '1'}
                    </div>
                    <div>
                      <p className="text-xs font-bold text-gray-800">Berkas Diajukan</p>
                      <p className="text-[10px] text-gray-400">{trackedSubmission.date}</p>
                    </div>
                  </div>

                  {/* Divider line */}
                  <div className={`hidden sm:block h-0.5 flex-1 ${getStatusStep(trackedSubmission.status) >= 3 ? 'bg-emerald-600' : 'bg-gray-200'}`} />

                  {/* Step Verification */}
                  <div className="flex sm:flex-col items-center gap-3 text-center">
                    <div className={`w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold ${
                      getStatusStep(trackedSubmission.status) >= 3 
                        ? 'bg-orange-500 text-white' 
                        : 'bg-gray-100 text-gray-400'
                    }`}>
                      {getStatusStep(trackedSubmission.status) >= 3 ? <Check size={16} /> : '2'}
                    </div>
                    <div>
                      <p className="text-xs font-bold text-gray-800">Verifikasi Berkas</p>
                      <p className="text-[10px] text-gray-400">{getStatusStep(trackedSubmission.status) >= 3 ? 'Sedang Diproses' : 'Menunggu Antrean'}</p>
                    </div>
                  </div>

                  {/* Divider line */}
                  <div className={`hidden sm:block h-0.5 flex-1 ${getStatusStep(trackedSubmission.status) >= 4 ? 'bg-emerald-600' : 'bg-gray-200'}`} />

                  {/* Step Done */}
                  <div className="flex sm:flex-col items-center gap-3 text-center">
                    <div className={`w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold ${
                      getStatusStep(trackedSubmission.status) >= 4 
                        ? 'bg-emerald-600 text-white' 
                        : 'bg-gray-100 text-gray-400'
                    }`}>
                      {getStatusStep(trackedSubmission.status) >= 4 ? <Check size={16} /> : '3'}
                    </div>
                    <div>
                      <p className="text-xs font-bold text-gray-800">Selesai / Siap Diambil</p>
                      <p className="text-[10px] text-gray-400">{getStatusStep(trackedSubmission.status) >= 4 ? 'Silakan ke Balai Desa' : 'Menunggu Verifikasi'}</p>
                    </div>
                  </div>
                </div>

              </div>

              {/* Status Note card */}
              <div className="p-3.5 bg-yellow-50/50 border border-yellow-100 text-xs rounded-xl text-yellow-800 space-y-1">
                <span className="font-bold flex items-center gap-1">📌 Catatan Petugas Administrasi:</span>
                <p className="leading-relaxed font-sans">{trackedSubmission.notes}</p>
              </div>

            </motion.div>
          )}
        </AnimatePresence>

        {trackedSubmission === null && submissionsList.length > 0 && (
          <div className="mt-5 text-center">
            <span className="text-[10px] bg-emerald-50 border border-emerald-100 text-emerald-700 font-bold px-3 py-1 rounded-full shrink-0">
              💡 Tip: Ada {submissionsList.length} berkas demo terdaftar di sesi lokal ini. Coba lacak nomor pengisian demo di bawah.
            </span>
            <div className="flex flex-wrap justify-center gap-2 mt-2">
              {submissionsList.slice(-3).map(sub => (
                <button 
                  key={sub.id} 
                  onClick={() => { setTrackCode(sub.trackingId); setTrackedSubmission(sub); }}
                  className="font-mono text-[10px] bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-2 py-0.5 rounded cursor-pointer"
                >
                  {sub.trackingId}
                </button>
              ))}
            </div>
          </div>
        )}
      </section>

      {/* 3. Category Buttons */}
      <section className="space-y-6">
        <div className="flex flex-wrap justify-center gap-2">
          {([
            { id: 'semua', label: '📂 Semua Layanan' },
            { id: 'kependudukan', label: '👨‍👩‍👧 Kependudukan (KTP/KK)' },
            { id: 'sosial', label: '🤝 Bantuan Sosial (Bansos)' },
            { id: 'izin', label: '📁 Surat Pengantar & Ijin' }
          ] as const).map((cat) => (
            <button
              key={cat.id}
              onClick={() => setActiveCategory(cat.id)}
              className={`px-5 py-2.5 rounded-full font-bold text-xs uppercase tracking-wider transition-all shadow-sm ${
                activeCategory === cat.id 
                  ? 'bg-primary text-white scale-105' 
                  : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-100'
              }`}
            >
              {cat.label}
            </button>
          ))}
        </div>

        {/* 4. Services Grid List */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {filteredServices.length > 0 ? (
            filteredServices.map((service) => (
              <motion.div
                key={service.id}
                layout
                whileHover={{ y: -5 }}
                className="bg-white rounded-2xl overflow-hidden border border-gray-100/80 shadow-sm hover:shadow-lg transition-all flex flex-col justify-between"
                id={`service-card-${service.id}`}
              >
                {/* Thumbnail Header Image */}
                <div className="aspect-[16/9] relative bg-emerald-50 overflow-hidden">
                  <img src={service.image} alt={service.title} className="w-full h-full object-cover" />
                  <div className="absolute top-3 left-3 px-2.5 py-1 bg-white/90 text-primary font-bold text-[10px] uppercase tracking-wide rounded-full shadow-sm backdrop-blur-sm">
                    {service.category}
                  </div>
                </div>

                {/* Info block */}
                <div className="p-5 flex-1 space-y-4 text-left">
                  <div className="flex items-start gap-3">
                    <div className="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100/50 text-emerald-800 flex items-center justify-center flex-shrink-0">
                      {getIcon(service.iconName)}
                    </div>
                    <div>
                      <h4 className="font-display font-bold text-sm text-gray-900 leading-snug line-clamp-2">
                        {service.title}
                      </h4>
                      <p className="text-[10px] text-gray-400 mt-1 uppercase font-semibold font-mono">Estimasi: {service.duration}</p>
                    </div>
                  </div>

                  <p className="text-[11px] leading-relaxed text-gray-500 font-sans line-clamp-3">
                    {service.description}
                  </p>

                  <div className="bg-gray-50 p-3 rounded-xl border border-gray-100 space-y-1.5">
                    <p className="text-[10px] font-bold text-gray-400 uppercase tracking-widest font-display">Persyaratan Utama:</p>
                    <ul className="text-[10px] text-gray-600 space-y-1 list-disc list-inside">
                      {service.requirements.slice(0, 3).map((req, idx) => (
                        <li key={idx} className="truncate">{req}</li>
                      ))}
                      {service.requirements.length > 3 && (
                        <li className="text-primary font-bold italic font-mono">+ {service.requirements.length - 3} Berkas Pendukung</li>
                      )}
                    </ul>
                  </div>
                </div>

                {/* Footer Apply Trigger */}
                <div className="p-5 border-t border-gray-50 flex items-center justify-between bg-gray-50/20">
                  <span className="text-xs font-bold text-emerald-700 font-mono">
                    {service.cost}
                  </span>

                  <button 
                    onClick={() => onSelectService(service)}
                    className="px-5 py-2.5 bg-primary text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:opacity-90 active:scale-95 transition-all font-display shadow-sm flex items-center gap-1"
                    id={`apply-now-btn-${service.id}`}
                  >
                    Ajukan Sekarang <ArrowRight size={13} />
                  </button>
                </div>
              </motion.div>
            ))
          ) : (
            <div className="col-span-full py-16 text-center space-y-3">
              <span className="text-4xl">🔍</span>
              <p className="text-sm font-bold text-gray-600">Layanan desa tidak ditemukan</p>
              <p className="text-xs text-gray-400">Silakan coba kata kunci penelusuran yang lain atau hubungi lobi kelurahan.</p>
            </div>
          )}
        </div>
      </section>

    </div>
  );
}
