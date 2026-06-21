export type AppTab = 'profile' | 'services' | 'potential' | 'news';

export interface ServiceItem {
  id: string;
  title: string;
  category: 'kependudukan' | 'sosial' | 'izin';
  description: string;
  duration: string;
  cost: string;
  iconName: string;
  image: string;
  requirements: string[];
}

export interface ComplaintTicket {
  id: string;
  title: string;
  category: 'infrastruktur' | 'sosial' | 'keamanan' | 'kebersihan' | 'lainnya';
  description: string;
  status: 'Draft' | 'Diterima' | 'Proses' | 'Selesai';
  date: string;
  author: string;
  trackingId: string;
  response?: string;
  location?: string;
}

export interface DocumentSubmission {
  id: string;
  serviceId: string;
  serviceName: string;
  nik: string;
  name: string;
  phone: string;
  email: string;
  date: string;
  status: 'Draft' | 'Diajukan' | 'Verifikasi' | 'Selesai';
  trackingId: string;
  files: string[];
  notes?: string;
}

export interface NewsItem {
  id: string;
  title: string;
  category: 'Pembangunan' | 'Kegiatan' | 'Pengumuman' | 'Prestasi';
  date: string;
  excerpt: string;
  content: string;
  image: string;
  author: string;
  reads: number;
}
