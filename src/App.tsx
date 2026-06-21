import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { 
  Building, ShieldAlert, CheckCircle, ArrowRight, 
  MapPin, Phone, Mail, Compass, HelpCircle, MessageSquareShare 
} from 'lucide-react';

import Header from './components/Header';
import Footer from './components/Footer';
import ProfileTab from './components/ProfileTab';
import ServicesTab from './components/ServicesTab';
import PotentialTab from './components/PotentialTab';
import NewsTab from './components/NewsTab';
import SubmissionModal from './components/SubmissionModal';
import ReportModal from './components/ReportModal';
import { AppTab, ServiceItem, DocumentSubmission, ComplaintTicket } from './types';

export default function App() {
  const [activeTab, setActiveTab] = useState<AppTab>('profile');
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedService, setSelectedService] = useState<ServiceItem | null>(null);
  const [isSubmissionOpen, setIsSubmissionOpen] = useState(false);
  const [isReportOpen, setIsReportOpen] = useState(false);

  // Initialize with robust simulated database state
  const [submissionsList, setSubmissionsList] = useState<DocumentSubmission[]>([
    {
      id: "sub-1",
      serviceId: "srv-1",
      serviceName: "Penerbitan KTP & Kartu Keluarga Baru",
      nik: "3275010203040001",
      name: "Andi Saputra",
      phone: "081298765432",
      email: "andisaputra@email.com",
      date: "12 Juni 2026",
      status: "Selesai",
      trackingId: "WD-SERVICES-8321",
      files: ["KTP_Lama.pdf", "Surat_RT.pdf"],
      notes: "Kartu Keluarga dan KTP fisik Anda telah selesai dicetak. Silakan ambil di Loket 3 Pelayanan Balai Desa pada jam kerja dengan membawa dokumen lama."
    },
    {
      id: "sub-2",
      serviceId: "srv-3",
      serviceName: "Registrasi Akta Kelahiran Baru",
      nik: "3275010203040002",
      name: "Bambang Wijaya",
      phone: "081311223344",
      email: "bambangw@email.com",
      date: "14 Juni 2026",
      status: "Verifikasi",
      trackingId: "WD-SERVICES-2941",
      files: ["Suket_Lahir.jpg", "Buku_Nikah.pdf"],
      notes: "Petugas sedang memverifikasi scan buku nikah asli orang tua. Mohon pastikan scan berkas tidak buram / terpotong."
    },
    {
      id: "sub-3",
      serviceId: "srv-4",
      serviceName: "Permohonan Bantuan Sosial Mandiri",
      nik: "3275010203040003",
      name: "Siti Rahmawati",
      phone: "085699887766",
      email: "sitirahma@email.com",
      date: "16 Juni 2026",
      status: "Diajukan",
      trackingId: "WD-SERVICES-5730",
      files: ["Suket_Miskin.pdf", "Depan_Rumah.jpg"],
      notes: "Berkas Anda telah berhasil diterima oleh sistem digital. Tim Satgas Sosial Desa sedang menjadwalkan survey verifikasi faktual lapangan."
    }
  ]);

  const [complaintsList, setComplaintsList] = useState<ComplaintTicket[]>([
    {
      id: "c-1",
      title: "Jalan Longsor Lingkar Dusun Timur",
      category: "infrastruktur",
      description: "Jalan semen lingkar timur mengalami retak parah dan sebagian amblas akibat hujan deras tadi malam. Sangat membahayakan pengguna jalan terutama motor.",
      status: "Proses",
      date: "15 Juni 2026",
      author: "Prasetyo",
      trackingId: "WD-SAMBAT-4819",
      location: "RT 05 / RW 02 Dusun Timur",
      response: "Laporan kerusakan jalan telah diverifikasi oleh tim perencana desa. Pemerintah desa sedang menyiapkan papan pembatas keselamatan darurat, semen beton cor akan ditambal mulai lusa menggunakan pagu anggaran darurat desa."
    },
    {
      id: "c-2",
      title: "Penumpukan Sampah Liar di Parit Sungai",
      category: "kebersihan",
      description: "Beberapa warga luar membuang sampah kantong plastik sembarangan di aliran anak sungai jembatan selatan. Air mulai tergenang dan menimbulkan bau menyengat.",
      status: "Selesai",
      date: "14 Juni 2026",
      author: "Warga Anonim",
      trackingId: "WD-SAMBAT-7391",
      location: "Jembatan Sawah Selatan",
      response: "Unit Satpol Pamong bekerjasama dengan Karang Taruna telah melakukan aksi bersih sungai mandiri kemarin. Spanduk larangan dan ancaman denda pidana kini terpasang kokoh di lokasi jembatan."
    }
  ]);

  const handleTabChange = (tab: AppTab) => {
    setActiveTab(tab);
    setSearchQuery(''); // Reset search when changing view
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  const handleOpenSubmission = (service: ServiceItem) => {
    setSelectedService(service);
    setIsSubmissionOpen(true);
  };

  const handleNewSubmission = (submission: DocumentSubmission) => {
    setSubmissionsList(prev => [...prev, submission]);
  };

  const handleNewComplaint = (ticket: ComplaintTicket) => {
    setComplaintsList(prev => [...prev, ticket]);
  };

  return (
    <div className="min-h-screen flex flex-col bg-[#fafbfc] transition-all scroll-smooth">
      
      {/* Dynamic Header Component */}
      <Header 
        activeTab={activeTab} 
        onTabChange={handleTabChange}
        searchQuery={searchQuery}
        onSearchChange={setSearchQuery}
        onOpenReport={() => setIsReportOpen(true)}
      />

      {/* Main Workspace Frame */}
      <main className="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 w-full">
        <AnimatePresence mode="wait">
          <motion.div
            key={activeTab}
            initial={{ opacity: 0, y: 15 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -15 }}
            transition={{ duration: 0.25, ease: 'easeInOut' }}
          >
            {activeTab === 'profile' && (
              <ProfileTab onTabChange={handleTabChange} />
            )}

            {activeTab === 'services' && (
              <ServicesTab 
                searchQuery={searchQuery}
                onSelectService={handleOpenSubmission}
                submissionsList={submissionsList}
              />
            )}

            {activeTab === 'potential' && (
              <PotentialTab />
            )}

            {activeTab === 'news' && (
              <NewsTab searchQuery={searchQuery} />
            )}
          </motion.div>
        </AnimatePresence>

        {/* Dynamic E-Sambat complaints ticker block only on home/profile page */}
        {activeTab === 'profile' && complaintsList.length > 0 && (
          <section className="mt-24 border-t border-gray-100 pt-16">
            <div className="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-3 mb-10 text-left">
              <div className="space-y-2">
                <span className="text-xs font-bold text-yellow-750 uppercase tracking-widest font-display">Pantau Aduan Masyarakat</span>
                <h2 className="font-display text-2xl sm:text-3xl font-extrabold text-[#111] tracking-tight">Feed Transparansi E-Sambat</h2>
                <p className="text-xs sm:text-sm text-gray-500 max-w-xl">Laporan aspirasi, gangguan infrastruktur, serta usulan pembangunan desa yang diungkapkan secara jujur dan ditindaklanjuti secara terbuka.</p>
              </div>

              <button 
                onClick={() => setIsReportOpen(true)}
                className="px-5 py-2.5 bg-yellow-600 text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-yellow-700 transition-all shadow-md w-fit font-display flex items-center gap-1 leading-none shrink-0"
                id="profile-sambat-trigger"
              >
                <ShieldAlert size={15} /> Kirim Aduan Baru
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {complaintsList.map(ticket => (
                <div 
                  key={ticket.id} 
                  className="bg-white border border-gray-100 rounded-2xl p-5.5 space-y-4 text-left hover:shadow-md transition-shadow relative"
                  id={`complaint-card-${ticket.id}`}
                >
                  <div className="flex justify-between items-center bg-gray-50/50 p-2.5 rounded-xl border border-gray-100 text-xs">
                    <div>
                      <span className="text-gray-400 font-semibold uppercase text-[9px] block">Kode Laporan</span>
                      <span className="font-bold text-primary text-[11px] font-mono select-all tracking-wide">{ticket.trackingId}</span>
                    </div>
                    {ticket.status === 'Selesai' ? (
                      <span className="bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-extrabold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider block transition-colors border border-emerald-100">
                        ✅ Selesai Dikerjakan
                      </span>
                    ) : (
                      <span className="bg-orange-50 text-orange-700 font-extrabold text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider block border border-orange-100">
                        ⏳ Sedang Diproses
                      </span>
                    )}
                  </div>

                  <div className="space-y-1.5">
                    <h4 className="font-display font-extrabold text-sm text-gray-900">{ticket.title}</h4>
                    <p className="text-[11.5px] text-gray-500 leading-relaxed font-sans">{ticket.description}</p>
                  </div>

                  <div className="bg-yellow-50/45 p-3 rounded-lg border border-yellow-101/40 space-y-1 text-xs">
                    <p className="font-bold text-[#795900] flex items-center gap-1 flex-shrink-0">💬 Tanggapan Balai Desa:</p>
                    <p className="text-gray-650 text-[11px] leading-relaxed">{ticket.response}</p>
                  </div>

                  <div className="flex justify-between text-[10px] text-gray-400 font-semibold uppercase font-mono mt-1 pt-1.5 border-t border-gray-50">
                    <span>📍 {ticket.location}</span>
                    <span>👤 {ticket.author} • {ticket.date}</span>
                  </div>
                </div>
              ))}
            </div>
          </section>
        )}
      </main>

      {/* Dynamic Footer Component */}
      <Footer onTabChange={handleTabChange} onOpenReport={() => setIsReportOpen(true)} />

      {/* Dynamic Multi-Step Document Submission Modal */}
      <SubmissionModal 
        isOpen={isSubmissionOpen}
        onClose={() => { setIsSubmissionOpen(false); setSelectedService(null); }}
        service={selectedService}
        onSubmit={handleNewNewSubmission}
      />

      {/* Dynamic Citizen Complaint/Sambat Modal */}
      <ReportModal 
        isOpen={isReportOpen}
        onClose={() => setIsReportOpen(false)}
        onSubmit={handleNewNewComplaint}
      />

    </div>
  );

  // Wrappers to automatically open the Services tab and trace the code when submitted!
  function handleNewNewSubmission(submission: DocumentSubmission) {
    handleNewSubmission(submission);
    handleTabChange('services');
    setTimeout(() => {
      const btn = document.getElementById('track-submit-btn');
      if (btn) {
        // Automatically inject tracking code into input and click track!
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
          if (input.placeholder.includes('WD-SERVICES')) {
            // Find input and simulate change
            const nativeInputValueSetter = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, "value")?.set;
            nativeInputValueSetter?.call(input, submission.trackingId);
            input.dispatchEvent(new Event('input', { bubbles: true }));
          }
        });
      }
    }, 400);
  }

  function handleNewNewComplaint(ticket: ComplaintTicket) {
    handleNewComplaint(ticket);
    handleTabChange('profile');
    setTimeout(() => {
      const tickerNode = document.getElementById(`complaint-card-${ticket.id}`);
      if (tickerNode) {
        tickerNode.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }, 400);
  }
}
