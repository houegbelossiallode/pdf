
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>



    <div class="container mt-15">

        <div class="row">
            <div class="col-sm-6">


            <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data" class="mt-15">
                @csrf
                <div>
                    <label for="name">Nom du PDF :</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                    <span  class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="file">Fichier PDF :</label>
                    <input type="file" name="file" accept="application/pdf" class="form-control" value="{{ old('file') }}">
                    @error('file')
                    <span  class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="price">Prix :</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}">
                    @error('price')
                    <span  class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Enregistrer le PDF</button>
                <button class="btn btn-info"><a href="{{ route('pdf.index') }}">Liste des pdfs</a></button>
            </form>
            </div>
            <div class="col-sm-6">

            </div>


        </div>


    </div>


</body>
</html>



