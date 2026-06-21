<?php
// PHP Version: Header Component
// Receives active page indicator and searchQuery string to style properly

if (!isset($page)) {
    $page = 'profile';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Desa Sukamaju | Website Resmi Pemerintah Desa</title>
    <!-- Google Fonts: Inter, Montserrat, Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN for instantaneous styling/execution on local servers -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#154212',
                        'primary-light': '#2d5a27',
                        'primary-bg': '#f3f8f2',
                        'primary-dark': '#0a2508',
                        secondary: '#795900',
                        'secondary-light': '#ffc641',
                        'secondary-bg': '#fffbf0',
                        accent: '#3b6934',
                        'neutral-dark': '#121c28',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons Library Integration -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafbfc;
            color: #121c28;
            scroll-behavior: smooth;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col transition-all">

    <!-- Header Frame -->
    <header class="bg-white sticky top-0 z-40 transition-all border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo -->
                <a href="index.php?page=profile" class="flex items-center gap-2 cursor-pointer group">
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center font-bold text-white shadow-md shadow-primary/20 group-hover:scale-105 transition-all">
                        WD
                    </div>
                    <span class="font-display text-2xl font-black text-primary tracking-tight">
                        Web<span class="text-[#795900]">Desa</span>
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-1 lg:space-x-4 items-center">
                    <a href="index.php?page=profile" class="px-4 py-2 rounded-lg font-medium text-sm transition-all relative <?php echo ($page === 'profile') ? 'text-primary font-bold' : 'text-gray-500 hover:text-primary hover:bg-gray-50'; ?>">
                        Profil Desa
                        <?php if ($page === 'profile'): ?>
                            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full"></span>
                        <?php endif; ?>
                    </a>
                    <a href="index.php?page=services" class="px-4 py-2 rounded-lg font-medium text-sm transition-all relative <?php echo ($page === 'services') ? 'text-primary font-bold' : 'text-gray-500 hover:text-primary hover:bg-gray-50'; ?>">
                        Layanan Publik
                        <?php if ($page === 'services'): ?>
                            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full"></span>
                        <?php endif; ?>
                    </a>
                    <a href="index.php?page=potential" class="px-4 py-2 rounded-lg font-medium text-sm transition-all relative <?php echo ($page === 'potential') ? 'text-primary font-bold' : 'text-gray-500 hover:text-primary hover:bg-gray-50'; ?>">
                        Potensi Wisata
                        <?php if ($page === 'potential'): ?>
                            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full"></span>
                        <?php endif; ?>
                    </a>
                    <a href="index.php?page=news" class="px-4 py-2 rounded-lg font-medium text-sm transition-all relative <?php echo ($page === 'news') ? 'text-primary font-bold' : 'text-gray-500 hover:text-primary hover:bg-gray-50'; ?>">
                        Kabar & Berita
                        <?php if ($page === 'news'): ?>
                            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full"></span>
                        <?php endif; ?>
                    </a>
                </nav>

                <!-- Action Button Triggers -->
                <div class="flex items-center gap-3 lg:gap-4">
                    
                    <!-- Search Input Box -->
                    <form method="GET" action="index.php" class="relative hidden sm:block">
                        <input type="hidden" name="page" value="<?php echo htmlspecialchars($page); ?>">
                        <i data-lucide="search" class="absolute left-3.5 top-3.5 text-gray-400 w-4 h-4"></i>
                        <input 
                            type="text" 
                            name="search" 
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                            placeholder="<?php echo ($page === 'services') ? 'Cari layanan desa...' : (($page === 'news') ? 'Cari berita desa...' : 'Cari info desa...'); ?>"
                            class="w-48 lg:w-64 pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-100 rounded-full text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white focus:border-transparent transition-all shadow-inner"
                        />
                    </form>

                    <!-- E-Sambat trigger button (triggers an overlay modal in bootstrap/JS) -->
                    <button 
                        onclick="toggleModal('reportModal')"
                        class="bg-yellow-600 text-white hover:bg-yellow-700 px-5 py-2.5 rounded-full font-bold text-xs flex items-center gap-1.5 shadow-md shadow-yellow-600/10 active:scale-95 transition-all font-display uppercase tracking-wider"
                    >
                        <i class="w-4 h-4" data-lucide="shield-alert"></i>
                        Aduan &amp; Hubungi Kami
                    </button>

                    <!-- Mobile Menu toggle -->
                    <button 
                        onclick="toggleMobileMenu()"
                        class="md:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600"
                    >
                        <i id="mobileMenuIcon" class="w-6 h-6" data-lucide="menu"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 py-3 px-4 space-y-3 transition-all">
            <!-- Mobile Search -->
            <form method="GET" action="index.php" class="relative">
                <input type="hidden" name="page" value="<?php echo htmlspecialchars($page); ?>">
                <i data-lucide="search" class="absolute left-3 top-3 text-gray-400 w-4 h-4"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                    placeholder="Cari info desa..."
                    class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs"
                />
            </form>

            <div class="grid grid-cols-2 gap-2">
                <a href="index.php?page=profile" class="py-2 px-3 rounded-lg text-center text-xs font-semibold uppercase tracking-wider transition-all <?php echo ($page === 'profile') ? 'bg-primary text-white' : 'bg-gray-50 text-gray-600'; ?>">
                    Profil Desa
                </a>
                <a href="index.php?page=services" class="py-2 px-3 rounded-lg text-center text-xs font-semibold uppercase tracking-wider transition-all <?php echo ($page === 'services') ? 'bg-primary text-white' : 'bg-gray-50 text-gray-600'; ?>">
                    Layanan Publik
                </a>
                <a href="index.php?page=potential" class="py-2 px-3 rounded-lg text-center text-xs font-semibold uppercase tracking-wider transition-all <?php echo ($page === 'potential') ? 'bg-primary text-white' : 'bg-gray-50 text-gray-600'; ?>">
                    Potensi Wisata
                </a>
                <a href="index.php?page=news" class="py-2 px-3 rounded-lg text-center text-xs font-semibold uppercase tracking-wider transition-all <?php echo ($page === 'news') ? 'bg-primary text-white' : 'bg-gray-50 text-gray-600'; ?>">
                    Kabar & Berita
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Frame -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 w-full">
