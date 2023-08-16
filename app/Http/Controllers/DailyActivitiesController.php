<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DailyActivity;
use App\Models\Image;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
                throw new Exception("Harus ada bukti", 1);
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
            return redirect()->back()->with('status', 'Data tersimpan!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('status', 'Data gagal disimpan!, alasan: ' . $th->getMessage());
        }
    }

    function show(DailyActivity $dailyActivity)
    {
        return view('kegiatan.show', compact('dailyActivity'));
    }

    function index(Request $request)
    {
        $endDate = Carbon::parse($request->endDate)->addDay();
        $title = 'Kegiatan';
        $dAct = DailyActivity::where('created_at', '>', $request->startDate)->where('created_at', '<', $endDate)->get();

        return view('kegiatan.index', compact('dAct', 'request', 'title'));
    }

    function filter()
    {
        return view('filter', ['type' =>
        'kegiatan']);
    }

    function create(): View
    {
        return view('kegiatan.create');
    }
}
