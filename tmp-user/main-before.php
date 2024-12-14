<?php if ( is_home() || is_front_page() ) : ?>
  <?php
    $categories = get_categories();
    $categoryCounts = [];
  ?>
  <section class="add-contents wrap">
    <h2 class="contents-title">コンテンツ</h2>
    <ul class="contents-cat">
      <li class="contents-cat-list">
        <a
          href="https://muyooo.com/free-icon/" 
          class="contents-cat-link">
          <div class="contents-cat-image">
            <img src="https://muyooo.com/wp-content/uploads/icon_import.png" class="contents-cat-icon">
          </div>
          <span class="contents-cat-headline">
            FileMaker用<br>フリーアイコン<br>
          </span>
          <span class="fa fa-chevron-down contents-cat-arrow" aria-hidden="true"></span>
        </a>
      </li>
      <li class="contents-cat-list">
        <a
          href="https://muyooo.com/filemaker/" 
          class="contents-cat-link">
          <div class="contents-cat-image">
            <img src="https://muyooo.com/wp-content/uploads/icon_note.png" class="contents-cat-icon">
          </div>
          <span class="contents-cat-headline">
            FileMaker<br>脱初心者への道<br>
          </span>
          <span class="fa fa-chevron-down contents-cat-arrow" aria-hidden="true"></span>
        </a>
      </li>
      <li class="contents-cat-list">
        <a
          href="https://muyooo.com/portfolio/" 
          class="contents-cat-link">
          <div class="contents-cat-image">
            <img src="https://muyooo.com/wp-content/uploads/icon_fileOutline.png" class="contents-cat-icon">
          </div>
          <span class="contents-cat-headline">
            ポートフォリオ<br>（制作物）<br>
          </span>
          <span class="fa fa-chevron-down contents-cat-arrow" aria-hidden="true"></span>
        </a>
      </li>
    </ul>
    <div class="wp-block-button add-contents-button">
      <a class="wp-block-button__link wp-element-button" href="https://muyooo.com/about/"><img src="https://muyooo.com/wp-content/uploads/icon_muyooo.png" alt="著者アイコン">プロフィール</a>
    </div>
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