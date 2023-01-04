@extends('layouts/sample')
@section('content')
<h1 class="d-flex align-items-center">
    <span>本の一覧（Blade利用）</span>
    <a href="{{ route('book.register') }}" class="btn btn-outline-success ms-3">新規登録へ</a>
</h1>
<table class="table table-striped">
    <tr>
        <th style="width: 40px;">ID</th>
        <th style="width: 300px;">タイトル</th>
        <th style="width: 100px;">金額</th>
        <th>概要</th>
        <th>タグ</th>
        <th style="width: 80px;">-</th>
    </tr>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ number_format($book->price) }}円</td>
            <td>{{ $book->abstract }}</td>
            <td>
                @foreach($book->tags as $bookTag)
                    <span>{{ $bookTag->name }}</span><br>
                @endforeach
            </td>
            <td>
                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-outline-secondary btn-sm ms-3">更新</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection
