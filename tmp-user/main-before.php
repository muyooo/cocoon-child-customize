<?php
$categories = get_categories();
$categoryCounts = [];
$categoryClass = 'analyze-cat-ratio';
$moveStopClass = 'analyze-cat-stop';
?>
<section class="add-contents wrap">
  <h2 class="analyze-cat-title">コンテンツ一覧</h2>
  <ul class="analyze-cat analyze-cat--hide">
  <?php foreach( $categories as $category ) : ?>
    <?php
      // カテゴリー情報の取得とリンクの作成
      $categoryDetail = get_category($category->term_id);
      $categoryCounts = array_merge_recursive(
        $categoryCounts,
        [
          'count' => $categoryDetail->count,
          'slug' => $categoryDetail->slug
        ]
      );
      $categoryURL = get_site_url() . '/category/' . $categoryDetail->slug . '/';
      $categoryUniqueClass = $categoryClass . '--' . $categoryDetail->slug;
    ?>
    <li class="analyze-cat-list">
      <a
        href="<?= esc_attr( $categoryURL ); ?>" 
        class=" 
          <?= esc_attr( $categoryClass . ' ' ); ?>
          <?= esc_attr( $categoryUniqueClass . ' ' ); ?>
          <?= esc_attr( $moveStopClass ); ?>
        "><?= esc_attr( $categoryDetail->name ); ?></a>
    </li>
    <?php endforeach; ?>

    <style type="text/css">
      <?php
        // カテゴリー比率の計算と設定
        $categoryArticleCountSum = array_sum($categoryCounts['count']);
        $categoryRatioValue = round(100 / $categoryArticleCountSum, 1);
        $i = 0;
        for($i; $i < count($categoryCounts['slug']); $i++) {
          $targetRatio = $categoryRatioValue * $categoryCounts['count'][$i];
          $targetMoveClassBefore = '.' . $categoryClass . '--' . $categoryCounts['slug'][$i] . '::before';
          $targetDeg = 0;
          if ($targetRatio <= 50) {
            $targetDeg = 360 * $targetRatio / 100;
            echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);}'; 
          } else {
            $targetDeg = 360 * ($targetRatio - 50) / 100;
            echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);background-color: #26499d;}'; 
          }
          $targetClassAfter = '.' . $categoryClass . '--' . $categoryCounts['slug'][$i] . '::after';
          echo $targetClassAfter . '{content:"' . $targetRatio .'%";}';
        }
      ?>
      .analyze-cat-stop::before{transform: rotate(0deg);}
    </style>
  </ul>
</section>