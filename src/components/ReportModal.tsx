import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { X, Check, MapPin, AlertCircle, FileImage, Send, ShieldAlert, User, Compass } from 'lucide-react';
import { ComplaintTicket } from '../types';

interface ReportModalProps {
  isOpen: boolean;
  onClose: () => void;
  onSubmit: (ticket: ComplaintTicket) => void;
}

export default function ReportModal({ isOpen, onClose, onSubmit }: ReportModalProps) {
  const [success, setSuccess] = useState(false);
  const [title, setTitle] = useState('');
  const [category, setCategory] = useState<'infrastruktur' | 'sosial' | 'keamanan' | 'kebersihan' | 'lainnya'>('infrastruktur');
  const [description, setDescription] = useState('');
  const [location, setLocation] = useState('');
  const [author, setAuthor] = useState('');
  const [isAnonymous, setIsAnonymous] = useState(false);
  const [files, setFiles] = useState<{ name: string; url: string }[]>([]);
  const [trackingCode, setTrackingCode] = useState('');
  const [error, setError] = useState('');

  if (!isOpen) return null;

  const handleImageUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (!e.target.files?.length) return;
    const file = e.target.files[0];
    const reader = new FileReader();
    reader.onloadend = () => {
      setFiles([{ name: file.name, url: reader.result as string }]);
    };
    reader.readAsDataURL(file);
  };

  const handleFormSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');

    if (!title || !description || !location) {
      setError('Harap isi judul, deskripsi lengkap, dan lokasi kejadian!');
      return;
    }

    const rand = Math.floor(1000 + Math.random() * 9000);
    const code = `WD-SAMBAT-${rand}`;
    setTrackingCode(code);

    const ticket: ComplaintTicket = {
      id: Math.random().toString(36).substr(2, 9),
      title,
      category,
      description,
      status: 'Diterima',
      date: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }),
      author: isAnonymous ? 'Warga Anonim' : (author || 'Warga Desa'),
      trackingId: code,
      location,
      response: 'Laporan Anda telah berhasil kami terima di sistem E-Sambat WebDesa. Tim Satuan Tugas Desa akan melakukan verifikasi lapangan segera.'
    };

    onSubmit(ticket);
    setSuccess(true);
  };

  const handleDone = () => {
    setSuccess(false);
    setTitle('');
    setDescription('');
    setLocation('');
    setAuthor('');
    setIsAnonymous(false);
    setFiles([]);
    setError('');
    onClose();
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 overflow-y-auto">
      <motion.div 
        initial={{ opacity: 0, scale: 0.95, y: 20 }}
        animate={{ opacity: 1, scale: 1, y: 0 }}
        exit={{ opacity: 0, scale: 0.95, y: 20 }}
        className="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden glass-card"
      >
        {/* Header */}
        <div className="flex items-center justify-between p-5 bg-yellow-600 text-white">
          <div className="flex items-center gap-2">
            <ShieldAlert size={22} className="text-yellow-100" />
            <div>
              <h3 className="text-lg font-bold font-display">Layanan E-Sambat Desa</h3>
              <p className="text-[11px] text-yellow-100/95">Aduan &amp; Aspirasi Warga Berbasis Digital</p>
            </div>
          </div>
          <button 
            onClick={onClose} 
            className="p-1 rounded-full hover:bg-white/15 transition-colors"
            id="close-report-modal"
          >
            <X size={18} />
          </button>
        </div>

        <AnimatePresence mode="wait">
          {!success ? (
            <motion.form 
              key="report-form"
              onSubmit={handleFormSubmit}
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              exit={{ opacity: 0 }}
              className="p-6 space-y-4"
            >
              {error && (
                <div className="p-3 bg-red-50 border-l-4 border-red-500 rounded text-red-700 text-xs flex items-center gap-1.5">
                  <AlertCircle size={16} />
                  <span>{error}</span>
                </div>
              )}

              <div className="bg-yellow-50 text-yellow-800 p-3 rounded-lg text-xs leading-relaxed border border-yellow-100 flex gap-2">
                <Compass className="text-yellow-600 flex-shrink-0" size={18} />
                <p>E-Sambat adalah platform pelaporan resmi bagi warga desa untuk melaporkan masalah lingkungan, infrastruktur, ketertiban umum, dan sosial secara cepat dan transparan.</p>
              </div>

              <div>
                <label className="block text-[11px] font-bold text-gray-500 uppercase mb-1">Judul Laporan / Aduan *</label>
                <input 
                  type="text"
                  value={title}
                  onChange={(e) => setTitle(e.target.value)}
                  placeholder="Contoh: Lampu Jalan Mati atau Sampah Menumpuk" 
                  className="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 focus:border-transparent text-sm transition-all"
                  required
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="block text-[11px] font-bold text-gray-500 uppercase mb-1">Kategori Aduan *</label>
                  <select
                    value={category}
                    onChange={(e: any) => setCategory(e.target.value)}
                    className="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all bg-white"
                  >
                    <option value="infrastruktur">🔧 Infrastruktur</option>
                    <option value="kebersihan">🧹 Kebersihan</option>
                    <option value="sosial">🤝 Sosial/Bantuan</option>
                    <option value="keamanan">🚨 Keamanan</option>
                    <option value="lainnya">📦 Lainnya</option>
                  </select>
                </div>
                <div>
                  <label className="block text-[11px] font-bold text-gray-500 uppercase mb-1">Lokasi Kejadian *</label>
                  <div className="relative">
                    <MapPin className="absolute left-2.5 top-2.5 text-gray-400" size={16} />
                    <input 
                      type="text"
                      value={location}
                      onChange={(e) => setLocation(e.target.value)}
                      placeholder="RT 03 / Dusun Makmur" 
                      className="w-full pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all"
                      required
                    />
                  </div>
                </div>
              </div>

              <div>
                <label className="block text-[11px] font-bold text-gray-500 uppercase mb-1">Isi Laporan Lengkap *</label>
                <textarea 
                  rows={3}
                  value={description}
                  onChange={(e) => setDescription(e.target.value)}
                  placeholder="Jelaskan kronologi, rincian masalah, atau saran secara jelas..." 
                  className="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all"
                  required
                />
              </div>

              <div className="grid grid-cols-2 gap-3 items-end">
                <div>
                  <label className="flex items-center gap-2 text-xs font-semibold text-gray-700 cursor-pointer select-none mb-2">
                    <input 
                      type="checkbox"
                      checked={isAnonymous}
                      onChange={(e) => setIsAnonymous(e.target.checked)}
                      className="rounded text-yellow-600 focus:ring-yellow-500"
                    />
                    Laporkan sebagai Anonim
                  </label>
                  {!isAnonymous && (
                    <div className="relative">
                      <User className="absolute left-2.5 top-2.5 text-gray-400" size={16} />
                      <input 
                        type="text"
                        value={author}
                        onChange={(e) => setAuthor(e.target.value)}
                        placeholder="Nama Lengkap Anda" 
                        className="w-full pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all"
                      />
                    </div>
                  )}
                </div>

                <div className="relative border border-dashed border-gray-300 rounded-lg p-2 text-center hover:bg-gray-50 bg-gray-50/20 hover:border-yellow-500 cursor-pointer">
                  <input 
                    type="file" 
                    accept="image/*"
                    onChange={handleImageUpload}
                    className="absolute inset-0 opacity-0 cursor-pointer"
                  />
                  {files.length > 0 ? (
                    <div className="flex items-center gap-2 justify-center">
                      <img src={files[0].url} alt="bukti" className="w-8 h-8 rounded object-cover border" />
                      <p className="text-[10px] text-gray-500 font-semibold truncate max-w-[80px]">{files[0].name}</p>
                    </div>
                  ) : (
                    <div className="flex flex-col items-center justify-center py-1">
                      <FileImage size={18} className="text-gray-400 mb-0.5" />
                      <p className="text-[10px] text-gray-600 font-bold">Unggah Bukti Foto</p>
                    </div>
                  )}
                </div>
              </div>

              <div className="pt-2">
                <button 
                  type="submit"
                  className="w-full py-3 bg-yellow-600 font-bold text-white rounded-lg hover:bg-yellow-700 transition-all flex items-center justify-center gap-2 text-sm shadow-md"
                >
                  <Send size={16} />
                  Kirim Laporan Aduan
                </button>
              </div>
            </motion.form>
          ) : (
            <motion.div 
              key="success-report"
              initial={{ opacity: 0, scale: 0.9 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0 }}
              className="p-8 text-center space-y-4"
            >
              <div className="w-16 h-16 bg-yellow-100 text-yellow-700 rounded-full flex items-center justify-center mx-auto">
                <Check size={36} />
              </div>
              <h3 className="text-xl font-bold font-display text-gray-800">Laporan Berhasil Terkirim</h3>
              <p className="text-sm text-gray-500 max-w-sm mx-auto">Aduan Anda di sistem E-Sambat telah dicatat. Gunakan kode pelacakan di bawah untuk melacak kemajuan penanganan tim lapangan kami.</p>

              <div className="p-4 bg-yellow-50 border border-yellow-200 rounded-xl my-4 max-w-xs mx-auto">
                <span className="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Kode Laporan E-Sambat</span>
                <span className="text-lg font-bold font-mono text-yellow-700 select-all tracking-wide">{trackingCode}</span>
              </div>

              <p className="text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-1.5 rounded-md inline-block">
                💡 Tim kami akan membalas aduan Anda dalam 24 jam.
              </p>

              <div className="pt-4 border-t border-gray-100 max-w-xs mx-auto">
                <button 
                  onClick={handleDone}
                  className="w-full py-2 bg-gray-800 hover:bg-gray-900 text-white font-bold rounded-lg transition-colors text-sm"
                >
                  Selesai
                </button>
              </div>
            </motion.div>
          )}
        </AnimatePresence>
      </motion.div>
    </div>
  );
}
