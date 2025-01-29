<x-front.layout>
    <x-slot name="pageHeader">
        {{ $data->title }}
    </x-slot>
    <x-slot name="pageSubheading">
        {{ $data->description }}
    </x-slot>
    <x-slot name="pageBackground">
        {{ asset('/thumbnails'). "/" . $data->thumbnail }}
    </x-slot>
    <x-slot name="pageHeaderLink">
         {{ route('page-detail', ['slug'=>$data->slug])}}
    </x-slot>
    <x-slot name="pageTitle">{{ $data->title }}</x-slot>
    <x-slot name="conten">{!! $data->content !!}</x-slot>
   
    
        <!-- Main Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="card shadow-lg border-0 rounded-3 p-4" style="background-color: #343a40; border-radius: 10px;">
                            <h2 class="text-center text-light mb-4">Kirim Pesan</h2>
        
                            <form action="" method="">
                                <div class="form-group mb-4">
                                    <label for="message" class="form-label fs-5 text-light">Pesan Anda:</label>
                                    <textarea id="message" name="message" class="form-control form-control-lg" rows="5" required placeholder="Tulis pesan Anda di sini" style="background-color: #495057; color: white; border: 1px solid #6c757d;"></textarea>
                                </div>
        
                                <button type="submit" class="btn btn-light btn-lg w-100">Kirim Pesan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        
                       
</x-front.layout>       