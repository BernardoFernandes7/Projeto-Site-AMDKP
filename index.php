<?php
$page_title = "AMDKP | Associação Marcial e Desportiva de Karaté";
$main_headline = "Associação Marcial e Desportiva de Karaté";
$sub_headline = "Portugal";

$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$base_url_vid = "https://www.amdkp.pt/0website/video/";
$base_url_gal = "https://www.amdkp.pt/0website/portal/galeria/";


$bg_iframe    = "https://amdkp.pt/0website/principalgaleria/galeriasite1.php";

$logo_principal = $base_url_img . "4AMDKP.png";
$logo_fnkp      = $base_url_img . "fnkp25.png";
$logo_ipdj      = $base_url_img . "ipdj.png";


$link_area_res    = "https://script.google.com/macros/s/AKfycbxQyuu3nE0_dneKg6RdJxYn_CaGykai14-FG2R2taz1iM9Wh5TNQDtQvVdlu3zyvsedPQ/exec";
$link_training    = "https://trainingtc.amdkp.pt/athlete/login";


$link_galeria_interna = "galeria.php"; 

$navegacao = [
    'amdkp' => [
        'label' => 'AMDKP',
        'url'   => '#', 
        'submenu' => [
            ['label' => 'Associação',          'url' => 'associacao.php'], 
            ['label' => 'O Karate (História)', 'url' => 'historia.php'],   
            ['label' => 'Estilo',              'url' => 'estilo.php']     
        ]
    ],
    
    'utilidade' => [
        'label' => 'Utilidade Pública',
        'url'   => 'utilidade.php', 
        'submenu' => []
    ]
];

$emails = [
    'presidente' => 'presidente@amdkp.pt',
    'geral'      => 'geral@amdkp.pt',
    'secretaria' => 'secretaria@amdkp.pt',
    'assembleia' => 'assembleia.geral@amdkp.pt',
    'tecnico'    => 'tecnico@amdkp.pt'
];

$social = [
    'facebook'  => "https://www.facebook.com/profile.php?id=61565124600449",
    'instagram' => "https://www.instagram.com/amdkportugal?igsh=MXg1N3A3cDA2czdrdg==",
    'tiktok'    => "https://tiktok.com"
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
                    colors: {
                        amdkp: { red: '#D80027', gold: '#d4af37', dark: '#0f0f0f', silver: '#c0c0c0', panel: '#1a1a1a' }
                    },
                    fontFamily: { sans: ['Montserrat', 'sans-serif'], oswald: ['Oswald', 'sans-serif'] },
                    animation: { 'fade-in': 'fadeIn 0.3s ease-out', 'slide-up': 'slideUp 0.4s ease-out' },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(20px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } }
                    }
                }
            }
        }
    </script>
