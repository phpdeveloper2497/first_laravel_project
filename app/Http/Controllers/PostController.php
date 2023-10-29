<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
        $this->authorizeResource(Post::class,'post'); // agar CRUD bo'ladigan bo'lsa methodlarga $this->authorize('update', $post); ni yozish shatmash shuni yozsak hammasi uchun ishlaydi faqat  ruxsat berish shart bolmaganlariga PostPolicy class methodlariga (index,show, create) ga return true; yozish kk.
    }

    public function index()
    {
//        foreach (Post::all() as $posts) {
//            echo $posts->title;
//        }
//
//        $posts = Post::all();
//        $posts = Post::where('title','title2')->get();
//        dd($posts);

        // BAZAGA MA'LUMOT QO'SHISH

        // FIRST METHOD
//
//        $posts = Post::create([
//            'title' => 'Paris',
//            'short_content' => 'New basic',
//            'content' => 'Create new element',
//            'photo' => 'library',
//
//        ]);
//
//        $posts->title='London';
//        return 'succsecful';

        // SECOND METHOD
//
//        $posts = new Post;
//
//        $posts->title = 'What is Lorem Ipsum?';
//        $posts->short_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry';
//        $posts->content = 'Lorem Ipsum has been the industrs standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries';
//        $posts->photo = 'Paris to London';
//        $posts->save();
//        return 'Successful create with second method';


        // UPDATE DATABASE

//        // FIRST METHOD
//        $posts = Post::find(5);
//        $posts->title = 'What is Lorem Ipsum?';
//        $posts->save();

//        SECOND METHOD

//        Post::where('short_content','Create' )->update(['short_content' => 'First create']);
//        dd($posts);
//        $posts->update(['Create' => 'First create']);
//        return 'successful update';
//

        // isDirty()-o'zgarganligini isClean()-o'zgarmaganligini tekshiradi

//        if($posts->isDirty('title')){
//            return 'yes';
//        }else{
//            return 'no';
//        }

        // Delete from database

        //FIRST METHOD
//        $post = Post::find(6);
//        $post->delete();

//        SECOND METHOD
//        $posts = Post::where('id',7)->first();
//        $posts->delete();
//        return 'successful deleted';

        //Three method
//        Post::destroy(12);

        //KORZINKALI O'CHIRHISH
//        Post::destroy(1);

//        $posts = DB::table('posts')->where('title', 'czxcxzz')->get();
//        $posts = DB::table('posts')->pluck('title');
//        $posts = DB::table('posts')->where('title', 'to day')->value('short_content');
//        $posts = DB::table('posts')->get()->chunk(3);
        //        return $posts->title;

//            $posts = DB::table('posts')->avg('id');
//        $posts = DB::table('posts')
//        ->select('title', 'short_content as content')
//        ->get();

//        $posts = DB::table('posts')->distinct()->get();

//        $query = DB::table('posts')->select('content');
//
//        $posts = $query->addSelect('short_content')->get();

//        $posts = DB::table('posts')
//            ->select(DB::raw('count(*) as short_content, content'))
//            ->where('content', '<>', 'rwgefsdfds')
//            ->groupBy('content')
//            ->get();

//        if (DB::table('posts')->where('title', 'title')->exists()) {
//            return 'ok';
//        }
//
//        $posts = DB::table('posts')
//            ->select('title', 'short_content as content')
//            ->get();
//            dd($posts);

        $posts = Post::latest()->paginate(9);

        return view('posts.index')->with('posts', $posts);

    }


    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);

    }


    public function store(StorePostRequest   $request)
    {

            //First method
//$path = $request->file('photo')->store('post-photos');
//$path = $request->file('photo')->storeAs('post-photos','bor');

        //Second method
       if($request->hasFile('photo')){
           $file = $request->file('photo');
           $name = $file->getClientOriginalName();
           $path = $file->storeAs('post-photos',$name);

       }

        $post = Post::create([
            'user_id' =>auth()->id(),
            'category_id' =>$request->input('category_id'),
//            'tag_id' =>$request->input('tag_id'),
            'title' => $request->input('title'),
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'photo' => $path ?? null,
        ]);

       if(isset($request->tags))
       {
           foreach ($request->tags as $tag)
           {
               $post->tags()->attach($tag);
           }
       }

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
//        $post = Post::find();  bu holatda show ga argument beriladi show(string $id) ko'rinishida
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }


    public function edit(Post $post)
    {
//        Authorize uchun      birinchi usul
//        if (! Gate::allows('update-post', $post)) {
//            abort(403);
//        }
        //ikkinchi qisqa usul
//        Gate::authorize('update', $post);
// The action is authorized...

//                uchinchi usul
//        $this->authorize('update', $post);

        return view('posts.edit')->with(['post'=>$post]);
    }


    public function update(StorePostRequest $request, Post $post)
    {

//        Gate::authorize('update', $post);

//        $this->authorize('update', $post);

        if($request->hasFile('photo')){

            if(isset($post->photo)){
                Storage::delete($post->photo);
            }

            $file = $request->file('photo');
            $name = $file->getClientOriginalName();
            $path = $file->storeAs('post-photos',$name);
        }

        $post->update([
            'title' => $request->input('title'),
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'photo' => $path ?? $post->photo
        ]);

        return redirect()->route('posts.show',['post'=>$post->id]);
    }


    public function destroy(Post $post)
    {
//        Gate::authorize('delete', $post);

//        $this->authorize('update', $post);

        if(isset($post->photo)){
            Storage::delete($post->photo);
        }


        $post->delete();
        return redirect()->route('posts.index');
    }
}

