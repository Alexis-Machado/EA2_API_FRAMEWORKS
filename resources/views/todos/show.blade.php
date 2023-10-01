@extends('app')

@section('content')
    <style>
        /* Estilo para el texto del formulario */
        form label,
        form select,
        form textarea {
            color: rgb(255, 255, 255);
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
            background-image: url('https://images.pexels.com/photos/460621/pexels-photo-460621.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
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

    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0" style="background-color: transparent;">
                    <div class="card-header text-center neon">{{ __('Actualizar Listado') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('todos-update', ['id' => $todo->id]) }}">
                            @method('PATCH')
                            @csrf

                            <div class="mb-3">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <label for="title" class="form-label">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control mb-3" name="title" id="title"
                                    placeholder="{{ __('Nombre') }}" value="{{ $todo->title }}">

                                <label for="category_id" class="form-label">{{ __('Categoría') }}</label>
                                <select name="category_id" class="form-select mb-3">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $todo->category && $todo->category->id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="description_id" class="form-label">{{ __('Descripción') }}</label>
                                <select name="description_id" class="form-select mb-3">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $todo->category && $todo->category->id == $category->id ? 'selected' : '' }}>
                                            {{ $category->description }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="publication" class="form-label">{{ __('Estado de Publicación') }}</label>
                                <input type="text" class="form-control mb-3" name="publication" id="publication"
                                    placeholder="{{ __('Estado de Publicación') }}" value="{{ $todo->publication }}">
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit"
                                    class="btn btn-success"><Strong>{{ __('ACTUALIZAR') }}</Strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
