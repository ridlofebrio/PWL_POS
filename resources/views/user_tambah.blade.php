<!DOCTYPE html>
<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <h1>Form Tambah Data User</h1>
        <form action="/user/tambah_simpan" method="post">

            {{ csrf_field() }}

            <label>Username <br></label>
            <input type="text" name="username" placeholder="Masukkan Username">
            <br>
            <label>Nama <br></label>
            <input type="text" name="nama" placeholder="Masukkan Nama">
            <br>
            <label>Password <br></label>
            <input type="password" name="password" placeholder="Masukkan Password">
            <br>
            <label>Level ID <br></label>
            <input type="text" name="level_id" placeholder="Masukkan ID Level">
            <br><br>
            <input type="submit" class="btn btn-success" value="simpan">
        </form>
    </body>
</html>