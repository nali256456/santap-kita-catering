document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.getElementById('navToggle');
    const mainNav = document.getElementById('mainNav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            mainNav.classList.toggle('open-mobile');
            if (mainNav.classList.contains('open-mobile')) {
                mainNav.style.display = 'flex';
                mainNav.style.flexDirection = 'column';
                mainNav.style.position = 'absolute';
                mainNav.style.top = '100%';
                mainNav.style.left = '0';
                mainNav.style.right = '0';
                mainNav.style.background = '#faf3e7';
                mainNav.style.padding = '16px 24px';
                mainNav.style.borderBottom = '1px solid #e3d4ba';
            } else {
                mainNav.style.display = 'none';
            }
        });
    }

    // Auto-hide flash messages
    document.querySelectorAll('.flash').forEach(function (el) {
        setTimeout(function () {
            el.style.transition = 'opacity .4s ease';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        }, 5000);
    });

    // User dropdown menu (member navbar)
    const userMenuTrigger = document.getElementById('userMenuTrigger');
    const userMenuDropdown = document.getElementById('userMenuDropdown');
    if (userMenuTrigger && userMenuDropdown) {
        userMenuTrigger.addEventListener('click', function (e) {
            e.stopPropagation();
            userMenuDropdown.classList.toggle('open');
        });
        document.addEventListener('click', function (e) {
            if (!userMenuDropdown.contains(e.target) && e.target !== userMenuTrigger) {
                userMenuDropdown.classList.remove('open');
            }
        });
    }

    // Sidebar toggle for dashboard (mobile)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const dashSidebar = document.getElementById('dashSidebar');
    if (sidebarToggle && dashSidebar) {
        sidebarToggle.addEventListener('click', function () {
            dashSidebar.classList.toggle('open');
        });
    }

    // Image preview for file inputs
    document.querySelectorAll('[data-preview]').forEach(function (input) {
        input.addEventListener('change', function (e) {
            const previewId = input.getAttribute('data-preview');
            const previewEl = document.getElementById(previewId);
            if (e.target.files && e.target.files[0] && previewEl) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    previewEl.src = ev.target.result;
                    previewEl.style.display = 'block';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });

    // Order total calculator
    const qtyInput = document.getElementById('quantityInput');
    const totalDisplay = document.getElementById('totalPriceDisplay');
    if (qtyInput && totalDisplay) {
        const unitPrice = parseFloat(qtyInput.getAttribute('data-price')) || 0;
        const formatRupiah = (num) => 'Rp ' + num.toLocaleString('id-ID');
        const updateTotal = () => {
            const qty = parseInt(qtyInput.value) || 0;
            totalDisplay.textContent = formatRupiah(qty * unitPrice);
        };
        qtyInput.addEventListener('input', updateTotal);
        updateTotal();
    }

    // Confirm delete actions
    document.querySelectorAll('[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const msg = form.getAttribute('data-confirm') || 'Apakah Anda yakin?';
            if (!confirm(msg)) {
                e.preventDefault();
            }
        });
    });
});
