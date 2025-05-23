@foreach ($mainCategories as $cat)
    @if (($model && $model->id != $cat->id) || isset($hasRelation))
		<ul>
			<li id="{{$cat->id}}" data-jstree='{"opened":true @if ($model->category_id == $cat->id),"selected":true @endif }'>
				{{$cat->title}}
				@if($cat->children->count() > 0)
					@include('category::dashboard.tree.categories.edit',['mainCategories' => $cat->children])
				@endif
			</li>
		</ul>
	@endif
@endforeach
