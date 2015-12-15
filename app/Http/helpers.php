<?php

function image($item)
{
    if ($item->image_type == null) {
        return '<img class="img-responsive" src="http://placehold.it/700x400" alt="">';
    }

    return '<img class="img-responsive" src="' .
            env('AWS_S3_IMAGE_PATH') .
            $item->id .
            '.' .
            $item->image_type .
            '" alt="' . $item->name . '">';
}
