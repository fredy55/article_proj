<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Comments;

class ArticlesController extends Controller
{
    public function allArticles()
    {
        
        //Fetch all Articles
        $articles = Articles::where('status', 'active')
                        ->orderBy('created_at', 'desc')
                        ->limit('full_text', 100, ' ...')
                        ->paginate(10);

        if($articles){
            return response()->json($articles, 200);
        }

        return response()->json(['error'=>'No article found! Please, try again.']);
    }

    public function singleArticle($id)
    {
        //Increase the article view count
        $this->addViews($id);
            
        //Fetch Single Articles
        $article = Articles::where(['status'=>'active', 'article_id'=>$id])->first();

        if($article){
            

            return response()->json($article, 200);
        }

        return response()->json(['error'=>'No article found! Please, try again.']);
    }
    
    public function articleComments(Request $request, $id)
    {
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

        return response()->json(['error'=>'An error occured! Please, try again.']);
    }

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

        return response()->json(['error'=>'An error occured! Please, try again.']);
    }
    
    public function articleViews($id)
    {
        //Find liked Article
        $articleViews = Articles::where(['status'=>'active', 'article_id'=>$id])->first('views');

        if($articleViews){
            return response()->json($articleViews, 200);
        }

        return response()->json(['error'=>'An error occured! Please, try again.']);
    }

    public function addViews($id)
    {
        //Find liked Article
        $articleQuery = Articles::where(['status'=>'active', 'article_id'=>$id]);
        $articleView = $articleQuery->first();
        $articleView->views = $articleView->views+1;
        
        if($articleView->save()){
            return true;
        }
        
        return false;
    }

}
