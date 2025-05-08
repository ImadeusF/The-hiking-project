<?php
ob_start();
$user_identifiant = isset($_SESSION['user']['sess_user']) ? $_SESSION['user']['sess_user'] : null;
$user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
?>

<div class="relative min-h-screen flex items-center justify-center bg-gray-50 py-10 px-6 sm:px-6 lg:px-8">
    <img src="<?php echo BASE_PATH; ?>/public/images/forest.webp" alt="Background Image" class="absolute inset-0 h-full w-full object-cover z-0">
    <div class="relative max-w-sm w-full space-y-8 z-10 p-10 bg-white bg-opacity-25 rounded-md border border-white" style="backdrop-filter: blur(10px);">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-50">
            REGISTER
        </h2>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($error) { ?>
                <p class="text-center text-red-500"><?php echo htmlspecialchars($error) ?></p>
                <p class="text-center">Redirection in <span id="countdownRegister">3</span> seconds</p>
            <?php } else { ?>
                <p class="text-center text-white">Your registration is successful.</p>
                <p class="text-center">Redirection in <span id="countdownIndex">3</span> seconds</p>
            <?php } ?>
            <script>
                sleepRedirection();
            </script>
        <?php } else { ?>
            <form class="mt-8 space-y-6" method="post" action="<?php echo BASE_PATH; ?>/sub/verification">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="nickname" class="sr-only">Nickname</label>
                        <input type="text" id="nickname" name="nickname" placeholder="Nickname" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input type="text" id="email" name="email" placeholder="Email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                    </div>
                </div>
                <div>
                    <input type="submit" value="REGISTER" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-gray-50 bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                </div>
            </form>
        <?php } ?>
    </div>
</div>

<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";
require(__DIR__ . '/../layout.view.php');
?>