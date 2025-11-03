<?php if (isset($_SESSION['toast'])): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div class="toast align-items-center text-bg-<?= htmlspecialchars($_SESSION['toast']['type']) ?> border-0 show"
            role="alert">
            <div class="d-flex">
                <div class="toast-body"><?= htmlspecialchars($_SESSION['toast']['message']) ?></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toastEl = document.querySelector('.toast');
        if (toastEl) new bootstrap.Toast(toastEl, { delay: 2500 }).show();
    });
</script>