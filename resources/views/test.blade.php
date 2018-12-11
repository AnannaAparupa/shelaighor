@foreach($posts as $post)
    <p>{{ $post->blog_title }}</p>
    @php
    $tags = $post->tags;
    $category = $post->category;
    $user = $post->user;
    @endphp
    <p>Tags</p>
    <ul>
        @foreach($tags as $tag)
            <li>{{ $tag->tag_title }}</li>
        @endforeach
    </ul>
    <p>Category Title: {{ $category->category_name }}</p>
    <p>User Name: {{ $user->name }}</p>
    <img src="{{ Voyager::image($post->blog_image) }}" alt="">
    {!! $post->blog_details !!}
    @endforeach