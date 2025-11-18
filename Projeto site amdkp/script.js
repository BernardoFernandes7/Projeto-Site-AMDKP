document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // 1. LÓGICA DO SLIDER DE FUNDO
    // ==========================================
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    
    // Garante que o primeiro slide aparece
    if (slides.length > 0) {
        slides[0].classList.add('active');
    }

    function changeSlide() {
        if (slides.length === 0) return;
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Muda de imagem a cada 3 segundos
    setInterval(changeSlide, 3000);


    // ==========================================
    // 2. LÓGICA DO MODAL DE LOGIN (TRAINING)
    // ==========================================
    
    const modal = document.getElementById("loginModal");
    const btnTraining = document.getElementById("training-btn");
    const closeBtn = document.querySelector(".close-modal"); // Usar querySelector é mais seguro aqui
    const loginForm = document.getElementById("loginForm");

    // ABRIR: Quando clica no botão "SIGA" do Training
    if(btnTraining) {
        btnTraining.addEventListener('click', function(event) {
            event.preventDefault(); // IMPEDE que o link carregue outra página
            modal.style.display = "block"; // Mostra a janela
        });
    }

    // FECHAR: Quando clica no X
    if(closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = "none";
        });
    }

    // FECHAR: Quando clica fora da janela (no fundo escuro)
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    // LOGIN: Quando carrega em "ENTRAR"
    if(loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Impede a página de recarregar
            
            // Redireciona para a página de treino
            window.location.href = "training.html"; 
        });
    }

});