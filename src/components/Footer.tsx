import React from 'react';
import { Mail, Phone, MapPin, Globe, Share2, Youtube, ShieldCheck } from 'lucide-react';
import { AppTab } from '../types';

interface FooterProps {
  onTabChange: (tab: AppTab) => void;
  onOpenReport: () => void;
}

export default function Footer({ onTabChange, onOpenReport }: FooterProps) {
  return (
    <footer className="bg-[#122810] text-[#e0eedf] mt-24 border-t-4 border-secondary">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          
          {/* Brand Col */}
          <div className="space-y-4">
            <div className="flex items-center gap-2">
              <div className="w-9 h-9 rounded-lg bg-white text-primary flex items-center justify-center font-black">
                WD
              </div>
              <span className="font-display text-xl font-bold text-white tracking-tight">
                Web<span className="text-[#ffdf41]">Desa</span>
              </span>
            </div>
            
            <p className="text-xs text-[#a5c3a1] leading-relaxed">
              © 2026 WebDesa. Hak Cipta Dilindungi. Platform digital terpadu untuk pelayanan transparansi administrasi publik, penyebaran infomasi, dan pengaduan pembangunan secara real-time.
            </p>

            <div className="flex gap-2.5 pt-2">
              <a href="#" className="w-8 h-8 rounded-full border border-[#425d3f] flex items-center justify-center text-[#ffdf41] hover:bg-[#ffdf41] hover:text-primary transition-all">
                <Globe size={14} />
              </a>
              <a href="#" className="w-8 h-8 rounded-full border border-[#425d3f] flex items-center justify-center text-[#ffdf41] hover:bg-[#ffdf41] hover:text-primary transition-all">
                <Share2 size={14} />
              </a>
              <a href="#" className="w-8 h-8 rounded-full border border-[#425d3f] flex items-center justify-center text-[#ffdf41] hover:bg-[#ffdf41] hover:text-primary transition-all">
                <Youtube size={14} />
              </a>
            </div>
          </div>

          {/* Identity Col */}
          <div>
            <h4 className="text-xs font-bold uppercase tracking-widest text-[#ffdf41] border-b border-[#304d2d] pb-2.5 mb-4 font-display">
              IDENTITAS DESA
            </h4>
            <ul className="space-y-2.5 text-xs text-[#b8d4b4]">
              <li>
                <button onClick={() => onTabChange('profile')} className="hover:text-white hover:underline transition-all text-left">
                  Sejarah &amp; Asal-Usul
                </button>
              </li>
              <li>
                <button onClick={() => onTabChange('profile')} className="hover:text-white hover:underline transition-all text-left">
                  Visi &amp; Misi Utama
                </button>
              </li>
              <li>
                <button onClick={() => onTabChange('profile')} className="hover:text-white hover:underline transition-all text-left">
                  Struktur Organisasi Aparatur
                </button>
              </li>
              <li>
                <button onClick={() => onTabChange('profile')} className="hover:text-white hover:underline transition-all text-left">
                  Geografis &amp; Demografis
                </button>
              </li>
            </ul>
          </div>

          {/* Quick Links Col */}
          <div>
            <h4 className="text-xs font-bold uppercase tracking-widest text-[#ffdf41] border-b border-[#304d2d] pb-2.5 mb-4 font-display">
              LAYANAN PUBLIK
            </h4>
            <ul className="space-y-2.5 text-xs text-[#b8d4b4]">
              <li>
                <button onClick={() => onTabChange('services')} className="hover:text-white hover:underline transition-all text-left">
                  Layanan Kependudukan (KTP &amp; KK)
                </button>
              </li>
              <li>
                <button onClick={() => onTabChange('services')} className="hover:text-white hover:underline transition-all text-left">
                  Layanan Surat Pengantar
                </button>
              </li>
              <li>
                <button onClick={() => onTabChange('services')} className="hover:text-white hover:underline transition-all text-left">
                  Layanan Bantuan Sosial
                </button>
              </li>
              <li>
                <button onClick={onOpenReport} className="text-yellow-400 hover:text-yellow-300 hover:underline transition-all text-left font-semibold">
                  E-Sambat Pengaduan Warga
                </button>
              </li>
            </ul>
          </div>

          {/* Contacts Col */}
          <div className="space-y-4">
            <h4 className="text-xs font-bold uppercase tracking-widest text-[#ffdf41] border-b border-[#304d2d] pb-2.5 mb-4 font-display">
              KONTAK &amp; ALAMAT
            </h4>
            
            <div className="space-y-3 text-xs text-[#b8d4b4]">
              <div className="flex items-start gap-2.5">
                <MapPin size={16} className="text-[#ffdf41] flex-shrink-0 mt-0.5" />
                <p className="leading-relaxed">
                  Jl. Raya Utama Desa No. 45, Kecamatan Sukamaju, Kabupaten Nusantara Raya, 12345
                </p>
              </div>

              <div className="flex items-center gap-2.5">
                <Mail size={16} className="text-[#ffdf41] flex-shrink-0" />
                <p>kontak@webdesa.go.id</p>
              </div>

              <div className="flex items-center gap-2.5">
                <Phone size={16} className="text-[#ffdf41] flex-shrink-0" />
                <p>+62 812-3456-7890</p>
              </div>
            </div>

            <div className="p-3 rounded-lg border border-[#3e5f39] bg-[#0c1f0b] flex gap-2 items-center">
              <ShieldCheck className="text-[#ffdf41] flex-shrink-0" size={16} />
              <p className="text-[10px] text-[#a5c3a1] leading-tight">Terakreditasi Digital Desa Mandiri Sejahtera</p>
            </div>
          </div>

        </div>

        <div className="border-t border-[#234120] mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center text-[11px] text-[#86a982]">
          <p>Diberdayakan oleh Platform Digital Terpadu WebDesa Pro.</p>
          <p className="mt-2 sm:mt-0">Dibuat khusus sesuai dengan Layout Mockup Resmi.</p>
        </div>
      </div>
    </footer>
  );
}
