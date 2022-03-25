@if(isset($selected_category))
    @foreach($categories as $sub_cat)
        <option value="{{$sub_cat->id}}" @if($sub_cat->id == $selected_category->parent_id) selected @endif>{{str_repeat('--',$level)}}{{$sub_cat->name}}</option>
        @if(count($sub_cat->childrenRecursive))
            @include('admin.partials.category',['categories'=>$sub_cat->childrenRecursive,'level'=>$level+1,'selected_category'])
        @endif
    @endforeach
    @else
@foreach($categories as $sub_cat)
        <option value="{{$sub_cat->id}}">{{str_repeat('--',$level)}}{{$sub_cat->name}}</option>
        @if(count($sub_cat->childrenRecursive))
            @include('admin.partials.category',['categories'=>$sub_cat->childrenRecursive,'level'=>$level+1])
            @endif
            @endforeach
@endif
