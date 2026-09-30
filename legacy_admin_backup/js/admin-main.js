document.addEventListener('DOMContentLoaded', () => {
    // Mobile Sidebar Toggle
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // Modal Handling for CRUD operations
    const openModalBtns = document.querySelectorAll('[data-admin-modal]');
    const closeBtns = document.querySelectorAll('.modal-close, [data-dismiss="modal"]');
    
    openModalBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = btn.getAttribute('data-admin-modal');
            const modal = document.getElementById(targetId);
            
            // If it's an edit button, we can populate the form based on data attributes
            const action = btn.getAttribute('data-action');
            if(action === 'edit' && modal) {
                const title = modal.querySelector('.modal-title');
                if(title) title.textContent = 'تعديل البيانات';
                // Here we would normally fetch or populate data
            } else if (action === 'add' && modal) {
                const title = modal.querySelector('.modal-title');
                if(title) title.textContent = 'إضافة جديد';
                const form = modal.querySelector('form');
                if(form) form.reset();
            }

            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.admin-modal');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    });

    // Close modal on outside click
    document.querySelectorAll('.admin-modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    });
});
