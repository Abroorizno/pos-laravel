<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aritmatika : Tambah</title>
</head>
<body>
    <center>
        <h1>- Operasi Tambah -</h1>
    </center>
    <form action="/action-tambah" method="post">
        @csrf
        <table align="center">
            <tr>
                <td>
                    <h3>Angka 1 : </h3>
                </td>
                <td>
                    <input type="number" name="angka1" required>
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    <h3>Angka 2 : </h3>
                </td>
                <td>
                    <input type="number" name="angka2" required>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Hitung!</button>
                </td>
            </tr>
        </table>
    </form>
    <hr>
    <center>
        <h3>Hasil : </h3>
        <h1>{{ $hasil }}</h1>
    </center>
</body>
</html>
