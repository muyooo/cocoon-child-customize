<?php if ( is_home() || is_front_page() ) : ?>
  <?php
    $categories = get_categories();
    $categoryCounts = [];
    function console_log($data){
      echo '<script>';
      echo 'console.log('.json_encode($data).')';
      echo '</script>';
    }
  ?>
  <section class="add-contents wrap">
    <h2 class="analyze-cat-title">コンテンツ</h2>
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
      ?>
      <li class="analyze-cat-list analyze-cat-list-<?= esc_attr( $categoryDetail->slug ) ?>">
        <a
          href="<?= get_page_url( $categoryDetail->slug ); ?>" 
          class="
            <?= get_analyze_cat_ratio_class(); ?> 
            <?= get_analyze_cat_ratio_unique_class( $categoryDetail->slug ); ?> 
            <?= get_analyze_move_stop_class(); ?>">
          <div class="analyze-cat-image">
            <img src="<?= get_icon_url( $categoryDetail->slug ); ?>" class="analyze-cat-icon">
          </div>
          <span class="analyze-cat-headline analyze-cat-headline--<?= esc_attr( $categoryDetail->slug );?>">
            <?= esc_attr( $categoryDetail->name ); ?><br>
          </span>
          <p class="analyze-cat-desc">
            <?= get_category_description($categoryDetail->term_id); ?>
          </p>
          <span class="fa fa-chevron-down analyze-cat-arrow" aria-hidden="true"></span>
        </a>
      </li>
    <?php endforeach; ?>
    </ul>
    <style type="text/css">
      <?php
        // カテゴリー比率の計算と設定
        $categoryArticleCountSum = array_sum($categoryCounts['count']);
        $categoryRatioValue = 100 / $categoryArticleCountSum;
        $i = 0;
        for($i; $i < count($categoryCounts['slug']); $i++) {
          $targetRatio = $categoryRatioValue * $categoryCounts['count'][$i];
          $targetMoveClass = '.' . get_analyze_cat_ratio_class() . '--' . $categoryCounts['slug'][$i];
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
          echo $categoryHeadline . '::after{content:"' . round($targetRatio, 1) . '%"}';
        }
      ?>
      .analyze-cat-stop::before{transform: rotate(0deg);}
    </style>
  </section>
  <h2 class="new-article-headline">新着記事</h2>
<?php elseif(is_category()) : ?>
  <div class="search-cat-image">
    <img src="<?= get_icon_url( get_current_slug() ); ?>" class="search-cat-icon">
  </div>
  <style type="text/css">
    @media screen and (max-width: 480px){
      .cat-popular-post--<?= get_current_slug(); ?>,
      .cat-recommend-post--<?= get_current_slug(); ?> {
        width: 100%;
        display: block;
      }
    }
  </style>
<?php endif; ?>