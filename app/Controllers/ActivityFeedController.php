<?php

namespace App\Controllers;

class ActivityFeedController extends BaseController
{
    public function index()
    {
        return view('workspace/activity_feed');
    }
}
