<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
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
            $data = Comment::with('post')->get()->toArray();

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
                'post'     => 'required|numeric|exists:posts,id',
                'content'  => 'required|string|max:500'
            ]);

            if($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Create resource
            $comment = new Comment();
            $comment->content = $request->get('content');
            $comment->post_id = $request->get('post');
            $comment->save();

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
                ['id' => 'required|numeric|exists:comments,id']
            );

            if ($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Search resource
            $data = Comment::with('post')->find($id)->toArray();

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
                'post'     => 'required|numeric|exists:posts,id',
                'content'  => 'required|string|max:500'
            ]);

            if($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Update resource
            $comment = Comment::find($request->get('id'));
            $comment->content = $request->get('content');
            $comment->post_id = $request->get('post');
            $comment->updated_at = Carbon::now();
            $comment->save();

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
                ['id' => 'required|numeric|exists:comments,id']
            );

            if ($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Delete the comment and post
            $comment = Comment::find($id);
            $comment->post()->delete();
            $comment->delete();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return response()->validate(200, Lang::get('message.delete'));
    }
}
