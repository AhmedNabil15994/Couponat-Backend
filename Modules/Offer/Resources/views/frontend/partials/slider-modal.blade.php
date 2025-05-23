<!-- Modal -->
<div class="modal fade" id="slider-modal" tabindex="-1" aria-labelledby="Filters" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($offer->images_arr as $key=>$image)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                            <img src="{{asset($image)}}" class="d-block w-100" alt="images">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleFade" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{__('apps::frontend.previous')}}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleFade" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{__('apps::frontend.next')}}</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


