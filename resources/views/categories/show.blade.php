@extends('app')

@section('content')

<style>
    /* Estilo para el texto del formulario */
    form label,
    form select,
    form textarea {
        color: rgb(0, 0, 0);
        font-weight: bold;
    }

    form input[type="text"] {
        color: black;
    }

    /* Estilo para el texto de las tablas */
    table th,
    table td {
        color: rgb(255, 255, 255);
        font-weight: bold;
    }
</style>


<style>
    body {
        background-image: url('https://images.pexels.com/photos/1054218/pexels-photo-1054218.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<style>
    .neon {
        font-size: 6em;
        font-weight: 500;
        color: rgb(255, 255, 255);
        text-shadow: 0 0 5px #03f4d4,
            0 0 25px #00aeff,
            0 0 50px #1a7ea5,
            0 0 100px #00d9ff;
        letter-spacing: 5px;
        cursor: pointer;
        text-transform: uppercase;
        transition: 1s;
        font-size: 40px;
        font-family: forte;
    }
</style>


        <div class="container w-50 border p-4">
            <div class="row mx-auto">
                <form method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}">
                    @method('PATCH')
                    @csrf

                    <div class="col">
                        <h4 class="mb-4 text-center neon">Actualizar Categoría</h4>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @error('color')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de la categoría</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Nombre de la Categoría" value="{{ $category->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="Descripción de la Categoría" value="{{ $category->description }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Escoge un color para la categoría</label>
                            <input type="color" class="form-control form-control-color" name="color" id="color"
                                value="{{ $category->color }}" title="Choose your color" required>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary"><strong>ACTUALIZAR CATEGORÍA</strong></button>
                        </div>
                    </div>
                </form>

                <div class="col">
                    @if ($category->todos->count() > 0)
                        <h4 class="mb-4"><Strong>Nombres para esta Categoría:</Strong></h4>
                        @foreach ($category->todos as $todo)
                            <div class="row py-1">
                                <div class="col-md-9 d-flex align-items-center">
                                    <a href="{{ route('todos-edit', ['id' => $todo->id]) }}" style="color: rgb(0, 0, 0); font-weight: bold;">{{ $todo->title }}</a>
                                </div>

                                <div class="col-md-3 d-flex justify-content-end">
                                    <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm"><strong>ELIMINAR</strong></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p><strong>No hay Nombres para esta categoría</strong></p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
