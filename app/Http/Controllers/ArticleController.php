<?php

namespace App\Http\Controllers;

use App\Events\Notified;
use App\Notifications\NewReply;
use App\Notifications\NewComment;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', ]);
    }

    public function index(Tag $tag=null)
    {
        //$articles = Article::latest()->filter(request(['month', 'year']))->simplePaginate(4);
        $articles = Article::latest();

        //fetch articles by month
        if($month = request('month'))
        {
            $articles->whereMonth('created_at', $month);
        }

        //fetch articles by year
        if($year = request('year'))
        {
            $articles->whereYear('created_at', $year);
        }

        //articles collection based on tags
        if($tag)
        {
            $articles = $tag->articles->load('tags');
        }

        //bootstrap paginate all fetched articles
        $articles = $articles->paginate(4);

        //fetch archives on the archives method from the Article model
        //fetch all tags with posts
        $archives = Article::archives();
        $tags = Tag::has('articles')->pluck('name');

        return view('blogs.index', compact('articles', 'archives', 'tags'));
    }

    public function show($title)
    {
        //get article object
        $posted = Article::with('tags')->where('title', '=', str_replace('-', ' ', $title))->first();

        //delete notificationif found on the query string
        if(isset($_GET['nots']))
        {
            DB::table('notifications')->where('id', '=', $_GET['nots'])->delete();
        }

        $archives = Article::archives();
        $tags = Tag::has('articles')->pluck('name');

        return view('blogs.show',compact('posted', 'archives', 'tags'));
    }

    public function create()
    {
        //limit access with the admin gate
        if(!Gate::allows('isAdmin'))
        {
            abort(404, 'Sorry, you are not authorized!');
        }

        $archives = Article::archives();
        $tags = Tag::has('articles')->pluck('name');
        $tagNames = Tag::all()->pluck('name');

        return view('blogs.create', compact('archives', 'tags', 'tagNames'));
    }

    public function store(Request $request)
    {
        //insert new article
        $article = Article::create([
            'title'=> $request->title,
            'body'=> $request->body,
            'user_id'=> Auth::id()
        ]);

        //map article to all tags
        foreach($request->tags as $tag)
        {
            $tagObj = Tag::whereName($tag)->first();
            $article->tags()->attach($tagObj->id);
        }

        return redirect('/blog')->with(['articlesuccess'=> 'Your article is posted!']);
    }

    public function comment($title, $request)
    {
        //article object fetched
        $posted = Article::where('title', '=', str_replace('-', ' ', $title))->first();

        //create comment object and reply
        $comment = Comment::create([
            'article_id' => $posted->id,
            'body' => request('body'),
            'user_id'=> Auth::id()
        ]);

        //notify the owner of the article about a new comment
        $comenteeId = $posted->user_id;
        if($comenteeId != Auth::id())
        {
            //notified
            $notif = User::whereId($comenteeId)->first()->notify(new NewComment($comment));

            //fire notification event
            event(new Notified($notif));
        }

        return back()->with(['commentsuccess'=> 'Your comment is added!']);
    }

    public function reply()
    {
        //create reply object and send reply
        $reply = Reply::create([
            'comment_id' => request('cid'),
            'body' => request('body'),
            'user_id'=> Auth::id()
        ]);

        //send a notification to the owner of the comment
        $commented = Comment::whereId(request('cid'))->first();
        $replyeeId = $commented->user_id;

        if($replyeeId != Auth::id())
        {
            //notify
            $notif = User::whereId($replyeeId)->first()->notify(new NewReply($reply));

            //fire notification event
            event(new Notified($notif));
        }

        //send a notification to other users who replied to the same comment
        $replied = Reply::whereCommentId(request('cid'))->get();
        foreach ($replied as $rep)
        {
            if($rep->user_id != Auth::id() && $rep->user_id != $replyeeId)
            {
                //notify
               $notif = User::whereId($rep->user_id)->first()->notify(new NewReply($reply));

                //fire notification event
                event(new Notified($notif));
            }
        }

        return back()->with(['replysuccess'=> 'Your reply is sent!']);
    }

}
