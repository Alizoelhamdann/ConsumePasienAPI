<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume</title>
</head>
<body>
    <form action="" method="get">
        @csrf
        <input type="text" name="search" placeholder="Cari nama....">
        <button type="submit">Cari</button>
    </form>
    <br>
    <a href="{{route('add')}}">Tambah Data Baru</a>
    <a href="{{route('trash')}}">Lihat Data</a>
    @if (Session::get('success'))
        <p style="padding: 5px 10px; background: green; color:white; margin:10px">{{Session::get('success')}}</p>
    @endif
    @foreach ($pasiens as $pasien)
    <ol>
        <li>NAMA : {{ $pasien['nama']}}</li>
        <li>ALAMAT : {{ $pasien['alamat']}}</li>
        <li>NOMOR : {{ $pasien['nomor']}}</li>
        <li>Jenis Kelamin : {{ $pasien['JK']}}</li>
        <li>Aksi : <a href="{{route('edit', $pasien['id'])}}"> Edit</a> || 
        <form action="{{route('delete', $pasien['id'])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
        </form>    
        </li>
        {{-- <li>Tanggal Pendaftaran : {{$dt['tanggal_pendaftaran']}}</li> --}}
    </ol>
    @endforeach
</body>
</html>