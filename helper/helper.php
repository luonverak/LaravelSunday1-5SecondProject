<?php
function emptyImage()
{
    return asset("/asset/images/no_image.jpg");
}

function Encryption($value)
{
    return base64_encode($value);
}
function Decryption($value)
{
    return base64_decode($value);
}
