<h2>Bienvenido
    <?= $this->Html->link(__($current_user['name']), ['action' => 'view', $current_user['id']]) . ' ' . $current_user['role'] ?>
</h2>