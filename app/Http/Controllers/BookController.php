<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\BookTag;

class BookController extends Controller
{
    /**
     * 本の一覧を返却します.
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    /**
     * 新規登録画面を表示します.
     */
    public function create()
    {
        $book = new Book();

        return view('books.create', compact('book'));
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
            (new BookTag())->fill(['book_id' => $book->id, 'name' => trim($tag)])->save();
        }

        return redirect()->route('book.index')->with([
            'message' => "新規登録しました（id={$book->id}）.",
        ]);
    }

    /**
     * 編集画面を表示します.
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        $val = compact('book');

        if (empty(old())) {
            $val = array_merge($val, $book->toArray());
            $val['tags'] = join("\n", $book->tagLabels());
        }

        return view('books.edit', $val);
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
            (new BookTag())->fill(['book_id' => $book->id, 'name' => trim($tag)])->save();
        }

        return redirect()->route('book.index')->with([
            'message' => "更新しました（id={$book->id}）.",
        ]);
    }

    /**
     * 削除します.
     */
    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with([
            'message' => "削除しました（id={$book->id}）.",
        ]);
    }
}
