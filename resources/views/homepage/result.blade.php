@if(isset($user))
  <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <img style="width: 200px" src="{{ $user->photo_url }}" alt="foto">
            </div>
            <table class="table scanner-result">
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Tempat / Tanggal Lahir</th>
                    <td>{{ $user->birth_place }} / {{ $user->formatted_birth_date }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td>{{ $user->phone_number }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>Tahun Lulus</th>
                    <td>{{ $user->graduation_year }}</td>
                </tr>
                <tr>
                    <th>Kegiatan</th>
                    <td>{{ $user->detail_activity }}</td>
                </tr>
            </table>
        </div>
    </div>
@else
    <h1>Tidak ada Data</h1>
@endif