<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Tulisan
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Tambah Data Tulisan
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Silakan melakukan penambahan data
                            </p>
                        </header>

                        <form method="post" action="{{route('member.page.store')}}" class="mt-6 space-y-6" enctype="multipart/form-data">
                              
                            @csrf
                            <div>
                                <x-input-label for="title" value="Judul" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{old('title')}}"  autofocus autocomplete="title" />
                            </div>
                            <div>
                                <x-input-label for="description" value="Deskripsi" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{old('description')}}" autofocus autocomplete="description" />
                            </div>
                            <div>
                                <x-input-label for="thumbnail" value="Thumbnail" />
                                <x-text-input id="thumbnail" name="thumbnail" type="file" class="w-full border-gray-300 rounded-md" autofocus autocomplete="thumbnail" />
                            </div>
                            <div>
                                <input id="x"  type="hidden" value="{!! old('content') !!}" name="content">
                                <trix-editor class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min-h-80" input="x"></trix-editor>
                            </div>
                            <div>
                                <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="draft" {{ old('status')}}>Simpan Sebagai Draft</option>
                                    <option value="publish" {{ old('status')}}>Publish</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="{{route('member.page.index')}}">
                                    <x-secondary-button>kembali</x-secondary-button>
                                </a>
                                <x-primary-button>simpan</x-primary-button>
                            </div>   
                        </form> 
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>