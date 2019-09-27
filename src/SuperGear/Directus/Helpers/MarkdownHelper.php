<?php

namespace SuperGear\Directus\Helpers;

use Parsedown;

/**
 * Helper to extend Parsedown
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/directus GitHub Repository
 */
class MarkdownHelper extends Parsedown
{
    /**
     *
     * @var string
     */
    const EXTERNAL_LINK = "/^(http|https):\/\//";
    const INNER_BRACKETS = "/\){(.*?)\}/";
    const TARGET_BLANK = "_blank";
    const DIVIDER_METHOD = ':';
    const DIVIDER_SIZES = 'x';

    /**
     * extend default function, if a link has http|https in url,
     * then handle this link as external and set target to _blank
     *
     * @param  array $excerpt
     * @return array
     */
    protected function inlineLink($excerpt)
    {
        $result = parent::inlineLink($excerpt);

        if (is_array($result)) {
            if (isset($result['element']['attributes'])) {
                if (preg_match(self::EXTERNAL_LINK, $result['element']['attributes']['href'])) {
                    $result['element']['attributes']['target'] = self::TARGET_BLANK;
                }
            }

            return $result;
        }
    }
}
