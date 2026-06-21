<?php
// PHP Version: E-Sambat Complaints Submission Modal Component
?>
<!-- E-Sambat Complaint Modal Overlay -->
<div id="reportModal" class="fixed inset-0 z-50 <?php echo (isset($_GET['open_sambat']) && $_GET['open_sambat'] == 'true') ? 'flex' : 'hidden'; ?> items-center justify-center p-4 bg-black/60 overflow-y-auto">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden glass-card">
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-5 bg-yellow-600 text-white">
            <div class="flex items-center gap-2">
                <i class="w-5.5 h-5.5 text-yellow-100" data-lucide="shield-alert"></i>
                <div class="text-left">
                    <h3 class="text-lg font-bold font-display">Layanan E-Sambat Desa</h3>
                    <p class="text-[11px] text-yellow-100/95">Aduan &amp; Aspirasi Warga Berbasis Digital</p>
                </div>
            </div>
            <button 
                onclick="toggleModal('reportModal', false)" 
                class="p-1 rounded-full hover:bg-white/15 transition-colors"
            >
                <i class="w-5 h-5 text-white" data-lucide="x"></i>
            </button>
        </div>

        <!-- Form Body -->
        <form action="submit-complaint.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-left">
            <div class="bg-yellow-50 text-yellow-800 p-3 rounded-lg text-xs leading-relaxed border border-yellow-100 flex gap-2">
                <i class="w-5 h-5 text-yellow-600 flex-shrink-0" data-lucide="compass"></i>
                <p>E-Sambat adalah platform pelaporan resmi bagi warga desa untuk melaporkan masalah lingkungan, infrastruktur, ketertiban umum, dan sosial secara cepat dan transparan.</p>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Judul Laporan / Aduan *</label>
                <input 
                    type="text"
                    name="title"
                    required
                    placeholder="Contoh: Lampu Jalan Mati atau Sampah Menumpuk" 
                    class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 focus:border-transparent text-sm transition-all"
                />
            </div>

            <!-- Category and Location -->
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Kategori Aduan *</label>
                    <select
                        name="category"
                        class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all bg-white"
                    >
                        <option value="infrastruktur">🔧 Infrastruktur</option>
                        <option value="kebersihan">🧹 Kebersihan</option>
                        <option value="sosial">🤝 Sosial/Bantuan</option>
                        <option value="keamanan">🚨 Keamanan</option>
                        <option value="lainnya">📦 Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Lokasi Kejadian *</label>
                    <div class="relative">
                        <i class="absolute left-2.5 top-2.5 text-gray-400 w-4 h-4" data-lucide="map-pin"></i>
                        <input 
                            type="text"
                            name="location"
                            required
                            placeholder="RT 03 / Dusun Makmur" 
                            class="w-full pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all"
                        />
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Isi Laporan Lengkap *</label>
                <textarea 
                    name="description"
                    rows="3"
                    required
                    placeholder="Jelaskan kronologi, rincian masalah, atau saran secara jelas..." 
                    class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all"
                ></textarea>
            </div>

            <!-- Anonymity and Author -->
            <div class="grid grid-cols-2 gap-3 items-end">
                <div>
                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-700 cursor-pointer select-none mb-2">
                        <input 
                            type="checkbox"
                            id="anonCheckbox"
                            name="is_anonymous"
                            value="1"
                            onchange="toggleAuthorField(this.checked)"
                            class="rounded text-yellow-600 focus:ring-yellow-500"
                        />
                        Laporkan sebagai Anonim
                    </label>
                    <div class="relative" id="authorField">
                        <i class="absolute left-2.5 top-2.5 text-gray-400 w-4 h-4" data-lucide="user"></i>
                        <input 
                            type="text"
                            name="author"
                            placeholder="Nama Lengkap Anda" 
                            class="w-full pl-8 pr-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-yellow-500 text-sm transition-all"
                        />
                    </div>
                </div>

                <!-- Proof Image Upload -->
                <div class="relative border border-dashed border-gray-300 rounded-lg p-2 text-center hover:bg-gray-50 bg-gray-50/20 hover:border-yellow-500 cursor-pointer">
                    <input 
                        type="file" 
                        name="complaint_image"
                        accept="image/*"
                        onchange="updateImageLabel(this)"
                        class="absolute inset-0 opacity-0 cursor-pointer"
                    />
                    <div class="flex flex-col items-center justify-center py-1" id="uploadPlaceholder">
                        <i class="w-4 h-4 text-gray-400 mb-0.5" data-lucide="file-image"></i>
                        <p class="text-[10px] text-gray-600 font-bold" id="fileLabelText">Unggah Bukti Foto</p>
                    </div>
                </div>
            </div>

            <!-- Submission Trigger -->
            <div class="pt-2">
                <button 
                    type="submit"
                    class="w-full py-3 bg-yellow-600 font-bold text-white rounded-lg hover:bg-yellow-700 transition-all flex items-center justify-center gap-2 text-sm shadow-md"
                >
                    <i class="w-4 h-4 text-white" data-lucide="send"></i>
                    Kirim Laporan Aduan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // JS helpers specific to report modal
    function toggleAuthorField(isAnon) {
        const authorField = document.getElementById('authorField');
        if (isAnon) {
            authorField.classList.add('hidden');
        } else {
            authorField.classList.remove('hidden');
        }
    }

    function updateImageLabel(input) {
        const labelText = document.getElementById('fileLabelText');
        if (input.files && input.files[0]) {
            labelText.innerText = "✓ " + input.files[0].name.substring(0, 15) + "...";
            labelText.classList.add('text-green-600');
        }
    }
</script>
