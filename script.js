document.addEventListener('DOMContentLoaded', function() {
    

    const API_URL = "api_dojos.php"; 
    
    const DEFAULT_IMG = "https://www.amdkp.pt/0website/semfoto.png";
    
    const BRIDGE_URL  = "bridge.php?url="; 
    
    let allDojosData = [];
    let dataLoaded = false;

    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenuContainer = document.getElementById('mobileMenuContainer');
  
    if(mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuContainer.classList.toggle('open');
            const icon = mobileMenuBtn.querySelector('i');
            if(mobileMenuContainer.classList.contains('open')){
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
    
    window.toggleMobileSubmenu = function(id, btn) {
        const sub = document.getElementById(id);
        const icon = btn.querySelector('.fa-chevron-down');
        
        if (sub.classList.contains('open')) {
            sub.classList.remove('open');
            if(icon) icon.style.transform = 'rotate(0deg)';
        } else {
            document.querySelectorAll('.mobile-submenu.open').forEach(el => {
                el.classList.remove('open');
                const parentBtn = el.previousElementSibling;
                if(parentBtn) {
                    const otherIcon = parentBtn.querySelector('.fa-chevron-down');
                    if(otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                }
            });
            sub.classList.add('open');
            if(icon) icon.style.transform = 'rotate(180deg)';
        }
    }

    
    function extractDriveId(url) {
      if (!url) return null;
      if (url.match(/drive\.google\.com/)) {
          let match = url.match(/[?&]id=([-\w]+)/);
          if (match) return match[1];
          match = url.match(/\/(?:d|folders)\/([-\w]+)/);
          if (match) return match[1];
      }
      if (url.match(/^[-\w]{25,}$/)) return url; 
      return null;
    }

    function formatImageSource(value) {
      if (!value) return DEFAULT_IMG;
      const str = String(value).trim();
      
      
      if(str.includes("/folders/")) return str;
      
      
      const driveId = extractDriveId(str);
      if (driveId) return "https://drive.google.com/uc?export=view&id=" + driveId;
      
      
      return str; 
    }

    function getCallCost(phone) {
        if (!phone) return "";
        const p = String(phone).trim();
        if (p.startsWith("2")) return "(Chamada para a rede fixa nacional)";
        if (p.startsWith("9")) return "(Chamada para a rede móvel nacional)";
        return "";
    }
  
   
    function openModal(id) { 
        const el = document.getElementById(id); 
        if(el) { 
            el.classList.remove('hidden'); 
            el.classList.add('block'); 
        } 
    }
    
    function closeModal(id) { 
        const el = document.getElementById(id); 
        if(el) { 
            el.classList.add('hidden'); 
            el.classList.remove('block'); 
        } 
    }
    
    document.querySelectorAll('.close-btn').forEach(btn => { 
        btn.addEventListener('click', (e) => { 
            const modal = e.target.closest('.fixed'); 
            if(modal) closeModal(modal.id); 
        }); 
    });
    
    window.addEventListener('click', (e) => { 
        if(e.target.classList.contains('fixed') || e.target.closest('.absolute-backdrop')) {
             if(e.target.id) closeModal(e.target.id);
        }
    });
    
    window.addEventListener('keydown', (e) => { 
        if(e.key === 'Escape') document.querySelectorAll('.fixed:not(.hidden)').forEach(m => closeModal(m.id)); 
    });
  
    
    const contactBtn = document.getElementById('openContactBtnFloater');
    if(contactBtn) contactBtn.onclick = () => openModal('contactModal');

    const dojosBtn = document.getElementById('openDojosBtn');
    if(dojosBtn) dojosBtn.addEventListener('click', () => { 
        openModal('dojoModal'); 
        if (!dataLoaded) fetchDojos(); 
    });

    const galBtn = document.getElementById('openGalleryModalBtn');
    if(galBtn) galBtn.onclick = () => openModal('galleryModal');

    const appBtn = document.getElementById('openAppBtn');
    if(appBtn) appBtn.onclick = () => openModal('appModal');

    const adminBtn = document.getElementById('openAdminLogin');
    if(adminBtn) adminBtn.onclick = () => openModal('adminLoginModal');
  
    
   
    const listContainer = document.getElementById('dynamicDojoList');
    const loader = document.getElementById('loadingDojos');
  
    function fetchDojos() {
      
      fetch(API_URL)
        .then(r => r.json())
        .then(data => {
          
          allDojosData = (data || []).map(escola => {
            return escola;
          });
          
          renderDojos(allDojosData);
          
          if(loader) loader.style.display = 'none';
          dataLoaded = true;
        })
        .catch(e => { 
            console.error("Erro ao buscar dojos:", e); 
            if(loader) loader.innerHTML = "Erro de ligação ao servidor."; 
        });
    }
  
    function renderDojos(escolas) {
      if(!listContainer) return;
      let html = '';
      
      escolas.forEach(escola => {
        
        const isActive = String(escola.ativo).toUpperCase() === 'TRUE' || escola.ativo == 1;
        if (!isActive) return;

        const logoSrc   = formatImageSource(escola.logourl);
        const senseiSrc = escola.fotosurl ? formatImageSource(escola.fotosurl) : "";
        const morada    = escola.morada || "";
        const local     = escola.localidade || "";
        
       
        let senseiBtns = '';
        if (escola.telefone) {
            senseiBtns += `<div class="inline-block text-center mr-1.5"><a href="tel:${escola.telefone}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 hover:bg-amdkp-red/20 hover:border-amdkp-red transition-all"><i class="fas fa-phone text-amdkp-red"></i> ${escola.telefone}</a><span class="block text-[10px] text-gray-500 italic mt-0.5">${getCallCost(escola.telefone)}</span></div>`;
        }
        if (escola.whatsapp) {
            senseiBtns += `<div class="inline-block align-top mr-1.5"><a href="https://wa.me/${escola.whatsapp}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 hover:bg-amdkp-red/20 hover:border-amdkp-red transition-all"><i class="fab fa-whatsapp text-amdkp-red"></i> WA</a></div>`;
        }
        const email = (escola.email || '').trim();
        if (email) {
            senseiBtns += `<div class="inline-block align-top"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 cursor-default"><i class="fas fa-envelope text-amdkp-red"></i> ${email}</span></div>`;
        }
        
        
        let senseiSection = '';
        if (escola.sensei || senseiBtns) {
            senseiSection = `<div class="mt-2.5 pl-3 border-l-2 border-white/10"><span class="block text-[10px] uppercase tracking-wider text-amdkp-gold mb-1.5 font-bold">Responsável Escola / Sensei: ${escola.sensei || ''}</span><div class="flex flex-wrap gap-2 items-center mb-1">${senseiBtns}</div></div>`;
        }

        
        let secBtns = '';
        if (escola.secretariatel) {
            secBtns += `<div class="inline-block text-center mr-1.5"><a href="tel:${escola.secretariatel}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 hover:bg-amdkp-red/20 hover:border-amdkp-red transition-all"><i class="fas fa-phone text-amdkp-red"></i> ${escola.secretariatel}</a><span class="block text-[10px] text-gray-500 italic mt-0.5">${getCallCost(escola.secretariatel)}</span></div>`;
        }
        const secEmail = (escola.secretariaemail || '').trim();
        if (secEmail) {
            secBtns += `<div class="inline-block align-top"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 cursor-default"><i class="fas fa-envelope text-amdkp-red"></i> ${secEmail}</span></div>`;
        }
        let secSection = '';
        if (secBtns || escola.respnome) {
            const label = escola.respnome ? "Secretaria / Responsável: " + escola.respnome : "Secretaria";
            secSection = `<div class="mt-2.5 pl-3 border-l-2 border-white/10"><span class="block text-[10px] uppercase tracking-wider text-amdkp-gold mb-1.5 font-bold">${label}</span><div class="flex flex-wrap gap-2 items-center mb-1">${secBtns}</div></div>`;
        }

        
        let linkBtns = '';
        if (escola.site) linkBtns += `<a href="${escola.site}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 hover:bg-amdkp-red/20 hover:border-amdkp-red transition-all"><i class="fas fa-globe text-amdkp-red"></i> Site</a>`;
        if (escola.maps) linkBtns += `<a href="${escola.maps}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 hover:bg-amdkp-red/20 hover:border-amdkp-red transition-all"><i class="fas fa-map-marker-alt text-amdkp-red"></i> Maps</a>`;
        
        
        if (escola.galeriaurl) linkBtns += `<button type="button" class="dojo-gallery-btn inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-white/10 text-xs text-gray-200 hover:bg-amdkp-red/20 hover:border-amdkp-red transition-all" data-url="${escola.galeriaurl}" data-title="Galeria do Dojo"><i class="fas fa-images text-amdkp-red"></i> O Espaço</button>`;
        
        let socialIcons = '';
        if (escola.facebook)  socialIcons += `<a href="${escola.facebook}" target="_blank" class="text-gray-400 text-lg hover:text-amdkp-gold hover:scale-110 transition-all"><i class="fab fa-facebook"></i></a>`;
        if (escola.instagram) socialIcons += `<a href="${escola.instagram}" target="_blank" class="text-gray-400 text-lg hover:text-amdkp-gold hover:scale-110 transition-all"><i class="fab fa-instagram"></i></a>`;
        if (escola.tiktok)    socialIcons += `<a href="${escola.tiktok}" target="_blank" class="text-gray-400 text-lg hover:text-amdkp-gold hover:scale-110 transition-all"><i class="fab fa-tiktok"></i></a>`;
        
        let linkSection = '';
        if (linkBtns || socialIcons) {
            linkSection = `<div class="mt-3 flex flex-wrap items-center gap-3"><div class="flex flex-wrap gap-2">${linkBtns}</div>${socialIcons ? `<div class="w-px h-4 bg-white/20 mx-1"></div><div class="flex gap-3">${socialIcons}</div>` : ''}</div>`;
        }

      
        html += `<div class="dojo-card-item flex flex-col md:flex-row gap-5 p-4 border-b border-white/10 items-start bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                    <div class="relative w-16 h-16 shrink-0">
                        <img src="${logoSrc}" class="w-full h-full rounded-full object-cover border-2 border-amdkp-gold bg-[#111]" onerror="this.src='${DEFAULT_IMG}'">
                        ${senseiSrc ? `<img src="${senseiSrc}" class="absolute -bottom-2 -right-2 w-9 h-9 rounded-full border-2 border-[#111] object-cover bg-[#333] shadow-md" title="Sensei ${escola.sensei || ''}" onerror="this.style.display='none'">` : ''}
                    </div>
                    <div class="flex-1 w-full">
                        <h3 class="text-base font-semibold text-amdkp-silver mb-1">${escola.nome || ''}</h3>
                        <div class="text-sm text-gray-300 opacity-90 mb-2">${morada}<br>${local}</div>
                        ${senseiSection}
                        ${secSection}
                        ${linkSection}
                    </div>
                </div>`;
      });
      
      listContainer.innerHTML = html;
      attachGalleryEvents();
    }
  
   
    const galImg = document.getElementById('dojoGalleryImage');
    const galTitle = document.getElementById('dojoGalleryTitle');
    const btnFolder = document.getElementById('folderLinkBtn');
    const linkExt = document.getElementById('externalGalleryLink');
    const galContent = document.getElementById('galleryContent');
  
    function attachGalleryEvents() {
        document.querySelectorAll('.dojo-gallery-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                let baseUrl = btn.getAttribute('data-url');
                let title = btn.getAttribute('data-title');
                
                if (!baseUrl) return;

                openModal('dojoGalleryModal');

                if (galTitle) galTitle.textContent = title || "Galeria";
                
                
                if (galImg) galImg.classList.add('hidden');
                if (btnFolder) btnFolder.classList.remove('hidden');
                if (linkExt) linkExt.href = baseUrl;
                if (galContent) galContent.classList.add('single-mode');

                
                if (baseUrl.match(/\.(jpeg|jpg|gif|png|webp|bmp)$/i)) {
                    if(galImg) {
                        galImg.src = formatImageSource(baseUrl);
                        galImg.classList.remove('hidden');
                    }
                    if(btnFolder) btnFolder.classList.add('hidden');
                }
            });
        });
    }
  
    
    const amdkpCarousel = document.getElementById('amdkpCarousel');
    const baseUrlGal = window.AMDKP_CONFIG ? window.AMDKP_CONFIG.baseUrlGal : ""; 
    
    if(baseUrlGal && amdkpCarousel) {
        const amdkpImgs = [
            baseUrlGal + "1.png", baseUrlGal + "2.png", baseUrlGal + "3.png", 
            baseUrlGal + "4.png", baseUrlGal + "5.png", baseUrlGal + "6.png", 
            baseUrlGal + "7.png", baseUrlGal + "8.png", baseUrlGal + "9.png"
        ];
        let amdkpIdx = 0;
        
        function updateAmdkpCarousel() { 
            if(amdkpCarousel) amdkpCarousel.src = amdkpImgs[amdkpIdx]; 
        }
        
        const prevBtn = document.querySelector('#amdkpCarouselContainer .prev');
        const nextBtn = document.querySelector('#amdkpCarouselContainer .next');
        
        if(prevBtn) { prevBtn.addEventListener('click', () => { amdkpIdx = (amdkpIdx - 1 + amdkpImgs.length) % amdkpImgs.length; updateAmdkpCarousel(); }); }
        if(nextBtn) { nextBtn.addEventListener('click', () => { amdkpIdx = (amdkpIdx + 1) % amdkpImgs.length; updateAmdkpCarousel(); }); }
        
        
        setInterval(() => { amdkpIdx = (amdkpIdx + 1) % amdkpImgs.length; updateAmdkpCarousel(); }, 3000);
    }
  
   
    const btnAuth = document.getElementById('btnAuth');
    if(btnAuth) {
        btnAuth.addEventListener('click', () => {
            const u = document.getElementById('adminUser').value;
            const p = document.getElementById('adminPass').value;
            const msg = document.getElementById('loginMsg');
            
            btnAuth.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            msg.classList.add('hidden');
            
            
            fetch(API_URL, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ action: 'checkAuth', user: u, pass: p })
            })
            .then(r => r.json())
            .then(data => { 
                if (data.status === 'success') { 
                    closeModal('adminLoginModal'); 
                    openModal('maintenanceModal'); 
                    renderEditList(); 
                } else { 
                    msg.classList.remove('hidden'); 
                } 
            })
            .catch(() => msg.classList.remove('hidden'))
            .finally(() => btnAuth.innerHTML = 'Entrar');
        });
    }
  
    window.switchTab = function(tab) {
        document.getElementById('tab-add').classList.add('hidden');
        document.getElementById('tab-edit').classList.add('hidden');
        document.getElementById('tab-btn-add').classList.remove('text-white', 'border-amdkp-gold');
        document.getElementById('tab-btn-add').classList.add('text-gray-400', 'border-transparent');
        document.getElementById('tab-btn-edit').classList.remove('text-white', 'border-amdkp-gold');
        document.getElementById('tab-btn-edit').classList.add('text-gray-400', 'border-transparent');
        
        document.getElementById('tab-' + tab).classList.remove('hidden');
        document.getElementById('tab-btn-' + tab).classList.add('text-white', 'border-amdkp-gold');
        document.getElementById('tab-btn-' + tab).classList.remove('text-gray-400', 'border-transparent');
        
        if(tab === 'edit') renderEditList();
    };
  
    function renderEditList() {
        const container = document.getElementById('editListContainer');
        let html = '';
        if (!allDojosData || allDojosData.length === 0) {
            html = '<div class="text-center p-5 text-gray-500">Lista vazia...</div>';
        } else {
            allDojosData.forEach((escola, index) => {
                const isActive = String(escola.ativo).toUpperCase() === 'TRUE' || escola.ativo == 1;
                const statusColor = isActive ? 'bg-green-500' : 'bg-red-500';
                
                
                const idParaEditar = index; 
                
                html += `<div class="flex justify-between items-center p-3 bg-[#222] rounded border border-[#333] mb-2">
                            <span class="text-sm font-semibold text-white flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full ${statusColor}"></span> ${escola.nome || ''}
                            </span>
                            <button class="px-2 py-1 bg-[#444] text-white rounded hover:bg-amdkp-gold hover:text-black transition" onclick="loadSchoolForEdit(${idParaEditar})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>`;
            });
        }
        container.innerHTML = html;
    }
    
    window.loadSchoolForEdit = function(index) {
        const escola = allDojosData[index];
        
        
        document.getElementById('inpNome').value = escola.nome || '';
        
        document.getElementById('originalRow').value = escola.id || ''; 
        
        document.getElementById('inpLocal').value = escola.localidade || '';
        document.getElementById('inpMorada').value = escola.morada || '';
        document.getElementById('inpSensei').value = escola.sensei || '';
        document.getElementById('inpTel').value = escola.telefone || '';
        document.getElementById('inpWa').value = escola.whatsapp || '';
        document.getElementById('inpEmail').value = escola.email || '';
        document.getElementById('inpSite').value = escola.site || '';
        document.getElementById('inpMaps').value = escola.maps || '';
        document.getElementById('inpLogo').value = escola.logourl || '';
        document.getElementById('inpGaleria').value = escola.galeriaurl || '';
        document.getElementById('inpSenseiFoto').value = escola.fotosurl || '';
        
        document.getElementById('formAction').value = 'edit';
        document.getElementById('btnLabel').innerText = 'Guardar';
        document.getElementById('statusDiv').classList.remove('hidden');
        
        const isActive = String(escola.ativo).toUpperCase() === 'TRUE' || escola.ativo == 1;
        document.getElementById('inpStatus').value = isActive ? 'TRUE' : 'FALSE';
        
        document.getElementById('btnCancelEdit').classList.remove('hidden');
        switchTab('add');
    };
  
    const btnCancel = document.getElementById('btnCancelEdit');
    if(btnCancel) {
        btnCancel.onclick = () => {
            document.getElementById('schoolForm').reset();
            document.getElementById('formAction').value = 'add';
            document.getElementById('btnLabel').innerText = 'Adicionar Escola';
            document.getElementById('statusDiv').classList.add('hidden');
            document.getElementById('btnCancelEdit').classList.add('hidden');
        };
    }
  
    
    const schoolForm = document.getElementById('schoolForm');
    if(schoolForm) {
        schoolForm.onsubmit = (e) => {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitSchool');
            const original = btn.innerHTML;
            btn.innerHTML = 'A gravar...';
            btn.disabled = true;
            
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());
            
            
            if (data.morada && !data["morada "]) data["morada "] = data.morada;
            
            fetch(API_URL, { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json' }, 
                body: JSON.stringify(data) 
            })
            .then(r => r.json())
            .then(resp => { 
                if(resp.status === 'success') {
                    alert('Gravado com sucesso!'); 
                    document.getElementById('btnCancelEdit').click(); 
                    closeModal('maintenanceModal'); 
                    dataLoaded = false; 
                    fetchDojos();
                } else {
                    alert('Erro ao gravar: ' + (resp.message || 'Erro desconhecido'));
                }
            })
            .catch(err => {
                console.error(err);
                alert('Erro de comunicação com o servidor.');
            })
            .finally(() => { 
                btn.innerHTML = original; 
                btn.disabled = false; 
            });
        };
    }
});