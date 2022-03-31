<?php

namespace App\Http\Controllers\Documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Comments;

class EndpointsController extends Controller
{
    /**
     * @OA\Get(
     *     path = "/articles",
     *     @OA\Response(
     *       response = "default",
     *       description = "The request was Successful",
     *     ) 
     *  )  
     */
}
