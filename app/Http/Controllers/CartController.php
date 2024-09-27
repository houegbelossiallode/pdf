<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;

class CartController extends Controller
{
  // CartController.php
public function add( $id) {
    $pdf = Pdf::find($id);

    // Vous pouvez utiliser les sessions ou une table dédiée pour le panier
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $pdf->name,
            "price" => $pdf->price,
            "quantity" => 1,
            "pdf_link"=> asset( 'storage/'. $pdf->file_path)
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'PDF ajouté au panier !');
    }

    public function increment($id)
    {
        $cart = session()->get('cart', []);

        // Vérifier si l'article existe dans le panier
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;  // Incrémenter la quantité
            session()->put('cart', $cart);  // Mettre à jour le panier dans la session
        }

        return redirect()->back()->with('success', 'Quantité mise à jour.');
    }


    public function decrement($id)
    {
        $cart = session()->get('cart', []);

        // Vérifier si l'article existe dans le panier et que la quantité est supérieure à 1
        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;  // Décrémenter la quantité
            session()->put('cart', $cart);  // Mettre à jour le panier dans la session
        }

        return redirect()->back()->with('info', 'Quantité mise à jour.');
    }

    public function remove($id)
{
    $cart = session()->get('cart', []);

    // Vérifier si l'article existe dans le panier
    if(isset($cart[$id])) {
        unset($cart[$id]); // Supprimer l'article du panier
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('danger', 'L\'article a été retiré du panier.');
}

// CartController.php
public function viewCart() {
    $cart = session()->get('cart');

    if( empty($cart)  )
    {
        $total = 0;
    }
    else
    {
//total du panier
$total = 0;

foreach($cart as $item){
 $total+= $item['price'] * $item['quantity'];
}
    }


    return view('cart.index', compact('cart','total'));
}




}