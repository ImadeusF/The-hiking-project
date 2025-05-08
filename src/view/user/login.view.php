<?php ob_start(); ?>
<div class="relative min-h-screen flex items-center justify-center bg-gray-50 py-10 px-6 sm:px-6 lg:px-8 ">
    <img src="<?php echo BASE_PATH; ?>/public/images/forest.webp" alt="Background Image" class="absolute inset-0 h-full w-full object-cover z-0">
    <div class="relative max-w-sm w-full space-y-8 z-10 p-10 bg-white bg-opacity-25 rounded-md border border-white" style="backdrop-filter: blur(10px);">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-50">
            LOGIN IN
        </h2>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($error) { ?>
                <p class="text-center text-red-500"><?php echo htmlspecialchars($error) ?></p>
                <p class="text-center">Redirection in <span id="countdownLogin">3</span> seconds</p>
            <?php } else { ?>
                <p class="text-center text-gray-50">
                    <?php echo htmlspecialchars($success_login); ?><br><br>
                    <span class="welcome-text"><?php echo htmlspecialchars($success_welcome); ?></span>
                </p>
                <p class="text-center">Redirection in <span id="countdownIndex">3</span> seconds</p>
            <?php } ?>
            <script>
                sleepRedirect();
            </script>
        <?php
        } else { ?>
            <form class="mt-8 space-y-6" method="post" action="<?php echo BASE_PATH; ?>/login/verification">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-gray-50 bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Sign in
                    </button>
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