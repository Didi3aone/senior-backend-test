@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Article edit') }}
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="required">Title *</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ old('title',$article->title) }}">
                        </div>
                        <div class="form-group">
                            <label class="required">Content *</label>
                            <textarea class="form-control" id="" name="content" rows="3">{{ old('content',$article->content) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="required">Article Image *</label>
                            <input type="file" class="form-control" id="" name="article_image">
                            <img src="{{ url(Storage::url($article->article_image)) }}" width="200px" height="100px">
                        </div>
                        <div class="form-group">
                            <label class="required">Creator *</label>
                            <input type="text" class="form-control" id="creator" placeholder="Enter creator" name="article_creator" value="{{ old('article_creator',$article->article_creator) }}">
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
