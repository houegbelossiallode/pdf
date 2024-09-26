<?php

namespace App\Http\Controllers;

use App\Mail\PdfLinksMail;
use Illuminate\Http\Request;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        // Configuration de FedaPay avec les clés API depuis le fichier .env
        FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_SANDBOX') ? 'sandbox' : 'live');
    }


    public function confirmation(){
        $cart = session()->get('cart',[]);
        $total = 0;
        foreach($cart as $item){
            $total+= $item['price'] * $item['quantity'];
           }
           session()->forget('cart');
        return view('pdfs.confirmation',compact('cart','total'));
        // Vider le panier après la réussite du paiement

    }


public function checkout(Request $request) {
    $cart = session()->get('cart');
    $total = array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    $paymentData = [
        'amount' => $total,
        "currency" => ["iso" => "XOF"],
        'description' => 'Paiement pour les PDFs',
        'callback_url' => route('order.success'),

    ];

    $transaction = \FedaPay\Transaction::create([
       'description' => $paymentData['description'],
       'amount' => $paymentData['amount'],
       'callback_url' => $paymentData['callback_url'],
       'currency' => ['iso'=>'XOF'],
    ]);



    // Redirection vers la page de paiement FedaPay
    $token = $transaction->generateToken()->url;
    return redirect()->to($token);

}


public function success(Request $request) {
    // Récupérer l'ID de la transaction depuis FedaPay
    $transactionId = $request->get('id'); // Assurez-vous que FedaPay renvoie cet ID via la redirection.

    // Vérifier l'état de la transaction
    $transaction = Transaction::retrieve($transactionId);

    // Si le paiement a réussi
    if ($transaction->status === 'approved') {
        // Envoyer les liens des PDFs à l'utilisateur
        $user = Auth::user();
        $cart = session()->get('cart',[]);

        // Logique pour envoyer les liens des PDF à l'utilisateur
      //  $pdfLinks = [
        //    "https://example.com/document1.pdf",
        //    "https://example.com/document2.pdf"
       // ];

            // Par exemple, vous pouvez envoyer un email contenant les liens
            Mail::to($user->email)->send(new PdfLinksMail($cart,$user));
      

       //conserver les informations dans une variable de session temporaire

       session()->put('confirmation',$cart);



        // Rediriger l'utilisateur vers une page de confirmation ou de succès
        return redirect()->route('order.confirmation')->with('success', 'Paiement validé et PDFs envoyés.');
    } else {
        // Si le paiement a échoué ou n'est pas validé
        return redirect()->route('order.checkout')->with('error', 'Le paiement a échoué ou n\'a pas été validé.');
    }
}


}