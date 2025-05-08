<?php
$user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
ob_start(); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-xl">
  <?php if ($action == "editprofil") { ?>
    <form action="<?php echo htmlspecialchars(BASE_PATH); ?>/user/saveprofil/<?php echo htmlspecialchars($user_infos[0]["id"]); ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="firstname">First Name</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" type="text" placeholder="First Name" name="firstname" value="<?php echo htmlspecialchars($user_infos[0]['firstname'] ?? ''); ?>">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="lastname">Last Name</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" placeholder="Last Name" name="lastname" value="<?php echo htmlspecialchars($user_infos[0]['lastname'] ?? ''); ?>">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="nickname">Nickname</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nickname" type="text" placeholder="Nickname" name="nickname" value="<?php echo htmlspecialchars($user_infos[0]['nickname'] ?? ''); ?>">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="email">Email</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Email" name="email" value="<?php echo htmlspecialchars($user_infos[0]['email'] ?? ''); ?>">
      </div>
      <div class="mb-4">
          <label class="block text-gray-700 text-2xl font-bold mb-2" for="admin_user">Admin User:</label>
          <input type=radio name="user_admin" value="0" <?php if ($user_infos[0]["user_admin"] == "0") echo "checked"; ?>> No
          <input type=radio name="user_admin" value="1" <?php if ($user_infos[0]["user_admin"] == "1") echo "checked"; ?>> Yes
        </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Save Modification
        </button>
      </div>
    </form>
  <?php } elseif (($action == "saveprofil") || isset($action)) { ?>
    <?php if (isset($successMessage)) : ?>
      <p class="block text-gray-600 text-2xl font-bold mb-2 text-center"><?php echo htmlspecialchars($successMessage); ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars(BASE_PATH); ?>/user/showprofil/<?php echo htmlspecialchars($user_infos[0]["id"]); ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-xl mx-auto">
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="firstname">First Name</label>
        <p><?php echo htmlspecialchars($user_infos[0]["firstname"] ?? ''); ?></p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="lastname">Last Name</label>
        <p><?php echo htmlspecialchars($user_infos[0]["lastname"] ?? ''); ?></p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="nickname">Nickname</label>
        <p><?php echo htmlspecialchars($user_infos[0]["nickname"] ?? ''); ?></p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-2xl font-bold mb-2" for="email">Email</label>
        <p><?php echo htmlspecialchars($user_infos[0]["email"] ?? ''); ?></p>
      </div>
      <?php if (($user_id == $user_infos[0]["id"]) || ($user_admin == "1")) { ?>
        <div class="mb-4">
          <label class="block text-gray-700 text-2xl font-bold mb-2" for="user_admin">Admin User:</label>
          <p><?php if ($user_infos[0]["user_admin"] == 0) { ?>No<?php } else { ?>Yes<?php } ?></p>
          
        </div>
        <div class="flex items-center">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Edit Your Profile
          </button>
    </form>
    <form action="<?php echo htmlspecialchars(BASE_PATH); ?>/user/deleteprofil/<?php echo htmlspecialchars($user_infos[0]['id']); ?>" method="post" class="ml-5 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onsubmit="return confirm('Are you sure you want to delete your profile?');">
      <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete Your Profile</button>
    </form>
  <?php } ?>
</div>
<?php } ?>
</div>
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-xl mx-auto">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-xl">
    <p class="block text-green-400 text-2xl font-bold mb-2 text-center">Other User(s) List :</p>
    <?php
    foreach ($all_Userinfos as $allUserinfo) {
      if ($user_admin == "1" && $user_id != $allUserinfo["id"]) { ?>
        <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-4">
          <p class="block text-gray-700 text-2xl font-bold mb-2"><?php echo $allUserinfo['nickname']; ?></p>
          <div class="flex">
            <a href='<?php echo htmlspecialchars(BASE_PATH); ?>/user/showprofil/<?php echo htmlspecialchars($allUserinfo['id']); ?>' class="mx-2">
              <img src='<?php echo htmlspecialchars(BASE_PATH); ?>/public/images/loupe.svg' alt='loupeicon' style="width: 24px; height: 24px;" />
            </a>
          </div>
        </div>
    <?php }
    }
    ?>
  </div>
</div>
<?php
$contentBody = ob_get_clean();
$contentHeader = "";
$contentFooter = "";
require(__DIR__ . '/../layout.view.php');
?>