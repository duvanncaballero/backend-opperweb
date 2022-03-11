<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        try {
            $data = Post::with('category')->with('comments')->get()->toArray();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return response()->validate(200, '', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validation Data
            $validator = Validator::make($request->all(), [
                'title'     => 'required|string|unique:posts|max:150',
                'content'   => 'required|string|max:65000',
                'category'  => 'required|numeric|exists:categories,id',
            ]);

            if($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Create resource
            $post = new Post();
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            $post->category_id = $request->get('category');
            $post->save();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return response()->validate(200, Lang::get('message.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        try {
            // Validation Data
            $validator = Validator::make(
                ['id' => $id],
                ['id' => 'required|numeric|exists:posts,id']
            );

            if ($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Search resource
            $data = Post::with('category')->with('comments')->find($id)->toArray();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return response()->validate(200, '', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        try {
            // Validation Data
            $validator = Validator::make($request->all(), [
                'id'        => 'required|numeric|exists:posts,id',
                'title'     => 'required|string|unique:posts|max:150',
                'content'   => 'required|string|max:65000',
                'category'  => 'required|numeric|exists:categories,id',
            ]);

            if($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Update resource
            $post = Post::find($request->get('id'));
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            $post->category_id = $request->get('category');
            $post->updated_at = Carbon::now();
            $post->save();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return  response()->validate(200, Lang::get('message.update'));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $validator = Validator::make(
                ['id' => $id],
                ['id' => 'required|numeric|exists:posts,id']
            );

            if ($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Delete the post and comments
            $post = Post::find($id);
            $post->comments()->delete();
            $post->delete();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return response()->validate(200, Lang::get('message.delete'));
    }
}
