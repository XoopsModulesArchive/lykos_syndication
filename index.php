<?php

// Lykos Syndication Module
// Written by Samuel Wright (http://www.lykoszine.co.uk)
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

include 'header.php';

if ('lykos_syndication' == $xoopsConfig['startpage']) {
    $xoopsOption['show_rblock'] = 1;

    require XOOPS_ROOT_PATH . '/header.php';

    make_cblock();
} else {
    $xoopsOption['show_rblock'] = 0;

    require XOOPS_ROOT_PATH . '/header.php';
}

$myts = MyTextSanitizer::getInstance();

OpenTable();

$sql = 'SELECT * FROM ' . $xoopsDB->prefix('modules') . " WHERE isactive='1' ORDER BY weight ASC";
$result = $xoopsDB->query($sql);

echo "<h4 style='text-align:left;'>" . _SYND . '</h4>';

echo "La syndication permet de suivre les nouveautés d'un site en utilisant un simple lecteur de flux RSS comme FeedReader par exemple.<br>
Il suffit de choisir ce que l'on veut suivre en copiant les liens ci-dessous vers l'application.";

while ($myrow = $xoopsDB->fetchArray($result)) {
    if ('news' == $myrow['dirname']) {
        1 == $actmods['news'];

        echo '<b><br><br><big><u>' . _NEWS . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/news_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/news_js.php'><img src='images/js.gif'></a>&nbsp;";
    }

    if ('mylinks' == $myrow['dirname']) {
        1 == $actmods['mylinks'];

        echo '<b><br><br><big><u>' . _LINKS . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/mylinks_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/mylinks_js.php'><img src='images/js.gif'></a>&nbsp;";
    }

    if ('mydownloads' == $myrow['dirname']) {
        1 == $actmods['mydownloads'];

        echo '<b><br><br><big><u>' . _DOWNLOADS . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/mydownloads_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/mydownloads_js.php'><img src='images/js.gif'></a>&nbsp;";
    }

    if ('wfdownloads' == $myrow['dirname']) {
        1 == $actmods['wfdownloads'];

        echo '<b><br><br><big><u>' . _WFDOWNLOADS . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/wfdownloads_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/wfdownloads_js.php'><img src='images/js.gif'></a>&nbsp;";
    }

    if ('newbb' == $myrow['dirname']) {
        1 == $actmods['newbb'];

        echo '<b><br><br><big><u>' . _NEWBB . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/newbb_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/newbb_js.php'><img src='images/js.gif'></a>&nbsp;";
    }

    if ('newbbex' == $myrow['dirname']) {
        1 == $actmods['newbb'];

        echo '<b><br><br><big><u>' . _NEWBBEX . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/newbbex_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/newbbex_js.php'><img src='images/js.gif'></a>&nbsp;";
    }

    if ('lykos_reviews' == $myrow['dirname']) {
        1 == $actmods['lykos_reviews'];

        echo '<b><br><br><big><u>' . _REVIEWS . '</u></big></b><br>';

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/lykos_reviews_rss.php'><img src='images/rss.gif'></a>&nbsp; / ";

        echo "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/lykos_reviews_js.php'><img src='images/js.gif'></a>&nbsp;";
    }
}

echo "<br><br>Vous pouvez utiliser les RSS de différentes façons. Pour l'ajouter en javascripts dans votre page, inclure simplement les quelques lignes dans votre code html:<br>";
echo '<br>&lt;script src="URL"&gt;&lt;/script&gt; <br><br>Cette URL est le lien from the relevant JS image above.';

echo "Le fil javascript peut est disponible en 3 classes ccs pour permetre de la formatter en fonction du site dans lequel il sera inséré:<br>
      <br>rss_title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      avec l'ancien aspect d'entête<br>
      rss_body&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     avec l'ancien aspect de corps<br>
      rss_footer&nbsp;&nbsp;&nbsp;     avec l'ancien aspect de pied de page<br>";

CloseTable();
include(XOOPS_ROOT_PATH . '/footer.php');

/* Funtions */
