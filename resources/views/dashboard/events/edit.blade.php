<x-app-layout>
    
    <x-dashboard.layout>
        {{-- <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script> --}}
        {{-- <script src="//cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script> --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <div class="max-w-screen-md md:mt-7 md:mb-5 mx-auto">
            <div class="mb-5">
                <a href="{{ route('events.index') }}" class="text-primary text-lg flex items-center gap-2">                  
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                    <span>กลับ</span>
                </a>
            </div>
            <div class="dashboard-card">
                <h2 class="title mb-5">เพิ่มกิจกรรม</h2>
        
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('events.store') }}" method="POST" class="form-create-post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control w-full mb-1">
                        <label for="title" class="label">
                          <span class="label-text">ชื่อกิจกรรม*</span>
                        </label>
                        <input type="text" placeholder="ระบุหัวข้อกิจกรรม" class="input input-bordered w-full" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" required />
                    </div>
                    <div class="form-control w-full mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <div class="flex gap-0 5 items-center">
                            {{ url('event/') }}
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $event->slug ?? '') }}" required>
                        </div>                        
                    </div>
                    <div class="mb-3">
                        <img class="max-w-lg h-auto block mx-auto" src="{{ $event->thumbnail }}" alt="">
                    </div>
                    <div class="form-control w-full max-w-xs">
                        <label for="thumbnail" class="label">
                          <span class="label-text">รูปหน้าปกกิจกรรม*</span>
                        </label>
                        <input type="file" class="file-input file-input-bordered w-full max-w-xs" id="thumbnail" name="thumbnail" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="label">
                            <span class="label-text">รายละเอียด*</span>
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $event->description }}</textarea>
                    </div>
                    <div class="flex gap-5">
                        <div class="flex-auto">
                            <div class="form-control w-full mb-3">
                                <label for="start_date" class="label">
                                  <span class="label-text">วันที่เริ่มกิจกรรม*</span>
                                </label>
                                <input type="datetime-local" class="input input-bordered w-full" id="start_date" name="start_date" value="{{ $event->start_date }}" required />
                            </div>
                        </div>
                        <div class="flex-auto">
                            <label for="end_date" class="label">
                                <span class="label-text">วันที่จบกิจกรรม*</span>
                              </label>
                              <input type="datetime-local" class="input input-bordered w-full" id="end_date" name="end_date" value="{{ $event->end_date }}" required />
                        </div>
                    </div>            
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-wide btn-primary text-white font-bold text-lg">บันทึกกิจกรรม</button>
                    </div>                    
                </form>
            </div>
        </div>
        <script>
            ClassicEditor
                .create( document.querySelector( '#description' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    </x-dashboard.layout>

</x-app-layout>
