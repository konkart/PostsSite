@extends('base')

@include('posts/create')
@section('posts')
<div class="row">
<div class="col-sm-12">
  <div class="container header">
    <div class="row">
      <div class="col-3">
        <h1 class="display-3">Posts</h1>
      </div>
      <div class="col-2 my-auto">
        <select class="category" name="category" id="category">
          <option value="Food">Food</option>
          <option value="Accomodation">Accomodation</option>
          <option value="Other">Other</option>
          <option selected value="All">All</option>
        </select>
      </div>
    </div> 
  </div>
  <div class="container" >
    @foreach($posts as $posts)
    <div class="row post-{{$posts->id}}">
      <div class="col-6">
        <h5>{{$posts->id}} {{$posts->title}} by {{$posts->author}}</h5>
        <p>{{$posts->content}}</p>
      </div>
      <div value="{{$posts->category}}" class="col-6 post-category">
        {{$posts->category}}
      </div>
      <div class="row post-{{$posts->id}}-votes">
        <div class="col-6">
          <button id="{{$posts->id}}" class="upvote {{$posts->id}} btn btn-primary btn-sm" >Upvotes {{$posts->upvotes}}</button>
          <button id="{{$posts->id}}" class="downvote {{$posts->id}} btn btn-danger btn-sm" >Downvotes {{$posts->downvotes}}</button>
        </div>
      </div>
      <hr>
    </div>
    
    @endforeach
</div>
</div>
@push('scripts')
<script>
let selector = document.querySelector('.category')
selector.addEventListener('change', event => {
  console.log(selector.value);
  document.querySelectorAll('.post-category').forEach((element) => {
    element.parentElement.style.display = "flex"
    if (element.innerText != selector.value && selector.value!="All")
      element.parentElement.style.display = "none"
  })
})

for (const btn of document.querySelectorAll('.upvote')) {
  btn.addEventListener('click', event => {
    const element = event.currentTarget
    var url = '{{route("posts.update", ":id") }}'
    url = url.replace(':id', event.currentTarget.id )
    $.ajax({
      method: 'PUT',
      url : url,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data : {'type' : "upvote" },
      dataType: 'json',
        success:function(data) {
          element.innerText = "Upvotes "+data.votes 
        }
    });
  });
}

for (const btn of document.querySelectorAll('.downvote')) {
  btn.addEventListener('click', event => {
    const element = event.currentTarget
    var url = '{{route("posts.update", ":id") }}'
    url = url.replace(':id', event.currentTarget.id )
    $.ajax({
      method: 'PUT',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url :  url,
      data : {'type' : "downvote" },
      dataType: 'json',
        success:function(data) {
          element.innerText = "Downvotes "+data.votes 
        }
    });
  });
}
</script>
@endpush
@endsection