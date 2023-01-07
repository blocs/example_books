@extends('layouts/sample')
@section('content')
<h1>（Blade）本の編集</h1>

<form action="" method="POST" class="mt-5">
    @csrf
    <div class="row">
        <div class="col-4">タイトル</div>
        <div class="col-8">
            <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-4">価格</div>
        <div class="col-8">
            <input type="number" name="price" value="{{ old('price', $book->price) }}" class="form-control">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-4">概要</div>
        <div class="col-8">
            <textarea name="abstract" rows="3" class="form-control">{{ old('abstract', $book->abstract) }}</textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-4">タグ（改行区切り）</div>
        <div class="col-8">
            <textarea name="tags" rows="3" class="form-control">{{ old('tags', join("\n", $book->tagLabels())) }}</textarea>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-5">
        <input type="hidden" name="id" value="{{ $book->id }}">
        <input type="submit" class="btn btn-primary" value="更新する" formaction="{{ route('book.update', $book->id) }}"/>
        <input type="submit" class="btn btn-danger ms-3" value="削除する" formaction="{{ route('book.destroy', $book->id) }}"/>
    </div>
</form>

@endsection
