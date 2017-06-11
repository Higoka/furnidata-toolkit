<?php

if (! file_exists('furnidata.xml')) {
    throw new RuntimeException('furnidata.xml not found');
}

$furnidata = new SimpleXMLElement(file_get_contents('furnidata.xml'));

$roomItems = sprintf('<roomitemtypes>%s</roomitemtypes>', $_POST['roomItems']);
$wallItems = sprintf('<wallitemtypes>%s</wallitemtypes>', $_POST['wallItems']);

$items = new SimpleXMLElement(sprintf('<items>%s</items>', $roomItems . $wallItems));

if (! empty($items->roomitemtypes)) {
    foreach ($items->roomitemtypes->furnitype as $item) {
        $child = $furnidata->roomitemtypes->addChild('furnitype');

        foreach ($item->attributes() as $key => $value) {
            $child->addAttribute($key, $value);
        }

        foreach ($item->children() as $key => $value) {
            $child->addChild($key, $value);
        }
    }
}

if (! empty($items->wallitemtypes)) {
    foreach ($items->wallitemtypes->furnitype as $item) {
        $child = $furnidata->wallitemtypes->addChild('furnitype');

        foreach ($item->attributes() as $key => $value) {
            $child->addAttribute($key, $value);
        }

        foreach ($item->children() as $key => $value) {
            $child->addChild($key, $value);
        }
    }
}

$furnidata->asXML('furnidata.xml');
