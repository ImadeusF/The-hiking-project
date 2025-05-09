<?php 
//view/homepage.view.php
ob_start();
$user_identifiant = isset($_SESSION['user']['sess_user']) ? $_SESSION['user']['sess_user'] : null;
$user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
?>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto max-w-screen-xl py-8">
    <?php
    $counter = 0;
    foreach ($hike_array as $hike) :
        $counter++;
    ?>
        <div class="card bg-white shadow-xl rounded-lg overflow-hidden flex flex-col">
            <div class="overflow-hidden">
                <a href="<?php echo BASE_PATH; ?>/hikes/<?= htmlspecialchars($hike["id"]); ?>">
                    <?php
                    // Get the category of the hike.
                    $category = $hike["category"];
                    // Generate a random number between 1 and 4.
                    $randomNumber = rand(1, 8);
                    // Construct the path to the random image.
                    $imagePath = BASE_PATH . "/public/images/{$category}/{$randomNumber}.jpg";
                    ?>
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($hike['name']); ?>" class="w-full h-64 object-cover shadow-xl transform transition duration-500 hover:scale-110 cursor-pointer">
                </a>
            </div>
            <div class="p-4 flex flex-col justify-between h-1/2">
                <a href="<?php echo BASE_PATH; ?>/hikes/<?= htmlspecialchars($hike["id"]); ?>">
                    <h3 class="font-bold text-xl pb-1"><?= htmlspecialchars($hike["name"]); ?></h3>
                </a>
                <div class="flex justify-between">
                    <p class="bg-green-500 text-white px-2 py-0.5 rounded"><?= htmlspecialchars($hike["distance"]); ?>KM</p>
                    <p class="bg-green-500 text-white px-2 py-0.5 rounded"><?= substr(htmlspecialchars($hike["duration"]), 0, -3); ?> H</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";

require(__DIR__ . '/layout.view.php');
?>