<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-center"> Tambah Pengguna</h1>
        <form class="row g-3" method="POST">
            <div class="col-12">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
            </div>
            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select" name="role" id="role">
                    <option selected>admin</option>
                    <option>staff</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="inputPassword4" name="password" placeholder="Masukkan password" id="password">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="inputCity" name="email" placeholder="Masukkan email" id="password">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="inputCity" name="phone" placeholder="Masukkan nomor telepon" id="phone">
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" rows="3" name="address" placeholder="Masukkan alamat" id="address"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Add User</button>
            </div>
        </form>
    </div>


</body>

</html>