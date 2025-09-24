<?php require __DIR__ . '/partials/header.php'; ?>

<div class="border-b border-gray-200 pb-8 mb-8">
    <h2 class="text-4xl font-semibold text-gray-900 sm:text-5xl text-center">Crea un enlace o proyecto</h2>
</div>

<div class="w-full max-w-xl mx-auto">
    <form method="POST" novalidate>
        <!-- TÍTULO -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-900">Título</label>
            <div class="mt-2">
                <input 
                    type="text" 
                    name="title" 
                    class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900" 
                    value="<?= htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <?php if (!empty($errors['title'])): ?>
                    <p class="text-xs text-red-500 mt-1">&rarr; <?= $errors['title'][0] ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- URL -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-900">Url</label>
            <div class="mt-2">
                <input 
                    type="text" 
                    name="url" 
                    class="w-full outline-1 outline-gray-300 rounded-md px-3 py-2 text-gray-900" 
                    value="<?= htmlspecialchars($_POST['url'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <?php if (!empty($errors['url'])): ?>
                    <p class="text-xs text-red-500 mt-1">&rarr; <?= $errors['url'][0] ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- DESCRIPCIÓN -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-900">Descripción</label>
            <div class="mt-2">
                <textarea 
                    name="description" 
                    rows="2" 
                    class="w-full outline-1 outline-gray-300 rounded-md px-4 py-2 text-gray-900"><?= htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                <?php if (!empty($errors['description'])): ?>
                    <p class="text-xs text-red-500 mt-1">&rarr; <?= $errors['description'][0] ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="w-full rounded-md bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-2 text-center text-sm font-semibold">
                Crear &rarr;
            </button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
