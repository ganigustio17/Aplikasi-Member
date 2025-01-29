<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaturan User <a href="{{route('member.user.create')}}" class="bg-blue-400 p-2 rounded-md text-white text-sm">+ Tambah User</a>
        </h2>
    </x-slot>
    <x-slot name="headerRight">
        <form action="" method="get">
            <x-text-input id="search" name="search" type="search" class="p-1 m-0 md:w-72 w-80 mt-3 md:mt-0" value="{{ request('search') }}"
                placeholder="Masukkan kata kunci" />
            <x-primary-button class="p-1" type="submit">Cari</x-primary-button>
        </form>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap table-fixed">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4 w-[80px]">No</td>
                                <td class="border px-6 py-4">Nama</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Waktu Daftar</td>
                                <td class="border px-6 py-4 lg:w-[120px] hidden lg:table-cell">Verifikasi Email</td>
                                <td class="border px-6 py-4 lg:w-[120px] hidden lg:table-cell">Block</td>
                                <td class="border px-6 py-4 lg:w-[200px] w-[100px]">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $value)
                                
                            <tr>
                                <td class="border px-6 py-4">{{ $data->firstItem() + $key }}</td>
                                <td class="border px-6 py-4">
                                    <div>{{ $value->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $value->email }}</div>
                                    <div class="text-sm text-gray-500">
                                        @if ($value->permissions->isEmpty() == false)
                                        <b>Hak Akses : </b>
                                            {{ $value->permissions->pluck('name')->implode(', ') }}
                                        @endif
                                    </div>
                                    
                                    <div class="block lg:hidden text-sm text-gray-500">verifikasi email: {{ $value->email_verified_at != null ? 'Sudah' : 'Belum' }}</div>
                                    <div class="block lg:hidden text-sm text-gray-500">
                                        Block:
                                        <a href="{{ route('member.user.toggle-block', ['user'=>$value->id])}}">
                                            <span class="text-blue-600">tidak</span>
                                        </a>
                                    </div>
                                </td>

                                <td class="border px-6 py-4 text-gray-500 text-sm text-center hidden lg:table-cell">
                                    {{ \Carbon\Carbon::parse($value->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY')}}
                                </td>
                                <td class="border px-6 py-4 text-gray-500 text-sm text-center hidden lg:table-cell">
                                     {{ $value->email_verified_at != null ? 'Sudah' : 'Belum' }}
                                </td>
                                <td class="border px-6 py-4 text-gray-500 text-sm text-center hidden lg:table-cell">
                                    <a href="{{ route('member.user.toggle-block', ['user'=>$value->id])}}">
                                        @if ($value->blocked_at == null)
                                        <span class="text-blue-600">tidak</span>
                                        @else   
                                        <span class="text-blue-600">ya</span>                                    
                                        @endif
                                    </a>
                                </td>
                                <td class="border px-6 py-4 text-center">
                                    <a href="{{route('member.user.edit', ['user'=>$value->id])}}" class="text-blue-600 hover:text-blue-400 px-2">edit</a>
                                    <form class="inline" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                        action="{{route('member.user.destroy', ['user'=>$value->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type='submit' class='text-red-600 hover:text-red-400 px-2'>
                                            hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr style=" position:relative;top: 13px;color: black;font-weight:bold;">
                                <td class="text-center" colspan="6">Data tidak ada</td>
                            </tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-5">
                    {!! $data->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>