<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ExampleController extends Controller
{

    public function index() {
        return ['response' =>
            [
                'id' => 1,
                'title' => 'Some Post',
                'body' => 'Here is post body'
            ]
        ];

    }
}
