<?php ob_start(); ?>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto max-w-screen-xl py-8">
  <?php
  if (!isset($hikes_array)) {
    if (empty($hike_array)) { ?>
      <div style="background-color: rgba(236, 239, 241, 0.5); padding: 2.5rem; border-radius: 0.375rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); text-align: center; margin-bottom: 1rem;">
        <p style="font-size: 2rem; margin-bottom: 1rem;">NO HIKES FOUND</p>
        <a href="/" style="background-color: #3b82f6; color: #fff; padding: 0.5rem 1rem; border-radius: 0.25rem; font-weight: 700; text-decoration: none;">
          Go Back
        </a>
      </div>
    <?php }
    foreach ($hike_array as $hike) : ?>
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
  <?php endforeach;
  } else {
    echo "No hikes found";
  } ?>

</div>


<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";

require(__DIR__ . '/layout.view.php');
?>