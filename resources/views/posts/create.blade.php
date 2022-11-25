
@section('create')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add Post</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('posts.store') }}">
          @csrf
          <div class="form-group">    
              <label for="author">Author</label>
              <input type="text" class="form-control" name="author"/>
          </div>
          <div class="form-group">
          <label for="author">Category</label>
          <select name="category" class="form-control">
            <option>Food</option>
            <option>Accomodation</option>
            <option>Other</option>
          </select>
          </div>
          <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title"/>
          </div>
          <label for="content">Content</label>
          <div class="form-group">
            <textarea type="text" rows="4" class="form-control" name="content"></textarea>
          </div>                         
          <button type="submit" class="btn btn-primary">Create Post</button>
      </form>
  </div>
</div>
</div>
@endsection