<?php //子テーマ用関数
if ( !defined( 'ABSPATH' ) ) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

//以下に子テーマ用の関数を書く
function get_current_link()
{
  return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}
function get_current_slug()
{
  $currentLink = get_current_link();
  $currentCatSlug = rtrim($currentLink, '/');
  return substr($currentCatSlug, strrpos($currentCatSlug, '/') + 1);
}
function get_icon_url($slug)
{
  return esc_attr( get_site_url() . '/wp-content/uploads/icon_' . $slug . '.png');
}
function get_category_url($slug)
{
  return esc_attr( get_site_url() . '/category/' . $slug . '/' );
}
function get_analyze_move_stop_class()
{
  $moveStopClass = 'analyze-cat-stop';
  return esc_attr( $moveStopClass );
}
function get_analyze_cat_ratio_class()
{
  return esc_attr( 'analyze-cat-ratio' );
}
function get_analyze_cat_ratio_unique_class($slug)
{
  return rtrim( get_analyze_cat_ratio_class() ) . '--' . $slug;
}
function floorX (float $val, ?int $x = null): float
{
  if (null == $x) return floor($val);
  if ($x < 0) throw new \RuntimeException('Invalid x');
  $tmp = $val - 0.5 / (10 ** $x);
  return round($tmp, $x, $tmp > 0 ? PHP_ROUND_HALF_UP : PHP_ROUND_HALF_DOWN);
}