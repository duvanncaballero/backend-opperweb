<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            $data = Category::with('posts')->get()->toArray();

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
                'name'     => 'required|string|unique:categories|max:150',
            ]);

            if($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Create resource
            $category = new Category();
            $category->name = $request->get('name');
            $category->save();

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
                ['id' => 'required|numeric|exists:categories,id']
            );

            if ($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Search resource
            $data = Category::with('posts')->find($id)->toArray();

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
                'name'     => 'required|string|unique:categories|max:150',
            ]);

            if($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Update resource
            $category = Category::find($request->get('id'));
            $category->name = $request->get('name');
            $category->updated_at = Carbon::now();
            $category->save();

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
                ['id' => 'required|numeric|exists:categories,id']
            );

            if ($validator->fails()){
                return response()->validate(400, $validator->errors());
            }

            //Delete the category
            $category = Category::find($id);
            $category->posts()->delete();
            $category->delete();

        } catch (\Exception $e) {
            return response()->validate(422, $e->getMessage());
        }

        return response()->validate(200, Lang::get('message.delete'));
    }
}
