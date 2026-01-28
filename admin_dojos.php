<?php
session_start();
require 'conection.php';


if (!isset($_SESSION['galeria_auth']) || $_SESSION['galeria_auth'] !== true) {
    header("Location: index.php");
    exit;
}

$mensagem = "";
$tipo_mensagem = ""; 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar') {
    try {
        $sql = "INSERT INTO dojos (nome, localidade, sensei, morada, horario, telefone, email, maps, facebook, instagram, logourl, fotosurl, ativo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            $_POST['nome'],
            $_POST['localidade'],
            $_POST['sensei'],
            $_POST['morada'],
            $_POST['horario'],
            $_POST['telefone'],
            $_POST['email'],
            $_POST['maps'],
            $_POST['facebook'],
            $_POST['instagram'],
            $_POST['logourl'],
            $_POST['fotosurl']
        ]);

        $mensagem = "Dojo criado com sucesso!";
        $tipo_mensagem = "sucesso";
    } catch (PDOException $e) {
        $mensagem = "Erro ao criar dojo: " . $e->getMessage();
        $tipo_mensagem = "erro";
    }
}


if (isset($_GET['delete_id'])) {
    $id_para_apagar = (int)$_GET['delete_id'];
    try {
        $stmt = $dbh->prepare("UPDATE dojos SET ativo = 0 WHERE id = ?");
        $stmt->execute([$id_para_apagar]);
        
        $mensagem = "Dojo removido do site com sucesso!";
        $tipo_mensagem = "sucesso";
    } catch (PDOException $e) {
        $mensagem = "Erro ao remover dojo.";
        $tipo_mensagem = "erro";
    }
}


try {
    $stmt = $dbh->query("SELECT * FROM dojos WHERE ativo = 1 ORDER BY nome ASC");
    $dojos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao ligar à base de dados.");
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Dojos | Backoffice AMDKP</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;500;700&family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { amdkp: { red: '#D80027', gold: '#d4af37', dark: '#0f0f0f', panel: '#1a1a1a' } },
                    fontFamily: { sans: ['Montserrat', 'sans-serif'], oswald: ['Oswald', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-amdkp-dark text-white min-h-screen pb-20">

    <header class="bg-black border-b border-white/10 p-6 mb-10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="font-oswald text-2xl text-amdkp-gold uppercase tracking-widest">
                <i class="fas fa-cogs mr-2"></i> Gestão de Dojos
            </h1>
            <div>
                <a href="dojos.php" class="text-sm text-amdkp-red hover:text-white uppercase font-bold transition flex items-center gap-2 border border-amdkp-red/50 px-4 py-2 rounded hover:bg-amdkp-red hover:border-amdkp-red">
                    Sair
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6">

        <?php if ($mensagem): ?>
            <div class="p-4 mb-8 rounded border <?php echo $tipo_mensagem === 'sucesso' ? 'bg-green-900/30 border-green-500 text-green-400' : 'bg-red-900/30 border-red-500 text-red-400'; ?>">
                <i class="fas <?php echo $tipo_mensagem === 'sucesso' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <div class="lg:col-span-1">
                <div class="bg-amdkp-panel p-8 rounded-xl border border-white/10 sticky top-32">
                    <h2 class="font-oswald text-xl text-white uppercase mb-6 border-b border-white/10 pb-2">
                        <i class="fas fa-plus-circle text-amdkp-gold mr-2"></i> Adicionar Novo
                    </h2>
                    
                    <form method="POST" action="admin_dojos.php" class="space-y-4">
                        <input type="hidden" name="acao" value="criar">
                        
                        <div>
                            <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Nome do Dojo *</label>
                            <input type="text" name="nome" required class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Localidade *</label>
                                <input type="text" name="localidade" required class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Sensei *</label>
                                <input type="text" name="sensei" required class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Morada</label>
                            <textarea name="morada" rows="2" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Horário</label>
                            <textarea name="horario" rows="3" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Telefone</label>
                                <input type="text" name="telefone" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Email</label>
                                <input type="email" name="email" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Link Google Maps (Embed src)</label>
                            <input type="text" name="maps" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none text-xs">
                        </div>

                        <div>
                            <label class="block text-xs uppercase text-gray-500 font-bold mb-1">URL Logótipo</label>
                            <input type="text" name="logourl" placeholder="https://..." class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none text-xs">
                        </div>

                        <div>
                            <label class="block text-xs uppercase text-gray-500 font-bold mb-1">URL Foto Sensei</label>
                            <input type="text" name="fotosurl" placeholder="https://..." class="w-full bg-black/50 border border-white/20 rounded p-2 text-white focus:border-amdkp-gold focus:outline-none text-xs">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="facebook" placeholder="Link Facebook" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white text-xs">
                            <input type="text" name="instagram" placeholder="Link Instagram" class="w-full bg-black/50 border border-white/20 rounded p-2 text-white text-xs">
                        </div>

                        <button type="submit" class="w-full py-3 bg-amdkp-gold text-black font-bold uppercase tracking-widest rounded hover:bg-white transition-all shadow-lg mt-4">
                            Criar Dojo
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-amdkp-panel p-8 rounded-xl border border-white/10">
                    <h2 class="font-oswald text-xl text-white uppercase mb-6 border-b border-white/10 pb-2 flex justify-between items-center">
                        <span><i class="fas fa-list-ul text-amdkp-gold mr-2"></i> Dojos Ativos</span>
                        <span class="text-xs bg-amdkp-gold text-black px-2 py-1 rounded font-sans font-bold"><?php echo count($dojos); ?></span>
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-gray-500 text-xs uppercase border-b border-white/10">
                                    <th class="p-3">Nome</th>
                                    <th class="p-3">Localidade</th>
                                    <th class="p-3">Sensei</th>
                                    <th class="p-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dojos as $dojo): ?>
                                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                    <td class="p-3 font-bold text-white"><?php echo $dojo['nome']; ?></td>
                                    <td class="p-3 text-gray-400 text-sm"><?php echo $dojo['localidade']; ?></td>
                                    <td class="p-3 text-gray-400 text-sm"><?php echo $dojo['sensei']; ?></td>
                                    <td class="p-3 text-right">
                                        <a href="admin_dojos.php?delete_id=<?php echo $dojo['id']; ?>" 
                                           onclick="return confirm('Tem a certeza que quer remover este dojo?');"
                                           class="inline-block px-3 py-1 bg-red-900/50 text-red-400 border border-red-500/30 rounded text-xs hover:bg-red-600 hover:text-white transition">
                                            <i class="fas fa-trash-alt"></i> Remover
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                
                                <?php if(empty($dojos)): ?>
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500 italic">Não existem dojos ativos.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>