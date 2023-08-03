<?php


/** format news tage */


function formatTags(array $tags): String
{
    return implode(',', $tags);
}