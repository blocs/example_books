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
        self::option_tags('name');

        return view('books.index', compact('books'));
    }

    /**
     * 新規登録画面を表示します.
     */
    public function create()
    {
        $book = new Book();
        self::option_tags('tags');

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
        self::insert_tags($book->id, $request->input('tags'));

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
            $val['tags'] = $book->tagLabels();
        }

        self::option_tags('tags');

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
        self::insert_tags($book->id, $request->input('tags'));

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

        // 本のタグの削除.
        BookTag::where('book_id', $id)->delete();

        return redirect()->route('book.index')->with([
            'message' => "削除しました（id={$book->id}）.",
        ]);
    }

    private static function option_tags($option_name)
    {
        \Blocs\Option::add($option_name, [
            'Ash' => '灰色',
            'Blue' => 'ブルー',
            'Pink' => 'ピンク',
        ]);

        $book_tags = BookTag::select('name')->distinct()->orderBy('name')->get();
        foreach ($book_tags as $book_tag) {
            \Blocs\Option::add($option_name, $book_tag->name);
        }
    }

    private static function insert_tags($book_id, $book_tag_names)
    {
        if (!is_array($book_tag_names)) {
            return;
        }

        foreach ($book_tag_names as $book_tag_name) {
            $book_tag_name = trim($book_tag_name);
            if (empty($book_tag_name)) {
                continue;
            }

            (new BookTag())->fill(['book_id' => $book_id, 'name' => $book_tag_name])->save();
        }
    }
}
