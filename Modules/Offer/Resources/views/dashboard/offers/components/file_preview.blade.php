<style>
    .btn-file{
        margin-bottom: 15px;
    }
    .file-preview{
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .file-preview-frame{
        max-width: 300px;
        position: relative;
        margin: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .file-preview-frame .fileinput-remove{
        position: absolute;
        top: 0;
        right: 0;
        background-color: #FFF;
        padding: 1px 2px;
        font-size: 16px;
        cursor: pointer;
    }
    .file-preview-frame .fileinput-remove:hover{
        background: #000;
        color: #FFF;
    }
    .float-left{
        float: left;
    }
    .float-right{
        float: right;
    }
</style>
<div class="file-input  {{!isset($value) ? 'hidden' : ''}}" id="{{str_replace("[",'',str_replace(']','',$key))}}_preview">
    <input class="hidden" data-name="{{$key}}" id="{{str_replace("[",'',str_replace(']','',$key))}}" name="{{$key}}" type="file" accept="image/*" {{isset($multiple) ? $multiple : ''}}>
    <div tabindex="500" class="btn btn-primary btn-file">
        <i class="glyphicon glyphicon-folder-open"></i>
        <span class="hidden-xs">Browse …</span>
    </div>
    <div class="file-preview">
        <div class="file-drop-disabled">
            <div class="file-preview-thumbnails">
                @foreach($value as $img)
                <div class="file-preview-frame float-{{locale() == 'ar' ? 'right' : 'left'}}">
                    <div class="fileinput-remove {{ !in_array($key,['main_image']) ? '' : 'hidden'}}" data-id="{{ $img->id }}"><i class="fa fa-times"></i></div>
                    <img src="{{$img->getUrl()}}" class="file-preview-image" title="Screenshot" alt="Screenshot" style="width:160px;height:160px;">
                </div>
                @endforeach
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="kv-upload-progress hide">
        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                0%
            </div>
        </div>
    </div>

    <button type="button" tabindex="500" title="Abort ongoing upload" class="btn btn-default hide fileinput-cancel fileinput-cancel-button">
        <i class="glyphicon glyphicon-ban-circle"></i>
        <span class="hidden-xs">Cancel</span>
    </button>

</div>
