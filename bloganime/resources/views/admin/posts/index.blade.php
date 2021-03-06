@extends('adminlte::page')

@section('title', 'Admin - POSTS')

@section('content_header')
<h1>
    Posts
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create-post">
        Crear
    </button>
</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de Posts</h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="posts" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Post</th>
                            <th>Autor</th>
                            <th>Contenido</th>
                            <th>Imagen</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td><FONT size=2 COLOR=#545454>{{ $post->id }}</font></td>
                            <td><FONT size=2 COLOR=#545454>{{ $post->category->name}}</font></td>
                            <td><FONT size=2 COLOR=#545454>{{ $post->title }}</font></td>
                            <td><FONT size=2 COLOR=#545454>{{ $post->author }}</font></td>
                            <td><FONT size=2 COLOR=#545454>{{ $post->content }}</font></td>
                            <td>
                                <img src="{{asset($post->featured)}}" alt="{{ $post->title }}" class="img-fluid" width="100px">
                            </td>
                            <td> 
                            <button type="button"  style='width:80px; height:15px padding-top =2px'  class="btn btn-warning" data-toggle="modal" data-target="#modal-update-post-{{$post->id}}">
                            <font size=2>Editar </font>
                            </button>
                            <form action="{{route('admin.posts.delete', $post->id)}}" method="POST">
                                {{csrf_field() }}
                                @method('DELETE')
                                <br><button class="btn btn-danger" style='width:80px; height:15px padding-top =2px' > <font size=2>Eliminar </font></button>
                            </br></form>
                        </td>
                        </tr>
                         <!-- modal UPDATE posts -->
                        @include('admin.posts.modal-update-post')
                        <!-- /.modal -->
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Post</th>
                            <th>Autor</th>
                            <th>contenido</th>
                            <th>Imagen</th>
                            <th>Accion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<!-- modal -->
<div class="modal fade" id="modal-create-post">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title">Crear Post</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
            <form action="{{ route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field()}}
            <div class="modal-body">
               <div class="form-group">
                   <label for="title">Post</label>
                   <input type="text" name="title" class="form-control" id="post">
               </div>

               <div class="form-group">
                   <label for="category-id">Categoria</label>
                   <select name="category_id" id="category_id" class="form-control">
                       <option value=""> Elegir categoria</option>
                       @foreach($categories as $category)
                       <option value="{{$category->id}}"> {{$category->name}} </option>
                       @endforeach
                    </select>
               </div>

               <div class="form-group">
                   <label for="content">Contenido</label>
                   <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
                </div>

               <div class="form-group">
                   <label for="author">Autor</label>
                   <input type="text" name="author" class="form-control" id="author">
               </div>

               <div class="form-group">
                   <label for="featured">Imagen principal</label>
                   <input type="file" name="featured" class="form-control" id="featured">
               </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Guardar</button>
            </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


@stop

@section('js')
<script>
$(document).ready(function() {
    $('#posts').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>
@stop

