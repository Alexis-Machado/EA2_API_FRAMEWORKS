@extends('app')

@section('content')
    <style>
        /* Estilo para el texto del formulario */
        form label,
        form input[type="text"],
        form select,
        form textarea {
            color: white;
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

        .negrita {
            font-weight: bold;
        }
    </style>

    <style>
        body {
            background-image: url('https://img3.wallspic.com/previews/5/0/6/2/4/142605/142605-resumen-fila-geometria-azul-naranja-x750.jpg');
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

    <div class="container w-75 border p-4">
        <div class="row mx-auto">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <div class="mb-3 col">

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @error('color')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @if (session('success'))
                        <h6 class="alert alert-success">{{ session('success') }}</h6>
                    @endif

                    <label for="exampleFormControlInput1" class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1"
                        placeholder="Nombre de la Categoria">

                    <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                    <input type="text" class="form-control mb-2" name="description" id="exampleFormControlInput1"
                        placeholder="Descripción de la Categoria">

                    <label for="exampleColorInput" class="form-label">Escoge un color para la categoría</label>
                    <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput"
                        value="#563d7c" title="Choose your color">

                    <div class="text-center">
                        <input type="submit" value="CREAR CATEGORÍA" class="btn btn-primary my-2 negrita" />
                    </div>
                </div>
            </form>
        </div>

        <!-- Título de la tabla -->
        <h2 class="text-center neon">Lista de Categorías</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Nombre de la Categoría</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center">
                                <a class="d-flex align-items-center justify-content-center gap-2"
                                    href="{{ route('categories.show', ['category' => $category->id]) }}">
                                    <span class="color-container" style="background-color: {{ $category->color }}"></span>
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td class="text-center">{{ $category->description }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $category->id }}"><strong>ACTUALIZAR</strong></button>
                                    <button class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $category->id }}"><strong>ELIMINAR</strong></button>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL DE ACTUALIZACIÓN -->
                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h5 class="modal-title mx-auto" id="editModalLabel{{ $category->id }}">
                                            <strong>Actualizar Categoría</strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <!-- Formulario de actualización -->
                                        <form method="POST"
                                            action="{{ route('categories.update', ['category' => $category->id]) }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="mb-3">
                                                <label for="editName{{ $category->id }}" class="form-label"><strong>Nombre
                                                        de
                                                        la
                                                        Categoría</strong></label>
                                                <input type="text" class="form-control" name="name"
                                                    id="editName{{ $category->id }}" value="{{ $category->name }}"
                                                    placeholder="Nombre de la Categoría">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editDescription{{ $category->id }}"
                                                    class="form-label"><strong>Descripción</strong></label>
                                                <input type="text" class="form-control" name="description"
                                                    id="editDescription{{ $category->id }}"
                                                    value="{{ $category->description }}"
                                                    placeholder="Descripción de la Categoría">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editColor{{ $category->id }}" class="form-label"><strong>Escoge
                                                        un
                                                        color para la categoría</strong></label>
                                                <input type="color" class="form-control form-control-color" name="color"
                                                    id="editColor{{ $category->id }}" value="{{ $category->color }}"
                                                    title="Choose your color">
                                            </div>
                                            <div class="mb-3 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary mx-auto"><strong>ACTUALIZAR</strong></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL DE ELIMINACIÓN -->
                        <div class="modal fade" id="modal{{ $category->id }}" tabindex="-1"
                            aria-labelledby="modalLabel{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $category->id }}"><Strong>Eliminar
                                                categoría</Strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Al eliminar la categoría <strong>{{ $category->name }}</strong> se eliminarán
                                        todos
                                        los Nombres asignados a la misma.
                                        ¿Está seguro que desea eliminar la categoría
                                        <strong>{{ $category->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal"><strong>CANCELAR</strong></button>
                                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-danger"><strong>ELIMINAR</strong></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
