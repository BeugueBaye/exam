<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Reponse;

class ReponseController extends Controller
{
    public function ajouterReponse(Request $request, $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $request->validate([
            'reponse' => 'required|string',
        ]);

        $reponse = new Reponse();
        $reponse->reponse = $request->reponse;
        $question->reponses()->save($reponse);

        return response()->json(['message' => 'Réponse ajoutée avec succès'], 200);
    }
    public function getReponsesForQuestion($id)
{
    $question = Question::find($id);

    if (!$question) {
        return response()->json(['message' => 'Question not found'], 404);
    }

    $reponses = $question->reponses;

    return response()->json($reponses, 200);
}

}
