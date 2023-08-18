<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{

    public function create(Request $request)
    {
        // Valider les données envoyées par le formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Insérer la question dans la base de données
        $question = new Question();
        $question->title = $request->title;
        $question->body = $request->body;
        $question->save();

        return response()->json(['message' => 'Question ajoutée avec succès'], 201);
    }
    public function index()
    {
        $questions = Question::all(); // Récupérer toutes les questions depuis la base de données

        return response()->json($questions); // Retourner les questions sous forme de réponse JSON
    }
    public function vote(Request $request, $id)
{
    $question = Question::find($id);
    if (!$question) {
        return response()->json(['message' => 'Question not found'], 404);
    }

    $question->votes += 1;
    $question->save();

    return response()->json(['message' => 'Vote added successfully'], 200);
}
public function incrementVu(Request $request, $id)
{
    $question = Question::find($id);
    if (!$question) {
        return response()->json(['message' => 'Question not found'], 404);
    }

    $question->vu += 1;
    $question->save();

    return response()->json(['message' => 'Vu incremented successfully'], 200);
}
public function show($id)
{
    $question = Question::find($id);
    if (!$question) {
        return response()->json(['message' => 'Question not found'], 404);
    }

    return response()->json($question, 200);
}

}
