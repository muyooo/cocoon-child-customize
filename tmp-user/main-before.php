<?php
echo '<section class="add-contents wrap">
  <h2 class="analyze-cat-title">コンテンツ一覧</h2>
  <ul class="analyze-cat analyze-cat--hide">';
    // カテゴリーの取得
    $categories = get_categories();
    $categoryCounts = [];
    foreach( $categories as $category ) {
      $categoryDetail = get_category($category->term_id);
      $categoryCounts = array_merge_recursive(
        $categoryCounts,
        [
          'count' => $categoryDetail->count,
          'slug' => $categoryDetail->slug
        ]
      );
      $categoryURL = get_site_url() . '/category/' . $categoryDetail->slug . '/';
      $categoryClass = 'analyze-cat-ratio';
      $categoryUniqueClass = $categoryClass . '--' . $categoryDetail->slug;
      $moveStopClass = 'analyze-cat-stop';
      echo '
        <li class="analyze-cat-list">
          <a
            href="' . $categoryURL . '" 
            class="' . 
              $categoryClass . ' ' . 
              $categoryUniqueClass . ' ' . 
              $moveStopClass .'">' . 
            $categoryDetail->name . 
          '</a>
        </li>
      ';
    }
    // カテゴリー比率の計算
    $categoryArticleCountSum = array_sum($categoryCounts['count']);
    $categoryRatioValue = round(100 / $categoryArticleCountSum, 1);
    echo '<style type="text/css">';
      $i = 0;
      for($i; $i < count($categoryCounts['slug']); $i++) {
        // 比率の付与
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
    echo '.analyze-cat-stop::before {transform: rotate(0deg);}</style>
  </ul>
</section>';