</head>
<body>

    <iframe id="bg-iframe" src="<?php echo $bg_iframe; ?>"></iframe>
    <div class="fixed inset-0 z-0 bg-gradient-to-b from-amdkp-red/10 via-black/50 to-black/90 pointer-events-none"></div>

    <header>
        <div class="navbar-container">
            <a href="#" class="logo-text">
                <img src="<?php echo $logo_principal; ?>" style="height: 40px; margin-right: 10px;">
                <span>AMDK-P</span>
            </a>
            
            <nav class="nav-center hidden lg:flex">
                <?php foreach ($navegacao as $key => $item): ?>
                    <div class="nav-item-dropdown group">
                        <a href="<?php echo $item['url']; ?>" class="nav-link-custom" <?php echo (strpos($item['url'], 'http') === 0) ? 'target="_blank"' : ''; ?>>
                            <?php echo $item['label']; ?>
                        </a>
                        <?php if (!empty($item['submenu'])): ?>
                            <div class="dropdown-menu">
                                <?php foreach ($item['submenu'] as $sub): ?>
                                    <a href="<?php echo $sub['url']; ?>" class="dropdown-item">
                                        <?php echo $sub['label']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>
            
            <button id="mobileMenuBtn" class="lg:hidden text-white text-2xl focus:outline-none hover:text-amdkp-red transition-colors">
                <i class="fas fa-bars"></i>
            </button>

            <div style="display: flex; gap: 10px;" class="items-center">
                <button id="openGalleryInfoBtn" class="cta-outline header-btn">
                    <i class="fas fa-images"></i> <span class="hidden sm:inline">Galeria</span>
                </button>
            </div>
        </div>

        <div id="mobileMenuContainer" class="lg:hidden absolute w-full left-0 top-[100%] shadow-xl bg-amdkp-panel">
            <?php foreach ($navegacao as $key => $item): ?>
                <div class="border-b border-white/10">
                    <?php if (!empty($item['submenu'])): ?>
                        <button class="mobile-link-parent w-full text-left" onclick="toggleMobileSubmenu('sub-<?php echo $key; ?>', this)">
                            <?php echo $item['label']; ?>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                        </button>
                        <div id="sub-<?php echo $key; ?>" class="mobile-submenu">
                            <?php foreach ($item['submenu'] as $sub): ?>
                                <a href="<?php echo $sub['url']; ?>" class="mobile-sublink">
                                    <?php echo $sub['label']; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo $item['url']; ?>" class="mobile-link-parent hover:text-amdkp-gold" <?php echo (strpos($item['url'], 'http') === 0) ? 'target="_blank"' : ''; ?>>
                            <?php echo $item['label']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <img src="<?php echo $logo_principal; ?>" alt="Logotipo" class="w-[180px] mx-auto mb-8 block" style="filter: drop-shadow(0 0 20px rgba(0,0,0,0.5));">
            
            <h1><?php echo $main_headline; ?><br><span><?php echo $sub_headline; ?></span></h1>
            
            <p>Construindo personalidades, forjando campeões. Uma associação organizada em prol das escolas e praticantes.</p>

            <div class="hero-buttons-grid mt-10">
                <a href="dojos.php" class="cta-button">
                    <i class="fas fa-map-marker-alt"></i> Dojos
                </a>
            </div>
            
            <div class="mt-12 flex justify-center items-center gap-6 opacity-70 hover:opacity-100 transition-opacity">
                 <img src="<?php echo $logo_fnkp; ?>" alt="FNKP" class="h-10 grayscale hover:grayscale-0 transition-all">
                 <div class="h-8 w-px bg-gray-600"></div>
                 <img src="<?php echo $logo_ipdj; ?>" alt="IPDJ" class="h-10 grayscale hover:grayscale-0 transition-all">
            </div>
        </div>
    </section>

    <section class="highlight-section" id="appSection">
        <div class="highlight-media">
            <img src="<?php echo $base_url_img; ?>ttcimg1.gif" alt="Fundo" class="highlight-video-bg">
            <img src="<?php echo $base_url_img; ?>LogotipoTraining.png" alt="Training TC App" class="highlight-logo-overlay">
        </div>
        <div class="highlight-content">
            <h3 style="color: var(--primary-red); margin-bottom: 10px;">Tecnologia</h3>
            <h2 style="font-size: 2.5rem; margin-bottom: 20px; line-height: 1.2;">Training TC App<br>O Universo do Aluno</h2>
            <p style="color: #ccc; margin-bottom: 20px;">
                Aceda aos seus dados de graduação, histórico de exames, renovações e conteúdos técnicos exclusivos através da nossa aplicação.
            </p>
            <p style="color: #ccc; margin-bottom: 30px; font-size: 0.9rem;">
                <i class="fas fa-check" style="color: var(--primary-red); margin-right: 5px;"></i> Compatível com todos os dispositivos.<br>
                <i class="fas fa-check" style="color: var(--primary-red); margin-right: 5px;"></i> Acesso direto aos conteúdos técnicos.
            </p>
            
            <button id="openAppBtn" class="cta-button">
                <i class="fas fa-mobile-alt"></i> Aceder à Aplicação
            </button>
        </div>
    </section>

    <section class="relative z-10 py-20 px-5 bg-black/90 border-t border-white/10">
        <div class="max-w-[1400px] mx-auto">
            <div class="text-center mb-12">
                <h2 class="section-title text-white">Ecossistema Competitivo</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Um caminho estruturado desde a iniciação até à alta performance.</p>
            </div>

            <div class="activities-grid">
                <article class="info-card">
                    <div class="card-header">
                        <h3>Sistema Meeting</h3>
                        <i class="fas fa-chess-knight"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Idades 3 - 14 Anos</span>
                        <p class="text-gray-400 text-sm mb-4">Sistema exclusivo de competição para as camadas jovens. Baseia-se em três meetings por época.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Meeting Karateca Completo</li>
                            <li><i class="fas fa-check"></i> Meeting Competitivo</li>
                            <li><i class="fas fa-check"></i> Meeting Teams</li>
                        </ul>
                    </div>
                </article>

                <article class="info-card">
                    <div class="card-header">
                        <h3>Competições Nacionais</h3>
                        <i class="fas fa-flag"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Nível Nacional</span>
                        <p class="text-gray-400 text-sm mb-4">Participação nos quadros competitivos oficiais e torneios de referência em Portugal.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Campeonatos FNK-P</li>
                            <li><i class="fas fa-check"></i> Opens Nacionais</li>
                            <li><i class="fas fa-check"></i> Ligas de Karate</li>
                        </ul>
                    </div>
                </article>

                <article class="info-card">
                    <div class="card-header">
                        <h3>Competições Internacionais</h3>
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Nível Mundial</span>
                        <p class="text-gray-400 text-sm mb-4">Projeção dos atletas em palcos mundiais e europeus das grandes federações.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> WKF & EKF Events</li>
                            <li><i class="fas fa-check"></i> Opens Internacionais</li>
                            <li><i class="fas fa-check"></i> Estágios de Seleção</li>
                        </ul>
                    </div>
                </article>

                <article class="info-card">
                    <div class="card-header">
                        <h3>High Performance</h3>
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Elite & Seleções</span>
                        <p class="text-gray-400 text-sm mb-4">O corpo de seleções visa desenvolver treinos e encontros para níveis de alta competição.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Aceleração da aprendizagem</li>
                            <li><i class="fas fa-check"></i> Evolução tática e psicológica</li>
                            <li><i class="fas fa-check"></i> Disputa de medalhas</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="relative z-10 py-20 px-5 bg-[#111] border-t border-white/5">
        <div class="max-w-[1400px] mx-auto">
            <div class="text-center mb-12">
                <h2 class="section-title text-white">Ecossistema Formativo</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Desenvolvimento contínuo, técnico e social para todos os praticantes.</p>
            </div>

            <div class="activities-grid">
                <article class="info-card">
                    <div class="card-header">
                        <h3>Jornadas Marciais</h3>
                        <i class="fas fa-fist-raised"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Técnica & Exames</span>
                        <p class="text-gray-400 text-sm mb-4">Estágios técnicos exclusivos da AMDK-P. Focados no ensino e treino das disciplinas base.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> 3 Jornadas por época</li>
                            <li><i class="fas fa-check"></i> Foco em Kata e Kumite</li>
                            <li><i class="fas fa-check"></i> Apuramento técnico</li>
                        </ul>
                    </div>
                </article>

                <article class="info-card">
                    <div class="card-header">
                        <h3>Masterclass</h3>
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Elite & Graduados</span>
                        <p class="text-gray-400 text-sm mb-4">Atividade de alta intensidade criada exclusivamente para karatecas a partir de 4º Kyu (Cinto Roxo).</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Ritmo elevado</li>
                            <li><i class="fas fa-check"></i> Aprofundamento cultural</li>
                            <li><i class="fas fa-check"></i> Estudo da física do movimento</li>
                        </ul>
                    </div>
                </article>

                <article class="info-card">
                    <div class="card-header">
                        <h3>Geração Z</h3>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Social & Lúdico</span>
                        <p class="text-gray-400 text-sm mb-4">Atividades lúdicas para envolver atletas, pais e familiares num ambiente descontraído.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Acantonamento Marcial</li>
                            <li><i class="fas fa-check"></i> Provas de Karting & Pedipapers</li>
                            <li><i class="fas fa-check"></i> Convívio e Espírito de Equipa</li>
                        </ul>
                    </div>
                </article>

                <article class="info-card">
                    <div class="card-header">
                        <h3>Graduações</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-7 h-7 fill-amdkp-red">
                            <path fill="currentColor" d="M496 128c0-17.7-14.3-32-32-32H48c-17.7 0-32 14.3-32 32v32c0 17.7 14.3 32 32 32h16v160c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V192h144v160c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V192h112v160c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V192h16c17.7 0 32-14.3 32-32v-32z"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <span class="tag-badge">Evolução Técnica</span>
                        <p class="text-gray-400 text-sm mb-4">Sistema de avaliação rigoroso que certifica a evolução técnica e mental do praticante.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Exames de Kyu e Dan</li>
                            <li><i class="fas fa-check"></i> Programas Oficiais</li>
                            <li><i class="fas fa-check"></i> Certificação Nacional</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

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

    <button id="openContactBtnFloater" class="fixed bottom-7 right-7 z-50 w-16 h-16 rounded-full border-2 border-amdkp-gold/80 bg-gradient-to-br from-amdkp-dark to-black text-amdkp-gold flex items-center justify-center text-2xl shadow-xl hover:scale-110 hover:from-amdkp-red hover:to-red-900 hover:text-white hover:border-amdkp-red transition-all duration-300" title="Contactos">
         <i class="fas fa-comments"></i>
    </button>

    <div id="contactModal" class="fixed inset-0 z-[1000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in" aria-hidden="true">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-silver m-0 font-oswald">Contactos AMDKP</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">&times;</span>
            </div>
            <div class="p-8 flex flex-col gap-6">
                <?php 
                $contactos = [
                    ['Direção', 'Órgãos Sociais', 'Questões institucionais e protocolares.', $emails['presidente'], $emails['geral'], ''],
                    ['Secretaria Geral', 'Inscrições & Documentação', 'Processos de filiação e renovações.', $emails['secretaria'], '', '911165714'],
                    ['Assembleia Geral', 'Estatutos & Eleições', 'Dúvidas sobre regulamentos.', $emails['assembleia'], '', ''],
                    ['Departamento Técnico', 'Formação & Graduações', 'Questões técnicas e exames.', $emails['tecnico'], '', '']
                ];
                foreach($contactos as $c): 
                ?>
                <div class="flex flex-col md:flex-row gap-5 items-center pb-5 border-b border-white/10 last:border-0">
                    <img src="<?php echo $logo_principal; ?>" class="w-16 h-16 object-contain opacity-80">
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-base text-amdkp-silver font-semibold font-oswald uppercase"><?php echo $c[0]; ?></h3>
                        <span class="block text-xs uppercase tracking-wider text-amdkp-red mb-2 font-bold"><?php echo $c[1]; ?></span>
                        <p class="text-sm text-gray-400 mb-3"><?php echo $c[2]; ?></p>
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            <?php if($c[3]): ?>
                            <a href="mailto:<?php echo $c[3]; ?>" class="inline-flex items-center gap-2 px-3 py-1.5 rounded border border-white/10 text-xs font-semibold hover:border-amdkp-red hover:text-amdkp-red transition-all">
                                <i class="fas fa-envelope"></i> <?php echo $c[3]; ?>
                            </a>
                            <?php endif; ?>
                            <?php if($c[5]): ?>
                            <a href="https://wa.me/351<?php echo $c[5]; ?>" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 rounded border border-white/10 text-xs font-semibold hover:border-amdkp-red hover:text-amdkp-red transition-all">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <?php endif; ?>
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
                <p class="max-w-xl text-gray-400 text-sm leading-relaxed mb-6">
                    Instale e tenha acesso ao universo AMDKP.
                </p>
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
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-gold m-0 font-oswald flex items-center gap-2">
                    <i class="fas fa-user-shield"></i> Autenticação
                </h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all" onclick="document.getElementById('loginModal').classList.add('hidden')">&times;</span>
            </div>
            
            <div class="p-8">
                <p class="text-sm text-gray-400 mb-6 text-center">Introduza as credenciais de administrador.</p>
                
                <form id="loginForm" class="space-y-4">
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-amdkp-silver mb-1 font-bold">Utilizador</label>
                        <input type="text" id="username" name="username" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-amdkp-gold focus:outline-none transition-colors" placeholder="Ex: admin">
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-amdkp-silver mb-1 font-bold">Password</label>
                        <input type="password" id="password" name="password" class="w-full bg-black/50 border border-white/20 rounded p-3 text-white focus:border-amdkp-gold focus:outline-none transition-colors" placeholder="******">
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
    
    <script>
        window.AMDKP_CONFIG = { baseUrlGal: "<?php echo $base_url_gal; ?>" };
    </script>
    <script src="script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const openInfoBtn = document.getElementById('openGalleryInfoBtn');
            const infoModal = document.getElementById('galleryInfoModal');
            const proceedBtn = document.getElementById('btnProceedToLogin');
            const loginModal = document.getElementById('loginModal');
            const loginForm = document.getElementById('loginForm');
            const errorMsg = document.getElementById('loginError');
            
           
            const contactBtn = document.getElementById('openContactBtnFloater');
            const contactModal = document.getElementById('contactModal');
            const appBtn = document.getElementById('openAppBtn'); 
            const appModal = document.getElementById('appModal');

            
            if(openInfoBtn && infoModal) {
                openInfoBtn.addEventListener('click', () => {
                    infoModal.classList.remove('hidden');
                });
            }

            
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
                        if (data.success) {
                            window.location.href = '<?php echo $link_galeria_interna; ?>';
                        } else {
                            errorMsg.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        errorMsg.textContent = "Erro de conexão.";
                        errorMsg.classList.remove('hidden');
                    });
                });
            }

           
            if(contactBtn && contactModal) {
                contactBtn.addEventListener('click', () => contactModal.classList.remove('hidden'));
            }
            
            
            if(appBtn && appModal) {
                appBtn.addEventListener('click', () => appModal.classList.remove('hidden'));
            }

            
            window.addEventListener('click', (e) => {
                if (e.target.id === 'galleryInfoModal') infoModal.classList.add('hidden');
                if (e.target.id === 'loginModal') loginModal.classList.add('hidden');
                if (e.target.id === 'contactModal') contactModal.classList.add('hidden');
                if (e.target.id === 'appModal') appModal.classList.add('hidden');
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