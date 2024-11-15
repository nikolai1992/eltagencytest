@if($image)
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <label for="lfm_{{$loop->index}}">Зображення</label>
                <a id="lfm_{{$loop->index}}" data-input="thumbnail_{{$loop->index}}" data-preview="holder_{{$loop->index}}">
                    <img id="holder_{{$loop->index}}" class="img-bordered-sm" style="max-height: 80px;max-width: 80px;background-color: cadetblue" src="{{$image??''}}">
                </a>
                <input id="thumbnail_{{$loop->index}}" class="form-control" type="text" name="{{$field}}[{{$loop->index}}]" value="{{$image}}">
            </div>
        </div>
    </div>
@else
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <label for="lfm_0">Зображення</label>
                <a id="lfm_0" data-input="thumbnail_0" data-preview="holder_0">
                    <img id="holder_0" class="img-bordered-sm" style="max-height: 80px;max-width: 80px;background-color: cadetblue" src="">
                </a>
                <input id="thumbnail_0" class="form-control" type="text" name="{{$field}}[0]" value="">

            </div>
        </div>
    </div>
@endif

@section('js')
    @parent
    @if($image)
        <script>$('#lfm_{{$loop->index}}').filemanager('image');</script>
    @else
        <script>$('#lfm_0').filemanager('image');</script>
    @endif
@endsection
