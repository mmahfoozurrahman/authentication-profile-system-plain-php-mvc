<?php if ($message = getFlash('success')): ?>
    <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700 ring-1 ring-green-600/20">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<?php if ($message = getFlash('error')): ?>
    <div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-700 ring-1 ring-red-600/20">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>