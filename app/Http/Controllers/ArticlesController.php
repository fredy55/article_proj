<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Articles;
use App\Models\Comments;

class ArticlesController extends Controller
{
    
    /**
     * @OA\GET(
     *    path="/articles",
     *    summary="Return list of articles, 10 per page",
     *    @OA\Response(
     *      response="200",
     *      description="Successful Operation."
     *    ),
     *    @OA\Response(
     *      response="500",
     *      description="Error occured."
     *    )
     * )
     */
    public function allArticles()
    {
        
        //Fetch all Articles
        $articles = Articles::where('status', 'active')
                        ->orderBy('created_at', 'desc') //Sort artical in descending order
                        ->limit('full_text', 100, ' ...')
                        ->paginate(10);

        if($articles){
            return response()->json($articles, 200);
        }

        return response()->json(['error'=>'Error occured! Please, try again.'], 500);
    }

    /**
     * @OA\GET(
     *    path="/articles/{id}",
     *    summary="Return a single Article",
     *    @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description="Article description used to find a single article",
     *       @OA\Schema(
     *           type="integer",
     *           format="int64",
     *           minimum=1
     *       )
     *    ),
     *    @OA\Response(
     *      response="200",
     *      description="Successful Operation."
     *    ),
     *    @OA\Response(
     *      response="500",
     *      description="Error occured."
     *    )
     * )
     */
    public function singleArticle($id)
    {
        //Single Article Query
        $articleQuery = Articles::where(['status'=>'active', 'article_id'=>$id]);
        
        //Increase the article view count
        $articleView = $articleQuery->first();
        $articleView->views = $articleView->views+1;
            
        if($articleView->save()){
            return response()->json($articleView, 200);
        }

        return response()->json(['error'=>'Error occured! Please, try again.'], 500);
    }
    
   /**
     * @OA\POST(
     *    path="/articles/{id}/comment",
     *    summary="Return a single Article",
     *    @OA\Parameter(
     *      name="article_id",
     *      in="path",
     *      required=true,
     *      description="Article description used to find a single article",
     *      @OA\Schema(
     *           type="integer",
     *           format="int64",
     *           minimum=1
     *       )
     *    ),
     *    @OA\Parameter(
     *      name="subject",
     *      in="query",
     *      required=true,
     *      description="Subject for an article comment",
     *      @OA\Schema(
     *           type="string"
     *      )
     *    ),
     * *  @OA\Parameter(
     *      name="body",
     *      in="query",
     *      required=true,
     *      description="Body for an article comment",
     *      @OA\Schema(
     *           type="string"
     *      )
     *    ),
     *    
     *    @OA\Response(
     *      response="200",
     *      description="Successful Operation."
     *    ),
     *    @OA\Response(
     *      response="401",
     *      description="Invalid input field."
     *    ),
     *    @OA\Response(
     *      response="500",
     *      description="Error occured."
     *    )
     * )
     */
    public function articleComments(Request $request, $id)
    {
        //Validate inputs
        $validateInput = Validator::make($request->all(), [
             'subject'=>'required|string',
             'body'=>'required|string',
        ]);

        if($validateInput->fails()){
            return response()->json(['error'=>$validateInput->errors()], 401);
        }

        //Create Article Comments
        $addComment = Comments::create([
                              'article_id'=>$id, 
                              'subject'=>$request->post('subject'),
                              'body'=>$request->post('subject')
                            ]);
        //Comment Throttling

        if($addComment){
            //Fetch all comments
            $comments=Comments::where('article_id',$id)
                                ->orderBy('created_at', 'desc')
                                ->get();

            return response()->json([
                                'success'=>'Your message has been successfully sent',
                                'comments'=>$comments
                            ], 200);
        }

        return response()->json(['error'=>'An error occured! Please, try again.'], 500);
    }
    
    /**
     * @OA\GET(
     *    path="/articles/{id}/like",
     *    summary="Return a single Article likes count",
     *    @OA\Parameter(
     *      name="article id",
     *      in="path",
     *      required=true,
     *      description="Description used to create likes for a single article",
     *       @OA\Schema(
     *           type="integer",
     *           format="int64",
     *           minimum=1
     *       )
     *    ),
     *    @OA\Response(
     *      response="200",
     *      description="Successful Operation."
     *    ),
     *    @OA\Response(
     *      response="500",
     *      description="Error occured."
     *    )
     * )
     */
    public function articleLikes($id)
    {
        //Find liked Article
        $articleQuery = Articles::where(['status'=>'active', 'article_id'=>$id]);
        $article = $articleQuery->first();
        $article->likes = $article->likes+1;
        
        if($article->save()){
            //Fetch total likes
            $articleLikes=$articleQuery->first('likes');

            return response()->json($articleLikes, 200);
        }

        return response()->json(['error'=>'An error occured! Please, try again.'], 500);
    }
    
    /**
     * @OA\GET(
     *    path="/articles/{id}/view",
     *    summary="Return a single Article view count",
     *    @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description="Description used to count a single article views",
     *       @OA\Schema(
     *           type="integer",
     *           format="int64",
     *           minimum=1
     *       )
     *    ),
     *    @OA\Response(
     *      response="200",
     *      description="Successful Operation."
     *    ),
     *    @OA\Response(
     *      response="500",
     *      description="Error occured."
     *    )
     * )
     */
    public function articleViews($id)
    {
        //Find Article
        $articleViews = Articles::where(['status'=>'active', 'article_id'=>$id])->first('views');

        if($articleViews){
            return response()->json($articleViews, 200);
        }

        return response()->json(['error'=>'An error occured! Please, try again.'], 500);
    }

}
