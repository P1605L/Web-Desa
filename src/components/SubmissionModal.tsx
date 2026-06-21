import React, { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { 
  X, Check, ChevronRight, ChevronLeft, UploadCloud, 
  Trash2, FileText, User, MapPin, Mail, Phone, CreditCard, Clock, ShieldCheck
} from 'lucide-react';
import { ServiceItem, DocumentSubmission } from '../types';

interface SubmissionModalProps {
  isOpen: boolean;
  onClose: () => void;
  service: ServiceItem | null;
  onSubmit: (submission: DocumentSubmission) => void;
}

export default function SubmissionModal({ isOpen, onClose, service, onSubmit }: SubmissionModalProps) {
  const [step, setStep] = useState(1);
  const [nik, setNik] = useState('');
  const [name, setName] = useState('');
  const [phone, setPhone] = useState('');
  const [email, setEmail] = useState('');
  const [address, setAddress] = useState('');
  const [files, setFiles] = useState<{ name: string; size: string; progress: number }[]>([]);
  const [isUploading, setIsUploading] = useState(false);
  const [trackingCode, setTrackingCode] = useState('');
  const [error, setError] = useState('');

  if (!isOpen || !service) return null;

  const handleFileUpload = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (!e.target.files?.length) return;
    setIsUploading(true);
    const uploadedFileList = Array.from(e.target.files) as File[];
    const newFiles = uploadedFileList.map(file => ({
      name: file.name,
      size: (file.size / (1024 * 1024)).toFixed(2) + ' MB',
      progress: 0
    }));

    setFiles(prev => [...prev, ...newFiles]);

    // Simulate upload progress
    newFiles.forEach((f, idx) => {
      let prog = 0;
      const interval = setInterval(() => {
        prog += 20;
        setFiles(prev => prev.map(item => {
          if (item.name === f.name) {
            return { ...item, progress: Math.min(prog, 100) };
          }
          return item;
        }));
        if (prog >= 100) {
          clearInterval(interval);
          if (idx === newFiles.length - 1) {
            setIsUploading(false);
          }
        }
      }, 150);
    });
  };

  const removeFile = (fileName: string) => {
    setFiles(prev => prev.filter(f => f.name !== fileName));
  };

  const validateStep = () => {
    setError('');
    if (step === 2) {
      if (!nik || !name || !phone || !email || !address) {
        setError('Harap lengkapi semua data diri wajib!');
        return false;
      }
      if (nik.length < 16) {
        setError('NIK harus berjumlah 16 digit angka!');
        return false;
      }
      if (!/^[0-9]+$/.test(nik)) {
        setError('NIK hanya boleh diisi angka!');
        return false;
      }
    }
    if (step === 3) {
      if (files.length === 0) {
        setError('Harap unggah minimal 1 berkas persyaratan!');
        return false;
      }
      if (files.some(f => f.progress < 100)) {
        setError('Harap tunggu hingga semua proses unggah berkas selesai!');
        return false;
      }
    }
    return true;
  };

  const nextStep = () => {
    if (!validateStep()) return;
    if (step < 4) {
      if (step === 3) {
        const rand = Math.floor(1000 + Math.random() * 9000);
        const code = `WD-SERVICES-${rand}`;
        setTrackingCode(code);
      }
      setStep(prev => prev + 1);
    }
  };

  const prevStep = () => {
    if (step > 1) {
      setStep(prev => prev - 1);
    }
  };

  const handleFormSubmit = () => {
    const submission: DocumentSubmission = {
      id: Math.random().toString(36).substr(2, 9),
      serviceId: service.id,
      serviceName: service.title,
      nik,
      name,
      phone,
      email,
      date: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }),
      status: 'Diajukan',
      trackingId: trackingCode,
      files: files.map(f => f.name),
      notes: 'Berkas Anda sedang dalam proses verifikasi awal administrasi.'
    };
    onSubmit(submission);
    // Reset form
    setStep(1);
    setNik('');
    setName('');
    setPhone('');
    setEmail('');
    setAddress('');
    setFiles([]);
    onClose();
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 overflow-y-auto">
      <motion.div 
        initial={{ opacity: 0, scale: 0.95, y: 20 }}
        animate={{ opacity: 1, scale: 1, y: 0 }}
        exit={{ opacity: 0, scale: 0.95, y: 20 }}
        className="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card"
      >
        {/* Header */}
        <div className="flex items-center justify-between p-6 bg-primary text-white">
          <div>
            <h3 className="text-xl font-bold font-display">Pengajuan Dokumen Digital</h3>
            <p className="text-xs text-white/80 mt-0.5">{service.title}</p>
          </div>
          <button 
            onClick={onClose} 
            className="p-1 rounded-full hover:bg-white/15 transition-colors"
            id="close-submission-modal"
          >
            <X size={20} />
          </button>
        </div>

        {/* Steps Tracker */}
        <div className="flex justify-between items-center px-10 py-4 bg-emerald-50/50 border-b border-gray-100">
          {[1, 2, 3, 4].map((s) => (
            <div key={s} className="flex items-center">
              <div 
                className={`w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-all shadow-sm ${
                  step === s 
                    ? 'bg-primary text-white ring-4 ring-primary-light/25' 
                    : step > s 
                      ? 'bg-emerald-600 text-white' 
                      : 'bg-white text-gray-400 border border-gray-200'
                }`}
              >
                {step > s ? <Check size={16} /> : s}
              </div>
              {s < 4 && (
                <div className={`h-1 w-12 sm:w-20 ml-2 ${step > s ? 'bg-emerald-600' : 'bg-gray-200'}`} />
              )}
            </div>
          ))}
        </div>

        {/* Content Area */}
        <div className="p-6 max-h-[60vh] overflow-y-auto">
          {error && (
            <div className="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded text-red-700 text-sm flex items-center gap-2">
              <span className="font-semibold">Galat:</span> {error}
            </div>
          )}

          <AnimatePresence mode="wait">
            {/* STEP 1: Persyaratan */}
            {step === 1 && (
              <motion.div
                initial={{ opacity: 0, x: 10 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -10 }}
                className="space-y-4"
              >
                <div className="p-4 rounded-xl bg-primary-bg border border-primary/10 flex gap-3">
                  <ShieldCheck className="text-primary flex-shrink-0" size={24} />
                  <div>
                    <h4 className="font-semibold text-primary text-sm font-display">Sistem Keamanan Terjamin</h4>
                    <p className="text-xs text-on-surface-variant leading-relaxed">Seluruh data yang Anda masukkan dilindungi dengan enkripsi tinggi dan hanya digunakan untuk kepentingan pengurusan administrasi desa.</p>
                  </div>
                </div>

                <div className="space-y-3">
                  <h4 className="font-bold text-gray-800 text-sm uppercase tracking-wider">Berkas Persyaratan Wajib:</h4>
                  <div className="grid grid-cols-1 gap-2">
                    {service.requirements.map((req, index) => (
                      <div key={index} className="flex items-start gap-2.5 p-3 rounded-lg border border-gray-100 bg-gray-50/50">
                        <span className="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                          {index + 1}
                        </span>
                        <p className="text-sm text-gray-700">{req}</p>
                      </div>
                    ))}
                  </div>

                  <div className="grid grid-cols-2 gap-4 pt-4 text-xs text-gray-500">
                    <div className="flex items-center gap-2">
                      <Clock size={16} className="text-primary-light" />
                      <div>
                        <p className="font-semibold text-gray-700">Estimasi Selesai</p>
                        <p>{service.duration}</p>
                      </div>
                    </div>
                    <div className="flex items-center gap-2">
                      <CreditCard size={16} className="text-primary-light" />
                      <div>
                        <p className="font-semibold text-gray-700">Biaya Layanan</p>
                        <p className="text-emerald-700 font-bold">{service.cost}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </motion.div>
            )}

            {/* STEP 2: Data Diri */}
            {step === 2 && (
              <motion.div
                initial={{ opacity: 0, x: 10 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -10 }}
                className="space-y-4"
              >
                <div className="grid grid-cols-2 gap-4">
                  <div className="col-span-2">
                    <label className="block text-xs font-bold text-gray-600 uppercase mb-1">Nomor Induk Kependudukan (NIK) *</label>
                    <div className="relative">
                      <CreditCard className="absolute left-3 top-3 text-gray-400" size={18} />
                      <input 
                        type="text" 
                        maxLength={16}
                        value={nik}
                        onChange={(e) => setNik(e.target.value.replace(/\D/g, ''))}
                        placeholder="Masukkan 16 digit NIK" 
                        className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                      />
                    </div>
                  </div>

                  <div className="col-span-2">
                    <label className="block text-xs font-bold text-gray-600 uppercase mb-1">Nama Lengkap Sesuai KTP *</label>
                    <div className="relative">
                      <User className="absolute left-3 top-3 text-gray-400" size={18} />
                      <input 
                        type="text" 
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        placeholder="Masukkan nama lengkap Anda" 
                        className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                      />
                    </div>
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-600 uppercase mb-1">Nomor Telepon / WhatsApp *</label>
                    <div className="relative">
                      <Phone className="absolute left-3 top-3 text-gray-400" size={18} />
                      <input 
                        type="tel" 
                        value={phone}
                        onChange={(e) => setPhone(e.target.value)}
                        placeholder="Contoh: 081234567890" 
                        className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                      />
                    </div>
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-600 uppercase mb-1">Alamat Email Aktif *</label>
                    <div className="relative">
                      <Mail className="absolute left-3 top-3 text-gray-400" size={18} />
                      <input 
                        type="email" 
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        placeholder="nama@email.com" 
                        className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                      />
                    </div>
                  </div>

                  <div className="col-span-2">
                    <label className="block text-xs font-bold text-gray-600 uppercase mb-1">Alamat Lengkap Rumah (RT/RW) *</label>
                    <div className="relative">
                      <MapPin className="absolute left-3 top-3.5 text-gray-400" size={18} />
                      <textarea 
                        rows={2}
                        value={address}
                        onChange={(e) => setAddress(e.target.value)}
                        placeholder="Contoh: Jl. Merpati No. 12, RT 02 / RW 05" 
                        className="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                      />
                    </div>
                  </div>
                </div>
              </motion.div>
            )}

            {/* STEP 3: Dokumen Pendukung */}
            {step === 3 && (
              <motion.div
                initial={{ opacity: 0, x: 10 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -10 }}
                className="space-y-4"
              >
                <div className="p-6 border-2 border-dashed border-gray-300 hover:border-primary rounded-xl text-center bg-gray-50/50 hover:bg-primary-bg/20 transition-all group relative cursor-pointer">
                  <input 
                    type="file" 
                    multiple
                    onChange={handleFileUpload}
                    className="absolute inset-0 opacity-0 cursor-pointer"
                  />
                  <UploadCloud className="mx-auto text-gray-400 group-hover:text-primary transition-colors mb-3" size={40} />
                  <p className="text-sm font-semibold text-gray-700">Tarik berkas ke sini atau klik untuk menelusuri</p>
                  <p className="text-xs text-gray-400 mt-1">Mendukung format PDF, JPG, PNG (Maks 5MB per berkas)</p>
                </div>

                {files.length > 0 && (
                  <div className="space-y-2">
                    <h5 className="font-bold text-xs text-gray-500 uppercase tracking-wide">Berkas Terunggah ({files.length})</h5>
                    <div className="space-y-2 max-h-48 overflow-y-auto">
                      {files.map((file) => (
                        <div key={file.name} className="flex items-center justify-between p-3 rounded-lg border border-gray-100 bg-white shadow-sm">
                          <div className="flex items-center gap-3 overflow-hidden">
                            <FileText size={20} className="text-primary-light flex-shrink-0" />
                            <div className="text-left overflow-hidden">
                              <p className="text-xs font-semibold text-gray-700 truncate">{file.name}</p>
                              <p className="text-[10px] text-gray-400">{file.size}</p>
                            </div>
                          </div>

                          <div className="flex items-center gap-3">
                            {file.progress < 100 ? (
                              <div className="w-16 bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                <div className="bg-primary h-full transition-all" style={{ width: `${file.progress}%` }} />
                              </div>
                            ) : (
                              <span className="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded text-[10px] font-bold">Sukses</span>
                            )}
                            <button 
                              onClick={() => removeFile(file.name)}
                              className="text-gray-400 hover:text-red-500 p-1"
                            >
                              <Trash2 size={16} />
                            </button>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </motion.div>
            )}

            {/* STEP 4: Ringkasan Pengajuan */}
            {step === 4 && (
              <motion.div
                initial={{ opacity: 0, x: 10 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -10 }}
                className="space-y-4 text-center py-6"
              >
                <div className="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                  <Check size={36} />
                </div>
                <h4 className="text-lg font-bold font-display text-gray-800">Dokumen Siap Diajukan</h4>
                <p className="text-sm text-gray-500 max-w-md mx-auto">Harap simpan Kode Pelacakan (Tracking Code) di bawah ini untuk memantau status pengajuan berkas administrasi Anda.</p>

                <div className="p-4 bg-gray-50 border border-gray-200 rounded-xl max-w-sm mx-auto my-4 space-y-2">
                  <p className="text-xs text-gray-400 uppercase tracking-widest font-bold">Kode Pelacakan Anda</p>
                  <p className="text-xl font-bold font-mono text-primary select-all tracking-wide">{trackingCode}</p>
                  <p className="text-[10px] text-emerald-700 font-medium">✨ Salin kode ini untuk melacak status di halaman Beranda/Services</p>
                </div>

                <div className="border-t border-gray-100 pt-4 text-left space-y-2 text-xs text-gray-600 max-w-md mx-auto">
                  <div className="flex justify-between"><span className="text-gray-400">Pemohon:</span> <span className="font-semibold text-gray-800">{name}</span></div>
                  <div className="flex justify-between"><span className="text-gray-400">NIK:</span> <span className="font-semibold font-mono text-gray-800">{nik}</span></div>
                  <div className="flex justify-between"><span className="text-gray-400">Jenis Dokumen:</span> <span className="font-semibold text-gray-800">{service.title}</span></div>
                  <div className="flex justify-between"><span className="text-gray-400">Jumlah Lampiran:</span> <span className="font-semibold text-gray-800">{files.length} berkas</span></div>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </div>

        {/* Footer Buttons */}
        <div className="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
          {step > 1 && step < 4 ? (
            <button 
              onClick={prevStep}
              className="flex items-center gap-1 text-sm font-semibold text-gray-600 hover:text-gray-800 py-2 px-3"
            >
              <ChevronLeft size={16} /> Kembali
            </button>
          ) : (
            <div />
          )}

          {step < 4 ? (
            <button 
              onClick={nextStep}
              className="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:opacity-90 flex items-center gap-1.5 transition-all text-sm"
            >
              Lanjutkan <ChevronRight size={16} />
            </button>
          ) : (
            <button 
              onClick={handleFormSubmit}
              className="px-8 py-3 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 shadow-md flex items-center gap-1.5 mx-auto transition-all text-sm"
              id="confirm-submission-btn"
            >
              Kirim Pengajuan Sekarang
            </button>
          )}
        </div>
      </motion.div>
    </div>
  );
}
