<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="/">Kembali</a>
    @if (Session::get('success'))
    <p style="padding: 5px 10px; background: green; color:white; margin:10px">{{Session::get('success')}}</p>
    @endif
    @foreach ($pasiensTrash as $pasien)
    <ol>
        <li>NAMA : {{ $pasien['nama']}}</li>
        <li>ALAMAT : {{ $pasien['alamat']}}</li>
        <li>NOMOR : {{ $pasien['nomor']}}</li>
        <li>Jenis Kelamin : {{ $pasien['JK']}}</li>
        <li>Dihapus Tanggal : {{\Carbon\Carbon::parse($pasien['deleted_at'])->format('j F, Y')}}</li>
        <li>
            <a href="{{route('restore', $pasien['id'])}}">Kembalikan Data</a>
            <a href="{{route('permanent', $pasien['id'])}}" style="color:black">Hapus Permanen</a>
        </li>
    </ol>
    @endforeach

</body>
</html>