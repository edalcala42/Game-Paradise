@include('top')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
    <h3 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8">{{ $blog->titulo }}</h3>
    <br>
    <br>
    <a class="text-gray-800 underline hover:text-gray-900" href="{{route('main_page')}}">Otros blogs disponibles</a>
    <br>
    <ul>
        <h2 class="font-bold text-gray-900">Contenido:</h2>
        <li>{{ $blog->contenido }}</li>
        <br>
        <?php if(isset($sesion_admin)) : ?>
            <h2 class="font-bold text-gray-900">Registrado en el sistema:</h2>
            <li>{{ $blog->created_at }}</li>
            <br>
            <h2 class="font-bold text-gray-900">Última edición:</h2>
            <li>{{ $blog->updated_at }}</li>
            <br>
            <h2 class="font-bold text-gray-900">Añadido por el usuario:</h2>
            <li>{{ $blog->user_id }}</li>
            <h2 class="font-bold text-gray-900">Juego del que habla:</h2>
            <li>{{ $blog->juego_id }}</li>
        <?php endif; ?>
    </ul>
    <?php if(isset($sesion_invitado)) : ?>
        <hr>
        <a href="{{ route('login') }}"><h4>Si deseas realizar algún comentario al respecto, por favor inicia sesión dando clic aquí.</h4></a>
        <a href="{{ route('register') }}"><h4>Y si no tienes un cuenta, puedes crear una aquí.</h4></a>
        <hr>
    <?php endif; ?>
    
    <?php if(isset($sesion_regular_user)) : ?>
        <form action="{{ route('store-comentario2', $blog)}}" method="GET" enctype="multipart/form-data">
        @csrf
            <li class="form-line" data-type="control_textarea" id="id_8">
                <label class="form-label form-label-top form-label-auto" id="label_8" for="input_8">¿Te gustaría dejar algún comentario al respecto?<br> </label>
                <div id="cid_8" class="form-input-wide" data-layout="full">
                    <textarea id="input_8" class="form-textarea" name="comentario" style="width:648px;height:163px" data-component="textarea" aria-labelledby="label_8"></textarea>
                </div>
            </li>
            <input type="submit" value="Enviar">
        </form>
    <?php endif; ?>
    <hr>
    <br> 
    <h2 class="font-bold text-gray-900">Comentarios del blog:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>user_id</th>
                <th>Comentario</th>
            </tr>
        </thead>
        @foreach ($comentarios as $comentario)
            <tr>
                <td>{{ $comentario->user_id }}</td>
                <td>{{ $comentario->comentario }}</td>
            </tr>
        @endforeach
        <hr>  
    </table>
    <?php if(isset($sesion_blogger)) : ?>
        <hr>
        <a href="{{route('blogs.edit', $blog->id)}}">Editar</a>
        <hr>
        <form action="{{ route('blogs.destroy', $blog) }}" method="post">
            @method('DELETE')
            @csrf
        <input type="submit" value="Eliminar">
    </form>
    <?php endif; ?>
</div>
</body>
</html>