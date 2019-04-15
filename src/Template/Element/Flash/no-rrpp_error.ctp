<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<style>
    .error{
        background-color:red;
        color: white;
        font-size:110%;
        margin-top:2%;
        border-radius:10px;
        padding: 0.3% 0% 0.3% 1%;
    }
</style>
<div class="message-error-user error" onclick="this.classList.add('hidden')">
    <?= $message ?>
</div>
<script>
    $('.error').delay(5000).fadeOut();
</script>