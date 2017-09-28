<?php

namespace App\Http\Controllers\Api\v1;

use App\Article;
use App\Http\Controllers\ArticlesController as ParentController;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticlesController extends ParentController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware = [];
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'tags']]);
    }
    public function tags() {
        // return \App\Tag::all();
        return json()->withCollection(
            \App\Tag::all(),
            new \App\Transformers\TagTransformer
        );
    }

    /**
     * @param LengthAwarePaginator $articles
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCollection(LengthAwarePaginator $articles)
    {
        // return $articles->toJson(JSON_PRETTY_PRINT);
        // return (new \App\Transformers\ArticleTransformerBasic)->withPagination($articles);
        return json()->withPagination(
            $articles,
            new \App\Transformers\ArticleTransformer
        );
    }

    /**
     * @param $article
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($article)
    {
//         return response()->json(
//             ['success' => 'created'],
//             201,
// //            책에서는 show 메서드를 수록하지 않았으므로 아래 코드를 오류를 낸다.
// //            우리 소스코드에서는 show 메서드를 포함하고 있으므로 주석해제해도 작동한다.
// //            ['Location' => route('api.v1.articles.show', $article->id)],
//             JSON_PRETTY_PRINT
//         );
        return json()->setHeaders([
            'Location' => route('api.v1.articles.show', $article->id)
        ])->created('created');
    }

    /**
     * @param \App\Article $article
     * @param \Illuminate\Database\Eloquent\Collection $comments
     * @return string
     */
    protected function respondInstance(Article $article, Collection $comments)
    {
        // return $article->toJson(JSON_PRETTY_PRINT);
        // return (new \App\Transformers\ArticleTransformerBasic)->withItem($article);
        return json()->withItem(
            $article,
            new \App\Transformers\ArticleTransformer
        );
    }

    /**
     * @param \App\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUpdated(Article $article)
    {
        // return response()->json([
        //     'success' => 'updated'
        // ], 200, [], JSON_PRETTY_PRINT);
        return json()->>success('updated');
    }
}
