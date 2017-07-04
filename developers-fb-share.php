<?php
/*
Plugin Name: Developers FB share
Description: Developers FB share button for WordPress
Version: 1.0.0
Author: botiq
*/

add_action('body_start', 'developers_fb_share_js');
function developers_fb_share_js()
{
    $language = 'sk_SK';

    echo <<<HTML
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/{$language}/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
HTML;

}

function developers_fb_share_button($url, $layout = 'button_count', $size = 'small')
{
    $urlenc = urlencode($url);

    $data = <<<HTML
<div class="fb-share-button" data-href="{$url}" data-layout="{$layout}" data-size="{$size}" data-mobile-iframe="true">
<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={$urlenc}&amp;src=sdkpreparse">Zdieľať</a>
</div>
HTML;

    return $data;
}

add_filter('the_content', 'developers_fb_share');
function developers_fb_share($content)
{
    if(is_single())
    {
        $content .= developers_fb_share_button(get_the_permalink());
    }

    return $content;
}

add_shortcode('devs_fb_share', 'developers_fb_share_shortcode');
function developers_fb_share_shortcode($atts)
{
    return developers_fb_share_button(get_the_permalink());
}