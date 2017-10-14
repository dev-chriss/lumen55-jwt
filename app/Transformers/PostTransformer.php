<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'comments', 'recentComments'];

    public function transform(Post $post)
    {
        return $post->attributesToArray();
    }

    public function includeUser(Post $post)
    {
        if (! $post->user) {
            return $this->null();
        }

        return $this->item($post->user, new UserTransformer());
    }

    public function includeComments(Post $post, ParamBag $params = null)
    {
        $limit = 10;
        if ($params->get('limit')) {
            $limit = (array) $params->get('limit');
            $limit = (int) current($limit);
        }

        $comments = $post->comments()->limit($limit)->get();
        $total = $post->comments()->count();

        return $this->collection($comments, new CommentTransformer())
            ->setMeta([
                'limit' => $limit,
                'count' => $comments->count(),
                'total' => $post->comments()->count(),
            ]);
    }

    /**
      * List loading list is not a good thing because dingo's preloading mechanism
      * Automatically preload the include parameters, so all comments for all posts will be read
      * So you can add a recentComments, add a limit condition
      But still not perfect.
      */

    public function includeRecentComments(Post $post, ParamBag $params = null)
    {
        if ($limit = $params->get('limit')) {
            $limit = (int) current($limit);
        } else {
            $limit = 15;
        }

        $comments = $post->recentComments($limit)->get();

        return $this->collection($comments, new CommentTransformer())
            ->setMeta([
                'limit' => $limit,
                'count' => $comments->count(),
                'total' => $post->comments()->count(),
            ]);
    }
}
