<aside class="col-lg-4">
  <!-- Widget [Search Bar Widget]-->
  <div class="widget search p-3">
    <h4 class="font-italic">Search the blog</h4>
    <form action="#" class="search-form"  action="{{ url('/search') }}" method="get">
      <div class="form-group">
        <input type="search" placeholder="What are you looking for?"  name="q" value="{{ request('q') }}">
        <button type="submit" class="submit"><i class="icon-search"></i>Go!</button>
      </div>
    </form>
  </div>
          
          <!-- Widget [Categories Widget]-->
          <div class="widget categories">
            @widget('categories')
          </div>
          <!-- Widget [Tags Cloud Widget]-->
          <div class="widget tags">       
            <header>
              <h3 class="h6">Tags</h3>
            </header>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
              <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
            </ul>
          </div>
          <div class="widget tags">       
            <header>
              <h3 class="h6">Stack Sidebar</h3>
            </header>
            @stack('sidebar')
          </div>
          

        </aside>