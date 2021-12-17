@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">Bot Mesajı əlavə et</div>
    
                <div class="card-body">
                    
                    <form action="{{route('bot_messages.store')}}" method="post">
                        <div class="form-group">
                            <label for="body">Mesaj</label>
                            <textarea class="form-control" name="body" id="body" rows="10">{{old('body')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="text">Aid olduğu mesaj</label>
                            <select name="parent" id="parent">
                                @foreach ($messages as $message)
                                    <option value="{{$message->id}}" style="max-width: 16em;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">{!!$message->body!!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Əlavə et</button>
                        </div>
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>

<script>
    tinymce.init({
        selector: 'textarea#body',
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });


</script>
@endsection
