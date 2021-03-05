
    <link href="{{ asset('css/jodit.min.css') }}" rel="stylesheet">

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Top Banner Information')}}</h3>
    </div>

    <form class="form-horizontal" action="{{ route('top_banner.store') }}" method="POST" enctype="multipart/form-data">
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
            <div class="form-group">
                <label class="col-sm-3" for="message">{{__('Message')}}</label>
                <div class="col-sm-9">
                    <textarea id="message" id="message" name="message" class="form-control editor" rows="5" ></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3" for="color">{{__('Background Color')}}</label>
                <div class="col-sm-9">
                    <input type="color" name="color" id="color" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3" for="height">{{__('Height')}}</label>
                <div class="col-sm-9">
                    <input type="number" min="0" max="100" name="height" id="height" class="form-control">
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
    </form>

</div>

    <!--jQuery [ REQUIRED ]-->
    <script src=" {{asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jodit.min.js') }}"></script>

    <script>
        $(".editor").each(function (el) {
   var $this = $(this);
   var buttons = $this.data("buttons");
   buttons = !buttons
       ? "source,|,bold,strikethrough,underline,italic,eraser,|,superscript,subscript,|,ul,ol,|,outdent,indent,|,font,fontsize,brush,paragraph,|,image,file,video,table,link,|,align,undo,redo,\n,selectall,cut,copyformat,|,hr,symbol,fullsize,print,about"
       : buttons;

   var editor = new Jodit(this, {
       uploader: {
           insertImageAsBase64URI: true,
       },
       toolbarAdaptive: false,
       defaultMode: "1",
       toolbarSticky: false,
       showXPathInStatusbar: false,
       buttons: buttons,
   });
});
</script>
