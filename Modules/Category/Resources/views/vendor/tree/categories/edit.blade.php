@foreach ($mainCategories as $cat)
		<ul>
			<li id="{{$cat->id}}" data-jstree='{"opened":true}'>
				{{$cat->title}}
				@if($cat->children->count() > 0)
					@include('category::vendor.tree.categories.edit',['mainCategories' => $cat->children])
				@endif
			</li>
		</ul>
@endforeach
