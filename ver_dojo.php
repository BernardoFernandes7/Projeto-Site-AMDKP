<?php
require 'conection.php'; 

$id_dojo = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id_dojo === 0) {
    header("Location: dojos.php");
    exit;
}

try {
    $stmt = $dbh->prepare("SELECT * FROM dojos WHERE id = ? AND ativo = 1");
    $stmt->execute([$id_dojo]);
    $dojo = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$dojo) die("Dojo não encontrado.");

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

$page_title = $dojo['nome'] . " | AMDKP";
$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$base_url_gal = "https://www.amdkp.pt/0website/portal/galeria/";
$logo_principal = $base_url_img . "4AMDKP.png";


$link_galeria_interna = "galeria.php";
$link_area_res = "https://www.amdkp.pt/login"; 

$navegacao = [
    'amdkp' => ['label' => 'AMDKP', 'url' => '#', 'submenu' => [['label' => 'Associação', 'url' => 'associacao.php'], ['label' => 'História', 'url' => 'historia.php'], ['label' => 'Estilo', 'url' => 'estilo.php']]],
    
    'utilidade' => ['label' => 'Utilidade Pública', 'url' => 'utilidade.php', 'submenu' => []]
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
        <div class="max-w-6xl mx-auto">
            
            <a href="dojos.php" class="inline-block text-amdkp-gold hover:text-white mb-8 uppercase text-sm font-bold tracking-wider transition">
                Voltar à Lista
            </a>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start relative">
                
                <div class="flex flex-col gap-4 z-10">
                    
                    <div class="w-full h-80 bg-[#222] rounded-xl border border-amdkp-gold/30 overflow-hidden relative group shadow-2xl flex items-center justify-center">
                        <?php if (!empty($dojo['maps'])): ?>
                            <iframe src="<?php echo $dojo['maps']; ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <?php else: ?>
                            <div class="text-center p-10 opacity-30">
                                <i class="fas fa-map-marked-alt text-8xl text-gray-500 mb-4 block"></i>
                                <span class="text-gray-400 text-sm uppercase tracking-widest font-oswald">Localização Indisponível</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($dojo['maps'])): 
                       
                        $dojos_centralizados = ['Brasfemes', 'Eiras', 'Karate Ademia', 'Loreto', 'Sta.Apolónia', 'Karaté Trouxemil'];
                        $usar_link_central = false;
                        
                        foreach($dojos_centralizados as $nome_alvo) {
                            if (stripos($dojo['nome'], $nome_alvo) !== false) {
                                $usar_link_central = true; break;
                            }
                        }

                        if ($usar_link_central) {
                            $termo_pesquisa = urlencode("Clube Academy karate Coimbra");
                        } else {
                            $termo_pesquisa = urlencode($dojo['nome'] . " " . $dojo['morada']);
                        }

                        $link_google_maps = "https://www.google.com/maps/search/?api=1&query=" . $termo_pesquisa;
                    ?>
                        <a href="<?php echo $link_google_maps; ?>" target="_blank" class="w-full py-4 bg-amdkp-red text-white font-oswald text-xl uppercase tracking-widest rounded hover:bg-red-700 transition shadow-lg text-center flex items-center justify-center gap-3">
                            <i class="fas fa-location-arrow"></i> Abrir no Google Maps
                        </a>
                    <?php endif; ?>

                    <div class="bg-amdkp-panel p-6 rounded-xl border border-white/10 shadow-xl mt-2">
                        <h3 class="text-amdkp-gold text-lg font-bold uppercase tracking-widest mb-4 border-b border-white/10 pb-2 font-oswald">
                            <i class="far fa-clock mr-2"></i> Horário das Aulas
                        </h3>
                        <?php if (!empty($dojo['horario'])): ?>
                            <div class="text-gray-300 leading-relaxed text-sm whitespace-pre-line pl-2 border-l-2 border-amdkp-red/50">
                                <?php echo $dojo['horario']; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 italic text-sm">Horário a definir ou sob consulta.</p>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="flex flex-col gap-4">
                    
                    <h1 class="font-oswald text-4xl text-white uppercase leading-tight tracking-wide border-l-4 border-amdkp-gold pl-4">
                        <?php echo $dojo['nome']; ?>
                    </h1>

                    <div class="bg-amdkp-panel p-8 rounded-xl border border-white/10 flex flex-col gap-8 shadow-xl mt-2 h-full justify-between">
                        
                        <div class="flex flex-col gap-8">
                            <div>
                                <h3 class="text-amdkp-gold text-xs font-bold uppercase tracking-widest mb-2 border-b border-white/10 pb-1">
                                    Responsável Técnico
                                </h3>
                                <div class="flex items-center gap-4 mt-4">
                                    <?php if ($dojo['fotosurl']): ?>
                                        <img src="<?php echo $dojo['fotosurl']; ?>" class="w-20 h-20 rounded-full border-2 border-amdkp-gold object-cover">
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-2xl text-white font-oswald">Sensei <?php echo $dojo['sensei']; ?></p>
                                        <p class="text-gray-400 text-sm">Instrutor Chefe</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-amdkp-gold text-xs font-bold uppercase tracking-widest mb-3 border-b border-white/10 pb-1">
                                    Contactos
                                </h3>
                                <ul class="space-y-4">
                                    <?php if ($dojo['telefone']): ?>
                                        <li class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded bg-white/5 flex items-center justify-center text-white border border-white/10 shrink-0"><i class="fas fa-phone"></i></div>
                                            <div>
                                                <span class="block text-[10px] text-gray-500 uppercase">Telefone</span>
                                                <a href="tel:<?php echo $dojo['telefone']; ?>" class="text-white hover:text-amdkp-gold text-lg font-bold"><?php echo $dojo['telefone']; ?></a>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($dojo['email']): ?>
                                        <li class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded bg-white/5 flex items-center justify-center text-white border border-white/10 shrink-0"><i class="fas fa-envelope"></i></div>
                                            <div class="overflow-hidden">
                                                <span class="block text-[10px] text-gray-500 uppercase">Email</span>
                                                <a href="mailto:<?php echo $dojo['email']; ?>" class="text-white hover:text-amdkp-gold font-bold truncate block text-sm"><?php echo $dojo['email']; ?></a>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <?php if ($dojo['morada']): ?>
                            <div>
                                <h3 class="text-amdkp-gold text-xs font-bold uppercase tracking-widest mb-3 border-b border-white/10 pb-1">
                                    Morada
                                </h3>
                                <p class="text-gray-300 text-sm"><?php echo nl2br($dojo['morada']); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($dojo['facebook'] || $dojo['instagram']): ?>
                        <div class="mt-6 pt-6 border-t border-white/10 flex justify-start gap-4">
                            <?php if ($dojo['facebook']): ?>
                                <a href="<?php echo $dojo['facebook']; ?>" target="_blank" class="w-10 h-10 rounded-full bg-amdkp-gold text-black flex items-center justify-center hover:bg-white transition-all shadow-lg hover:scale-110">
                                    <i class="fab fa-facebook-f text-lg"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($dojo['instagram']): ?>
                                <a href="<?php echo $dojo['instagram']; ?>" target="_blank" class="w-10 h-10 rounded-full bg-amdkp-gold text-black flex items-center justify-center hover:bg-white transition-all shadow-lg hover:scale-110">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>
    </main>

    <footer>
        <div class="footer-content text-center py-8 border-t border-[#222]">
            <p class="text-gray-500">© <?php echo date("Y"); ?> AMDKP. Todos os direitos reservados.</p>
        </div>
    </footer>

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
                <p class="text-sm text-gray-400 mb-6 text-center">Introduza as credenciais de administrador.</p>
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.AMDKP_CONFIG = { baseUrlGal: "<?php echo $base_url_gal; ?>" };
            
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
                        if (data.success) {
                            window.location.href = '<?php echo $link_galeria_interna; ?>';
                        } else {
                            errorMsg.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        errorMsg.textContent = "Erro de conexão.";
                        errorMsg.classList.remove('hidden');
                    });
                });
            }

            window.addEventListener('click', (e) => { 
                if (e.target.id === 'galleryInfoModal') infoModal.classList.add('hidden');
                if (e.target.id === 'loginModal') loginModal.classList.add('hidden');
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