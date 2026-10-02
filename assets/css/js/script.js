document.addEventListener('DOMContentLoaded', function () {
    // Password visibility toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🔒';
        });
    }

    // Delete Modal Event Handling
    const deleteTriggers = document.querySelectorAll('.btn-delete-trigger');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const cancelDeleteBtn2 = document.getElementById('cancelDeleteBtn');
    const confirmDeleteForm = document.getElementById('confirmDeleteForm');
    const modalCustomerName = document.getElementById('modalCustomerName');

    if (deleteModal) {
        deleteTriggers.forEach(button => {
            button.addEventListener('click', function () {
                const customerId = this.getAttribute('data-id');
                const customerName = this.getAttribute('data-name');
                
                modalCustomerName.textContent = customerName;
                confirmDeleteForm.action = 'delete_customer.php?id=' + customerId;
                deleteModal.classList.add('active');
            });
        });

        const closeModal = () => deleteModal.classList.remove('active');
        
        if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeModal);
        if (cancelDeleteBtn2) cancelDeleteBtn2.addEventListener('click', closeModal);
        
        // Close modal when clicking on dark backdrop outside box
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeModal();
            }
        });
    }
});document.addEventListener('DOMContentLoaded', function () {
    // Password visibility toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🔒';
        });
    }

    // Delete Modal Event Handling
    const deleteTriggers = document.querySelectorAll('.btn-delete-trigger');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const cancelDeleteBtn2 = document.getElementById('cancelDeleteBtn');
    const confirmDeleteForm = document.getElementById('confirmDeleteForm');
    const modalCustomerName = document.getElementById('modalCustomerName');

    if (deleteModal) {
        deleteTriggers.forEach(button => {
            button.addEventListener('click', function () {
                const customerId = this.getAttribute('data-id');
                const customerName = this.getAttribute('data-name');
                
                modalCustomerName.textContent = customerName;
                confirmDeleteForm.action = 'delete_customer.php?id=' + customerId;
                deleteModal.classList.add('active');
            });
        });

        const closeModal = () => deleteModal.classList.remove('active');
        
        if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeModal);
        if (cancelDeleteBtn2) cancelDeleteBtn2.addEventListener('click', closeModal);
        
        // Close modal when clicking on dark backdrop outside box
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeModal();
            }
        });
    }
});document.addEventListener('DOMContentLoaded', function () {
    // Password visibility toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🔒';
        });
    }

    // Delete Modal Event Handling
    const deleteTriggers = document.querySelectorAll('.btn-delete-trigger');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const cancelDeleteBtn2 = document.getElementById('cancelDeleteBtn');
    const confirmDeleteForm = document.getElementById('confirmDeleteForm');
    const modalCustomerName = document.getElementById('modalCustomerName');

    if (deleteModal) {
        deleteTriggers.forEach(button => {
            button.addEventListener('click', function () {
                const customerId = this.getAttribute('data-id');
                const customerName = this.getAttribute('data-name');
                
                modalCustomerName.textContent = customerName;
                confirmDeleteForm.action = 'delete_customer.php?id=' + customerId;
                deleteModal.classList.add('active');
            });
        });

        const closeModal = () => deleteModal.classList.remove('active');
        
        if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeModal);
        if (cancelDeleteBtn2) cancelDeleteBtn2.addEventListener('click', closeModal);
        
        // Close modal when clicking on dark backdrop outside box
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                closeModal();
            }
        });
    }
});