<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
                throw new Exception("Harus ada bukti", 1);
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
            return redirect()->back()->with('status', 'Data tersimpan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('status', 'Data gagal disimpan!, ' . $th->getMessage());
        }
    }

    function show(DailyLog $dailyLog)
    {
        return view('pembukuan.show', compact('dailyLog'));
    }

    function index(Request $request)
    {
        $endDate = Carbon::parse($request->endDate)->addDay();
        $title = 'Pembukuan';
        $dLog = DailyLog::where('created_at', '>', $request->startDate)->where('created_at', '<', $endDate)->get();

        return view($request->has('print') ? 'pembukuan.print' : 'pembukuan.index', compact('dLog', 'request', 'title'));
    }

    function filter()
    {
        return view('filter', ['type' =>
        'pembukuan']);
    }

    function create(): View
    {
        return view('pembukuan.create');
    }
}
