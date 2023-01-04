<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookTag;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * 本の一覧を返却します（blade利用）.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    /**
     * 本の一覧を返却します（blocs利用）.
     */
    public function indexWithBlocs()
    {
        $bookList = Book::with('tags')->get();
        return view('books.index-blocs', compact('bookList'));
    }

    /**
     * 新規登録画面を表示します.
     */
    public function create()
    {
        $book = new Book();
        return view('books.detail', compact('book'));
    }

    /**
     * 新規登録します.
     */
    public function store(BookRequest $request)
    {
        // 本の登録.
        $book = new Book();
        $book->fill($request->validated());
        $book->save();

        // 本のタグの登録.
        $tags = explode("\n", $request->input('tags', ''));
        foreach ($tags as $tag) {
            (new BookTag())->fill([ 'book_id' => $book->id, 'name' => trim($tag) ])->save();
        }

        Log::info("bookを新規登録. id={$book->id}");

        return redirect()->route('book.index')->with([
            'message' => "新規登録しました（id={$book->id}）."
        ]);
    }

    /**
     * 編集画面を表示します.
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        return view('books.detail', compact('book'));
    }

    /**
     * 更新します.
     */
    public function update(BookRequest $request, int $id)
    {
        // 本の更新.
        $book = Book::findOrFail($id);
        $book->fill($request->validated());
        $book->save();

        // 本のタグの更新（Delete & Insert）.
        BookTag::where('book_id', $id)->delete();
        $tags = explode("\n", $request->input('tags', ''));
        foreach ($tags as $tag) {
            (new BookTag())->fill([ 'book_id' => $book->id, 'name' => trim($tag) ])->save();
        }

        Log::info("bookを更新. id={$book->id}");

        return redirect()->route('book.index')->with([
            'message' => "更新しました（id={$book->id}）."
        ]);
    }

    /**
     * 削除します.
     */
    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        Log::info("bookを削除. id={$book->id}");

        return redirect()->route('book.index')->with([
            'message' => "削除しました（id={$book->id}）."
        ]);
    }
}
