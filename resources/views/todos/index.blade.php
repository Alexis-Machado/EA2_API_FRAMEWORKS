@extends('app')

@section('content')
    <style>
        form label,
        form select,
        form textarea {
            color: white;
            font-weight: bold;
        }

        form input[type="text"] {
            color: black;
            font-weight: bold;
        }

        table th,
        table td {
            color: white;
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

    <div class="container border p-4">
        <div class="row">
            <form method="POST" action="{{ route('todos') }}">
                @csrf

                <div class="mb-3 col-12">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @if (session('success'))
                        <h6 class="alert alert-success">{{ session('success') }}</h6>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="title" id="exampleFormControlInput1"
                                placeholder="Nombre">
                        </div>

                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select name="category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="description_id" class="form-label">Descripción</label>
                            <select name="description_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="title" class="form-label">Estado de Publicación</label>
                            <input type="text" class="form-control" name="publication" id="exampleFormControlInput1"
                                placeholder="Estado de la Publicación">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <input type="submit" value="CREAR LISTA" class="btn btn-primary my-2 negrita" />
                        </div>
                    </div>
                </div>
            </form>

            <h2 class="text-center neon">Listado</h2>

            <div class="col-12">
                <div class="table-responsive">
                    <div class="text-center">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Estado de Publicación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                    <tr>
                                        <td><a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
                                        </td>
                                        <td>
                                            @if ($todo->category)
                                                <span class="color-container"
                                                    style="background-color: {{ $todo->category->color }}"></span>
                                                {{ $todo->category->name }}
                                            @else
                                                Sin categoría
                                            @endif
                                        </td>
                                        <td>
                                            @if ($todo->category)
                                                {{ $todo->category->description }}
                                            @else
                                                Sin Descripción
                                            @endif
                                        </td>
                                        <td>{{ $todo->publication }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $todo->id }}"><strong>ACTUALIZAR</strong></button>

                                                <!-- Botón para abrir el modal de eliminación -->
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $todo->id }}"><strong>ELIMINAR</strong></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL DE ACTUALIZACIÓN -->
                                    <div class="modal fade" id="editModal{{ $todo->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $todo->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">
                                                    <h5 class="modal-title mx-auto" id="editModalLabel{{ $todo->id }}">
                                                        <Strong>Actualizar Listado</Strong>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario de actualización -->
                                                    <form method="POST"
                                                        action="{{ route('todos-update', ['id' => $todo->id]) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row justify-content-center">
                                                            <!-- Columna para el primer campo -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="editTitle{{ $todo->id }}"
                                                                        class="form-label"><strong>Nombre</strong></label>
                                                                    <input type="text" class="form-control"
                                                                        name="title" id="editTitle{{ $todo->id }}"
                                                                        value="{{ $todo->title }}" placeholder="Nombre"
                                                                        style="color: black">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editCategory{{ $todo->id }}"
                                                                        class="form-label"><strong>Categoría</strong></label>
                                                                    <select name="category_id" class="form-select"
                                                                        id="editCategory{{ $todo->id }}">
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}"
                                                                                @if ($todo->category && $todo->category->id == $category->id) selected @endif>
                                                                                {{ $category->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Columna para el segundo campo -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="editDescription{{ $todo->id }}"
                                                                        class="form-label"><strong>Descripción</strong></label>
                                                                    <select name="description_id" class="form-select"
                                                                        id="editDescription{{ $todo->id }}">
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}"
                                                                                @if ($todo->category && $todo->category->id == $category->id) selected @endif>
                                                                                {{ $category->description }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editPublication{{ $todo->id }}"
                                                                        class="form-label"><strong>Estado de
                                                                            Publicación</strong></label>
                                                                    <input type="text" class="form-control"
                                                                        name="publication"
                                                                        id="editPublication{{ $todo->id }}"
                                                                        value="{{ $todo->publication }}"
                                                                        placeholder="Estado de la Publicación"
                                                                        style="color: black">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Botón de enviar -->
                                                        <div class="mb-3 text-center">
                                                            <button type="submit"
                                                                class="btn btn-primary"><strong>ACTUALIZAR</strong></button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- MODAL DE ELIMINACIÓN -->
                                    <div class="modal fade" id="deleteModal{{ $todo->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $todo->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $todo->id }}">
                                                        <strong>Eliminar Listado</strong>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Al eliminar el listado de <strong>{{ $todo->title }}</strong> se
                                                    eliminaran
                                                    todos
                                                    los Datos asociados a el mismo.
                                                    ¿Está seguro de que desea eliminar el listado
                                                    <strong>{{ $todo->title }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal"><strong>CANCELAR</strong></button>
                                                    <form action="{{ route('todos-destroy', ['id' => $todo->id]) }}"
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
            </div>
        </div>
    </div>

    <script>
        // Obtén todos los formularios con el atributo data-confirm
        const confirmForms = document.querySelectorAll('form[data-confirm]');

        // Agrega un controlador de eventos para cada formulario
        confirmForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Muestra el cuadro de diálogo de confirmación
                const message = form.getAttribute('data-confirm');
                if (confirm(message)) {
                    // Si el usuario hace clic en "Aceptar", envía el formulario
                    form.submit();
                }
            });
        });
    </script>
@endsection
