<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConversationTree;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Get the initial conversation nodes (root level)
     */
    public function getInitialNodes()
    {
        // Ambil root node yang tidak memiliki parent_id
        $nodes = ConversationTree::whereNull('parent_id')
            ->orderBy('order')
            ->get(['id', 'question', 'button_text', 'answer']);

        return response()->json([
            'success' => true,
            'message' => 'Initial conversation nodes retrieved successfully',
            'data' => [
                'question' => 'Apa yang ingin Anda lakukan?',
                'nodes' => $nodes
            ]
        ]);
    }


    /**
     * Get child nodes for a specific parent node
     */
    public function getChildNodes($parentId)
    {
        $parent = ConversationTree::find($parentId);

        if (!$parent) {
            return response()->json([
                'success' => false,
                'message' => 'Parent node not found'
            ], 404);
        }

        // Mengambil child nodes berdasarkan parent_id
        $nodes = ConversationTree::where('parent_id', $parentId)
            ->orderBy('order')
            ->get(['id', 'question', 'button_text', 'answer']);

        // Menentukan pertanyaan dan jawaban
        if ($nodes->isNotEmpty()) {
            // Pertanyaan adalah dari child node pertama
            $firstChild = $nodes->first();
            $question = $firstChild->question;

            // Jika node memiliki anak, tidak ada jawaban
            if ($firstChild->parent_id !== null) {
                $answer = null;  // Tidak ada jawaban jika masih berlanjut
            } else {
                // Jika tidak ada anak, maka ini adalah node terakhir, tampilkan jawaban
                $answer = $firstChild->answer;
            }
        } else {
            // Jika tidak ada anak, gunakan jawaban dari parent
            $question = $parent->question;
            $answer = $parent->answer;
        }

        return response()->json([
            'success' => true,
            'message' => 'Child nodes retrieved successfully',
            'data' => [
                'question' => $question,  // Pertanyaan berikutnya
                'answer' => $answer,      // Jawaban jika ada
                'nodes' => $nodes         // Opsi untuk melanjutkan
            ]
        ]);
    }


    /**
     * Get a specific node's details
     */
    public function getNode($id)
    {
        $node = ConversationTree::find($id);

        if (!$node) {
            return response()->json([
                'success' => false,
                'message' => 'Node not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Node retrieved successfully',
            'data' => [
                'id' => $node->id,
                'question' => $node->question,
                'button_text' => $node->button_text,
                'answer' => $node->answer,
                'parent_id' => $node->parent_id
            ]
        ]);
    }

    /**
     * Get the entire conversation path for a node
     */
    public function getConversationPath($nodeId)
    {
        $node = ConversationTree::find($nodeId);

        if (!$node) {
            return response()->json([
                'success' => false,
                'message' => 'Node not found'
            ], 404);
        }

        $path = [];
        $currentNode = $node;

        // Build path from current node up to root
        while ($currentNode) {
            array_unshift($path, [
                'id' => $currentNode->id,
                'question' => $currentNode->question,
                'button_text' => $currentNode->button_text,
                'answer' => $currentNode->answer
            ]);
            $currentNode = $currentNode->parent;
        }

        return response()->json([
            'success' => true,
            'message' => 'Conversation path retrieved successfully',
            'data' => $path
        ]);
    }
}