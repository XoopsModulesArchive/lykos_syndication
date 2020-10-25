<?php

// Lykos Syndication Module
// Written by Samuel Wright (http://www.lykoszine.co.uk)
// Some code used adapted from backend.php (https://www.xoops.org/)
// See readme for more info

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //

$filename = '../cache/lykos_reviews.js';      //File to read/write
$timespan = 300;                   //3 hours (if the file is more recent than this, it will not be updated)

include '../../../mainfile.php';

$fd = fopen($filename, 'rb');
if ($fd and (time() - filemtime($filename) < $timespan)) {
    $contents = fread($fd, filesize($filename));

    echo $contents;

    fclose($fd);
} else {
    fclose($fd);

    $sql = 'SELECT review_id, category_id, review_title, review_item FROM ' . $xoopsDB->prefix('lykos_reviews_contents') . ' WHERE review_visible=1 ORDER BY review_time DESC';

    $result = $xoopsDB->query($sql, 10, 0);

    if (!$result) {
        echo "Une erreur s'est produite.";
    } else {
        $fd = fopen($filename, 'w+b');

        $temp = "document.write('<div class=\"rss_title\">";

        $temp .= '<a href="' . XOOPS_URL . '/modules/lykos_reviews">' . $xoopsConfig['sitename'] . " - Reviews</a><br></div>');\n";

        $myts = MyTextSanitizer::getInstance();

        while ($myrow = $xoopsDB->fetchArray($result)) {
            //$myrow = str_replace("(", "-", $myrow);

            //$myrow = str_replace(")", "-", $myrow);

            //$myrow = str_replace("'", "", $myrow);

            $temp .= "document.write('* <span class=\"rss_body\"><A HREF=\"" . XOOPS_URL . '/modules/lykos_reviews/index.php?op=r&cat_it=' . $myrow['category_id'] . '&rev_id=' . $myrow['review_id'] . '">';

            $temp .= htmlspecialchars($myrow['review_title'], ENT_QUOTES | ENT_HTML5) . ' ' . htmlspecialchars($myrow['review_item'], ENT_QUOTES | ENT_HTML5) . "</a></span><br>');\n";

            //$temp .= "document.write('* <span class=\"rss_body\"><A HREF=\"".XOOPS_URL."/modules/mydownloads/index.php?op=r&cat_id=".htmlspecialchars($myrow['category_id'])."&rev_id=".htmlspecialchars($myrow['review_id'])"\">";
         //$temp .= htmlspecialchars($myrow['review_title'])." - "htmlspecialchars($myrow['review_item'])."</a></span><br>');\n";
        }

        $t = date('F j, Y, G:i', time() - $timespan);       //For time diff

        $temp .= "document.write('<div class=\"rss_footer\">Last Updated: $t</div>');";
    }

    echo $temp;

    fwrite($fd, $temp, mb_strlen($temp));

    fclose($fd);
}
