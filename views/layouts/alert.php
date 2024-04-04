<?php

use src\core\Application;

  $message = Application::$app->getMessage();
?>
<?php if($message):?>
<div class="alert alert-<?php echo $message['type']; ?> alert-dismissible fade show" role="alert">
      <?php echo $message['message']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif;?>