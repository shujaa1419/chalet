<div class="wn__sidebar">
    <!-- Start Single Widget -->
    <aside class="widget search_widget">
        <h3 class="widget-title">Search</h3>
        <form action="{{route('chalet.frontend.search')}}" method="get">
            @csrf
            <div class="form-input">
                <input type="text" name="keyword" value="{{old('keyword',request()->keyword)}}" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </aside>
</div>
