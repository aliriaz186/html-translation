@foreach ($dispute->resolutions as $key => $resolution)
    @if ($resolution->user_id == Auth::user()->id)
        <div class="block block-comment mb-3">
            <div class="d-flex flex-row-reverse">
                <div class="pl-3">
                    <div class="block-image">
                        @if ($resolution->user->avatar_original != null)
                            <img src="{{ asset($resolution->user->avatar_original) }}" class="rounded-circle">
                        @else
                            <img src="{{ asset('frontend/images/user.png') }}" class="rounded-circle">
                        @endif
                    </div>
                </div>
                <div class="flex-grow-1 ml-5 pl-5">
                    <div class="p-3 bg-gray rounded">
                        {{ $resolution->resolution }}
                    </div>
                    <span class="comment-date alpha-7 small mt-1 d-block text-right">
                        {{ date('h:i:m d-m-Y', strtotime($resolution->created_at)) }}
                    </span>
                </div>
            </div>
        </div>
    @else
        <div class="block block-comment mb-3">
            <div class="d-flex">
                <div class="pr-3">
                    <div class="block-image">
                        @if ($resolution->user->avatar_original != null)
                            <img src="{{ asset($resolution->user->avatar_original) }}" class="rounded-circle">
                        @else
                            <img src="{{ asset('frontend/images/user.png') }}" class="rounded-circle">
                        @endif
                    </div>
                </div>
                <div class="flex-grow-1 mr-5 pr-5">
                    <div class="p-3 bg-gray rounded">
                        {{ $resolution->resolution }}
                    </div>
                    <span class="comment-date alpha-7 small mt-1 d-block">
                        {{ date('h:i:m d-m-Y', strtotime($resolution->created_at)) }}
                    </span>
                </div>
            </div>
        </div>
    @endif
@endforeach
