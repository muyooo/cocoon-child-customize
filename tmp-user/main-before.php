<?php if ( is_home() || is_front_page() ) : ?>
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

          <?php
            // 最近のカテゴリー記事の取得と表示
            $categoryRecentPosts = get_posts( array(
              'category_name' => $categoryDetail->slug,
              'posts_per_page' => 3 
            ));
            if ($categoryRecentPosts) :
          ?>
          <ul class="cat-recent-posts">
            <?php foreach ( $categoryRecentPosts as $post ) : ?>
              <?php setup_postdata( $post );?>
              <li class="cat-recent-post" title="<?php the_title(); ?>">
                <span class="cat-recent-post-date"><?php the_time( 'Y.n.j' ); ?></span><br>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
            <?php endforeach ?>
          </ul>
          <a href="<?= esc_attr( $categoryURL ); ?>" class="analyze-cat-link">
            <span class="fa fa-chevron-down" aria-hidden="true"></span>
          </a>
          <?php endif; ?>
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
            $targetMoveClass = '.' . $categoryClass . '--' . $categoryCounts['slug'][$i];
            $targetMoveClassBefore = $targetMoveClass . '::before';
            $targetDeg = 0;
            if ($targetRatio <= 50) {
              $targetDeg = 360 * $targetRatio / 100;
              echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);}'; 
            } else {
              $targetDeg = 360 * ($targetRatio - 50) / 100;
              echo $targetMoveClassBefore . '{transform: rotate(' . $targetDeg . 'deg);background-color: #26499d;}';
              echo $targetMoveClass . ':hover::before {background-color: #fcc800;transition: 0s;}';
            }
            $targetClassAfter = '.' . $categoryClass . '--' . $categoryCounts['slug'][$i] . '::after';
            echo $targetClassAfter . '{content:"' . $targetRatio .'%";}';
          }
        ?>
        .analyze-cat-stop::before{transform: rotate(0deg);}
      </style>
    </ul>
  </section>
<?php endif; ?>