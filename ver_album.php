<?php
require 'conection.php'; 


$categoria_slug = isset($_GET['cat']) ? $_GET['cat'] : '';


$titulos = [
    'jornadas'    => 'Jornadas Marciais',
    'masterclass' => 'Masterclass & Formação',
    'meeting'     => 'Meetings & Competições',
    ''            => 'Álbum Desconhecido'
];


if (!array_key_exists($categoria_slug, $titulos) && $categoria_slug !== '') {
    $titulo_pagina = "Álbum: " . ucfirst($categoria_slug);
} elseif ($categoria_slug === '') {
    header("Location: galeria.php");
    exit;
} else {
    $titulo_pagina = $titulos[$categoria_slug];
}

$page_title = $titulo_pagina . " | Galeria AMDKP";
$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$logo_principal = $base_url_img . "4AMDKP.png";


try {
    $stmt = $dbh->prepare("SELECT * FROM galeria_fotos WHERE categoria = ? ORDER BY id DESC");
    $stmt->execute([$categoria_slug]);
    $fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar fotos.");
}
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
<body class="bg-amdkp-dark text-white min-h-screen flex flex-col">

    <header class="fixed w-full top-0 z-50 bg-black/90 border-b border-white/10 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="galeria.php" class="flex items-center gap-3 group">
                <img src="<?php echo $logo_principal; ?>" class="h-10">
                <span class="font-oswald text-xl tracking-widest text-white">AMDK-P <span class="text-amdkp-gold text-xs align-top">ÁLBUNS</span></span>
            </a>
            <a href="galeria.php" class="text-amdkp-gold hover:text-white text-sm font-bold uppercase tracking-wider transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Voltar às Pastas
            </a>
        </div>
    </header>

    <main class="flex-grow pt-32 pb-20 px-6 relative">
        <div class="max-w-7xl mx-auto">
            
            <div class="border-l-4 border-amdkp-gold pl-6 mb-12 animate-fade-in">
                <span class="text-amdkp-gold text-sm font-bold uppercase tracking-widest block mb-1">Galeria Fotográfica</span>
                <h1 class="font-oswald text-4xl md:text-5xl text-white uppercase"><?php echo $titulo_pagina; ?></h1>
            </div>

            <?php if (count($fotos) > 0): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 auto-rows-[200px]">
                    <?php foreach ($fotos as $foto): ?>
                        <div class="group relative overflow-hidden rounded-lg border border-white/10 bg-amdkp-panel cursor-pointer hover:border-amdkp-gold transition-all duration-300"
                             onclick="openLightbox('<?php echo $foto['url_foto']; ?>', '<?php echo htmlspecialchars($foto['titulo']); ?>')">
                            
                            <img src="<?php echo $foto['url_foto']; ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <i class="fas fa-search-plus text-3xl text-amdkp-gold mb-2"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full p-2 bg-black/80 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-xs text-center text-white truncate font-sans"><?php echo $foto['titulo'] ? $foto['titulo'] : 'Sem título'; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-20 bg-amdkp-panel rounded-xl border border-white/5 border-dashed">
                    <i class="fas fa-camera text-6xl text-gray-600 mb-4"></i>
                    <p class="text-gray-400 text-xl font-oswald uppercase">Esta pasta ainda não tem fotografias.</p>
                    <p class="text-gray-600 text-sm mt-2">Novos conteúdos brevemente.</p>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <div id="lightbox" class="fixed inset-0 z-[6000] hidden bg-black/95 backdrop-blur-md flex items-center justify-center p-4 animate-fade-in">
        
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white hover:text-amdkp-red text-4xl transition-colors z-50">
            &times;
        </button>

        <div class="relative max-w-5xl w-full flex flex-col items-center">
            <img id="lightbox-img" src="" class="max-h-[85vh] max-w-full object-contain rounded shadow-2xl border border-white/10">
            <p id="lightbox-caption" class="text-white mt-4 font-oswald tracking-wider text-lg"></p>
        </div>
    </div>

    <script>
        
        function openLightbox(src, caption) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            
            img.src = src;
            cap.textContent = caption;
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
        }

        
        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto'; 
            setTimeout(() => { document.getElementById('lightbox-img').src = ''; }, 300);
        }

        
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });

        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
</body>
</html>