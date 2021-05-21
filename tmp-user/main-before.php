<?php if ( is_home() || is_front_page() ) : ?>
  <?php
    $categories = get_categories();
    $categoryCounts = [];
    $categoryClass = 'analyze-cat-ratio';
    $moveStopClass = 'analyze-cat-stop';
  ?>
  <section class="add-contents wrap">
    <h2 class="analyze-cat-title">コンテンツ</h2>
    <ul class="analyze-cat analyze-cat--hide">
    <?php foreach( $categories as $category ) : ?>
      <?php if ($category->parent === 0): ?>
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
              <?= esc_attr( $moveStopClass ); ?>">
            <div class="analyze-cat-image">
              <img src="<?= esc_attr( get_site_url() . '/wp-content/uploads/icon_' . $categoryDetail->slug . '.png'); ?>" class="analyze-cat-icon">
            </div>
            <span class="analyze-cat-headline analyze-cat-headline--<?= esc_attr( $categoryDetail->slug );?>">
              <?= esc_attr( $categoryDetail->name ); ?><br>
            </span>
            <span class="fa fa-chevron-down analyze-cat-arrow" aria-hidden="true"></span>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>

      <style type="text/css">
        <?php
          // カテゴリー比率の計算と設定
          $categoryArticleCountSum = array_sum($categoryCounts['count']);
          $categoryRatioValue = round(100 / $categoryArticleCountSum, 1);
          $i = 0;
          for($i; $i < count($categoryCounts['slug']); $i++) {
            $targetRatio = $categoryRatioValue * $categoryCounts['count'][$i];
            $targetMoveClass = '.' . $categoryClass . '--' . $categoryCounts['slug'][$i];
            $targetMoveClassBefore = $targetMoveClass . '::before';
            $targetDeg = 0;
            if ($targetRatio <= 50) {
              $targetDeg = 360 * $targetRatio / 100;
              echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);}'; 
            } else {
              $targetDeg = 360 * ($targetRatio - 50) / 100;
              echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);background-color: #f8b500;}';
              echo $targetMoveClass . ':hover::before {background-color: #f8b500;transition: 0s;}';
            }
            $categoryHeadline = '.analyze-cat-headline--' . $categoryCounts['slug'][$i];
            echo $categoryHeadline . '::after{content:"' . $targetRatio . '%"}';
          }
        ?>
        .analyze-cat-stop::before{transform: rotate(0deg);}
      </style>
    </ul>
  </section>
<?php elseif(is_category()) : ?>
  <div class="search-cat-image">
    <img src="<?= get_icon_url( get_current_slug() ); ?>" class="search-cat-icon">
  </div>
<?php endif; ?>