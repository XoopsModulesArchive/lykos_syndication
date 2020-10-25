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

$modversion['name'] = _MI_LYKOS_SYND_NAME;
$modversion['version'] = 1.01;
$modversion['description'] = _MI_LYKOS_SYND_DESC;
$modversion['credits'] = 'Lykos Zine / Nicolas';
$modversion['author'] = 'Samuel Wright';
$modversion['help'] = 'lykos_reviews.html';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/lykoszine.gif';
$modversion['dirname'] = 'lykos_syndication';

// Admin things
$modversion['hasAdmin'] = 0;

// Main contents
$modversion['hasMain'] = 1;

// Blocks
$modversion['blocks'][1]['file'] = 'b_lykos_synd_feeds.php';
$modversion['blocks'][1]['name'] = _B_LYKOS_SYND_NAME;
$modversion['blocks'][1]['description'] = 'Shows rss and js newsfeeds';
$modversion['blocks'][1]['show_func'] = 'b_lykos_synd_feeds_show';

// Search
$modversion['hasSearch'] = 0;
