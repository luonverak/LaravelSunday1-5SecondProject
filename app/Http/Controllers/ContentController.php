<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ContentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function addContent(Request $request)
    {
        try {
            if (!$request->has("title") || $request->title == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Title is required."
                ]);
            }

            $title = $request->title;

            $description = $request->description;
            $logo = $request->file("logo");
            $category_id = $request->cat_id;

            $category = CategoryModel::where("id", $category_id)->first();
            if (!$category) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong"
                ]);
            }

            $fileName = "";

            if ($logo) {
                $fileName = date("dmyhis") . '-' . $logo->getClientOriginalName();
                $logo->move("asset/images", $fileName);
                $fileName = url("asset/images/$fileName");
            }

            $content = new ContentModel();
            $content->title = $title;
            $content->description = $description;
            $content->thumbnail = $fileName;
            $content->category_id = $category_id;
            $content->user_id = Auth::user()->id;
            $content->save();

            return response()->json([
                "status" => "success",
                "msg" => "Success"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getContent()
    {
        try {
            $content = ContentModel::select([
                "id",
                "title",
                "description",
                "category_id"
            ])->with(["category" => function ($q) {
                $q->select("id","name");
            }])->get();

            return response()->json([
                "status" => "success",
                "msg" => "Success",
                "records" => $content
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
