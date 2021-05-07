<?php
echo '<section class="add-contents wrap">
  <ul class="analyze-cat">';
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
      $categoryClass = 'analyze-cat-' . $categoryDetail->slug . '-ratio';
      $moveStopClass = 'analyze-cat-stop';
      echo '
        <li class="analyze-cat-list">
          <a href="' . $categoryURL . '" class="' . $categoryClass . ' ' . $moveStopClass .'">' . $categoryDetail->name . '</a>
        </li>
      ';
    }
    // カテゴリー比率の計算
    $categoryArticleCountSum = array_sum($categoryCounts['count']);
    $categoryRatioValue = round(100 / $categoryArticleCountSum, 1);
    echo '<style>';
      $i = 0;
      for($i; $i < count($categoryCounts['slug']); $i++) {
        // 比率の付与
        $targetRatio = $categoryRatioValue * $categoryCounts['count'][$i];
        $targetMoveClassBefore = '.analyze-cat-' . $categoryCounts['slug'][$i] . '-ratio::before';
        $targetDeg = 0;
        if ($targetRatio <= 50) {
          $targetDeg = 360 * $targetRatio / 100;
          echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);transition: .8s;}'; 
        } else {
          $targetDeg = 360 * ($targetRatio - 50) / 100;
          echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);background-color: #7a99cf;transition: .8s;}'; 
        }
        $targetClassAfter = '.analyze-cat-' . $categoryCounts['slug'][$i] . '-ratio::after';
        echo $targetClassAfter . '{content:"' . $targetRatio .'%";}';
      }
    echo ".analyze-cat-stop::before {transform: rotate(0deg);}</style>
    <script type='text/javascript'>
      'use strict';
      setTimeout(() => {
        const analyzeData = document.querySelectorAll('.analyze-cat-list a');
        console.log(analyzeData);
        let i = 0;
        for(i; i < analyzeData.length; i++) {
          analyzeData[i].classList.remove('analyze-cat-stop');
        }
      }, 200);
    </script>
  </ul>
</section>";