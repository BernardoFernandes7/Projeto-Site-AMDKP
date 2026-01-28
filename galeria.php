<?php

$page_title = "Galeria Interna | AMDKP";


$base_url_img = "https://www.amdkp.pt/0website/logotipo/";
$logo_principal = $base_url_img . "4AMDKP.png";


$pastas = [
    [
        'titulo' => 'Jornadas',
        'link'   => 'ver_album.php?cat=jornadas',
        'icone'  => 'fa-folder',
        'desc'   => 'Estágios e Exames Técnicos'
    ],
    [
        'titulo' => 'Masterclass',
        'link'   => 'ver_album.php?cat=masterclass',
        'icone'  => 'fa-folder-open',
        'desc'   => 'Formação Avançada e Workshops'
    ],
    [
        'titulo' => 'Meeting',
        'link'   => 'ver_album.php?cat=meeting',
        'icone'  => 'fa-folder',
        'desc'   => 'Competições e Encontros'
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
                    keyframes: { fadeIn: { '0%': { opacity: '0', transform: 'translateY(10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } } }
                }
            }
        }
    </script>
</head>
<body class="bg-amdkp-dark text-white min-h-screen flex flex-col">

    <header class="fixed w-full top-0 z-50 bg-black/90 border-b border-white/10 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="index.php" class="flex items-center gap-3 group">
                <img src="<?php echo $logo_principal; ?>" class="h-10 group-hover:scale-110 transition-transform">
                <span class="font-oswald text-xl tracking-widest text-white group-hover:text-amdkp-gold transition-colors">AMDK-P <span class="text-amdkp-red text-xs align-top">GALERIA</span></span>
            </a>
            
            <a href="index.php" class="text-gray-400 hover:text-white text-sm font-bold uppercase tracking-wider transition-colors flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Sair</span>
            </a>
        </div>
    </header>

    <main class="flex-grow pt-32 pb-20 px-6 relative flex items-center justify-center">
        
        <div class="absolute inset-0 z-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at center, #333 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="max-w-6xl w-full mx-auto relative z-10">
            
            <div class="text-center mb-16 animate-fade-in">
                <h1 class="font-oswald text-4xl md:text-5xl text-white uppercase mb-4">Arquivo Digital</h1>
                <div class="h-1 w-24 bg-amdkp-gold mx-auto mb-6"></div>
                <p class="text-gray-400 max-w-2xl mx-auto">Selecione uma categoria para visualizar os álbuns fotográficos e vídeos.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                <?php foreach ($pastas as $pasta): ?>
                    <a href="<?php echo $pasta['link']; ?>" class="group block h-full">
                        <div class="bg-amdkp-panel border border-white/10 rounded-xl p-10 text-center transition-all duration-300 hover:border-amdkp-gold hover:shadow-[0_0_30px_rgba(212,175,55,0.15)] hover:-translate-y-2 relative overflow-hidden h-full flex flex-col items-center justify-center animate-fade-in">
                            
                            <div class="absolute inset-0 bg-gradient-to-br from-amdkp-gold/0 to-amdkp-gold/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            <div class="mb-6 relative transform group-hover:scale-110 transition-transform duration-300">
                                <i class="fas <?php echo $pasta['icone']; ?> text-7xl text-amdkp-gold/80 group-hover:text-amdkp-gold transition-colors drop-shadow-lg"></i>
                            </div>

                            <h2 class="font-oswald text-2xl text-white uppercase tracking-wider mb-2 group-hover:text-amdkp-gold transition-colors">
                                <?php echo $pasta['titulo']; ?>
                            </h2>

                            <p class="text-gray-500 text-sm font-sans group-hover:text-gray-300 transition-colors">
                                <?php echo $pasta['desc']; ?>
                            </p>
                            
                            <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0">
                                <span class="text-amdkp-gold text-sm font-bold uppercase tracking-widest">Abrir <i class="fas fa-chevron-right ml-1"></i></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        </div>
    </main>

    <footer class="border-t border-white/10 bg-black py-6 text-center">
        <p class="text-gray-600 text-xs uppercase tracking-widest">&copy; <?php echo date("Y"); ?> AMDKP - Área Reservada</p>
    </footer>

</body>
</html>