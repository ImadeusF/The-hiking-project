<?php
ob_start();
//Display the session info after the registration
$user_identifiant = isset($_SESSION['user']['sess_user']) ? $_SESSION['user']['sess_user'] : null;
$user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
?>

<nav class="bg-green-300 border-gray-200 rounded sticky top-0 z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="<?php echo BASE_PATH; ?>/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img class="h-8 rounded-full" src="<?php echo BASE_PATH; ?>/public/images/logo.jpg" alt="Your Logo">
        </a>
        
        <!-- DROP DOWN MENU FOR TAGS -->
        <?php if (!empty($user_identifiant)) : ?>
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="text-gray-50 text-lg" id="options-menu" aria-haspopup="true" aria-expanded="true">
                    <i class="fas fa-leaf"></i>
                    <span>Category</span>
                </button>
                <div x-show="open" class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <a href="<?php echo BASE_PATH; ?>/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">All</a>
                        <?php foreach ($tagList as $tag) { ?>
                            <a href="<?php echo BASE_PATH; ?>/category/<?php echo $tag['id']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"><?php echo $tag['name']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="flex items-center md:order-2 space-x-3">
            <?php if (empty($user_identifiant)) { ?>

                <a class="text-gray-50 text-lg nav-link" href="<?php echo BASE_PATH; ?>/">HOME</a>
                <a class="text-gray-50 text-lg nav-link" href="<?php echo BASE_PATH; ?>/login">LOGIN</a>
                <a class="text-gray-50 text-lg nav-link" href="<?php echo BASE_PATH; ?>/register">REGISTER</a>
            <?php } else { ?>
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="text-gray-50 text-lg" id="options-menu" aria-haspopup="true" aria-expanded="true">
                        <i class="fas fa-user-circle fa-lg"></i>
                        <span>Menu</span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="z-index: 1000;">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <?php if ($user_identifiant) { ?>
                                <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <?php echo " Connected as : " . $user_identifiant; ?>
                                </div>
                            <?php } ?>
                            <a href="<?php echo BASE_PATH; ?>/user/showprofil/<?= htmlspecialchars($user_id) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit Profil</a>
                            <a href="<?php echo BASE_PATH; ?>/user/hikesmngt/<?= htmlspecialchars($user_id) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Hikes Management</a>
                            <a href="<?php echo BASE_PATH; ?>/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>

<?php
$contentHeader = ob_get_clean();
$contentBody = "";
$contentFooter = "";
require(__DIR__ . '/layout.view.php');
?>