import React, { useState } from 'react';
import { Search, ShieldAlert, Menu, X, Globe, Phone } from 'lucide-react';
import { AppTab } from '../types';

interface HeaderProps {
  activeTab: AppTab;
  onTabChange: (tab: AppTab) => void;
  searchQuery: string;
  onSearchChange: (query: string) => void;
  onOpenReport: () => void;
}

export default function Header({ 
  activeTab, 
  onTabChange, 
  searchQuery, 
  onSearchChange,
  onOpenReport 
}: HeaderProps) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  const navItems: { id: AppTab; label: string }[] = [
    { id: 'profile', label: 'Profil Desa' },
    { id: 'services', label: 'Layanan Publik' },
    { id: 'potential', label: 'Potensi Wisata' },
    { id: 'news', label: 'Kabar & Berita' }
  ];

  return (
    <header className="bg-white sticky top-0 z-40 transition-all border-b border-gray-100 shadow-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-20">
          
          {/* Logo */}
          <div 
            onClick={() => onTabChange('profile')} 
            className="flex items-center gap-2 cursor-pointer group"
          >
            <div className="w-10 h-10 rounded-xl bg-primary flex items-center justify-center font-bold text-white shadow-md shadow-primary/20 group-hover:scale-105 transition-all">
              WD
            </div>
            <span className="font-display text-2xl font-black text-primary tracking-tight">
              Web<span className="text-secondary">Desa</span>
            </span>
          </div>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex space-x-1 lg:space-x-4 items-center">
            {navItems.map((item) => (
              <button
                key={item.id}
                onClick={() => onTabChange(item.id)}
                className={`px-4 py-2 rounded-lg font-medium text-sm transition-all relative ${
                  activeTab === item.id 
                    ? 'text-primary font-bold' 
                    : 'text-gray-500 hover:text-primary hover:bg-gray-50'
                }`}
                id={`tab-nav-${item.id}`}
              >
                {item.label}
                {activeTab === item.id && (
                  <span className="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full" />
                )}
              </button>
            ))}
          </nav>

          {/* Search, Contact, Mobile Menu Trigger */}
          <div className="flex items-center gap-3 lg:gap-4">
            
            {/* Search Input Container */}
            <div className="relative hidden sm:block">
              <Search className="absolute left-3.5 top-3 text-gray-400" size={17} />
              <input 
                type="text" 
                value={searchQuery}
                onChange={(e) => onSearchChange(e.target.value)}
                placeholder={
                  activeTab === 'services' 
                    ? "Cari layanan desa..." 
                    : activeTab === 'news' 
                    ? "Cari berita desa..." 
                    : "Cari info desa..."
                }
                className="w-48 lg:w-64 pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-100 rounded-full text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white focus:border-transparent transition-all shadow-inner"
              />
            </div>

            {/* Sambat/Report Button */}
            <button 
              onClick={onOpenReport}
              className="bg-yellow-600 text-white hover:bg-yellow-700 px-5 py-2.5 rounded-full font-bold text-xs flex items-center gap-1.5 shadow-md shadow-yellow-600/10 active:scale-95 transition-all font-display uppercase tracking-wider"
              id="header-report-btn"
            >
              <ShieldAlert size={14} />
              Aduan &amp; Hubungi Kami
            </button>

            {/* Mobile Menu Toggle */}
            <button 
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600"
              id="mobile-menu-toggle"
            >
              {mobileMenuOpen ? <X size={22} /> : <Menu size={22} />}
            </button>
          </div>

        </div>
      </div>

      {/* Mobile Navigation Drawer */}
      {mobileMenuOpen && (
        <div className="md:hidden bg-white border-t border-gray-100 py-3 px-4 space-y-3 transition-all animate-in fade-in duration-200">
          {/* Mobile Search */}
          <div className="relative">
            <Search className="absolute left-3 top-2.5 text-gray-400" size={16} />
            <input 
              type="text" 
              value={searchQuery}
              onChange={(e) => onSearchChange(e.target.value)}
              placeholder="Cari info desa..."
              className="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs"
            />
          </div>

          <div className="grid grid-cols-2 gap-2">
            {navItems.map((item) => (
              <button
                key={item.id}
                onClick={() => {
                  onTabChange(item.id);
                  setMobileMenuOpen(false);
                }}
                className={`py-2 px-3 rounded-lg text-left text-xs font-semibold uppercase tracking-wider transition-all ${
                  activeTab === item.id 
                    ? 'bg-primary text-white' 
                    : 'bg-gray-50 text-gray-600'
                }`}
              >
                {item.label}
              </button>
            ))}
          </div>
        </div>
      )}
    </header>
  );
}
