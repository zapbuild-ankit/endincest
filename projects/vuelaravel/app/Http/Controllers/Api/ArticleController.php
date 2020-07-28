<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller {
	public function saveArticle(Request $request) {
		$request->validate([
				'title'       => 'required',
				'description' => 'required',
			]);

		$article = new Article([
				'title'       => $request->get('title'),
				'description' => $request->get('description'),
			]);
		$article->save();

		return response()->json([

				'success' => true,
			]);
	}

	public function getArticle() {
		$articles = Article::orderBy('id', 'DESC')->get();

		return response()->json([
				'success' => true,
				'data'    => $articles
			]);
	}

	public function getEditArticle($id) {
		$article = Article::find($id);

		if (!$article) {
			return response()->json([
					'success'  => false,
					'errors'   => [
						'message' => 'Article Not Found',
					]
				]);
		}

		return response()->json([

				'success' => true,
				'data'    => $article
			]);
	}

	public function postEditArticle(Request $request, $id) {
		$request->validate([
				'title'       => 'required',
				'description' => 'required',
			]);

		$article = Article::find($id);

		$article->update($request->all());

		return response()->json('Article Successfully updated');
	}

	public function postDeleteArticle(Request $request) {
		$article = Article::find($request->get('deleteId'));

		$article->delete();

		return response()->json([
				'success' => true
			]);
	}
}