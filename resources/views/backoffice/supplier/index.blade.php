@extends('layouts.backoffice.master', ['title' => 'Supplier'])
@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Pemasok" url="{{ route('backoffice.category.index')}}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $i => $supplier )
                            <tr>
                                <td>
                                    {{ $i + $suppliers->firstItem() }}
                                </td>
                                <td>
                                    {{ $supplier->name }}
                                </td>
                                <td>
                                    {{ $supplier->address}}
                                </td>
                                <td>
                                    {{ $supplier->telp }}
                                </td>
                                <td>
                                    @can('supplier-update')
                                        <x-button-modal id="{{ $supplier->id }}" title="Ubah Data"/>
                                        <x-modal id="{{ $supplier->id }}" title="Ubah Data">
                                            <form action="{{ route('backoffice.supplier.update', $supplier->id)}}"
                                            method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-input title="Nama Pemasok" name="name" type="text"
                                                    placeholder="Masukan Nama Pemasok" value="{{ $supplier->name }}" />
                                                <x-input title="Telp Pemasok" name="telp" type="number"
                                                    placeholder="Masukan Telp Pemasok" value="{{ $supplier->telp }}" />
                                                <x-input title="Alamat Pemasok" name="address" type="text"
                                                    placeholder="Masukan Alamat Pemasok" value="{{ $supplier->address }}" />
                                                <x-button-save title="Simpan" />
                                            </form>
                                        </x-modal>
                                    @endcan
                                    @can('supplier-delete')
                                        <x-button-delete id="{{ $supplier->id }}" title="Hapus Data" url="{{ route('backoffice.supplier.destroy', $supplier->id ) }}"/>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $suppliers->links('pagination::bootstrap-5') }}</div>
        </div>
        @can('supplier-create')
            <div class="col-12 col-lg-4">
                <form action="{{ route('backoffice.supplier.store') }}" method="POST">
                    @csrf
                    <x-card title="Tambah Pemasok" class="card-body">
                        <x-input title="Nama Pemasok" name="name" type="text" placeholder="Masukan Nama Pemasok"
                            value="{{ old('name') }}" />
                        <x-input title="Telp Pemasok" name="telp" type="number" placeholder="Masukan Telp Pemasok"
                            value="{{ old('telp') }}" />
                        <x-input title="Alamat Pemasok" name="address" type="text" placeholder="Masukan Alamat Pemasok"
                            value="{{ old('address') }}" />
                        <x-button-save title="Simpan" />
                    </x-card>
                </form>
            </div>
        @endcan
    </x-container>
@endsection
