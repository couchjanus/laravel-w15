<nav class="bg-grey-light p-3 rounded font-sans w-full m-4">
  <div class="flex flex-wrap items-center">
    <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start">
    <ol class="list-reset flex flex-wrap items-center text-grey-dark">
      <li><a href="/" class="text-blue font-bold">Home</a></li>
      <li><span class="mx-2">/</span></li>
      <li><a href="/admin" class="text-blue font-bold">Dashboard</a></li>
      <li><span class="mx-2">/</span></li>
      <li>{{ $breadcrumbItem }}</li>
    </ol>
  </div>
  
  <div class="flex w-full pt-2 content-center justify-between md:w-2/3 md:justify-end">
  	<ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
    @isset($search)
      <form class="block mx-5 mt-4 lg:inline-block lg:mt-0" action="/admin/users/search" method="POST" role="search">@csrf
          <input class="inline-block text-sm px-4 py-2 leading-none border rounded text-black border-white" type="text" placeholder="Search users" aria-label="Search" name="q">
          <button class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0" type="submit">Search</button>
      </form>
    @endisset
    @isset($url)
	    <li class="flex-1 md:flex-none md:mr-3">
          <a href="{{route($url)}}">
					  <button class="inline-block py-1 px-2 no-underline bg-blue-300 hover:bg-blue-500 rounded" href="#">Add New</button>
          </a>
	    </li>
    @endisset
    @isset($back)
	    <li class="flex-1 md:flex-none md:mr-3">
		    <a class="inline-block py-1 px-2 no-underline bg-red-300 hover:bg-red-500 rounded" href="{{ route($back) }}">Back</a>
	    </li>
    @endisset
    @isset($trash)
        <a href="{{ route($trash)}}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-white bg-red-500 hover:bg-red-800 mt-4 lg:mt-0">Trashed</a>
    @endisset
    @isset($getStatus)
	    <li class="flex-1 md:flex-none md:mr-3">
				<div class="relative inline-block">
					<button onclick="toggleDD('myChoice')" class="drop-button py-1 px-2 focus:outline-none bg-green-300 hover:bg-green-500">Choice Status <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg></button>
          
          <div id="myChoice" class="dropdownlist absolute bg-gray-900 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">

            @foreach($status as $key => $value)
              <a class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block" href=""
                onclick="event.preventDefault();
                  document.getElementById('item-status').value={{ $key }};
                  document.getElementById('status-form').submit();">
                  {{$value}}
              </a>
            @endforeach
          </div>
          <form id="status-form" action="{{ route($getStatus) }}" method="GET" style="display: none;">
              <input type="hidden" id="item-status" name="status" value="">
          </form>
      </li>
      @endisset
    </ul>
  </div>
</nav>
