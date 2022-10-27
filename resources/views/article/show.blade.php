@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Article Show') }}
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                           <td>Title</td>
                           <td>:</td>
                           <td>{{ $article->title }}</td>
                        </tr>
                        <tr>
                           <td>Content</td>
                           <td>:</td>
                           <td>{{ $article->content }}</td>
                        </tr>
                        <tr>
                           <td>Image</td>
                           <td>:</td>
                           <td><img src="{{ url(Storage::url($article->article_image)) }}" width="200px" height="100px"></td>
                        </tr>
                        <tr>
                           <td>Creator</td>
                           <td>:</td>
                           <td>{{ $article->article_creator }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
