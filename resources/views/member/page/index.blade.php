<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaturan page <a href="{{route('member.page.create')}}" class="bg-blue-400 p-2 rounded-md text-white text-sm">Tambah Tulisan</a>
        </h2>
    </x-slot>
    <x-slot name="headerRight">
        <form action="{{ route('member.page.index')}}" method="get">
            <x-text-input id="search" name="search" type="search" class="p-1 m-0 md:w-72 w-80 mt-3 md:mt-0" value="{{ request('search')}}" placeholder="Masukkan kata kunci"/>
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
                                <td class="border px-6 py-4">Judul</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Tanggal</td>
                                <td class="border px-6 py-4 lg:w-[100px] hidden lg:table-cell">Status</td>
                                <td class="border px-6 py-4 lg:w-[250px] w-[100px]">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $value)
                                
                            <tr>
                                <td class="border px-6 py-4 text-center">{{ $data->firstItem() + $key }}</td>
                                <td class="border px-6 py-4">
                                    {{ $value->title }}
                                    <div class="block text-sm text-gray-500">Penulis : {{ $value->user->name }}</div>
                                </td>
                                <td class="border px-6 py-4 text-center text-gray-500 text-sm hidden lg:table-cell">{{ \Carbon\Carbon::parse($value->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                                <td class="border px-6 py-4 text-center text-sm hidden lg:table-cell">{{ $value->status }}</td>
                                <td class="border px-6 py-4 text-center">
                                    <form action='{{route('member.page.destroy', ['post'=>$value->id])}}' method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                    <a href='{{route('member.page.edit', ['post'=>$value->id])}}' class="text-blue-600 hover:text-blue-400 px-2">edit</a>
                                    <a target='blank' href='{{route('page-detail', ['slug'=>$value->slug])}}' class="text-blue-600 hover:text-blue-400 px-2">lihat</a>
                                    <button type=' submit' class='text-red-600 hover:text-red-400 px-2'>
                                        hapus
                                    </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr style="position:relative;top: 13px;color: black;font-weight:bold;"><td class="text-center" colspan="5">Data tidak ada</td></tr>
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