@extends('layout.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Product</h1>

            <a class="btn btn-primary mb-2" href="{{ route('product.create') }}" role="button">Create New</a>

            {{-- Flash session message --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Nama</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Brand</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp. {{ number_format($product->price, 0, 2) }}</td>
                                    <td>Rp. {{ number_format($product->sale_price, 0, 2) }}</td>
                                    <td>{{ $product->brands }}</td>
                                    <td>
                                        @if ($product->image == null)
                                            <span class="badge bg-primary">No Image</span>
                                        @else
                                            <img src="{{ asset('storage/product/' . $product->image) }}"
                                                alt="{{ $product->name }}" style="max-width: 50px">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($product->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            @if (Auth::user()->role->name == 'Admin')
                                                {{-- Pengecekan apakah pengguna adalah admin --}}
                                                <form action="{{ route('product.updateStatus', $product->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fas fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('product.updateStatus', $product->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fas fa-times"></i></button>
                                                </form>
                                            @else
                                                <span class="badge bg-info">Pending</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        <form onsubmit="return confirm('Are you sure?');"
                                            action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>Edit</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash-alt"></i> Delete</button>

                                        </form>
                                    </td>

                                </tr>
                                @php
                                    $categoryName = $product->category->name;
                                    if (!isset($categoryCounts[$categoryName])) {
                                        $categoryCounts[$categoryName] = 0;
                                    }
                                    $categoryCounts[$categoryName]++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Jumlah Produk berdasarkan Kategori :</h3>
                    <ul>
                        @foreach ($categoryCounts as $categoryName => $count)
                            <li>{{ $categoryName }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
