@extends('layouts.app')

@section('title', 'Users')

@section('content')

<style>
    body {
        background-color: #fff8ed;
    }

    .user-container {
        background: #fff3dc;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .page-title {
        color: #6b4226;
        font-weight: bold;
    }

    .btn-create {
        background-color: #8b5e34;
        color: white;
        border-radius: 10px;
        padding: 10px 20px;
        border: none;
    }

    .btn-create:hover {
        background-color: #6f451f;
        color: white;
    }

    .search-box {
        background: white;
        border-radius: 10px;
        padding: 10px;
    }

    .table-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,.08);
    }

    table thead {
        background-color: #8b5e34;
        color: white;
    }

    table tbody tr:hover {
        background-color: #fff1d6;
    }

    .btn-edit {
        background-color: #d9a441;
        color: white;
        border-radius: 8px;
    }

    .btn-edit:hover {
        background-color: #b8862c;
        color:white;
    }

    .btn-delete {
        background-color: #b85450;
        color:white;
        border-radius:8px;
    }

    .btn-delete:hover {
        background-color:#913c39;
        color:white;
    }

</style>


<div class="container mt-4">

    <div class="user-container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="page-title">
                👥 Halaman Users
            </h1>

            <a href="{{ route('admin.users.create') }}" 
               class="btn btn-create">
                + Tambah user
            </a>

        </div>


        {{-- Search --}}
        <form action="{{ route('admin.users') }}" method="GET" class="mb-4">

            <div class="input-group search-box">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari username atau email..."
                >

                <button class="btn btn-outline-dark">
                    🔍 Cari
                </button>

            </div>

        </form>



        {{-- Table --}}

        <div class="table-card">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>


                @forelse($users as $user)

                <tr>

                    <td>
                        {{ $users->firstItem() + $loop->index }}
                    </td>


                    <td>
                        <strong>
                            {{ $user->name }}
                        </strong>
                    </td>


                    <td>
                        {{ $user->email }}
                    </td>


                    <td>

                        <span class="badge bg-warning text-dark">
                            {{ $user->role->name ?? 'Tidak ada role' }}
                        </span>

                    </td>


                    <td>


                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="btn btn-sm btn-edit">

                            ✏ Edit

                        </a>



                        <form action="{{ route('admin.users.destroy', $user) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')


                            <button class="btn btn-sm btn-delete"
                                onclick="return confirm('Yakin hapus user ini?')">

                                🗑 Hapus

                            </button>


                        </form>


                    </td>


                </tr>


                @empty

                <tr>

                    <td colspan="5" class="text-center text-muted py-4">

                        Data user belum tersedia

                    </td>

                </tr>

                @endforelse


                </tbody>


            </table>

        </div>


        <div class="mt-3">
            {{ $users->links() }}
        </div>


    </div>

</div>


@endsection