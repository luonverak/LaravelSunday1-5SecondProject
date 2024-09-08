<?php

namespace App\Http\Controllers;

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

            if ($category) {
                return response()->json([
                    "status" => "success",
                    "msg" => "Category added success."
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
