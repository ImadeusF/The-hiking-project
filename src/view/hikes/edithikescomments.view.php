<?php ob_start(); ?>
<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <div class="max-w-3xl mx-auto">
        <div class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
            <div class="bg-white p-5 sm:p-10">
                <?php if (is_array($hikesComments)) { ?>
                    <h1 class="text-gray-900 font-bold text-3xl mb-2">Edit your comment</h1>
                    <!-- Comment form -->
                    <form action="<?php echo htmlspecialchars(BASE_PATH); ?>/hikes/editcom/<?php echo htmlspecialchars($hikesComments['id_hikes']); ?>/<?php echo htmlspecialchars($hikesComments['id']); ?>" method="post">
                        <textarea style="border:1px solid black" rows="5" cols="50" name="hikesComment" id="hikesComment" class="w-full p-2 mb-4" required><?php echo htmlspecialchars($hikesComments['hikes_comments']); ?></textarea>
                        <input type="submit" value="Edit your comment" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                    </form>
                <?php } else { ?>
                    <p class="text-base leading-8 my-5">It seems the product number you entered doesn't exist.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";
require(__DIR__ . '/../layout.view.php');
?>