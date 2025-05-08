<?php ob_start(); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-xl">
    <form action="<?php echo htmlspecialchars(BASE_PATH); ?>/user/hikesmngt/edit/save/<?php echo htmlspecialchars($hikes[0]["id"]); ?>/<?php echo htmlspecialchars($hikes[0]["created_by"]); ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <p class="block text-gray-700 text-2xl font-bold mb-2">Edit a Hike:</p>
        <p class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="name">Name:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" id="name" value="<?php echo htmlspecialchars($hikes[0]['name'] ?? ''); ?>">
        </p>
        <p class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="distance">Distance:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="distance" id="distance" step='0.5' value="<?php echo htmlspecialchars($hikes[0]['distance'] ?? ''); ?>">
        </p>
        <p class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="duration">Duration:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="time" name="duration" id="duration" value="<?php echo htmlspecialchars($hikes[0]['duration'] ?? ''); ?>">
        </p>
        <p class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="elevation_gain">Elevation gain:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" step='200' name="elevation_gain" id="elevation_gain" value="<?php echo htmlspecialchars($hikes[0]['elevation_gain'] ?? ''); ?>">
        </p>
        <p class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="description">Description:</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="10" name="description" id="description"><?php echo htmlspecialchars($hikes[0]['description'] ?? ''); ?></textarea>
        </p>
        <p class="mb-4">
            <label class="block text-gray-700 text-base font-bold mb-2" for="id_tags">Category:</label>
            <select name="id_tags" id="id_tags" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php
                foreach ($tagList as $tag) {
                    $selected = ($tag['id'] == $hikes[0]['id_tags']) ? "selected" : "";
                    echo "<option value='{$tag['id']}' $selected>{$tag['name']}</option>";
                }
                ?>
            </select>
        </p>
        <input class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Save modification">
    </form>
</div>

<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";
require(__DIR__ . '/../layout.view.php');
?>