<x-layouts.main>


    <x-slot:title>
        Edit post #{{ $post->id }}
    </x-slot:title>


    <x-page-header>
        Edit post #{{ $post->id }}
    </x-page-header>

    <div class="row container-fluid py-2 px-5">
        <div class="col-lg-7 mb-5 mb-lg-1">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.update',['post'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 control-group mb-4">
                            <input type="text" class="form-control p-4" name="title" value="{{$post->title}}" placeholder="Post title" />
                            @error('title')
                            <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-12 control-group mb-4">
                            <textarea class="form-control p-4" rows="4" name="short_content"  placeholder="Post short_content" >{{$post->short_content}}</textarea>
                            @error('short_content')
                            <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group mb-4">
                        <textarea class="form-control p-4" rows="6" name="content" placeholder="Post content" >{{$post->content}}</textarea>
                        @error('content')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" mb-4">
                        <input type="file" name="photo"/>
                        @error('photo')
                        <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex">
                        <button class="btn btn-success  py-3 px-5" type="submit" >Save</button>
                        <a href="{{route('posts.show',['post'=>$post->id])}}" class="btn btn-danger  py-3 px-5" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layouts.main>
