<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreatePostRequest;
use App\Models\Backend\Post;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Tüm kontrolcülerde yetki kontrolü construct metodunda yapılacak
        // Gerekirse resource kontrolcülerinde metodun içinde de kontrol edilebilir.
        $this->middleware(['permission:panel']); // Backend altındaki tüm kontrolcülerde mecburi olarak bulunacak.
        //$this->middleware(['permission:beta_tester']);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function index(){
        //$tagged=Post::withAnyTags(['tag3', 'tag2'])->get();

        // mevcut içeriği görüntüleme yetkisi kontrol edilecek.
        return view ('backend.posts.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        dd(\request()->post());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id) ?? abort(404,'İçerik Bulunamadı');
        return view('backend.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ckeditor_upload(Request $request){
        //ckeditor ile içerik düzenlerken ya da eklerken resimleri yükleyen metod.
        $post=Post::find($request->post_id);
        if($post){
            $image = $post->addMediaFromRequest('upload')->toMediaCollection('editor_images');
            return response()->json([
                'url'=>$image->getUrl(),
                'page'=>'güncelleme döndü.'
            ]);
        } else {
            //yeni ekleniyorsa post_id 0 olarak gelecek. Bu durumda 0 ile ekleyip post eklendiğinde 0 olanları post üzerine ekleyeceğiz.
            $post = new Post();
            $post->id=0;
            $post->exists = true;
            $image = $post->addMediaFromRequest('upload')->toMediaCollection('editor_images');
            return response()->json([
                'url'=>$image->getUrl(),
                'page'=>'new metodu döndürdü'
            ]);
        }

    }
}
