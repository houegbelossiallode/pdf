<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{

    public function index(){
        $pdfs = Pdf::orderBy('created_at','desc')->get();
        return view('pdfs.index', compact('pdfs'));
   }

    public function create(){
         return view('pdfs.create');
    }

    public function store(Request $request)
    {

         // Personnaliser les messages d'erreurs
  $messages = [
    'name.required' => 'Le nom du PDF est obligatoire.',
    'file.required' => 'Le fichier PDF est obligatoire.',
    'file.mimes' => 'Le fichier doit être un PDF.',
    'file.max' => 'La taille du fichier ne doit pas dépasser 10 Mo.',
    'price.required' => 'Le prix est obligatoire.',
    'price.numeric' => 'Le prix doit être un nombre.',
   ];
        // Valider les données
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:10000', // Valider que le fichier est un PDF
            'price' => 'required|numeric',
        ],  $messages);

        // Enregistrer le fichier PDF dans le dossier storage
        $filePath = $request->file('file')->store('pdfs', 'public');

        // Créer un nouvel enregistrement dans la table PDFs
        Pdf::create([
            'name' => $request->input('name'),
            'file_path' => $filePath,
            'price' => $request->input('price'),
        ]);
        return redirect()->back()->with('message', 'PDF enregistré avec succès.');
       }
}
