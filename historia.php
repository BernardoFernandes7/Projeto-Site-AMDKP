<?php
$page_title = "História do Karate | AMDKP";

$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$base_url_gal = "https://www.amdkp.pt/0website/portal/galeria/";
$logo_principal = $base_url_img . "4AMDKP.png";
$link_area_res = "https://script.google.com/macros/s/AKfycbxQyuu3nE0_dneKg6RdJxYn_CaGykai14-FG2R2taz1iM9Wh5TNQDtQvVdlu3zyvsedPQ/exec";


$link_galeria_interna = "galeria.php";

$link_training    = "https://trainingtc.amdkp.pt/athlete/login";
$base_url_vid     = "https://www.amdkp.pt/0website/video/";

$navegacao = [
    'amdkp' => ['label' => 'AMDKP', 'url' => '#', 'submenu' => [['label' => 'Associação', 'url' => 'associacao.php'], ['label' => 'O Karate (História)', 'url' => 'historia.php'], ['label' => 'Estilo', 'url' => 'estilo.php']]],
  
    'utilidade' => ['label' => 'Utilidade Pública', 'url' => 'utilidade.php', 'submenu' => []]
];

$emails = ['presidente' => 'presidente@amdkp.pt', 'geral' => 'geral@amdkp.pt', 'secretaria' => 'secretaria@amdkp.pt', 'assembleia' => 'assembleia.geral@amdkp.pt', 'tecnico' => 'tecnico@amdkp.pt'];
$social = ['facebook' => "https://www.facebook.com/profile.php?id=61565124600449", 'instagram' => "https://www.instagram.com/amdkportugal?igsh=MXg1N3A3cDA2czdrdg==", 'tiktok' => "https://tiktok.com"];
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
                    fontFamily: { sans: ['Montserrat', 'sans-serif'], oswald: ['Oswald', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-amdkp-dark text-white">

    <div class="fixed inset-0 z-0 bg-[#0f0f0f]">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-transparent to-black pointer-events-none"></div>
    </div>

    <header>
        <div class="navbar-container">
            <a href="index.php" class="logo-text"><img src="<?php echo $logo_principal; ?>" style="height: 40px; margin-right: 10px;"><span>AMDK-P</span></a>
            <nav class="nav-center hidden lg:flex">
                <?php foreach ($navegacao as $key => $item): ?>
                    <div class="nav-item-dropdown group">
                        <a href="<?php echo $item['url']; ?>" class="nav-link-custom"><?php echo $item['label']; ?></a>
                        <?php if (!empty($item['submenu'])): ?>
                            <div class="dropdown-menu"><?php foreach ($item['submenu'] as $sub): ?><a href="<?php echo $sub['url']; ?>" class="dropdown-item"><?php echo $sub['label']; ?></a><?php endforeach; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>
            <button id="mobileMenuBtn" class="lg:hidden text-white text-2xl focus:outline-none hover:text-amdkp-red transition-colors"><i class="fas fa-bars"></i></button>
            <div style="display: flex; gap: 10px;" class="items-center">
                <button id="openGalleryInfoBtn" class="cta-outline header-btn"><i class="fas fa-images"></i> <span class="hidden sm:inline">Galeria</span></button>
                </div>
        </div>
        <div id="mobileMenuContainer" class="lg:hidden absolute w-full left-0 top-[100%] shadow-xl bg-amdkp-panel">
            <?php foreach ($navegacao as $key => $item): ?>
                <div class="border-b border-white/10">
                    <?php if (!empty($item['submenu'])): ?>
                        <button class="mobile-link-parent w-full text-left" onclick="toggleMobileSubmenu('sub-<?php echo $key; ?>', this)"><?php echo $item['label']; ?> <i class="fas fa-chevron-down text-sm transition-transform duration-300"></i></button>
                        <div id="sub-<?php echo $key; ?>" class="mobile-submenu"><?php foreach ($item['submenu'] as $sub): ?><a href="<?php echo $sub['url']; ?>" class="mobile-sublink"><?php echo $sub['label']; ?></a><?php endforeach; ?></div>
                    <?php else: ?>
                        <a href="<?php echo $item['url']; ?>" class="mobile-link-parent hover:text-amdkp-gold"><?php echo $item['label']; ?></a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </header>

    <main class="relative z-10 pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto">
            <section class="animate-fade-in">
                <h1 class="font-oswald text-4xl text-white uppercase border-b-4 border-amdkp-red inline-block mb-10 tracking-wide">História do Karate</h1>
                <div class="text-gray-300 space-y-6 text-lg leading-relaxed text-justify font-sans">
                    <p>Artes Marciais já existem há milhares de anos não havendo registos precisos da sua criação. Sabe-se que foi na antiga Índia, há mais de 2000 anos, que surgiu o primeiro tipo de luta sistematizado denominada <strong>Vajramushti</strong>, mais tarde tendo uma derivação da conhecida arte marcial <strong>Kalarippayatt</strong>.</p>
                    <p>Em 520 A.D., um monge budista chamado <strong>Bodhidharma</strong> viajou da Índia para a China para ensinar Budismo no Templo Shaolin. Os ensinamentos de Bodhidharma são reconhecidos como a base de um estilo de arte marcial chamado Shaolin Kung Fu.</p>
                    <p>Cinco monges tornaram-se conhecidos como “Os Cinco Ancestrais“. Considera-se que este facto deu origem aos cinco estilos básicos de Kung Fu: Tigre, Dragão, Leopardo, Serpente e Grou.</p>
                    <div class="p-6 bg-white/5 border-l-4 border-amdkp-gold rounded-r-lg my-8"><p class="mb-0 text-white italic">Como cidadãos chineses emigraram para as ilhas de Okinawa, novos sistemas se desenvolveram. O nome genérico dado às formas de luta de Okinawa foi “Te”, que significa “mão”.</p></div>
                    <p>Na Okinawa do século XVIII, desenvolveram-se três centros importantes: Shuri, Naha e Tomari. Consequentemente os três estilos básicos tornaram-se conhecidos como:</p>
                    <ul class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6 text-center">
                        <li class="bg-[#222] p-4 rounded border border-white/10 text-amdkp-gold font-oswald uppercase tracking-wider">Shuri-te</li>
                        <li class="bg-[#222] p-4 rounded border border-white/10 text-amdkp-gold font-oswald uppercase tracking-wider">Naha-te</li>
                        <li class="bg-[#222] p-4 rounded border border-white/10 text-amdkp-gold font-oswald uppercase tracking-wider">Tomari-te</li>
                    </ul>
                    <p>Em 1820 Sokon Matsumura fundiu os três estilos e deu o nome de <strong>Shorin</strong>.</p>
                    <p><strong>Gichin Funakoshi</strong>, um estudante de um dos discípulos de Matsumura, chamado Anko Itosu, foi a pessoa que introduziu e popularizou o Karate nas ilhas principais do Japão.</p>
                    <h3 class="text-xl text-amdkp-silver font-oswald uppercase mt-8 border-b border-white/10 pb-2 mb-4">A Evolução do Nome "Karate"</h3>
                    <p>O caractere “Kara” significava “China”, e o caractere “Te” significava “Mão”. Gichin Funakoshi mudou por outro caractere “Kara”, que significa “Vazio”. O nome passou a significar “Mãos Vazias”.</p>
                    <p>No ano de 1933, o Dai Nippon Butokukai reconheceu oficialmente o Karate-Do como arte marcial.</p>
                    <div class="bg-gradient-to-r from-amdkp-red/10 to-transparent p-6 rounded border-l-4 border-amdkp-red mt-8"><p class="mb-0 text-white font-semibold">Sensei Mabuni evoluiu o estilo Shito-ryu. Um dos seus alunos, Sensei Chojiro Tani, criou um estilo de prática ajustável à capacidade de cada um, criando o Shukokai (uma via para todos).</p></div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="flex justify-center gap-6 mb-8 text-2xl">
                <a href="<?php echo $social['facebook']; ?>" target="_blank" class="text-gray-400 hover:text-amdkp-red transition-all"><i class="fab fa-facebook"></i></a>
                <a href="<?php echo $social['instagram']; ?>" target="_blank" class="text-gray-400 hover:text-amdkp-red transition-all"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo $social['tiktok']; ?>" target="_blank" class="text-gray-400 hover:text-amdkp-red transition-all"><i class="fab fa-tiktok"></i></a>
            </div>
            <p>&copy; <?php echo date("Y"); ?> AMDKP. Todos os direitos reservados.</p>
        </div>
    </footer>

    <button id="openContactBtnFloater" class="fixed bottom-7 right-7 z-50 w-16 h-16 rounded-full border-2 border-amdkp-gold/80 bg-gradient-to-br from-amdkp-dark to-black text-amdkp-gold flex items-center justify-center text-2xl shadow-xl hover:scale-110 hover:from-amdkp-red hover:to-red-900 hover:text-white hover:border-amdkp-red transition-all duration-300" title="Contactos"><i class="fas fa-comments"></i></button>

    <div id="contactModal" class="fixed inset-0 z-[1000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-silver m-0 font-oswald">Contactos AMDKP</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">&times;</span>
            </div>
            <div class="p-8 flex flex-col gap-6">
                <?php $contactos = [['Direção', 'Órgãos Sociais', 'Questões institucionais.', $emails['presidente'], $emails['geral'], ''], ['Secretaria Geral', 'Inscrições & Documentação', 'Processos de filiação.', $emails['secretaria'], '', '911165714'], ['Assembleia Geral', 'Estatutos & Eleições', 'Dúvidas sobre regulamentos.', $emails['assembleia'], '', ''], ['Departamento Técnico', 'Formação & Graduações', 'Questões técnicas.', $emails['tecnico'], '', '']]; foreach($contactos as $c): ?>
                <div class="flex flex-col md:flex-row gap-5 items-center pb-5 border-b border-white/10 last:border-0">
                    <img src="<?php echo $logo_principal; ?>" class="w-16 h-16 object-contain opacity-80">
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-base text-amdkp-silver font-semibold font-oswald uppercase"><?php echo $c[0]; ?></h3>
                        <span class="block text-xs uppercase tracking-wider text-amdkp-red mb-2 font-bold"><?php echo $c[1]; ?></span>
                        <p class="text-sm text-gray-400 mb-3"><?php echo $c[2]; ?></p>
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            <?php if($c[3]): ?><a href="mailto:<?php echo $c[3]; ?>" class="inline-flex items-center gap-2 px-3 py-1.5 rounded border border-white/10 text-xs font-semibold hover:border-amdkp-red hover:text-amdkp-red transition-all"><i class="fas fa-envelope"></i> <?php echo $c[3]; ?></a><?php endif; ?>
                            <?php if($c[5]): ?><a href="https://wa.me/351<?php echo $c[5]; ?>" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 rounded border border-white/10 text-xs font-semibold hover:border-amdkp-red hover:text-amdkp-red transition-all"><i class="fab fa-whatsapp"></i> WhatsApp</a><?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="appModal" class="fixed inset-0 z-[1000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-silver m-0 font-oswald">Aplicação do Aluno</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">&times;</span>
            </div>
            <div class="p-8 text-center flex flex-col items-center">
                <img src="<?php echo $base_url_img; ?>LogotipoTraining.png" class="max-w-[160px] mb-6">
                <a href="<?php echo $link_training; ?>" target="_blank" class="cta-button mb-6">
                    <i class="fas fa-mobile-alt"></i> Aceder ao Training
                </a>
                <div class="w-full rounded overflow-hidden border border-white/10 bg-black mb-6">
                    <video autoplay loop muted playsinline class="w-full block">
                        <source src="<?php echo $base_url_vid; ?>introtraining.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>

    <div id="galleryInfoModal" class="fixed inset-0 z-[3000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-silver m-0 font-oswald">Galeria AMDKP</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">&times;</span>
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
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-gold m-0 font-oswald flex items-center gap-2"><i class="fas fa-user-shield"></i> Autenticação</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all" onclick="document.getElementById('loginModal').classList.add('hidden')">&times;</span>
            </div>
            <div class="p-8">
                <p class="text-sm text-gray-400 mb-6 text-center">Introduza as credenciais de administrador.</p>
                <form id="loginForm" class="space-y-4">
                    <div><label class="block text-xs uppercase tracking-wider text-amdkp-silver mb-1 font-bold">Utilizador</label><input type="text" id="username" name="username" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-amdkp-gold focus:outline-none transition-colors"></div>
                    <div><label class="block text-xs uppercase tracking-wider text-amdkp-silver mb-1 font-bold">Password</label><input type="password" id="password" name="password" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-amdkp-gold focus:outline-none transition-colors"></div>
                    <div id="loginError" class="hidden text-amdkp-red text-xs font-bold text-center bg-red-900/20 p-2 rounded animate-pulse"><i class="fas fa-exclamation-circle"></i> Dados incorretos.</div>
                    <button type="submit" class="w-full py-3 bg-amdkp-gold text-black font-bold uppercase tracking-widest rounded hover:bg-white transition-all shadow-lg mt-4">Aceder <i class="fas fa-arrow-right ml-2"></i></button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.AMDKP_CONFIG = { baseUrlGal: "<?php echo $base_url_gal; ?>" };
            
            const openInfoBtn = document.getElementById('openGalleryInfoBtn');
            const infoModal = document.getElementById('galleryInfoModal');
            const proceedBtn = document.getElementById('btnProceedToLogin');
            const loginModal = document.getElementById('loginModal');
            const loginForm = document.getElementById('loginForm');
            const errorMsg = document.getElementById('loginError');
            const contactBtn = document.getElementById('openContactBtnFloater');
            const contactModal = document.getElementById('contactModal');
            const appModal = document.getElementById('appModal'); 

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
                    fetch('conta_admin.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ username: user, password: pass }) })
                    .then(response => response.json()).then(data => { if (data.success) { window.location.href = '<?php echo $link_galeria_interna; ?>'; } else { errorMsg.classList.remove('hidden'); } })
                    .catch(error => { errorMsg.textContent = "Erro de conexão."; errorMsg.classList.remove('hidden'); });
                });
            }
            if(contactBtn && contactModal) contactBtn.addEventListener('click', () => contactModal.classList.remove('hidden'));

            window.addEventListener('click', (e) => { 
                if (e.target.id === 'galleryInfoModal') infoModal.classList.add('hidden');
                if (e.target.id === 'loginModal') loginModal.classList.add('hidden');
                if (e.target.id === 'contactModal') contactModal.classList.add('hidden');
                if (e.target.id === 'appModal') appModal.classList.add('hidden');
            });
            document.querySelectorAll('.close-btn').forEach(btn => {
                btn.addEventListener('click', function() { const modal = this.closest('div[id$="Modal"]'); if(modal) modal.classList.add('hidden'); });
            });
        });
    </script>
</body>
</html>