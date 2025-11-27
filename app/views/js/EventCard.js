// Tunggu semua konten HTML dimuat
document.addEventListener("DOMContentLoaded", () => {

    const popupContainer = document.getElementById("popupContainer");
    const popupContentWrapper = document.getElementById("popup-content-wrapper");
    const popupBody = document.getElementById("popup-body");
    const openDetailButton = document.getElementById("openEventDetail");
    const closeFrameButton = document.getElementById("closePopupFrameBtn");

    
    /**
     */
    function showPopup() {
        popupContainer.classList.add("show");
    }

    /**
     */
    function closePopup() {
        popupContainer.classList.remove("show");
        popupBody.innerHTML = '<p class="text-center text-gray-500">Memuat...</p>';
    }

    /**
     * @param {string} url
     * @param {function} callback
     */
    async function loadPopupContent(url, callback) {
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error(`Gagal memuat ${url}`);
            
            const html = await response.text();
            
            popupBody.innerHTML = html;
            
            if (url.includes('PaymentMethodDialog')) {
                popupContentWrapper.classList.remove('max-w-2xl');
                popupContentWrapper.classList.add('max-w-lg');
            } else {
                popupContentWrapper.classList.remove('max-w-lg');
                popupContentWrapper.classList.add('max-w-2xl');
            }

            if (callback) {
                callback();
            }

        } catch (error) {
            console.error(error);
            popupBody.innerHTML = `<p class="text-red-500 text-center">Terjadi kesalahan: ${error.message}</p>`;
        }
    }


    /**
     */
    function attachDetailListeners() {
        const joinEventBtn = document.getElementById("joinEventBtn");
        const closeDetailBtn = document.getElementById("closeDetailBtn");

        joinEventBtn.addEventListener("click", () => {
            console.log("Tombol Ikuti Acara diklik. Memuat popup pembayaran...");
            loadPopupContent("PaymentMethodDialog.html", attachPaymentListeners);
        });

        closeDetailBtn.addEventListener("click", closePopup);
    }

    /**
     */
    function attachPaymentListeners() {
        const cancelPaymentBtn = document.getElementById("cancelPaymentBtn");
        const proceedPaymentBtn = document.getElementById("proceedPaymentBtn");

        cancelPaymentBtn.addEventListener("click", closePopup);

        proceedPaymentBtn.addEventListener("click", () => {
            // Di sini Anda akan melanjutkan ke alur pembayaran (misal: QRIS atau VA)
            alert("Melanjutkan ke Pembayaran!");
            closePopup();
        });
    }


    openDetailButton.addEventListener("click", () => {
        console.log("Membuka popup detail event...");
        showPopup();
        loadPopupContent("EventDialogDetail.php", attachDetailListeners);
    });

    closeFrameButton.addEventListener("click", closePopup);

    popupContainer.addEventListener("click", (event) => {
        if (event.target === popupContainer) {
            closePopup();
        }
    });
});