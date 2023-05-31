<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume Rest API Pasiens || Create</title>
</head>

<body>
    <h2>Tambah Data Baru</h2>
    @if (Session::get('errors'))
        <p style="color: red">{{Session::get('errors')}}</p>
    @endif
    <form action="{{route('send')}}" method="POST">
        @csrf
        <div style="display: flex; margin-bottom: 15px">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukan Nama Anda">
        </div>
        <div style="display: flex; margin-bottom: 15px">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat Anda">
        </div>
        <div style="display: flex; margin-bottom: 15px">
            <label for="nomor">Nomor</label>
            <input type="number" name="nomor" id="nomor" placeholder="Masukan Nomor Anda">
        </div>
        <div style="display: flex; margin-bottom: 15px">
            <label for="JK">Jenis Kelamin</label>
            <select name="JK" id="JK" >
                <option hidden disabled selected>Pilih</option>   
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <button type="submit">Kirim</button>
    </form>
</body>

</html>
