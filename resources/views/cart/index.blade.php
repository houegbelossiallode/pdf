<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#33b5e5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">
    <link rel='stylesheet' id='roboto-subset.css-css'  href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5' type='text/css' media='all' />
    <meta charset="utf-8">

<section class="h-100">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">
            @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}
            </div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}
            </div>
            @endif
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-normal mb-0">Mon panier</h3>
            <div>
              <p class="mb-0"><span class="text-muted"><h1>Total  {{ $total }} €</h1></p>
            </div>
          </div>

          @if(session('cart'))

          <div class="card rounded-3 mb-4">
            @foreach(session('cart') as $id => $details)
            <div class="card-body p-4">
              <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-2 col-lg-2 col-xl-2">
                    <img src="{{ asset('images/pdf.png') }}" alt="PDF" >
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                  <p class="lead fw-normal mb-2">{{ $details['name'] }}</p>
                  <p><span class="text-muted">{{ $details['price'] }} € </span></p>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                    <form action="{{ route('cart.decrement', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" >-</button>
                    </form>

                  <input id="form1" min="0" name="quantity" value="{{ $details['quantity'] }}"
                    class="form-control form-control-sm" />
                    <form action="{{ route('cart.increment', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">+</button>
                    </form>

                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                  <h5 class="mb-0">{{ $details['price'] * $details['quantity'] }} €</h5>
                </div>
                <!-- Bouton pour supprimer l'article du panier -->
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                </form>
              </div>
            </div>
          </div>


          <div class="card mb-4">
            <div class="card-body p-4 d-flex flex-row">
              <div data-mdb-input-init class="form-outline flex-fill">
                <input type="text" id="form1" class="form-control form-control-lg" />
                <label class="form-label" for="form1">Discound code</label>
              </div>
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning btn-lg ms-3">Apply</button>
            </div>
          </div>
          @endforeach
          <div class="card">
            <div class="card-body">
              <a  href="{{ route('order.checkout') }}" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-block btn-lg">Proceed to Pay</a>
            </div>
          </div>

          @endif
        </div>
      </div>
    </div>
  </section>







  <!-- jQuery (Toastr dépend de jQuery) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      @if (Session::has('message'))
      <script>
          toastr.options = {
              "progressBar" : true,
          }
          toastr.success("{{ Session::get('message') }}", 'Success !!!'  );
      </script>
      @endif

      @if (Session::has('info'))
      <script>
          toastr.options = {
              "progressBar" : true,
          }
          toastr.info("{{ Session::get('info') }}", 'Info !!!'  );
      </script>
      @endif


      @if (Session::has('danger'))
      <script>
          toastr.options = {
              "progressBar" : true,
          }
          toastr.error("{{ Session::get('danger') }}"  );
      </script>
      @endif


</body>
</html>








