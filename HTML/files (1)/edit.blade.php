<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Banner Circle Information')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_circle_banners.update', $banner_circle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="panel-body">
         <div class="form-group">
                <label class="col-sm-3" for="status">{{__('Status')}}</label>
                <div class="col-sm-9">
                    <label class="switch">
                        <input type="checkbox" name="status" {{$banner_circle->status == 1?'checked':''}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3" for="link">{{__('Link')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{__('Link')}}" id="url" name="url" value="{{ $banner_circle->link}}" class="form-control" required>
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-3" for="title">{{__('Title')}}</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$banner_circle->title}}" placeholder="{{__('Title')}}" id="title" name="title" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3">
                    <label class="control-label">{{__('Banner Images')}}</label>
                    <strong>(500px*564px)</strong>
                </div>
                <div class="col-sm-9">
                    @if ($banner_circle->photo != null)
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="img-upload-preview">
                                <img loading="lazy"  src="{{ asset($banner_circle->photo) }}" alt="" class="img-responsive">
                                <input type="hidden" name="previous_photo" value="{{ $banner_circle->photo }}">
                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endif
                    <div id="photo">

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>

<script type="text/javascript">

    $(document).ready(function(){

        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });

        $("#photo").spartanMultiImagePicker({
            fieldName:        'photo',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-9 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
                console.log(index, file,  'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
                console.log(index, file,  'file size too big');
                alert('File size too big');
            }
        });
    });

</script>
