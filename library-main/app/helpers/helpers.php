<?php
function convert_date($value)
{
    return Date('H:i:s - d M Y', strtotime($value));
}

function convert_price($value)
{
    return 'Rp.' . number_format($value, 0, ',', '.');
}
