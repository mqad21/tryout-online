<?php

namespace App\Http\Controllers;

use App\DataTables\AlumniDataTable;
use App\DataTables\UsersDataTable;
use App\Helpers\Constants;
use App\Models\Activity;
use App\Models\Department;
use App\Models\Division;
use App\Models\Job;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class UserController extends Controller
{

    public function daftar_pengguna(UsersDataTable $datatable)
    {
        return $datatable->render('pages.pengguna.manajemen-pengguna');
    }

    public function download_kartu(Request $request)
    {
        $zip = new ZipArchive;
        $fileName = 'kartu_alumni.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('profile_card'));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName));
    }

    public function detail_pengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $jobs = Job::all();
        $departments = Department::all();
        $divisions = Division::all();
        $positions = Position::all();
        $activities = Activity::all();
        $roles = Role::all();
        $own_user = false;
        return view('pages.profil', compact('jobs', 'departments', 'divisions', 'positions', 'roles', 'user', 'own_user', 'activities'));
    }

    public function detail_pengguna_post(Request $request, $id)
    {
        if ($request->submit == 'approve') {
            $request->validate([
                'role_id' => 'required'
            ]);
        }
        $user = User::findOrFail($id);
        if ($request->submit == 'approve') {
            $user->is_approved = true;
            $user->role_id = $request->role_id;
        } else {
            $user->is_approved = false;
        }
        $user->save();
        if ($request->submit != 'approve') return redirect()->back();
        return redirect('/pengguna')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menyetujui pengguna',
            'title' => 'Berhasil'
        ]);
    }

    public function hapus_pengguna(Request $request, $id)
    {
        User::findOrFail($id)->delete();
        return redirect('/pengguna')->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menghapus pengguna',
            'title' => 'Berhasil'
        ]);
    }

    public function alumni(AlumniDataTable $datatable)
    {
        return $datatable->render('pages.pengguna.direktori-alumni');
    }

    public function statistik_alumni()
    {
        $types = [
            Constants::CHART_TYPE_STAMBUK,
            Constants::CHART_TYPE_KEGIATAN,
            Constants::CHART_TYPE_KEGIATAN_STAMBUK,
        ];
        return view('pages.pengguna.statistik-alumni', compact('types'));
    }

    public function grafik_alumni(Request $request)
    {
        $base_data_tahun = collect(range(1981, date("Y")))->mapWithKeys(function ($item) {
            return [strval($item) . ' ' => 0];
        });
        $base_data_kegiatan = Activity::all()->pluck('name')->mapWithKeys(function ($item) {
            return [$item => 0];
        });
        $base_data_tahun_kegiatan = $base_data_tahun->map(function () use ($base_data_kegiatan) {
            return $base_data_kegiatan;
        });

        switch ($request->type) {
            case Constants::CHART_TYPE_STAMBUK:
                $type = "ColumnChart";
                $count = User::alumni()->get()->groupBy('graduation_year')->map->count();
                $count = $this
                    ->merge_data($count, $base_data_tahun, true)
                    ->map(function ($item, $key) {
                        return ['Tahun Lulus' => $key, 'Jumlah Alumni' => $item];
                    })->values();
                $data = $this->associative_to_aoa($count);
                $options = [
                    'chart' => [
                        'title' => $request->type,
                    ],
                    'bars' => 'vertical',
                    'vAxis' => [
                        'format' => 'decimal'
                    ],
                    'hAxis' => [
                        'format' => 'decimal',
                        'textStyle' => [
                            'fontSize' => 12,
                        ],
                        'gridlines' => [
                            'count' => 1,
                            'interval' => 1,
                        ]
                    ],
                    'legend' => [
                        'position' => 'right'
                    ],
                ];
                break;
            case Constants::CHART_TYPE_KEGIATAN:
                $type = "PieChart";
                $count = User::alumni()->with('activity')->get()->groupBy('activity.name')->map->count();
                $count = $this
                    ->merge_data($count, $base_data_kegiatan)
                    ->map(function ($item, $key) {
                        return ['Kegiatan' => $key, 'Jumlah Alumni' => $item];
                    })->values();
                $data = $this->associative_to_aoa($count);
                $options = [
                    'height' => 300,
                    'chart' => [
                        'title' => $request->type,
                    ],
                ];
                break;
            case Constants::CHART_TYPE_KEGIATAN_STAMBUK:
                $type = "ColumnChart";
                $count = User::alumni()->get()->groupBy('graduation_year')->map(function ($item) use ($base_data_kegiatan) {
                    return Activity::all()->mapWithKeys(function ($activity) use ($item) {
                        return [$activity->name => collect($item)->where('activity_id', $activity->id)->count()];
                    });
                });
                $count = $this
                    ->merge_data($count, $base_data_tahun_kegiatan, true)
                    ->map(function ($item, $key) {
                        return collect(['Tahun Lulus' => $key])->merge($item);
                    })->values();
                $data = $this->associative_to_aoa($count);
                $options = [
                    'chart' => [
                        'title' => $request->type,
                    ],
                    'bars' => 'vertical',
                    'vAxis' => [
                        'format' => 'decimal'
                    ],
                    'hAxis' => [
                        'format' => 'decimal',
                        'textStyle' => [
                            'fontSize' => 12,
                        ],
                        'gridlines' => [
                            'count' => 1,
                            'interval' => 1,
                        ]
                    ],
                    'isStacked' => true,
                    'legend' => [
                        'position' => 'right'
                    ],
                ];
                break;
        }

        return view('pages.pengguna.grafik-alumni', compact('data', 'options', 'type'));
    }

    private function merge_data($collection, $base_data, $number_key = false)
    {
        if ($number_key) {
            $collection = $collection->mapWithKeys(function ($item, $key) {
                return [$key . ' ' => $item];
            })->all();
        }
        return $base_data->merge($collection);
    }

    private function associative_to_aoa($associative)
    {
        $keys = collect($associative[0])->keys();
        $aoa = collect($associative)
            ->map(function ($item) {
                return collect($item)->values();
            })
            ->prepend($keys)
            ->values();
        return $aoa;
    }
}
