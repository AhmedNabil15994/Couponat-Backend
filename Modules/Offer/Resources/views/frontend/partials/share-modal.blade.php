<!-- Modal -->
<div class="modal fade" id="share-modal" tabindex="-1" aria-labelledby="Share" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="Filters">{{__('apps::frontend.share_place')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="item">
                    <div class="media mb-3">
                        <img src="{{asset($offer->main_image)}}" alt="image" class="mr-3" />
                        <div class="media-body align-self-center ">
                            <h5 class="mt-0">{{$offer->title}} </h5>
                            <p> {{$offer->discount_desc}} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{$buttons['copylink']}}" class="d-block">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-back h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.copy')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['mailto']}}" class="d-block" target="_blank">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-envelope h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.email')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['telegram']}}" class="d-block" target="_blank">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-chat h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.messages')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['whatsapp']}}" class="d-block" target="_blank">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-whatsapp h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.whatsapp')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['reddit']}}" class="d-block" target="_blank">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-messenger h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.messanger')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['facebook']}}" class="d-block" target="_blank">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-facebook h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.facebook')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['twitter']}}" class="d-block" target="_blank">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-twitter h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.twitter')}}</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$buttons['copylink']}}" class="d-block">
                            <div class="border rounded p-3 my-2">
                                <i class="bi bi-code-slash h4"></i>
                                <span class="h5 ml-2">{{__('apps::frontend.embed')}}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
