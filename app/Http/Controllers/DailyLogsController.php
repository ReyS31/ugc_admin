<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DailyLogsController extends Controller
{
    function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $latest_amount = 0;
            $latest = DailyLog::latest()
                ->first();
            $latest_money = $latest->latest_amount ?? 0;
            $validated = $request->validate([
                'desc' => 'required',
                'money_in' => 'required',
                'amount' => 'required',
            ]);

            if (!$request->has('images')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'tidak ada gambar'
                ], 400);
            }

            if (!$request->money_in) {
                $latest_amount = $latest_money - $request->amount;
            } else {
                $latest_amount = $latest_money + $request->amount;
            }
            $data =  DailyLog::create(array_merge($validated, [
                'latest_amount' => $latest_amount,
            ]));


            if (count($request->images) > 0) {
                foreach ($request->images as $image) {
                    $extension = $image->extension();

                    if (!$this->isImage($extension)) {
                        throw new Exception("File harus gambar", 1);
                    }

                    $productFilename = Str::uuid()  . '.' . $extension;
                    $image->storeAs('public/daily_logs', $productFilename);
                    Image::create([
                        'url' => 'daily_logs/' . $productFilename,
                        'imageable_id' => $data->id,
                        'imageable_type' => DailyLog::class,
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

    function show(DailyLog $dailyLog)
    {
        return view('daily_log', compact('dailyLog'));
    }
}
