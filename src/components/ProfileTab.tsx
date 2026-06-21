import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { 
  Users, Smartphone, Sprout, MapPin, Milestone, ArrowRight, 
  Mail, Phone, Trophy, ExternalLink, Activity, Sparkles, X, ChevronDown, CheckCircle
} from 'lucide-react';
import { AppTab } from '../types';

interface ProfileTabProps {
  onTabChange: (tab: AppTab) => void;
}

export default function ProfileTab({ onTabChange }: ProfileTabProps) {
  const [selectedStaff, setSelectedStaff] = useState<any | null>(null);
  const [showOrgModal, setShowOrgModal] = useState(false);
  const [activeGeoView, setActiveGeoView] = useState<'kependudukan' | 'wilayah' | 'potensi'>('kependudukan');

  const staffList = [
    {
      name: 'Ir. H. Ahmad Fauzi',
      role: 'Kepala Desa',
      detailRole: 'Pimpinan Tertinggi Desa',
      image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuALY1rhacXYRMqFmHMMTqV1F9amgBTviCav8bJfRDBIGWBeMdbF0XyC99s7B1b0Doi_zz3Obh3kU9ZS4VaSkPD9uZkO8UTWt5DBOqfR5hqCqRdTe-sFVIKbmwHKz49Yd2puwzjXn7tiKOkBzSxNq6BpGM3huUhcAASw8eCi4sZ9exnWPEQM3A2O3xBtiFCv0dNN8oeqp0UKLJKzauy873yDJERBKhZWcNZYWtjRSJj9-uSA33H-L6kIyo1n_QWyzT7OmA25W_NPBlY',
      phone: '+62 811-4433-221',
      email: 'ahmadfauzi@webdesa.go.id',
      bio: 'Lahir di Sukamaju, mengabdi selama lebih dari 15 tahun di bidang tata pamong desa. Lulusan Teknik Sipil Institut Teknologi dengan fokus pembangunan infrastruktur pedesaan ramah lingkungan.',
      tugas: [
        'Memimpin penyelenggaraan pemerintahan desa berdasarkan kebijakan yang ditetapkan bersama BPD.',
        'Mengajukan rancangan peraturan desa menetapkan APBDesa.',
        'Membina ketentraman dan ketertiban masyarakat desa.'
      ]
    },
    {
      name: 'Siti Aminah, S.E.',
      role: 'Sekretaris Desa',
      detailRole: 'Kepala Sekretariat & Administrasi Umum',
      image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDUETgEGPI_HAkJ8-UkUUFUU8OK0Ir3iSy58vJsjacBCVSHkwDIiMVeyxRMRKEX8-cwiM3pBRPJFsFFBQxJhL6QpnfI0cVLJzvmUtjSRQLHbAnu9xBHOR1ypSlAhv3PtNHaR0_AK-AEs4gO2yV106map7BL-22Seabv9SndhIhI2zMKQ6IFarv36eaMrtnQMTFoR_8Mptyu3re-59jBukgTAQSb9Pggp7TzYxwmAayNxixOYVHfq6fW4pZmp8t85ahm9qky52ytnsE',
      phone: '+62 812-5566-778',
      email: 'sitiaminah@webdesa.go.id',
      bio: 'Ahli administrasi keuangan publik daerah, berpengalaman menyusun Laporan Penyelenggaraan Pemerintahan Desa (LPPD) berstandar nasional.',
      tugas: [
        'Mengoordinasikan tugas-tugas kepala seksi pembinaan administrasi.',
        'Menyusun draf peraturan desa serta mengelola arsip desa.',
        'Mempersiapkan rapat-rapat kerja koordinasi aparat desa.'
      ]
    },
    {
      name: 'Rahmat Hidayat',
      role: 'Bendahara Desa',
      detailRole: 'Kepala Urusan Keuangan',
      image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCI3XpHDI-msIS1rD52uvXzmeWAJFBhAlScxg5E72Wr6jW7lgjpj5jAcsdCt-SiKBayJggnkWKLuxCGka0t3AMa0vPlInMOmoBkS8jgWI53MveGzM0gbzD-bBO0KyDfi-5T92qXoAro984EwdEL9F-folLKIReB3ITtHDpkCeeEvBBtFfdO1vR4b6eWxpKN6YAgaJm89oaGil1yLrHxBTB9hMf9NOrgxjIxWZ1c_KPAQym2GLBCEh1KgP8YYQoxwCCO9e_uqUwVhT0',
      phone: '+62 813-8877-665',
      email: 'rahmathidayat@webdesa.go.id',
      bio: 'Mengelola anggaran pendapatan dan belanja desa (APBDes) secara transparan. Terkenal jujur dan tegas dalam audit keuangan warga.',
      tugas: [
        'Menerima, menyimpan, menyetorkan, serta membayarkan dana desa.',
        'Menyelenggarakan pembukuan keuangan kas desa secara periodik.',
        'Melaporkan realisasi penyerapan dana pajak & bantuan pemerintah.'
      ]
    },
    {
      name: 'Budi Santoso, S.T.',
      role: 'Kaur Perencanaan',
      detailRole: 'Kepala Urusan Perencanaan Pembangunan',
      image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDHXLEHAFaVz6IRJQLxcNGttoK5JimoDXIrt_TGek6HI0O4W-ZDq_EzvGWAYS-4e8NDplgUy4ituS-UBSqkQZsM0cCQoYtrgt_XsNYA3KJjhyBuEixI9WzhQdM1fQUEuC1CWek19yXUtUmNEGw_rMs9ASypCYfmxjuoYFNR9Ier22PJZdypMSy7TYhMX9sZBqKVRHMIiJuV_rUGNXKTpA0-tZQFBnekbQiaR13xPB_5RfbjD-0pbefudYYLZ16vS7XU14TIUHoovWQ',
      phone: '+62 856-1122-334',
      email: 'budisantoso@webdesa.go.id',
      bio: 'Sarjana arsitektur wilayah pengembangan pedesaan. Merancang peta tata guna lahan digital serta sistem tata air modern untuk sawah pertanian.',
      tugas: [
        'Menyusun Rencana Kerja Pembangunan Desa (RKPDesa) tahunan.',
        'Menyiapkan rancangan usulan musyawarah perencanaan pembangunan (Musrenbang).',
        'Mengawasi pengerjaan instalasi fisik infrastruktur umum.'
      ]
    },
    {
      name: 'Dewi Lestari',
      role: 'Kaur Umum',
      detailRole: 'Kepala Urusan Tata Usaha & Urusan Umum',
      image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuD3QnTa_CKM1RVk5VZoUn2ZKLP0nmfVsNbPXFoSXroJw89PlUNYM2TtuhBbkSDWsJLGR3nrqgOnJdiy2axVHkg8b1DcJkTSke3-pe6PhkoCus59nQLIQjsN63YW0BZFOknthSc4ENOEujNSjw1v9zM0qAq3viUXMErGnkSRTUrY33XDCNQ3m6Y1LgTjsNZJueyfcvhRcRr5kNP5IFxAKdvjiHvS0CcFvmgQB_XBKo7feYmAszfzLuq5TKy6rGDJUAnX41BokxYfdiw',
      phone: '+62 821-3344-556',
      email: 'dewilestari@webdesa.go.id',
      bio: 'Fokus pada pelayanan internal, manajemen kehumasan, penyediaan sarana operasional balai desa, dan mengurusi inventarisasi aset desa.',
      tugas: [
        'Mengelola surat menyurat keluar masuk serta urusan rumah tangga balai desa.',
        'Melakukan inventarisasi dan mencatat pendaftaran tanah kas desa.',
        'Memberikan dukungan administratif untuk upacara adat dan agenda penting.'
      ]
    }
  ];

  return (
    <div className="space-y-4">
      {/* 1. Hero Section */}
      <section className="relative overflow-hidden rounded-3xl bg-emerald-950 text-white min-h-[480px] flex items-center shadow-xl">
        <div className="absolute inset-0 z-0">
          <img 
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVIiHqkwc4q7FoIbLy_URotVT9QfNZoHKwtq6oDZc8XXcyGKfYHNEFEwA-goag4NHXXqfbHS8StbVkSvTRPcBJtAwkvxD69xjkXnJhDeYlQQcsswHAa_uKpyzrp4fgfuUft5YdaRkYBh1j3BnVCOigTICgWkoCLKHGbyBed_Q25zHoBqhdaxv493uqVT52QZp_Yw5YRpwF6fNhV2jQQRCQ_YCbcDfsp6Nrqyk6E_kF_V8YKB2_1kE5UScyrh8n8s5LjpOzTWM-V_U" 
            alt="Desa Teropong Sunrise" 
            className="w-full h-full object-cover opacity-35 scale-105 transition-all duration-1000 select-none"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/70 to-transparent" />
        </div>

        <div className="relative z-10 max-w-4xl mx-auto text-center px-6 py-20 space-y-6">
          <motion.div 
            initial={{ opacity: 0, y: 15 }}
            animate={{ opacity: 1, y: 0 }}
            className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-xs font-semibold backdrop-blur-sm shadow-sm"
          >
            <Sparkles size={14} /> Selayang Pandang WebDesa Sukamaju
          </motion.div>
          
          <motion.h1 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.1 }}
            className="font-display text-3xl sm:text-5xl md:text-6xl font-extrabold tracking-tight leading-[1.1] text-white"
          >
            Mengenal Lebih Dekat <br />
            <span className="text-[#ffdf41] font-black underline decoration-wavy decoration-[#38a130] decoration-2">Desa Kami</span> yang Asri &amp; Berdaya
          </motion.h1>
          
          <motion.p 
            initial={{ opacity: 0, y: 25 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.2 }}
            className="text-sm sm:text-lg text-emerald-100/90 max-w-2xl mx-auto font-sans leading-relaxed"
          >
            Menelusuri jejak sejarah yang melegenda, visi masa depan digital yang modern, serta dedikasi tulus seluruh aparatur pemerintah desa dalam melayani segenap kearifan masyarakat lokal.
          </motion.p>

          <motion.div 
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ delay: 0.3 }}
            className="pt-4 flex flex-wrap justify-center gap-3"
          >
            <button 
              onClick={() => onTabChange('services')}
              className="px-6 py-3 bg-[#ffdf41] text-emerald-950 font-bold text-xs uppercase tracking-wider rounded-full hover:bg-white hover:scale-105 active:scale-95 transition-all shadow-md font-display"
              id="hero-services-btn"
            >
              Lihat Layanan Digital <ArrowRight className="inline-block" size={14} />
            </button>
            <a 
              href="#sejarah-desa" 
              className="px-6 py-3 bg-emerald-800/80 text-white font-semibold text-xs uppercase tracking-wider rounded-full border border-emerald-700/50 hover:bg-emerald-800 transition-all text-center"
            >
              Telusuri Sejarah ↓
            </a>
          </motion.div>
        </div>
      </section>

      {/* 2. Sejarah Desa Column */}
      <section id="sejarah-desa" className="py-20 border-b border-gray-100 scroll-smooth">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Left Art frame */}
          <div className="lg:col-span-5 relative">
            <div className="aspect-square rounded-2xl overflow-hidden shadow-2xl relative border-8 border-white p-1 bg-gray-50 bg-gradient-to-tr from-emerald-100 to-white">
              <img 
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAiy7tiJieFtG2l5QRe3KicDXG_fCeWQ-C9BY0WqHvYeXGMPKAe8xWn4EASYznz9Gtk3-x038BbKqvg-CBHM73MOjdoRwQOIzq424Ek93HlT889hTOydG8rfWC0chTqJBjnJJr4T5QNL0upc2RaP6gcWc8sKM0gpWuyoVWDrW9yFx8hBwvs1B9C9zT_Fo48vvO7TIpz422EPbh4W7JF0nZgPX12k7iKTU6JffUH0eAxZb0i_BwyzUoCMnC7wZx7HCZjFtl_acna4c" 
                alt="Beringin Tua Desa Bersejarah" 
                className="w-full h-full object-cover hover:scale-105 transition-all duration-700"
              />
              <div className="absolute inset-0 bg-emerald-950/10 pointer-events-none" />
            </div>

            {/* Asymmetric Quote card */}
            <div className="absolute -bottom-8 lg:right-[-40px] bg-emerald-900 text-[#e6f4e4] p-6 rounded-2xl shadow-xl w-64 border border-emerald-800 font-serif leading-relaxed italic transform rotate-[-2deg]">
              <p className="text-sm">
                "Berawal dari tiga keluarga pengembara di lereng perbukitan selatan, menembus sejarah lewat kokohnya tali persaudaraan..."
              </p>
            </div>
          </div>

          {/* Right Text */}
          <div className="lg:col-span-7 space-y-5 lg:pl-10">
            <span className="inline-block px-3.5 py-1 bg-[#ffdf41]/10 text-yellow-700 rounded-full font-bold text-[11px] uppercase tracking-wider border border-[#ffdf41]/25">
              SEJARAH DESA
            </span>
            <h2 className="font-display text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
              Asal-Usul &amp; Perkembangan Wilayah
            </h2>

            <div className="space-y-4 text-xs sm:text-sm text-gray-600 leading-relaxed font-sans">
              <p>
                Desa ini dirintis pada pertengahan abad ke-18 oleh tiga bersaudara beraliran agraris yang melakukan babat alas di wilayah lereng perbukitan subur. Dengan semangat kekeluargaan yang tinggi dan prinsip gotong-royong, daerah yang dulunya berupa hutan belantara kini bertransformasi menjadi lumbung pangan andalan pariwisata daerah.
              </p>
              <p>
                Selama masa perjuangan kemerdekaan, sejarah mencatat desa kami sebagai pertahanan logistik pejuang rakyat karena melimpahnya sumber air pegunungan alami serta hasil tani. Warisan kegigihan tersebut mengakar erat dalam diri warga kami hingga kini: tangguh menghadapi bencana, mandiri berwirausaha, serta menjunjung tinggi tata krama kesopanan daerah.
              </p>
              <p>
                Melalui program digitalisasi terpadu, WebDesa diresmikan demi mewujudkan tata kela administrasi desa yang bersih, cepat, transparan dari mana saja tanpa meninggalkan akar kearifan lokal yang luhur.
              </p>
            </div>
          </div>

        </div>
      </section>

      {/* 3. Visi & Misi Bento Grid */}
      <section className="py-20 border-b border-gray-100">
        <div className="text-center max-w-xl mx-auto space-y-3 mb-16">
          <span className="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display">Arah &amp; Sasaran Pembangunan</span>
          <h2 className="font-display text-3xl font-extrabold text-gray-950">Visi &amp; Misi Utama</h2>
          <p className="text-xs sm:text-sm text-gray-500">Komitmen tulus pemerintah desa demi peningkatan kualitas hidup masyarakat yang berkelanjutan.</p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          
          {/* Main Visi card */}
          <div className="md:col-span-3 bg-gradient-to-r from-emerald-950 to-emerald-900 p-8 sm:p-10 rounded-2xl text-center relative overflow-hidden group border border-emerald-800 shadow-lg text-white">
            <div className="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 rounded-full translate-x-1/3 -translate-y-1/3 group-hover:scale-105 transition-transform duration-700" />
            <div className="absolute bottom-0 left-0 w-64 h-64 bg-emerald-700/15 rounded-full -translate-x-1/4 translate-y-1/4 pointer-events-none" />
            
            <span className="inline-block p-3 rounded-2xl bg-white/10 text-[#ffdf41] mb-4">
              <Milestone size={32} />
            </span>
            <h3 className="font-display text-xl sm:text-2xl font-bold tracking-tight text-white mb-4">Visi Pembangunan Desa</h3>
            <p className="font-serif text-base sm:text-xl text-emerald-100 italic max-w-2xl mx-auto leading-relaxed">
              "Mewujudkan Desa Mandiri yang Berbasis Digitalisasi Pelayanan Terpadu, Berkarakter Adat Budaya, serta Sejahtera Lahir Batin Secara Merata Pada Tahun 2029."
            </p>
          </div>

          {/* Misi Item 1 */}
          <div className="p-6 rounded-2xl bg-white border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition-shadow">
            <div className="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 border border-emerald-100 flex-shrink-0">
              <Users size={22} />
            </div>
            <h4 className="font-display text-base font-bold text-gray-900 mb-2">Pemberdayaan Masyarakat</h4>
            <p className="text-xs text-gray-500 leading-relaxed">
              Membangun kemandirian ekonomi warga melalui forum Musrenbang yang inklusif, pendampingan UMKM, kelompok tani, sertifikasi keahlian, dan pemerataan bantuan modal produktif kerja.
            </p>
          </div>

          {/* Misi Item 2 */}
          <div className="p-6 rounded-2xl bg-white border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition-shadow">
            <div className="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 border border-emerald-100 flex-shrink-0">
              <Smartphone size={22} />
            </div>
            <h4 className="font-display text-base font-bold text-gray-900 mb-2">Digitalisasi Pelayanan</h4>
            <p className="text-xs text-gray-500 leading-relaxed">
              Mengadopsi pemanfaatan teknologi informasi untuk mempermudah akses layanan keadministrasian kependudukan, pengaduan keluhan, serta efisiensi transparansi dana tunai anggaran desa.
            </p>
          </div>

          {/* Misi Item 3 */}
          <div className="p-6 rounded-2xl bg-white border border-gray-100 shadow-sm flex flex-col hover:shadow-md transition-shadow">
            <div className="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-5 border border-emerald-100 flex-shrink-0">
              <Sprout size={22} />
            </div>
            <h4 className="font-display text-base font-bold text-gray-900 mb-2">Lingkungan yang Asri</h4>
            <p className="text-xs text-gray-500 leading-relaxed">
              Menjaga kelestarian lingkungan hidup dan sumber daya alam hayati lewat program penghijauan hulu sungai, penataan limbah sampah warga mandiri, serta konservasi sawah beririgasi.
            </p>
          </div>

        </div>
      </section>

      {/* 4. Struktur Organisasi */}
      <section className="py-20 border-b border-gray-100">
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
          <div className="space-y-2">
            <span className="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display">Aparatur Berintegritas</span>
            <h2 className="font-display text-3xl font-extrabold text-gray-950">Struktur Urusan Kepengurusan</h2>
            <p className="text-xs sm:text-sm text-gray-500">Pemerintah Desa Terpilih yang mengemban tugas amanah masa bakti 2021 - 2027.</p>
          </div>

          <button 
            onClick={() => setShowOrgModal(true)} 
            className="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-bold hover:bg-emerald-100 hover:scale-105 active:scale-95 transition-all w-fit font-display shadow-sm uppercase tracking-wide"
            id="open-org-diagram-btn"
          >
            Lihat Bagan Lengkap <ArrowRight size={14} />
          </button>
        </div>

        {/* Focus kepala desa */}
        <div className="flex justify-center mb-12">
          <motion.div 
            whileHover={{ y: -5 }}
            onClick={() => setSelectedStaff(staffList[0])}
            className="w-full max-w-sm p-6 rounded-2xl border border-emerald-100/30 bg-emerald-50/50 hover:bg-emerald-50 text-center flex flex-col items-center shadow-md relative cursor-pointer group hover:border-emerald-200 transition-all"
            id="staff-leader-card"
          >
            <div className="w-28 h-28 rounded-full overflow-hidden border-4 border-white shadow-md relative z-10 flex-shrink-0 bg-gray-100">
              <img 
                src={staffList[0].image} 
                alt={staffList[0].name} 
                className="w-full h-full object-cover group-hover:scale-105 transition-all duration-300"
              />
            </div>
            
            <div className="mt-4 space-y-1">
              <h4 className="font-display text-lg font-extrabold text-gray-900 leading-none">{staffList[0].name}</h4>
              <p className="text-xs font-bold text-emerald-800 uppercase tracking-widest font-display">{staffList[0].role}</p>
              <p className="text-[10px] text-gray-400 mt-1">✨ Klik untuk detail tanggung jawab</p>
            </div>

            <div className="flex gap-2 justify-center pt-3 mt-4 border-t border-gray-100 w-full text-gray-400">
              <a href={`mailto:${staffList[0].email}`} className="p-2 rounded-full hover:bg-white hover:text-emerald-700 transition-all shadow-sm">
                <Mail size={15} />
              </a>
              <a href={`tel:${staffList[0].phone}`} className="p-2 rounded-full hover:bg-white hover:text-emerald-700 transition-all shadow-sm">
                <Phone size={15} />
              </a>
            </div>
          </motion.div>
        </div>

        {/* Staff Grid */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
          {staffList.slice(1).map((staff, index) => (
            <motion.div
              key={index}
              whileHover={{ y: -5 }}
              onClick={() => setSelectedStaff(staff)}
              className="p-5 rounded-2xl bg-white border border-gray-100 text-center flex flex-col items-center hover:shadow-md cursor-pointer transition-all hover:bg-gray-50/50 group"
              id={`staff-card-${index}`}
            >
              <div className="w-20 h-20 rounded-full overflow-hidden border-2 border-emerald-100/50 shadow-sm relative z-10 flex-shrink-0 bg-gray-100 mb-3">
                <img 
                  src={staff.image} 
                  alt={staff.name} 
                  className="w-full h-full object-cover group-hover:scale-105 transition-all duration-300"
                />
              </div>
              <h5 className="font-display text-xs sm:text-sm font-extrabold text-gray-900 tracking-tight leading-snug">{staff.name}</h5>
              <p className="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-display mt-1">{staff.role}</p>
            </motion.div>
          ))}
        </div>
      </section>

      {/* 5. Geografis & Demografis */}
      <section className="py-20">
        <div className="text-center max-w-xl mx-auto space-y-3 mb-16">
          <span className="text-xs font-bold text-emerald-700 tracking-widest uppercase font-display">Luas &amp; Penduduk Wilayah</span>
          <h2 className="font-display text-3xl font-extrabold text-gray-950">Geografis &amp; Demografis</h2>
          <p className="text-xs sm:text-sm text-gray-500">Kondisi topografi tanah serta persebaran diagram penduduk desa kami.</p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          {/* Geografis Box */}
          <div className="lg:col-span-6 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">
            <div className="flex items-center gap-2.5">
              <div className="p-2.5 rounded-xl bg-emerald-50 text-emerald-700">
                <MapPin size={20} />
              </div>
              <div>
                <h3 className="font-display text-base font-bold text-gray-900">Wilayah Batas Teritorial</h3>
                <p className="text-[11px] text-gray-400">Total Luas Daerah: 1,240 Hektar</p>
              </div>
            </div>

            {/* Simulated Satellite Map */}
            <div className="aspect-[16/10] rounded-xl overflow-hidden relative border border-gray-100 shadow-inner group">
              <img 
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjvGNSvxEQ_Y2tGNZFrOIkSHXZADGKntB9v_q-kMHdHsjRzQ_k1ebWokxvdv2PCEpuNlACaYdbAXrrifjeqQMVzADcDwgVTx3FBhXnHhDcj_WlxxWnidizr-ovl9p3wMr_8PYvVkbL3iGOqBQ4bs2eGhDRVDZaNWy08lclTXZXILxYsoRtCM8zXFjoWZs5hxC5f6Vroveqo5MMGpe38jyskYbSYbaQ1t3SLwimok2JeYcfVIWGCEX5jmHlzFxXzURETCF2k_qi3A0" 
                alt="Peta Satelit Wilayah Desa" 
                className="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 select-none"
              />
              <div className="absolute inset-0 bg-emerald-950/5 pointer-events-none" />
              
              {/* Overlay boundaries legend */}
              <div className="absolute top-3 right-3 bg-white/90 p-3 rounded-lg border border-gray-100 shadow-sm max-w-[170px] text-[10px] space-y-1.5 backdrop-blur-sm pointer-events-none">
                <p className="font-bold text-gray-700 border-b border-gray-200 pb-1 mb-1 font-display">BATAS WILAYAH</p>
                <div className="flex items-center gap-1.5"><span className="w-2 h-2 rounded-full bg-red-500" /> <span>Utara: Desa Makmur</span></div>
                <div className="flex items-center gap-1.5"><span className="w-2 h-2 rounded-full bg-blue-500" /> <span>Timur: Kec. Harapan</span></div>
                <div className="flex items-center gap-1.5"><span className="w-2 h-2 rounded-full bg-emerald-500" /> <span>Selatan: Hutan Lindung</span></div>
              </div>
            </div>

            {/* Quick stats columns */}
            <div className="grid grid-cols-2 gap-4">
              <div className="p-4 rounded-xl border border-gray-100 bg-gray-50/55 text-center">
                <p className="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-display">Luas Wilayah</p>
                <p className="text-lg font-extrabold text-emerald-800">1,240 Ha</p>
              </div>
              <div className="p-4 rounded-xl border border-gray-100 bg-gray-50/55 text-center">
                <p className="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-display">Ketinggian Rata-Rata</p>
                <p className="text-lg font-extrabold text-emerald-800">450 MDPL</p>
              </div>
            </div>
          </div>

          {/* Demografis Box */}
          <div className="lg:col-span-6 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between min-h-[440px]">
            <div className="space-y-6">
              <div className="flex justify-between items-center">
                <div className="flex items-center gap-2.5">
                  <div className="p-2.5 rounded-xl bg-orange-50 text-orange-700">
                    <Activity size={20} />
                  </div>
                  <div>
                    <h3 className="font-display text-base font-bold text-gray-900">Statistik Kependudukan</h3>
                    <p className="text-[11px] text-gray-400">Total: <span className="font-bold text-emerald-700">4,829 Jiwa</span></p>
                  </div>
                </div>
                
                {/* Visual view toggles */}
                <div className="flex gap-1 bg-gray-100 rounded-full p-1 text-[10px] font-bold">
                  <button 
                    onClick={() => setActiveGeoView('kependudukan')}
                    className={`px-3 py-1 rounded-full ${activeGeoView === 'kependudukan' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500'}`}
                  >
                    Usia &amp; Gender
                  </button>
                  <button 
                    onClick={() => setActiveGeoView('potensi')}
                    className={`px-3 py-1 rounded-full ${activeGeoView === 'potensi' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500'}`}
                  >
                    Mata Pencaharian
                  </button>
                </div>
              </div>

              <AnimatePresence mode="wait">
                {activeGeoView === 'kependudukan' ? (
                  <motion.div 
                    key="gender-age"
                    initial={{ opacity: 0, y: 10 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: -10 }}
                    className="space-y-6"
                  >
                    {/* Gender ratio bar */}
                    <div className="space-y-2">
                      <div className="flex justify-between text-xs font-semibold text-gray-700">
                        <span className="flex items-center gap-1">👨 Laki-laki: 2,450 (51%)</span>
                        <span className="flex items-center gap-1">👩 Perempuan: 2,379 (49%)</span>
                      </div>
                      <div className="h-6.5 w-full bg-gray-100 rounded-full overflow-hidden flex shadow-inner p-1">
                        <div className="h-full bg-emerald-700 rounded-l-full flex items-center justify-center text-[10px] font-bold text-white transition-all" style={{ width: '51%' }}>51%</div>
                        <div className="h-full bg-[#fca26e] rounded-r-full flex items-center justify-center text-[10px] font-bold text-emerald-950 transition-all" style={{ width: '49%' }}>49%</div>
                      </div>
                    </div>

                    {/* Age group bars */}
                    <div className="space-y-3">
                      <p className="text-xs font-bold text-gray-500 uppercase tracking-widest font-display">Kelompok Golongan Usia</p>
                      
                      {/* Age group 1 */}
                      <div className="space-y-1">
                        <div className="flex justify-between text-xs text-gray-600">
                          <span>Anak-Anak (0-18 Tahun)</span>
                          <span className="font-bold text-emerald-900">25% (1.207 jiwa)</span>
                        </div>
                        <div className="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                          <div className="h-full bg-emerald-600 transition-all" style={{ width: '25%' }} />
                        </div>
                      </div>

                      {/* Age group 2 */}
                      <div className="space-y-1">
                        <div className="flex justify-between text-xs text-gray-600">
                          <span>Usia Produktif (19-55 Tahun)</span>
                          <span className="font-bold text-emerald-900 font-display">60% (2.897 jiwa)</span>
                        </div>
                        <div className="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                          <div className="h-full bg-primary-light transition-all" style={{ width: '60%' }} />
                        </div>
                      </div>

                      {/* Age group 3 */}
                      <div className="space-y-1">
                        <div className="flex justify-between text-xs text-gray-600">
                          <span>Lansia (&gt; 55 Tahun)</span>
                          <span className="font-bold text-emerald-900">15% (725 jiwa)</span>
                        </div>
                        <div className="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                          <div className="h-full bg-[#ffdf41] transition-all" style={{ width: '15%' }} />
                        </div>
                      </div>
                    </div>
                  </motion.div>
                ) : (
                  <motion.div 
                    key="pencaharian-details"
                    initial={{ opacity: 0, y: 10 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: -10 }}
                    className="space-y-4"
                  >
                    <p className="text-xs font-bold text-gray-500 uppercase tracking-widest font-display mb-2">Sebaran Lapangan Pekerjaan Utama</p>
                    
                    <div className="grid grid-cols-2 gap-4">
                      
                      <div className="p-4 rounded-xl border border-gray-100 bg-emerald-50/30 flex gap-3 items-center">
                        <span className="text-2xl">🌾</span>
                        <div>
                          <p className="text-xs text-gray-400">Petani &amp; Pekebun</p>
                          <p className="text-xl font-bold text-emerald-800 font-display">72%</p>
                        </div>
                      </div>

                      <div className="p-4 rounded-xl border border-gray-100 bg-orange-50/30 flex gap-3 items-center">
                        <span className="text-2xl">🏪</span>
                        <div>
                          <p className="text-xs text-gray-400">Pedagang Mandiri</p>
                          <p className="text-xl font-bold text-orange-850 font-display">18%</p>
                        </div>
                      </div>

                      <div className="p-4 rounded-xl border border-gray-100 bg-blue-50/30 flex gap-3 items-center">
                        <span className="text-2xl">🏗️</span>
                        <div>
                          <p className="text-xs text-gray-400">Buruh &amp; Konstruksi</p>
                          <p className="text-xl font-bold text-blue-800">6%</p>
                        </div>
                      </div>

                      <div className="p-4 rounded-xl border border-gray-100 bg-yellow-50/30 flex gap-3 items-center">
                        <span className="text-2xl">💼</span>
                        <div>
                          <p className="text-xs text-gray-400">PNS / TNI / Swasta</p>
                          <p className="text-xl font-bold text-yellow-700">4%</p>
                        </div>
                      </div>

                    </div>

                    <div className="p-3 bg-gray-50 rounded-lg text-[10px] text-[#4d514e]">
                      💡 Mayoritas lahan adalah sawah basah, sehingga mayoritas penduduk bermatapencaharian bercocok tanam padi gogo sawah organik andalan perbukitan selatan.
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>

            <div className="pt-4 border-t border-gray-100 mt-6 text-[10px] text-gray-400 flex justify-between items-center">
              <span>* Data diupdate secara manual per semester dari KK jemaat</span>
              <span className="text-emerald-700 font-bold">Terakreditasi A</span>
            </div>
          </div>

        </div>
      </section>

      {/* Staff Detail modal */}
      <AnimatePresence>
        {selectedStaff && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 overflow-y-auto">
            <motion.div 
              initial={{ opacity: 0, scale: 0.95, y: 20 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 20 }}
              className="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden glass-card"
            >
              <div className="p-5 bg-primary text-white flex justify-between items-center">
                <h4 className="font-display font-bold text-base">Profil Pejabat Pemerintahan</h4>
                <button onClick={() => setSelectedStaff(null)} className="p-1 rounded-full hover:bg-white/10 transition-colors">
                  <X size={18} />
                </button>
              </div>

              <div className="p-6 space-y-6">
                <div className="flex gap-4 items-center">
                  <div className="w-16 h-16 rounded-full overflow-hidden border border-gray-200 flex-shrink-0">
                    <img src={selectedStaff.image} alt={selectedStaff.name} className="w-full h-full object-cover" />
                  </div>
                  <div>
                    <h5 className="font-display font-extrabold text-base text-gray-900">{selectedStaff.name}</h5>
                    <p className="text-xs font-bold text-emerald-800 uppercase tracking-widest">{selectedStaff.role}</p>
                    <p className="text-[10px] text-gray-400">{selectedStaff.detailRole}</p>
                  </div>
                </div>

                <div className="space-y-2">
                  <p className="text-xs font-bold text-gray-500 uppercase tracking-wider">Bio Singkat</p>
                  <p className="text-xs text-gray-600 leading-relaxed bg-gray-50 p-3.5 rounded-xl border border-gray-100 italic">
                    "{selectedStaff.bio}"
                  </p>
                </div>

                <div className="space-y-2.5">
                  <p className="text-xs font-bold text-gray-500 uppercase tracking-wider">Tugas Instansi Utama</p>
                  <div className="space-y-1.5 text-xs text-gray-650">
                    {selectedStaff.tugas.map((t: string, i: number) => (
                      <div key={i} className="flex gap-2 items-start">
                        <CheckCircle size={14} className="text-emerald-600 flex-shrink-0 mt-0.5" />
                        <span>{t}</span>
                      </div>
                    ))}
                  </div>
                </div>

                <div className="pt-4 border-t border-gray-100 flex justify-between text-xs text-gray-500">
                  <span className="font-mono">📬 {selectedStaff.email}</span>
                  <span className="font-mono">📞 {selectedStaff.phone}</span>
                </div>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

      {/* Org Diagram Modal */}
      <AnimatePresence>
        {showOrgModal && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 overflow-y-auto">
            <motion.div 
              initial={{ opacity: 0, scale: 0.95, y: 20 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.95, y: 20 }}
              className="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card"
            >
              <div className="p-5 bg-gradient-to-r from-emerald-950 to-primary text-white flex justify-between items-center">
                <div>
                  <h4 className="font-display font-bold text-lg">Bagan Alur Kepengurusan Desa</h4>
                  <p className="text-[10px] text-emerald-200">Interaksi Struktural Pemerintah Desa Sukamaju</p>
                </div>
                <button onClick={() => setShowOrgModal(false)} className="p-1.5 rounded-full hover:bg-white/10 transition-colors">
                  <X size={18} />
                </button>
              </div>

              <div className="p-8 space-y-8 overflow-x-auto">
                <div className="min-w-[650px] space-y-8">
                  {/* Level 1 Kepala */}
                  <div className="flex justify-center">
                    <div className="p-3 bg-emerald-900 text-white rounded-lg border-2 border-emerald-600 text-center w-56 font-display shadow-md">
                      <p className="text-[10px] uppercase font-bold text-emerald-300">Kepala Desa</p>
                      <p className="font-extrabold text-xs">Ir. H. Ahmad Fauzi</p>
                    </div>
                  </div>

                  {/* Level 2 Sekretaris */}
                  <div className="flex justify-center relative">
                    <div className="absolute top-[-32px] bottom-[32px] w-0.5 bg-gray-300 left-1/2" />
                    
                    <div className="p-3 bg-emerald-50 text-emerald-950 rounded-lg border-2 border-emerald-400 text-center w-56 font-display shadow-sm z-10">
                      <p className="text-[10px] uppercase font-bold text-emerald-700">Sekretaris Desa</p>
                      <p className="font-extrabold text-xs">Siti Aminah, S.E.</p>
                    </div>
                  </div>

                  {/* Level 3 staff */}
                  <div className="relative">
                    <div className="absolute top-[-32px] left-1/2 w-0.5 h-8 bg-gray-300" />
                    <div className="absolute top-0 left-[16.6%] right-[16.6%] h-0.5 bg-gray-300" />
                    
                    <div className="grid grid-cols-3 gap-4 pt-8">
                      <div className="flex flex-col items-center relative">
                        <div className="absolute top-[-32px] w-0.5 h-8 bg-gray-300" />
                        <div className="p-3 bg-white border border-gray-200 rounded-lg text-center w-48 font-display shadow-inner">
                          <p className="text-[9px] uppercase font-bold text-gray-400">Keuangan / Bendahara</p>
                          <p className="font-bold text-xs text-gray-800">Rahmat Hidayat</p>
                        </div>
                      </div>

                      <div className="flex flex-col items-center relative">
                        <div className="absolute top-[-32px] w-0.5 h-8 bg-gray-300" />
                        <div className="p-3 bg-white border border-gray-200 rounded-lg text-center w-48 font-display shadow-inner">
                          <p className="text-[9px] uppercase font-bold text-gray-400">Kaur Perencanaan</p>
                          <p className="font-bold text-xs text-gray-800">Budi Santoso, S.T.</p>
                        </div>
                      </div>

                      <div className="flex flex-col items-center relative">
                        <div className="absolute top-[-32px] w-0.5 h-8 bg-gray-300" />
                        <div className="p-3 bg-white border border-gray-200 rounded-lg text-center w-48 font-display shadow-inner">
                          <p className="text-[9px] uppercase font-bold text-gray-400">Kaur Umum &amp; Humas</p>
                          <p className="font-bold text-xs text-gray-800">Dewi Lestari</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <p className="text-center text-xs text-gray-400 italic pt-6 bg-gray-50 rounded-xl leading-relaxed">
                  Bagan kepengurusan ini disusun transparan dalam kerangka tata kerja kolaboratif. Klik salah satu pejabat di halaman utama untuk melihat rincian riwayat kepemimpinan serta kontak dinas resmi masing-masing aparatur.
                </p>
              </div>

              <div className="p-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <button onClick={() => setShowOrgModal(false)} className="px-5 py-2.5 bg-gray-800 text-white hover:bg-gray-900 font-bold text-xs rounded-xl transition-colors font-display">
                  Selesai
                </button>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>

    </div>
  );
}
