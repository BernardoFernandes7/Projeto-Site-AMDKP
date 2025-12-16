<?php

$page_title = "Quem Somos | AMDKP";


$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$base_url_gal = "https://www.amdkp.pt/0website/portal/galeria/";
$logo_principal = $base_url_img . "4AMDKP.png";
$link_area_res    = "https://script.google.com/macros/s/AKfycbxQyuu3nE0_dneKg6RdJxYn_CaGykai14-FG2R2taz1iM9Wh5TNQDtQvVdlu3zyvsedPQ/exec";
$link_galeria_ext = "http://kavp-proton.ddns.net:10180/";

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
                        <a href="<?php echo $item['url']; ?>" class="nav-link-custom">
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
                        <a href="<?php echo $item['url']; ?>" class="mobile-link-parent hover:text-amdkp-gold">
                            <?php echo $item['label']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </header>

    <main class="relative z-10 pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto">
            <section class="mb-16 animate-fade-in">
                <h1 class="font-oswald text-4xl text-white uppercase border-b-4 border-amdkp-red inline-block mb-8 tracking-wide">
                    Quem Somos
                </h1>
                <div class="text-gray-300 space-y-6 text-lg leading-relaxed text-justify font-sans">
                    <p>A <strong>Associação Marcial e Desportiva de Karate – Portugal</strong>, resulta da união de um conjunto de escolas com origem em várias regiões do nosso país, pela vontade expressa dos seus associados que congregam e comungam dos mesmos ideais para o karate desde a sua fundação no Ano de 2013, ainda com a designação inicial de CKCS – Clube Karate Coimbra Shukokai.</p>
                    <p>Esta associação desde a data da sua fundação teve uma grande evolução, fruto do seu dinamismo, da sua intervenção social e da sua forma de abordar o desporto como veículo formador, essencialmente junto das crianças e jovens, baseando-se em valores que fomentem o desenvolvimento conjunto e o empreendedorismo dos seus associados e das entidades que são parceiras neste propósito e missão.</p>
                    <p>A AMDK-P continuará a desenvolver-se dentro dos padrões e visão que sempre existiu no seio desta, para que com empenho, dedicação, compromisso e responsabilidade, possa assumir o seu papel e assim continuar a trabalhar para ser uma referência importante no desenvolvimento do desporto em geral e do Karate desportivo ou marcial em particular, para que a atividade desta Associação se destaque de forma consistente e reconhecida, como uma das mais relevantes no contexto do panorama português, na Europa e no Mundo.</p>
                    <p>A AMDK-P assume-se como uma entidade dinamizadora do Karate enquanto atividade marcial, desportiva, social, educativa e de lazer, tendo em conta a sua importância na formação de uma juventude que contribua para uma sociedade assente em princípios e valores, baseando a sua intervenção na área do ensino de um desporto completo. Para além da dinamização dos jovens, adultos e da terceira idade, assenta também no empreendedorismo de atividades em que o conhecimento e a formação pessoal com relevo social, tais como: a promoção da cidadania, dos direitos humanos, da educação e da cultura, que sejam aspetos fundamentais a considerar.</p>
                    <p>Sendo uma organização sem fins lucrativos, sempre se pautou por uma ação promotora do desporto de lazer, de competição e de alta competição bem como uma Associação RNAJ – Registo Nacional de Associativismo Jovem, promovendo ações ativas, contribuindo para uma sociedade dinâmica, coesa, com personalidade interativa e integradora.</p>
                    <div class="bg-white/5 border-l-4 border-amdkp-gold p-6 rounded-r-lg">
                        <p class="mb-0 italic text-white">Esta Associação tem igualmente como uma das suas preocupações fundamentais, a inclusão de cidadãos com necessidades especiais, tendo já no seu seio praticantes/atletas com diagnóstico de autismo, o que tem permitido com êxito a sua integração e a obtenção de resultados muito positivos na sua evolução e desenvolvimento individuais ou coletivos.</p>
                    </div>
                </div>
            </section>

            <section class="animate-slide-up">
                <h2 class="font-oswald text-3xl text-amdkp-gold uppercase border-b-2 border-white/20 inline-block mb-6 tracking-wide">
                    Missão
                </h2>
                <div class="text-gray-300 space-y-6 text-lg leading-relaxed text-justify font-sans">
                    <p>A AMDK-P tem como missão dinamizar, desenvolver e organizar o Karate marcial e desportivo em todas as suas dimensões e categorias, como um todo, de forma harmoniosa, assegurando a sua continuidade e crescimento em todo o território nacional, abrangendo todos os meios sociais e faixas etárias, cooperando estreitamente com os seus parceiros nacionais e internacionais, públicos e privados, numa ótica de independência e de benefício recíproco, em prol do êxito da sua missão.</p>
                    <p>Esta missão passa pela realização de várias atividades, seja esta de cariz participativo, ou como organizador. A associação funciona como plataforma de entendimento organizativo para as várias entidades e associações do país.</p>
                    <p>Sendo a sede na região do pinhal interior, permite o intercâmbio de experiência e iniciativas de interesse e de atração de e para as várias regiões do país. São atividades que mobilizam pessoas, praticantes, familiares e turistas desportivos. As atividades a que nos propomos são de âmbito nacional e internacional com abrangência pelos vários cantos do mundo praticantes de Karate.</p>
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
    
    <script>
        window.AMDKP_CONFIG = { baseUrlGal: "<?php echo $base_url_gal; ?>" };
    </script>
    <script src="script.js"></script>
</body>
</html>