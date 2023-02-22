<?php

use App\Models\Settings\WebsIdentity;

function appdata()
{
    return WebsIdentity::find(1);
}
