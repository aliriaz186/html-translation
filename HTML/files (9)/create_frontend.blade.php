
    <link href="{{ asset('css/jodit.min.css') }}" rel="stylesheet">

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Classified Product Information')}}</h3>
        </div>

        <form class="form-horizontal" action="{{ route('classified_products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3" for="switch">{{__('Status')}}</label>
                    <div class="col-sm-9">
                        <label class="switch">
                            <input type="checkbox" name="status" >
                            <span class="slider round"></span></label>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Banner')}}</label>
                        <strong>(1600px*899px)</strong>
                    </div>
                    <div class="col-sm-9">
                       <input type="file" name="banner_image">
                    </div>
                </div> --}}
                <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Slider Images')}}</label>
                        <strong>(639px*414px)</strong>
                    </div>
                    <div class="col-sm-9">
                       <input type="file" name="slider_image">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="title">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <textarea id="title" required name="title" class="form-control " rows="5" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="text">{{__('Text')}}</label>
                    <div class="col-sm-9">
                        <textarea id="text" required name="text" class="form-control " rows="5" ></textarea>
                    </div>
                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>

    </div>
