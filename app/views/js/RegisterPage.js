document.addEventListener('DOMContentLoaded', () => {

    const tabPanitia = document.getElementById('tab-panitia');
    const tabPeserta = document.getElementById('tab-peserta');
    const contentPanitia = document.getElementById('content-panitia');
    const contentPeserta = document.getElementById('content-peserta');

    const backButton = document.getElementById('backButton');
    
    const panitiaForm = document.getElementById('panitiaForm');
    const ktmInput = document.getElementById('panitia-ktm');
    const filePlaceholder = document.getElementById('file-upload-placeholder');
    const fileDetails = document.getElementById('file-upload-details');
    const fileNameEl = document.getElementById('file-name');
    const fileSizeEl = document.getElementById('file-size');
    const clearFileBtn = document.getElementById('clearFileButton');

    const pesertaForm = document.getElementById('pesertaForm');

    const toastEl = document.getElementById('toast');
    const toastMessageEl = document.getElementById('toast-message');

    let ktmFile = null;
    let toastTimer = null;


    /**
     * @param {string} messagePesan
     * @param {'success' | 'error'} type
     */
    function showToast(message, type = 'success') {
        if (toastTimer) {
            clearTimeout(toastTimer);
        }

        toastMessageEl.textContent = message;
        toastEl.className = 'toast-visible';
        if (type === 'success') {
            toastEl.classList.add('toast-success');
        } else {
            toastEl.classList.add('toast-error');
        }

        toastTimer = setTimeout(() => {
            toastEl.className = 'toast-hidden';
        }, 3000);
    }

    /**
     * @param {'panitia' | 'peserta'} activeTab
     */
    function switchTab(activeTab) {
        if (activeTab === 'panitia') {
            tabPanitia.dataset.state = 'active';
            tabPeserta.dataset.state = 'inactive';
            contentPanitia.classList.remove('hidden');
            contentPeserta.classList.add('hidden');
        } else {
            tabPanitia.dataset.state = 'inactive';
            tabPeserta.dataset.state = 'active';
            contentPanitia.classList.add('hidden');
            contentPeserta.classList.remove('hidden');
        }
    }

    /**
     */
    function handleFileChange(e) {
        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 5 * 1024 * 1024) {
            showToast('Ukuran file maksimal 5MB', 'error');
            ktmInput.value = '';
            return;
        }

        ktmFile = file;

        fileNameEl.textContent = file.name;
        fileSizeEl.textContent = `${(file.size / 1024).toFixed(2)} KB`;
        filePlaceholder.classList.add('hidden');
        fileDetails.classList.remove('hidden');
    }

    /**
     */
    function handleClearFile() {
        ktmFile = null;
        ktmInput.value = '';
        filePlaceholder.classList.remove('hidden');
        fileDetails.classList.add('hidden');
    }

    /**
     */
    function handlePanitiaSubmit(e) {
        e.preventDefault();
        
        const password = document.getElementById('panitia-password').value;
        const confirmPassword = document.getElementById('panitia-confirm-password').value;

        if (password !== confirmPassword) {
            showToast('Password dan konfirmasi password tidak sama', 'error');
            return;
        }
        if (password.length < 6) {
            showToast('Password minimal 6 karakter', 'error');
            return;
        }
        if (!ktmFile) {
            showToast('Mohon upload KTM Anda', 'error');
            return;
        }

        showToast('Pendaftaran Panitia berhasil! Menunggu verifikasi admin.', 'success');
        setTimeout(() => {
            window.location.href = '../components/Login.html'; 
        }, 1500);
    }

    /**
     */
    function handlePesertaSubmit(e) {
        e.preventDefault();
        
        const password = document.getElementById('peserta-password').value;
        const confirmPassword = document.getElementById('peserta-confirm-password').value;

        if (password !== confirmPassword) {
            showToast('Password dan konfirmasi password tidak sama', 'error');
            return;
        }
        if (password.length < 6) {
            showToast('Password minimal 6 karakter', 'error');
            return;
        }

        showToast('Pendaftaran Peserta berhasil! Silakan login.', 'success');
        setTimeout(() => {
            window.location.href = '../components/Login.html';
        }, 1500);
    }
    
    tabPanitia.addEventListener('click', () => switchTab('panitia'));
    tabPeserta.addEventListener('click', () => switchTab('peserta'));

    backButton.addEventListener('click', () => {
        window.location.href = '../components/Login.html'; 
    });

    ktmInput.addEventListener('change', handleFileChange);
    clearFileBtn.addEventListener('click', handleClearFile);
    panitiaForm.addEventListener('submit', handlePanitiaSubmit);

    pesertaForm.addEventListener('submit', handlePesertaSubmit);

    switchTab('peserta');
});