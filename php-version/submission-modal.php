<?php
// PHP Version: Document Submission Modal (Wizard Mode)
?>
<!-- Document Submission Modal (Form Wizard) -->
<div id="submissionModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/60 overflow-y-auto">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden glass-card">
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 bg-primary text-white">
            <div class="text-left">
                <h3 class="text-xl font-bold font-display">Pengajuan Dokumen Digital</h3>
                <p id="submissionModalServiceTitle" class="text-xs text-white/80 mt-0.5">Penerbitan KTP & Kartu Keluarga Baru</p>
            </div>
            <button 
                onclick="closeSubmissionModal()" 
                class="p-1 rounded-full hover:bg-white/15 transition-colors"
            >
                <i class="w-5 h-5 text-white" data-lucide="x"></i>
            </button>
        </div>

        <!-- Steps Tracker Progress Bar -->
        <div class="flex justify-between items-center px-10 py-4 bg-emerald-50/50 border-b border-gray-100">
            <?php for ($s=1; $s<=4; $s++): ?>
            <div class="flex items-center">
                <div 
                    id="wizardStepIndicator-<?php echo $s; ?>"
                    class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-all shadow-sm bg-white text-gray-400 border border-gray-200"
                >
                    <?php echo $s; ?>
                </div>
                <?php if ($s < 4): ?>
                    <div id="wizardStepConnector-<?php echo $s; ?>" class="h-1 w-12 sm:w-20 ml-2 bg-gray-200" style="margin-right: 0.5rem"></div>
                <?php endif; ?>
            </div>
            <?php endfor; ?>
        </div>

        <!-- Form Wizard Action Frame -->
        <form id="wizardForm" action="submit-service.php" method="POST" enctype="multipart/form-data" class="text-left">
            <input type="hidden" name="service_id" id="formServiceId" value="">
            <input type="hidden" name="service_name" id="formServiceName" value="">
            <input type="hidden" name="tracking_id" id="formTrackingId" value="">

            <div class="p-6 max-h-[60vh] overflow-y-auto">
                <div id="wizardErrorMessage" class="hidden mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded text-red-700 text-sm flex items-center gap-2">
                    <span class="font-semibold">Galat:</span> <span id="errorText"></span>
                </div>

                <!-- STEP 1: Persyaratan -->
                <div id="wizardStepContent-1" class="space-y-4">
                    <div class="p-4 rounded-xl bg-primary-bg border border-primary/10 flex gap-3">
                        <i class="w-6 h-6 text-primary flex-shrink-0" data-lucide="shield-check"></i>
                        <div>
                            <h4 class="font-semibold text-primary text-sm font-display">Sistem Keamanan Terjamin</h4>
                            <p class="text-xs text-on-surface-variant leading-relaxed">Seluruh data yang Anda masukkan dilindungi dengan enkripsi tinggi dan hanya digunakan untuk kepentingan pengurusan administrasi desa.</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Berkas Persyaratan Wajib:</h4>
                        <div id="requirementsListContainer" class="grid grid-cols-1 gap-2">
                            <!-- Populated via JS -->
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-4 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <i class="w-4 h-4 text-primary-light" data-lucide="clock"></i>
                                <div>
                                    <p class="font-semibold text-gray-700">Estimasi Selesai</p>
                                    <p id="requirementsDurationText">2 - 3 Hari Kerja</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="w-4 h-4 text-primary-light" data-lucide="credit-card"></i>
                                <div>
                                    <p class="font-semibold text-gray-700">Biaya Layanan</p>
                                    <p class="text-emerald-700 font-bold" id="requirementsCostText">Gratis (Bebas Biaya)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Data Diri -->
                <div id="wizardStepContent-2" class="hidden space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nomor Induk Kependudukan (NIK) *</label>
                            <div class="relative">
                                <i class="absolute left-3 top-3.5 text-gray-400 w-4 h-4" data-lucide="credit-card"></i>
                                <input 
                                    type="text" 
                                    name="nik"
                                    id="inputNik"
                                    maxlength="16"
                                    oninput="this.value = this.value.replace(/\D/g, '')"
                                    placeholder="Masukkan 16 digit NIK" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                                />
                            </div>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nama Lengkap Sesuai KTP *</label>
                            <div class="relative">
                                <i class="absolute left-3 top-3.5 text-gray-400 w-4 h-4" data-lucide="user"></i>
                                <input 
                                    type="text" 
                                    name="name"
                                    id="inputName"
                                    placeholder="Masukkan nama lengkap Anda" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nomor Telepon / WhatsApp *</label>
                            <div class="relative">
                                <i class="absolute left-3 top-3.5 text-gray-400 w-4 h-4" data-lucide="phone"></i>
                                <input 
                                    type="tel" 
                                    name="phone"
                                    id="inputPhone"
                                    placeholder="Contoh: 081234567890" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Alamat Email Aktif *</label>
                            <div class="relative">
                                <i class="absolute left-3 top-3.5 text-gray-400 w-4 h-4" data-lucide="mail"></i>
                                <input 
                                    type="email" 
                                    name="email"
                                    id="inputEmail"
                                    placeholder="nama@email.com" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                                />
                            </div>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Alamat Lengkap Rumah (RT/RW) *</label>
                            <div class="relative">
                                <i class="absolute left-3 top-4.5 text-gray-400 w-4 h-4" data-lucide="map-pin"></i>
                                <textarea 
                                    name="address"
                                    id="inputAddress"
                                    rows="2"
                                    placeholder="Contoh: Jl. Merpati No. 12, RT 02 / RW 05" 
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary focus:border-transparent text-sm transition-all"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: Dokumen Pendukung -->
                <div id="wizardStepContent-3" class="hidden space-y-4">
                    <div class="p-6 border-2 border-dashed border-gray-300 hover:border-primary rounded-xl text-center bg-gray-50/50 hover:bg-primary-bg/20 transition-all group relative cursor-pointer">
                        <input 
                            type="file" 
                            name="document_files[]"
                            multiple
                            onchange="updateFilesList(this)"
                            class="absolute inset-0 opacity-0 cursor-pointer"
                        />
                        <i class="mx-auto text-gray-400 group-hover:text-primary transition-colors mb-3 w-10 h-10" data-lucide="upload-cloud"></i>
                        <p class="text-sm font-semibold text-gray-700">Tarik berkas ke sini atau klik untuk menelusuri</p>
                        <p class="text-xs text-gray-400 mt-1">Mendukung format PDF, JPG, PNG (Maks 5MB per berkas)</p>
                    </div>

                    <div id="uploadedFilesWrapper" class="hidden space-y-2">
                        <h5 class="font-bold text-xs text-gray-500 uppercase tracking-wide">Berkas Terpilih</h5>
                        <div id="uploadedFilesList" class="space-y-2 max-h-48 overflow-y-auto">
                            <!-- JS populated list -->
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Ringkasan Pengajuan -->
                <div id="wizardStepContent-4" class="hidden space-y-4 text-center py-6">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="w-10 h-10 text-emerald-600" data-lucide="check"></i>
                    </div>
                    <h4 class="text-lg font-bold font-display text-gray-800">Dokumen Siap Diajukan</h4>
                    <p class="text-sm text-gray-500 max-w-md mx-auto">Harap simpan Kode Pelacakan (Tracking Code) di bawah ini untuk memantau status pengajuan berkas administrasi Anda.</p>

                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl max-w-sm mx-auto my-4 space-y-2">
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Kode Pelacakan Anda</p>
                        <p id="requirementsTrackingCode" class="text-xl font-bold font-mono text-primary select-all tracking-wide">WD-SERVICES-XXXX</p>
                        <p class="text-[10px] text-emerald-700 font-medium">✨ Salin kode ini untuk melacak status di halaman Layanan Publik</p>
                    </div>

                    <div class="border-t border-gray-100 pt-4 text-left space-y-2 text-xs text-gray-600 max-w-md mx-auto">
                        <div class="flex justify-between"><span class="text-gray-400">Pemohon:</span> <span id="summaryName" class="font-semibold text-gray-800">-</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">NIK:</span> <span id="summaryNik" class="font-semibold font-mono text-gray-800">-</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Jenis Dokumen:</span> <span id="summaryService" class="font-semibold text-gray-800">-</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Jumlah Lampiran:</span> <span id="summaryFilesCount" class="font-semibold text-gray-800">0 berkas</span></div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer Buttons -->
            <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                <button 
                    type="button"
                    id="wizardPrevBtn"
                    onclick="stepBack()"
                    class="hidden flex items-center gap-1 text-sm font-semibold text-gray-600 hover:text-gray-800 py-2 px-3"
                >
                    <i class="w-4 h-4" data-lucide="chevron-left"></i> Kembali
                </button>
                <div id="flexFooterBalancer"></div>

                <button 
                    type="button"
                    id="wizardNextBtn"
                    onclick="stepForward()"
                    class="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:opacity-90 flex items-center gap-1.5 transition-all text-sm ml-auto"
                >
                    Lanjutkan <i class="w-4 h-4 text-white" data-lucide="chevron-right"></i>
                </button>

                <button 
                    type="submit"
                    id="wizardSubmitBtn"
                    class="hidden px-8 py-3 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 shadow-md flex items-center gap-1.5 mx-auto transition-all text-sm"
                >
                    Kirim Pengajuan Sekarang
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // State indicators for form steps
    let currentStep = 1;
    let selectedServiceData = null;

    // Services configurations to feed the requirements and details
    const serviceConfigs = {
        'srv-1': {
            id: 'srv-1',
            title: 'Penerbitan KTP & Kartu Keluarga Baru',
            duration: '2 - 3 Hari Kerja',
            cost: 'Gratis (Bebas Biaya)',
            requirements: [
                'Isi formulir pendaftaran digital pengajuan sipil',
                'Unggah scan KTP asli / Surat Pengantar Kehilangan',
                'Fotokopi Kartu Keluarga lama',
                'Surat Pengantar RT/RW setempat yang ditandatangani basah'
            ]
        },
        'srv-2': {
            id: 'srv-2',
            title: 'Surat Keterangan Pengantar RT / RW',
            duration: '1 Jam (Instan)',
            cost: 'Gratis (Bebas Biaya)',
            requirements: [
                'NIK terdaftar valid di basis data kependudukan desa',
                'Scan asli KTP pemohon',
                'Deskripsi jelas mengenai maksud peruntukan surat pengantar'
            ]
        },
        'srv-3': {
            id: 'srv-3',
            title: 'Registrasi Akta Kelahiran Baru',
            duration: '3 - 5 Hari Kerja',
            cost: 'Gratis (Bebas Biaya)',
            requirements: [
                'Surat keterangan kelahiran asli dari Bidan, Puskesmas, atau Rumah Sakit',
                'Fotokopi Buku Nikah / Kutipan Akta Perkawinan orang tua',
                'Scan KTP kedua orang tua kandung & minimal 2 orang saksi',
                'Scan Kartu Keluarga asli orang tua'
            ]
        },
        'srv-4': {
            id: 'srv-4',
            title: 'Permohonan Bantuan Sosial Mandiri',
            duration: '7 Hari Kerja Verifikasi',
            cost: 'Gratis (Bebas Biaya)',
            requirements: [
                'Surat Pernyataan Tidak Mampu ditandatangani RT & RW setempat',
                'Foto kondisi fisik rumah bagian tampak depan dan ruang tamu dalam',
                'KTP asli & Kartu Keluarga pemohon utama',
                'Slip gaji / Surat keterangan penghasilan bulanan di bawah upah minimum'
            ]
        },
        'srv-5': {
            id: 'srv-5',
            title: 'Izin Domisili Usaha Mikro & Niaga',
            duration: '1 - 2 Hari Kerja',
            cost: 'Gratis (Bebas Biaya)',
            requirements: [
                'Scan KTP penanggung jawab usaha',
                'Foto fisik lokasi tempat usaha mikro',
                'Persetujuan tertulis bertandatangan tetangga radius terdekat usaha',
                'Surat pengantar kepemilikan lahan atau bukti perjanjian sewa tempat'
            ]
        }
    };

    function openSubmissionModal(serviceId) {
        selectedServiceData = serviceConfigs[serviceId];
        if (!selectedServiceData) return;

        // Reset wizard step parameters
        currentStep = 1;
        document.getElementById('formServiceId').value = selectedServiceData.id;
        document.getElementById('formServiceName').value = selectedServiceData.title;
        document.getElementById('submissionModalServiceTitle').innerText = selectedServiceData.title;
        document.getElementById('requirementsDurationText').innerText = selectedServiceData.duration;
        document.getElementById('requirementsCostText').innerText = selectedServiceData.cost;

        // Reset forms input values
        document.getElementById('inputNik').value = '';
        document.getElementById('inputName').value = '';
        document.getElementById('inputPhone').value = '';
        document.getElementById('inputEmail').value = '';
        document.getElementById('inputAddress').value = '';
        document.getElementById('uploadedFilesWrapper').classList.add('hidden');
        document.getElementById('uploadedFilesList').innerHTML = '';

        // Reset wizard layout states
        toggleWizardLayouts();

        // Feed list of requirements
        const listContainer = document.getElementById('requirementsListContainer');
        listContainer.innerHTML = '';
        selectedServiceData.requirements.forEach((req, idx) => {
            listContainer.innerHTML += `
                <div class="flex items-start gap-2.5 p-3 rounded-lg border border-gray-100 bg-gray-50/50">
                    <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                        ${idx + 1}
                    </span>
                    <p class="text-sm text-gray-700">${req}</p>
                </div>
            `;
        });

        toggleModal('submissionModal', true);
    }

    function closeSubmissionModal() {
        toggleModal('submissionModal', false);
    }

    function toggleWizardLayouts() {
        // Manage indicators style
        for (let s = 1; s <= 4; s++) {
            const ind = document.getElementById('wizardStepIndicator-' + s);
            const con = document.getElementById('wizardStepConnector-' + s);
            const content = document.getElementById('wizardStepContent-' + s);

            if (currentStep === s) {
                ind.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-all shadow-sm bg-primary text-white ring-4 ring-primary-light/25";
                content.classList.remove('hidden');
            } else if (currentStep > s) {
                ind.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-all shadow-sm bg-emerald-600 text-white";
                content.classList.add('hidden');
            } else {
                ind.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm transition-all shadow-sm bg-white text-gray-400 border border-gray-200";
                content.classList.add('hidden');
            }

            if (con) {
                if (currentStep > s) {
                    con.className = "h-1 w-12 sm:w-20 ml-2 bg-emerald-600";
                } else {
                    con.className = "h-1 w-12 sm:w-20 ml-2 bg-gray-200";
                }
            }
        }

        // Manage button visibility rules
        const prevBtn = document.getElementById('wizardPrevBtn');
        const nextBtn = document.getElementById('wizardNextBtn');
        const submitBtn = document.getElementById('wizardSubmitBtn');
        const balancer = document.getElementById('flexFooterBalancer');

        if (currentStep > 1 && currentStep < 4) {
            prevBtn.classList.remove('hidden');
            balancer.classList.add('hidden');
        } else {
            prevBtn.classList.add('hidden');
            balancer.classList.remove('hidden');
        }

        if (currentStep < 4) {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        } else {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        }

        document.getElementById('wizardErrorMessage').classList.add('hidden');
    }

    function validateStep(step) {
        if (step === 2) {
            const nik = document.getElementById('inputNik').value;
            const name = document.getElementById('inputName').value;
            const phone = document.getElementById('inputPhone').value;
            const email = document.getElementById('inputEmail').value;
            const address = document.getElementById('inputAddress').value;

            if (!nik || !name || !phone || !email || !address) {
                showWizardError('Harap lengkapi semua data diri wajib!');
                return false;
            }
            if (nik.length < 16) {
                showWizardError('NIK harus berjumlah 16 digit angka!');
                return false;
            }
        }
        return true;
    }

    function showWizardError(msg) {
        document.getElementById('errorText').innerText = msg;
        document.getElementById('wizardErrorMessage').classList.remove('hidden');
    }

    function stepForward() {
        if (!validateStep(currentStep)) return;

        if (currentStep < 4) {
            currentStep++;
            if (currentStep === 4) {
                // Generate a random tracking code to offer instant layout feed
                const rand = Math.floor(1000 + Math.random() * 9000);
                const trackCode = 'WD-SERVICES-' + rand;
                document.getElementById('formTrackingId').value = trackCode;
                document.getElementById('requirementsTrackingCode').innerText = trackCode;

                // Bind Summary Details
                document.getElementById('summaryNik').innerText = document.getElementById('inputNik').value;
                document.getElementById('summaryName').innerText = document.getElementById('inputName').value;
                document.getElementById('summaryService').innerText = selectedServiceData.title;
            }
            toggleWizardLayouts();
        }
    }

    function stepBack() {
        if (currentStep > 1) {
            currentStep--;
            toggleWizardLayouts();
        }
    }

    function updateFilesList(input) {
        const wrapper = document.getElementById('uploadedFilesWrapper');
        const list = document.getElementById('uploadedFilesList');
        list.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            wrapper.classList.remove('hidden');
            document.getElementById('summaryFilesCount').innerText = input.files.length + ' berkas';
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                list.innerHTML += `
                    <div class="flex items-center justify-between p-3 rounded-lg border border-gray-100 bg-white shadow-sm">
                        <div class="flex items-center gap-3 overflow-hidden text-left">
                            <i class="w-5 h-5 text-primary-light" data-lucide="file-text"></i>
                            <div>
                                <p class="text-xs font-semibold text-gray-700 truncate max-w-[180px]">${file.name}</p>
                                <p class="text-[10px] text-gray-400">${fileSize}</p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded text-[10px] font-bold">Siap Kirim</span>
                    </div>
                `;
            }
            lucide.createIcons();
        } else {
            wrapper.classList.add('hidden');
            document.getElementById('summaryFilesCount').innerText = '0 berkas';
        }
    }
</script>
