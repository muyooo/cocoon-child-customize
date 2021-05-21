<?php if(is_category()) : ?>
<link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/category.css">
<?php endif; ?>
<?php if (!is_user_administrator()) :
//管理者を除外してカウントする場合は以下に挿入 ?>

<?php endif; ?>
<?php //全ての訪問者をカウントする場合は以下に挿入 ?>
