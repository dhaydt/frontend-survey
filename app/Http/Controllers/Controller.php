<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show($shared = NULL, $id){
        $data['id'] = $id;
        $data['survey'] = Survey::find($id);
        $data['surveyor_id'] = $shared;
        $data['title'] = $data['survey']['name'] ?? '';

        return view('frontend.show.index', $data);
    }
}
