<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Circle Banner Information')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_circle_banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3" for="status">{{__('Status')}}</label>
                <div class="col-sm-9">
                    <label class="switch">
                        <input type="checkbox" name="status">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3" for="link">{{__('Link')}}</label>
                <div class="col-sm-9">
                    <input type="url" placeholder="{{__('Link')}}" id="link" name="link" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3" for="title">{{__('Title')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{__('Title')}}" id="title" name="title" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3">
                    <label class="control-label">{{__('Banner Circle Images')}}</label>
                    <strong>(500px*564px)</strong>
                </div>
                <div class="col-sm-9">
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

        $('.demo-select2').select2();

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
