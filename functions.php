<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く
function get_current_link() {
  return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}
function get_current_slug() {
  $currentLink = get_current_link();
  $currentCatSlug = rtrim($currentLink, '/');
  return substr($currentCatSlug, strrpos($currentCatSlug, '/') + 1);
}
function get_icon_url($slug) {
  return esc_attr( get_site_url() . '/wp-content/uploads/icon_' . $slug . '.png');
}