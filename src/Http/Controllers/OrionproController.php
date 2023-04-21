<?php

namespace Osfrportal\OrionproLaravel\Http\Controllers;

class OrionproController
{
    public function index()
    {
	return response()->json([
	    'items' => '---',
	]);
    }
}