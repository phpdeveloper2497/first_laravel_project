<x-layouts.main>


    <x-slot:title>
        Create blog
    </x-slot:title>


    <x-page-header>
        Create blog
    </x-page-header>

    <div class="row container-fluid py-2 px-5">
        <div class="col-lg-7 mb-5 mb-lg-1">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-12 control-group mb-4">
                            <input type="text" class="form-control p-4" name="title" value="{{old('title')}}" placeholder="Post title" />
                            @error('title')
                            <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-12 control-group mb-4 ">
                            <select class="rounded-5 form-control p-2"  name="category_id" value="Choose category" >
                                    <option value="" selected disabled>Choose category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('title')
                            <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-12 control-group mb-4">
                            <textarea class="form-control p-4" rows="4" name="short_content"  placeholder="Post short_content" >{{ old('short_content') }}</textarea>
                            @error('short_content')
                            <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group mb-4">
                        <textarea class="form-control p-4" rows="6" name="content" placeholder="Post content" >{{ old('content') }}</textarea>
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
                    <div>
                        <button class="btn btn-primary btn-block py-3 px-5" type="submit" >Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layouts.main>
