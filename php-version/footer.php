<?php
// PHP Version: Footer Component
?>
    </main> <!-- End of Main Frame -->

    <!-- Footer Block -->
    <footer class="bg-[#122810] text-[#e0eedf] mt-24 border-t-4 border-[#795900]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                
                <!-- Brand and Description -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-lg bg-white text-primary flex items-center justify-center font-black">
                            WD
                        </div>
                        <span class="font-display text-xl font-bold text-white tracking-tight">
                            Web<span class="text-[#ffdf41]">Desa</span>
                        </span>
                    </div>
                    
                    <p class="text-xs text-[#a5c3a1] leading-relaxed">
                        © <?php echo date('Y'); ?> WebDesa. Hak Cipta Dilindungi. Platform digital terpadu untuk pelayanan transparansi administrasi publik, penyebaran informasi, dan pengaduan pembangunan secara real-time.
                    </p>

                    <div class="flex gap-2.5 pt-2">
                        <a href="#" class="w-8 h-8 rounded-full border border-[#425d3f] flex items-center justify-center text-[#ffdf41] hover:bg-[#ffdf41] hover:text-primary transition-all">
                            <i class="w-3.5 h-3.5" data-lucide="globe"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full border border-[#425d3f] flex items-center justify-center text-[#ffdf41] hover:bg-[#ffdf41] hover:text-primary transition-all">
                            <i class="w-3.5 h-3.5" data-lucide="share-2"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full border border-[#425d3f] flex items-center justify-center text-[#ffdf41] hover:bg-[#ffdf41] hover:text-primary transition-all">
                            <i class="w-3.5 h-3.5" data-lucide="youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Identitas Desa -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#ffdf41] border-b border-[#304d2d] pb-2.5 mb-4 font-display">
                        IDENTITAS DESA
                    </h4>
                    <ul class="space-y-2.5 text-xs text-[#b8d4b4]">
                        <li>
                            <a href="index.php?page=profile#sejarah-desa" class="hover:text-white hover:underline transition-all text-left block">
                                Sejarah &amp; Asal-Usul
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=profile#visi-misi" class="hover:text-white hover:underline transition-all text-left block">
                                Visi &amp; Misi Utama
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=profile#aparatur" class="hover:text-white hover:underline transition-all text-left block">
                                Struktur Organisasi Aparatur
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=profile#geografis" class="hover:text-white hover:underline transition-all text-left block">
                                Geografis &amp; Demografis
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Layanan Publik Quicklinks -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#ffdf41] border-b border-[#304d2d] pb-2.5 mb-4 font-display">
                        LAYANAN PUBLIK
                    </h4>
                    <ul class="space-y-2.5 text-xs text-[#b8d4b4]">
                        <li>
                            <a href="index.php?page=services" class="hover:text-white hover:underline transition-all text-left block">
                                Layanan Kependudukan (KTP &amp; KK)
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=services" class="hover:text-white hover:underline transition-all text-left block">
                                Layanan Surat Pengantar
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=services" class="hover:text-white hover:underline transition-all text-left block">
                                Layanan Bantuan Sosial
                            </a>
                        </li>
                        <li>
                            <button onclick="toggleModal('reportModal')" class="text-yellow-400 hover:text-yellow-300 hover:underline transition-all text-left font-semibold block">
                                E-Sambat Pengaduan Warga
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Contacts & Address -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#ffdf41] border-b border-[#304d2d] pb-2.5 mb-4 font-display">
                        KONTAK &amp; ALAMAT
                    </h4>
                    
                    <div class="space-y-3 text-xs text-[#b8d4b4]">
                        <div class="flex items-start gap-2.5">
                            <i class="w-4 h-4 text-[#ffdf41] flex-shrink-0 mt-0.5" data-lucide="map-pin"></i>
                            <p class="leading-relaxed">
                                Jl. Raya Utama Desa No. 45, Kecamatan Sukamaju, Kabupaten Nusantara Raya, 12345
                            </p>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <i class="w-4 h-4 text-[#ffdf41] flex-shrink-0" data-lucide="mail"></i>
                            <p>kontak@webdesa.go.id</p>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <i class="w-4 h-4 text-[#ffdf41] flex-shrink-0" data-lucide="phone"></i>
                            <p>+62 812-3456-7890</p>
                        </div>
                    </div>

                    <div class="p-3 rounded-lg border border-[#3e5f39] bg-[#0c1f0b] flex gap-2 items-center">
                        <i class="w-4 h-4 text-[#ffdf41] flex-shrink-0" data-lucide="shield-check"></i>
                        <p class="text-[10px] text-[#a5c3a1] leading-tight">Terakreditasi Digital Desa Mandiri Sejahtera</p>
                    </div>
                </div>

            </div>

            <div class="border-t border-[#234120] mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center text-[11px] text-[#86a982]">
                <p>Diberdayakan oleh Platform Digital Terpadu WebDesa Pro PHP Edition.</p>
                <p class="mt-2 sm:mt-0">Daftar layout, tombol, and modals sudah sepenuhnya terkonversi.</p>
            </div>
        </div>
    </footer>

    <!-- Global Javascript Managers for Modals and Interactivity -->
    <script>
        // Initialize dynamic lucide icons
        lucide.createIcons();

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Generic Modal Toggle Controller
        function toggleModal(modalId, show = true) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
