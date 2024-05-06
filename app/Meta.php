<?php

namespace App;

class Meta
{
    protected static $meta = [];

    protected static $url = '';

    public static function addMeta($name, $content, $url = '')
    {
        static::$meta[$name] = $content;
        static::$url = $url;
    }

    public static function render()
    {
        $html = '';
        if (static::$meta && isset(static::$meta['meta_data'])) {
            $html .= static::$meta['meta_data'].PHP_EOL;
        } else {
            $html .= '<meta property="og:site_name" content="'.config('app.name').'" />'.PHP_EOL;
            $html .= '<meta name="twitter:site" content="'.config('app.name').'" />'.PHP_EOL;
            $html .= '<meta property="og:locale" content="en_US" />'.PHP_EOL;
            $html .= '<meta property="og:type" content="website" />'.PHP_EOL;

            foreach (static::$meta as $name => $content) {
                switch ($name) {
                    case 'card':
                        $html .= '<meta property="og:image" content="'.$content.'"/>'.PHP_EOL;
                        $html .= '<meta name="twitter:image" content="'.$content.'"/>'.PHP_EOL;
                        break;
                    case 'title':
                        $html .= '<meta name="title" content="'.$content.'"/>'.PHP_EOL;
                        $html .= '<meta name="twitter:title" content="'.$content.'"/>'.PHP_EOL;
                        $html .= '<meta property="og:title" content="'.$content.'"/>'.PHP_EOL;
                        break;
                    case 'description':
                        $html .= '<meta name="description" content="'.$content.'"/>'.PHP_EOL;
                        $html .= '<meta name="twitter:description" content="'.$content.'"/>'.PHP_EOL;
                        $html .= '<meta property="og:description" content="'.$content.'"/>'.PHP_EOL;
                        break;
                    case 'canonical_url':
                        $canonical = $content ? $content : static::$url;
                        $html .= '<meta name="canonical" content="'.$canonical.'"/>'.PHP_EOL;
                        break;
                    case 'twitter_handle':
                        $html .= '<meta name="twitter:creator" content="'.$content.'"/>'.PHP_EOL;
                        break;
                    case 'schema':
                        $html .= $content.PHP_EOL;
                        break;
                    case 'meta_data':
                        break;
                    default:
                        $html .= '<meta name="'.$name.'" content="'.$content.'"/>'.PHP_EOL;
                }
            }
        }

        return $html;
    }
}
