@extends('layouts.app')
@section('content')
<form class="card" name="formulario" method="POST" enctype=multipart/form-data>
    <div class="card-header">
        <h4 class="card-title" style="margin-left:10%">Image Upload</h4>
    </div>
    <div class="card-body" style="margin-left:10%">
        @csrf 
        <div style="display: flex;justify-content: center;flex-wrap: wrap;">
            <label for="image_path" style="width:100%;font-size:40px">Imagen</label>
            <input type="file" name="image_path" class="form-control form-control-sm" style="margin-right:70%" id="image_path">    
            <label for="description" style="width:100%;font-size:40px">Descripción</label>
            <textarea name="description" cols="40" rows="3" style="margin-right:70%"></textarea>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <p><input style="margin-right: 9.2vw;margin-top: 1vh;" class="btn btn-primary" type="submit" value="Subir imagen"></p>
        </div>
    </div>
</form>
@endsection