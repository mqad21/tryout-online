<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Department;
use App\Models\Division;
use App\Models\Job;
use App\Models\Position;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Storage;
use \setasign\Fpdi\Fpdi;

class ProfileController extends Controller
{

    // Menampilkan halaman profil.
    public function index()
    {
        $user = Auth::user();
        $regions = Region::all();
        return view('pages.profil', compact('user', 'regions'));
    }

    // Logic update profil.
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'region_id' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->update($request->only('name', 'region_id'));

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil memperbarui profil',
            'title' => 'Berhasil'
        ]);
    }

    // Nampilkan Kartu Anggota.
    public function card()
    {
        $this->getProfileCard(Auth::user())->Output();
    }

    // Mendapatkan Kartu Anggota.
    private function getProfileCard(User $user)
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile('assets_/card_template.pdf');
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

            switch ($pageNo) {
                case 1:
                    $pdf->SetFont('Arial', 'B', 22);
                    // Set Nama
                    $pdf->SetXY(76, 27);
                    $pdf->MultiCell(0, 9, $user->name, 0, 'L');

                    // Set Stambuk
                    $pdf->SetXY(76, 58);
                    $pdf->MultiCell(0, 9, $user->graduation_year, 0, 'L');

                    // Set Alamat
                    $pdf->SetFont('Arial', 'B', 18);
                    $pdf->SetXY(76, 89);
                    $pdf->MultiCell(0, 8, $user->address, 0, 'L');

                    // Set Foto
                    $user_profile = explode("/", $user->photo_url);
                    $pdf->Image('profile_picture/' .  end($user_profile), 17.5, 18.5, 50.5, 0);

                    break;
                case 2:
                    $pdf->Image('https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=' . $user->uuid, 58, 21.7, 82, 0, 'PNG');
                    break;
            }
        }
        $pdf->setSourceFile("assets_/card_template.pdf");
        return $pdf;
    }
}
