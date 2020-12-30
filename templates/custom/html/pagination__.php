<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function pagination_arrow(){
$arrow = array(
'first' => '&lt;&lt;',
'prev' => '&lt;',
'next' => '&gt;',
'last' => '&gt;&gt;',
);
return $arrow;
}

function pagination_list_footer($list)
{
$html = "<div class=\"pagination\">\n";
$html .= $list['pageslinks'];
$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
$html .= "\n</div>";

return $html;
}

function pagination_list_render($list)
{
$html = '<ul class="pagination-list">';
$html .= $list['start']['data'];
$html .= $list['previous']['data'];

foreach ($list['pages'] as $k => $page)
{
if (in_array($k, range($range * $step - ($step + 1), $range * $step)))
{
if (($k % $step == 0 || $k == $range * $step - ($step + 1)) && $k != $currentPage && $k != $range * $step - $step)
{
$page['data'] = preg_replace('#(<a.*?>).*?(</a>)#', '$1...$2', $page['data']);
}
}

$html .= $page['data'];
}

$html .= $list['next']['data'];
$html .= $list['end']['data'];

$html .= '</ul>';
return $html;
}

function pagination_item_active(&$item)
{
$arrow = pagination_arrow();
$class = '';

// Check for "Start" item
if ($item->text == JText::_('JLIB_HTML_START'))
{
$display = $arrow['first'];
$class = ' class="first"';
}

// Check for "Prev" item
if ($item->text == JText::_('JPREV'))
{
$display = $arrow['prev'];
$class = ' class="prev"';
}

// Check for "Next" item
if ($item->text == JText::_('JNEXT'))
{
$display = $arrow['next'];
$class = ' class="next"';
}

// Check for "End" item
if ($item->text == JText::_('JLIB_HTML_END'))
{
$display = $arrow['last'];
$class = ' class="last"';
}

// If the display object isn't set already, just render the item with its text
if (!isset($display))
{
$display = $item->text;
}

return '<li' . $class . '><a title="' . $item->text . '" href="' . $item->link . '">' . $display . '</a></li>';
}

function pagination_item_inactive(&$item)
{
$arrow = pagination_arrow();
// Check for "Start" item
if ($item->text == JText::_('JLIB_HTML_START'))
{
return '<li class="first disabled"><span>'.$arrow['first'].'</span></li>';
}

// Check for "Prev" item
if ($item->text == JText::_('JPREV'))
{
return '<li class="prev disabled"><span>'.$arrow['prev'].'</span></li>';
}

// Check for "Next" item
if ($item->text == JText::_('JNEXT'))
{
return '<li class="next disabled"><span>'.$arrow['next'].'</span></li>';
}

// Check for "End" item
if ($item->text == JText::_('JLIB_HTML_END'))
{
return '<li class="last disabled"><span>'.$arrow['last'].'</span></li>';
}

// Check if the item is the active page
if (isset($item->active) && ($item->active))
{
return '<li class="active"><span>' . $item->text . '</span></li>';
}

// Doesn't match any other condition, render a normal item
return '<li class="disabled">' . $item->text . '</li>';
}
?>

