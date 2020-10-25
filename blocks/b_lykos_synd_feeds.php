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

function b_lykos_synd_feeds_show($options)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $block = [];

    $block['title'] = _B_LYKOS_SYND_NAME;

    $block['content'] = "<small><div align='center'>";

    $block['content'] .= "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/news_rss.php'><img src='" . XOOPS_URL . "/modules/lykos_syndication/images/rss.gif'></a>&nbsp;/&nbsp;";

    $block['content'] .= "<a href='" . XOOPS_URL . "/modules/lykos_syndication/mods/news_js.php'><img src='" . XOOPS_URL . "/modules/lykos_syndication/images/js.gif'></a>&nbsp;<br>";

    $block['content'] .= "<a href='" . XOOPS_URL . "/modules/lykos_syndication/index.php'>" . _B_LYKOS_SYND_MORE . '</a>';

    $block['content'] .= '</div></small>';

    return $block;
}
