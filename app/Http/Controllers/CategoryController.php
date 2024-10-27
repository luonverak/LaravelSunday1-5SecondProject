<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthMiddleware;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        try {

            if (!$request->has("name") || $request->name == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong."
                ]);
            }

            $name = $request->name;
            $description = $request->description;
            $fileName = "";
            $logo = $request->file("logo");
            if ($logo) {
                $fileName = date("dmyhis") . '-' . $logo->getClientOriginalName();
                $logo->move("asset/images", $fileName);
                $fileName = url("asset/images/$fileName");
            }

            $category = new CategoryModel();
            $category->name = $name;
            $category->description = $description ?? ""; // ?? meaning if null
            $category->logo = $fileName;
            $category->save(); // insert data into database

            $category->logo = $category->logo ?: emptyImage();

            if ($category) {
                return response()->json([
                    "status" => "success",
                    "msg" => "Category added success.",
                    "record" => $category
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getCategory()
    {
        try {
            $category = CategoryModel::select([
                "id",
                "name",
                "description",
                "logo"
            ])->get();
            $category->map(function ($q) {
                return $q->logo = $q->logo ?: emptyImage();
            });
            return response()->json([
                "status" => "success",
                "msg" => "Success",
                "records" => $category
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editCategory(Request $request)
    {
        try {
            if (!$request->has("name") || $request->name == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong."
                ]);
            }
            $id = Decryption($request->id);

            $name = $request->name;
            $description = $request->description;
            $fileName = "";

            $logo = $request->file("logo");
            if ($logo) {
                $fileName = date("dmyhis") . '-' . $logo->getClientOriginalName();
                $logo->move("asset/images", $fileName);
                $fileName = url("asset/images/$fileName");
            }

            $category = CategoryModel::where("id", $id)->first();

            if (!$category) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong."
                ]);
            }

            $category->name = $name;
            $category->description = $description ?: $category->description;
            $category->logo = $fileName ?: $category->logo;
            $category->save(); // update data into database

            $category->logo = $category->logo ?: emptyImage();

            if ($category) {
                return response()->json([
                    "status" => "success",
                    "msg" => "Category added success.",
                    "record" => $category
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
