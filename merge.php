<?php

if (! file_exists('furnidata.xml')) {
    throw new RuntimeException('furnidata.xml not found');
}

$furnidata = new SimpleXMLElement(file_get_contents('furnidata.xml'));
$items     = new SimpleXMLElement('<items>' . $_POST['xml'] . '</items>');

foreach ($items->furnitype as $item) {
    $child = $furnidata->roomitemtypes->addChild('furnitype');

    foreach ($item->attributes() as $key => $value) {
        $child->addAttribute($key, $value);
    }

    foreach ($item->children() as $key => $value) {
        $child->addChild($key, $value);
    }
}

$furnidata->asXML('furnidata.xml');
