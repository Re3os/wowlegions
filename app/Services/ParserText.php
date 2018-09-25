<?php

namespace App\Services;

class ParserText {

    public function bb_parse($string) {
        $tags = 'b|i|ul|li|code|strong|size|color|center|quote|url|img|item';
        while (preg_match_all('`\[('.$tags.')=?(.*?)\](.+?)\[/\1\]`', $string, $matches)) foreach ($matches[0] as $key => $match) {
            list($tag, $param, $innertext) = array($matches[1][$key], $matches[2][$key], $matches[3][$key]);
            switch ($tag) {
                case 'b': $replacement = "<b>$innertext</b>"; break;
                case 'i': $replacement = "<i>$innertext</i>"; break;
                case 'ul': $replacement = "<ul>$innertext</ul>"; break;
                case 'li': $replacement = "<li>$innertext</li>"; break;
                case 'code': $replacement = "<div class=\"qxbb-code\">$innertext</div>"; break;
                case 'strong': $replacement = "<strong>$innertext</strong>"; break;
                case 'item': $replacement = '<a href="' . ($param? $param : $innertext) . "\">$innertext</a>"; break;
                case 'size': $replacement = "<span style=\"font-size: $param;\">$innertext</span>"; break;
                case 'color': $replacement = "<span style=\"color: $param;\">$innertext</span>"; break;
                case 'center': $replacement = "<div class=\"centered\">$innertext</div>"; break;
                case 'quote': $replacement = "<blockquote data-quote=\"$param\" class=\"quote-public\">$innertext</blockquote>" . $param? "<blockquote data-quote=\"$param\" class=\"quote-public\">$innertext</blockquote><br>" : ''; break;
                case 'url': $replacement = '<a href="' . ($param? $param : $innertext) . "\">$innertext</a>"; break;
                case 'img':
                    list($width, $height) = preg_split('`[Xx]`', $param);
                    $replacement = "<img src=\"$innertext\" " . (is_numeric($width)? "width=\"$width\" " : '') . (is_numeric($height)? "height=\"$height\" " : '') . '/>';
                break;
                case 'video':
                    $videourl = parse_url($innertext);
                    parse_str($videourl['query'], $videoquery);
                    if (strpos($videourl['host'], 'youtube.com') !== FALSE) $replacement = '<embed src="http://www.youtube.com/v/' . $videoquery['v'] . '" type="application/x-shockwave-flash" width="425" height="344"></embed>';
                    if (strpos($videourl['host'], 'google.com') !== FALSE) $replacement = '<embed src="http://video.google.com/googleplayer.swf?docid=' . $videoquery['docid'] . '" width="400" height="326" type="application/x-shockwave-flash"></embed>';
                break;
            }
            $string = str_replace($match, $replacement, $string);
        }
        return $string;
    }
}