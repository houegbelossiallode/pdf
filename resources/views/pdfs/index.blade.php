

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Pricing example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/pricing.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>


    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">

        <a class="btn btn-outline-primary" href="{{ route('cart.view') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg></a>
      </div>


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Pdf en vente</h1>
      <p class="lead">Nous avons quelques pdfs pour vous afin que vous puissiez préparer vos examens et concours</p>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}
    </div>
    @endif

    @foreach($pdfs as $pdf)
    <div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ $pdf->name }}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ number_format($pdf->price, 2) }} XOF</h1>
            <ul class="list-unstyled mt-3 mb-4">
                <img src="{{ asset('images/pdf.png') }}" alt="PDF" >
            </ul>
            <form action="{{ route('cart.add', $pdf->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary">Ajouter au panier</button>
            </form>
          </div>
        </div>


      </div>

    </div>
   @endforeach











   <!-- jQuery (Toastr dépend de jQuery) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      @if (Session::has('message'))
      <script>
          toastr.options = {
              "progressBar" : true,
          }
          toastr.success("{{ Session::get('message') }}"  );
      </script>
      @endif

    
</body>
</html>
