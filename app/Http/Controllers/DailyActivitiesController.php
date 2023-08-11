<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DailyActivity;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DailyActivitiesController extends Controller
{
    function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);

            if (!$request->has('images')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'tidak ada gambar'
                ], 400);
            }

            $data =  DailyActivity::create($validated);


            if (count($request->images) > 0) {
                foreach ($request->images as $image) {
                    $extension = $image->extension();

                    if (!$this->isImage($extension)) {
                        throw new Exception("File harus gambar", 1);
                    }

                    $productFilename = Str::uuid()  . '.' . $extension;
                    $image->storeAs('public/daily_activity', $productFilename);
                    Image::create([
                        'url' => 'daily_activity/' . $productFilename,
                        'imageable_id' => $data->id,
                        'imageable_type' => DailyActivity::class,
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'data disimpan',
                'data' => $data->toArray(),
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => $th->getMessage(),
                ],
                400
            );
        }
    }

    
    function show(DailyActivity $dailyActivity)
    {
        return view('daily_activity', compact('dailyActivity'));
    }
}
