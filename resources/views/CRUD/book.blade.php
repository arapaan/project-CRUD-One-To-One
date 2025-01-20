<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel dengan PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <h1 class="d-flex justify-content-center">Data Buku</h1>
  @if (@session('success'))
      <div class="alert alert-success">
        {{ session('success') }}  
      </div>
  @endif
  @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
  @endif
  {{-- input data --}}
    <div class="container">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#TambahHobi">Tambah</button>

        <div class="modal fade" id="TambahHobi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Menambahkan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('CRUD.post') }}">
                  @csrf
                    <input type="text" name="name" placeholder="Masukkan nama buku" required value="{{ old('name') }}"> <br>
                    <p>Masukkan tanggal penerbitan:</p>
                    <input type="date" name="date" placeholder="Masukkan tanggal penerbitan" required value="{{ old('date') }}"> <br>
                    <select name="author_id" id="">
                     @foreach( $authors as $author )
                      <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->birth }})</option>
                     @endforeach
                    </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
            </div>
          </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Author</th>
                    <th scope="col">Birth</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>


                <?php foreach ($data as $index => $item): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td> <!-- ID otomatis -->
                        <td><?php echo htmlspecialchars($item->name); ?></td>
                        <td><?php echo htmlspecialchars($item->date); ?></td>
                        <td>{{ $item->author->name ? : '-' }}</td>
                        <td>{{ $item->author->birth ? : '-' }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#EditNama-{{ $index }}">Edit</button>

                            <!-- Modal -->
        <div class="modal fade" id="EditNama-{{ $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="{{ route('CRUD.update', $item->id) }}">
                @csrf
                @method('put')
                  <input type="text" name="name" required value="{{ old('name', $item->name) }}"> <br>
                  <input type="date" name="date" required value="{{ old('date', $item->date) }}"> <br>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <form action="{{ route('CRUD.destroy',$item->id) }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-outline-danger">Hapus</button>
        </form>
        </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        </table>
        </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>