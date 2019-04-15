<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<style>
    .message-error-user{
        color: red;
    }
</style>
<div class="message-error-user" onclick="this.classList.add('hidden')"><?= $message ?></div>