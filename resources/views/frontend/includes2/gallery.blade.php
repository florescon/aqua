    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row" style="margin-bottom: 15px;">
            @foreach($gallery as $image)
                <a href="{{ asset('/images/gallery/' . $image->image) }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4" style="margin-bottom: 15px;">
                    <img src="{{ asset('/images/gallery/' . $image->image) }}" width="414" class="img-fluid">
                </a>
            @endforeach
            </div>
            {{-- <div class="row" style="margin-bottom: 15px;">
                <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                    <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid">
                </a>
                <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                    <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid">
                </a>
                <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4">
                    <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid">
                </a>
            </div> --}}
        </div>
    </div>