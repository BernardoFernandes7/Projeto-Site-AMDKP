<?php
// =================================================================
//  CONFIGURAÇÃO GERAL
// =================================================================

$page_title = "Utilidade Pública | AMDKP";


$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$base_url_gal = "https://www.amdkp.pt/0website/portal/galeria/";
$logo_principal = $base_url_img . "4AMDKP.png";
$link_area_res    = "https://script.google.com/macros/s/AKfycbxQyuu3nE0_dneKg6RdJxYn_CaGykai14-FG2R2taz1iM9Wh5TNQDtQvVdlu3zyvsedPQ/exec";
$link_galeria_ext = "http://kavp-proton.ddns.net:10180/";
$link_training    = "https://trainingtc.amdkp.pt/athlete/login";
$base_url_vid     = "https://www.amdkp.pt/0website/video/";


$navegacao = [
    'amdkp' => [
        'label' => 'AMDKP',
        'url'   => '#',
        'submenu' => [
            ['label' => 'Associação',                        'url' => 'associacao.php'],
            ['label' => 'O Karate (História)',               'url' => 'historia.php'],
            ['label' => 'Estilo',                            'url' => 'estilo.php'],
           
        ]
    ],
    'institucional' => [
        'label' => 'Institucional',
        'url'   => '#',
        'submenu' => [
            ['label' => 'Assembleia Geral',           'url' => '#'],
            
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
            <a href="index.php" class="logo-text">
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
                <button id="openGalleryModalBtn" class="cta-outline header-btn">
                    <i class="fas fa-images"></i> <span class="hidden sm:inline">Galeria</span>
                </button>
                <a href="<?php echo $link_area_res; ?>" target="_blank" class="cta-button header-btn">
                    <i class="fas fa-lock"></i> <span class="hidden sm:inline">Área Reservada</span>
                </a>
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

    <main class="relative z-10 pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto">
            
            <section class="animate-fade-in">
                <h1 class="font-oswald text-3xl md:text-4xl text-white uppercase border-b-4 border-amdkp-red inline-block mb-10 tracking-wide leading-tight">
                    AMDK-P Associação com Estatuto de <span class="text-amdkp-gold">Utilidade Pública</span>
                </h1>
                
                <div class="text-gray-300 space-y-6 text-lg leading-relaxed text-justify font-sans">
                    <p>
                        Mantemos a nossa missão de desenvolver relevantes atividades de interesse geral no âmbito do desporto, através do ensino e promoção do Karate, tanto no plano formativo como competitivo, enquanto meio privilegiado de educação física, desenvolvimento psicossocial e de integração comunitária.
                    </p>
                    
                    <div class="p-6 bg-white/5 border-l-4 border-amdkp-gold rounded-r-lg my-8">
                        <p class="mb-0 text-white italic">
                            A obtenção do Estatuto de Utilidade Pública pela AMDK-P, é o resultado da idoneidade moral dos seus dirigentes, incentivando o associativismo jovem, para benefício dos seus associados e das suas comunidades envolventes.
                        </p>
                    </div>

                    <p>
                        Esta associação mereceu o reconhecimento da tutela pela sua ação desportiva, pelos valores sociais e de formação que defende e promove para o desenvolvimento e crescimento dos jovens, para uma sociedade que deve ser igualitária, democrática e de partilha.
                    </p>

                    <h3 class="text-xl text-amdkp-silver font-oswald uppercase mt-8 border-b border-white/10 pb-2 mb-4">Mecenato Desportivo e Benefícios Fiscais</h3>

                    <p>
                        O Estatuto dos Benefícios de Fiscais relativos ao Mecenato Desportivo configura um conjunto de incentivos concedido pelo Estado para estimular empresas e particulares a efetuarem donativos a entidades privadas e públicas.
                    </p>
                    <p>
                        As empresas e os particulares que concedem um donativo, beneficiam de uma majoração que é adicionada ao valor desse donativo, o qual é abatido à sua matéria coletável, conduzindo à redução do imposto a pagar ao Estado.
                    </p>
                    <p>
                        O imposto em causa é, no que concerne às empresas, o <strong>IRC</strong> (Imposto sobre o Rendimento das Pessoas Coletivas) e, no que concerne a particulares, o <strong>IRS</strong> (Imposto sobre o Rendimento das Pessoas Singulares).
                    </p>
                    <p>
                        Os donativos constituem entregas em dinheiro ou em espécie, concedidos sem contrapartidas que configurem obrigações de carácter pecuniário ou comercial às entidades beneficiárias cuja atividade consista na realização de iniciativas nas áreas social, cultural, ambiental, desportiva ou educacional.
                    </p>
                    <p class="font-bold text-amdkp-gold">
                        A Lei do mecenato para o sector do desporto é uma ferramenta proposta pelo Estado para estimular o financiamento privado do desporto e ajudar o associativismo desportivo.
                    </p>

                    <div class="mt-12 text-center">
                        <button id="openApoioBtn" class="cta-button w-full md:w-auto shadow-lg hover:shadow-amdkp-gold/20">
                            <i class="fas fa-hand-holding-heart"></i> Como pode integrar o apoio aos projetos AMDK-P
                        </button>
                    </div>
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

    <button id="openContactBtnFloater" class="fixed bottom-7 right-7 z-50 w-16 h-16 rounded-full border-2 border-amdkp-gold/80 bg-gradient-to-br from-amdkp-dark to-black text-amdkp-gold flex items-center justify-center text-2xl shadow-xl hover:scale-110 hover:from-amdkp-red hover:to-red-900 hover:text-white hover:border-amdkp-red transition-all duration-300" title="Contactos">
         <i class="fas fa-comments"></i>
    </button>

    <div id="apoioModal" class="fixed inset-0 z-[1000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up border border-amdkp-gold/30">
            <div class="modal-header-custom flex justify-between items-center p-6 bg-gradient-to-r from-black to-[#222]">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-gold m-0 font-oswald flex items-center gap-3">
                    <i class="fas fa-hand-holding-heart"></i> Apoio aos Projetos
                </h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">&times;</span>
            </div>
            <div class="p-8 text-gray-300 leading-relaxed space-y-4 text-justify">
                <p>
                    Poderá verificar e apoiar os vários projetos da AMDK-P, através dos seus donativos que sejam deduzidos à sua matéria colectável, conduzindo à redução do imposto a pagar ao Estado, quando do preenchimento do seu IRC ou do seu IRS.
                </p>
                <p>
                    Contribua desta forma para causas concretas, ajudando ao desenvolvimento e concretização de projetos, com força e impacto na nossa sociedade.
                </p>
                <p>
                    Com a periodicidade necessária e exigível, facultaremos informações relativamente ao estado de desenvolvimento e de concretização dos projetos, por si apoiados, para que possa aquilatar do seu contributo e respetivos resultados obtidos.
                </p>
                <p>
                    Temos uma equipa dedicada ao acompanhamento dos projetos em curso, que tenham sido suportados pelos apoios em sede de Utilidade Pública, a qual será o interlocutor entre os responsáveis pelo desenvolvimento dos projetos, as entidades promotoras e seus apoiantes.
                </p>
                <div class="mt-8 text-center pt-4 border-t border-white/10">
                    <p class="text-white font-semibold mb-2">Envie-nos um email através do:</p>
                    <a href="mailto:presidente@amdkp.pt" class="text-amdkp-red hover:text-amdkp-gold transition-colors font-oswald text-xl uppercase tracking-wide">
                        <i class="fas fa-envelope mr-2"></i> presidente@amdkp.pt
                    </a>
                </div>
            </div>
        </div>
    </div>

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

    <div id="galleryModal" class="fixed inset-0 z-[1000] hidden bg-black/90 backdrop-blur-sm overflow-y-auto animate-fade-in">
        <div class="modal-content-box relative w-[92%] max-w-3xl mx-auto my-12 bg-amdkp-panel text-gray-100 rounded-lg shadow-2xl overflow-hidden animate-slide-up">
            <div class="modal-header-custom flex justify-between items-center p-6">
                <h2 class="text-lg tracking-[0.18em] uppercase text-amdkp-silver m-0 font-oswald">Galeria AMDKP</h2>
                <span class="close-btn text-3xl cursor-pointer hover:text-amdkp-red transition-all">&times;</span>
            </div>
            <div class="p-8 text-center flex flex-col items-center">
                <div class="w-full rounded overflow-hidden border border-white/10 bg-black mb-6">
                    <img src="<?php echo $base_url_gal; ?>galeriaamdkp.png" class="w-full block">
                </div>
                <a href="<?php echo $link_galeria_ext; ?>" target="_blank" class="cta-outline">
                    <i class="fas fa-external-link-alt text-amdkp-gold"></i> Aceder à Galeria Externa
                </a>
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
    
    <script>
        window.AMDKP_CONFIG = { baseUrlGal: "<?php echo $base_url_gal; ?>" };
    </script>
    <script src="script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnApoio = document.getElementById('openApoioBtn');
            const modalApoio = document.getElementById('apoioModal');
            
            if(btnApoio && modalApoio) {
                btnApoio.addEventListener('click', function() {
                    modalApoio.classList.remove('hidden');
                    modalApoio.classList.add('block');
                });
            }
        });
    </script>
</body>
</html>