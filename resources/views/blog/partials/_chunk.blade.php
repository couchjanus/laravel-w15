<div class="post col-xl-6">
    <div class="post-thumbnail">
          <a href="post.html"><img src="images/cat1.jpg" alt="..." class="img-fluid"></a>
    </div>
        <div class="post-details">
          <div class="post-meta d-flex justify-content-between">
            <div class="date meta-last">{{ $post->created_at }}</div>
            <div class="category"><a href="#">{{ $post->category_id }}</a></div>
          </div>
          <a href="/blog/{{ $post->id }}">
            <h3 class="h4">{{ $post->title }}</h3>
          </a>
          
          <p class="text-muted">{{ Str::limit($post->content, 50)}}</p>
        </div>
      </div>