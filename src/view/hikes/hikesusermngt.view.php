<?php
ob_start();
$user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-xl">
    <?php if (isset($_GET['message'])) : ?>
        <p class="block text-gray-600 text-2xl font-bold mb-2 text-center"><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars(BASE_PATH); ?>/user/hikesmngt/add/<?php echo htmlspecialchars($user_id); ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Add a Hike">
        <p class="block text-green-400 text-2xl font-bold mb-2 text-center">Your Hikes List:</p>
        <?php
        $hasUserHikes = false;
        foreach ($hikes as $hikelist) :
            if ($user_id == $hikelist['created_by']) {
                $hasUserHikes = true; // The user has at least one hike
        ?>
                <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-4">
                    <p class="block text-gray-700 text-2xl font-bold mb-2"><?php echo $hikelist['name']; ?></p>
                    <div class="flex">
                        <a href='<?php echo htmlspecialchars(BASE_PATH); ?>/user/hikesmngt/edit/<?php echo htmlspecialchars($hikelist['id']); ?>' class="mx-2">
                            <img src='<?php echo htmlspecialchars(BASE_PATH); ?>/public/images/edit.svg' alt='editicon' style="width: 24px; height: 24px;" />
                        </a>
                        <a href='<?php echo htmlspecialchars(BASE_PATH); ?>/user/hikesmngt/delete/<?php echo htmlspecialchars($hikelist['id']); ?>' class="mx-2">
                            <img src='<?php echo htmlspecialchars(BASE_PATH); ?>/public/images/delete.svg' alt='deleteicon' style="width: 24px; height: 24px;" />
                        </a>
                    </div>
                </div>
            <?php }
        endforeach;

        if (!$hasUserHikes && $user_admin == "1") { // If user has no hike and is an administrator 
            ?>
            <p class="block text-gray-400 text-2xl font-bold mb-2 text-center">No Hikes found</p>
        <?php } elseif ($user_admin == "1") { //if the user is an admin 
        ?>
            <p class="block text-green-400 text-2xl font-bold mb-2 text-center">Other Hike(s) List :</p>
            <?php
            foreach ($hikes as $hikelist) :
                //if the user is an admin, he will be able to edit and delete all hikes (other than his own hikes)
                if ($user_id != $hikelist['created_by']) { ?>
                    <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-4">
                        <p class="block text-gray-700 text-2xl font-bold mb-2"><?php echo $hikelist['name']; ?></p>
                        <div class="flex">
                            <a href='<?php echo htmlspecialchars(BASE_PATH); ?>/user/hikesmngt/edit/<?php echo htmlspecialchars($hikelist['id']); ?>' class="mx-2">
                                <img src='<?php echo htmlspecialchars(BASE_PATH); ?>/public/images/edit.svg' alt='editicon' style="width: 24px; height: 24px;" />
                            </a>
                            <a href='<?php echo htmlspecialchars(BASE_PATH); ?>/user/hikesmngt/delete/<?php echo htmlspecialchars($hikelist['id']); ?>' class="mx-2">
                                <img src='<?php echo htmlspecialchars(BASE_PATH); ?>/public/images/delete.svg' alt='deleteicon' style="width: 24px; height: 24px;" />
                            </a>
                        </div>
                    </div>
        <?php }
            endforeach;
        } ?>
    </form>
</div>

<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";
require(__DIR__ . '/../layout.view.php');
?>