@extends('layouts.backoffice.master', ['title' => 'Hak Akses'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Hak Akses" url="{{ route('backoffice.role.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hak Akses</th>
                            <th>Perizinan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $i => $role)
                            <tr>
                                <td>{{ $i + $roles->firstItem() }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <li>{{ $permission->name }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    <x-button-modal id="{{ $role->id }}" title="Ubah Data" />
                                    <x-modal id="{{ $role->id }}" title="Ubah Data">
                                        <form action="{{ route('backoffice.role.update', $role->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-input title="Nama Hak Akses" name="name" type="text"
                                                placeholder="Masukan Nama Hak Akses" value="{{ $role->name }}" />
                                            <x-select-group title="Perizinan">
                                                @foreach ($permissions as $permission)
                                                    <label class="form-selectgroup-item">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}" class="form-selectgroup-input"
                                                            @checked($role->permissions()->find($permission->id))>
                                                        <span class="form-selectgroup-label">
                                                            {{ $permission->name }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </x-select-group>
                                            <x-button-save title="Simpan" />
                                        </form>
                                    </x-modal>
                                    <x-button-delete id="{{ $role->id }}" title="Hapus Data" url="{{ route('backoffice.role.destroy', $role->id ) }}"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $roles->links('pagination::bootstrap-5') }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('backoffice.role.store') }}" method="POST">
                @csrf
                <x-card title="Tambah Hak Akses" class="card-body">
                    <x-input title="Nama Hak Akses" name="name" type="text" placeholder="Masukan Nama Akses"
                        value="{{ old('name') }}" />
                    <x-select-group title="Perizinan">
                        @foreach ($permissions as $permission)
                            <label class="form-selectgroup-item">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    class="form-selectgroup-input">
                                <span class="form-selectgroup-label">
                                    {{ $permission->name }}
                                </span>
                            </label>
                        @endforeach
                    </x-select-group>
                    <x-button-save title="Simpan" />
                </x-card>
            </form>
        </div>
    </x-container>
@endsection