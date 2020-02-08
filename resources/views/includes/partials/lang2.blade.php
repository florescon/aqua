@foreach(array_keys(config('locale.languages')) as $lang)
    @if($lang != app()->getLocale())
	    <ul>
	        <li>
	            <a href="{{ '/lang/'.$lang }}">@lang('menus.language-picker.langs.'.$lang)</a>
	        </li>
	    </ul>
    @endif
@endforeach
