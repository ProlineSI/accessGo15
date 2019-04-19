<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<style>
    .message-error-user{
        color: red;
        cursor: pointer;
    }
</style>
<div class="message-error-user" onclick="this.classList.add('hidden')"><?= $message ?></div>
<script>
    $('.message-error-user').delay(4000).slideUp(500);
</script>