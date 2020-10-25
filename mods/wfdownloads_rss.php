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

$filename = '../cache/wfdownloads.rss';      //File to read/write
$timespan = 30;                       //3 hours (if the file is more recent than this, it will not be updated)

include '../../../mainfile.php';

$fd = fopen($filename, 'rb');
if ($fd and (time() - filemtime($filename) < $timespan)) {
    $contents = fread($fd, filesize($filename));

    echo $contents;

    fclose($fd);
} else {
    fclose($fd);

    $sql = 'SELECT lid, title FROM ' . $xoopsDB->prefix('wfdownloads_downloads') . ' WHERE status=1 ORDER BY date DESC';

    $result = $xoopsDB->query($sql, 10, 0);

    if (!$result) {
        echo "Une erreur s'est produite.";
    } else {
        header('Content-Type: text/plain');

        $fd = fopen($filename, 'w+b');

        $temp = '<?xml version="1.0" encoding="' . _CHARSET . "\"?>\n";

        $temp .= "<rss version=\"0.92\">\n";

        $temp .= "  <channel>\n";

        $temp .= '       <title>' . $xoopsConfig['sitename'] . " - WF Téléchargements</title>\n";

        $temp .= '       <link>' . XOOPS_URL . "/wfdownloads</link>\n";

        $temp .= '       <description>' . $xoopsConfig['slogan'] . "</description>\n";

        $temp .= "    <image>\n";

        $temp .= '       <title>' . $xoopsConfig['sitename'] . "</title>\n";

        $temp .= '       <url>' . XOOPS_URL . "/images/logo.gif</url>\n";

        $temp .= '       <link>' . XOOPS_URL . "/</link>\n";

        $temp .= '       <description>' . $xoopsConfig['slogan'] . "</description>\n";

        $temp .= "       <width>88</width>\n";

        $temp .= "       <height>31</height>\n";

        $temp .= "    </image>\n";

        $myts = MyTextSanitizer::getInstance();

        while ($myrow = $xoopsDB->fetchArray($result)) {
            $temp .= "    <item>\n";

            $temp .= '       <title>' . htmlspecialchars($myrow['title'], ENT_QUOTES | ENT_HTML5) . "</title>\n";

            $temp .= '       <link>' . XOOPS_URL . '/modules/wfdownloads/singlefile.php?cid=' . htmlspecialchars($myrow['lid'], ENT_QUOTES | ENT_HTML5) . '&amp;lid=' . htmlspecialchars($myrow['lid'], ENT_QUOTES | ENT_HTML5) . "</link>\n";

            $temp .= "    </item>\n";
        }

        $temp .= "  </channel>\n";

        $temp .= '</rss>';
    }

    echo $temp;

    fwrite($fd, $temp, mb_strlen($temp));

    fclose($fd);
}
