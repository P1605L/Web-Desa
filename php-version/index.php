<?php
// PHP Version: Main Entry Point (Front Controller Routing System)
// Combines modular layouts, dynamic database queries, and interactive modals seamlessly

// 1. Establish Configuration and Database Connection
require_once 'config.php';

// 2. Resolve requested view page parameter (routing)
$page = isset($_GET['page']) ? sanitizeInput($_GET['page']) : 'profile';
$allowed_pages = ['profile', 'services', 'potential', 'news'];
if (!in_array($page, $allowed_pages)) {
    $page = 'profile';
}

// 3. Include Header Framework (CSS/CDNs, Navigation Menu Links)
require_once 'header.php';

// BANNER E-SAMBAT SUCCESS INJEKSI
if (isset($_GET['sambat_status']) && $_GET['sambat_status'] === 'success'): ?>
    <div class="mb-10 text-left p-6 bg-yellow-50 border-l-4 border-yellow-600 rounded-xl max-w-4xl mx-auto flex gap-4 items-start shadow-sm animate-fade-in">
        <div class="p-2 bg-yellow-100 text-yellow-850 rounded-full">
            <i class="w-6 h-6 text-yellow-600" data-lucide="shield-alert"></i>
        </div>
        <div>
            <h3 class="font-display font-bold text-yellow-950 text-base">Laporan E-Sambat berhasil diajukan</h3>
            <p class="text-xs text-yellow-800 leading-relaxed mt-0.5">Kami telah menerima laporan/aspirasi aduan Anda ke basis data digital kelurahan secara aman. Terimakasih telah peduli demi kemajuan bersama.</p>
            <div class="mt-3 p-3 bg-white font-mono text-xs font-bold text-yellow-700 max-w-sm rounded-lg border border-yellow-105 flex justify-between items-center select-all">
                <span>🎫 KODE TIKET: <?php echo htmlspecialchars($_GET['code']); ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
// 4. Render Active Tab Module dynamically
switch ($page) {
    case 'services':
        require_once 'services-tab.php';
        break;
    case 'potential':
        require_once 'potential-tab.php';
        break;
    case 'news':
        require_once 'news-tab.php';
        break;
    case 'profile':
    default:
        require_once 'profile-tab.php';
        break;
}

// 5. Load Global Overlay Modals (E-Sambat Complaints, and Multi-Step Document filing)
require_once 'report-modal.php';
require_once 'submission-modal.php';

// 6. Include Footer Framework (Lucide triggers, Copyrights)
require_once 'footer.php';
?>
