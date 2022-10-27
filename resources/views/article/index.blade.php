@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Article List') }}
                    <br/>
                    <a href="{{ route('article.create') }}" class="btn btn-info">{{ __('Create') }}</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Article Image</th>
                                <th scope="col">Article Creator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($article) && $article->count())
                                @foreach($article as $key => $value)
                                    @php $path = Storage::url($value->article_image); @endphp
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->content }}</td>
                                        <td><img src="{{ url($path) }}" width="200px" height="100px"></td>
                                        <td>{{ $value->article_creator }}</td>
                                        <td>
                                            <a href="{{ route('article.edit', $value->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                                            <a href="{{ route('article.show', $value->id) }}" class="btn btn-success">{{ __('Show') }}</a>
                                            <form action="{{ route('article.destroy',$value->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $article->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
