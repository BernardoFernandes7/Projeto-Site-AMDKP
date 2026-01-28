<?php
require 'conection.php'; 

$page_title = "Dojos | AMDKP";


try {
    $stmt = $dbh->query("SELECT * FROM dojos WHERE ativo = 1 ORDER BY localidade ASC, nome ASC");
    $escolas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar dojos: " . $e->getMessage());
}


$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$base_url_gal = "https://www.amdkp.pt/0website/portal/galeria/";
$logo_principal = $base_url_img . "4AMDKP.png";
$link_area_res = "https://script.google.com/macros/s/AKfycbxQyuu3nE0_dneKg6RdJxYn_CaGykai14-FG2R2taz1iM9Wh5TNQDtQvVdlu3zyvsedPQ/exec";


$link_galeria_interna = "galeria.php";
$link_backoffice = "admin_dojos.php"; 

$navegacao = [
    'amdkp' => [
        'label' => 'AMDKP',
        'url'   => '#',
        'submenu' => [['label' => 'Associação', 'url' => 'associacao.php'], ['label' => 'O Karate (História)', 'url' => 'historia.php'], ['label' => 'Estilo', 'url' => 'estilo.php']]
    ],
    
    'utilidade' => [
        'label' => 'Utilidade Pública',
        'url'   => 'utilidade.php',
        'submenu' => []
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { amdkp: { red: '#D80027', gold: '#d4af37', dark: '#0f0f0f', silver: '#c0c0c0', panel: '#1a1a1a' } },
                    fontFamily: { sans: ['Montserrat', 'sans-serif'], oswald: ['Oswald', 'sans-serif'] },
                    animation: { 'fade-in': 'fadeIn 0.5s ease-out' },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-amdkp-dark text-white">

    <header>
        <div class="navbar-container">
            <a href="index.php" class="logo-text">
                <img src="<?php echo $logo_principal; ?>" style="height: 40px; margin-right: 10px;">
                <span>AMDK-P</span>
            </a>
            <nav class="nav-center hidden lg:flex">
                <?php foreach ($navegacao as $key => $item): ?>
                    <div class="nav-item-dropdown group">
                        <a href="<?php echo $item['url']; ?>" class="nav-link-custom"><?php echo $item['label']; ?></a>
                        <?php if (!empty($item['submenu'])): ?>
                            <div class="dropdown-menu">
                                <?php foreach ($item['submenu'] as $sub): ?><a href="<?php echo $sub['url']; ?>" class="dropdown-item"><?php echo $sub['label']; ?></a><?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>
            <div style="display: flex; gap: 10px;" class="items-center">
                <button id="openGalleryInfoBtn" class="cta-outline header-btn"><i class="fas fa-images"></i> <span class="hidden sm:inline">Galeria</span></button>
            </div>
        </div>
    </header>

    <main class="relative z-10 pt-32 pb-20 px-6 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="font-oswald text-4xl text-amdkp-gold uppercase border-b-4 border-amdkp-red inline-block mb-4 tracking-wide">
                    Dojos
                </h1>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Conheça os nossos dojos
                </p>
            </div>

            <div class="max-w-xl mx-auto mb-12 relative animate-fade-in">
                <div class="relative">
                    <input type="text" id="dojoSearch" placeholder="Pesquisar por nome ou localidade..." 
                           class="w-full bg-[#1a1a1a] border border-white/20 rounded-full py-3 pl-12 pr-4 text-white placeholder-gray-500 focus:outline-none focus:border-amdkp-gold focus:ring-1 focus:ring-amdkp-gold transition-all shadow-lg">
                    <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php if (empty($escolas)): ?>
                    <div class="col-span-full text-center text-gray-500">Nenhum dojo encontrado.</div>
                <?php else: ?>
                    <?php foreach ($escolas as $escola): ?>
                        
                        <a href="ver_dojo.php?id=<?php echo $escola['id']; ?>" 
                           class="dojo-card group bg-amdkp-panel rounded-xl overflow-hidden shadow-lg border border-amdkp-gold hover:border-white hover:shadow-amdkp-gold/20 transition-all duration-300 hover:-translate-y-2 block relative"
                           data-search="<?php echo strtolower($escola['nome'] . ' ' . $escola['localidade']); ?>">
                            
                            <div class="h-56 w-full bg-white flex items-center justify-center p-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition z-10"></div>
                                
                                <img src="<?php echo $escola['logourl'] ?: 'https://www.amdkp.pt/0website/semfoto.png'; ?>" 
                                     class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-700">
                                
                                <div class="absolute bottom-0 left-0 bg-amdkp-red text-white text-xs font-bold px-3 py-1 uppercase z-20">
                                    <?php echo $escola['localidade']; ?>
                                </div>
                            </div>

                            <div class="p-5 text-center relative">
                                <div class="w-8 h-1 bg-amdkp-red mx-auto mb-3"></div>
                                
                                <h3 class="text-xl font-oswald text-white mb-1 group-hover:text-amdkp-gold transition-colors truncate">
                                    <?php echo $escola['nome']; ?>
                                </h3>
                                <p class="text-sm text-gray-400">Sensei <?php echo $escola['sensei']; ?></p>
                            </div>
                        </a>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div id="noResults" class="hidden text-center py-10">
                <p class="text-gray-500 font-oswald uppercase tracking-wide">Nenhum dojo encontrado com esse nome.</p>
            </div>

        </div>
    </main>

    <footer>
        <div class="footer-content text-center py-8 border-t border-[#222]">
            <p class="text-gray-500">&copy; <?php echo date("Y"); ?> AMDKP. Todos os direitos reservados.</p>
        </div>
    </footer>

    <button id="openAdminBtn" class="fixed bottom-7 left-7 z-50 w-12 h-12 rounded-full bg-black/80 text-gray-500 hover:text-amdkp-gold border border-white/10 hover:border-amdkp-gold flex items-center justify-center transition-all shadow-2xl opacity-50 hover:opacity-100 group" title="Gestão de Dojos">
        <i class="fas fa-cog text-xl group-hover:rotate-90 transition-transform duration-700"></i>
    </button>

    <div id="galleryInfoModal" class="fixed inset-0 z-[3000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-silver m-0 font-oswald">Galeria AMDKP</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">×</span>
            </div>
            <div class="p-8 text-center flex flex-col items-center">
                <div class="w-full rounded overflow-hidden border border-white/10 bg-black mb-6">
                    <img src="<?php echo $base_url_gal; ?>galeriaamdkp.png" class="w-full block">
                </div>
                <button id="btnProceedToLogin" class="cta-outline px-10 py-4 text-xl font-bold uppercase tracking-wider w-full max-w-md flex justify-center items-center gap-4 hover:bg-white hover:text-black transition-all duration-300 shadow-lg">
                    <i class="fas fa-lock"></i> Entrar na Galeria
                </button>
            </div>
        </div>
    </div>

    <div id="loginModal" class="fixed inset-0 z-[3100] hidden bg-black/95 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[90%] max-w-md mx-auto my-32 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl border border-amdkp-gold/50 animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6 bg-[#111] border-b border-white/10">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-gold m-0 font-oswald flex items-center gap-2">
                    <i class="fas fa-user-shield"></i> Autenticação
                </h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all" onclick="document.getElementById('loginModal').classList.add('hidden')">×</span>
            </div>
            <div class="p-8">
                <p class="text-sm text-gray-400 mb-6 text-center">Introduza as credenciais de acesso à Galeria.</p>
                <form id="loginForm" class="space-y-4">
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-amdkp-silver mb-1 font-bold">Utilizador</label>
                        <input type="text" id="username" name="username" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-amdkp-gold focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-amdkp-silver mb-1 font-bold">Password</label>
                        <input type="password" id="password" name="password" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-amdkp-gold focus:outline-none transition-colors">
                    </div>
                    <div id="loginError" class="hidden text-amdkp-red text-xs font-bold text-center bg-red-900/20 p-2 rounded animate-pulse">
                        <i class="fas fa-exclamation-circle"></i> Dados incorretos.
                    </div>
                    <button type="submit" class="w-full py-3 bg-amdkp-gold text-black font-bold uppercase tracking-widest rounded hover:bg-white transition-all shadow-lg mt-4">
                        Aceder <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="adminLoginModal" class="fixed inset-0 z-[3200] hidden bg-black/95 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[90%] max-w-md mx-auto my-32 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl border border-white/20 animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6 bg-[#111] border-b border-white/10">
                <h2 class="text-lg tracking-[0.18em] uppercase text-white m-0 font-oswald flex items-center gap-2">
                    <i class="fas fa-cogs"></i> Gestão
                </h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all" onclick="document.getElementById('adminLoginModal').classList.add('hidden')">×</span>
            </div>
            <div class="p-8">
                <p class="text-sm text-gray-400 mb-6 text-center">Acesso restrito ao Backoffice.</p>
                <form id="adminLoginForm" class="space-y-4">
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1 font-bold">Utilizador</label>
                        <input type="text" id="adminUser" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-white focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-gray-500 mb-1 font-bold">Password</label>
                        <input type="password" id="adminPass" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-white focus:outline-none transition-colors">
                    </div>
                    <div id="adminLoginError" class="hidden text-amdkp-red text-xs font-bold text-center bg-red-900/20 p-2 rounded animate-pulse">
                        <i class="fas fa-exclamation-circle"></i> Dados inválidos.
                    </div>
                    <button type="submit" class="w-full py-3 bg-white text-black font-bold uppercase tracking-widest rounded hover:bg-gray-200 transition-all shadow-lg mt-4">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const searchInput = document.getElementById('dojoSearch');
            const noResultsMsg = document.getElementById('noResults');

            if(searchInput) {
                searchInput.addEventListener('keyup', function() {
                    let filter = this.value.toLowerCase();
                    let cards = document.querySelectorAll('.dojo-card');
                    let visibleCount = 0;

                    cards.forEach(card => {
                        let searchContent = card.getAttribute('data-search');
                        if (searchContent.includes(filter)) {
                            card.style.display = ""; 
                            card.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            card.style.display = "none"; 
                            card.classList.add('hidden');
                        }
                    });

                    if(visibleCount === 0) noResultsMsg.classList.remove('hidden');
                    else noResultsMsg.classList.add('hidden');
                });
            }

            
            const openInfoBtn = document.getElementById('openGalleryInfoBtn');
            const infoModal = document.getElementById('galleryInfoModal');
            const proceedBtn = document.getElementById('btnProceedToLogin');
            const loginModal = document.getElementById('loginModal');
            const loginForm = document.getElementById('loginForm');
            const errorMsg = document.getElementById('loginError');

            if(openInfoBtn && infoModal) openInfoBtn.addEventListener('click', () => infoModal.classList.remove('hidden'));

            if(proceedBtn) {
                proceedBtn.addEventListener('click', () => {
                    infoModal.classList.add('hidden');
                    loginModal.classList.remove('hidden');
                    errorMsg.classList.add('hidden');
                    document.getElementById('username').value = '';
                    document.getElementById('password').value = '';
                });
            }

            if(loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const user = document.getElementById('username').value;
                    const pass = document.getElementById('password').value;

                    fetch('conta_admin.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username: user, password: pass })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) window.location.href = '<?php echo $link_galeria_interna; ?>';
                        else errorMsg.classList.remove('hidden');
                    })
                    .catch(() => errorMsg.classList.remove('hidden'));
                });
            }

            
            const adminBtn = document.getElementById('openAdminBtn');
            const adminModal = document.getElementById('adminLoginModal');
            const adminForm = document.getElementById('adminLoginForm');
            const adminError = document.getElementById('adminLoginError');

            if(adminBtn && adminModal) {
                adminBtn.addEventListener('click', () => {
                    adminModal.classList.remove('hidden');
                    adminError.classList.add('hidden');
                    document.getElementById('adminUser').value = '';
                    document.getElementById('adminPass').value = '';
                });
            }

            if(adminForm) {
                adminForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const user = document.getElementById('adminUser').value;
                    const pass = document.getElementById('adminPass').value;

                   
                    fetch('conta_admin.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ username: user, password: pass })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            
                            window.location.href = '<?php echo $link_backoffice; ?>';
                        } else {
                            adminError.classList.remove('hidden');
                        }
                    })
                    .catch(() => adminError.classList.remove('hidden'));
                });
            }

            
            window.addEventListener('click', (e) => {
                if (e.target.id === 'galleryInfoModal') infoModal.classList.add('hidden');
                if (e.target.id === 'loginModal') loginModal.classList.add('hidden');
                if (e.target.id === 'adminLoginModal') adminModal.classList.add('hidden');
            });

            document.querySelectorAll('.close-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const modal = this.closest('div[id$="Modal"]');
                    if(modal) modal.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>